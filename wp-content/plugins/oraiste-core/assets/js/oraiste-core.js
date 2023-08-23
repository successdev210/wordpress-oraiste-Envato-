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

(function ( $ ) {
	'use strict';

	$( document ).ready(
	    function () {
            qodefBackToTop.init();
        }
	);

	var qodefBackToTop = {
		init: function () {
			this.holder = $( '#qodef-back-to-top' );

			if ( this.holder.length ) {
				// Scroll To Top
				this.holder.on(
					'click',
					function ( e ) {
						e.preventDefault();
						qodefBackToTop.animateScrollToTop();
					}
				);

				qodefBackToTop.showHideBackToTop();
			}
		},
		animateScrollToTop: function () {
			var startPos = qodef.scroll,
				newPos   = qodef.scroll,
				step     = .9,
				animationFrameId;

			var startAnimation = function () {
				if ( newPos === 0 ) {
                    return;
                }

				newPos < 0.0001 ? newPos = 0 : null;

				var ease = qodefBackToTop.easingFunction( (startPos - newPos) / startPos );
				$( 'html, body' ).scrollTop( startPos - (startPos - newPos) * ease );
				newPos = newPos * step;

				animationFrameId = requestAnimationFrame( startAnimation );
			};
			startAnimation();
			$( window ).one(
				'wheel touchstart',
				function () {
					cancelAnimationFrame( animationFrameId );
				}
			);
		},
		easingFunction: function ( n ) {
			return 0 == n ? 0 : Math.pow( 1024, n - 1 );
		},
		showHideBackToTop: function () {
			$( window ).scroll( function () {
				var $thisItem = $( this ),
					b         = $thisItem.scrollTop(),
					c         = $thisItem.height(),
					d;

				if ( b > 0 ) {
					d = b + c / 2;
				} else {
					d = 1;
				}

				if ( d < 1e3 ) {
					qodefBackToTop.addClass( 'off' );
				} else {
					qodefBackToTop.addClass( 'on' );
				}
			} );
		},
		addClass: function ( a ) {
			this.holder.removeClass( 'qodef--off qodef--on' );

			if ( a === 'on' ) {
				this.holder.addClass( 'qodef--on' );
			} else {
				this.holder.addClass( 'qodef--off' );
			}
		}
	};

})( jQuery );

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

(function ( $ ) {
	'use strict';

	$( window ).on(
		'load',
		function () {
			qodefUncoverFooter.init();
		}
	);

	var qodefUncoverFooter = {
		holder: '',
		init: function () {
			this.holder = $( '#qodef-page-footer.qodef--uncover' );

			if ( this.holder.length && ! qodefCore.html.hasClass( 'touchevents' ) ) {
				qodefUncoverFooter.addClass();
				qodefUncoverFooter.setHeight( this.holder );

				$( window ).resize(
					function () {
						qodefUncoverFooter.setHeight( qodefUncoverFooter.holder );
					}
				);
			}
		},
		setHeight: function ( $holder ) {
			$holder.css( 'height', 'auto' );

			var footerHeight = $holder.outerHeight();

			if ( footerHeight > 0 ) {
				$( '#qodef-page-outer' ).css(
					{
						'margin-bottom': footerHeight,
						'background-color': qodefCore.body.css( 'backgroundColor' )
					}
				);

				$holder.css( 'height', footerHeight );
			}
		},
		addClass: function () {
			qodefCore.body.addClass( 'qodef-page-footer--uncover' );
		}
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefFullscreenMenu.init();
		}
	);

	$( window ).on(
		'resize',
		function () {
			qodefFullscreenMenu.handleHeaderWidth( 'resize' );
		}
	);

	var qodefFullscreenMenu = {
		init: function () {
			var $fullscreenMenuOpener = $( 'a.qodef-fullscreen-menu-opener' ),
				$menuItems            = $( '#qodef-fullscreen-area nav ul li a' );

			// prevent header changing width when fullscreen menu is open
			qodefFullscreenMenu.handleHeaderWidth( 'init' );

			// open popup menu
			$fullscreenMenuOpener.on(
				'click',
				function ( e ) {
					e.preventDefault();
					var $thisOpener = $( this );

					if ( ! qodefCore.body.hasClass( 'qodef-fullscreen-menu--opened' ) ) {
						qodefFullscreenMenu.openFullscreen( $thisOpener );

						$( document ).keyup(
							function ( e ) {
								if ( e.keyCode === 27 ) {
									qodefFullscreenMenu.closeFullscreen( $thisOpener );
								}
							}
						);
					} else {
						qodefFullscreenMenu.closeFullscreen( $thisOpener );
					}
				}
			);

			// open dropdowns
			$menuItems.on(
				'tap click',
				function ( e ) {
					var $thisItem = $( this );

					if ( $thisItem.parent().hasClass( 'menu-item-has-children' ) ) {
						e.preventDefault();
						qodefFullscreenMenu.clickItemWithChild( $thisItem );
					} else if ( $thisItem.attr( 'href' ) !== 'http://#' && $thisItem.attr( 'href' ) !== '#' ) {
						qodefFullscreenMenu.closeFullscreen( $fullscreenMenuOpener );
					}
				}
			);
		},
		openFullscreen: function ( $opener ) {
			$opener.addClass( 'qodef--opened' );
			qodefCore.body.removeClass( 'qodef-fullscreen-menu-animate--out' ).addClass( 'qodef-fullscreen-menu--opened qodef-fullscreen-menu-animate--in' );
			qodefCore.qodefScroll.disable();
		},
		closeFullscreen: function ( $opener ) {
			$opener.removeClass( 'qodef--opened' );
			qodefCore.body.removeClass( 'qodef-fullscreen-menu--opened qodef-fullscreen-menu-animate--in' ).addClass( 'qodef-fullscreen-menu-animate--out' );
			qodefCore.qodefScroll.enable();
			$( 'nav.qodef-fullscreen-menu ul.sub_menu' ).slideUp( 200 );
		},
		clickItemWithChild: function ( thisItem ) {
			var $thisItemParent  = thisItem.parent(),
				$thisItemSubMenu = $thisItemParent.find( '.sub-menu' ).first();

			if ( $thisItemSubMenu.is( ':visible' ) ) {
				$thisItemSubMenu.slideUp( 300 );
				$thisItemParent.removeClass( 'qodef--opened' );
			} else {
				$thisItemSubMenu.slideDown( 300 );
				$thisItemParent.addClass( 'qodef--opened' ).siblings().find( '.sub-menu' ).slideUp( 400 );
			}
		},
		handleHeaderWidth: function (state) {
			var $header = $( '#qodef-page-header' );

			if ($header.length) {
				// if desktop device
				if (qodefCore.windowWidth > 1024) {
					// if page height is greater then window height, scroll bar is visible
					if (qodefCore.body.height() > qodefCore.windowHeight) {
						// on resize reset previously set inline width
						if ('resize' === state) {
							$header.css( {'width': ''} );
						}
						$header.width( $header.width() );
					}
				} else {
					// reset previously set inline width
					$header.css( {'width': ''} );
				}
			}
		}
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefHeaderScrollAppearance.init();
		}
	);

	var qodefHeaderScrollAppearance = {
		appearanceType: function () {
			return qodefCore.body.attr( 'class' ).indexOf( 'qodef-header-appearance--' ) !== -1 ? qodefCore.body.attr( 'class' ).match( /qodef-header-appearance--([\w]+)/ )[1] : '';
		},
		init: function () {
			var appearanceType = this.appearanceType();

			if ( appearanceType !== '' && appearanceType !== 'none' ) {
				qodefCore[appearanceType + 'HeaderAppearance']();
			}
		}
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
	    function () {
            qodefMobileHeaderAppearance.init();
        }
	);

	/*
	 **	Init mobile header functionality
	 */
	var qodefMobileHeaderAppearance = {
		init: function () {
			if ( qodefCore.body.hasClass( 'qodef-mobile-header-appearance--sticky' ) ) {

				var docYScroll1   = qodefCore.scroll,
					displayAmount = qodefGlobal.vars.mobileHeaderHeight + qodefGlobal.vars.adminBarHeight,
					$pageOuter    = $( '#qodef-page-outer' );

				qodefMobileHeaderAppearance.showHideMobileHeader( docYScroll1, displayAmount, $pageOuter );

				$( window ).scroll(
				    function () {
                        qodefMobileHeaderAppearance.showHideMobileHeader( docYScroll1, displayAmount, $pageOuter );
                        docYScroll1 = qodefCore.scroll;
                    }
				);

				$( window ).resize(
				    function () {
                        $pageOuter.css( 'padding-top', 0 );
                        qodefMobileHeaderAppearance.showHideMobileHeader( docYScroll1, displayAmount, $pageOuter );
                    }
				);
			}
		},
		showHideMobileHeader: function ( docYScroll1, displayAmount, $pageOuter ) {
			if ( qodefCore.windowWidth <= 1024 ) {
				if ( qodefCore.scroll > displayAmount * 2 ) {
					//set header to be fixed
					qodefCore.body.addClass( 'qodef-mobile-header--sticky' );

					//add transition to it
					setTimeout(
						function () {
							qodefCore.body.addClass( 'qodef-mobile-header--sticky-animation' );
						},
						300
					); //300 is duration of sticky header animation

					//add padding to content so there is no 'jumping'
					$pageOuter.css( 'padding-top', qodefGlobal.vars.mobileHeaderHeight );
				} else {
					//unset fixed header
					qodefCore.body.removeClass( 'qodef-mobile-header--sticky' );

					//remove transition
					setTimeout(
						function () {
							qodefCore.body.removeClass( 'qodef-mobile-header--sticky-animation' );
						},
						300
					); //300 is duration of sticky header animation

					//remove padding from content since header is not fixed anymore
					$pageOuter.css( 'padding-top', 0 );
				}

				if ( (qodefCore.scroll > docYScroll1 && qodefCore.scroll > displayAmount) || (qodefCore.scroll < displayAmount * 3) ) {
					//show sticky header
					qodefCore.body.removeClass( 'qodef-mobile-header--sticky-display' );
				} else {
					//hide sticky header
					qodefCore.body.addClass( 'qodef-mobile-header--sticky-display' );
				}
			}
		}
	};

})( jQuery );

