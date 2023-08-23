<?php

class OraisteCore_Mobile_Headers {
	private static $instance;
	private $layout_meta;
	private $layouts;
	private $mobile_header_object;

	public function __construct() {

		// Includes header layouts
		$this->include_elements();

		// Set module variables
		add_action( 'wp', array( $this, 'set_variables' ) ); // wp hook is set because we need to wait global wp_query object to instance in order to get page id

		// Overrides default header template of theme
		add_action( 'wp', array( $this, 'render_template' ) );

		// Add module body classes
		add_filter( 'body_class', array( $this, 'add_body_classes' ) );

		//Add widget areas
		add_action( 'widgets_init', array( $this, 'add_header_widget_areas' ) );

		//Generates menu typography styles
		add_filter( 'oraiste_filter_add_inline_style', array( $this, 'set_menu_typography_styles' ) );
	}

	/**
	 * @return OraisteCore_Mobile_Headers
	 */
	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function get_layout_meta() {
		return $this->layout_meta;
	}

	public function set_layout_meta( $layout_meta ) {
		$this->layout_meta = $layout_meta;
	}

	public function get_layouts() {
		return $this->layouts;
	}

	public function set_layouts( $layouts ) {
		$this->layouts = $layouts;
	}

	public function get_mobile_header_object() {
		return $this->mobile_header_object;
	}

	public function set_mobile_header_object( $mobile_header_object ) {
		$this->mobile_header_object = $mobile_header_object;
	}

	function include_elements() {

		foreach ( glob( ORAISTE_CORE_INC_PATH . '/mobile-header/dashboard/*/*.php' ) as $admin ) {
			include_once $admin;
		}
		foreach ( glob( ORAISTE_CORE_INC_PATH . '/mobile-header/layouts/*/include.php' ) as $layout ) {
			include_once $layout;
		}
	}

	function set_variables() {
		$layout_meta = oraiste_core_get_post_value_through_levels( 'qodef_mobile_header_layout' );
		$layouts     = apply_filters( 'oraiste_core_filter_register_mobile_header_layouts', $header_layouts_option = array() );

		$this->set_layout_meta( $layout_meta );
		$this->set_layouts( $layouts );

		if ( ! empty( $layout_meta ) && ! empty( $layouts ) ) {
			foreach ( $layouts as $key => $value ) {
				if ( $layout_meta === $key ) {

					$this->set_mobile_header_object( $value::get_instance() );
				}
			}
		}
	}

	function load_template() {
		// template is properly escaped inside html file
		echo $this->get_mobile_header_object()->load_template(); // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped
	}

	function render_template() {
		$header_object = $this->get_mobile_header_object();

		if ( ! empty( $header_object ) ) {
			$template_hook = $header_object->is_whole_header_override() ? 'oraiste_filter_mobile_header_template' : 'oraiste_filter_mobile_header_content_template';

			add_filter( $template_hook, array( $this, 'load_template' ), 11 );
		}
	}

	function add_body_classes( $classes ) {
		$header_layout = oraiste_core_get_post_value_through_levels( 'qodef_mobile_header_layout' );
		$classes[]     = ! empty( $header_layout ) ? 'qodef-mobile-header--' . $header_layout : '';

		$classes[] = 'yes' === oraiste_core_get_post_value_through_levels( 'qodef_mobile_header_scroll_appearance' ) ? 'qodef-mobile-header-appearance--sticky' : '';

		return $classes;
	}

	function add_header_widget_areas() {
		register_sidebar(
			array(
				'id'            => 'qodef-mobile-header-widget-area',
				'name'          => esc_html__( 'Mobile Header', 'oraiste-core' ),
				'before_widget' => '<div id="%1$s" class="widget %2$s qodef-mobile-header-widget-area-one" data-area="mobile-header">',
				'after_widget'  => '</div>',
				'description'   => esc_html__( 'Widgets added here will appear in mobile header widget area', 'oraiste-core' ),
			)
		);
	}

	function set_menu_typography_styles( $style ) {
		$scope = ORAISTE_CORE_OPTIONS_NAME;

		$first_lvl_styles        = oraiste_core_get_typography_styles( $scope, 'qodef_mobile_1st_lvl' );
		$first_lvl_hover_styles  = oraiste_core_get_typography_hover_styles( $scope, 'qodef_mobile_1st_lvl' );
		$second_lvl_styles       = oraiste_core_get_typography_styles( $scope, 'qodef_mobile_2nd_lvl' );
		$second_lvl_hover_styles = oraiste_core_get_typography_hover_styles( $scope, 'qodef_mobile_2nd_lvl' );

		if ( ! empty( $first_lvl_styles ) ) {
			$style .= qode_framework_dynamic_style( '.qodef-mobile-header-navigation > ul > li > a', $first_lvl_styles );
		}

		if ( ! empty( $first_lvl_hover_styles ) ) {
			$style .= qode_framework_dynamic_style( '.qodef-mobile-header-navigation > ul > li > a:hover', $first_lvl_hover_styles );
		}

		$first_lvl_active_color = oraiste_core_get_option_value( 'admin', 'qodef_mobile_1st_lvl_active_color' );

		if ( ! empty( $first_lvl_active_color ) ) {
			$first_lvl_active_styles = array(
				'color' => $first_lvl_active_color,
			);

			$style .= qode_framework_dynamic_style(
				array(
					'.qodef-mobile-header-navigation > ul >li.current-menu-ancestor > a',
					'.qodef-mobile-header-navigation > ul >li.current-menu-item > a',
				),
				$first_lvl_active_styles
			);
		}

		if ( ! empty( $second_lvl_styles ) ) {
			$style .= qode_framework_dynamic_style( '.qodef-mobile-header-navigation .qodef-drop-down-second-inner ul li > a', $second_lvl_styles );
		}

		if ( ! empty( $second_lvl_hover_styles ) ) {
			$style .= qode_framework_dynamic_style( '.qodef-mobile-header-navigation .qodef-drop-down-second-inner ul li > a:hover', $second_lvl_hover_styles );
		}

		$second_lvl_active_color = oraiste_core_get_option_value( 'admin', 'qodef_mobile_2nd_lvl_active_color' );

		if ( ! empty( $second_lvl_active_color ) ) {
			$second_lvl_active_styles = array(
				'color' => $second_lvl_active_color,
			);

			$style .= qode_framework_dynamic_style(
				array(
					'.qodef-mobile-header-navigation .qodef-drop-down-second ul li.current-menu-ancestor > a',
					'.qodef-mobile-header-navigation .qodef-drop-down-second ul li.current-menu-item > a',
				),
				$second_lvl_active_styles
			);
		}

		return $style;
	}
}

OraisteCore_Mobile_Headers::get_instance();
