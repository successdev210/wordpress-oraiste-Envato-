<?php

class OraisteCore_Titles {
	private static $instance;
	private $layout_meta;
	private $layouts;
	private $title_object;

	public function __construct() {

		// Includes title layouts
		$this->include_layouts();

		// Set module variables
		add_action( 'wp', array( $this, 'set_variables' ) ); // wp hook is set because we need to wait global wp_query object to instance in order to get page id

		// Overrides default title template of theme
		add_action( 'wp', array( $this, 'render_template' ) );

		// Add title area classes
		add_filter( 'oraiste_filter_page_title_classes', array( $this, 'add_page_title_classes' ) );

		// Add title area inline styles
		add_filter( 'oraiste_filter_add_inline_style', array( $this, 'add_inline_styles' ) );
	}

	/**
	 * @return OraisteCore_Titles
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

	public function get_title_object() {
		return $this->title_object;
	}

	public function set_title_object( $title_object ) {
		$this->title_object = $title_object;
	}

	function include_layouts() {

		foreach ( glob( ORAISTE_CORE_INC_PATH . '/title/dashboard/*/*.php' ) as $admin ) {
			include_once $admin;
		}

		foreach ( glob( ORAISTE_CORE_INC_PATH . '/title/layouts/*/include.php' ) as $layout ) {
			include_once $layout;
		}
	}

	function set_variables() {
		$layout_meta = oraiste_core_get_post_value_through_levels( 'qodef_title_layout' );
		$layouts     = apply_filters( 'oraiste_core_filter_register_title_layouts', $layouts = array() );
		$this->set_layout_meta( $layout_meta );
		$this->set_layouts( $layouts );

		if ( ! empty( $layout_meta ) && ! empty( $layouts ) ) {
			foreach ( $layouts as $key => $value ) {
				if ( $layout_meta === $key ) {
					$this->set_title_object( $value::get_instance() );
				}
			}
		}
	}

	function render_template() {
		$title_object = $this->get_title_object();

		if ( ! empty( $title_object ) ) {
			$template_hook = $title_object->overriding_whole_title ? 'oraiste_filter_title_template' : 'oraiste_filter_title_content_template';

			add_filter( $template_hook, array( $this, 'load_template' ) );
		}
	}

	function load_template() {
		// template is properly escaped inside html file
		echo $this->get_title_object()->load_template(); // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped
	}

	function add_page_title_classes( $classes ) {
		$layout             = oraiste_core_get_post_value_through_levels( 'qodef_title_layout' );
		$text_alignment     = oraiste_core_get_post_value_through_levels( 'qodef_page_title_text_alignment' );
		$vertical_alignment = oraiste_core_get_post_value_through_levels( 'qodef_page_title_vertical_text_alignment' );
		$image_params       = oraiste_core_get_page_title_image_params();

		if ( ! empty( $layout ) ) {
			$classes[] = 'qodef-title--' . $layout;
		}

		if ( ! empty( $text_alignment ) ) {
			$classes[] = 'qodef-alignment--' . $text_alignment;
		}

		if ( ! empty( $vertical_alignment ) ) {
			$classes[] = 'qodef-vertical-alignment--' . $vertical_alignment;
		}

		if ( ! empty( $image_params['image'] ) ) {
			$classes[] = 'qodef--has-image';

			if ( ! empty( $image_params['image_behavior'] ) ) {
				$classes[] = 'qodef-image--' . $image_params['image_behavior'];

				if ( 'parallax' === $image_params['image_behavior'] ) {
					$classes[] = 'qodef-parallax';
				}
			}
		}

		return $classes;
	}

	function add_inline_styles( $style ) {
		$styles = array();

		$height                   = oraiste_core_get_post_value_through_levels( 'qodef_page_title_height' );
		$height_mobile            = oraiste_core_get_post_value_through_levels( 'qodef_page_title_height_on_smaller_screens' );
		$title_padding            = apply_filters( 'oraiste_core_filter_title_padding', 0 );
		$title_padding_mobile     = apply_filters( 'oraiste_core_filter_title_padding_mobile', 0 );
		$title_vertical_alignment = oraiste_core_get_post_value_through_levels( 'qodef_page_title_vertical_text_alignment' );
		$background_color         = oraiste_core_get_post_value_through_levels( 'qodef_page_title_background_color' );
		$image_params             = oraiste_core_get_page_title_image_params();

		if ( ! empty( $height ) ) {
			$styles['height'] = intval( $height ) . 'px';
		}

		if ( ! empty( $background_color ) ) {
			$styles['background-color'] = $background_color;
		}

		if ( ! empty( $image_params['image'] ) && '' === $image_params['image_behavior'] ) {
			$styles['background-image'] = 'url(' . esc_url( wp_get_attachment_image_url( $image_params['image'], 'full' ) ) . ')';
		}

		if ( ! empty( $styles ) ) {
			$style .= qode_framework_dynamic_style( '.qodef-page-title', $styles );
		}

		$content_styles = array();

		if ( 0 !== $title_padding && 'header-bottom' === $title_vertical_alignment ) {
			$content_styles['padding-top'] = intval( $title_padding ) . 'px';
		}

		if ( ! empty( $content_styles ) ) {
			$style .= qode_framework_dynamic_style( '.qodef-page-title .qodef-m-content', $content_styles );
		}

		$title_styles = array();

		$title_color = oraiste_core_get_post_value_through_levels( 'qodef_page_title_color' );

		if ( ! empty( $title_color ) ) {
			$title_styles['color'] = $title_color;
		}

		if ( ! empty( $title_styles ) ) {
			$style .= qode_framework_dynamic_style( '.qodef-page-title .qodef-m-title', $title_styles );
		}

		//responsive styles - start
		$title_styles_mobile = array();

		if ( ! empty( $height_mobile ) ) {
			$title_styles_mobile['height'] = intval( $height_mobile ) . 'px';
		}

		if ( ! empty( $title_styles_mobile ) ) {
			$style .= qode_framework_dynamic_style_responsive( '.qodef-page-title', $title_styles_mobile, '', '1024' );
		}

		$content_styles_mobile = array();

		if ( 0 !== $title_padding_mobile ) {
			$content_styles_mobile['padding-top'] = intval( $title_padding_mobile ) . 'px';
		}

		if ( ! empty( $content_styles_mobile ) ) {
			$style .= qode_framework_dynamic_style_responsive( '.qodef-page-title .qodef-m-content', $content_styles_mobile, '', '1024' );
		}

		//responsive styles - end

		return $style;
	}
}

OraisteCore_Titles::get_instance();