(function ($) {
	'use strict';

	$(document).ready(
		function () {
			qodefNavMenu.init();
		}
	);

	var qodefNavMenu = {
		init                : function () {
			qodefNavMenu.dropdownBehavior();
			qodefNavMenu.wideDropdownPosition();
			qodefNavMenu.dropdownPosition();
		},
		dropdownBehavior    : function () {
			var $menuItems = $('.qodef-header-navigation > ul > li');

			$menuItems.each(
				function () {
					var $thisItem = $(this);

					if ($thisItem.find('.qodef-drop-down-second').length) {
						$thisItem.waitForImages(
							function () {
								var $dropdownHolder = $thisItem.find('.qodef-drop-down-second'),
									$dropdownMenuItem = $dropdownHolder.find('.qodef-drop-down-second-inner ul'),
									dropDownHolderHeight = $dropdownMenuItem.outerHeight();

								if (navigator.userAgent.match(/(iPod|iPhone|iPad)/)) {
									$thisItem.on(
										'touchstart mouseenter',
										function () {
											$dropdownHolder.css(
												{
													'height'    : dropDownHolderHeight,
													'overflow'  : 'visible',
													'visibility': 'visible',
													'opacity'   : '1',
												}
											);
										}
									).on(
										'mouseleave',
										function () {
											$dropdownHolder.css(
												{
													'height'    : '0px',
													'overflow'  : 'hidden',
													'visibility': 'hidden',
													'opacity'   : '0',
												}
											);
										}
									);
								} else {
									if (qodefCore.body.hasClass('qodef-drop-down-second--animate-height')) {
										var animateConfig = {
											interval: 0,
											over    : function () {
												setTimeout(
													function () {
														$dropdownHolder.addClass('qodef-drop-down--start').css(
															{
																'visibility': 'visible',
																'height'    : '0',
																'opacity'   : '1',
															}
														);
														$dropdownHolder.stop().animate(
															{
																'height': dropDownHolderHeight,
															},
															400,
															'easeInOutQuint',
															function () {
																$dropdownHolder.css('overflow', 'visible');
															}
														);
													},
													100
												);
											},
											timeout : 100,
											out     : function () {
												$dropdownHolder.stop().animate(
													{
														'height' : '0',
														'opacity': 0,
													},
													100,
													function () {
														$dropdownHolder.css(
															{
																'overflow'  : 'hidden',
																'visibility': 'hidden',
															}
														);
													}
												);

												$dropdownHolder.removeClass('qodef-drop-down--start');
											}
										};

										$thisItem.hoverIntent(animateConfig);
									} else {
										var config = {
											interval: 0,
											over    : function () {
												setTimeout(
													function () {
														$dropdownHolder.addClass('qodef-drop-down--start').stop().css({'height': dropDownHolderHeight});
													},
													150
												);
											},
											timeout : 150,
											out     : function () {
												$dropdownHolder.stop().css({'height': '0'}).removeClass('qodef-drop-down--start');
											}
										};

										$thisItem.hoverIntent(config);
									}
								}
							}
						);
					}
				}
			);
		},
		wideDropdownPosition: function () {
			var $menuItems = $('.qodef-header-navigation > ul > li.qodef-menu-item--wide');

			if ($menuItems.length) {
				$menuItems.each(
					function () {
						var $menuItem = $(this);
						var $menuItemSubMenu = $menuItem.find('.qodef-drop-down-second');

						if ($menuItemSubMenu.length) {
							$menuItemSubMenu.css('left', 0);

							var leftPosition = $menuItemSubMenu.offset().left;

							if (qodefCore.body.hasClass('qodef--boxed')) {
								//boxed layout case
								var boxedWidth = $('.qodef--boxed #qodef-page-wrapper').outerWidth();
								leftPosition = leftPosition - (qodefCore.windowWidth - boxedWidth) / 2;
								$menuItemSubMenu.css({'left': -leftPosition, 'width': boxedWidth});

							} else if (qodefCore.body.hasClass('qodef-drop-down-second--full-width')) {
								//wide dropdown full width case
								$menuItemSubMenu.css({'left': -leftPosition, 'width': qodefCore.windowWidth});
							} else {
								//wide dropdown in grid case
								$menuItemSubMenu.css({'left': -leftPosition + (qodefCore.windowWidth - $menuItemSubMenu.width()) / 2});
							}
						}
					}
				);
			}
		},
		dropdownPosition    : function () {
			var $menuItems = $('.qodef-header-navigation > ul > li.qodef-menu-item--narrow.menu-item-has-children');

			if ($menuItems.length) {
				$menuItems.each(
					function () {
						var $thisItem = $(this),
							menuItemPosition = $thisItem.offset().left,
							$dropdownHolder = $thisItem.find('.qodef-drop-down-second'),
							$dropdownMenuItem = $dropdownHolder.find('.qodef-drop-down-second-inner ul'),
							dropdownMenuWidth = $dropdownMenuItem.outerWidth(),
							menuItemFromLeft = $(window).width() - menuItemPosition;

						if (qodef.body.hasClass('qodef--boxed')) {
							//boxed layout case
							var boxedWidth = $('.qodef--boxed #qodef-page-wrapper').outerWidth();
							menuItemFromLeft = boxedWidth - menuItemPosition;
						}

						var dropDownMenuFromLeft;

						if ($thisItem.find('li.menu-item-has-children').length > 0) {
							dropDownMenuFromLeft = menuItemFromLeft - dropdownMenuWidth;
						}

						$dropdownHolder.removeClass('qodef-drop-down--right');
						$dropdownMenuItem.removeClass('qodef-drop-down--right');
						if (menuItemFromLeft < dropdownMenuWidth || dropDownMenuFromLeft < dropdownMenuWidth) {
							$dropdownHolder.addClass('qodef-drop-down--right');
							$dropdownMenuItem.addClass('qodef-drop-down--right');
						}
					}
				);
			}
		}
	};

})(jQuery);

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

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefSpinner.init();
		}
	);

	$( window ).on(
		'load',
		function () {
			qodefSpinner.windowLoaded = true;
			qodefSpinner.fadeOutLoader();
		}
	);

	$( window ).on(
		'elementor/frontend/init',
		function () {
			var isEditMode = Boolean( elementorFrontend.isEditMode() );

			if ( isEditMode ) {
				qodefSpinner.init( isEditMode );
			}
		}
	);

	var qodefSpinner = {
		holder: '',
		windowLoaded: false,
		init: function ( isEditMode ) {
			this.holder = $( '#qodef-page-spinner:not(.qodef--custom-spinner)' );

			if (this.holder.length) {
				if (! this.holder.hasClass('qodef-layout--textual')) {
					qodefSpinner.animateSpinner(isEditMode);
					qodefSpinner.fadeOutAnimation();
				} else {
					qodefSpinner.animateCustomSpinner(this.holder);
					qodefSpinner.fadeOutAnimation();
				}
			}
		},
		animateSpinner: function ( isEditMode ) {
			if ( isEditMode ) {
				qodefSpinner.fadeOutLoader() ;
			}
		},
		animateCustomSpinner: function ($holder) {
			var preloaderText = $holder.find('.qodef-textual-spinner-text'),
				preloaderSvg = $holder.find('.qodef-textual-spinner-svg');

			preloaderText.addClass('qodef-appeared');
			preloaderSvg.addClass('qodef-appeared');

			setTimeout(function() {
				preloaderSvg.addClass('qodef-m-morph-circle q-m-morph-idle');
				qodef.qodefSvgMorph.init();
			}, 100);

			setTimeout(function(){
				var appearedItems = $('.qodef--has-appear.qodef--appear');

				appearedItems.each(function () {
					var thisItem = $(this);
					thisItem.removeClass('qodef--appear');
				});
			}, 1200);
		},
		fadeOutLoader: function ( speed, delay, easing ) {
			speed = speed ? speed : 600;
			delay = delay ? delay : 3500;
			easing = easing ? easing : 'swing';

			var $holder = qodefSpinner.holder.length ? qodefSpinner.holder : $( '#qodef-page-spinner:not(.qodef--custom-spinner)' ),
				mainRevHolder = $('#qodef-main-rev-holder'),
				$spinnerSvg = $('.qodef-textual-spinner-svg')

			$holder.delay( delay ).fadeOut( speed, easing );

			if(mainRevHolder.length){
				setTimeout(function() {
					mainRevHolder.find('rs-module').revstart();
				}, delay - 100);
				setTimeout(function() {
					qodef.qodefAppearElementsReady.init();
					$spinnerSvg.remove();
				}, delay + 700);
			}

			$( window ).on(
				'bind',
				'pageshow',
				function ( event ) {
					if ( event.originalEvent.persisted ) {
						$holder.fadeOut( speed, easing );
					}
				}
			);
		},
		fadeOutAnimation: function () {

			// Check for fade out animation
			if ( qodefCore.body.hasClass( 'qodef-spinner--fade-out' ) ) {
				var $pageHolder = $( '#qodef-page-wrapper' ),
					$linkItems  = $( 'a' );

				// If back button is pressed, than show content to avoid state where content is on display:none
				window.addEventListener(
					'pageshow',
					function ( event ) {
						var historyPath = event.persisted || (typeof window.performance !== 'undefined' && window.performance.navigation.type === 2);
						if ( historyPath && ! $pageHolder.is( ':visible' ) ) {
							$pageHolder.show();
						}
					}
				);

				$linkItems.on(
					'click',
					function ( e ) {
						var $clickedLink = $( this );

						if (
							e.which === 1 && // check if the left mouse button has been pressed
							$clickedLink.attr( 'href' ).indexOf( window.location.host ) >= 0 && // check if the link is to the same domain
							! $clickedLink.hasClass( 'remove' ) && // check is WooCommerce remove link
							$clickedLink.parent( '.product-remove' ).length <= 0 && // check is WooCommerce remove link
							$clickedLink.parents( '.woocommerce-product-gallery__image' ).length <= 0 && // check is product gallery link
							typeof $clickedLink.data( 'rel' ) === 'undefined' && // check pretty photo link
							typeof $clickedLink.attr( 'rel' ) === 'undefined' && // check VC pretty photo link
							! $clickedLink.hasClass( 'lightbox-active' ) && // check is lightbox plugin active
							(typeof $clickedLink.attr( 'target' ) === 'undefined' || $clickedLink.attr( 'target' ) === '_self') && // check if the link opens in the same window
							$clickedLink.attr( 'href' ).split( '#' )[0] !== window.location.href.split( '#' )[0] // check if it is an anchor aiming for a different page
						) {
							e.preventDefault();

							$pageHolder.fadeOut(
								600,
								'easeOutSine',
								function () {
									window.location = $clickedLink.attr( 'href' );
								}
							);
						}
					}
				);
			}
		}
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.oraiste_core_button = {};

	$( document ).ready(
		function () {
			qodefButton.init();
		}
	);

	var qodefButton = {
		init: function () {
			this.buttons = $( '.qodef-button' );

			if ( this.buttons.length ) {
				this.buttons.each(
					function () {
						var $thisButton = $( this );

						qodefButton.buttonHoverColor( $thisButton );
						qodefButton.buttonHoverBgColor( $thisButton );
						qodefButton.buttonHoverBorderColor( $thisButton );
					}
				);
			}
		},
		buttonHoverColor: function ( $button ) {
			if ( typeof $button.data( 'hover-color' ) !== 'undefined' ) {
				var hoverColor    = $button.data( 'hover-color' );
				var originalColor = $button.css( 'color' );

				$button.on(
					'mouseenter touchstart',
					function () {
						qodefButton.changeColor( $button, 'color', hoverColor );
					}
				);
				$button.on(
					'mouseleave touchend',
					function () {
						qodefButton.changeColor( $button, 'color', originalColor );
					}
				);
			}
		},
		buttonHoverBgColor: function ( $button ) {
			if ( typeof $button.data( 'hover-background-color' ) !== 'undefined' ) {
				var hoverBackgroundColor    = $button.data( 'hover-background-color' );
				var originalBackgroundColor = $button.css( 'background-color' );

				$button.on(
					'mouseenter touchstart',
					function () {
						qodefButton.changeColor( $button, 'background-color', hoverBackgroundColor );
					}
				);
				$button.on(
					'mouseleave touchend',
					function () {
						qodefButton.changeColor( $button, 'background-color', originalBackgroundColor );
					}
				);
			}
		},
		buttonHoverBorderColor: function ( $button ) {
			if ( typeof $button.data( 'hover-border-color' ) !== 'undefined' ) {
				var hoverBorderColor    = $button.data( 'hover-border-color' );
				var originalBorderColor = $button.css( 'borderTopColor' );

				$button.on(
					'mouseenter touchstart',
					function () {
						qodefButton.changeColor( $button, 'border-color', hoverBorderColor );
					}
				);
				$button.on(
					'mouseleave touchend',
					function () {
						qodefButton.changeColor( $button, 'border-color', originalBorderColor );
					}
				);
			}
		},
		changeColor: function ( $button, cssProperty, color ) {
			$button.css( cssProperty, color );
		}
	};

	qodefCore.shortcodes.oraiste_core_button.qodefButton = qodefButton;

})( jQuery );

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.oraiste_core_google_map = {};

	$( document ).ready(
		function () {
			qodefGoogleMap.init();
		}
	);

	var qodefGoogleMap = {
		init: function () {
			this.holder = $( '.qodef-google-map' );

			if ( this.holder.length ) {
				this.holder.each(
					function () {
						if ( typeof window.qodefGoogleMap !== 'undefined' ) {
							window.qodefGoogleMap.init( $( this ).find( '.qodef-m-map' ) );
						}
					}
				);
			}
		}
	};

	qodefCore.shortcodes.oraiste_core_google_map.qodefGoogleMap = qodefGoogleMap;

})( jQuery );

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.oraiste_core_icon = {};

	$( document ).ready(
		function () {
			qodefIcon.init();
		}
	);

	var qodefIcon = {
		init: function () {
			this.icons = $( '.qodef-icon-holder' );

			if ( this.icons.length ) {
				this.icons.each(
					function () {
						var $thisIcon = $( this );

						qodefIcon.iconHoverColor( $thisIcon );
						qodefIcon.iconHoverBgColor( $thisIcon );
						qodefIcon.iconHoverBorderColor( $thisIcon );
					}
				);
			}
		},
		iconHoverColor: function ( $iconHolder ) {
			if ( typeof $iconHolder.data( 'hover-color' ) !== 'undefined' ) {
				var spanHolder    = $iconHolder.find( 'span' );
				var originalColor = spanHolder.css( 'color' );
				var hoverColor    = $iconHolder.data( 'hover-color' );

				$iconHolder.on(
					'mouseenter',
					function () {
						qodefIcon.changeColor(
							spanHolder,
							'color',
							hoverColor
						);
					}
				);
				$iconHolder.on(
					'mouseleave',
					function () {
						qodefIcon.changeColor(
							spanHolder,
							'color',
							originalColor
						);
					}
				);
			}
		},
		iconHoverBgColor: function ( $iconHolder ) {
			if ( typeof $iconHolder.data( 'hover-background-color' ) !== 'undefined' ) {
				var hoverBackgroundColor    = $iconHolder.data( 'hover-background-color' );
				var originalBackgroundColor = $iconHolder.css( 'background-color' );

				$iconHolder.on(
					'mouseenter',
					function () {
						qodefIcon.changeColor(
							$iconHolder,
							'background-color',
							hoverBackgroundColor
						);
					}
				);
				$iconHolder.on(
					'mouseleave',
					function () {
						qodefIcon.changeColor(
							$iconHolder,
							'background-color',
							originalBackgroundColor
						);
					}
				);
			}
		},
		iconHoverBorderColor: function ( $iconHolder ) {
			if ( typeof $iconHolder.data( 'hover-border-color' ) !== 'undefined' ) {
				var hoverBorderColor    = $iconHolder.data( 'hover-border-color' );
				var originalBorderColor = $iconHolder.css( 'borderTopColor' );

				$iconHolder.on(
					'mouseenter',
					function () {
						qodefIcon.changeColor(
							$iconHolder,
							'border-color',
							hoverBorderColor
						);
					}
				);
				$iconHolder.on(
					'mouseleave',
					function () {
						qodefIcon.changeColor(
							$iconHolder,
							'border-color',
							originalBorderColor
						);
					}
				);
			}
		},
		changeColor: function ( iconElement, cssProperty, color ) {
			iconElement.css(
				cssProperty,
				color
			);
		}
	};

	qodefCore.shortcodes.oraiste_core_icon.qodefIcon = qodefIcon;

})( jQuery );

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.oraiste_core_image_gallery                    = {};
	qodefCore.shortcodes.oraiste_core_image_gallery.qodefSwiper        = qodef.qodefSwiper;
	qodefCore.shortcodes.oraiste_core_image_gallery.qodefMasonryLayout = qodef.qodefMasonryLayout;

})( jQuery );

