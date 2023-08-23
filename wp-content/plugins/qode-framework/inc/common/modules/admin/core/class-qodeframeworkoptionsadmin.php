<?php

class QodeFrameworkOptionsAdmin extends QodeFrameworkOptions {
	private $menu_name;
	private $options_name;
	private $menu_label;
	private $icon_path;
	private $code;

	public function __construct( $menu_name = QODE_FRAMEWORK_SLUG, $options_name = 'qode_framework_options', $params = array() ) {
		parent::__construct();

		$this->menu_name    = $menu_name;
		$this->options_name = $options_name;

		$this->menu_label = ! empty( $params['label'] ) ? $params['label'] : esc_html__( 'Qode Options', 'qode-framework' );
		$this->icon_path  = ! empty( $params['icon_path'] ) ? $params['icon_path'] : QODE_FRAMEWORK_INC_URL_PATH . '/common/modules/admin/assets/img/admin-logo-icon.png';
		$this->code       = isset( $params['code'] ) ? (bool) $params['code'] : true;

		add_action( 'init', array( $this, 'init_options' ), 11 );

		add_action( 'admin_menu', array( $this, 'framework_menu' ) );

		if ( ! empty( $this->get_code() ) ) {
			add_action( 'admin_bar_menu', array( $this, 'framework_admin_bar_menu' ), 999 ); /// 999 is set to be at the last place in admin bar

			add_action( 'wp_ajax_qode_framework_action_save_options_' . $this->get_options_name(), array( $this, 'save_options' ) );

			add_action( 'wp_ajax_qode_framework_action_reset_options_' . $this->get_options_name(), array( $this, 'reset_options' ) );
		}

		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_framework_options_scripts' ), 5 ); // 5 is set to be same permission as Gutenberg plugin have

		add_filter( 'admin_body_class', array( $this, 'add_admin_body_classes' ) );
	}

	public function get_menu_name() {
		return $this->menu_name;
	}

	public function get_options_name() {
		return $this->options_name;
	}

	public function get_menu_label() {
		return $this->menu_label;
	}

	public function get_icon_path() {
		return $this->icon_path;
	}

	public function get_code() {
		return $this->code;
	}

	function framework_menu() {

		do_action( 'qode_framework_action_before_options_map', $this->get_menu_name() );

		$child_elements = $this->get_child_elements();

		if ( ! empty( $child_elements ) ) {
			add_menu_page(
				$this->get_menu_label(),
				$this->get_menu_label(),
				'edit_theme_options',
				$this->get_menu_name(),
				array(
					$this,
					'render_options',
				),
				$this->get_icon_path(),
				1000
			);
		}

		do_action( 'qode_framework_action_after_options_map', $this->get_menu_name() );
	}

	function framework_admin_bar_menu( $wp_admin_bar ) {
		$menu_name = $this->get_menu_name();

		if ( current_user_can( 'edit_theme_options' ) && ! empty( $menu_name ) && ! is_admin() ) {
			$menu_id = esc_attr( str_replace( '_', '-', $menu_name ) . '-admin-bar-options' );

			$args = array(
				'id'    => $menu_id,
				'title' => sprintf( '<span class="ab-icon dashicons-before dashicons-admin-generic"></span> %s', esc_html( $this->get_menu_label() ) ),
				'href'  => esc_url( admin_url( 'admin.php?page=' . esc_attr( $menu_name ) ) ),
			);

			$wp_admin_bar->add_node( $args );
		}
	}

	function init_options() {

		do_action( 'qode_framework_action_before_options_init_' . $this->get_options_name(), $this->get_options_name() );

		if ( ! get_option( $this->get_options_name() ) ) {
			add_option( $this->get_options_name(), $this->get_options() );
		}

		$this->populate_options();

		do_action( 'qode_framework_action_after_options_init_' . $this->get_options_name(), $this->get_options_name() );
	}

