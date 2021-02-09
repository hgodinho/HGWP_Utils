<?php
/**
 * HGod_Loads
 *
 * @package hgod/classes 
 * @author Henrique Godinho <ola@hgod.in>
 */

/**
 * HGod_Loads
 *
 * Loop thru array and register scripts and styles in the passed hooks
 *
 * @package hgod/classes
 * @version 1.0.0
 * @author Henrique Godinho <hnrq.godinho@gmail.com>
 *
 * @see current_filter() https://developer.wordpress.org/reference/functions/current_filter/
 *
 * # Scripts
 * @see wp_register_script() https://developer.wordpress.org/reference/functions/wp_register_script/
 * @see wp_enqueue_script() https://developer.wordpress.org/reference/functions/wp_enqueue_script/
 *
 * # Styles
 * @see wp_register_style() https://developer.wordpress.org/reference/functions/wp_register_style/
 * @see wp_enqueue_style() https://developer.wordpress.org/reference/functions/wp_enqueue_style/
 * @deprecated 1.1.0
 */
class HGod_Loads {
	/**
	 * Scripts options array.
	 *
	 * @var array
	 */
	protected $scripts = array();

	/**
	 * Stles options array.
	 *
	 * @var array
	 */
	protected $styles = array();

	/**
	 * Construtor
	 *
	 * @param array $args | Loads options array.
	 */
	public function __construct( $args ) {
		$this->scripts = $args['scripts'];
		$this->styles  = $args['styles'];
		$this->loop_actions();
	}

	/**
	 * Loop Scripts
	 *
	 * @return void
	 */
	public function loop_scripts() {
		$scripts = $this->scripts;
		$filter  = current_filter();
		if ( isset( $scripts ) ) {
			if ( is_array( $scripts ) ) {
				foreach ( $scripts as $script ) {
					if ( $filter === $script['hook'] ) {
						$done = wp_register_script(
							$script['handle'],
							$script['src'],
							$script['deps'],
							$script['ver'],
							$script['in_footer']
						);
						if ( ! $done ) {
							// HGodBee::hb_var_dump( $done, __CLASS__, __METHOD__, __LINE__, true );
						}
						wp_enqueue_script( $script['handle'] );
					}
				}
			}
		}
	}

	/**
	 * Loop Styles
	 *
	 * @return void
	 */
	public function loop_styles() {
		$styles = $this->styles;
		$filter = current_filter();
		if ( isset( $styles ) ) {
			if ( is_array( $styles ) ) {
				foreach ( $styles as $style ) {
					if ( $filter === $style['hook'] ) {
						$done = wp_register_style(
							$style['handle'],
							$style['src'],
							$style['deps'],
							$style['ver'],
							$style['in_footer']
						);
						if ( ! $done ) {
							// HGodBee::hb_var_dump( $style['ver'], __CLASS__, __METHOD__, __LINE__, true );
						}
						wp_enqueue_style( $style['handle'] );
					}
				}
			}
		}
	}

	/**
	 * Loop add_actions
	 *
	 * @return void
	 */
	public function loop_actions() {
		$scripts = $this->scripts;
		$styles  = $this->styles;
		if ( isset( $scripts ) ) {
			if ( is_array( $scripts ) ) {
				foreach ( $scripts as $script ) {
					add_action( $script['hook'], array( $this, 'loop_scripts' ) );
				}
			}
		}
		if ( isset( $styles ) ) {
			if ( is_array( $styles ) ) {
				foreach ( $styles as $style ) {
					add_action( $style['hook'], array( $this, 'loop_styles' ) );
				}
			}
		}
	}

}
