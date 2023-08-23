(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefFrontEndSave.init();
		}
	);

	var qodefFrontEndSave = {
		init: function () {
			this.holder = $( '.qodef-front-end-form' );

			if ( this.holder.length ) {
				this.holder.each(
					function () {
						qodefFrontEndSave.triggerFormSubmit( $( this ) );
					}
				);
			}
		},
		triggerFormSubmit: function ( $holder ) {
			$holder.on(
				'submit',
				function ( e ) {
					e.preventDefault();

					qodefFrontEndSave.triggerRequest( $holder );
				}
			);
		},
		triggerRequest: function ( $holder ) {
			$holder.addClass( 'qodef--loading' );

			var $btnText        = $holder.find( 'button.qodef-front-end-submit' ),
				updatingBtnText = $btnText.data( 'updating-text' ),
				updatedBtnText  = $btnText.data( 'updated-text' ),
				restRoute       = $btnText.data( 'rest-route' ),
				restNonce       = $btnText.data( 'rest-nonce' ),
				prevBtnText     = $btnText.html(),
				$gallery        = $holder.find( '.qodef-form-gallery-upload-hidden' ),
				$responseHolder = $holder.find( '.qodef-front-end-response' );

			$btnText.html( updatingBtnText );
			$responseHolder.removeClass( 'qodef--success qodef--error qodef--undefined' ).empty();

			var ajaxData = {
				'options': $holder.serialize()
			};

			$.ajax(
				{
					type: 'POST',
					data: ajaxData,
					url: qodeFramework.vars.restUrl + qodeFramework.vars[restRoute],
					beforeSend: function ( request ) {
						request.setRequestHeader(
							'X-WP-Nonce',
							qodeFramework.vars[restNonce]
						);
					},
					success: function ( response ) {
						$responseHolder.addClass( 'qodef--' + response.status ).html( response.message );

						if ( response.status === 'success' ) {
							$btnText.html( updatedBtnText );

							if ( response.redirect !== '' ) {
								window.location = response.redirect;
							}
						} else {
							$btnText.html( prevBtnText );
						}
					},
					complete: function () {
						$holder.removeClass( 'qodef--loading' );
					}
				}
			);

			return false;
		}
	};

})( jQuery );
