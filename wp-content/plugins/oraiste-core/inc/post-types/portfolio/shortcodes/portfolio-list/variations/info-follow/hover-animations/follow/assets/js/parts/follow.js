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
