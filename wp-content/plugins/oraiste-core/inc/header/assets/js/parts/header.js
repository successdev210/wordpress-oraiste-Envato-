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
