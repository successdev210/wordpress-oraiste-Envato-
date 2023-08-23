(function ($) {
	'use strict';

	qodefCore.shortcodes.oraiste_core_section_title = {};

	$(document).ready(function () {
		qodefSectionTitle.init();
	});

	var qodefSectionTitle = {
		init: function () {
			var $holder = $('.qodef-section-title');

			if ($holder.length) {
				$holder.each(function () {
					var $thisHolder = $(this),
						$animatedBorder = $thisHolder.find('.qodef--highlight .qodef-border-lines-3'),
						animationDelay = $thisHolder.hasClass('.qodef--has-appear') ? 1500 : 0;

					setTimeout(function(){
						$thisHolder.appear(function () {
							$animatedBorder.addClass('qodef-animation-init');
						}, {accX: 0, accY: 0});
					}, animationDelay);
				});
			}
		}
	};

	qodefCore.shortcodes.oraiste_core_section_title.qodefSectionTitle = qodefSectionTitle;
	qodefCore.shortcodes.oraiste_core_section_title.qodefAppearElementsReady = qodef.qodefAppearElementsReady;
})(jQuery);
