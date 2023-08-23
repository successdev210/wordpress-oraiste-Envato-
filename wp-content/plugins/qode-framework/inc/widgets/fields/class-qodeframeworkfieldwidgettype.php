<?php

abstract class QodeFrameworkFieldWidgetType {

	public $widget;
	public $instance;
	public $type;
	public $field_type;
	public $name;
	public $default_value;
	public $title;
	public $description;
	public $options;
	public $args;
	public $params;

	function __construct( $params ) {
		$this->widget        = isset( $params['widget'] ) ? $params['widget'] : null;
		$this->instance      = isset( $params['instance'] ) ? $params['instance'] : array();
		$this->type          = isset( $params['type'] ) ? $params['type'] : '';
		$this->field_type    = isset( $params['field_type'] ) ? $params['field_type'] : '';
		$this->name          = isset( $params['name'] ) ? $params['name'] : '';
		$this->default_value = isset( $params['default_value'] ) ? $params['default_value'] : '';
		$this->title         = isset( $params['title'] ) ? $params['title'] : '';
		$this->description   = isset( $params['description'] ) ? $params['description'] : '';
		$this->options       = isset( $params['options'] ) ? $params['options'] : array();
		$this->args          = isset( $params['args'] ) ? $params['args'] : array();

		$value           = ! empty( $this->instance ) && isset( $this->instance[ $this->name ] ) ? esc_attr( $this->instance[ $this->name ] ) : '';
		$value           = ! empty( $value ) ? $value : $this->default_value;
		$params['value'] = $value;

		$id           = ! is_null( $this->widget ) ? $this->widget->get_field_id( $this->name ) : '';
		$params['id'] = $id;

		$name                   = ! is_null( $this->widget ) ? $this->widget->get_field_name( $this->name ) : '';
		$params['name']         = $name;
		$params['default_name'] = $this->name;

		$this->params = isset( $params ) ? $params : array();
		$this->load_assets();
		$this->render();
	}

	public function load_assets() {
		do_action( 'qode_framework_action_field_widget_type_load_assets', $this->field_type );
	}

	abstract public function render();
}
