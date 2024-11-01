<?php

namespace WPT_Masonry_Divi_Modules\MasonryPostTypeGallery;

use  ET_Builder_Module ;
class MasonryPostTypeGallery extends ET_Builder_Module
{
    public  $slug = 'et_pb_masonry_post_type_gallery' ;
    public  $vb_support = 'on' ;
    protected  $container ;
    protected  $helper ;
    public  $icon_path ;
    protected  $module_credits = array(
        'module_uri' => 'https://wptools.app/wordpress-plugin/masonry-gallery-and-posts-for-divi/?utm_source=customer-website&utm_medium=post-type-module&utm_campaign=divi-masonry&utm_content=module-credits',
        'author'     => 'WP Tools',
        'author_uri' => 'https://wptools.app/wordpress-plugin/masonry-gallery-and-posts-for-divi/?utm_source=customer-website&utm_medium=post-type-module&utm_campaign=divi-masonry&utm_content=module-credits',
    ) ;
    public function __construct( $container, $fullwidth = false )
    {
        $this->container = $container;
        parent::__construct();
        $this->fullwidth = $fullwidth;
    }
    
    /**
     * init divi module *
     */
    public function init()
    {
        $this->name = esc_html__( 'Masonry Posts', '' );
        $this->icon_path = $this->container['plugin_dir'] . '/images/logo.svg';
    }
    
    /**
     * get the fields helper class *
     */
    public function helper()
    {
        
        if ( !$this->helper ) {
            $this->helper = new Fields( $this->container );
            $this->helper->set_module( $this );
        }
        
        return $this->helper;
    }
    
    /**
     * get the module toggles *
     */
    public function get_settings_modal_toggles()
    {
        return [
            'general'  => [
            'toggles' => [
            'main_content' => esc_html__( 'Post Filter', 'et_builder' ),
            'content'      => esc_html__( 'Content', 'et_builder' ),
            'masonry'      => esc_html__( 'Masonry Settings', 'et_builder' ),
        ],
        ],
            'advanced' => [
            'toggles' => [
            'grid_item'             => esc_html__( 'Grid Item', 'et_builder' ),
            'grid_item_hover'       => esc_html__( 'Grid Item : Hover Overlay', 'et_builder' ),
            'title'                 => esc_html__( 'Title', 'et_builder' ),
            'item_meta_container'   => esc_html__( 'Meta Text Container', 'et_builder' ),
            'item_meta'             => esc_html__( 'Meta Text', 'et_builder' ),
            'item_meta_link'        => esc_html__( 'Meta Link', 'et_builder' ),
            'description'           => esc_html__( 'Description', 'et_builder' ),
            'button'                => esc_html__( 'Button', 'et_builder' ),
            'pagination'            => esc_html__( 'Pagination', 'et_builder' ),
            'pagination_link_text'  => esc_html__( 'Pagination Link Text', 'et_builder' ),
            'no_post_error_heading' => esc_html__( '"No Posts" Error Heading', 'et_builder' ),
            'no_post_error_body'    => esc_html__( '"No Posts" Error Body', 'et_builder' ),
        ],
        ],
        ];
    }
    
    /**
     * get the css fields for advanced divi module settings *
     */
    public function get_custom_css_fields_config()
    {
        return $this->helper()->get_css_fields();
    }
    
