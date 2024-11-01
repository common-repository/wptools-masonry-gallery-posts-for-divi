<?php
namespace WPT_Masonry_Divi_Modules\MasonryPostTypeGalleryFullWidth;

use WPT_Masonry_Divi_Modules\MasonryPostTypeGallery\MasonryPostTypeGallery;

class MasonryPostTypeGalleryFullWidth extends MasonryPostTypeGallery
{

    public $slug       = 'et_pb_masonry_post_type_gallery_fw';
    public $vb_support = 'on';
    protected $container;
    protected $helper;

    public function __construct(
        $container,
        $fullwidth = false
    ) {
        $this->container = $container;
        parent::__construct($container, true);
        $this->slug = 'et_pb_masonry_post_type_gallery_fw';
    }

}
