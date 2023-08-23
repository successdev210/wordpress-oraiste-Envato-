(function ($) {
	'use strict';

	$(window).on(
		'load',
		function () {
			qodefParallaxBackground.init();
		}
	);

	/**
	 * Init global parallax background functionality
	 */
	var qodefParallaxBackground = {
		init       : function (settings) {
			this.$sections = $('.qodef-parallax');

			// Allow overriding the default config
			$.extend(this.$sections, settings);

			var isSupported = !qodefCore.html.hasClass('touchevents') && !qodefCore.body.hasClass('qodef-browser--edge') && !qodefCore.body.hasClass('qodef-browser--ms-explorer');

			if (this.$sections.length && isSupported) {
				this.$sections.each(
					function () {
						qodefParallaxBackground.ready($(this));
					}
				);
			}
		},
		isSupported: function (enableOnTouch) {


			console.log('default support: ' + isSupported);

			if (enableOnTouch) {
				isSupported = !qodefCore.body.hasClass('qodef-browser--edge') && !qodefCore.body.hasClass('qodef-browser--ms-explorer');

				console.log('custom support: ' + isSupported);
			}

			return isSupported;
		},
		ready      : function ($section) {
			$section.$imgHolder = $section.find('.qodef-parallax-img-holder');
			$section.$imgWrapper = $section.find('.qodef-parallax-img-wrapper');
			$section.$img = $section.find('img.qodef-parallax-img');

			var h = $section.height(),
				imgWrapperH = $section.$imgWrapper.height();

			$section.movement = 100 * (imgWrapperH - h) / h / 2; //percentage (divided by 2 due to absolute img centering in CSS)

			$section.buffer = window.pageYOffset;
			$section.scrollBuffer = null;


			//calc and init loop
			requestAnimationFrame(
				function () {
					$section.$imgHolder.animate({opacity: 1}, 100);
					qodefParallaxBackground.calc($section);
					qodefParallaxBackground.loop($section);
				}
			);

			//recalc
			$(window).on(
				'resize',
				function () {
					qodefParallaxBackground.calc($section);
				}
			);
		},
		calc       : function ($section) {
			var wH = $section.$imgWrapper.height(),
				wW = $section.$imgWrapper.width();

			if ($section.$img.width() < wW) {
				$section.$img.css(
					{
						'width' : '100%',
						'height': 'auto',
					}
				);
			}

			if ($section.$img.height() < wH) {
				$section.$img.css(
					{
						'height'   : '100%',
						'width'    : 'auto',
						'max-width': 'unset',
					}
				);
			}
		},
		loop       : function ($section) {
			if ($section.scrollBuffer === Math.round(window.pageYOffset)) {
				requestAnimationFrame(
					function () {
						qodefParallaxBackground.loop($section);
					}
				); //repeat loop

				return false; //same scroll value, do nothing
			} else {
				$section.scrollBuffer = Math.round(window.pageYOffset);
			}

			var wH = window.outerHeight,
				sTop = $section.offset().top,
				sH = $section.height();

			if ($section.scrollBuffer + wH * 1.2 > sTop && $section.scrollBuffer < sTop + sH) {
				var delta = (Math.abs($section.scrollBuffer + wH - sTop) / (wH + sH)).toFixed(4) * 1.8, //coeff between 0 and 1 based on scroll amount
					yVal = (delta * $section.movement).toFixed(4);

				if ($section.buffer !== delta) {
					$section.$imgWrapper.css('transform', 'translate3d(0,' + yVal + '%, 0)');
				}

				$section.buffer = delta;
			}

			requestAnimationFrame(
				function () {
					qodefParallaxBackground.loop($section);
				}
			); //repeat loop
		}
	};

	qodefCore.qodefParallaxBackground = qodefParallaxBackground;

})(jQuery);
