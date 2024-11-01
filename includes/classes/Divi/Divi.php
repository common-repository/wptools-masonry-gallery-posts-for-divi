<?php
namespace WPT\Masonry\Divi;

use WPT_Masonry_Divi_Modules\MasonryImageGallery\MasonryImageGallery;
use WPT_Masonry_Divi_Modules\MasonryPostTypeGallery\MasonryPostTypeGallery;
use WPT_Masonry_Divi_Modules\MasonaryImageGalleryFullWidth\MasonaryImageGalleryFullWidth;
use WPT_Masonry_Divi_Modules\MasonryPostTypeGalleryFullWidth\MasonryPostTypeGalleryFullWidth;

/**
 * Divi.
 */
class Divi
{
    protected $container;

    /**
     * Constructor.
     */
    public function __construct($container)
    {
        $this->container = $container;
    }

    public function is_ajax()
    {
        return defined('DOING_AJAX') && DOING_AJAX;
    }

    /**
     * Register divi extension
     *
     * @return [type] [description]
     */
    public function divi_extensions_init()
    {
        new \WPT_Masonry_Divi_Modules\DiviMasonryExtension($this->container);
    }

    /**
     * Enqueue assets for divi modules
     */
    public function enqueue_assets()
    {

        wp_enqueue_script(
            'wpt-masonry',
            $this->container['plugin_url'] . "/js/masonry.pkgd.min.js",
            ['jquery'],
            $this->container['plugin_version'],
            true
        );

        wp_enqueue_script(
            'wpt-imagesloaded',
            $this->container['plugin_url'] . "/js/imagesloaded.pkgd.min.js",
            ['wpt-masonry'],
            $this->container['plugin_version'],
            true
        );

        wp_enqueue_script(
            'wpt-masonry-custom',
            $this->container['plugin_url'] . "/js/script.js",
            ['magnific-popup'],
            $this->container['plugin_version'],
            true
        );

        if (defined("ET_BUILDER_VERSION")) {
            $divi_with_dynamic_assets = class_exists('\\ET_Dynamic_Assets');

            if ($divi_with_dynamic_assets) {
                $maginific_js  = ET_BUILDER_URI . '/feature/dynamic-assets/assets/js/magnific-popup.js';
                $maginific_css = ET_BUILDER_URI . '/feature/dynamic-assets/assets/css/magnific_popup.css';
            } else {
                $maginific_js  = ET_BUILDER_URI . '/scripts/ext/jquery.magnific-popup.js';
                $maginific_css = ET_BUILDER_URI . '/styles/magnific_popup.css';
            }

            wp_enqueue_style('magnific-popup', $maginific_css, [], ET_BUILDER_VERSION);
            wp_enqueue_script('magnific-popup', $maginific_js, ['jquery', 'wpt-masonry'], ET_BUILDER_VERSION, true);
        }

        if ($this->is_fb()) {
            wp_enqueue_style('wpdt-divi-backend', $this->container['plugin_url'] . "/styles/backend-style.min.css", [], $this->container['plugin_version'], false);
        }

    }

    /**
     * ET builder ready hook
     *
     * @return [type] [description]
     */
    public function et_builder_ready()
    {
        new MasonryImageGallery($this->container);
        new MasonryPostTypeGallery($this->container);

        new MasonaryImageGalleryFullWidth($this->container);
        new MasonryPostTypeGalleryFullWidth($this->container);
    }

    /**
     * Check if request is from frontend builder.
     */
    public function is_fb()
    {
        // phpcs:ignore WordPress.Security.NonceVerification
        return isset($_GET['et_fb']) and ($_GET['et_fb'] == '1');
    }

    public function get_responsive_values(
        $prop_name,
        $props,
        $default
    ) {
        $desktop = et_pb_responsive_options()->get_desktop_value($prop_name, $props, $default);
        $tablet  = et_pb_responsive_options()->get_tablet_value($prop_name, $props, $desktop);
        $phone   = et_pb_responsive_options()->get_phone_value($prop_name, $props, $tablet);

        return [
            'desktop' => $desktop,
            'tablet'  => $tablet,
            'phone'   => $phone,
        ];
    }

    public function process_advanced_margin_padding_css(
        $module,
        $prop_name,
        $function_name,
        $margin_padding
    ) {
        $utils           = \ET_Core_Data_Utils::instance();
        $all_values      = $module->props;
        $advanced_fields = $module->advanced_fields;

        // Disable if module doesn't set advanced_fields property and has no VB support.
        if (!$module->has_vb_support() && !$module->has_advanced_fields) {
            return;
        }

        $allowed_advanced_fields = [$prop_name . '_margin_padding'];
        foreach ($allowed_advanced_fields as $advanced_field) {
            if (!empty($advanced_fields[$advanced_field])) {

                foreach ($advanced_fields[$advanced_field] as $option_name => $form_field) {
                    $margin_key  = "{$option_name}_custom_margin";
                    $padding_key = "{$option_name}_custom_padding";
                    if ('' !== $utils->array_get($all_values, $margin_key, '') || '' !== $utils->array_get($all_values, $padding_key, '')) {
                        $settings = $utils->array_get($form_field, 'margin_padding', []);

                        $form_field_margin_padding_css = $utils->array_get($settings, 'css.main', '');
                        if (empty($form_field_margin_padding_css)) {
                            $utils->array_set($settings, 'css.main', $utils->array_get($form_field, 'css.main', ''));
                        }

                        $margin_padding->update_styles($module, $option_name, $settings, $function_name, $advanced_field);
                    }
                }
            }
        }
    }

    public function get_prop_value(
        $module,
        $prop_name
    ) {
        return isset($module->props[$prop_name]) && $module->props[$prop_name] ? $module->props[$prop_name] : $module->get_default($prop_name);
    }

}