(function ($) {
	'use strict';

	qodefCore.shortcodes.oraiste_core_image_with_text = {};

	$(document).ready(function () {
		qodefScrollingImageWithText.init();
	});

	var qodefScrollingImageWithText = {
		init: function () {
			var $holder = $('.qodef-image-with-text.qodef-image-action--scrolling-image');

			if ($holder.length) {
				$holder.each(function () {
					var $thisHolder = $(this),
						$imageHolder = $thisHolder.find('.qodef-m-image-inner-holder'),
						$scrollingImage = $thisHolder.find('.qodef-m-image img'),
						$scrollingFrame = $thisHolder.find('.qodef-m-iwt-frame'),
						horizontal = $thisHolder.hasClass('qodef-scrolling-direction--horizontal'),
						state;

					var initAnimation = function () {
						state = qodefScrollingImageWithText.sizing($scrollingImage, $scrollingFrame, horizontal);
						qodefScrollingImageWithText.scrollAnimation($imageHolder, $scrollingImage, state);
					}

					$thisHolder.waitForImages(function () {
						initAnimation();
					});

					$(window).resize(function () {
						initAnimation();
					});
				});
			}
		},
		sizing: function ($scrollingImage, $scrollingFrame, horizontal) {
			var scrollingFrameHeight = $scrollingFrame.height(),
				scrollingImageHeight = $scrollingImage.height(),
				scrollingFrameWidth = $scrollingFrame.width(),
				scrollingImageWidth = $scrollingImage.width(),
				delta,
				timing,
				scrollable = false;

			if (horizontal) {
				delta = Math.round(scrollingImageWidth - scrollingFrameWidth);
				timing = Math.round(scrollingImageWidth / scrollingFrameWidth) * 2;
			} else {
				delta = Math.round(scrollingImageHeight - scrollingFrameHeight);
				timing = Math.round(scrollingImageHeight / scrollingFrameHeight) * 1.7;
			}

			if (horizontal) {
				if (scrollingImageWidth > scrollingFrameWidth) {
					scrollable = true;
				}
			} else {
				if (scrollingImageHeight > scrollingFrameHeight) {
					scrollable = true;
				}
			}

			return {
				delta: delta,
				timing: timing,
				scrollable: scrollable,
				horizontal: horizontal
			}
		},
		scrollAnimation: function ($thisHolder, $scrollingImage, state) {
			//scroll animation on hover
			$thisHolder.mouseenter(function () {
				$scrollingImage.css('transition-duration', state.timing + 's'); //transition duration set in relation to image height
				if (state.horizontal) {
					$scrollingImage.css('transform', 'translate3d(-' + state.delta + 'px, 0px, 0px)');
				} else {
					$scrollingImage.css('transform', 'translate3d(0px, -' + state.delta + 'px, 0px)');
				}
			});

			//scroll animation reset
			$thisHolder.mouseleave(function () {
				if (state.scrollable) {
					$scrollingImage.css('transition-duration', Math.min(state.timing / 3, 3) + 's');
					$scrollingImage.css('transform', 'translate3d(0px, 0px, 0px)');
				}
			});
		}
	};

	qodefCore.shortcodes.oraiste_core_image_with_text.qodefScrollingImageWithText = qodefScrollingImageWithText;
	qodefCore.shortcodes.oraiste_core_image_with_text.qodefMagnificPopup = qodef.qodefMagnificPopup;
	qodefCore.shortcodes.oraiste_core_image_with_text.qodefAppearElementsReady = qodef.qodefAppearElementsReady;

})(jQuery);

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

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.oraiste_core_video_button                    = {};
	qodefCore.shortcodes.oraiste_core_video_button.qodefMagnificPopup = qodef.qodefMagnificPopup;

})( jQuery );

