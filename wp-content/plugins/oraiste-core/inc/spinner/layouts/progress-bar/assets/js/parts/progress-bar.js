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
