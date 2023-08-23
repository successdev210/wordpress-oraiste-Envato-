(function ($) {
	"use strict";

	$(window).on(
		'load',
		function () {
			qodefBackgroundText.init();
		}
	);

	$(window).resize(
		function () {
			qodefBackgroundText.init();
		}
	);

	var qodefBackgroundText = {
		init                    : function () {
			var $holder = $('.qodef-background-text');

			if ($holder.length) {
				$holder.each(
					function () {
						qodefBackgroundText.responsiveOutputHandler($(this));
					}
				);
			}
		},
		responsiveOutputHandler : function ($holder) {
			var breakpoints = {
				3840: 1441,
				1440: 1367,
				1366: 1025,
				1024: 1
			};

			$.each(
				breakpoints,
				function (max, min) {
					if (qodef.windowWidth <= max && qodef.windowWidth >= min) {
						qodefBackgroundText.generateResponsiveOutput($holder, max);
					}
				}
			);
		},
		generateResponsiveOutput: function ($holder, width) {
			var $textHolder = $holder.find('.qodef-m-background-text');

			if ($textHolder.length) {
				$textHolder.css(
					{
						'font-size': $textHolder.data('size-' + width) + 'px',
						'top'      : $textHolder.data('vertical-offset-' + width) + 'px',
					}
				);
			}
		},
	};

	window.qodefBackgroundText = qodefBackgroundText;
})(jQuery);
