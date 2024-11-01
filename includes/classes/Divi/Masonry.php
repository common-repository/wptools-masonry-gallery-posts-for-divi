<?php
namespace WPT\Masonry\Divi;

/**
 * Masonry.
 */
class Masonry
{
    protected $container;

    /**
     * Constructor.
     */
    public function __construct($container)
    {
        $this->container = $container;
    }

    /**
     * List of selectors
     */
    public function get_selectors($module)
    {
        return [
            'grid'                         => [
                'selector' => "%%order_class%% .masonry-grid",
                'label'    => 'Grid Container',
            ],
            'grid-item'                    => [
                'selector' => "%%order_class%% .masonry-grid-item",
                'label'    => 'Grid Item',
            ],
            'grid-item-hover'              => [
                'selector' => "%%order_class%% .masonry-grid-item:hover",
                'label'    => 'Grid Item : Hover',
            ],
            'grid_item_overlay_hover'      => [
                'selector' => "%%order_class%% .masonry-grid-item:hover .masonry-item-overlay",
                'label'    => 'Grid Item : Hover Overlay',
            ],
            'grid_item_overlay_icon_hover' => [
                'selector' => "%%order_class%% .masonry-grid-item:hover .masonry-item-overlay .et-pb-icon",
                'label'    => 'Grid Item Overlay Icon : Hover',
            ],
            'grid-sizer'                   => [
                'selector' => "%%order_class%% .masonry-grid-sizer",
                'label'    => 'Grid Sizer',
            ],
            'title'                        => [
                'selector' => "%%order_class%% .masonry-grid-item .item-title",
                'label'    => 'Item Title',
            ],
            'description'                  => [
                'selector' => "%%order_class%% .masonry-grid-item .item-description",
                'label'    => 'Item Description',
            ],
            'overlay_bg'                   => [
                'selector' => "%%order_class%%.mfp-bg",
                'label'    => 'Overlay Background',
            ],
            'overlay_arrows'               => [
                'selector' => "%%order_class%%.mfp-wrap .mfp-arrow",
                'label'    => 'Overlay Arrows',
            ],
            'overlay_arrows_after'         => [
                'selector' => "%%order_class%%.mfp-wrap .mfp-arrow::after",
                'label'    => 'Overlay Arrows :: After',
            ],
            'overlay_close_button'         => [
                'selector' => "%%order_class%%.mfp-wrap .mfp-close",
                'label'    => 'Overlay Close Button',
            ],
            'overlay_gallery_counter'      => [
                'selector' => "%%order_class%%.mfp-wrap .mfp-bottom-bar .mfp-counter",
                'label'    => 'Overlay Gallery Counter',
            ],
            'overlay_title'                => [
                'selector' => "%%order_class%%.mfp-wrap .mfp-bottom-bar .mfp-title",
                'label'    => 'Overlay Item Title',
            ],
        ];
    }

    public function get_title_fields($module)
    {
        $fields = [
            //  margin field.
            'title_custom_margin'  => [
                'label'            => esc_html__('Margin', ''),
                'type'             => 'custom_padding',
                'option_category'  => 'layout',
                'mobile_options'   => true,
                'hover'            => false,
                'default'          => $module->get_default('title_custom_margin'),
                'default_on_front' => $module->get_default('title_custom_margin'),
                'tab_slug'         => 'advanced',
                'toggle_slug'      => 'title',
                'description'      => esc_html__('Set the margin for ', ''),
            ],
            //  padding field
            'title_custom_padding' => [
                'label'            => esc_html__('Padding', ''),
                'type'             => 'custom_padding',
                'option_category'  => 'layout',
                'mobile_options'   => true,
                'hover'            => false,
                'default'          => $module->get_default('title_custom_padding'),
                'default_on_front' => $module->get_default('title_custom_padding'),
                'tab_slug'         => 'advanced',
                'toggle_slug'      => 'title',
                'description'      => esc_html__('Set the padding for Grid Item', ''),
            ],
        ];

        return $fields;
    }

    public function get_description_fields($module)
    {
        $fields = [

            'description_custom_margin'  => [
                'label'            => esc_html__('Description Margin', ''),
                'type'             => 'custom_padding',
                'option_category'  => 'layout',
                'mobile_options'   => true,
                'hover'            => false,
                'default'          => $module->get_default('description_custom_margin'),
                'default_on_front' => $module->get_default('description_custom_margin'),
                'tab_slug'         => 'advanced',
                'toggle_slug'      => 'description',
                'description'      => esc_html__('Set the margin for Description', ''),
            ],

            'description_custom_padding' => [
                'label'            => esc_html__('Description Padding', ''),
                'type'             => 'custom_padding',
                'option_category'  => 'layout',
                'mobile_options'   => true,
                'hover'            => false,
                'default'          => $module->get_default('description_custom_padding'),
                'default_on_front' => $module->get_default('description_custom_padding'),
                'tab_slug'         => 'advanced',
                'toggle_slug'      => 'description',
                'description'      => esc_html__('Set the padding for Description', ''),
            ],
        ];

        return $fields;
    }

