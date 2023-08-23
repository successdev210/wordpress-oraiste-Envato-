<?php

class OraisteCore_Switch_Header extends OraisteCore_Header {
	private static $instance;

	public function __construct() {
		$this->set_layout( 'switch' );
		$this->default_header_height = 100; // header height w/o overflow menu

		parent::__construct();
	}

	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function enqueue_additional_assets() {
		wp_enqueue_style( 'perfect-scrollbar', ORAISTE_CORE_URL_PATH . 'assets/plugins/perfect-scrollbar/perfect-scrollbar.css', array() );
		wp_enqueue_script( 'perfect-scrollbar', ORAISTE_CORE_URL_PATH . 'assets/plugins/perfect-scrollbar/perfect-scrollbar.jquery.min.js', array( 'jquery' ), false, true );
	}
}
