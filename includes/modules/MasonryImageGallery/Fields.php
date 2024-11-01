<?php

namespace WPT_Masonry_Divi_Modules\MasonryImageGallery;

/**
 * .
 */
class Fields
{
    protected  $container ;
    protected  $module ;
    /**
     * Constructor.
     */
    public function __construct( $container )
    {
        $this->container = $container;
    }
    
    /**
     * Set the module instance.
     */
    public function set_module( $module )
    {
        $this->module = $module;
    }
    
    /**
     * Get selector
     */
    public function get_selector( $key )
    {
        $selectors = $this->get_selectors();
        return $selectors[$key]['selector'];
    }
    
    /**
     * List of selectors
     */
    public function get_selectors()
    {
        $selectors = $this->container['masonry']->get_selectors( $this->module );
        return $selectors;
    }
    
    /**
     * Get default for given keys
     */
    public function get_default( $key )
    {
        $defaults = $this->get_defaults();
        return ( isset( $defaults[$key] ) ? $defaults[$key] : '' );
    }
    
    /**
     * Get defaults
     */
    public function get_defaults()
    {
        $defaults = [
            'image_selection_type'       => 'choose_images',
            'image_ids'                  => '',
            'show_title'                 => 'off',
            'show_description'           => 'none',
            'title_level'                => 'h4',
            'filter_by_categories'       => 'off',
            'categories'                 => '',
            'post__in'                   => '',
            'post__not_in'               => '',
            'images_per_page'            => 12,
            'orderby'                    => 'date',
            'order'                      => 'ASC',
            'overlay_bg'                 => '#0b0b0b',
            'overlay_opacity'            => '0.8',
            'overlay_arrows_color'       => '#ffffff',
            'overlay_arrows_bg'          => '',
            'overlay_arrows_size'        => '64px',
            'overlay_close_button_color' => '#ffffff',
            'title_custom_margin'        => '0|0|0|0|false|false',
            'title_custom_padding'       => '0|0|0|0|false|false',
            'description_custom_margin'  => '0|0|0|0|false|false',
            'description_custom_padding' => '0|0|0|0|false|false',
        ];
        $defaults += $this->container['masonry']->get_defaults();
        return $defaults;
    }
    
    /**
     * Get module fields
     */
    public function get_fields()
    {
        $fields = [];
        $fields += $this->get_attachment_filter_fields();
        $fields += $this->get_content_fields();
        $fields += $this->get_overlay_fields();
        $fields += $this->get_overlay_arrows_fields();
        $fields += $this->get_overlay_close_button_fields();
        $fields += $this->container['masonry']->get_fields( $this->module );
        $fields['admin_label'] = [
            'label'       => __( 'Admin Label', 'et_builder' ),
            'type'        => 'text',
            'description' => 'This will change the label of the module in the builder for easy identification.',
        ];
        return $fields;
    }
    
    public function get_overlay_close_button_fields()
    {
        $fields = [];
        $fields['overlay_close_button_color'] = [
            'label'       => esc_html__( 'Color', 'et_builder' ),
            'type'        => 'color-alpha',
            'tab_slug'    => 'advanced',
            'toggle_slug' => 'overlay_close_button',
            'description' => esc_html__( 'Set the color for the close button', 'et_builder' ),
            'show_if'     => [],
            'default'     => $this->get_default( 'overlay_close_button_color' ),
        ];
        return $fields;
    }
    
    public function get_overlay_arrows_fields()
    {
        $fields = [];
        $fields['overlay_arrows_color'] = [
            'label'       => esc_html__( 'Color', 'et_builder' ),
            'type'        => 'color-alpha',
            'tab_slug'    => 'advanced',
            'toggle_slug' => 'overlay_arrows',
            'description' => esc_html__( 'Set the color for the arrows', 'et_builder' ),
            'show_if'     => [],
            'default'     => $this->get_default( 'overlay_arrows_color' ),
        ];
        $fields['overlay_arrows_bg'] = [
            'label'       => esc_html__( 'Background Color', 'et_builder' ),
            'type'        => 'color-alpha',
            'tab_slug'    => 'advanced',
            'toggle_slug' => 'overlay_arrows',
            'description' => esc_html__( 'Set the background color for the arrows', 'et_builder' ),
            'show_if'     => [],
            'default'     => $this->get_default( 'overlay_arrows_bg' ),
        ];
        $fields['overlay_arrows_size'] = [
            'label'          => esc_html__( 'Arrow Size', 'et_builder' ),
            'type'           => 'range',
            'range_settings' => [
            'min'  => 1,
            'max'  => 400,
            'step' => 1,
        ],
            'tab_slug'       => 'advanced',
            'toggle_slug'    => 'overlay_arrows',
            'description'    => esc_html__( '', 'et_builder' ),
            'show_if'        => [],
            'allowed_units'  => [ 'px' ],
            'default_unit'   => 'px',
            'default'        => $this->get_default( 'overlay_arrows_size' ),
        ];
        return $fields;
    }
    
