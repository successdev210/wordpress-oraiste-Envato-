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
