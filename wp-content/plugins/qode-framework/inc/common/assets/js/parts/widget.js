(function ( $ ) {
	'use strict';

	$( document ).ready(
		function () {
			qodefWidgetFields.initColorPicker();
			qodefWidgetFields.initIconPicker();
		}
	);

	$( document ).on(
		'widget-added widget-updated',
		function ( event, widget ) {
			qodefWidgetFields.initColorPicker( widget );
			qodefWidgetFields.initDependency( widget );
			qodefWidgetFields.initIconPicker( widget );
		}
	);

	var qodefWidgetFields = {
		initColorPicker: function ( $widget ) {
			var $colorPickerHolder = typeof $widget !== 'undefined' ? $widget.find( '.qodef-widget-field--color' ) : $( '#widgets-right .qodef-widget-field--color' );

			if ( $colorPickerHolder.length ) {
				qodefWidgetFields.initPickerField(
					$colorPickerHolder,
					$colorPickerHolder.find( '.qodef-color-field' )
				);
			}
		},
		initPickerField: function ( $holder, $field ) {
			if ( $field.length && $holder.find( '.wp-picker-container' ).length <= 0 ) {
				$field.wpColorPicker(
					{
						change: _.throttle(
							function () { // For Customizer
								$( this ).trigger( 'change' );
							},
							3000
						)
					}
				);
			}
		},
		initDependency: function ( $widget ) {
			var $dependency = $widget.find( '.widget-content .qodef-widget-field[data-option-name]' );

			if ( $dependency.length ) {
				qodef.qodefDependency.reinitWidget( $dependency );
			}
		},
		initIconPicker: function ( $widget ) {
			var $iconPickerHolder = typeof $widget !== 'undefined' ? $widget.find( '.qodef-widget-iconpicker-select:not(.qodef-select2):not(.qodef--icons-init)' ) : $( '#widgets-right .qodef-widget-iconpicker-select:not(.qodef-select2):not(.qodef--icons-init)' );

			if ( $iconPickerHolder.length && typeof $iconPickerHolder.fontIconPicker === 'function' ) {
				$iconPickerHolder.addClass( 'qodef--icons-init' );
				$iconPickerHolder.fontIconPicker();
			}
		}
	};

})( jQuery );
