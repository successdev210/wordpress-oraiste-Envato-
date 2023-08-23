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
