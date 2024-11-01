var wptMasonry = {
	init: function() {
		var self = this;

		jQuery(".wpt-masonry").each(function() {
			var $masonryEl = jQuery(this);
			var $gridEl = jQuery(this).find(".masonry-grid");
			$gridEl.removeClass("wpt-masonry-hidden");

			var msnry = Masonry.data($gridEl);

			if (msnry) {
				msnry.destroy();
			}

			var classname = "." + $gridEl.data("class");
			var options = $gridEl.data("options");
			if (typeof options !== "undefined") {
				options.itemSelector = classname + " .masonry-grid-item";
				options.columnWidth = classname + " .masonry-grid-sizer";
				options.percentPosition = true;

				$grid = $gridEl.masonry(options);

				$grid.imagesLoaded().progress(function() {
					$grid.masonry("layout");
				});

				if ($masonryEl.hasClass("wpt-masonry-with-gallery")) {
					jQuery(options.itemSelector).magnificPopup({
						type: "image",
						mainClass: $gridEl.data("class") + " wpt-masonry",
						gallery: {
							titleSrc: "title",
							enabled: true,
						},
					});
				}
			}
		});
	},
};

jQuery(document).ready(function($) {
	wptMasonry.init();
});