    public function get_overlay_fields()
    {
        $fields = [];
        $fields['overlay_bg'] = [
            'label'       => esc_html__( 'Background Color', 'et_builder' ),
            'type'        => 'color-alpha',
            'tab_slug'    => 'advanced',
            'toggle_slug' => 'overlay',
            'description' => esc_html__( 'Select background color for the overlay.', 'et_builder' ),
            'show_if'     => [],
            'default'     => $this->get_default( 'overlay_bg' ),
        ];
        $fields['overlay_opacity'] = [
            'label'          => esc_html__( 'Background Opacity', 'et_builder' ),
            'type'           => 'range',
            'range_settings' => [
            'min'  => 0,
            'max'  => 1,
            'step' => 0.01,
        ],
            'tab_slug'       => 'advanced',
            'toggle_slug'    => 'overlay',
            'description'    => esc_html__( 'Set the opacity for the overlay', 'et_builder' ),
            'show_if'        => [],
            'allowed_units'  => [ '' ],
            'default_unit'   => '',
            'validate_unit'  => false,
            'default'        => $this->get_default( 'overlay_opacity' ),
        ];
        return $fields;
    }
    
    public function get_content_fields()
    {
        $fields = [];
        $fields['show_title'] = [
            'label'       => esc_html__( 'Show Title', 'et_builder' ),
            'type'        => 'yes_no_button',
            'options'     => [
            'off' => esc_html__( 'Off', 'et_builder' ),
            'on'  => esc_html__( 'On', 'et_builder' ),
        ],
            'tab_slug'    => 'general',
            'toggle_slug' => 'content',
            'description' => esc_html__( 'Show image title.', 'et_builder' ),
            'show_if'     => [],
            'default'     => $this->get_default( 'show_title' ),
        ];
        $fields['show_description'] = [
            'label'       => esc_html__( 'Show Description', 'et_builder' ),
            'type'        => 'select',
            'options'     => [
            'none'         => 'None',
            'caption'      => 'Image Caption',
            'post-content' => 'Image Description',
        ],
            'tab_slug'    => 'general',
            'toggle_slug' => 'content',
            'description' => esc_html__( 'Show image description', 'et_builder' ),
            'show_if'     => [],
            'default'     => $this->get_default( 'show_description' ),
        ];
        return $fields;
    }
    
    /**
     * Category filter fields for attachments.
     */
    public function get_attachment_filter_fields()
    {
        $fields = [];
        $fields['image_selection_type'] = [
            'label'       => esc_html__( 'Image Selection Type', 'et_builder' ),
            'type'        => 'hidden',
            'tab_slug'    => 'general',
            'toggle_slug' => 'main_content',
            'description' => esc_html__( '', 'et_builder' ),
            'show_if'     => [],
            'default'     => $this->get_default( 'image_selection_type' ),
        ];
        $fields['image_ids'] = [
            'label'       => esc_html__( 'Images', 'et_builder' ),
            'type'        => 'upload-gallery',
            'tab_slug'    => 'general',
            'toggle_slug' => 'main_content',
            'description' => esc_html__( 'Select the images for the image gallery', 'et_builder' ),
            'show_if'     => [
            'image_selection_type' => 'choose_images',
        ],
            'default'     => $this->get_default( 'image_ids' ),
        ];
        $fields['image_gallery_fs'] = [
            'label'       => esc_html__( '', 'et_builder' ),
            'type'        => 'wpdt_masonry_image_gallery_fs',
            'tab_slug'    => 'general',
            'toggle_slug' => 'main_content',
            'description' => esc_html__( '', 'et_builder' ),
            'show_if'     => [
            'image_selection_type' => 'choose_images',
        ],
            'default'     => true,
        ];
        return $fields;
    }
    
    public function get_css_fields()
    {
        $selectors = $this->get_selectors();
        foreach ( $selectors as $key => $selector ) {
            $selectors[$key]['selector'] = "html body div#page-container " . $selector['selector'];
        }
        return $selectors;
    }
    
    public function set_advanced_toggles( &$toggles )
    {
        $selectors = $this->get_selectors();
        foreach ( $selectors as $slug => $selector ) {
            $toggles['advanced']['toggles'][$slug] = $selector['label'];
        }
    }
    
    /**
     * Advanced font definition
     */
    public function get_advanced_font_definition( $key )
    {
        return [
            'css' => [
            'main'      => $this->get_selector( $key ),
            'important' => 'all',
        ],
        ];
    }
    
    public function set_advanced_font_definition( &$config, $key )
    {
        $config['fonts'][$key] = $this->get_advanced_font_definition( $key );
    }

}