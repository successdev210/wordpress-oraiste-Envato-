(function ($) {
	'use strict';

	// This case is important when theme is not active
	if (typeof qodef !== 'object') {
		window.qodef = {};
	}

	window.qodefCore = {};
	qodefCore.shortcodes = {};
	qodefCore.listShortcodesScripts = {
		qodefSwiper       : qodef.qodefSwiper,
		qodefPagination   : qodef.qodefPagination,
		qodefFilter       : qodef.qodefFilter,
		qodefMasonryLayout: qodef.qodefMasonryLayout,
	};

	qodefCore.body = $('body');
	qodefCore.html = $('html');
	qodefCore.windowWidth = $(window).width();
	qodefCore.windowHeight = $(window).height();
	qodefCore.scroll = 0;

	$(document).ready(
		function () {
			qodefCore.scroll = $(window).scrollTop();
			qodefInlinePageStyle.init();
		}
	);

	$(window).resize(
		function () {
			qodefCore.windowWidth = $(window).width();
			qodefCore.windowHeight = $(window).height();
		}
	);

	$(window).scroll(
		function () {
			qodefCore.scroll = $(window).scrollTop();
		}
	);

	var qodefScroll = {
		disable            : function () {
			if (window.addEventListener) {
				window.addEventListener(
					'wheel',
					qodefScroll.preventDefaultValue,
					{passive: false}
				);
			}

			// window.onmousewheel = document.onmousewheel = qodefScroll.preventDefaultValue;
			document.onkeydown = qodefScroll.keyDown;
		},
		enable             : function () {
			if (window.removeEventListener) {
				window.removeEventListener(
					'wheel',
					qodefScroll.preventDefaultValue,
					{passive: false}
				);
			}
			window.onmousewheel = document.onmousewheel = document.onkeydown = null;
		},
		preventDefaultValue: function (e) {
			e = e || window.event;
			if (e.preventDefault) {
				e.preventDefault();
			}
			e.returnValue = false;
		},
		keyDown            : function (e) {
			var keys = [37, 38, 39, 40];
			for (var i = keys.length; i--;) {
				if (e.keyCode === keys[i]) {
					qodefScroll.preventDefaultValue(e);
					return;
				}
			}
		}
	};

	qodefCore.qodefScroll = qodefScroll;

	var qodefPerfectScrollbar = {
		init           : function ($holder) {
			if ($holder.length) {
				qodefPerfectScrollbar.qodefInitScroll($holder);
			}
		},
		qodefInitScroll: function ($holder) {
			var $defaultParams = {
				wheelSpeed     : 0.6,
				suppressScrollX: true
			};

			var $ps = new PerfectScrollbar(
				$holder[0],
				$defaultParams
			);

			$(window).resize(
				function () {
					$ps.update();
				}
			);
		}
	};

	qodefCore.qodefPerfectScrollbar = qodefPerfectScrollbar;

	var qodefInlinePageStyle = {
		init: function () {
			this.holder = $('#oraiste-core-page-inline-style');

			if (this.holder.length) {
				var style = this.holder.data('style');

				if (style.length) {
					$('head').append('<style type="text/css">' + style + '</style>');
				}
			}
		}
	};

})(jQuery);
