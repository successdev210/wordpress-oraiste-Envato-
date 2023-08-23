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
