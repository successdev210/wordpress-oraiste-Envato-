<?php

class QodeFrameworkRoot {
	private static $instance;
	private $admin_options;
	private $meta_options;
	private $front_end_options;
	private $taxonomy_options;
	private $user_options;
	private $attachment_options;
	private $nav_menu_options;
	private $customizer_options;
	private $custom_post_types;
	private $shortcodes;
	private $icons;
	private $image_sizes;
	private $widgets;
	private $custom_sidebars;

	private function __construct() {
		do_action( 'qode_framework_action_before_framework_root_init' );

		add_action( 'after_setup_theme', array( $this, 'load_icons_files' ), 5 );
		add_action( 'after_setup_theme', array( $this, 'load_options_files' ), 5 );
		add_action( 'after_setup_theme', array( $this, 'load_cpt_files' ), 5 );
		add_action( 'after_setup_theme', array( $this, 'load_shortcode_files' ), 5 );
		add_action( 'after_setup_theme', array( $this, 'load_media_files' ), 5 );
		add_action( 'after_setup_theme', array( $this, 'load_sidebar_files' ), 5 );
		add_action( 'after_setup_theme', array( $this, 'load_widget_files' ), 5 );

		do_action( 'qode_framework_action_after_framework_root_init' );
	}

	/**
	 * @return QodeFrameworkRoot
	 */
	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function load_options_files() {
		require_once QODE_FRAMEWORK_INC_PATH . '/common/include.php';
		require_once QODE_FRAMEWORK_INC_PATH . '/fonts/include.php';

		$this->admin_options   = array();
		$admin_options_classes = apply_filters( 'qode_framework_filter_register_admin_options', $this->admin_options );

		if ( ! empty( $admin_options_classes ) ) {
			foreach ( $admin_options_classes as $class ) {
				$this->set_admin_option( $class );
			}
		}

		$this->meta_options       = new QodeFrameworkOptionsMeta();
		$this->front_end_options  = new QodeFrameworkOptionsFront();
		$this->user_options       = new QodeFrameworkOptionsUser();
		$this->attachment_options = new QodeFrameworkOptionsAttachment();
		$this->nav_menu_options   = new QodeFrameworkOptionsNavMenu();
		$this->customizer_options = new QodeFrameworkOptionsCustomizer();
	}

	public function load_cpt_files() {
		require_once QODE_FRAMEWORK_INC_PATH . '/post-types/include.php';

		$this->custom_post_types = new QodeFrameworkCustomPostTypes();
		$this->taxonomy_options  = new QodeFrameworkOptionsTaxonomy();
	}

	public function load_shortcode_files() {
		require_once QODE_FRAMEWORK_INC_PATH . '/shortcodes/include.php';

		$this->shortcodes = new QodeFrameworkShortcodes();
	}

	public function load_icons_files() {
		require_once QODE_FRAMEWORK_INC_PATH . '/icons/include.php';

		$this->icons = QodeFrameworkIcons::get_instance();
	}

	public function load_media_files() {
		require_once QODE_FRAMEWORK_INC_PATH . '/media/include.php';

		$this->image_sizes = new QodeFrameworkImageSizes();
	}

	public function load_sidebar_files() {
		require_once QODE_FRAMEWORK_INC_PATH . '/sidebar/include.php';

		$this->custom_sidebars = new QodeFrameworkCustomSidebar();
	}

	public function load_widget_files() {
		require_once QODE_FRAMEWORK_INC_PATH . '/widgets/include.php';

		$this->widgets = new QodeFrameworkWidgets();
	}

	function get_admin_options() {
		return $this->admin_options;
	}

	function set_admin_option( QodeFrameworkOptionsAdmin $options ) {
		$key                         = $options->get_options_name();
		$this->admin_options[ $key ] = $options;

		return $this->admin_options[ $key ];
	}

	function get_admin_option( $key ) {
		if ( is_array( $key ) ) {
			$key = $key[0];
		}

		return $this->admin_options[ $key ];
	}

	function get_meta_options() {
		return $this->meta_options;
	}

	function get_front_end_options() {
		return $this->front_end_options;
	}

	function get_taxonomy_options() {
		return $this->taxonomy_options;
	}

	function get_user_options() {
		return $this->user_options;
	}

	function get_attachment_options() {
		return $this->attachment_options;
	}

	function get_nav_menu_options() {
		return $this->nav_menu_options;
	}

