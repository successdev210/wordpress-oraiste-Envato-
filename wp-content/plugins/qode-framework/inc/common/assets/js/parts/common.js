(function ( $ ) {
	'use strict';

	if ( typeof qodef !== 'object' ) {
		window.qodef = {};
	}

	$( document ).ready(
		function () {
			qodefTabs.init();
			qodefDependency.init();
			qodefRepeater.init();
		}
	);

	var qodefTabs = {
		init: function () {
			this.holder = $( '.qodef-tab-wrapper' );

			if ( this.holder.length ) {
				this.holder.each(
					function () {
						qodefTabs.initTabs( $( this ) );
					}
				);
			}
		},
		initTabs: function ( tabs ) {
			tabs.children( '.qodef-tab-item-content' ).each(
				function ( index ) {
					index = index + 1;

					var $that    = $( this ),
						link     = $that.attr( 'id' ),
						$navItem = $that.parent().find( '.qodef-tab-item-nav-wrapper li:nth-child(' + index + ') a' ),
						navLink  = $navItem.attr( 'href' );

					link = '#' + link;

					if ( link.indexOf( navLink ) > -1 ) {
						$navItem.attr( 'href', link );
					}
				}
			);

			tabs.addClass( 'qodef--init' ).tabs(
				{
					activate: function () {
						// This peace of code is required in order to re init maps for address field type when it's inside tabs layout
						if ( typeof qodef.qodefAddressFields === 'object' ) {
							qodef.qodefAddressFields.init( true );
						}
					}
				}
			);
		}
	};

	var qodefDependency = {
		init: function () {
			qodefDependency.initOptions();
			qodefDependency.initMenu();
			qodefDependency.initWidget();
		},
		initOptions: function ( ) {
			var $dependencyOptions = $( '.qodef-field-content .qodef-field[data-option-name]' );

			if ( $dependencyOptions.length ) {
				qodefDependency.initFields( $dependencyOptions );
			}
		},
		initMenu: function () {
			var $dependencyOptions = $( '#update-nav-menu .qodef-menu-item-field[data-option-name]' );

			if ( $dependencyOptions.length ) {
				qodefDependency.initFields( $dependencyOptions );
			}
		},
		initWidget: function () {
			var $dependencyOptions = $( '#widgets-right .widget-content .qodef-widget-field[data-option-name]' );

			if ( $dependencyOptions.length ) {
				$dependencyOptions.each(
					function () {
						var $option = $( this );

						qodefDependency.initField( $option );
					}
				);
			}
		},
		reinitRepeater: function () {
			var $dependencyOptions = $( '.qodef-repeater-fields-holder .qodef-field-content .qodef-field[data-option-name]' );

			if ( $dependencyOptions.length ) {
				$dependencyOptions.each(
					function () {
						var $thisOption    = $( this );
						var thisOptionType = $thisOption.data( 'option-type' );

						switch (thisOptionType) {
							case 'selectbox':
								qodefDependency.qodefSelectBoxDependencyRepeater( $thisOption );
								break;
							case 'radiogroup':
								qodefDependency.qodefRadioGroupDependencyRepeater( $thisOption );
								break;
						}
						qodefDependency.initField( $thisOption );
					}
				);
			}
		},
		reinitWidget: function ( widgetDependencyFields ) {
			qodefDependency.initFields( widgetDependencyFields );
		},
		initFields: function ( fields ) {
			fields.each(
				function () {
					var $thisOption = $( this );

					if ( $thisOption.parents( '.qodef-repeater-template' ).length <= 0 ) {
						qodefDependency.initField( $thisOption );
					}
				}
			);
		},
		initField: function ( $thisOption ) {
			var thisOptionType = $thisOption.data( 'option-type' );

			if ( ! $thisOption.hasClass( 'qodef-dependency-option' ) ) {
				$thisOption.addClass( 'qodef-dependency-option' );

				switch (thisOptionType) {
					case 'selectbox':
						qodefDependency.qodefSelectBoxDependency( $thisOption );
						break;
					case 'radiogroup':
						qodefDependency.qodefRadioGroupDependency( $thisOption );
						break;
					case 'yesno':
						qodefDependency.qodefRadioGroupDependency( $thisOption );
						break;
				}
			}
		},
		qodefSelectBoxDependency: function ( option ) {
			option.on(
				'change',
				function () {
					var optionValue = $( this ).val();
					qodefDependency.qodefDependencyActionInit(
						option,
						optionValue
					);
				}
			);
			option.trigger( 'change' );
		},
		qodefSelectBoxDependencyRepeater: function ( option ) {
			var repeaterOptionValue = option.val();
			qodefDependency.qodefDependencyActionInit(
				option,
				repeaterOptionValue
			);
		},
		qodefRadioGroupDependency: function ( option ) {
			var optionName = option.data( 'option-name' ),
				radioItem  = option.find( 'input[name=' + optionName + ']' );
			radioItem.on(
				'change',
				function () {
					var optionValue = this.value;
					qodefDependency.qodefDependencyActionInit(
						option,
						optionValue
					);
				}
			);
			qodefDependency.qodefDependencyActionInit(
				option,
				option.find( 'input[name=' + option.data( 'option-name' ) + ']:checked' ).val()
			);
		},
		qodefRadioGroupDependencyRepeater: function ( option ) {
			var optionName          = option.data( 'option-name' ),
				radioItem           = option.find( 'input[name=' + optionName + ']' ),
				repeaterOptionValue = radioItem.value;
			qodefDependency.qodefDependencyActionInit(
				option,
				repeaterOptionValue
			);
		},
		qodefDependencyActionInit: function ( option, optionValue ) {
			var dependencyHolder = $( '.qodef-dependency-holder' ),
				optionName       = option.data( 'option-name' );

			if ( dependencyHolder.length && optionName !== undefined && optionName !== '' && optionValue !== undefined ) {
				dependencyHolder.each(
					function () {
						var $thisHolder   = $( this ),
							showDataItems = $thisHolder.data( 'show' ),
							hideDataItems = $thisHolder.data( 'hide' );

						if ( showDataItems !== '' && showDataItems !== undefined ) {
							if ( qodefDependency.qodefGetNumberOfItems( showDataItems ) > 1 ) {
								qodefDependency.qodefMultipleDependencyLogic(
									showDataItems,
									$thisHolder,
									optionName,
									optionValue,
									true
								);
							} else {
								qodefDependency.qodefSingleDependencyLogic(
									showDataItems,
									$thisHolder,
									optionName,
									optionValue,
									true
								);
							}
						}

						if ( hideDataItems !== '' && hideDataItems !== undefined ) {
							if ( qodefDependency.qodefGetNumberOfItems( hideDataItems ) > 1 ) {
								qodefDependency.qodefMultipleDependencyLogic(
									hideDataItems,
									$thisHolder,
									optionName,
									optionValue,
									false
								);
							} else {
								qodefDependency.qodefSingleDependencyLogic(
									hideDataItems,
									$thisHolder,
									optionName,
									optionValue,
									false
								);
							}
						}
					}
				);
			}
		},
		qodefGetNumberOfItems: function ( items ) {
			var numberOfItems = 0;

			for ( var item in items ) {
				if ( items.hasOwnProperty( item ) ) {
					++numberOfItems;
				}
			}

			return numberOfItems;
		},
		qodefMultipleDependencyLogic: function ( dataItems, holder, optionName, optionValue, show ) {
			var flag           = [],
				itemVisibility = true;

			$.each(
				dataItems,
				function ( key, value ) {
					value = value.split( ',' );

					if ( optionName === key ) {
						if ( value.indexOf( optionValue ) !== -1 ) {
							flag.push( true );
						} else {
							flag.push( false );
						}
					} else {
						var otherOptionName = $( '.qodef-dependency-option[data-option-name="' + key + '"]' ),
							otherOptionType = otherOptionName.data( 'option-type' ),
							otherValue      = '';

						switch (otherOptionType) {
							case 'checkbox':
								otherValue = otherOptionName.find( 'input[type="hidden"][name="' + key + '"]' ).val();
								break;
							case 'selectbox':
								otherValue = otherOptionName.val();
								break;
							case 'radiogroup':
								otherValue = otherOptionName.find( 'input[name="' + key + '"]' ).val();
								break;
						}

						if ( otherValue.length && value.indexOf( otherValue ) !== -1 ) {
							flag.push( true );
						} else {
							flag.push( false );
						}
					}
				}
			);

			for ( var f in flag ) {
				if ( ! flag[f] ) {
					itemVisibility = false;
				}
			}

			if ( show ) {
				if ( itemVisibility ) {
					holder.fadeIn( 200 );
				} else {
					holder.fadeOut( 200 );
				}
			} else {
				if ( itemVisibility ) {
					holder.fadeOut( 200 );
				} else {
					holder.fadeIn( 200 );
				}
			}
		},
		qodefSingleDependencyLogic: function ( dataItems, holder, optionName, optionValue, show ) {
			$.each(
				dataItems,
				function ( key, value ) {
					if ( optionName === key ) {
						value = value.split( ',' );

						if ( show ) {
							if ( value.indexOf( optionValue ) !== -1 ) {
								// holder.fadeIn(200);
								holder.removeClass( 'qodef-hide-dependency-holder' );
								holder.addClass( 'qodef-show-dependency-holder' ); //for search options manipulation
							} else {
								//holder.fadeOut(200);
								holder.addClass( 'qodef-hide-dependency-holder' );
								holder.removeClass( 'qodef-show-dependency-holder' ); //for search options manipulation
							}
						} else {
							if ( value.indexOf( optionValue ) !== -1 ) {
								//holder.fadeOut(200);
								holder.addClass( 'qodef-hide-dependency-holder' );
								holder.removeClass( 'qodef-show-dependency-holder' ); //for search options manipulation
							} else {
								//holder.fadeIn(200);
								holder.removeClass( 'qodef-hide-dependency-holder' );
								holder.addClass( 'qodef-show-dependency-holder' ); //for search options manipulation
							}
						}
					}
				}
			);
		}
	};

	qodef.qodefDependency = qodefDependency;

	var qodefRepeater = {
		init: function () {
			qodefRepeater.initRepeater();
			qodefRepeater.initRepeaterInner();
		},
		initRepeater: function () {
			var repeaterHolder = $( '.qodef-repeater-wrapper' );

			if ( repeaterHolder.length ) {
				repeaterHolder.each(
					function () {
						var $thisHolder = $( this );
						qodefRepeater.qodefAddNewRow( $thisHolder );
						qodefRepeater.qodefRemoveRow( $thisHolder );
						qodefRepeater.qodefInitSortable( $thisHolder );
					}
				);
			}
		},
		initRepeaterInner: function () {
			var repeaterInnerHolder = $( '.qodef-repeater-inner-wrapper' );

			if ( repeaterInnerHolder.length ) {
				repeaterInnerHolder.each(
					function () {
						var $thisHolder = $( this );
						qodefRepeater.qodefAddNewRowInner( $thisHolder );
						qodefRepeater.qodefRemoveRowInner( $thisHolder );
						qodefRepeater.qodefInitSortableInner( $thisHolder );
					}
				);
			}
		},
		qodefGetNumberOfRows: function ( holder ) {
			return holder.find( '.qodef-repeater-fields-holder' ).length;
		},
		qodefInitSortable: function ( holder ) {
			if ( holder.find( '.qodef-repeater-wrapper-main.sortable' ).length ) {
				$( '.qodef-repeater-wrapper-main.sortable' ).sortable(
					{
						placeholder: 'qodef-placeholder',
						forcePlaceholderSize: true
					}
				);
			}
			qodefRepeater.qodefInitSortableInner( holder );
		},
		qodefInitSortableInner: function ( holder ) {
			if ( holder.find( '.qodef-repeater-inner-wrapper-main.sortable' ).length ) {
				$( '.qodef-repeater-inner-wrapper-main.sortable' ).sortable(
					{
						placeholder: 'qodef-placeholder',
						forcePlaceholderSize: true
					}
				);
			}
		},
		qodefAddNewRow: function ( holder ) {
			var $addButton       = holder.find( '.qodef-repeater-add a' );
			var templateName     = holder.find( '.qodef-repeater-wrapper-main' ).data( 'template' );
			var $repeaterContent = holder.find( '.qodef-repeater-wrapper-main' );
			var repeaterTemplate = wp.template( 'qodef-repeater-template-' + templateName );

			$addButton.on(
				'click',
				function ( e ) {
					e.preventDefault();
					e.stopPropagation();

					var $row = $(
						repeaterTemplate(
							{
								rowIndex: qodefRepeater.qodefGetNumberOfRows( holder ) || 0
							}
						)
					);

					$repeaterContent.append( $row );
					var innerHolder = $row.find( '.qodef-repeater-inner-wrapper' );
					qodefRepeater.qodefAddNewRowInner( innerHolder );
					qodefRepeater.qodefRemoveRowInner( innerHolder );
					qodefRepeater.qodefInitSortable( holder );
					qodefDependency.reinitRepeater();

					$( document ).trigger(
						'qodef_add_new_row_trigger',
						$row.find( '.qodef-repeater-fields' )
					);
				}
			);
		},
		qodefRemoveRow: function ( holder ) {
			var repeaterContent = holder.find( '.qodef-repeater-wrapper-main' );

			repeaterContent.on(
				'click',
				'.qodef-clone-remove',
				function ( e ) {
					e.preventDefault();
					e.stopPropagation();

					if ( ! window.confirm( 'Are you sure you want to remove this section?' ) ) {
						return;
					}

					var $rowParent = $( this ).parents( '.qodef-repeater-fields-holder' );
					$rowParent.remove();
				}
			);
		},
		qodefAddNewRowInner: function ( holder ) {
			var $addInnerButton   = holder.find( '.qodef-repeater-inner-add a' ),
				templateInnerName = holder.find( '.qodef-repeater-inner-wrapper-main' ).data( 'template' ),
				rowInnerTemplate  = wp.template( 'qodef-repeater-inner-template-' + templateInnerName );

			$addInnerButton.on(
				'click',
				function ( e ) {
					e.preventDefault();
					e.stopPropagation();

					var $clickedButton    = $( this ),
						$parentRow        = $clickedButton.parents( '.qodef-repeater-fields-holder' ).first(),
						parentIndex       = $parentRow.data( 'index' ),
						$rowInnerContent  = $clickedButton.parent().parent().prev(),
						lastRowInnerIndex = $parentRow.find( '.qodef-repeater-inner-fields-holder' ).length;

					var $repeaterInnerRow = $(
						rowInnerTemplate(
							{
								rowIndex: parentIndex,
								rowInnerIndex: lastRowInnerIndex
							}
						)
					);

					$rowInnerContent.append( $repeaterInnerRow );
					qodefRepeater.qodefInitSortableInner( holder );
					qodefDependency.reinitRepeater();
				}
			);
		},
		qodefRemoveRowInner: function ( holder ) {
			var repeaterInnerContent = holder.find( '.qodef-repeater-inner-wrapper-main' );

			repeaterInnerContent.on(
				'click',
				'.qodef-clone-inner-remove',
				function ( e ) {
					e.preventDefault();
					e.stopPropagation();

					if ( ! confirm( 'Are you sure you want to remove section?' ) ) {
						return;
					}

					var $removeButton = $( this );
					var $parent       = $removeButton.parents( '.qodef-repeater-inner-fields-holder' );

					$parent.remove();
				}
			);
		}
	};

})( jQuery );
