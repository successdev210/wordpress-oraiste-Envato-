(function ($) {
	'use strict';

	qodefCore.shortcodes.oraiste_core_interactive_portfolio_list = {};

	$(document).ready(
		function () {
			qodefInteractivePortfolioList.init();
		}
	);

	$(window).on(
		'elementor/frontend/init',
		function () {
			elementorFrontend.hooks.addAction(
				'frontend/element_ready/oraiste_core_horizontal_layout.default',
				function () {
					qodefInteractivePortfolioList.init();
				}
			);
		}
	);

	var qodefInteractivePortfolioList = {
		init    : function () {
			this.holder = $('.qodef-interactive-portfolio-list');

			if (this.holder.length) {
				this.holder.each(
					function () {
						qodefInteractivePortfolioList.initItem($(this));
					}
				);
			}
		},
		initItem: function ($holder) {
			var $items = $holder.find('.qodef-e');

			if ($items.length) {
				$items.on(
					'mouseenter',
					function () {
						$items.removeClass('qodef--active');
						$(this).addClass('qodef--active');
					}
				);
				if ($holder.hasClass('qodef-item-layout--numbered-list')) {
					$items.on(
						'mouseleave',
						function () {
							$items.removeClass('qodef--active');
						}
					);
				}
			}

			$holder.addClass('qodef--init');
		},
	};

	qodefCore.shortcodes.oraiste_core_interactive_portfolio_list.qodefInteractivePortfolioList = qodefInteractivePortfolioList;

})(jQuery);