(function ( $ ) {
	'use strict';

	var shortcode = 'oraiste_core_blog_list';

	qodefCore.shortcodes[shortcode] = {};

	if ( typeof qodefCore.listShortcodesScripts === 'object' ) {
		$.each(
			qodefCore.listShortcodesScripts,
			function ( key, value ) {
				qodefCore.shortcodes[shortcode][key] = value;
			}
		);
	}

	qodefCore.shortcodes[shortcode].qodefResizeIframes = qodef.qodefResizeIframes;
	qodefCore.shortcodes[shortcode].qodefAppearElementsReady = qodef.qodefAppearElementsReady;

})( jQuery );

(function ($) {
	"use strict";

	$(document).ready(function () {
		qodefSwitchNavMenu.init();
	});

	/**
	 * Function object that represents switch menu area.
	 * @returns {{init: Function}}
	 */
	var qodefSwitchNavMenu = {
		calcDropdown            : function ($switchMenuObject) {
			var $menu = $switchMenuObject.find('.qodef-header-switch-navigation'),
				$dropdowns = $menu.find('.qodef-drop-down-second').children().children('.sub-menu'),
				top = 0;

			if ($dropdowns.length) {
				$dropdowns.each(function () {
					var $thisDropdown = $(this),
						$subMenu = $thisDropdown.find('.sub-menu'),
						$items = $thisDropdown.children().children('a'),
						maxWidth = 0,
						translation = 0;

					top = $thisDropdown.parent().offset().top - $menu.offset().top;

					$items.each(
						function () {
							var $this = $(this);

							// 300 is max width of parent holder
							if (300 <= $this.width()) {
								// $this.addClass('qodef-wider');
								maxWidth = 300;
							} else if (maxWidth < $this.width()) {
								maxWidth = $this.width();
							}
						}
					);

					translation = $thisDropdown.parent().width() - maxWidth;

					$thisDropdown.css({
						'top'      : -top,
						'width'    : maxWidth,
						'transform': 'translateX(' + translation + 'px)'
					});

					$thisDropdown.append('<li class="qodef-menu--back"><a href="#"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 19 9" style="enable-background:new 0 0 19 9;" xml:space="preserve"><line x1="0.7" y1="4.5" x2="18.8" y2="4.5"/><polyline points="4.6,8.4 0.7,4.4 4.6,0.6 "/></svg></a></li>');

					if ($subMenu.length) {
						$subMenu.each(function () {
							var $thisSub = $(this),
								$items = $thisSub.children().children('a'),
								maxWidth = 0,
								translation = 0;

							top = $thisSub.parent().offset().top - $menu.offset().top;

							$items.each(
								function () {
									var $this = $(this);

									//300 is max width of parent holder
									if (300 <= $this.width()) {
										$this.addClass('qodef-wider');
										maxWidth = 300;

									} else if (maxWidth < $this.width()) {
										maxWidth = $this.width();
									}
								}
							);

							translation = $thisSub.parent().width() - maxWidth;

							$thisSub.css({
								'top'      : -top,
								'width'    : maxWidth,
								'transform': 'translateX(' + translation + 'px)'
							});

							$thisSub.append('<li class="qodef-menu--back"><a href="#"><svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 19 9" style="enable-background:new 0 0 19 9;" xml:space="preserve"><line x1="0.7" y1="4.5" x2="18.8" y2="4.5"/><polyline points="4.6,8.4 0.7,4.4 4.6,0.6 "/></svg></a></li>');
						});
					}
				});
			}

		},
		dropdownClickToggle     : function ($switchMenuObject) {
			var $menuItems = $switchMenuObject.find('.qodef-header-switch-navigation ul li.menu-item-has-children'),
				$backItems = $switchMenuObject.find('.qodef-menu--back');

			$menuItems.each(function () {
				var $menuItem = $(this),
					$dropdownOpener = $(this).find('> a');

				$dropdownOpener.on('click tap', function (e) {
					e.preventDefault();
					e.stopPropagation();

					$menuItem.siblings().addClass('qodef-menu-sibling--open');
					$menuItem.addClass('qodef-menu-item--open');
				});
			});

			$backItems.each(function () {
				var $backItem = $(this),
					$dropdownClose = $backItem.find('a'),
					$parentMenuItem = $backItem.closest('.menu-item-has-children');

				$dropdownClose.on('click tap', function (e) {
					e.preventDefault();
					e.stopPropagation();

					$parentMenuItem.siblings().removeClass('qodef-menu-sibling--open');
					$parentMenuItem.removeClass('qodef-menu-item--open');
				});
			})
		},
		initNavigationAreaScroll: function ($switchNavigation) {
			if (typeof qodefCore.qodefPerfectScrollbar === 'object') {
				qodefCore.qodefPerfectScrollbar.init($switchNavigation);
			}
		},
		init                    : function () {
			var $switchMenuObject = $('.qodef-header--switch #qodef-page-header');

			if ($switchMenuObject.length) {
				qodefSwitchNavMenu.calcDropdown($switchMenuObject);
				qodefSwitchNavMenu.dropdownClickToggle($switchMenuObject);
				qodefSwitchNavMenu.initNavigationAreaScroll($switchMenuObject.find('.qodef-header-switch-navigation'));
			}
		}
	};

})(jQuery);

