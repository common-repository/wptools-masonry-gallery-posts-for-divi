<?php

namespace WPT\Masonry\WP;

/**
 * Bootstrap.
 */
class Bootstrap
{
    protected  $container ;
    /**
     * Constructor.
     */
    public function __construct( $container )
    {
        $this->container = $container;
    }
    
    /**
     * Register activation hook
     */
    public function register_activation_hook()
    {
        flush_rewrite_rules( true );
    }
    
    public function fs_lic_js()
    {
        $isPremium = false;
        // phpcs:ignore
        echo  sprintf( '<script type="text/javascript">var wpt_divi_masonry_fs = %b;</script>', $isPremium ) ;
    }

}