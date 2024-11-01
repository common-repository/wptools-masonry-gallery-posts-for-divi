<?php
namespace WPT\Masonry\WP;

/**
 * Attachment.
 */
class Attachment
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
     * Register attachment taxonomy.
     */
    public function register_taxonomy()
    {
        $taxonomiesTypesDir = $this->container['plugin_dir'] . '/taxonomies/';
        include_once $taxonomiesTypesDir . 'wpt-attachment-cat.php';
    }

    /**
     * Add the custom order field to the create/edit post type item.
     */
    public function register_post_type_args_filter(
        $args,
        $post_type
    ) {

        if ($post_type == 'attachment') {
            if (!isset($args['supports'])) {
                $args['supports'] = [];
            }
            $args['supports'][] = 'page-attributes';
        }

        return $args;
    }

}
