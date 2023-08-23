<?php

class QodeFrameworkPageCustomizer extends QodeFrameworkPage {

	function __construct( $params ) {
		parent::__construct( $params );
	}

	function add_tab_element( $params ) {
		throw new BadMethodCallException();
	}

	function add_section_element( $params ) {
		throw new BadMethodCallException();
	}

	function add_row_element( $params ) {
		throw new BadMethodCallException();
	}

	function add_repeater_element( $params ) {
		throw new BadMethodCallException();
	}

	function add_field_element( $params ) {
		$params['type']          = 'customizer';
		$params['default_value'] = isset( $params['default_value'] ) ? $params['default_value'] : '';

		qode_framework_get_framework_root()->get_customizer_options()->set_option( $params['name'], $params['default_value'], $params['field_type'] );
		parent::add_field_element( $params );
	}

	function display_field_element( $panel, $wp_customize ) {
		$additional_params = array(
			'panel'        => $panel,
			'wp_customize' => $wp_customize,
		);

		foreach ( $this->get_children() as $name => $child ) {
			$child->params = array_merge( $child->params, $additional_params );

			$child->render();
		}
	}
}
