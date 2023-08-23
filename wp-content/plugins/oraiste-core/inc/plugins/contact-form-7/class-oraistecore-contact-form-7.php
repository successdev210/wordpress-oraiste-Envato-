<?php

if ( ! class_exists( 'OraisteCore_Contact_Form_7' ) ) {
	class OraisteCore_Contact_Form_7 {
		private static $instance;

		public function __construct() {

			if ( qode_framework_is_installed( 'contact_form_7' ) ) {
				// Init
				$this->init();
			}
		}

		/**
		 * @return OraisteCore_Contact_Form_7
		 */
		public static function get_instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		function init() {
			// Include helper functions
			include_once ORAISTE_CORE_PLUGINS_PATH . '/contact-form-7/helper.php';

			// Include template helper functions
			include_once ORAISTE_CORE_PLUGINS_PATH . '/contact-form-7/template-functions.php';

			// Include widgets
			add_action( 'qode_framework_action_before_widgets_register', array( $this, 'include_widgets' ) );

			// Override templates
			$this->override_templates();
		}

		function include_widgets() {
			foreach ( glob( ORAISTE_CORE_PLUGINS_PATH . '/contact-form-7/widgets/*/include.php' ) as $widget ) {
				include_once $widget;
			}
		}

		function override_templates() {
			// Replace cf7 submit button with our button
			remove_action( 'wpcf7_init', 'wpcf7_add_form_tag_submit' );
			add_action( 'wpcf7_init', 'oraiste_core_cf7_add_submit_form_tag' );
		}
	}

	OraisteCore_Contact_Form_7::get_instance();
}