    /**
     * get the advanced field for divi module settings *
     */
    public function get_advanced_fields_config()
    {
        $config = [];
        $config['text'] = false;
        $config['link_options'] = false;
        $config['max_width'] = false;
        $config += $this->container['masonry']->get_advanced_fields_config( $this );
        $config['fonts']['no_post_error_heading'] = [
            'label'          => esc_html__( 'Heading', '' ),
            'font_size'      => [
            'default_on_front' => '',
            'range_settings'   => [
            'min'  => '1',
            'max'  => '100',
            'step' => '1',
        ],
            'validate_unit'    => true,
        ],
            'line_height'    => [
            'default_on_front' => '',
            'range_settings'   => [
            'min'  => '0.1',
            'max'  => '10',
            'step' => '0.1',
        ],
        ],
            'letter_spacing' => [
            'default_on_front' => '0px',
            'range_settings'   => [
            'min'  => '0',
            'max'  => '10',
            'step' => '1',
        ],
            'validate_unit'    => true,
        ],
            'text_align'     => [
            'default_on_front' => 'center',
            'default'          => 'center',
        ],
            'css'            => [
            'main'      => $this->get_selector( 'no_post_error_heading' ),
            'important' => 'all',
        ],
            'tab_slug'       => 'advanced',
            'toggle_slug'    => 'no_post_error_heading',
        ];
        $config['fonts']['no_post_error_body'] = [
            'label'          => esc_html__( 'Body', '' ),
            'font_size'      => [
            'default_on_front' => '',
            'range_settings'   => [
            'min'  => '1',
            'max'  => '100',
            'step' => '1',
        ],
            'validate_unit'    => true,
        ],
            'line_height'    => [
            'default_on_front' => '',
            'range_settings'   => [
            'min'  => '0.1',
            'max'  => '10',
            'step' => '0.1',
        ],
        ],
            'letter_spacing' => [
            'default_on_front' => '0px',
            'range_settings'   => [
            'min'  => '0',
            'max'  => '10',
            'step' => '1',
        ],
            'validate_unit'    => true,
        ],
            'text_align'     => [
            'default_on_front' => 'center',
            'default'          => 'center',
        ],
            'css'            => [
            'main'      => $this->get_selector( 'no_post_error_body' ),
            'important' => 'all',
        ],
            'tab_slug'       => 'advanced',
            'toggle_slug'    => 'no_post_error_body',
        ];
        $config['fonts']['item_meta'] = [
            'label'          => esc_html__( 'Meta Text', '' ),
            'font_size'      => [
            'default_on_front' => '13px',
            'range_settings'   => [
            'min'  => '1',
            'max'  => '100',
            'step' => '1',
        ],
            'validate_unit'    => true,
        ],
            'line_height'    => [
            'default_on_front' => '',
            'range_settings'   => [
            'min'  => '0.1',
            'max'  => '10',
            'step' => '0.1',
        ],
        ],
            'letter_spacing' => [
            'default_on_front' => '0px',
            'range_settings'   => [
            'min'  => '0',
            'max'  => '10',
            'step' => '1',
        ],
            'validate_unit'    => true,
        ],
            'text_align'     => [
            'default_on_front' => 'center',
            'default'          => 'center',
        ],
            'css'            => [
            'main'      => $this->get_selector( 'item_meta' ),
            'important' => 'all',
        ],
            'tab_slug'       => 'advanced',
            'toggle_slug'    => 'item_meta',
        ];
        $config['fonts']['item_meta_link'] = [
            'label'          => esc_html__( 'Meta Text', '' ),
            'font_size'      => [
            'default_on_front' => '13px',
            'range_settings'   => [
            'min'  => '1',
            'max'  => '100',
            'step' => '1',
        ],
            'validate_unit'    => true,
        ],
            'line_height'    => [
            'default_on_front' => '',
            'range_settings'   => [
            'min'  => '0.1',
            'max'  => '10',
            'step' => '0.1',
        ],
        ],
            'letter_spacing' => [
            'default_on_front' => '0px',
            'range_settings'   => [
            'min'  => '0',
            'max'  => '10',
            'step' => '1',
        ],
            'validate_unit'    => true,
        ],
            'text_align'     => [
            'default_on_front' => 'center',
            'default'          => 'center',
        ],
            'css'            => [
            'main'      => $this->get_selector( 'item_meta_link' ),
            'important' => 'all',
        ],
            'tab_slug'       => 'advanced',
            'toggle_slug'    => 'item_meta_link',
        ];
        $config['button']['button'] = [
            'label'           => esc_html__( 'Button', 'ultimate-carousel-for-divi' ),
            'css'             => [
            'main'      => $this->get_selector( 'button' ),
            'alignment' => $this->get_selector( 'button_wrapper' ),
        ],
            'margin_padding'  => [
            'css'           => [
            'margin'    => $this->get_selector( 'button_wrapper' ),
            'padding'   => $this->get_selector( 'button' ),
            'important' => 'all',
        ],
            'custom_margin' => [
            'default' => '0|10px|10px|10px|false|false',
        ],
        ],
            'use_alignment'   => true,
            'box_shadow'      => true,
            'depends_on'      => [ 'show_button' ],
            'depends_show_if' => 'on',
            'tab_slug'        => 'advanced',
            'toggle_slug'     => 'button',
        ];
        $config['meta_margin_padding'] = [
            'meta' => [
            'margin_padding' => [
            'css'         => [
            'use_margin'  => true,
            'use_padding' => true,
            'main'        => $this->get_selector( 'item_meta' ),
            'important'   => 'all',
        ],
            'tab_slug'    => 'advanced',
            'toggle_slug' => 'item_meta',
        ],
        ],
        ];
        $config['fonts']['pagination_link_text'] = [
            'label'           => esc_html__( 'Pagination Link', '' ),
            'font_size'       => [
            'default_on_front' => '20px',
            'range_settings'   => [
            'min'  => '1',
            'max'  => '100',
            'step' => '1',
        ],
            'validate_unit'    => true,
        ],
            'line_height'     => [
            'default_on_front' => '1em',
            'range_settings'   => [
            'min'  => '0.1',
            'max'  => '10',
            'step' => '0.1',
        ],
        ],
            'letter_spacing'  => [
            'default_on_front' => '0px',
            'range_settings'   => [
            'min'  => '0',
            'max'  => '10',
            'step' => '1',
        ],
            'validate_unit'    => true,
        ],
            'hide_text_align' => true,
            'css'             => [
            'main'      => $this->get_selector( 'previous_pagination_link' ) . ',' . $this->get_selector( 'next_pagination_link' ),
            'important' => 'all',
        ],
            'tab_slug'        => 'advanced',
            'toggle_slug'     => 'pagination_link_text',
        ];
        //  spacing advanced settings.
        $config['pagination_wrapper_margin_padding'] = [
            'pagination_wrapper' => [
            'margin_padding' => [
            'css' => [
            'use_margin'  => true,
            'use_padding' => false,
            'main'        => $this->get_selector( 'pagination_wrapper' ),
            'important'   => 'all',
        ],
        ],
        ],
        ];
        return $config;
    }
    