(function ($) {
	'use strict';

	$(document).ready(
		function () {
			qodefVerticalSlidingNavMenu.init();
		}
	);

	/**
	 * Function object that represents vertical menu area.
	 * @returns {{init: Function}}
	 */
	var qodefVerticalSlidingNavMenu = {
		openedScroll: 0,

		initNavigation                  : function ($verticalSlidingMenuObject) {
			var $verticalSlidingNavObject = $verticalSlidingMenuObject.find('.qodef-header-vertical-sliding-navigation');

			qodefVerticalSlidingNavMenu.dropdownClickToggle($verticalSlidingNavObject);
		},
		dropdownClickToggle             : function ($verticalSlidingNavObject) {
			var $menuItems = $verticalSlidingNavObject.find('ul li.menu-item-has-children');

			$menuItems.each(
				function () {
					var $elementToExpand = $(this).find(' > .qodef-drop-down-second, > ul');
					var menuItem = this;
					var $dropdownOpener = $(this).find('> a');
					var slideUpSpeed = 'fast';
					var slideDownSpeed = 'fast';

					$dropdownOpener.on(
						'click tap',
						function (e) {
							e.preventDefault();
							e.stopPropagation();

							if ($elementToExpand.is(':visible')) {
								$(menuItem).removeClass('qodef-menu-item--open');
								$elementToExpand.slideUp(slideUpSpeed);
							} else if ($dropdownOpener.parent().parent().children().hasClass('qodef-menu-item--open') && $dropdownOpener.parent().parent().parent().hasClass('qodef-vertical-menu')) {
								$(this).parent().parent().children().removeClass('qodef-menu-item--open');
								$(this).parent().parent().children().find(' > .qodef-drop-down-second').slideUp(slideUpSpeed);

								$(menuItem).addClass('qodef-menu-item--open');
								$elementToExpand.slideDown(slideDownSpeed);
							} else {

								if (!$(this).parents('li').hasClass('qodef-menu-item--open')) {
									$menuItems.removeClass('qodef-menu-item--open');
									$menuItems.find(' > .qodef-drop-down-second, > ul').slideUp(slideUpSpeed);
								}

								if ($(this).parent().parent().children().hasClass('qodef-menu-item--open')) {
									$(this).parent().parent().children().removeClass('qodef-menu-item--open');
									$(this).parent().parent().children().find(' > .qodef-drop-down-second, > ul').slideUp(slideUpSpeed);
								}

								$(menuItem).addClass('qodef-menu-item--open');
								$elementToExpand.slideDown(slideDownSpeed);
							}
						}
					);
				}
			);
		},
		verticalSlidingAreaScrollable   : function ($verticalSlidingMenuObject) {
			return $verticalSlidingMenuObject.hasClass('qodef-with-scroll');
		},
		initVerticalSlidingAreaScroll   : function ($verticalSlidingMenuObject) {
			if (qodefVerticalSlidingNavMenu.verticalSlidingAreaScrollable($verticalSlidingMenuObject) && typeof qodefCore.qodefPerfectScrollbar === 'object') {
				qodefCore.qodefPerfectScrollbar.init($verticalSlidingMenuObject);
			}
		},
		verticalSlidingAreaShowHide     : function ($verticalSlidingMenuObject) {
			var $verticalSlidingMenuOpener = $verticalSlidingMenuObject.find('.qodef-vertical-sliding-menu-opener');

			$verticalSlidingMenuOpener.on(
				'click',
				function (e) {
					e.preventDefault();

					if (!$verticalSlidingMenuObject.hasClass('qodef-vertical-sliding-menu--opened')) {
						$verticalSlidingMenuObject.addClass('qodef-vertical-sliding-menu--opened');
						qodefVerticalSlidingNavMenu.openedScroll = qodef.window.scrollTop();
					} else {
						$verticalSlidingMenuObject.removeClass('qodef-vertical-sliding-menu--opened');
					}
				}
			);
		},
		verticalSlidingAreaCloseOnScroll: function ($verticalSlidingMenuObject) {
			qodef.window.on(
				'scroll',
				function () {
					if ($verticalSlidingMenuObject.hasClass('qodef-vertical-sliding-menu--opened') && Math.abs(qodef.scroll - qodefVerticalSlidingNavMenu.openedScroll) > 400) {
						$verticalSlidingMenuObject.removeClass('qodef-vertical-sliding-menu--opened');
					}
				}
			);
		},
		init                            : function () {
			var $verticalSlidingMenuObject = $('.qodef-header--vertical-sliding #qodef-page-header');

			if ($verticalSlidingMenuObject.length) {
				qodefVerticalSlidingNavMenu.verticalSlidingAreaShowHide($verticalSlidingMenuObject);
				qodefVerticalSlidingNavMenu.verticalSlidingAreaCloseOnScroll($verticalSlidingMenuObject);
				qodefVerticalSlidingNavMenu.initNavigation($verticalSlidingMenuObject);
				qodefVerticalSlidingNavMenu.initVerticalSlidingAreaScroll($verticalSlidingMenuObject);
			}
		}
	};

})(jQuery);

