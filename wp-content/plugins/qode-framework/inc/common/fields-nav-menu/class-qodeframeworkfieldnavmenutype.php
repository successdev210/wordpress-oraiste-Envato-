<?php

abstract class QodeFrameworkFieldNavMenuType {
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

		$this->type          = isset( $params['type'] ) ? $params['type'] : '';
		$this->field_type    = isset( $params['field_type'] ) ? $params['field_type'] : '';
		$this->name          = isset( $params['name'] ) ? $params['name'] : '';
		$this->default_value = isset( $params['default_value'] ) ? $params['default_value'] : '';
		$this->title         = isset( $params['title'] ) ? $params['title'] : '';
		$this->description   = isset( $params['description'] ) ? $params['description'] : '';
		$this->options       = isset( $params['options'] ) ? $params['options'] : array();
		$this->dependency    = isset( $params['dependency'] ) ? $params['dependency'] : array();
		$this->args          = isset( $params['args'] ) ? $params['args'] : array();
		$this->post_id        = isset( $params['post_id'] ) ? $params['post_id'] : '';

		$value           = qode_framework_get_option_value( '', $this->type, $this->name, $this->default_value, $this->post_id );
		$class           = array();
		$dependency_data = array();

		$params['value']      = $value;
		$params['key']        = sprintf( 'menu-item-%s', $this->name );
		$params['id']         = sprintf( 'edit-%s-%s', $params['key'], $this->post_id );
		$params['field_name'] = sprintf( '%s[%s]', $params['key'], $this->post_id );
		$class[]              = sprintf( 'field-%s', $this->name );
		$params['width']      = sprintf( 'field-%s', $this->name );

		$params['width'] = 'wide';
		if ( isset( $this->args['width'] ) && '' !== $this->args['width'] ) {
			$params['width'] = $this->args['width'];
		}

		if ( ! empty( $this->dependency ) ) {
			$class[] = 'qodef-dependency-holder';

			if ( array_key_exists( 'show', $this->dependency ) ) {
				$new_dependency = array();
				foreach ( $this->dependency['show'] as $key => $value ) {
					$value['option_name']   = $key;
					$key                    = sprintf( 'menu-item-%s[%s]', $key, $this->post_id );
					$new_dependency[ $key ] = $value;
				}
				$this->dependency['show'] = $new_dependency;
			}
			if ( array_key_exists( 'hide', $this->dependency ) ) {
				$new_dependency = array();
				foreach ( $this->dependency['hide'] as $key => $value ) {
					$value['option_name']   = $key;
					$key                    = sprintf( 'menu-item-%s[%s]', $key, $this->post_id );
					$new_dependency[ $key ] = $value;
				}
				$this->dependency['hide'] = $new_dependency;
			}

			$show = array_key_exists( 'show', $this->dependency ) ? qode_framework_return_menu_dependency_options_array( $this->dependency['show'], true, $this->post_id ) : array();
			$hide = array_key_exists( 'hide', $this->dependency ) ? qode_framework_return_menu_dependency_options_array( $this->dependency['hide'], false, $this->post_id ) : array();

			$class[]         = qode_framework_return_dependency_classes( $show, $hide );
			$dependency_data = qode_framework_return_dependency_data( $show, $hide );
		}

		$params['class']           = implode( ' ', $class );
		$params['dependency_data'] = $dependency_data;

		$this->params = isset( $params ) ? $params : array();

		$this->render();
	}

	abstract public function render();
}