    /**
     * get the divi module fields *
     */
    public function get_fields()
    {
        return $this->helper()->get_fields();
    }
    
    /**
     * Render the divi module *
     */
    public function render( $attrs, $content = null, $render_slug = null )
    {
        $props = wp_parse_args( $this->props, $this->helper()->get_defaults() );
        $module_class = trim( \ET_Builder_Element::add_module_order_class( '', $render_slug ) );
        $multi_view = et_pb_multi_view_options( $this );
        $classes = [ 'masonry-grid' ];
        if ( $props['hide_until_loaded'] == 'on' ) {
            $classes[] = 'wpt-masonry-hidden';
        }
        $this->add_classname( [ 'wpt-masonry' ] );
        $this->container['divi']->enqueue_assets();
        $this->container['masonry']->set_styles( $this, $render_slug );
        $masonry_js_options = $this->container['masonry']->get_js_options( $this );
        $posts = $this->container['divi_post_type_query_builder']->get_posts( 'post_type_builder', $this, $props );
        $posts_query_props = $this->container['divi_post_type_query_builder']->props;
        $posts_query = $this->container['divi_post_type_query_builder']->query;
        $open_link_in = $this->container['divi']->get_prop_value( $this, 'open_link_in' );
        if ( $open_link_in == '_same' ) {
            $open_link_in = '';
        }
        $this->container['divi']->process_advanced_margin_padding_css(
            $this,
            'meta',
            $render_slug,
            $this->margin_padding
        );
        //  margin padding style
        $this->container['divi']->process_advanced_margin_padding_css(
            $this,
            'pagination_wrapper',
            $render_slug,
            $this->margin_padding
        );
        \ET_Builder_Element::set_style( $render_slug, [
            'selector'    => $this->get_selector( 'pagination_wrapper' ),
            'declaration' => sprintf( 'padding-right:%spx;', $props['gutter'] ),
        ] );
        ob_start();
        require $this->container['plugin_dir'] . '/resources/views/masonry-post-type-gallery.php';
        return ob_get_clean();
    }
    
    /**
     * Get the default value for the field *
     */
    public function get_default( $key )
    {
        return $this->helper()->get_default( $key );
    }
    
    /**
     * Get the css selector *
     */
    public function get_selector( $key )
    {
        return $this->helper()->get_selector( $key );
    }

}