    public function get_fields($module)
    {
        $fields = [];

        $fields += $this->get_settings_fields($module);
        $fields += $this->get_grid_item_hover_fields($module);
        $fields += $this->get_title_fields($module);
        $fields += $this->get_description_fields($module);

        // item background

        $this->container['divi_background']->get_fields(
            'grid_item_bg',
            'Background',
            '',
            $fields,
            $module,
            'Customize the background style of the grid item by adjusting the background color, gradient, and image.',
            'advanced',
            'grid_item'
        );

        return $fields;
    }

    public function get_grid_item_hover_fields($module)
    {
        $fields = [];

        $fields['show_grid_item_overlay_on_hover'] = [
            'label'       => esc_html__('Show Grid Item Overlay On Hover', 'et_builder'),
            'type'        => 'yes_no_button',
            'options'     => [
                'off' => esc_html__('Off', 'et_builder'),
                'on'  => esc_html__('On', 'et_builder'),
            ],
            'tab_slug'    => 'advanced',
            'toggle_slug' => 'grid_item_hover',
            'description' => esc_html__('Show an overlay when grid item is hovered.', 'et_builder'),
            'show_if'     => [],
            'default'     => $this->get_default('show_grid_item_overlay_on_hover'),
        ];

        $this->container['divi_background']->get_fields(
            'grid_item_hover_bg',
            'Background',
            '',
            $fields,
            $module,
            'Customize the background style of the grid item overlay by adjusting the background color, gradient, and image.',
            'advanced',
            'grid_item_hover',
            ['show_grid_item_overlay_on_hover' => 'on']
        );

        $fields['grid_item_hover_icon'] = [
            'label'               => esc_html__('Icon', 'et_builder'),
            'type'                => 'select_icon',
            'option_category'     => 'configuration',
            'class'               => ['et-pb-font-icon'],
            'renderer_with_field' => true,
            'tab_slug'            => 'advanced',
            'toggle_slug'         => 'grid_item_hover',
            'show_if'             => ['show_grid_item_overlay_on_hover' => 'on'],
            'default'             => $this->get_default('grid_item_hover_icon'),
        ];

        $fields['grid_item_hover_icon_size'] = [
            'label'          => esc_html__('Icon Size', 'et_builder'),
            'type'           => 'range',
            'range_settings' => [
                'min'  => 1,
                'max'  => 400,
                'step' => 1,
            ],
            'tab_slug'       => 'advanced',
            'toggle_slug'    => 'grid_item_hover',
            'description'    => esc_html__('Size of the icon', 'et_builder'),
            'show_if'        => ['show_grid_item_overlay_on_hover' => 'on'],
            'allowed_units'  => ['px'],
            'default_unit'   => 'px',
            'default'        => $this->get_default('grid_item_hover_icon_size'),
        ];

        $fields['grid_item_hover_icon_color'] = [
            'label'       => esc_html__('Icon Color', 'et_builder'),
            'type'        => 'color-alpha',
            'tab_slug'    => 'advanced',
            'toggle_slug' => 'grid_item_hover',
            'description' => esc_html__('Choose icon color', 'et_builder'),
            'show_if'     => ['show_grid_item_overlay_on_hover' => 'on'],
            'default'     => $this->get_default('grid_item_hover_icon_color'),
        ];

        return $fields;
    }

