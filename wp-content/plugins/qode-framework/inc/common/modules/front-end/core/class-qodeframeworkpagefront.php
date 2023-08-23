<?php

class QodeFrameworkPageFront extends QodeFrameworkPage {
	private $method;
	private $name;
	private $form_id;
	private $form_action;
	private $button_label;
	private $button_args;
	private $form_nonce_name;

	function __construct( $params ) {
		parent::__construct( $params );
		$this->method          = isset( $params['method'] ) ? $params['method'] : '';
		$this->name            = isset( $params['name'] ) ? $params['name'] : '';
		$this->form_id         = isset( $params['form_id'] ) ? $params['form_id'] : '';
		$this->form_action     = isset( $params['form_action'] ) ? $params['form_action'] : '';
		$this->button_label    = isset( $params['button_label'] ) ? $params['button_label'] : '';
		$this->button_args     = isset( $params['button_args'] ) ? $params['button_args'] : '';
		$this->form_nonce_name = $this->set_form_nonce_name( $params );
	}

	public function get_method() {
		return $this->method;
	}

	public function get_name() {
		return $this->name;
	}

	public function get_form_id() {
		return $this->form_id;
	}

	public function get_form_action() {
		return $this->form_action;
	}

	public function get_button_label() {
		return $this->button_label;
	}

	public function get_button_args() {
		return $this->button_args;
	}

	public function get_form_nonce_name() {
		return $this->form_nonce_name;
	}

	private function set_form_nonce_name( $params ) {
		$nonce_name = 'qode-framework-nonce-' . $this->get_slug() . '-' . get_current_user_id();
		if ( isset( $params['form_nonce_name'] ) && ! empty( $params['form_nonce_name'] ) ) {
			$nonce_name = $params['form_nonce_name'];
		}

		return $nonce_name;
	}

	function add_tab_element( $params ) {
		if ( isset( $params['name'] ) && ! empty( $params['name'] ) ) {
			$params['type'] = 'front-end';
			$field          = new QodeFrameworkTabFront( $params );
			$this->add_child( $field );

			return $field;
		}

		return false;
	}

	function add_section_element( $params ) {

		if ( isset( $params['name'] ) && ! empty( $params['name'] ) ) {
			$params['type'] = 'front-end';
			$field          = new QodeFrameworkSectionFront( $params );
			$this->add_child( $field );

			return $field;
		}

		return false;
	}

	function add_row_element( $params ) {

		if ( isset( $params['name'] ) && ! empty( $params['name'] ) ) {
			$params['type'] = 'front-end';
			$field          = new QodeFrameworkRowFront( $params );
			$this->add_child( $field );

			return $field;
		}

		return false;
	}

	function add_repeater_element( $params ) {
		$params['type'] = 'front-end';

		return parent::add_repeater_element( $params );
	}

	function add_field_element( $params ) {
		$params['type'] = 'front-end';

		parent::add_field_element( $params );
	}

	function load_page_assets() {
		wp_enqueue_media();
		qode_framework_options()->enqueue_dashboard_framework_scripts( array( 'main_style' => false ) );

		wp_enqueue_script( 'qode-framework-front-end', QODE_FRAMEWORK_INC_URL_PATH . '/common/modules/front-end/assets/js/front-end-options.js' );

		$global = apply_filters( 'qode_framework_filter_localize_main_js', array() );

		wp_localize_script(
			'qode-framework-front-end',
			'qodeFramework',
			array(
				'vars' => $global,
			)
		);
	}

	function render() {
		$params = array( 'page' => $this );
		qode_framework_template_part( QODE_FRAMEWORK_INC_PATH, 'common', 'modules/front-end/templates/holder', '', $params );

		$this->load_page_assets();
	}
}