	function get_customizer_options() {
		return $this->customizer_options;
	}

	function get_custom_post_types() {
		return $this->custom_post_types;
	}

	function get_custom_post_type_names() {
		$cpt_names = array();

		foreach ( (array) $this->custom_post_types as $items ) {
			foreach ( $items as $item => $value ) {
				$cpt_names[ $item ] = $item;
			}
		}

		return $cpt_names;
	}

	function get_custom_post_type_taxonomies( $cpt_slug = '' ) {
		$taxonomies = array();

		if ( ! empty( $cpt_slug ) ) {
			$cpt_taxonomies = get_object_taxonomies( $cpt_slug );

			foreach ( $cpt_taxonomies as $cpt_taxonomy ) {
				$taxonomies[ $cpt_taxonomy ] = ucwords( str_replace( array( '-' ), array( ' ' ), $cpt_taxonomy ) );
			}
		} else {
			$cpt_names = qode_framework_get_framework_root()->get_custom_post_type_names();

			foreach ( $cpt_names as $cpt_name ) {
				$cpt_taxonomies = get_object_taxonomies( $cpt_name );

				foreach ( $cpt_taxonomies as $cpt_taxonomy ) {
					$taxonomies[ $cpt_taxonomy ] = ucwords( str_replace( array( '-' ), array( ' ' ), $cpt_taxonomy ) );
				}
			}
		}

		return $taxonomies;
	}

	function get_shortcodes() {
		return $this->shortcodes;
	}

	function get_widgets() {
		return $this->widgets;
	}

	function get_custom_sidebars() {
		return $this->custom_sidebars;
	}

	function add_options_page( $params ) {
		$page = false;
		if ( isset( $params['type'] ) && ! empty( $params['type'] ) ) {
			if ( 'admin' === $params['type'] ) {
				$scope = isset( $params['scope'] ) ? $params['scope'] : '';
				if ( ! empty( $scope ) ) {
					$page = new QodeFrameworkPageAdmin( $params );
					$this->get_admin_option( $scope )->add_option_page( $page );
				}
			} elseif ( 'meta' === $params['type'] ) {
				$page = new QodeFrameworkPageMeta( $params );
				$this->get_meta_options()->add_option_page( $page );
			} elseif ( 'front-end' === $params['type'] ) {
				$page = new QodeFrameworkPageFront( $params );
				$this->get_front_end_options()->add_option_page( $page );
			} elseif ( 'taxonomy' === $params['type'] ) {
				$page = new QodeFrameworkPageTaxonomy( $params );
				$this->get_taxonomy_options()->add_option_page( $page );
			} elseif ( 'user' === $params['type'] ) {
				$params['layout'] = 'table';
				$page             = new QodeFrameworkPageUser( $params );
				$this->get_user_options()->add_option_page( $page );
			} elseif ( 'attachment' === $params['type'] ) {
				$page = new QodeFrameworkPageAttachment( $params );
				$this->get_attachment_options()->add_option_page( $page );
			} elseif ( 'nav-menu' === $params['type'] ) {
				$page = new QodeFrameworkPageNavMenu( $params );
				$this->get_nav_menu_options()->add_option_page( $page );
			} elseif ( 'customizer' === $params['type'] ) {
				$page = new QodeFrameworkPageCustomizer( $params );
				$this->get_customizer_options()->add_option_page( $page );
			}
		}

		return $page;
	}

	function add_custom_post_type( QodeFrameworkCustomPostType $cpt ) {
		if ( $cpt ) {
			$this->get_custom_post_types()->add_custom_post_type( $cpt );
		}

		return $cpt;
	}

	function add_shortcode( QodeFrameworkShortcode $shortcode ) {
		if ( $shortcode ) {
			$this->get_shortcodes()->add_shortcode( $shortcode );
		}

		return $shortcode;
	}

	function add_widget( QodeFrameworkWidget $widget ) {
		if ( $widget ) {
			$this->get_widgets()->add_widget( $widget );
		}

		return $widget;
	}
}

if ( ! function_exists( 'qode_framework_get_framework_root' ) ) {
	/**
	 * Main instance of Qode Framework Root.
	 *
	 * Returns the main instance of QodeFrameworkRoot to prevent the need to use globals.
	 *
	 * @since  1.0
	 * @return QodeFrameworkRoot
	 */
	function qode_framework_get_framework_root() {
		return QodeFrameworkRoot::get_instance();
	}
}
