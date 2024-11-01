<?php

namespace WPT_Masonry_Divi_Modules\MasonryPostTypeGallery;

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
        $selectors += [
            'item_meta'                        => [
            'selector' => "%%order_class%% .masonry-grid .item-meta",
            'label'    => 'Item Meta',
        ],
            'item_meta_link'                   => [
            'selector' => "%%order_class%% .masonry-grid .item-meta a",
            'label'    => 'Item Meta Link',
        ],
            'button'                           => [
            'selector' => "%%order_class%% .masonry-grid .et_pb_button_wrapper .et_pb_button",
            'label'    => 'Button',
        ],
            'button_wrapper'                   => [
            'selector' => "%%order_class%% .masonry-grid .et_pb_button_wrapper",
            'label'    => 'Button Wrapper',
        ],
            'pagination_wrapper'               => [
            'selector' => "%%order_class%% .pagination",
            'label'    => 'Pagination Wrapper',
        ],
            'previous_pagination_link_wrapper' => [
            'selector' => "%%order_class%% .pagination .alignleft",
            'label'    => 'Previous Pagination Link Wrapper',
        ],
            'previous_pagination_link'         => [
            'selector' => "%%order_class%% .pagination .alignleft a",
            'label'    => 'Previous Pagination Link',
        ],
            'next_pagination_link_wrapper'     => [
            'selector' => "%%order_class%% .pagination .alignright",
            'label'    => 'Next Pagination Link Wrapper',
        ],
            'next_pagination_link'             => [
            'selector' => "%%order_class%% .pagination .alignright a",
            'label'    => 'Next Pagination Link',
        ],
            'no_post_error_heading'            => [
            'selector' => "%%order_class%% .no-post-error-heading",
            'label'    => '"No Posts" Error Heading',
        ],
            'no_post_error_body'               => [
            'selector' => "%%order_class%% .no-post-error-body",
            'label'    => '"No Posts" Error Body',
        ],
        ];
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
            'pagination_previous_label'        => 'Previous',
            'pagination_next_label'            => 'Next',
            'open_link_in'                     => '_blank',
            'no_posts_error_heading'           => 'No Posts Found',
            'no_posts_error_body'              => 'Kindly select the posts using the custom query filter',
            'show_image'                       => 'on',
            'show_title'                       => 'off',
            'show_description'                 => 'none',
            'show_meta'                        => 'on',
            'show_author'                      => 'on',
            'show_date'                        => 'on',
            'date_format'                      => 'M j, Y',
            'show_categories'                  => 'on',
            'show_comment_count'               => 'on',
            'show_pagination'                  => 'on',
            'show_read_more_button'            => 'on',
            'button_url_new_window'            => 'on',
            'button_text'                      => 'Read More',
            'title_level'                      => 'h4',
            'description_char_count'           => '255',
            'description_suffix'               => '',
            'title_custom_margin'              => '10px|10px|10px|10px|false|false',
            'title_custom_padding'             => '0|0|0|0|false|false',
            'description_custom_margin'        => '0|10px|10px|10px|false|false',
            'description_custom_padding'       => '0|0|0|0|false|false',
            'meta_custom_margin'               => '0|10px|10px|10px|false|false',
            'meta_custom_padding'              => '0|0|0|0|false|false',
            'pagination_wrapper_custom_margin' => '15px|0|0|0|false|false',
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
        $fields += $this->get_post_type_filter_fields();
        $fields += $this->get_content_fields();
        $fields += $this->get_meta_container_fields();
        $fields += $this->get_pagination_wrapper_fields();
        $fields += $this->container['masonry']->get_fields( $this->module );
        $fields['admin_label'] = [
            'label'       => __( 'Admin Label', 'et_builder' ),
            'type'        => 'text',
            'description' => 'This will change the label of the module in the builder for easy identification.',
        ];
        return $fields;
    }
    
    public function get_pagination_wrapper_fields()
    {
        $fields = [];
        //  margin field.
        $fields['pagination_wrapper_custom_margin'] = [
            'label'            => esc_html__( ' Margin', '' ),
            'type'             => 'custom_padding',
            'option_category'  => 'layout',
            'mobile_options'   => true,
            'hover'            => false,
            'default'          => $this->get_default( 'pagination_wrapper_custom_margin' ),
            'default_on_front' => $this->get_default( 'pagination_wrapper_custom_margin' ),
            'tab_slug'         => 'advanced',
            'toggle_slug'      => 'pagination_wrapper',
            'description'      => esc_html__( 'Set the margin for pagination wrapper ', '' ),
        ];
        return $fields;
    }
    
    public function get_meta_container_fields()
    {
        $fields = [
            'meta_custom_margin'  => [
            'label'            => esc_html__( 'Margin', '' ),
            'type'             => 'custom_padding',
            'option_category'  => 'layout',
            'mobile_options'   => true,
            'hover'            => false,
            'default'          => $this->get_default( 'meta_custom_margin' ),
            'default_on_front' => $this->get_default( 'meta_custom_margin' ),
            'tab_slug'         => 'advanced',
            'toggle_slug'      => 'item_meta_container',
            'description'      => esc_html__( '', '' ),
        ],
            'meta_custom_padding' => [
            'label'            => esc_html__( 'Padding', '' ),
            'type'             => 'custom_padding',
            'option_category'  => 'layout',
            'mobile_options'   => true,
            'hover'            => false,
            'default'          => $this->get_default( 'meta_custom_padding' ),
            'default_on_front' => $this->get_default( 'meta_custom_padding' ),
            'tab_slug'         => 'advanced',
            'toggle_slug'      => 'item_meta_container',
            'description'      => esc_html__( '', '' ),
        ],
        ];
        return $fields;
    }
    
    public function get_content_fields()
    {
        $fields = [];
        $fields['no_posts_error_heading'] = [
            'label'       => esc_html__( '"No Posts" Error Heading', 'et_builder' ),
            'type'        => 'text',
            'tab_slug'    => 'general',
            'toggle_slug' => 'content',
            'description' => esc_html__( 'Heading text to show when no posts are found.', 'et_builder' ),
            'show_if'     => [],
            'default'     => $this->get_default( 'no_posts_error_heading' ),
        ];
        $fields['no_posts_error_body'] = [
            'label'       => esc_html__( '"No Posts" Error body', 'et_builder' ),
            'type'        => 'text',
            'tab_slug'    => 'general',
            'toggle_slug' => 'content',
            'description' => esc_html__( 'Body text to show when no posts are found.', 'et_builder' ),
            'show_if'     => [],
            'default'     => $this->get_default( 'no_posts_error_body' ),
        ];
        $fields['open_link_in'] = [
            'label'       => esc_html__( 'Open URL In?', 'et_builder' ),
            'type'        => 'select',
            'options'     => [
            '_blank' => 'New Window',
            '_same'  => 'Same Window',
        ],
            'tab_slug'    => 'general',
            'toggle_slug' => 'content',
            'description' => esc_html__( '', 'et_builder' ),
            'show_if'     => [],
            'default'     => $this->get_default( 'open_link_in' ),
        ];
        $fields['show_image'] = [
            'label'       => esc_html__( 'Show Image', 'et_builder' ),
            'type'        => 'yes_no_button',
            'options'     => [
            'off' => esc_html__( 'Off', 'et_builder' ),
            'on'  => esc_html__( 'On', 'et_builder' ),
        ],
            'tab_slug'    => 'general',
            'toggle_slug' => 'content',
            'description' => esc_html__( 'Show image.', 'et_builder' ),
            'show_if'     => [],
            'default'     => $this->get_default( 'show_image' ),
        ];
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
            'excerpt'      => 'Excerpt',
            'post-content' => 'Post Content',
        ],
            'tab_slug'    => 'general',
            'toggle_slug' => 'content',
            'description' => esc_html__( 'Show image description', 'et_builder' ),
            'show_if'     => [],
            'default'     => $this->get_default( 'show_description' ),
        ];
        $fields['description_char_count'] = [
            'label'          => esc_html__( 'Description Character Count', 'et_builder' ),
            'type'           => 'range',
            'range_settings' => [
            'min'  => -1,
            'max'  => 2000,
            'step' => 1,
        ],
            'tab_slug'       => 'general',
            'toggle_slug'    => 'content',
            'description'    => esc_html__( 'Set the character count for the description', 'et_builder' ),
            'show_not_if'    => [
            'show_description' => 'none',
        ],
            'allowed_units'  => [ '' ],
            'default_unit'   => '',
            'validate_unit'  => false,
            'default'        => $this->get_default( 'description_char_count' ),
        ];
        $fields['description_suffix'] = [
            'label'       => esc_html__( 'Description Suffix', 'et_builder' ),
            'type'        => 'text',
            'tab_slug'    => 'general',
            'toggle_slug' => 'content',
            'description' => esc_html__( 'A suffix at the end of the description. For example, an ellipsis, ...', 'et_builder' ),
            'show_if'     => [
            'show_description' => [ 'excerpt', 'post-content' ],
        ],
            'show_if_not' => [
            'description_char_count' => '-1',
        ],
            'default'     => $this->get_default( 'description_suffix' ),
        ];
        $fields['show_meta'] = [
            'label'       => esc_html__( 'Show Meta Fields', 'et_builder' ),
            'type'        => 'yes_no_button',
            'options'     => [
            'off' => esc_html__( 'Off', 'et_builder' ),
            'on'  => esc_html__( 'On', 'et_builder' ),
        ],
            'tab_slug'    => 'general',
            'toggle_slug' => 'content',
            'description' => esc_html__( 'Show meta fields like author, date, categories and comment count', 'et_builder' ),
            'show_if'     => [],
            'default'     => $this->get_default( 'show_meta' ),
        ];
        $fields['show_author'] = [
            'label'       => esc_html__( 'Show Author', 'et_builder' ),
            'type'        => 'yes_no_button',
            'options'     => [
            'off' => esc_html__( 'Off', 'et_builder' ),
            'on'  => esc_html__( 'On', 'et_builder' ),
        ],
            'tab_slug'    => 'general',
            'toggle_slug' => 'content',
            'description' => esc_html__( '', 'et_builder' ),
            'show_if'     => [
            'show_meta' => 'on',
        ],
            'default'     => $this->get_default( 'show_author' ),
        ];
        $fields['show_date'] = [
            'label'       => esc_html__( 'Show Date', 'et_builder' ),
            'type'        => 'yes_no_button',
            'options'     => [
            'off' => esc_html__( 'Off', 'et_builder' ),
            'on'  => esc_html__( 'On', 'et_builder' ),
        ],
            'tab_slug'    => 'general',
            'toggle_slug' => 'content',
            'description' => esc_html__( '', 'et_builder' ),
            'show_if'     => [
            'show_meta' => 'on',
        ],
            'default'     => $this->get_default( 'show_date' ),
        ];
        $fields['date_format'] = [
            'label'       => esc_html__( 'Date Format', 'et_builder' ),
            'type'        => 'text',
            'tab_slug'    => 'general',
            'toggle_slug' => 'content',
            'description' => esc_html__( '', 'et_builder' ),
            'show_if'     => [
            'show_meta' => 'on',
            'show_date' => 'on',
        ],
            'default'     => $this->get_default( 'date_format' ),
        ];
        $fields['show_categories'] = [
            'label'       => esc_html__( 'Show Categories', 'et_builder' ),
            'type'        => 'yes_no_button',
            'options'     => [
            'off' => esc_html__( 'Off', 'et_builder' ),
            'on'  => esc_html__( 'On', 'et_builder' ),
        ],
            'tab_slug'    => 'general',
            'toggle_slug' => 'content',
            'description' => esc_html__( '', 'et_builder' ),
            'show_if'     => [
            'show_meta' => 'on',
        ],
            'default'     => $this->get_default( 'show_categories' ),
        ];
        $fields['show_comment_count'] = [
            'label'       => esc_html__( 'Show Comment Count', 'et_builder' ),
            'type'        => 'yes_no_button',
            'options'     => [
            'off' => esc_html__( 'Off', 'et_builder' ),
            'on'  => esc_html__( 'On', 'et_builder' ),
        ],
            'tab_slug'    => 'general',
            'toggle_slug' => 'content',
            'description' => esc_html__( '', 'et_builder' ),
            'show_if'     => [
            'show_meta' => 'on',
        ],
            'default'     => $this->get_default( 'show_comment_count' ),
        ];
        $fields['show_read_more_button'] = [
            'label'       => esc_html__( 'Show "Read More" Button', 'et_builder' ),
            'type'        => 'yes_no_button',
            'options'     => [
            'off' => esc_html__( 'Off', 'et_builder' ),
            'on'  => esc_html__( 'On', 'et_builder' ),
        ],
            'tab_slug'    => 'general',
            'toggle_slug' => 'content',
            'description' => esc_html__( '', 'et_builder' ),
            'show_if'     => [],
            'default'     => $this->get_default( 'show_read_more_button' ),
        ];
        $fields['button_url_new_window'] = [
            'label'       => esc_html__( 'Open URL In New Window', 'et_builder' ),
            'type'        => 'yes_no_button',
            'options'     => [
            'off' => esc_html__( 'Off', 'et_builder' ),
            'on'  => esc_html__( 'On', 'et_builder' ),
        ],
            'tab_slug'    => 'general',
            'toggle_slug' => 'content',
            'description' => esc_html__( '', 'et_builder' ),
            'show_if'     => [
            'show_read_more_button' => 'on',
        ],
            'default'     => $this->get_default( 'button_url_new_window' ),
        ];
        $fields['button_text'] = [
            'label'       => esc_html__( 'Button Text', 'et_builder' ),
            'type'        => 'text',
            'tab_slug'    => 'general',
            'toggle_slug' => 'content',
            'description' => esc_html__( '', 'et_builder' ),
            'show_if'     => [
            'show_read_more_button' => 'on',
        ],
            'default'     => $this->get_default( 'button_text' ),
        ];
        return $fields;
    }
    
    public function get_post_type_filter_fields()
    {
        $fields = [];
        $fields += $this->container['divi_post_type_query_builder']->get_fields(
            'post_type_builder',
            'Post Type',
            'general',
            'main_content',
            'Select a "Post Type" from the list.'
        );
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