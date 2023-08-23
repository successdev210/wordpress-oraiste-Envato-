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
