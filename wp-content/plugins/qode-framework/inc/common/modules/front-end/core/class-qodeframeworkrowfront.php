<?php

class QodeFrameworkRowFront extends QodeFrameworkRow {

	function __construct( $params ) {
		parent::__construct( $params );
	}

	function add_repeater_element( $params ) {
		$params['type'] = 'front-end';

		return parent::add_repeater_element( $params );
	}

	function add_field_element( $params ) {
		$params['type'] = 'front-end';

		parent::add_field_element( $params );
	}
}
