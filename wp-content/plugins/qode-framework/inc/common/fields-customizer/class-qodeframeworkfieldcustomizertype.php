<?php

abstract class QodeFrameworkFieldCustomizerType {
	public $field_type;
	public $option_type;
	public $section;
	public $settings;
	public $type;
	public $name;
	public $priority;
	public $title;
	public $description;
	public $default_value;
	public $sanitize_callback;
	public $params;

	function __construct( $params ) {
		$this->field_type        = isset( $params['field_type'] ) ? $params['field_type'] : '';
		$this->option_type       = isset( $params['option_type'] ) ? $params['option_type'] : '';
		$this->section           = isset( $params['section'] ) ? $params['section'] : '';
		$this->settings          = isset( $params['settings'] ) ? $params['settings'] : '';
		$this->type              = isset( $params['type'] ) ? $params['type'] : '';
		$this->name              = isset( $params['name'] ) ? $params['name'] : '';
		$this->priority          = isset( $params['priority'] ) ? $params['priority'] : 10;
		$this->title             = isset( $params['title'] ) ? $params['title'] : '';
		$this->description       = isset( $params['description'] ) ? $params['description'] : '';
		$this->default_value     = isset( $params['default_value'] ) ? $params['default_value'] : '';
		$this->sanitize_callback = isset( $params['sanitize_callback'] ) ? $params['sanitize_callback'] : '';

		$value           = qode_framework_get_option_value( '', $this->type, $this->name, $this->default_value );
		$params['value'] = $value;

		$this->params = isset( $params ) ? $params : array();
		$this->render();
	}

	abstract public function render();
}
