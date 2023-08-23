<?php

if ( ! class_exists( 'OraisteCore_WooCommerce_YITH_Quick_View' ) ) {
	class OraisteCore_WooCommerce_YITH_Quick_View {
		private static $instance;

		public function __construct() {

			if ( qode_framework_is_installed( 'yith-quick-view' ) ) {
				// Init
				add_action( 'after_setup_theme', array( $this, 'init' ) );
			}
		}

		/**
		 * @return OraisteCore_WooCommerce_YITH_Quick_View
		 */
		public static function get_instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		function init() {

			// Unset default templates modules
			$this->unset_templates_modules();

			// Change default templates position
			$this->change_templates_position();

			// Override default templates
			$this->override_templates();
		}

		function unset_templates_modules() {
			// Remove button element on shop pages
			remove_action( 'woocommerce_after_shop_loop_item', array( YITH_WCQV_Frontend(), 'yith_add_quick_view_button' ), 15 );
		}

		function change_templates_position() {
			// Add button element for shop pages
			add_action( 'oraiste_action_product_list_item_additional_image_content', array( YITH_WCQV_Frontend(), 'yith_add_quick_view_button' ) );
			add_action( 'oraiste_core_action_product_list_item_additional_image_content', array( YITH_WCQV_Frontend(), 'yith_add_quick_view_button' ) );
		}

		function override_templates() {

		}
	}

	OraisteCore_WooCommerce_YITH_Quick_View::get_instance();
}
