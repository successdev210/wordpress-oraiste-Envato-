<?php

if ( ! class_exists( 'OraisteCore_Dashboard' ) ) {
	class OraisteCore_Dashboard {

		private static $instance;

		private $sub_pages = [];

		private $validation_url = 'https://api.qodeinteractive.com/purchase-code-validation.php';

		public $licence_field = 'oraiste_purchase_info';

		public $import_field = 'oraiste_import_params';


		function __construct() {
			// Order of hooks is important, dashboard_add_page method needs to be at the end
			add_action( 'admin_menu', [ &$this, 'register_sub_pages' ] );
			add_action( 'wp_enqueue_scripts', [ &$this, 'enqueue_styles' ] );
			add_action( 'admin_menu', [ &$this, 'dashboard_add_page' ] );

			add_action( 'oraiste_core_action_on_deactivation', [ &$this, 'remove_redirect' ] );

			if ( 'yes' === get_option( 'oraiste_core_activated_first_time' ) ) {
				add_action( 'oraiste_core_action_plugin_loaded', [ &$this, 'page_welcome_redirect' ] );
			}

			add_action( 'after_setup_theme', [ $this, 'load_files' ] );

		}//end __construct()


		/**
		 * @return OraisteCore_Dashboard
		 */
		public static function get_instance() {
			if ( is_null( self::$instance ) ) {
				self::$instance = new self();
			}

			return self::$instance;

		}//end get_instance()


		public function set_sub_pages( OraisteCore_Dashboard_Sub_Page $sub_page ) {
			$this->sub_pages[$sub_page->get_base()] = $sub_page;

		}//end set_sub_pages()


		function get_sub_pages() {
			return $this->sub_pages;

		}//end get_sub_pages()


		function load_files() {
			include_once ORAISTE_CORE_INC_PATH . '/core-dashboard/rest/include.php';
			include_once ORAISTE_CORE_INC_PATH . '/core-dashboard/class-oraistecore-dashboard-registration.php';
			include_once ORAISTE_CORE_INC_PATH . '/core-dashboard/class-oraistecore-dashboard-theme-validation.php';
			include_once ORAISTE_CORE_INC_PATH . '/core-dashboard/sub-pages/class-oraistecore-dashboard-sub-page.php';

			foreach ( glob( ORAISTE_CORE_INC_PATH . '/core-dashboard/sub-pages/*/include.php' ) as $subpages ) {
				include_once $subpages;
			}

		}//end load_files()


		function dashboard_add_page() {
			$page = add_menu_page(
				esc_html__( 'Oraiste Dashboard', 'oraiste-core' ),
				esc_html__( 'Oraiste Dashboard', 'oraiste-core' ),
				'administrator',
				'oraiste_core_dashboard',
				[
					&$this,
					'load_dashboard_template',
				],
				ORAISTE_CORE_INC_URL_PATH . '/core-dashboard/assets/img/admin-logo-icon.png',
				998
			);

			add_action( 'load-' . $page, [ &$this, 'load_admin_css' ] );

			foreach ( $this->get_sub_pages() as $sub_page => $sub_page_value ) {
				$sub_page_instance = add_submenu_page(
					'oraiste_core_dashboard',
					$sub_page_value->get_title(),
					$sub_page_value->get_title(),
					'administrator',
					$sub_page,
					[
						$sub_page_value,
						'render',
					]
				);

				add_action( 'load-' . $sub_page_instance, [ &$this, 'load_admin_css' ] );
			}

		}//end dashboard_add_page()


		function load_dashboard_template() {
			$params                 = [];
			$params['theme_name']   = qode_framework_is_installed( 'theme' ) ? esc_html( wp_get_theme()->get( 'Name' ) ) : esc_html__( 'Qode Interactive', 'oraiste-core' );
			$params['system_info']  = OraisteCore_Dashboard_System_Info_Page::get_instance()->get_system_info();
			$params['info']         = $this->purchased_code_info();
			$params['is_activated'] = ! empty( $this->get_purchased_code() );

			oraiste_core_template_part( 'core-dashboard', 'templates/core-dashboard', '', $params );

		}//end load_dashboard_template()


		public function register_sub_pages() {
			$sub_pages = apply_filters( 'oraiste_core_filter_add_welcome_sub_page', $icons = [] );

			if ( ! empty( $sub_pages ) ) {
				foreach ( $sub_pages as $sub_page ) {
					$this->set_sub_pages( new $sub_page() );
				}
			}

		}//end register_sub_pages()


		function load_admin_css() {
			add_action( 'admin_enqueue_scripts', [ &$this, 'enqueue_styles' ] );
			add_action( 'admin_enqueue_scripts', [ &$this, 'enqueue_scripts' ] );

		}//end load_admin_css()


		function enqueue_styles() {
			wp_enqueue_style( 'select2', QODE_FRAMEWORK_INC_URL_PATH . '/common/assets/plugins/select2/select2.min.css' );
			wp_enqueue_style( 'oraiste-core-dashboard-style', ORAISTE_CORE_INC_URL_PATH . '/core-dashboard/assets/css/core-dashboard.min.css' );

		}//end enqueue_styles()


		function enqueue_scripts() {
			wp_enqueue_script( 'select2', QODE_FRAMEWORK_INC_URL_PATH . '/common/assets/plugins/select2/select2.full.min.js', [], false, true );
			wp_enqueue_script( 'oraiste-core-dashboard-script', ORAISTE_CORE_INC_URL_PATH . '/core-dashboard/assets/js/modules/core-dashboard.js', [], false, true );
			$global_variables = apply_filters( 'oraiste_core_filter_dashboard_js_global_variables', [] );

			wp_localize_script(
				'oraiste-core-dashboard-script',
				'qodefCoreDashboardGlobalVars',
				[ 'vars' => $global_variables ]
			);

		}//end enqueue_scripts()


		function remove_redirect() {
			delete_transient( 'oraiste_core_welcome_page_redirect' );

		}//end remove_redirect()


		function page_welcome_redirect() {
			$redirect = get_transient( 'oraiste_core_welcome_page_redirect' );

			if ( empty( $redirect ) ) {
				set_transient( 'oraiste_core_welcome_page_redirect', 1, 31536000 );

				wp_safe_redirect( add_query_arg( [ 'page' => 'oraiste_core_dashboard' ], esc_url( admin_url( 'admin.php' ) ) ) );
			}

		}//end page_welcome_redirect()

		function theme_validation() {
			$is_theme_active = qode_framework_is_installed( 'theme' );

			qode_framework_get_ajax_status( 'success', '', array( 'is_theme_active' => $is_theme_active ) );
		}//end theme_validation()

		function purchase_code_registration() {
			if ( ! isset( $_POST ) || empty( $_POST ) ) {
				return esc_html__( 'All fields are empty', 'oraiste-core' );
			} else {
				switch ( $_POST['options']['action'] ) :
					case 'register':
						$this->register_purchase_code( $_POST['options']['post'] );
						break;

					case 'deregister':
						$this->deregister_purchase_code();
						break;
				endswitch;
			}

			wp_die();

		}//end purchase_code_registration()


		function register_purchase_code() {
			$data        = [];
			$data_string = $_POST['options']['post'];
			parse_str( $data_string, $data );

			if ( empty( $data['purchase_code'] ) || empty( $data['email'] ) ) {
				qode_framework_get_ajax_status(
					'error',
					esc_html__( 'Purchase Code and Email are empty', 'oraiste-core' ),
					[
						'purchase_code' => false,
						'email'         => false,
					]
				);
			} else if ( empty( $data['purchase_code'] ) ) {
				qode_framework_get_ajax_status( 'error', esc_html__( 'Purchase Code is empty', 'oraiste-core' ), [ 'purchase_code' => false ] );
			} else if ( empty( $data['email'] ) ) {
				qode_framework_get_ajax_status( 'error', esc_html__( 'Email is empty', 'oraiste-core' ), [ 'email' => false ] );
			}

			$url = add_query_arg(
				[
					'purchase_code' => rtrim( $data['purchase_code'] ),
					'email'         => $data['email'],
					'profile'       => ORAISTE_CORE_PROFILE_SLUG . '-themes',
					'demo_url'      => esc_url( get_site_url() ),
					'action'        => 'register',
				],
				$this->validation_url
			);

			$json = $this->api_connection( $url );

			if ( isset( $json['success'] ) && $json['success'] ) {
				update_option( $this->licence_field, $json['data']['validation'] );
				update_option( $this->import_field, $json['data']['import'] );
				qode_framework_get_ajax_status( 'success', $this->response_codes( $json['response_code'] ) );
			} else if ( isset( $json['message'] ) && ! $json['success'] && ( isset( $json['data']['error'] ) && 404 == $json['data']['error'] ) ) {
				qode_framework_get_ajax_status( 'error', $this->response_codes( $json['response_code'] ), [ 'purchase_code' => false ] );
			} else if ( isset( $json['message'] ) && ! $json['success'] && ( isset( $json['data']['error'] ) && 'used' === $json['data']['error'] ) ) {
				qode_framework_get_ajax_status( 'error', $this->response_codes( $json['response_code'], $json['data'] ), array( 'already_used' => true ) );
			} else if ( isset( $json['message'] ) && ! $json['success'] ) {
				qode_framework_get_ajax_status( 'error', $this->response_codes( $json['response_code'] ) );
			}

		}//end register_purchase_code()


		function deregister_purchase_code() {
			$code = $this->get_purchased_code();

			$url = add_query_arg(
				[
					'purchase_code' => $code,
					'action'        => 'deregister',
					'profile'       => ORAISTE_CORE_PROFILE_SLUG . '-themes',
				],
				$this->validation_url
			);

			$json = $this->api_connection( $url );

			if ( $json['success'] ) {
				delete_option( $this->licence_field );
				delete_option( $this->import_field );
				qode_framework_get_ajax_status( 'success', $this->response_codes( $json['response_code'] ) );
			} else {
				qode_framework_get_ajax_status( 'error', $this->response_codes( $json['response_code'] ) );
			}

		}//end deregister_purchase_code()


		function check_purchase_code( $demo ) {
			$code = $this->get_purchased_code();

			$url = add_query_arg(
				[
					'purchase_code' => $code,
					'action'        => 'check',
					'profile'       => ORAISTE_CORE_PROFILE_SLUG . '-themes',
					'demo'          => $demo,
				],
				$this->validation_url
			);

			$json = $this->api_connection( $url );

			if ( $json['success'] ) {
				return true;
			} else {
				return false;
			}

		}//end check_purchase_code()


		function get_purchased_code_data() {
			return get_option( $this->licence_field );

		}//end get_purchased_code_data()


		function purchased_code_info() {
			$info = $this->get_purchased_code_data();

			if ( $info && ! empty( $info ) ) {
				return $info;
			} else {
				return false;
			}

		}//end purchased_code_info()


		function get_purchased_code() {
			$info = $this->purchased_code_info();

			if ( is_array( $info ) && isset( $info['purchase_code'] ) ) {
				return $info['purchase_code'];
			}

			return '';

		}//end get_purchased_code()


		function get_code() {
			$code = $this->get_purchased_code();

			if ( empty( $code ) && ( in_array( getenv( 'REMOTE_ADDR' ), array( '127.0.0.1', '::1' ), true ) || strpos( getenv( 'HTTP_HOST' ), 'qodeinteractive' ) !== false ) ) {
				$code = true;
			}

			return $code;
		}//end get_code()


		function get_import_params() {
			$params = get_option( $this->import_field );

			if ( is_array( $params ) && count( $params ) > 0 ) {
				return $params;
			}

			return false;

		}//end get_import_params()


		function api_connection( $url ) {
			$response = wp_remote_get(
				$url,
				[
					'user-agent' => 'WordPress/' . get_bloginfo( 'version' ) . '; ' . esc_url( home_url( '/' ) ),
					'timeout'    => 30,
				]
			);

			if ( is_wp_error( $response ) ) {
				return $response;
			}

			$response_code = wp_remote_retrieve_response_code( $response );
			if ( 200 !== intval( $response_code ) ) {
				return new WP_Error( 'bad_request', esc_html__( 'Bad request', 'oraiste-core' ) );
			}

			$json = json_decode( wp_remote_retrieve_body( $response ), true );

			if ( empty( $json ) || ! is_array( $json ) ) {
				return new WP_Error( 'invalid_response', esc_html__( 'Invalid Response', 'oraiste-core' ) );
			}

			return $json;

		}//end api_connection()


		function response_codes( $code, $data = array() ) {
			$message = '';

			switch ( $code ) :
				case 200:
					$message = esc_html__( 'Failed to validate code due to an error', 'oraiste-core' );
					break;

				case 400:
					$message = esc_html__( 'Parameter or argument in the request was invalid', 'oraiste-core' );
					break;

				case 401:
					$message = esc_html__( 'The authorization header is missing. Verify that your code is correct.', 'oraiste-core' );
					break;

				case 403:
					$message = esc_html__( 'Personal token is incorrect or does not have the required permission(s)', 'oraiste-core' );
					break;

				case 404:
					$message = esc_html__( 'The purchase code is invalid', 'oraiste-core' );
					break;

				case 601:
					$message = esc_html__( 'You successfully activated theme', 'oraiste-core' );
					break;

				case 602:
					$message = esc_html__( 'Code is valid', 'oraiste-core' );
					break;

				case 603:
					$message = esc_html__( 'You successfully added demo', 'oraiste-core' );
					break;

				case 604:
					$message = esc_html__( 'You successfully deregister theme', 'oraiste-core' );
					break;

				case 650:
					$registered_url = '';

					if ( ! empty( $data ) && isset( $data['registered_url'] ) && ! empty( $data['registered_url'] ) ) {
						$registered_url = ' - ' . esc_url( $data['registered_url'] );
					}

					$message = sprintf(
						esc_html__( 'This code was already used to register another domain%s. Please deregister your code there so that you can use it for registering here.', 'oraiste-core' ),
						$registered_url
					);
					break;

				case 651:
					$message = esc_html__( 'Error occurred during activation', 'oraiste-core' );
					break;

				case 652:
					$message = esc_html__( 'Code is invalid', 'oraiste-core' );
					break;

				case 653:
					$message = esc_html__( 'Error occurred during adding', 'oraiste-core' );
					break;

				case 654:
					$message = esc_html__( 'Error occurred during deactivation', 'oraiste-core' );
					break;
			endswitch;

			return $message;

		}//end response_codes()

	}//end class

	OraisteCore_Dashboard::get_instance();
}//end if
