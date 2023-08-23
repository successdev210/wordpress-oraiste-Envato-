<?php

abstract class QodeFrameworkFieldAttachmentType {

	public $type;
	public $field_type;
	public $name;
	public $default_value;
	public $title;
	public $description;
	public $options;
	public $args;
	public $params;
	public $post_id;
	public $form_fields;

	function __construct( $params ) {
		$this->type          = isset( $params['type'] ) ? $params['type'] : '';
		$this->field_type    = isset( $params['field_type'] ) ? $params['field_type'] : '';
		$this->name          = isset( $params['name'] ) ? $params['name'] : '';
		$this->default_value = isset( $params['default_value'] ) ? $params['default_value'] : '';
		$this->title         = isset( $params['title'] ) ? $params['title'] : '';
		$this->description   = isset( $params['description'] ) ? $params['description'] : '';
		$this->options       = isset( $params['options'] ) ? $params['options'] : array();
		$this->args          = isset( $params['args'] ) ? $params['args'] : array();
		$this->post_id       = isset( $params['post_id'] ) ? $params['post_id'] : '';
		$this->form_fields   = isset( $params['form_fields'] ) ? $params['form_fields'] : array();

		$value           = qode_framework_get_option_value( '', $this->type, $this->name, $this->default_value, $this->post_id );
		$params['value'] = $value;

		if ( ! empty( $this->post_id ) ) {
			$this->name = 'attachments[' . $this->post_id . '][' . $this->name . ']';
		}

		$this->form_fields['input'] = 'html';
		$this->form_fields['label'] = $this->title;
		$this->form_fields['helps'] = $this->description;

		$this->params = isset( $params ) ? $params : array();
		$this->render();

		return $this->form_fields;
	}

	abstract public function render();
}