(function ( $ ) {
	'use strict';

	var fixedHeaderAppearance = {
		showHideHeader: function ( $pageOuter, $header ) {
			if ( qodefCore.windowWidth > 1024 ) {
				if ( qodefCore.scroll <= 0 ) {
					qodefCore.body.removeClass( 'qodef-header--fixed-display' );
					$pageOuter.css( 'padding-top', '0' );
					$header.css( 'margin-top', '0' );
				} else {
					qodefCore.body.addClass( 'qodef-header--fixed-display' );
					$pageOuter.css( 'padding-top', parseInt( qodefGlobal.vars.headerHeight + qodefGlobal.vars.topAreaHeight ) + 'px' );
					$header.css( 'margin-top', parseInt( qodefGlobal.vars.topAreaHeight ) + 'px' );
				}
			}
		},
		init: function () {

			if ( ! qodefCore.body.hasClass( 'qodef-header--vertical' ) ) {
				var $pageOuter = $( '#qodef-page-outer' ),
					$header    = $( '#qodef-page-header' );

				fixedHeaderAppearance.showHideHeader( $pageOuter, $header );

				$( window ).scroll(
					function () {
						fixedHeaderAppearance.showHideHeader( $pageOuter, $header );
					}
				);

				$( window ).resize(
					function () {
						$pageOuter.css( 'padding-top', '0' );
						fixedHeaderAppearance.showHideHeader( $pageOuter, $header );
					}
				);
			}
		}
	};

	qodefCore.fixedHeaderAppearance = fixedHeaderAppearance.init;

})( jQuery );

