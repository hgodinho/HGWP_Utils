# HGWP_Utils

Classes de utilidades para desenvolvimento em WordPress

***
## todo

- [ ] doc;
  - [x] tax
  - [x] cpt
  - [ ] admin
  - [ ] extras
- [ ] securit checks;
- [ ] error handling;
- [ ] widgets(?);
- [ ] menus(?);

***

### class HGWP_Admin

### class HGWP_Cpt

Para iniciar a classe Cpt você precisa passar dois parâmetros `$args` (array) e `$init` (boolean|default: true).

#### Parâmetros

1. __`$args`__:
   Array de post-types para serem criados. [@see `register_post_type()`](https://developer.wordpress.org/reference/functions/register_post_type/)

        array(
            array(
                'name' => 'post_type_name',
                'args' => array(
                    'label'               => 'Post Type',
                    'description'         => 'Post Type Description',
                    'labels'              => $labels, // @see https://developer.wordpress.org/reference/functions/get_post_type_labels/ for a full list os labels
                    'supports'            => array(),
                    'bp_activity'         => array(), // Support for BuddyPress activity and comments @see https://codex.buddypress.org/plugindev/post-types-activities/#2-add-comments-tracking-feature-during-the-post-type-registration
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
                )
            ),
            ...
        )

2. __`$init`__: (boolean) Se a classe inicia por default ou deve ser inicializada utilizando o método `Cpt::registra_post()`
    
    - __Default:__ `true`







#### Métodos

- __`Cpt::registra_post()`__: Chamado automaticamente quando `$init === true`, se na inicialização da classe for passado o valor `false` você precisará chamar este método manualmente para registrar os Custom Post Types no WordPress.
***
### class HGWP_Loads

***
### class HGWP_Tax

Para iniciar a classe Tax você precisa passar dois parâmetros `$args` (array) e `$init` (boolean|default: true).

#### Parâmetros

1. __`$args`__:
   Array de taxonomias a serem criadas. [@see `register_taxonomy()`](https://developer.wordpress.org/reference/functions/register_taxonomy/)

        array(
                array(
                    'name' => 'post_type_name', // string
                    'post_types' => 'post_types', // string|array
                    'args' => array( // @see https://developer.wordpress.org/reference/functions/register_taxonomy/
                        'hierarchical' => true,
                    ),
                    'labels'           => array(
                        'name'          => 'Name of tax', @see https://developer.wordpress.org/reference/functions/get_taxonomy_labels/
                    ),
                ),
                ...
            );

2. __`$init`__: (boolean) Se a classe inicia por default ou deve ser inicializada utilizando o método `Tax::registra_taxonomia()`
    
    - __Default:__ `true`
#### Métodos

- __`Tax::registra_taxonomia()`__: Chamado automaticamente quando `$init === true`, se na inicialização da classe for passado o valor `false` você precisará chamar este método manualmente para registrar taxonomias no WordPress.
***
### class HGWP_Utils

***
## Changelog
- `0.14` melhoria na exibição EXTRAS::special_var_dump
- `0.13` desfaz ação anterior
- `0.12.3` muda o hook do cpt para after_setup_theme
- `0.12.2` adiciona prioridade 10 para o init
- `0.12.1` adiciona suporte para BuddPress Activity
- `0.12` condicional $init na classe Tax, melhoria na dumentação
- `0.11.9` remove condicional $init registra_post
- `0.11.8` bug-fix na registra_post
- `0.11.7` condicional $init aprimorada e adição e envio de warning para query-monitor
- `0.11.6` correção do chamado da classe de debug nas classe Cpt e Load
- `0.11.5` correção do chamado da classe de debug na classe tax quando o registro de taxonomias retornava um erro
- `0.11.4` melhoria na apresentacao do log
- `0.11.3` arrumar bugs em Extras::special_log()
- `0.11.2` adiciona wp_inline_script no loop do Loads. passar parametro no array script['inline_scripts']
- `0.11.1` bug file_data()
- `0.11.0` snake_case_functions
- `0.10.0` mudança no nome dos arquivos PascalCase 
- `0.9.2`
- `0.9.1` composer nome update
- `0.9.0` modificacao nome das classes psr-4 standard PascalCase
- `0.8.0` modificacao dos nomes das classes
- `0.7.1` estrutura das pastas e autoload
- `0.7.0` namespace e phpcs
- `0.6.0` mudança no nome composer
- `0.5.0` mudança no nome das classes e adiçao da HGWP_Utils
- `0.4.0` 
- `0.3.2` minor changes
- `0.3.1` minor changes
- `0.3.0` minor changes
- `0.2.1` missing code for add_action on styles array of class-hgod-load.php,
- `0.2.0` multiple adds and changes,
- `0.1.0` init.

