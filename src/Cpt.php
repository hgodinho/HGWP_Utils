<?php
/**
 * Adiciona Custom-post types
 *
 * @link https://codex.wordpress.org/Function_Reference/register_post_type
 * @package hgod/hgwputils
 * @author Henrique Godinho <ola@hgod.in>
 */

namespace HGWPUtils;

/**
 * Cpt
 */
class Cpt {

	/**
	 * Post Types
	 *
	 * @var array
	 */
	public $post_types = array();

	/**
	 * INIT
	 */
	public $init;

	/**
	 * Construct
	 *
	 * @param array   $args | CPT options.
	 * @param boolean $init | Init.
	 */
	public function __construct( $args, $init = true ) {
		$this->init = $init;
		if ( is_array( $args ) ) {
			$count = count( array_values( $args ) );
			if ( $count > 0 && $count < 2 ) {
				$post_type   = $args[0];
				$parsed_post = $this->parse_args( $post_type );
				array_push( $this->post_types, $parsed_post );
			} else {
				foreach ( $args as $post_type ) {
					$parsed_post = $this->parse_args( $post_type );
					array_push( $this->post_types, $parsed_post );
				}
			}
		}
		if ( $init ) {
			add_action( 'init', array( $this, 'registra_post' ), 10 );
		} else {
			$this->registra_post();
		}
	}

	/**
	 * Regitra Custom post-type
	 *
	 * @return (WP_Post_Type|WP_Error) The registered post type object on success, WP_Error object on failure.
	 */
	public function registra_post() {

		$post_types = $this->post_types;

		if ( is_array( $post_types ) ) {
			$count = count( array_values( $post_types ) );
			if ( $count > 0 && $count < 2 ) {
				$post_type = $post_types[0];
				$name      = $post_type['name'];
				$args      = $post_type['args'];
				$register  = register_post_type( $name, $args );
				if ( is_wp_error( $register ) ) {
					Extras::special_var_dump( $register, __CLASS__, __METHOD__, __LINE__, true );
				}
			} else {
				foreach ( $post_types as $post_type ) {
					$name = $post_type['name'];
					$args = $post_type['args'];
					if ( is_string( $name ) && is_array( $args ) ) {
						$register = register_post_type( $name, $args );
					}
					if ( is_wp_error( $register ) ) {
						Extras::special_var_dump( $register, __CLASS__, __METHOD__, __LINE__, false );
					}
				}
			}
			return $register;
		}
	}

	/**
	 * Arruma o array para passar para o método resgistra_post()
	 *
	 * @param array $post_type | Options Array.
	 * @return array $parsedpost_type | Parsed Options Array.
	 */
	public function parse_args( $post_type ) {
		$name   = $post_type['name'];
		$args   = $post_type['args'];
		$labels = $post_type['args']['labels'];

		$default_args = array(
			'label'               => 'Post Type',
			'description'         => 'Post Type Description',
			'labels'              => $labels,
			'supports'            => false,
			'bp_activity'         => false,
			'taxonomies'          => array( 'category', 'post_tag' ),
			'hierarchical'        => false,
			'public'              => true,
			'show_ui'             => true,
			'show_in_menu'        => true,
			'show_in_rest'        => true,
			'menu_position'       => 5,
			'show_in_admin_bar'   => true,
			'show_in_nav_menus'   => true,
			'can_export'          => true,
			'has_archive'         => true,
			'exclude_from_search' => false,
			'publicly_queryable'  => true,
			'capability_type'     => 'post',
		);
		$parsed_args  = wp_parse_args( $args, $default_args );

		$parsedpost_type = array(
			'name' => $name,
			'args' => $parsed_args,
		);

		return $parsedpost_type;
	}
}
