(function ($) {
	'use strict';

	qodefCore.shortcodes.oraiste_core_portfolio_showcase = {};

	$(document).ready(function () {
		qodefPortfolioShowcase.init();
	});

	var qodefPortfolioShowcase = {
		init: function () {
			var $holder = $('.qodef-portfolio-showcase .qodef--highlight .qodef-border-lines-1 ');

			if ($holder.length) {
				$holder.each(function () {
					var $thisHolder = $(this);

					$thisHolder.appear(function () {
						setTimeout(function(){
							$thisHolder.addClass('qodef-animation-init');
						}, 900);
					}, {accX: 0, accY: 0});
				});
			}
		}
	};

	qodefCore.shortcodes.oraiste_core_portfolio_showcase.qodefPortfolioShowcase = qodefPortfolioShowcase;
	qodefCore.shortcodes.oraiste_core_portfolio_showcase.qodefAppearElementsReady = qodef.qodefAppearElementsReady;
})(jQuery);
