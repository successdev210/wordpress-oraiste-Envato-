<?php

abstract class OraisteCore_Header {
	protected $default_header_height;
	protected $header_height;
	private $overriding_whole_header = false;
	private $layout;
	private $layout_slug = '';
	private $search_layout;

	public function __construct() {
		$this->set_header_height();

		add_filter( 'oraiste_core_action_before_main_css', array( $this, 'enqueue_assets' ) );
		add_filter( 'oraiste_core_action_before_main_css', array( $this, 'enqueue_additional_assets' ) );
		add_filter( 'oraiste_filter_localize_main_js', array( $this, 'set_global_javascript_variables' ) );
		add_filter( 'oraiste_core_filter_content_margin', array( $this, 'get_content_margin' ) );
		add_filter( 'oraiste_core_filter_title_padding', array( $this, 'get_title_padding' ) );
		add_filter( 'oraiste_filter_add_inline_style', array( $this, 'set_inline_header_styles' ) );
		add_filter( 'oraiste_filter_header_inner_class', array( $this, 'set_header_inner_classes' ), 10, 2 );
		add_filter( 'oraiste_filter_mobile_header_inner_class', array( $this, 'set_header_inner_classes' ), 10, 2 );
		add_filter( 'oraiste_core_filter_nav_menu_header_selector', array( $this, 'set_nav_menu_header_selector' ) );
		add_filter( 'oraiste_core_filter_nav_menu_narrow_header_selector', array( $this, 'set_nav_menu_narrow_header_selector' ) );
	}

	function set_header_height() {
		$header_height = oraiste_core_get_post_value_through_levels( 'qodef_' . $this->get_formatted_layout() . '_header_height' );
		$header_height = ! empty( $header_height ) ? intval( $header_height ) : $this->default_header_height;

		$this->header_height = apply_filters( 'oraiste_core_filter_set_header_height', $header_height );
	}

	/**
	 * swap dash with underscore
	 *
	 * header slug must be same as folder name, we're using dash as delimiter
	 * options and metaboxes, we're using underscore as delimiter
	 *
	 * @return mixed
	 */
	public function get_formatted_layout() {
		return str_replace( '-', '_', $this->get_layout() );
	}

	public function get_layout() {
		return $this->layout;
	}

	public function set_layout( $layout ) {
		$this->layout = $layout;
	}

	public function get_search_layout() {
		return $this->search_layout;
	}

	public function is_whole_header_override() {
		return $this->overriding_whole_header;
	}

	public function set_overriding_whole_header( $overriding_whole_header ) {
		$this->overriding_whole_header = $overriding_whole_header;
	}

	public function load_template( $parameters = array() ) {
		$parameters = apply_filters( 'oraiste_core_filter_header_template', $parameters );

		return oraiste_core_get_template_part( 'header/layouts/' . $this->get_layout(), 'templates/' . $this->get_layout(), $this->get_layout_slug(), $parameters );
	}

	public function get_layout_slug() {
		return $this->layout_slug;
	}

	public function set_layout_slug( $layout_slug ) {
		$this->layout_slug = $layout_slug;
	}

	public function enqueue_assets() {
		wp_enqueue_script( 'hoverIntent' );
	}

	public function enqueue_additional_assets() {
		return false;
	}

	public function set_global_javascript_variables( $global_vars ) {
		$global_vars['headerHeight'] = $this->header_height;

		return $global_vars;
	}

	public function get_content_margin( $margin ) {

		if ( $this->get_header_transparency() || $this->content_behind_header() ) {
			$margin += $this->header_height;
		}

		return $margin;
	}

	public function get_header_transparency() {
		$background_color = oraiste_core_get_post_value_through_levels( 'qodef_' . $this->get_formatted_layout() . '_header_background_color' );

		if ( ! empty( $background_color ) ) {
			return ! preg_match( '/^#[a-f0-9]{6}$/i', $background_color ); // hex color is valid
		}

		return false;
	}

	public function content_behind_header() {
		return 'yes' === oraiste_core_get_post_value_through_levels( 'qodef_content_behind_header' );
	}

	public function get_title_padding( $padding ) {

		if ( $this->get_header_transparency() || $this->content_behind_header() ) {
			$padding += $this->header_height;
		}

		return $padding;
	}

	function set_header_inner_classes( $class, $layout ) {
		// Check is content in grid
		$class[] = 'yes' === oraiste_core_get_post_value_through_levels( 'qodef_' . $this->get_formatted_layout() . '_header_in_grid' ) ? 'qodef-content-grid' : '';

		// Check header skin
		$header_skin = oraiste_core_get_post_value_through_levels( 'qodef_header_skin' );
		if ( ! empty( $header_skin ) && 'none' !== $header_skin && 'default' === $layout ) {
			$class[] = 'qodef-color-skin--' . $header_skin;
		}

		return $class;
	}

	public function set_inline_header_styles( $style ) {
		$styles = array();

		$height           = oraiste_core_get_post_value_through_levels( 'qodef_' . $this->get_formatted_layout() . '_header_height' );
		$background_color = oraiste_core_get_post_value_through_levels( 'qodef_' . $this->get_formatted_layout() . '_header_background_color' );

		if ( ! empty( $height ) ) {
			$styles['height'] = intval( $height ) . 'px';
		}

		if ( ! empty( $background_color ) ) {
			$styles['background-color'] = $background_color;
		}

		if ( ! empty( $styles ) ) {
			$style .= qode_framework_dynamic_style( '.qodef-header--' . $this->get_layout() . ' #qodef-page-header', $styles );
		}

		$inner_styles  = array();
		$border_styles = array();

		$side_padding = oraiste_core_get_post_value_through_levels( 'qodef_' . $this->get_formatted_layout() . '_header_side_padding' );
		$border_color = oraiste_core_get_post_value_through_levels( 'qodef_' . $this->get_formatted_layout() . '_header_border_color' );

		if ( '' !== $side_padding ) {
			if ( qode_framework_string_ends_with_space_units( $side_padding ) ) {
				$inner_styles['padding-left']  = $side_padding;
				$inner_styles['padding-right'] = $side_padding;
				$border_styles['width']        = 'calc(100% - (' . $side_padding . ' * 2))';
				$border_styles['left']         = $side_padding;
			} else {
				$inner_styles['padding-left']  = intval( $side_padding ) . 'px';
				$inner_styles['padding-right'] = intval( $side_padding ) . 'px';
				$border_styles['width']        = 'calc(100% - ' . intval( $side_padding ) * 2 . 'px)';
				$border_styles['left']         = intval( $side_padding ) . 'px';
			}
		}

		if ( ! empty( $border_color ) ) {
			$border_styles['background-color'] = $border_color;
		}

		if ( ! empty( $inner_styles ) ) {
			$style .= qode_framework_dynamic_style( '.qodef-header--' . $this->get_layout() . ' #qodef-page-header-inner', $inner_styles );
		}

		if ( ! empty( $border_styles ) ) {
			$style .= qode_framework_dynamic_style( '.qodef-header--' . $this->get_layout() . ' #qodef-page-header-inner::after', $border_styles );
		}

		return $style;
	}

	public function set_nav_menu_header_selector( $selector ) {
		return $selector;
	}

	public function set_nav_menu_narrow_header_selector( $selector ) {
		return $selector;
	}
}