(function ( $ ) {
	'use strict';

	var stickyHeaderAppearance = {
		header: '',
		docYScroll: 0,
		init: function () {
			var displayAmount = stickyHeaderAppearance.displayAmount();

			// Set variables
			stickyHeaderAppearance.header 	  = $( '.qodef-header-sticky' );
			stickyHeaderAppearance.docYScroll = $( document ).scrollTop();

			// Set sticky visibility
			stickyHeaderAppearance.setVisibility( displayAmount );

			$( window ).scroll(
				function () {
					stickyHeaderAppearance.setVisibility( displayAmount );
				}
			);
		},
		displayAmount: function () {
			if ( qodefGlobal.vars.qodefStickyHeaderScrollAmount !== 0 ) {
				return parseInt( qodefGlobal.vars.qodefStickyHeaderScrollAmount, 10 );
			} else {
				return parseInt( qodefGlobal.vars.headerHeight + qodefGlobal.vars.adminBarHeight, 10 );
			}
		},
		setVisibility: function ( displayAmount ) {
			var isStickyHidden = qodefCore.scroll < displayAmount;

			if ( stickyHeaderAppearance.header.hasClass( 'qodef-appearance--up' ) ) {
				var currentDocYScroll = $( document ).scrollTop();

				isStickyHidden = (currentDocYScroll > stickyHeaderAppearance.docYScroll && currentDocYScroll > displayAmount) || (currentDocYScroll < displayAmount);

				stickyHeaderAppearance.docYScroll = $( document ).scrollTop();
			}

			stickyHeaderAppearance.showHideHeader( isStickyHidden );
		},
		showHideHeader: function ( isStickyHidden ) {
			if ( isStickyHidden ) {
				qodefCore.body.removeClass( 'qodef-header--sticky-display' );
			} else {
				qodefCore.body.addClass( 'qodef-header--sticky-display' );
			}
		},
	};

	qodefCore.stickyHeaderAppearance = stickyHeaderAppearance.init;

})( jQuery );

(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefProgressBarSpinner.init();
		}
	);

	var qodefProgressBarSpinner = {
		percentNumber: 0,
		init: function () {
			this.holder = $( '#qodef-page-spinner.qodef-layout--progress-bar' );

			if ( this.holder.length ) {
				qodefProgressBarSpinner.animateSpinner( this.holder );
			}
		},
		animateSpinner: function ( $holder ) {

			var $numberHolder = $holder.find( '.qodef-m-spinner-number-label' ),
				$spinnerLine  = $holder.find( '.qodef-m-spinner-line-front' ),
				numberIntervalFastest,
				windowLoaded  = false;

			$spinnerLine.animate(
				{ 'width': '100%' },
				10000,
				'linear'
			);

			var numberInterval = setInterval(
				function () {
					qodefProgressBarSpinner.animatePercent( $numberHolder, qodefProgressBarSpinner.percentNumber );

					if ( windowLoaded ) {
						clearInterval( numberInterval );
					}
				},
				100
			);

			$( window ).on(
				'load',
				function () {
					windowLoaded = true;

					numberIntervalFastest = setInterval(
						function () {
							if ( qodefProgressBarSpinner.percentNumber >= 100 ) {
								clearInterval( numberIntervalFastest );
								$spinnerLine.stop().animate(
									{ 'width': '100%' },
									500
								);

								setTimeout(
									function () {
										$holder.addClass( 'qodef--finished' );

										setTimeout(
											function () {
												qodefProgressBarSpinner.fadeOutLoader( $holder );
											},
											1000
										);
									},
									600
								);
							} else {
								qodefProgressBarSpinner.animatePercent( $numberHolder, qodefProgressBarSpinner.percentNumber );
							}
						},
						6
					);
				}
			);
		},
		animatePercent: function ( $numberHolder, percentNumber ) {
			if ( percentNumber < 100 ) {
				percentNumber += 5;
				$numberHolder.text( percentNumber );

				qodefProgressBarSpinner.percentNumber = percentNumber;
			}
		},
		fadeOutLoader: function ( $holder, speed, delay, easing ) {
			speed = speed ? speed : 600;
			delay = delay ? delay : 0;
			easing = easing ? easing : 'swing';

			$holder.delay( delay ).fadeOut( speed, easing );

			$( window ).on(
				'bind',
				'pageshow',
				function ( event ) {
					if ( event.originalEvent.persisted ) {
						$holder.fadeOut( speed, easing );
					}
				}
			);
		}
	};

})( jQuery );

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.oraiste_core_instagram_list = {};

	$( document ).ready(
		function () {
			qodefInstagram.init();
		}
	);

	var qodefInstagram = {
		init: function () {
			this.holder = $( '.sbi.qodef-instagram-swiper-container' );

			if ( this.holder.length ) {
				this.holder.each(
					function () {
						var $thisHolder     = $( this ),
							sliderOptions   = $thisHolder.parent().attr( 'data-options' ),
							$instagramImage = $thisHolder.find( '.sbi_item.sbi_type_image' ),
							$imageHolder    = $thisHolder.find( '#sbi_images' );

						$thisHolder.attr( 'data-options', sliderOptions );

						$imageHolder.addClass( 'swiper-wrapper' );

						if ( $instagramImage.length ) {
							$instagramImage.each(
								function () {
									$( this ).addClass( 'qodef-e qodef-image-wrapper swiper-slide' );
								}
							);
						}

						if ( typeof qodef.qodefSwiper === 'object' ) {
							qodef.qodefSwiper.init( $thisHolder );
						}
					}
				);
			}
		},
	};

	qodefCore.shortcodes.oraiste_core_instagram_list.qodefInstagram = qodefInstagram;
	qodefCore.shortcodes.oraiste_core_instagram_list.qodefSwiper    = qodef.qodefSwiper;

})( jQuery );

(function ( $ ) {
	'use strict';

	/*
	 **	Re-init scripts on gallery loaded
	 */
	$( document ).on(
		'yith_wccl_product_gallery_loaded',
		function () {

			if ( typeof qodefCore.qodefWooMagnificPopup === 'function' ) {
				qodefCore.qodefWooMagnificPopup.init();
			}
		}
	);

})( jQuery );

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.oraiste_core_product_category_list                    = {};
	qodefCore.shortcodes.oraiste_core_product_category_list.qodefMasonryLayout = qodef.qodefMasonryLayout;
	qodefCore.shortcodes.oraiste_core_product_category_list.qodefSwiper        = qodef.qodefSwiper;

})( jQuery );

(function ( $ ) {
	'use strict';

	var shortcode = 'oraiste_core_product_list';

	qodefCore.shortcodes[shortcode] = {};

	if ( typeof qodefCore.listShortcodesScripts === 'object' ) {
		$.each(
			qodefCore.listShortcodesScripts,
			function ( key, value ) {
				qodefCore.shortcodes[shortcode][key] = value;
			}
		);
	}

})( jQuery );

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.oraiste_core_clients_list             = {};
	qodefCore.shortcodes.oraiste_core_clients_list.qodefSwiper = qodef.qodefSwiper;

})( jQuery );

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

