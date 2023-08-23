<?php

if ( ! class_exists( 'OraisteCore_Dashboard_Rest_API' ) ) {
	/**
	 * Rest API class with configuration
	 */
	class OraisteCore_Dashboard_Rest_API {
		private static $instance;
		private $namespace;
		private $route;

		public function __construct() {
			// Init variables
			$this->set_namespace( 'qode-api/v1' );
			$this->set_route( 'dashboard' );

			// Localize theme's main js script with rest variable
			add_filter( 'oraiste_core_filter_dashboard_js_global_variables', array( $this, 'localize_script' ) );

			// Function that register Rest API routes
			add_action( 'rest_api_init', array( $this, 'register_rest_api_route' ) );
		}

		/**
		 * @return OraisteCore_Dashboard_Rest_API
		 */
		public static function get_instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		public function get_namespace() {
			return $this->namespace;
		}

		public function set_namespace( $namespace ) {
			$this->namespace = $namespace;
		}

		public function get_route() {
			return $this->route;
		}

		public function set_route( $route ) {
			$this->route = $route;
		}

		function localize_script( $global ) {
			$global['restUrl']   = esc_url_raw( rest_url() );
			$global['restRoute'] = esc_attr( $this->get_namespace() . '/' . $this->get_route() );
			$global['restNonce'] = wp_create_nonce( 'wp_rest' );

			return $global;
		}

		function register_rest_api_route() {
		}
	}

	OraisteCore_Dashboard_Rest_API::get_instance();
}