    /**
     * masonry settings fields
     */
    public function get_settings_fields($module)
    {
        $fields = [];

        $fields['hide_until_loaded'] = [
            'label'       => esc_html__('Hide Grid Until Page Load', 'et_builder'),
            'type'        => 'yes_no_button',
            'options'     => [
                'off' => esc_html__('Off', 'et_builder'),
                'on'  => esc_html__('On', 'et_builder'),
            ],
            'tab_slug'    => 'general',
            'toggle_slug' => 'masonry',
            'description' => esc_html__('Hide the masonry grid until the page loads. If you experience janking of images on page load, enable this setting.', 'et_builder'),
            'show_if'     => [],
            'default'     => $this->get_default('hide_until_loaded'),
        ];

        $fields['columns'] = [
            'label'          => esc_html__('Columns', 'et_builder'),
            'type'           => 'range',
            'range_settings' => [
                'min'  => 1,
                'max'  => 10,
                'step' => 1,
            ],
            'tab_slug'       => 'general',
            'toggle_slug'    => 'masonry',
            'description'    => esc_html__('Set the number of columns for the masonry grid layout', 'et_builder'),
            'show_if'        => [],
            'allowed_units'  => [''],
            'default_unit'   => '',
            'validate_unit'  => false,
            'mobile_options' => true,
            'default'        => $this->get_default('columns'),
        ];

        $fields['gutter'] = [
            'label'          => esc_html__('Space Between Items', 'et_builder'),
            'type'           => 'range',
            'range_settings' => [
                'min'  => 0,
                'max'  => 100,
                'step' => 1,
            ],
            'tab_slug'       => 'general',
            'toggle_slug'    => 'masonry',
            'description'    => esc_html__('Set the space between each masonry items.', 'et_builder'),
            'show_if'        => [],
            'allowed_units'  => [''],
            'default_unit'   => '',
            'validate_unit'  => false,
            'default'        => $this->get_default('gutter'),
        ];

        return $fields;
    }

    /**
     * Get default for given keys
     */
    public function get_default($key)
    {
        $defaults = $this->get_defaults();

        return isset($defaults[$key]) ? $defaults[$key] : '';
    }

    /**
     * Get defaults
     */
    public function get_defaults()
    {
        $defaults = [
            'hide_until_loaded'               => 'off',
            'columns'                         => '3',
            'gutter'                          => '10',
            'show_grid_item_overlay_on_hover' => 'off',
            'grid_item_hover_icon'            => '',
            'grid_item_hover_icon_size'       => '96px',
            'grid_item_hover_icon_color'      => '#ffffff',
        ];

        return $defaults;
    }

    public function set_styles(
        $module,
        $render_slug
    ) {
        $columns_responsive = $this->container['divi']->get_responsive_values('columns', $module->props, $module->get_default('columns'));

        $gutter     = $this->container['divi']->get_prop_value($module, 'gutter');
        $icon_size  = $this->container['divi']->get_prop_value($module, 'grid_item_hover_icon_size');
        $icon_color = $this->container['divi']->get_prop_value($module, 'grid_item_hover_icon_color');

        \ET_Builder_Element::set_style($render_slug, [
            'selector'    => $module->get_selector('grid-item'),
            'declaration' => sprintf('margin-bottom: %spx;', $gutter),
        ]);

        \ET_Builder_Element::set_style($render_slug, [
            'selector'    => $module->get_selector('grid-item') . ',' . $module->get_selector('grid-sizer'),
            'declaration' => sprintf('width: calc(calc(100%%/%s) - %spx);', $columns_responsive['desktop'], $gutter),
        ]);

        \ET_Builder_Element::set_style($render_slug, [
            'selector'    => $module->get_selector('grid-item') . ',' . $module->get_selector('grid-sizer'),
            'declaration' => sprintf('width: calc(calc(100%%/%s) - %spx);', $columns_responsive['tablet'], $gutter),
            'media_query' => '@media all and (max-width: 980px)',
        ]);

        \ET_Builder_Element::set_style($render_slug, [
            'selector'    => $module->get_selector('grid-item') . ',' . $module->get_selector('grid-sizer'),
            'declaration' => sprintf('width: calc(calc(100%%/%s) - %spx);', $columns_responsive['phone'], $gutter),
            'media_query' => '@media only screen and ( max-width: 640px )',
        ]);

        \ET_Builder_Element::set_style($render_slug, [
            'selector'    => $module->get_selector('grid_item_overlay_hover'),
            'declaration' => sprintf('color:%s;', $icon_color),
        ]);

        \ET_Builder_Element::set_style($render_slug, [
            'selector'    => $module->get_selector('grid_item_overlay_icon_hover'),
            'declaration' => sprintf('font-size:%s;', $icon_size),
        ]);

        $this->container['divi_background']->process_background([
            'base_prop_name'    => 'grid_item_hover_bg',
            'props'             => $module->props,
            'function_name'     => $render_slug,
            'selector'          => $module->get_selector('grid_item_overlay_hover'),
            // 'selector_hover'    => $module->get_selector('grid_item_hover'),
            'important'         => ' !important',
            'prop_name_aliases' => [
                "use_grid_item_hover_bg_color_gradient" => "grid_item_hover_bg_use_color_gradient",
                "grid_item_hover_bg"                    => "grid_item_hover_bg_color",
            ],
        ]);

        $this->container['divi_background']->process_background([
            'base_prop_name'    => 'grid_item_bg',
            'props'             => $module->props,
            'function_name'     => $render_slug,
            'selector'          => $module->get_selector('grid-item'),
            'selector_hover'    => $module->get_selector('grid-item-hover'),
            'important'         => ' !important',
            'prop_name_aliases' => [
                "use_grid_item_bg_color_gradient" => "grid_item_bg_use_color_gradient",
                "grid_item_bg"                    => "grid_item_bg_color",
            ],
        ]);

        // Grid Item margin padding style
        $this->container['divi']->process_advanced_margin_padding_css(
            $module,
            'title',
            $render_slug,
            $module->margin_padding
        );

        // Description margin padding style
        $this->container['divi']->process_advanced_margin_padding_css(
            $module,
            'description',
            $render_slug,
            $module->margin_padding
        );
    }

