<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit; // Exit if accessed directly
}

if ( ! class_exists( 'Oraiste_Welcome_Page' ) ) {
	class Oraiste_Welcome_Page {
		private static $instance;

		/**
		 * get the instance of Oraiste_Welcome_Page
		 *
		 * @return self
		 */
		public static function get_instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;
		}

		private function __clone() {
		}

		private function __construct() {
			// theme activation hook
			add_action( 'after_switch_theme', array( $this, 'init_activation_hook' ) );

			// welcome page redirect on theme activation
			add_action( 'admin_init', array( $this, 'welcome_page_redirect' ) );

			// add welcome page into theme options
			add_action( 'admin_menu', array( $this, 'create_welcome_page' ), 12 );

			// enqueue theme welcome page scripts
			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_styles' ) );
		}

		/**
		 * Init hooks on theme activation
		 */
		function init_activation_hook() {
			if ( ! is_network_admin() ) {
				set_transient( '_oraiste_welcome_page_redirect', 1, 30 );
			}
		}

		/**
		 * Redirect to welcome page on theme activation
		 */
		function welcome_page_redirect() {
			// if no activation redirect, bail
			if ( ! get_transient( '_oraiste_welcome_page_redirect' ) ) {
				return;
			}

			// delete the redirect transient
			delete_transient( '_oraiste_welcome_page_redirect' );

			// if activating from network, or bulk, bail
			if ( is_network_admin() || isset( $_GET['activate-multi'] ) ) {
				return;
			}

			// redirect to welcome page
			wp_safe_redirect( add_query_arg( array( 'page' => 'oraiste_welcome_page' ), esc_url( admin_url( 'themes.php' ) ) ) );
			exit;
		}

		/**
		 * Add welcome page
		 */
		function create_welcome_page() {
			add_theme_page(
				esc_html__( 'About', 'oraiste' ),
				esc_html__( 'About', 'oraiste' ),
				current_user_can( 'edit_theme_options' ),
				'oraiste_welcome_page',
				array( $this, 'welcome_page_content' )
			);

			remove_submenu_page( 'themes.php', 'oraiste_welcome_page' );
		}

		/**
		 * Render welcome page content
		 */
		function welcome_page_content() {
			$params = array();

			$theme                       = wp_get_theme();
			$params['theme']             = $theme;
			$params['theme_name']        = esc_html( $theme->get( 'Name' ) );
			$params['theme_description'] = esc_html( $theme->get( 'Description' ) );
			$params['theme_version']     = $theme->get( 'Version' );
			$params['theme_screenshot']  = file_exists( ORAISTE_ROOT_DIR . '/screenshot.png' ) ? ORAISTE_ROOT . '/screenshot.png' : ORAISTE_ROOT . '/screenshot.jpg';

			oraiste_template_part( 'welcome', 'templates/welcome', '', $params );
		}

		/**
		 * Enqueue welcome page scripts
		 *
		 * @param string $hook
		 */
		function enqueue_styles( $hook ) {

			if ( 'appearance_page_oraiste_welcome_page' === $hook ) {
				wp_enqueue_style( 'oraiste-welcome-page-style', ORAISTE_INC_ROOT . '/welcome/assets/admin/css/welcome.min.css' );
			}
		}
	}

	Oraiste_Welcome_Page::get_instance();
}