(function ( $ ) {
	'use strict';

	var shortcode = 'oraiste_core_portfolio_list';

	qodefCore.shortcodes[shortcode] = {};

	if ( typeof qodefCore.listShortcodesScripts === 'object' ) {
		$.each(
			qodefCore.listShortcodesScripts,
			function ( key, value ) {
				qodefCore.shortcodes[shortcode][key] = value;
			}
		);
	}

	$( document ).ready(
		function () {
			qodefPortfolioList.init();
		}
	);

	var qodefPortfolioList = {
		init: function () {
			this.holder = $( '.qodef-portfolio-list.qodef-parallax-scroll' );

			if ( this.holder.length ) {
				this.holder.each(
					function () {
						qodefPortfolioList.initItem( $( this ) );
					}
				);
			}
		},
		initItem: function ( $holder ) {
			var items    = $holder.find( '.qodef-portfolio-list-item:nth-child(2n)' ),
				dY       = 22,
				itemsOdd = $holder.find( '.qodef-portfolio-list-item:nth-child(2n + 1)' ),
				dYOdd    = 13;

			var ease = function ( a, b, n ) {
				return (1 - n) * a + n * b;
			};

			var inView = function ( item ) {
				if ( window.scrollY + window.innerHeight > item.offset().top && window.scrollY < item.offset().top + item.outerHeight() ) {
					return true;
				}

				return false;
			};

			var itemsInView = function ( items ) {
				return items.filter( function () {
					return inView( $( this ) );
				} );
			};

			var move = function ( items, dY ) {
				items.each(
					function () {
						var item = $( this );

						item.data( 'y', 0 );
						item.data( 'c', Math.random() );
					}
				);

				function loop() {

					itemsInView( items ).each(
						function () {
							var item   = $( this );
							var deltaY = (item.offset().top - window.scrollY) / window.innerHeight - 1;

							item.data( 'y', ease( item.data( 'y' ), deltaY, item.data( 'c' ) * .1 ) );
							item.css( { 'transform': 'translate3d(0,' + (dY * item.data( 'y' )).toFixed( 2 ) + '%,0)', } );
						}
					);

					requestAnimationFrame( loop );
				}

				requestAnimationFrame( loop );
			};

			if ( itemsOdd.length && ! Modernizr.touch && qodefCore.windowWidth >= 680 ) {
				move( itemsOdd, dYOdd );
			}

			if ( items.length && ! Modernizr.touch && qodefCore.windowWidth >= 680 ) {
				move( items, dY	);
			}
		},
	};

	qodefCore.shortcodes.oraiste_core_portfolio_list.qodefPortfolioList = qodefPortfolioList;
	qodefCore.shortcodes.oraiste_core_portfolio_list.qodefPortfolioList.qodefAppearElementsReady = qodef.qodefAppearElementsReady ;

})( jQuery );

(function ($) {
	'use strict';

	qodefCore.shortcodes.oraiste_core_portfolio_list_fixed_layout = {};

	$( document ).ready(
		function () {
			qodefPortfolioListFixedLayout.init();
		}
	);

	$( window ).on(
		'elementor/frontend/init',
		function () {
			var isEditMode = Boolean( elementorFrontend.isEditMode() );

			if ( isEditMode ) {
				qodefPortfolioListFixedLayout.init();
			}
		}
	);

	$( window ).on(
		'resize',
		function () {
			qodefPortfolioListFixedLayout.init();
		}
	);

	var qodefPortfolioListFixedLayout = {
		init     : function () {
			this.holder = $( '.qodef-portfolio-list-fixed-layout' );

			if ( this.holder.length ) {
				this.holder.each(
					function () {
						var $thisHolder = $( this );

						qodefPortfolioListFixedLayout.setHeight( $thisHolder );
					}
				);
			}
		},
		setHeight: function ( $holder ) {
			var holderWidth = $holder.width(),
				ratio       = 1744 / 701,	// ratio from photoshop, shortcode width x item height
				$items      = $holder.find( 'article' );

			if ( $items.length ) {
				$items.each(
					function () {
						if ( qodef.windowWidth > 768 ) {
							$( this ).height( holderWidth / ratio );
						} else {
							$( this ).height( '' );
						}
					}
				);
			}
		}
	};

	qodefCore.shortcodes.oraiste_core_portfolio_list_fixed_layout.qodefPortfolioListFixedLayout = qodefPortfolioListFixedLayout;
	qodefCore.shortcodes.oraiste_core_portfolio_list_fixed_layout.qodefAppearElementsReady = qodef.qodefAppearElementsReady;

})( jQuery );

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

(function ( $ ) {
	'use strict';

	var shortcode = 'oraiste_core_team_list';

	qodefCore.shortcodes[shortcode] = {};

	if ( typeof qodefCore.listShortcodesScripts === 'object' ) {
		$.each(
			qodefCore.listShortcodesScripts,
			function ( key, value ) {
				qodefCore.shortcodes[shortcode][key] = value;
			}
		);
	}

})( jQuery );

(function ( $ ) {
	'use strict';

	qodefCore.shortcodes.oraiste_core_testimonials_list             = {};
	qodefCore.shortcodes.oraiste_core_testimonials_list.qodefSwiper = qodef.qodefSwiper;

})( jQuery );

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
(function ($) {
	"use strict";

	qodefCore.shortcodes.oraiste_core_portfolio_list = {};
	
	$(document).ready(function () {
		qodefTiltInfoBellow.init();
	});

	$(document).on(
		'oraiste_trigger_get_new_posts',
		function () {
			qodefTiltInfoBellow.init();
		}
	);

	var qodefTiltInfoBellow = {
		init: function () {
			var $gallery = $('.qodef-portfolio-list.qodef-hover-animation--tilt');

			if ($gallery.length) {
				$gallery.each(function () {
					var $this = $(this);

					$this.find('article .qodef-e-media-image').each(function () {
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

	qodefCore.shortcodes.oraiste_core_portfolio_list.qodefTiltInfoBellow = qodefTiltInfoBellow;
	
})(jQuery);
(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefInfoFollow.init();
		}
	);

	$( document ).on(
		'oraiste_trigger_get_new_posts',
		function () {
			qodefInfoFollow.init();
		}
	);

	var qodefInfoFollow = {
		init: function () {
			var $gallery = $( '.qodef-hover-animation--follow' );

			if ( $gallery.length ) {
				qodefCore.body.append( '<div class="qodef-follow-info-holder"><div class="qodef-follow-info-inner"><div class="qodef-follow-info"></div></div></div>' );

				var $followInfoHolder   = $( '.qodef-follow-info-holder' ),
					$followInfo = $followInfoHolder.find('.qodef-follow-info');

				$gallery.each(
					function () {
						$gallery.find( '.qodef-e-inner' ).each(
							function () {
								var $thisItem = $( this );

								//info element position
								$thisItem.on(
									'mousemove',
									function ( e ) {
										if ( e.clientX + 20 + $followInfoHolder.width() > qodefCore.windowWidth ) {
											$followInfoHolder.addClass( 'qodef-right' );
										} else {
											$followInfoHolder.removeClass( 'qodef-right' );
										}

										$followInfoHolder.css(
											{
												top: e.clientY + 20,
												left: e.clientX + 20,
											}
										);
									}
								);

								//show/hide info element
								$thisItem.on(
									'mouseenter',
									function () {
										var $thisContent = $( this ).find('.qodef-e-content');

										if ( $thisContent.length ){
											$followInfo.html( $thisContent.html() );
										}

										if ( ! $followInfoHolder.hasClass( 'qodef-is-active' ) ) {
											$followInfoHolder.addClass( 'qodef-is-active' );
										}
									}
								).on(
									'mouseleave',
									function () {
										if ( $followInfoHolder.hasClass( 'qodef-is-active' ) ) {
											$followInfoHolder.removeClass( 'qodef-is-active' );
										}
									}
								);
							}
						);
					}
				);
			}
		}
	};

	qodefCore.shortcodes.oraiste_core_portfolio_list.qodefInfoFollow = qodefInfoFollow;

})( jQuery );

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