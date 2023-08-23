<?php

class QodeFrameworkTabMeta extends QodeFrameworkTab {

	public $scope;

	function __construct( $params ) {
		parent::__construct( $params );
	}

	function add_section_element( $params ) {

		if ( isset( $params['name'] ) && ! empty( $params['name'] ) ) {
			$params['type'] = 'front-end';
			$field          = new QodeFrameworkSectionMeta( $params );
			$this->add_child( $field );

			return $field;
		}

		return false;
	}

	function add_row_element( $params ) {

		if ( isset( $params['name'] ) && ! empty( $params['name'] ) ) {
			$params['type'] = 'front-end';
			$field          = new QodeFrameworkRowMeta( $params );
			$this->add_child( $field );

			return $field;
		}

		return false;
	}

	function add_repeater_element( $params ) {
		$params['type']          = 'meta-box';
		$params['default_value'] = isset( $params['default_value'] ) ? $params['default_value'] : '';
		qode_framework_get_framework_root()->get_meta_options()->set_option( $params['name'], $params['default_value'], 'repeater' );

		return parent::add_repeater_element( $params );
	}

	function add_field_element( $params ) {
		$params['type']          = 'meta-box';
		$params['default_value'] = isset( $params['default_value'] ) ? $params['default_value'] : '';
		qode_framework_get_framework_root()->get_meta_options()->set_option( $params['name'], $params['default_value'], $params['field_type'] );
		parent::add_field_element( $params );

		if ( 'iconpack' === $params['field_type'] ) {
			$icons_object     = qode_framework_icons();
			$icon_collections = $icons_object->get_icon_object_collection();

			foreach ( $icon_collections as $icon_collection_key => $icon_collection_value ) {
				$icon_name   = $icons_object->get_formatted_icon_field_name( $params['name'], $icon_collection_key, '-' );
				$params_icon = array(
					'type'       => 'meta-box',
					'name'       => $icon_name,
					'field_type' => 'icon',
					'title'      => $icon_collection_value->get_name(),
					'options'    => $icon_collection_value->get_icons(),
					'dependency' => array(
						'show' => array(
							$params['name'] => array(
								'values'        => $icon_collection_key,
								'default_value' => $params['default_value'],
							),
						),
					),
				);

				qode_framework_get_framework_root()->get_meta_options()->set_option( $icon_name, '', 'icon' );

				parent::add_field_element( $params_icon );
			}
		}
	}
}
