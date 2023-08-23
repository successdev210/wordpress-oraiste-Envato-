<?php

class QodeFrameworkFieldCustomizerSetting extends QodeFrameworkFieldCustomizerType {

	function __construct( $params ) {
		parent::__construct( $params );
	}

	public function render() {
		$sanitize_callback = false;

		if ( isset( $this->sanitize_callback ) ) {
			switch ( $this->sanitize_callback ) {
				case 'sanitize_checkbox':
					$sanitize_callback = $this->sanitize_checkbox( $this->params['value'] );
					break;
			}
		}

		$this->params['wp_customize']->add_setting(
			$this->name,
			array(
				'type'              => $this->option_type,
				'default'           => $this->default_value,
				'sanitize_callback' => $sanitize_callback,
			)
		);
	}

	/**
	 * Sanitize callback function for checkbox
	 *
	 * @param bool $checked
	 *
	 * @return boolean
	 */
	public function sanitize_checkbox( $checked ) {
		return ( isset( $checked ) && true === $checked );
	}
}
