(function ($) {
	"use strict";

	qodefCore.shortcodes.oraiste_core_portfolio_list_fixed_layout = {};
	
	$(document).ready(function () {
		qodefTiltInfoBellow.init();
	});

	var qodefTiltInfoBellow = {
		init: function () {
			var $gallery = $('.qodef-portfolio-list-fixed-layout.qodef-hover-animation--tilt');

			if ($gallery.length) {
				$gallery.each(function () {
					var $this = $(this);

					$this.find('article .qodef-e-media-image').each(function () {
						var $tiltHolder = $(this).find('.js-tilt-glare');

						if ( $tiltHolder.length === 0 ) {
							$(this).tilt({
								maxTilt: 23,
								perspective: 2000,
								// easing: "cubic-bezier(.03,.98,.52,.99)",
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

	qodefCore.shortcodes.oraiste_core_portfolio_list_fixed_layout.qodefTiltInfoBellow = qodefTiltInfoBellow;
	
})(jQuery);