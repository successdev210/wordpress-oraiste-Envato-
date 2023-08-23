<?php

if ( ! class_exists( 'Oraiste_WooCommerce' ) ) {
	class Oraiste_WooCommerce {
		private static $instance;

		public function __construct() {

			if ( oraiste_is_installed( 'woocommerce' ) ) {
				// Include files
				$this->include_files();

				// Init
				add_action( 'before_woocommerce_init', array( $this, 'init' ) );
			}
		}

		public static function get_instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		function include_files() {
			// Include helper functions
			include_once ORAISTE_INC_ROOT_DIR . '/woocommerce/helper.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound

			// Include template helper functions
			include_once ORAISTE_INC_ROOT_DIR . '/woocommerce/template-functions.php'; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
		}

		function init() {
			// Adds theme supports
			add_theme_support( 'woocommerce' );

			// Disable default WooCommerce style
			add_filter( 'woocommerce_enqueue_styles', '__return_false' );

			// Enqueue 3rd party plugins script
			add_action( 'oraiste_action_before_main_js', array( $this, 'enqueue_assets' ) );

			// Unset default WooCommerce templates modules
			$this->unset_templates_modules();

			// Add new WooCommerce templates
			$this->add_templates();

			// Change default WooCommerce templates position
			$this->change_templates_position();

			// Override default WooCommerce templates
			$this->override_templates();

			// Set default WooCommerce product layout
			$this->set_default_layout();
		}

		function enqueue_assets() {
			// Enqueue plugin's 3rd party scripts (select2 is registered inside WooCommerce plugin)
			wp_enqueue_script( 'select2' );
		}

		function unset_templates_modules() {
			// Remove main shop holder
			remove_action( 'woocommerce_before_main_content', 'woocommerce_output_content_wrapper', 10 );
			remove_action( 'woocommerce_after_main_content', 'woocommerce_output_content_wrapper_end', 10 );

			// Remove breadcrumbs
			remove_action( 'woocommerce_before_main_content', 'woocommerce_breadcrumb', 20 );

			// Remove sidebar
			remove_action( 'woocommerce_sidebar', 'woocommerce_get_sidebar', 10 );

			// Remove product ratings on list
			remove_action( 'woocommerce_after_shop_loop_item_title', 'woocommerce_template_loop_rating', 5 );

			// Remove product link on list
			remove_action( 'woocommerce_before_shop_loop_item', 'woocommerce_template_loop_product_link_open', 10 );
			remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 5 );
		}

		function add_templates() {
			/**
			 * Global templates hooks
			 */

			// Add grid template holder around shop
			add_action( 'woocommerce_before_main_content', 'oraiste_add_main_woo_page_template_holder', 5 ); // permission 5 is set because oraiste_add_main_woo_page_holder hook is added on 10
			add_action( 'woocommerce_after_main_content', 'oraiste_add_main_woo_page_template_holder_end', 20 ); // permission 20 is set because oraiste_add_main_woo_page_holder_end hook is added on 10

			// Add main shop holder
			add_action( 'woocommerce_before_main_content', 'oraiste_add_main_woo_page_holder', 10 );
			add_action( 'woocommerce_after_main_content', 'oraiste_add_main_woo_page_holder_end', 10 );
			add_action( 'woocommerce_before_cart', 'oraiste_add_main_woo_page_holder', 5 ); // permission 5 is set just to holder be at the first place
			add_action( 'woocommerce_after_cart', 'oraiste_add_main_woo_page_holder_end', 20 ); // permission 20 is set just to holder be at the last place
			add_action( 'woocommerce_before_checkout_form', 'oraiste_add_main_woo_page_holder', 5 ); // permission 5 is set just to holder be at the first place
			add_action( 'woocommerce_after_checkout_form', 'oraiste_add_main_woo_page_holder_end', 20 ); // permission 20 is set just to holder be at the last place

			// Add additional tags around results and ordering
			add_action( 'woocommerce_before_shop_loop', 'oraiste_add_results_and_ordering_holder', 15 ); // permission 5 is set because wc_print_notices hook is added on 10
			add_action( 'woocommerce_before_shop_loop', 'oraiste_add_results_and_ordering_holder_end', 40 ); // permission 40 is set because woocommerce_catalog_ordering hook is added on 30

			// Add sidebar templates for shop page
			add_action( 'woocommerce_after_main_content', 'oraiste_add_main_woo_page_sidebar_holder', 15 ); // permission 15 is set because oraiste_add_main_woo_page_holder_end hook is added on 10

			// Override On sale template
			add_filter( 'woocommerce_sale_flash', 'oraiste_woo_set_sale_flash' );
			add_action( 'oraiste_core_action_woo_product_mark_info', 'oraiste_add_sale_flash_on_product', 10 ); // permission 10 is set because woocommerce_show_product_loop_sale_flash hook is added on 10

			// Add out of stock mark for product list item
			add_filter( 'woocommerce_before_single_product_summary', 'oraiste_add_out_of_stock_mark_on_product', 10 ); // permission 10 is set because woocommerce_show_product_sale_flash hook is added on 10
			add_action( 'woocommerce_before_shop_loop_item_title', 'oraiste_add_out_of_stock_mark_on_product', 10 ); // permission 10 is set because woocommerce_show_product_loop_sale_flash hook is added on 10
			add_action( 'oraiste_core_action_woo_product_mark_info', 'oraiste_add_out_of_stock_mark_on_product', 10 ); // permission 10 is set because woocommerce_show_product_loop_sale_flash hook is added on 10

			// Add new mark for product list item
			add_filter( 'woocommerce_before_single_product_summary', 'oraiste_add_new_mark_on_product', 10 ); // permission 10 is set because woocommerce_show_product_sale_flash hook is added on 10
			add_action( 'woocommerce_before_shop_loop_item_title', 'oraiste_add_new_mark_on_product', 10 ); // permission 10 is set because woocommerce_show_product_loop_sale_flash hook is added on 10
			add_action( 'oraiste_core_action_woo_product_mark_info', 'oraiste_add_new_mark_on_product', 10 ); // permission 10 is set because woocommerce_show_product_loop_sale_flash hook is added on 10

			/**
			 * Product single page templates hooks
			 */

			// Add additional tags around product image and content
			add_action( 'woocommerce_before_single_product_summary', 'oraiste_add_product_single_content_holder', 2 ); // permission 2 is set because oraiste_add_product_single_image_holder hook is added on 5
			add_action( 'woocommerce_after_single_product_summary', 'oraiste_add_product_single_content_holder_end', 5 ); // permission 5 is set because woocommerce_output_product_data_tabs hook is added on 10

			// Add additional tags around product list item image
			add_action( 'woocommerce_before_single_product_summary', 'oraiste_add_product_single_image_holder', 5 ); // permission 5 is set because woocommerce_show_product_sale_flash hook is added on 10
			add_action( 'woocommerce_before_single_product_summary', 'oraiste_add_product_single_image_holder_end', 30 ); // permission 30 is set because woocommerce_show_product_images hook is added on 20

			// Add social share template for product single page
			add_action( 'woocommerce_share', 'oraiste_woo_product_render_social_share_html' );

			// add additional tags around product single thumbnails
			add_action( 'woocommerce_product_thumbnails', 'oraiste_woo_single_thumbnail_images_wrapper', 5 );
			add_action( 'woocommerce_product_thumbnails', 'oraiste_woo_single_thumbnail_images_wrapper_end', 35 );
		}

		function change_templates_position() {
			// Add link around image for product list item
			add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_open', 29 ); // permission 29 is set because oraiste_add_product_list_item_holder_end hook is closed on 30
			add_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_product_link_close', 29 );
		}

		function override_templates() {

			// Disable page heading
			add_filter( 'woocommerce_show_page_title', 'oraiste_woo_disable_page_heading' );

			// Override product list holder
			add_filter( 'woocommerce_product_loop_start', 'oraiste_add_product_list_holder' );
			add_filter( 'woocommerce_product_loop_end', 'oraiste_add_product_list_holder_end' );

			// Override number of columns for main shop page
			add_filter( 'loop_shop_columns', 'oraiste_woo_product_list_columns' );

			// Override number of products per page
			add_filter( 'loop_shop_per_page', 'oraiste_woo_products_per_page' );

			// Override list pagination args
			add_filter( 'woocommerce_pagination_args', 'oraiste_woo_pagination_args' );

			// Override reviews pagination args
			add_filter( 'woocommerce_comment_pagination_args', 'oraiste_woo_pagination_args' );

			// Override product title
			remove_action( 'woocommerce_shop_loop_item_title', 'woocommerce_template_loop_product_title', 10 ); // permission 10 is default
			add_action( 'woocommerce_shop_loop_item_title', 'oraiste_woo_shop_loop_item_title', 10 );

			// Add product classes
			add_filter( 'post_class', 'oraiste_add_single_product_classes', 10, 3 );

			// Override product title
			remove_action( 'woocommerce_single_product_summary', 'woocommerce_template_single_title', 5 ); // permission 5 is default
			add_action( 'woocommerce_single_product_summary', 'oraiste_woo_template_single_title', 5 );

			// Override number of thumbnails for single product
			add_filter( 'woocommerce_product_thumbnails_columns', 'oraiste_woo_single_thumbnail_images_columns' );

			// Override thumbnails size for single product
			add_filter( 'woocommerce_gallery_thumbnail_size', 'oraiste_woo_single_thumbnail_images_size' );

			// Override related products args
			add_filter( 'woocommerce_output_related_products_args', 'oraiste_woo_single_related_product_list_columns' );

			// Override rating template
			add_filter( 'woocommerce_product_get_rating_html', 'oraiste_woo_product_get_rating_html', 10, 2 );

			// Override product search form template
			add_filter( 'get_product_search_form', 'oraiste_woo_get_product_search_form' );

			// Override product content widget template
			add_filter( 'wc_get_template', 'oraiste_woo_get_content_widget_product', 10, 2 );

			// Override quantity input template
			add_filter( 'wc_get_template', 'oraiste_woo_get_quantity_input', 10, 2 );

			// Override single product meta template
			add_filter( 'wc_get_template', 'oraiste_woo_get_single_product_meta', 10, 2 );
		}

		function set_default_layout() {

			// This code is copied from core plugin - product list shortcode - info below variation
			if ( ! oraiste_is_installed( 'core' ) ) {
				// Add additional tags around product list item
				add_action( 'woocommerce_before_shop_loop_item', 'oraiste_add_product_list_item_holder', 5 ); // permission 5 is set because woocommerce_template_loop_product_link_open hook is added on 10
				add_action( 'woocommerce_after_shop_loop_item', 'oraiste_add_product_list_item_holder_end', 30 ); // permission 30 is set because woocommerce_template_loop_add_to_cart hook is added on 10

				// Add additional tags around product list item image
				add_action( 'woocommerce_before_shop_loop_item_title', 'oraiste_add_product_list_item_image_holder', 5 ); // permission 5 is set because woocommerce_show_product_loop_sale_flash hook is added on 10
				add_action( 'woocommerce_before_shop_loop_item_title', 'oraiste_add_product_list_item_image_holder_end', 30 ); // permission 30 is set because woocommerce_template_loop_product_thumbnail hook is added on 10

				// Add additional tags around content inside product list item image
				add_action( 'woocommerce_before_shop_loop_item_title', 'oraiste_add_product_list_item_additional_image_holder', 15 ); // permission 15 is set because woocommerce_template_loop_product_thumbnail hook is added on 10
				add_action( 'woocommerce_before_shop_loop_item_title', 'oraiste_add_product_list_item_additional_image_holder_end', 25 ); // permission 25 is set because oraiste_add_product_list_item_image_holder_end hook is added on 30

				// Add additional tags around product list item content
				add_action( 'woocommerce_shop_loop_item_title', 'oraiste_add_product_list_item_content_holder', 5 ); // permission 5 is set because woocommerce_template_loop_product_title hook is added on 10
				add_action( 'woocommerce_after_shop_loop_item', 'oraiste_add_product_list_item_content_holder_end', 20 ); // permission 30 is set because woocommerce_template_loop_add_to_cart hook is added on 10

				// Change add to cart position on product list
				remove_action( 'woocommerce_after_shop_loop_item', 'woocommerce_template_loop_add_to_cart', 10 ); // permission 10 is default
				add_action( 'woocommerce_before_shop_loop_item_title', 'woocommerce_template_loop_add_to_cart', 20 ); // permission 20 is set because oraiste_add_product_list_item_additional_image_holder hook is added on 15
			}
		}
	}

	Oraiste_WooCommerce::get_instance();
}
