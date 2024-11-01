<?php

namespace WPT_Masonry_Divi_Modules\MasonryImageGallery;

use  ET_Builder_Module ;
class MasonryImageGallery extends ET_Builder_Module
{
    public  $slug = 'et_pb_wpt_masonry_image_gallery' ;
    public  $vb_support = 'on' ;
    protected  $container ;
    protected  $helper ;
    public  $icon_path ;
    protected  $module_credits = array(
        'module_uri' => 'https://wptools.app/wordpress-plugin/masonry-gallery-and-posts-for-divi/?utm_source=customer-website&utm_medium=image-gallery-module&utm_campaign=divi-masonry&utm_content=module-credits',
        'author'     => 'WP Tools',
        'author_uri' => 'https://wptools.app/wordpress-plugin/masonry-gallery-and-posts-for-divi/?utm_source=customer-website&utm_medium=image-gallery-module&utm_campaign=divi-masonry&utm_content=module-credits',
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
        $this->name = esc_html__( 'Masonry Image Gallery', '' );
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
            'main_content' => esc_html__( 'Image Selection', 'et_builder' ),
            'content'      => esc_html__( 'Content', 'et_builder' ),
            'masonry'      => esc_html__( 'Masonry Settings', 'et_builder' ),
        ],
        ],
            'advanced' => [
            'toggles' => [
            'grid_item'               => esc_html__( 'Grid Item', 'et_builder' ),
            'grid_item_hover'         => esc_html__( 'Grid Item : Hover Overlay', 'et_builder' ),
            'title'                   => esc_html__( 'Title', 'et_builder' ),
            'description'             => esc_html__( 'Description', 'et_builder' ),
            'overlay'                 => esc_html__( 'Overlay', 'et_builder' ),
            'overlay_arrows'          => esc_html__( 'Overlay Arrows', 'et_builder' ),
            'overlay_close_button'    => esc_html__( 'Overlay Close Button', 'et_builder' ),
            'overlay_gallery_counter' => esc_html__( 'Overlay Gallery Counter', 'et_builder' ),
            'overlay_title'           => esc_html__( 'Overlay Item Title', 'et_builder' ),
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
        $config += $this->container['masonry']->get_advanced_fields_config( $this );
        $config['borders']['overlay_arrows'] = [
            'css'         => [
            'main' => [
            'border_radii'  => $this->get_selector( 'overlay_arrows' ),
            'border_styles' => $this->get_selector( 'overlay_arrows' ),
        ],
        ],
            'defaults'    => [
            'border_radii'  => 'on||||',
            'border_styles' => [
            'width' => '0',
            'color' => '#eeeeee',
            'style' => 'solid',
        ],
        ],
            'tab_slug'    => 'advanced',
            'toggle_slug' => 'overlay_arrows',
        ];
        $config['fonts']['overlay_gallery_counter'] = [
            'label'           => esc_html__( 'Overlay Item Counter', '' ),
            'font_size'       => [
            'default_on_front' => '',
            'range_settings'   => [
            'min'  => '1',
            'max'  => '100',
            'step' => '1',
        ],
            'validate_unit'    => true,
        ],
            'line_height'     => [
            'default_on_front' => '',
            'range_settings'   => [
            'min'  => '0.1',
            'max'  => '10',
            'step' => '0.1',
        ],
        ],
            'letter_spacing'  => [
            'default_on_front' => '',
            'range_settings'   => [
            'min'  => '0',
            'max'  => '10',
            'step' => '1',
        ],
            'validate_unit'    => true,
        ],
            'text_align'      => [
            'default_on_front' => '',
            'default'          => '',
        ],
            'hide_text_align' => true,
            'css'             => [
            'main'      => $this->get_selector( 'overlay_gallery_counter' ),
            'important' => 'all',
        ],
            'tab_slug'        => 'advanced',
            'toggle_slug'     => 'overlay_gallery_counter',
        ];
        $config['fonts']['overlay_title'] = [
            'label'          => esc_html__( 'Overlay Item Title', '' ),
            'font'           => [
            'default' => '|||on|||||',
        ],
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
            'default_on_front' => '',
            'range_settings'   => [
            'min'  => '0',
            'max'  => '10',
            'step' => '1',
        ],
            'validate_unit'    => true,
        ],
            'text_align'     => [
            'default_on_front' => 'left',
            'default'          => 'left',
        ],
            'css'            => [
            'main'      => $this->get_selector( 'overlay_title' ),
            'important' => 'all',
        ],
            'tab_slug'       => 'advanced',
            'toggle_slug'    => 'overlay_title',
        ];
        $config['text'] = false;
        $config['max_width'] = false;
        $config['link_options'] = false;
        $config['filters'] = false;
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
        $this->add_classname( [ 'wpt-masonry', 'wpt-masonry-with-gallery' ] );
        $this->container['divi']->enqueue_assets();
        $this->container['masonry']->set_styles( $this, $render_slug );
        $masonry_js_options = $this->container['masonry']->get_js_options( $this );
        
        if ( $props['image_selection_type'] == 'choose_images' ) {
            $images = $this->container['image_gallery']->get_by_ids( $props['image_ids'] );
        } else {
        }
        
        \ET_Builder_Element::set_style( $render_slug, [
            'selector'    => $this->get_selector( 'overlay_bg' ),
            'declaration' => sprintf( 'background:%s; opacity:%s;', $props['overlay_bg'], $props['overlay_opacity'] ),
        ] );
        \ET_Builder_Element::set_style( $render_slug, [
            'selector'    => $this->get_selector( 'overlay_arrows_after' ),
            'declaration' => sprintf(
            'color:%s;%s;height:%s !important; width:%s !important; font-size:%s;',
            $props['overlay_arrows_color'],
            ( $props['overlay_arrows_bg'] ? 'background: ' . $props['overlay_arrows_bg'] : '' ),
            $props['overlay_arrows_size'],
            $props['overlay_arrows_size'],
            $props['overlay_arrows_size']
        ),
        ] );
        \ET_Builder_Element::set_style( $render_slug, [
            'selector'    => $this->get_selector( 'overlay_arrows' ),
            'declaration' => sprintf(
            'height:%s !important; width:%s !important; top: 50%%;margin-top: -%spx !important;',
            $props['overlay_arrows_size'],
            $props['overlay_arrows_size'],
            $props['overlay_arrows_size']
        ),
        ] );
        \ET_Builder_Element::set_style( $render_slug, [
            'selector'    => $this->get_selector( 'overlay_close_button' ),
            'declaration' => sprintf( 'color:%s ;', $props['overlay_close_button_color'] ),
        ] );
        ob_start();
        require $this->container['plugin_dir'] . '/resources/views/masonry-image-gallery.php';
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