	function populate_options() {

		do_action( 'qode_framework_action_before_options_populate', $this->get_options_name() );

		$db_options = get_option( $this->get_options_name() );

		if ( is_array( $db_options ) && ! empty( $db_options ) ) {
			$this->set_options( array_merge( $this->get_options(), get_option( $this->get_options_name() ) ) );
		}

		$this->register_options();

		do_action( 'qode_framework_action_after_options_populate', $this->get_options_name() );
	}

	function register_options() {

		do_action( 'qode_framework_action_before_options_registered', $this->get_options_name() );

		register_setting( $this->get_menu_label(), $this->get_options_name() );

		do_action( 'qode_framework_action_after_options_registered', $this->get_options_name() );
	}

	function save_options() {
		if ( current_user_can( 'edit_theme_options' ) ) {
			$_REQUEST = stripslashes_deep( $_REQUEST );

			unset( $_REQUEST['action'] );

			check_ajax_referer( 'qode_framework_ajax_save_nonce', 'qode_framework_ajax_save_nonce' );

			$options_name = $_REQUEST['options_name'];
			unset( $_REQUEST['options_name'] );

			if ( $options_name === $this->get_options_name() ) {

				do_action( 'qode_framework_action_before_framework_option_save', $this->get_options(), $_REQUEST );

				$this->set_options( array_merge( $this->get_options(), $_REQUEST ) );

				update_option( $this->get_options_name(), $this->get_options() );

				esc_html_e( 'Saved', 'qode-framework' );

				do_action( 'qode_framework_action_after_framework_option_save' );

			} else {
				esc_html_e( 'Wrong options trigger', 'qode-framework' );
			}

			die();
		}
	}

	function reset_options() {
		if ( current_user_can( 'edit_theme_options' ) ) {
			$_REQUEST = stripslashes_deep( $_REQUEST );

			unset( $_REQUEST['action'] );

			check_ajax_referer( 'qode_framework_ajax_save_nonce', 'qode_framework_ajax_save_nonce' );

			$options_name = $_REQUEST['options_name'];
			unset( $_REQUEST['options_name'] );

			if ( $options_name === $this->get_options_name() ) {

				delete_option( $this->get_options_name() );

				esc_html_e( 'Options reset to default', 'qode-framework' );

				do_action( 'qode_framework_action_after_framework_option_reset' );

			} else {
				esc_html_e( 'Wrong options trigger', 'qode-framework' );
			}

			die();
		}
	}

	function render_options() {
		$params                 = array();
		$params['options']      = $this;
		$params['options_name'] = $this->get_options_name();

		qode_framework_template_part( QODE_FRAMEWORK_INC_PATH, 'common', 'modules/admin/templates/holder', '', $params );
	}

	function render_navigation() {
		$params                 = array();
		$params['pages']        = $this->get_child_elements();
		$params['options_name'] = $this->get_options_name();
		$params['menu_label']   = $this->get_menu_label();
		$params['use_icons']    = false;

		qode_framework_template_part( QODE_FRAMEWORK_INC_PATH, 'common', 'modules/admin/templates/navigation', '', $params );
	}

	function render_content() {
		$params                 = array();
		$pages                  = $this->get_child_elements();
		$params['pages']        = $pages;
		$params['options_name'] = $this->get_options_name();

		qode_framework_template_part( QODE_FRAMEWORK_INC_PATH, 'common', 'modules/admin/templates/content', '', $params );
	}

	function enqueue_framework_options_scripts() {
		//check if page is options page
		if ( isset( $_GET['page'] ) && strpos( $_GET['page'], $this->get_menu_name() ) !== false ) {
			$this->enqueue_dashboard_framework_scripts();
		}
	}

	function add_admin_body_classes( $classes ) {
		if ( isset( $_GET['page'] ) && strpos( $_GET['page'], $this->get_menu_name() ) !== false ) {
			$classes = $classes . ' qodef-framework-admin';
			$classes = $classes . ' qodef-framework-admin-options';
		}

		if ( empty( $this->get_code() ) ) {
			$classes = $classes . ' qodef-framework-not-registered';
		}

		return $classes;
	}
}
