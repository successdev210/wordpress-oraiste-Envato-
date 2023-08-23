(function ($) {
	'use strict';

	qodefCore.shortcodes.oraiste_core_horizontal_portfolio_showcase = {};

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

	var qodefHorizontalSlider = {
		desktop: false,
		mobile: false,

		init: function () {
			var holder = $('.qodef-horizontal-portfolio-showcase');

			if (holder.length) {
				holder.each(function () {
					var $thisHolder = $(this),
						$animatedBorder = $thisHolder.find('.qodef--highlight .qodef-border-lines-1');

					$thisHolder.addClass('qodef--appear');

					$thisHolder.appear(function () {
						setTimeout(function(){
							$animatedBorder.addClass('qodef-animation-init');
						}, 900);
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
				$items = $itemsHolder.find('.qodef-m-item:not(.qodef-m-text)'),
				$textHolder = $itemsHolder.find('.qodef-m-text'),
				$textHolderWidth = $textHolder.outerWidth(),
				$Scrollbar = window.Scrollbar,
				scrollbarOldOffset = 0,
				scrollbarOffset = 0,
				scrollDelta = 0,
				parallaxImages = [],
				parallaxImagesDeltas = [],
				itemWidths = [],
				offsetsLeft = [];

			$Scrollbar.use(HorizontalScrollPlugin);

			var $myScrollbar = $Scrollbar.init(document.querySelector('.qodef-horizontal-portfolio-showcase .qodef-m-items-holder'),
				{
					damping: .06,
					continuousScrolling: false,
				}
			);

			$items.each(function ($i) {
				var $thisItem = $(this);
				parallaxImages[$i] = $thisItem.find('.qodef-e-custom-image img');
				parallaxImagesDeltas[$i] = 0;
				itemWidths[$i] = $thisItem.outerWidth();

				offsetsLeft[$i] = itemWidths[$i] * ($i + 1);

				$(this).attr('data-offset-left', offsetsLeft[$i]);

				// condition: sc width (holder width) - text holder width > item right position - item half width
				if ((holderWidth - $textHolderWidth) > (offsetsLeft[$i]) - (itemWidths[$i] / 2)) {
					setTimeout(
						function () {
							$thisItem.addClass( 'qodef--appear' );
						},
						$i * 200 + 200
					)
				}
			});

			$myScrollbar.addListener(function () {
				scrollbarOffset = this.offset.x;
				scrollDelta = scrollbarOffset - scrollbarOldOffset;

				if (Math.abs(scrollDelta) > 5){
					$items.each(function ($i) {
						var $thisItem = $(this);

						// condition: sc width (holder width) - text holder width + horizontal scroll > item right position - item half width
						if (!$thisItem.hasClass('qodef--appear') && (holderWidth - $textHolderWidth + scrollbarOffset) > (offsetsLeft[$i]) - (itemWidths[$i] / 2)) {
							$thisItem.addClass('qodef--appear');
						}

						if ((scrollbarOffset + qodef.windowWidth) > offsetsLeft[$i] - $textHolderWidth) {
							parallaxImagesDeltas[$i] += scrollDelta;

							if (Math.abs(parallaxImagesDeltas[$i]/65) < 30){//60 random numbers base on appearance, 30 in order for parallax image to cover container
								parallaxImages[$i].css('transform','translateX(' + ( - (parallaxImagesDeltas[$i]/65).toFixed(1) ) + '%)');
							}
						}
					});
				}

				scrollbarOldOffset = scrollbarOffset;
			});
		},
		removeSlider: function ($holder) {
			var $itemsHolder = $holder.find('.qodef-m-items-holder'),
				$items = $itemsHolder.find('.qodef-m-item'),
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
		},
	};

	qodefCore.shortcodes.oraiste_core_horizontal_portfolio_showcase.qodefHorizontalSlider = qodefHorizontalSlider;

})(jQuery);
