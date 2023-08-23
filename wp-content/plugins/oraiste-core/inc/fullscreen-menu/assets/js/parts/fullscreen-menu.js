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
