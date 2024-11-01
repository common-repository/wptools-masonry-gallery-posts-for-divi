<?php

namespace WPT\Masonry\Divi;

/**
 * ImageGallery.
 */
class ImageGallery
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
     * Get images by IDs
     */
    public function get_by_ids( $image_ids )
    {
        $image_ids = trim( $image_ids );
        if ( !$image_ids ) {
            return [];
        }
        $image_ids = explode( ',', $image_ids );
        
        if ( !wpt_divi_masonry()->is_premium() ) {
            $chunks = array_chunk( $image_ids, 6 );
            if ( isset( $chunks[0] ) ) {
                $image_ids = $chunks[0];
            }
        }
        
        $images = [];
        foreach ( $image_ids as $id ) {
            $image = [];
            $src = wp_get_attachment_image_src( $id, 'full' );
            if ( isset( $src[0] ) ) {
                $image['src'] = $src[0];
            }
            $image['srcset'] = wp_get_attachment_image_srcset( $id, 'full' );
            $image['title'] = get_the_title( $id );
            $image['caption'] = wp_get_attachment_caption( $id );
            $image['description'] = '';
            $image_post = get_post( $id );
            if ( $image_post ) {
                $image['description'] = $image_post->post_content;
            }
            $images[] = $image;
        }
        return $images;
    }

}