<?php
namespace WPT_Masonry_Divi_Modules;

use DiviExtension;

class DiviMasonryExtension extends DiviExtension
{
    protected $container;

    /**
     * The gettext domain for the extension's translations.
     *
     * @var string
     * @since 1.0.0
     */
    public $gettext_domain;

    /**
     * The extension's WP Plugin name.
     *
     * @var string
     * @since 1.0.0
     */
    public $name = 'wpt-masonry-with-gallery-for-images-and-posts';

    /**
     * The extension's version
     *
     * @var string
     * @since 1.0.0
     */
    public $version;

    /**
     * Constructor.
     *
     * @param string $name
     * @param array  $args
     */
    public function __construct( $container )
    {
        $this->gettext_domain = $container['plugin_slug'];
        $this->version        = $container['plugin_version'];
        $this->plugin_dir     = $container['plugin_dir'] . '/';
        $this->plugin_dir_url = $container['plugin_url'] . '/';

        $this->container = $container;
        parent::__construct( $this->name, [] );
    }
}
