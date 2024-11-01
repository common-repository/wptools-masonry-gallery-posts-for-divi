<?php
namespace WPT\Masonry;

use WPTools\Pimple\Container;

/**
 * Container
 */
class Loader extends Container
{
    /**
     *
     * @var mixed
     */
    public static $instance;

    public function __construct()
    {
        parent::__construct();

        $this['bootstrap'] = function ($container) {
            return new WP\Bootstrap($container);
        };

        $this['divi'] = function ($container) {
            return new Divi\Divi($container);
        };

        $this['divi_background'] = function ($container) {
            return new Divi\Background($container);
        };

        $this['masonry'] = function ($container) {
            return new Divi\Masonry($container);
        };

        $this['divi_post_type_query_builder'] = function ($container) {
            return new Divi\PostTypeQueryBuilder($container);
        };

        $this['image_gallery'] = function ($container) {
            return new Divi\ImageGallery($container);
        };

        $this['attachment'] = function ($container) {
            return new WP\Attachment($container);
        };

    }

/**
 * Get container instance.
 */
    public static function getInstance()
    {
        if (!self::$instance) {
            self::$instance = new Loader();
        }

        return self::$instance;
    }

/**
 * Plugin run
 */
    public function run()
    {
        register_activation_hook($this['plugin_file'], [$this['bootstrap'], 'register_activation_hook']);

        //divi actions
        add_action('et_builder_ready', [$this['divi'], 'et_builder_ready'], 1);
        add_action('divi_extensions_init', [$this['divi'], 'divi_extensions_init']);

        $this['attachment']->register_taxonomy();

        add_filter(
            'register_post_type_args',
            [
                $this['attachment'],
                'register_post_type_args_filter',
            ],
            10,
            2
        );

        if ($this['divi']->is_fb()) {
            add_action(
                'wp_enqueue_scripts',
                [$this['divi'], 'enqueue_assets'],
                10,
                1
            );
        }

        // REST APIs
        add_action('rest_api_init', [$this['divi_post_type_query_builder'], 'rest_api_init']);
        add_action(
            'wp_head',
            [$this['bootstrap'], 'fs_lic_js']
        );
    }

};
