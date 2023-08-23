(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefIconAjax.init();
		}
	);

	var qodefIconAjax = {
		init: function () {
			var iconPackFields = $( '.qodef-icon-pack-field' );
			if ( iconPackFields.length ) {
				iconPackFields.each(
					function () {
						var $thisIconPack = $( this );
						var $thisIconPackField = $thisIconPack.find( 'select' );
						var $thisIconField = $thisIconPack.next( '.qodef-icon-field' ).find( 'select' );
						qodefIconAjax.initSelect(
							$thisIconPackField,
							$thisIconField
						);
						qodefIconAjax.initSelectChange(
							$thisIconPackField,
							$thisIconField
						);
					}
				);
			}
		},
		initSelect: function ( iconPackField, iconField ) {
			var chosenIconPack = iconPackField.data( 'selected' );
			qodefIconAjax.populateFields(
				chosenIconPack,
				iconPackField,
				iconField
			);
		},
		initSelectChange: function ( iconPackField, iconField ) {
			iconPackField.on(
				'change',
				function () {
					var chosenIconPack = $( this ).find( 'option:selected' ).val();
					qodefIconAjax.populateFields(
						chosenIconPack,
						iconPackField,
						iconField
					);
				}
			);
		},
		populateFields: function ( chosenIconPack, iconPackField, iconField ) {
			if ( chosenIconPack !== '' && chosenIconPack !== undefined ) {
				var data = {
					action: 'qode_framework_get_icon_pack_' + chosenIconPack
				};

				iconPackField.attr(
					'disabled',
					'disabled'
				);
				iconField.attr(
					'disabled',
					'disabled'
				);

				$.post(
					ajaxurl,
					data,
					function ( response ) {
						iconField.empty();
						iconField.html( response );
						iconPackField.removeAttr( 'disabled' );
						iconField.removeAttr( 'disabled' );
						qodefIconAjax.setIconPackValue( iconField );
					}
				);
			} else {
				iconField.empty();
			}
		},
		setIconPackValue: function ( iconField ) {
			var chosenIcon = iconField.data( 'selected' );
			iconField.val( chosenIcon );
		}
	};

})( jQuery );
