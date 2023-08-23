(function ($) {
	'use strict';

	qodefCore.shortcodes.oraiste_core_horizontal_portfolio_list = {};

	$(document).ready(
		function () {
			qodefHorizontalSlider.init();
		}
	);

	$(window).resize(
		function () {
			qodefHorizontalSlider.init();
		}
	);

	$(window).on(
		'elementor/frontend/init',
		function () {
			elementorFrontend.hooks.addAction(
				'frontend/element_ready/oraiste_core_horizontal_portfolio_list.default',
				function () {
					qodefHorizontalSlider.init();
				}
			);
		}
	);

	var qodefHorizontalSlider = {
		desktop: false,
		mobile: false,

		init: function () {
			var holder = $('.qodef-horizontal-portfolio-list');

			if (holder.length) {
				holder.each(function () {
					var $thisHolder = $(this),
						$animatedBorder = $thisHolder.find('.qodef--highlight .qodef-border-lines-1');

						$thisHolder.appear(function () {
							$animatedBorder.addClass('qodef-animation-init');
						}, {accX: 0, accY: 0});

						if (qodef.windowWidth > 1024) {
						qodefHorizontalSlider.desktop = true;

						if (qodefHorizontalSlider.mobile === true) {
							location.reload();
						} else {
							qodefHorizontalSlider.animateSlider($thisHolder);
						}
					} else {
						qodefHorizontalSlider.mobile = true;

						if (qodefHorizontalSlider.desktop === true) {
							location.reload();
						} else {
							qodefHorizontalSlider.removeSlider($thisHolder);
						}
					}
				});
			}
		},
		animateSlider: function ($holder) {
			var holderWidth = $holder.width(),
				$itemsHolder = $holder.find('.qodef-m-items-holder'),
				itemsHolderLeftPadding = parseInt($itemsHolder.css('padding-left')),
				$items = $itemsHolder.find('.qodef-e'),
				itemWidth = $items.outerWidth(),
				$Scrollbar = window.Scrollbar;

			$Scrollbar.use(HorizontalScrollPlugin);
			$Scrollbar.use(window.OverscrollPlugin);

			var $myScrollbar = $Scrollbar.init(document.querySelector('.qodef-horizontal-portfolio-list .qodef-m-items-holder'),
				{
					damping: 0.05,
					plugins: {
						overscroll: {
							damping: 0.1,
							maxOverscroll: 100
						}
					}
				}
			);

			$items.each(function ($i) {
				var thisOffsetLeft = itemWidth * ($i + 1);

				$(this).attr('data-offset-left', thisOffsetLeft);
				$(this).data('offset-left', thisOffsetLeft);
			});

			$items.each(function ($i) {
				var $thisItem = $(this);
				// condition: sc width (holder width) - item holder left padding > item right position - item half width
				if ((holderWidth - itemsHolderLeftPadding) > ($(this).data('offset-left')) - (itemWidth / 2)) {
					setTimeout(function () {
						$thisItem.addClass('qodef--appear');
					}, $i * 250)
				}
			});

			$myScrollbar.addListener(function () {
				var scrollbarOffset = this.offset.x;

				$items.each(function () {
					// condition: sc width (holder width) - item holder left padding + horizontal scroll > item right position - item half width
					if ((holderWidth - itemsHolderLeftPadding + scrollbarOffset) > ($(this).data('offset-left')) - (itemWidth / 2)) {
						$(this).addClass('qodef--appear');
					}
				});
			});
		},
		removeSlider: function ($holder) {
			var $itemsHolder = $holder.find('.qodef-m-items-holder'),
				$items = $itemsHolder.find('.qodef-e'),
				$sliderElement = $itemsHolder.find('.scroll-content'),
				$section = $holder.closest('.elementor-section.elementor-section-height-full');

			if ($sliderElement.length) {
				$items.unwrap(); // remove .scroll-content
				$itemsHolder.find('.scrollbar-track').remove(); // remove .scrollbar-track
			}

			$items.each(function () {
				var $thisItem = $(this);

				$thisItem.appear(function () {
					$thisItem.addClass('qodef--appear');
				});
			});

			if ($section.length) {
				$section.css({ 'height': 'auto' });
			}
		}
	};

	qodefCore.shortcodes.oraiste_core_horizontal_portfolio_list.qodefHorizontalSlider = qodefHorizontalSlider;

})(jQuery);
