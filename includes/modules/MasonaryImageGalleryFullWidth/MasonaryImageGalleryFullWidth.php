<?php
namespace WPT_Masonry_Divi_Modules\MasonaryImageGalleryFullWidth;

use WPT_Masonry_Divi_Modules\MasonryImageGallery\MasonryImageGallery;

class MasonaryImageGalleryFullWidth extends MasonryImageGallery
{

    public $slug       = 'et_pb_wpt_masonry_image_gallery_fw';
    public $vb_support = 'on';
    protected $container;
    protected $helper;

    public function __construct(
        $container,
        $fullwidth = false
    ) {
        $this->container = $container;
        parent::__construct($container, true);
        $this->slug = 'et_pb_wpt_masonry_image_gallery_fw';
    }

}
