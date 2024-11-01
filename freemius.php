<?php

if ( !function_exists( 'wpt_divi_masonry' ) ) {
    // Create a helper function for easy SDK access.
    function wpt_divi_masonry()
    {
        global  $wpt_divi_masonry ;
        
        if ( !isset( $wpt_divi_masonry ) ) {
            // Include Freemius SDK.
            require_once dirname( __FILE__ ) . '/freemius/start.php';
            $wpt_divi_masonry = fs_dynamic_init( [
                'id'             => '8580',
                'slug'           => 'wptools-masonry-gallery-posts-for-divi',
                'type'           => 'plugin',
                'public_key'     => 'pk_1d9834e49aa3405c5248e9152ec76',
                'is_premium'     => false,
                'premium_suffix' => 'Premium',
                'has_addons'     => false,
                'has_paid_plans' => true,
                'trial'          => [
                'days'               => 7,
                'is_require_payment' => false,
            ],
                'menu'           => [
                'support' => false,
            ],
                'is_live'        => true,
            ] );
        }
        
        return $wpt_divi_masonry;
    }
    
    // Init Freemius.
    wpt_divi_masonry();
    // Signal that SDK was initiated.
    do_action( 'wpt_divi_masonry_loaded' );
}
