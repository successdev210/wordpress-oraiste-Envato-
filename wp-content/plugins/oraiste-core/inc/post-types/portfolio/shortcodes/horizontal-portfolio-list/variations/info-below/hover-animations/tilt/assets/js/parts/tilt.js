(function ($) {
	"use strict";

	qodefCore.shortcodes.oraiste_core_horizontal_portfolio_list = {};
	
	$(document).ready(function () {
		qodefTiltInfoBellow.init();
	});

	var qodefTiltInfoBellow = {
		init: function () {
			var $gallery = $('.qodef-horizontal-portfolio-list.qodef-hover-animation--tilt');

			if ($gallery.length) {
				$gallery.each(function () {
					var $this = $(this);

					$this.find('article.qodef--appear .qodef-e-media-image').each(function () {
						var $tiltHolder = $(this).find('.js-tilt-glare');

						if ( $tiltHolder.length === 0 ) {
							$(this).tilt({
								maxTilt: 23,
								perspective: 2000,
								easing: "cubic-bezier(0.22, 0.61, 0.36, 1)",
								transition: true,
								speed: 300,
								glare: false,
							});
						}
					});
				});
			}
		}
	};

	qodefCore.shortcodes.oraiste_core_horizontal_portfolio_list.qodefTiltInfoBellow = qodefTiltInfoBellow;
	
})(jQuery);