    public function get_js_options($module)
    {
        $gutter = $this->container['divi']->get_prop_value($module, 'gutter');

        return [
            'gutter' => intval($gutter),
        ];
    }

    public function get_advanced_fields_config($module)
    {
        $config = [];
        // fonts
        $config['fonts']['title'] = [
            'depends_on'      => ['show_title'],
            'depends_show_if' => 'on',
            'label'           => esc_html__('Title', ''),
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
                'default_on_front' => '1.5em',
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
            'header_level'    => [
                'default' => 'h4',
            ],
            'text_align'      => [
                'default_on_front' => 'center',
                'default'          => 'center',
            ],
            'css'             => [
                'main'      => $module->get_selector('title'),
                'important' => 'all',
            ],
            'tab_slug'        => 'advanced',
            'toggle_slug'     => 'title',
        ];

        $config['fonts']['description'] = [
            'depends_on'          => ['show_description'],
            'depends_show_if_not' => 'none',
            'label'               => esc_html__('Description', ''),
            'font_size'           => [
                'default_on_front' => '14px',
                'range_settings'   => [
                    'min'  => '1',
                    'max'  => '100',
                    'step' => '1',
                ],
                'validate_unit'    => true,
            ],
            'line_height'         => [
                'default_on_front' => '',
                'range_settings'   => [
                    'min'  => '0.1',
                    'max'  => '10',
                    'step' => '0.1',
                ],
            ],
            'letter_spacing'      => [
                'default_on_front' => '0px',
                'range_settings'   => [
                    'min'  => '0',
                    'max'  => '10',
                    'step' => '1',
                ],
                'validate_unit'    => true,
            ],
            'text_align'          => [
                'default_on_front' => 'justified',
                'default'          => 'justified',
            ],
            'css'                 => [
                'main'      => $module->get_selector('description'),
                'important' => 'all',
            ],
            'tab_slug'            => 'advanced',
            'toggle_slug'         => 'description',
        ];

        $config['borders']['default'] = [
            'css' => [
                'main'      => '%%order_class%%',
                'important' => 'all',
            ],
        ];

        $config['borders']['grid_item'] = [
            'css'         => [
                'main' => [
                    'border_radii'  => $module->get_selector('grid-item'),
                    'border_styles' => $module->get_selector('grid-item'),
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
            'toggle_slug' => 'grid_item',
        ];

        $config['box_shadow']['default'] = [
            'css' => [
                'main'      => '%%order_class%%',
                'important' => 'all',
            ],
        ];

        $config['box_shadow']['grid_item'] = [
            'css'         => [
                'main'      => $module->get_selector('grid-item'),
                'important' => 'all',
            ],
            'tab_slug'    => 'advanced',
            'toggle_slug' => 'grid_item',
        ];

        // Grid Item spacing advanced settings.
        $config['title_margin_padding'] = [
            'title' => [
                'margin_padding' => [
                    'css'         => [
                        'use_margin'  => true,
                        'use_padding' => true,
                        'main'        => $module->get_selector('title'),
                        'important'   => 'all',
                    ],
                    'tab_slug'    => 'advanced',
                    'toggle_slug' => 'title',
                ],
            ],
        ];

        // Description spacing advanced settings.
        $config['description_margin_padding'] = [
            'description' => [
                'margin_padding' => [
                    'css'         => [
                        'use_margin'  => true,
                        'use_padding' => true,
                        'main'        => $module->get_selector('description'),
                        'important'   => 'all',
                    ],
                    'tab_slug'    => 'advanced',
                    'toggle_slug' => 'description',
                ],
            ],
        ];

        return $config;
    }

}
