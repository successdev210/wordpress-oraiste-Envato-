<?php

if ( ! function_exists( 'oraiste_core_set_elements_styles' ) ) {
	/**
	 * Function that generates module inline styles
	 *
	 * @param string $style
	 *
	 * @return string
	 */
	function oraiste_core_set_elements_styles( $style ) {
		$scope = ORAISTE_CORE_OPTIONS_NAME;

		$label_styles = oraiste_core_get_typography_styles( $scope, 'qodef_elements_label' );

		if ( ! empty( $label_styles ) ) {
			$style .= qode_framework_dynamic_style(
				array(
					'label',
				),
				$label_styles
			);
		}

		$input_styles         = oraiste_core_get_typography_styles( $scope, 'qodef_elements_input_fields' );
		$fields_bg_color      = oraiste_core_get_post_value_through_levels( 'qodef_elements_input_fields_background_color' );
		$fields_border_color  = oraiste_core_get_post_value_through_levels( 'qodef_elements_input_fields_border_color' );
		$fields_border_width  = oraiste_core_get_post_value_through_levels( 'qodef_elements_input_fields_border_width' );
		$fields_border_radius = oraiste_core_get_post_value_through_levels( 'qodef_elements_input_fields_border_radius' );
		$fields_border_style  = oraiste_core_get_post_value_through_levels( 'qodef_elements_input_fields_border_style' );
		$fields_padding       = oraiste_core_get_post_value_through_levels( 'qodef_elements_input_fields_padding' );

		if ( ! empty( $fields_bg_color ) ) {
			$input_styles['background-color'] = $fields_bg_color;
		}

		if ( ! empty( $fields_border_color ) ) {
			$input_styles['border-color'] = $fields_border_color;
		}

		if ( '' !== $fields_border_width ) {
			if ( qode_framework_string_ends_with_space_units( $fields_border_width, true ) ) {
				$input_styles['border-width'] = $fields_border_width;
			} else {
				$input_styles['border-width'] = intval( $fields_border_width ) . 'px';
			}
		}

		if ( '' !== $fields_border_radius ) {
			if ( qode_framework_string_ends_with_space_units( $fields_border_radius, true ) ) {
				$input_styles['border-radius'] = $fields_border_radius;
			} else {
				$input_styles['border-radius'] = intval( $fields_border_radius ) . 'px';
			}
		}

		if ( ! empty( $fields_border_style ) ) {
			$input_styles['border-style'] = esc_attr( $fields_border_style );
		}

		if ( '' !== $fields_padding ) {
			$input_styles['padding'] = esc_attr( $fields_padding );
		}

		if ( ! empty( $input_styles ) ) {
			$style .= qode_framework_dynamic_style(
				array(
					'input[type="text"]',
					'input[type="email"]',
					'input[type="url"]',
					'input[type="password"]',
					'input[type="number"]',
					'input[type="tel"]',
					'input[type="search"]',
					'input[type="date"]',
					'textarea',
					'select',
					'body .select2-container--default .select2-selection--single',
					'body .select2-container--default .select2-selection--multiple',
				),
				$input_styles
			);
		}

		$input_focus_styles        = array();
		$fields_focus_color        = oraiste_core_get_post_value_through_levels( 'qodef_elements_input_fields_focus_color' );
		$fields_bg_focus_color     = oraiste_core_get_post_value_through_levels( 'qodef_elements_input_fields_background_focus_color' );
		$fields_border_focus_color = oraiste_core_get_post_value_through_levels( 'qodef_elements_input_fields_border_focus_color' );

		if ( ! empty( $fields_focus_color ) ) {
			$input_focus_styles['color'] = $fields_focus_color;
		}

		if ( ! empty( $fields_bg_focus_color ) ) {
			$input_focus_styles['background-color'] = $fields_bg_focus_color;
		}

		if ( ! empty( $fields_border_focus_color ) ) {
			$input_focus_styles['border-color'] = $fields_border_focus_color;
		}

		if ( ! empty( $input_focus_styles ) ) {
			$style .= qode_framework_dynamic_style(
				array(
					'input[type="text"]:focus',
					'input[type="email"]:focus',
					'input[type="url"]:focus',
					'input[type="password"]:focus',
					'input[type="number"]:focus',
					'input[type="tel"]:focus',
					'input[type="search"]:focus',
					'input[type="date"]:focus',
					'textarea:focus',
					'select:focus',
					'body .select2-container--default .select2-selection--single:focus',
					'body .select2-container--default .select2-selection--multiple:focus',
				),
				$input_focus_styles
			);
		}

		$button_styles        = oraiste_core_get_typography_styles( $scope, 'qodef_elements_buttons' );
		$button_bg_color      = oraiste_core_get_post_value_through_levels( 'qodef_elements_buttons_background_color' );
		$button_border_color  = oraiste_core_get_post_value_through_levels( 'qodef_elements_buttons_border_color' );
		$button_border_width  = oraiste_core_get_post_value_through_levels( 'qodef_elements_buttons_border_width' );
		$button_border_radius = oraiste_core_get_post_value_through_levels( 'qodef_elements_buttons_border_radius' );
		$button_border_style  = oraiste_core_get_post_value_through_levels( 'qodef_elements_buttons_border_style' );
		$button_box_shadow    = oraiste_core_get_post_value_through_levels( 'qodef_elements_buttons_box_shadow' );
		$button_padding       = oraiste_core_get_post_value_through_levels( 'qodef_elements_buttons_padding' );

		if ( ! empty( $button_bg_color ) ) {
			$button_styles['background-color'] = $button_bg_color;
		}

		if ( ! empty( $button_border_color ) ) {
			$button_styles['border-color'] = $button_border_color;
		}

		if ( '' !== $button_border_width ) {
			if ( qode_framework_string_ends_with_space_units( $button_border_width, true ) ) {
				$button_styles['border-width'] = $button_border_width;
			} else {
				$button_styles['border-width'] = intval( $button_border_width ) . 'px';
			}
			$button_styles['border-style'] = 'solid';
		}

		if ( '' !== $button_border_radius ) {
			if ( qode_framework_string_ends_with_space_units( $button_border_radius, true ) ) {
				$button_styles['border-radius'] = $button_border_radius;
			} else {
				$button_styles['border-radius'] = intval( $button_border_radius ) . 'px';
			}
		}

		if ( ! empty( $button_border_style ) ) {
			$button_styles['border-style'] = esc_attr( $button_border_style );
		}

		if ( ! empty( $button_box_shadow ) ) {
			$button_styles['box-shadow'] = esc_attr( $button_box_shadow );
		}

		if ( '' !== $button_padding ) {
			$button_styles['padding'] = esc_attr( $button_padding );
		}

		if ( ! empty( $button_styles ) ) {
			$style .= qode_framework_dynamic_style(
				array(
					'input[type="submit"]',
					'button[type="submit"]',
					'.qodef-theme-button',
					'.qodef-button.qodef-layout--filled',
					'#qodef-woo-page .added_to_cart',
					'#qodef-woo-page .button',
					'.qodef-woo-shortcode .added_to_cart',
					'.qodef-woo-shortcode .button',
					'.widget.woocommerce .button',
				),
				$button_styles
			);
		}

		$button_hover_styles       = array();
		$button_hover_color        = oraiste_core_get_post_value_through_levels( 'qodef_elements_buttons_hover_color' );
		$button_bg_hover_color     = oraiste_core_get_post_value_through_levels( 'qodef_elements_buttons_background_hover_color' );
		$button_border_hover_color = oraiste_core_get_post_value_through_levels( 'qodef_elements_buttons_border_hover_color' );

		if ( ! empty( $button_hover_color ) ) {
			$button_hover_styles['color'] = $button_hover_color;
		}

		if ( ! empty( $button_bg_hover_color ) ) {
			$button_hover_styles['background-color'] = $button_bg_hover_color;
		}

		if ( ! empty( $button_border_hover_color ) ) {
			$button_hover_styles['border-color'] = $button_border_hover_color;
		}

		if ( ! empty( $button_hover_styles ) ) {
			$style .= qode_framework_dynamic_style(
				array(
					'input[type="submit"]:hover',
					'button[type="submit"]:hover',
					'.qodef-theme-button:hover',
					'.qodef-button.qodef-layout--filled:hover',
					'#qodef-woo-page .added_to_cart:hover',
					'#qodef-woo-page .button:hover',
					'.qodef-woo-shortcode .added_to_cart:hover',
					'.qodef-woo-shortcode .button:hover',
					'.widget.woocommerce .button:hover',
				),
				$button_hover_styles
			);
		}

		$button_simple_styles = oraiste_core_get_typography_styles( $scope, 'qodef_elements_buttons_simple' );

		if ( ! empty( $button_simple_styles ) ) {
			$style .= qode_framework_dynamic_style(
				array(
					'.qodef-button.qodef-layout--textual',
				),
				$button_simple_styles
			);
		}

		$button_simple_hover_styles          = array();
		$button_simple_hover_color           = oraiste_core_get_post_value_through_levels( 'qodef_elements_buttons_simple_hover_color' );
		$button_simple_hover_text_decoration = oraiste_core_get_post_value_through_levels( 'qodef_elements_buttons_simple_hover_text_decoration' );

		if ( ! empty( $button_simple_hover_color ) ) {
			$button_simple_hover_styles['color'] = $button_simple_hover_color;
		}

		if ( ! empty( $button_simple_hover_text_decoration ) ) {
			$button_simple_hover_styles['text-decoration'] = $button_simple_hover_text_decoration;
		}

		if ( ! empty( $button_simple_hover_styles ) ) {
			$style .= qode_framework_dynamic_style(
				array(
					'.qodef-button.qodef-layout--textual:hover',
				),
				$button_simple_hover_styles
			);
		}

		$slider_arrow_styles   = array();
		$slider_arrow_color    = oraiste_core_get_post_value_through_levels( 'qodef_elements_slider_arrow_color' );
		$slider_arrow_bg_color = oraiste_core_get_post_value_through_levels( 'qodef_elements_slider_arrow_background_color' );

		if ( ! empty( $slider_arrow_color ) ) {
			$slider_arrow_styles['color'] = $slider_arrow_color;
		}

		if ( ! empty( $slider_arrow_bg_color ) ) {
			$slider_arrow_styles['background-color'] = $slider_arrow_bg_color;
		}

		if ( ! empty( $slider_arrow_styles ) ) {
			$style .= qode_framework_dynamic_style(
				array(
					'.qodef-swiper-container .swiper-button-next',
					'.qodef-swiper-container .swiper-button-prev',
				),
				$slider_arrow_styles
			);
		}

		$slider_arrow_svg_styles = array();
		$slider_arrow_svg_size   = oraiste_core_get_post_value_through_levels( 'qodef_elements_slider_arrow_size' );

		if ( ! empty( $slider_arrow_svg_size ) ) {
			$slider_arrow_svg_styles['width'] = intval( $slider_arrow_svg_size ) . 'px';
		}

		if ( ! empty( $slider_arrow_svg_styles ) ) {
			$style .= qode_framework_dynamic_style(
				array(
					'.qodef-swiper-container .swiper-button-next svg',
					'.qodef-swiper-container .swiper-button-prev svg',
				),
				$slider_arrow_svg_styles
			);
		}

		$slider_arrow_hover_styles   = array();
		$slider_arrow_hover_color    = oraiste_core_get_post_value_through_levels( 'qodef_elements_slider_arrow_hover_color' );
		$slider_arrow_bg_hover_color = oraiste_core_get_post_value_through_levels( 'qodef_elements_slider_arrow_background_hover_color' );

		if ( ! empty( $slider_arrow_hover_color ) ) {
			$slider_arrow_hover_styles['color'] = $slider_arrow_hover_color;
		}

		if ( ! empty( $slider_arrow_bg_hover_color ) ) {
			$slider_arrow_hover_styles['background-color'] = $slider_arrow_bg_hover_color;
		}

		if ( ! empty( $slider_arrow_hover_styles ) ) {
			$style .= qode_framework_dynamic_style(
				array(
					'.qodef-swiper-container .swiper-button-next:hover',
					'.qodef-swiper-container .swiper-button-prev:hover',
				),
				$slider_arrow_hover_styles
			);
		}

		return $style;
	}

	add_filter( 'oraiste_filter_add_inline_style', 'oraiste_core_set_elements_styles' );
}
