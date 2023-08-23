(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefCustomSidebar.init();
		}
	);

	/**
	 * Init custom sidebar
	 */
	var qodefCustomSidebar = {
		init: function () {
			var $holder = $( '.qodef-custom-sidebar' );
			if ( $holder.length ) {
				qodefCustomSidebar.initForm( $holder );
				qodefCustomSidebar.addSidebar( $holder );
				qodefCustomSidebar.addRemoveButton();
				qodefCustomSidebar.deleteSidebar( $holder );
			}
		},
		initForm: function ( holder ) {
			var $widgetsHolder = $( '.widget-liquid-right' );

			if ( $widgetsHolder.length && holder.length ) {
				$widgetsHolder.append( holder );
				holder.addClass( 'qodef--init' );
			}
		},
		addSidebar: function ( holder ) {
			var $addButton = holder.find( '.qodef-custom-sidebar-button' );

			$addButton.on(
				'click',
				function ( e ) {
					e.preventDefault();

					var sidebarName     = holder.find( '.qodef-custom-sidebar-name' ),
						nonce           = holder.find( '#qode_framework_nonce_custom_sidebar' ),
						$responseHolder = holder.find( '.qodef-custom-sidebar-response' );

					// Empty element content if exist
					$responseHolder.empty();

					$.ajax(
						{
							type: 'POST',
							url: ajaxurl,
							data: {
								action: 'qode_framework_add_custom_sidebar',
								name: $.trim( sidebarName.val() ),
								nonce: nonce.val()
							},
							success: function ( data ) {
								var response = JSON.parse( data );
								sidebarName.val( '' );

								if ( response.status === 'success' ) {
									$responseHolder.fadeIn( 300 ).html( response.message );

									// Reinit widgets page
									window.location.href = response.redirect;
								} else {
									$responseHolder.fadeIn( 300 ).html( response.message );
								}

								setTimeout(
									function () {
										$responseHolder.fadeOut( 300 ).empty();
									},
									1000
								);
							}
						}
					);
				}
			);
		},
		deleteSidebar: function ( holder ) {
			var $widgetsArea  = $( '#widgets-right' ),
				$removeButton = $widgetsArea.find( '.qodef-custom-sidebar-remove' );

			$removeButton.on(
				'click',
				function ( e ) {
					var $widget      = $( e.currentTarget ).parents( '.widgets-holder-wrap:eq(0)' ),
						$sidebarName = $widget.find( '.sidebar-name h2' ),
						name         = $.trim( $sidebarName.text() ),
						nonce        = holder.find( '#qode_framework_nonce_custom_sidebar' );

					var confirm = window.confirm( 'Are you sure you want to delete ' + name + '?' );

					if ( confirm !== true ) {
						return false;
					}

					$.ajax(
						{
							type: 'POST',
							url: ajaxurl,
							data: {
								action: 'qode_framework_delete_custom_sidebar',
								name: name,
								nonce: nonce.val()
							},
							success: function ( data ) {
								var response = JSON.parse( data );

								if ( response.status === 'success' ) {
									$widget.slideUp(
										200,
										function () {
											// Delete all widgets inside custom sidebar area
											$(
												'.widget-control-remove',
												$widget
											).trigger( 'click' );

											$widget.remove();
											wpWidgets.saveOrder();
										}
									);
								} else {
									console.log( response.message );
								}
							}
						}
					);
				}
			);
		},
		addRemoveButton: function () {
			var $widgetsArea = $( '#widgets-right' );

			if ( $widgetsArea.length ) {
				$widgetsArea.find( '.sidebar-qodef-custom-sidebar' ).append( '<span class="qodef-custom-sidebar-remove"></span>' );
			}
		}
	};

})( jQuery );
