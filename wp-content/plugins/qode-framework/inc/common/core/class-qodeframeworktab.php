<?php

abstract class QodeFrameworkTab implements QodeFrameworkTreeInterface, QodeFrameworkChildInterface {
	private $scope;
	private $type;
	private $name;
	private $title;
	private $description;
	private $icon;
	private $children;

	function __construct( $params ) {
		$this->scope       = isset( $params['scope'] ) ? $params['scope'] : '';
		$this->type        = isset( $params['type'] ) ? $params['type'] : '';
		$this->name        = isset( $params['name'] ) ? $params['name'] : '';
		$this->title       = isset( $params['title'] ) ? $params['title'] : '';
		$this->description = isset( $params['description'] ) ? $params['description'] : '';
		$this->icon        = isset( $params['icon'] ) ? $params ['icon'] : '';
		$this->children    = isset( $params['children'] ) ? $params['children'] : array();
	}

	public function get_scope() {
		return $this->scope;
	}

	public function get_type() {
		return $this->type;
	}

	public function get_name() {
		return $this->name;
	}

	public function get_title() {
		return $this->title;
	}

	public function get_description() {
		return $this->description;
	}

	public function get_icon() {
		return $this->icon;
	}

	public function get_children() {
		return $this->children;
	}

	public function has_children() {
		return count( $this->children ) > 0;
	}

	public function get_child( $key ) {
		return $this->children[ $key ];
	}

	public function add_child( QodeFrameworkChildInterface $field ) {
		$key                    = $field->get_name();
		$this->children[ $key ] = $field;
	}

	abstract function add_section_element( $params );

	abstract function add_row_element( $params );

	function add_repeater_element( $params ) {
		if ( isset( $params['name'] ) && ! empty( $params['name'] ) ) {
			$field = new QodeFrameworkFieldRepeater( $params );
			$this->add_child( $field );

			return $field;
		}

		return false;
	}

	function add_field_element( $params ) {

		if ( isset( $params['name'] ) && ! empty( $params['name'] ) ) {
			$field = new QodeFrameworkFieldMapper( $params );
			$this->add_child( $field );

			return $field;
		}

		return false;
	}

	function render() {
		$params['this_object'] = $this;

		qode_framework_template_part( QODE_FRAMEWORK_INC_PATH, 'common', 'templates/tab', '', $params );
	}
}
