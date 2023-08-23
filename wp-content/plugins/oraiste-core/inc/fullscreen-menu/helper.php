<?php

if ( ! function_exists( 'oraiste_core_register_fullscreen_menu' ) ) {
	/**
	 * Function which add additional main menu navigation into global list
	 *
	 * @param array $menus
	 *
	 * @return array
	 */
	function oraiste_core_register_fullscreen_menu( $menus ) {
		$menus['fullscreen-menu-navigation'] = esc_html__( 'Fullscreen Navigation', 'oraiste-core' );

		return $menus;
	}

	add_filter( 'oraiste_filter_register_navigation_menus', 'oraiste_core_register_fullscreen_menu' );
}

if ( ! function_exists( 'oraiste_core_minimal_header_show_widget_area_three' ) ) {
	/**
	 * Function that set dependency option value for specific module layout
	 *
	 * @param array $options
	 *
	 * @return array
	 */
	function oraiste_core_minimal_header_show_widget_area_three( $options ) {
		$options[] = 'minimal';

		return $options;
	}

	add_filter( 'oraiste_core_filter_widget_area_three_show_option', 'oraiste_core_minimal_header_show_widget_area_three' );
}

if ( ! function_exists( 'oraiste_core_set_fullscreen_menu_typography_styles' ) ) {
	/**
	 * Function that generates module inline styles
	 *
	 * @param string $style
	 *
	 * @return string
	 */
	function oraiste_core_set_fullscreen_menu_typography_styles( $style ) {
		$scope = ORAISTE_CORE_OPTIONS_NAME;

		$first_lvl_styles        = oraiste_core_get_typography_styles( $scope, 'qodef_fullscreen_1st_lvl' );
		$first_lvl_hover_styles  = oraiste_core_get_typography_hover_styles( $scope, 'qodef_fullscreen_1st_lvl' );
		$second_lvl_styles       = oraiste_core_get_typography_styles( $scope, 'qodef_fullscreen_2nd_lvl' );
		$second_lvl_hover_styles = oraiste_core_get_typography_hover_styles( $scope, 'qodef_fullscreen_2nd_lvl' );

		if ( ! empty( $first_lvl_styles ) ) {
			$style .= qode_framework_dynamic_style( '.qodef-fullscreen-menu > ul > li > a', $first_lvl_styles );
		}

		if ( ! empty( $first_lvl_hover_styles ) ) {
			$style .= qode_framework_dynamic_style( '.qodef-fullscreen-menu > ul > li > a:hover', $first_lvl_hover_styles );
		}

		$first_lvl_active_color = oraiste_core_get_option_value( 'admin', 'qodef_fullscreen_1st_lvl_active_color' );

		if ( ! empty( $first_lvl_active_color ) ) {
			$first_lvl_active_styles = array(
				'color' => $first_lvl_active_color,
			);

			$style .= qode_framework_dynamic_style(
				array(
					'.qodef-fullscreen-menu > ul >li.current-menu-ancestor > a',
					'.qodef-fullscreen-menu > ul >li.current-menu-item > a',
				),
				$first_lvl_active_styles
			);
		}

		if ( ! empty( $second_lvl_styles ) ) {
			$style .= qode_framework_dynamic_style( '.qodef-fullscreen-menu .qodef-drop-down-second-inner ul li > a', $second_lvl_styles );
		}

		if ( ! empty( $second_lvl_hover_styles ) ) {
			$style .= qode_framework_dynamic_style( '.qodef-fullscreen-menu .qodef-drop-down-second-inner ul li > a:hover', $second_lvl_hover_styles );
		}

		$second_lvl_active_color = oraiste_core_get_option_value( 'admin', 'qodef_fullscreen_2nd_lvl_active_color' );

		if ( ! empty( $second_lvl_active_color ) ) {
			$second_lvl_active_styles = array(
				'color' => $second_lvl_active_color,
			);

			$style .= qode_framework_dynamic_style(
				array(
					'.qodef-fullscreen-menu .qodef-drop-down-second ul li.current-menu-ancestor > a',
					'.qodef-fullscreen-menu .qodef-drop-down-second ul li.current-menu-item > a',
				),
				$second_lvl_active_styles
			);
		}

		return $style;
	}

	add_filter( 'oraiste_filter_add_inline_style', 'oraiste_core_set_fullscreen_menu_typography_styles' );
}

if ( ! function_exists( 'oraiste_core_fullscreen_menu_styles' ) ) {
	/**
	 * Function that generates module inline styles
	 *
	 * @param string $style
	 *
	 * @return string
	 */
	function oraiste_core_fullscreen_menu_styles( $style ) {
		$background_image = oraiste_core_get_post_value_through_levels( 'qodef_fullscreen_menu_background_image' );

		$holder_styles = array();

		if ( ! empty( $background_image ) ) {
			$holder_styles['background-image'] = 'url(' . esc_url( wp_get_attachment_image_url( $background_image, 'full' ) ) . ')';
		}

		if ( ! empty( $holder_styles ) ) {
			$style .= qode_framework_dynamic_style( '#qodef-fullscreen-area', $holder_styles );
		}

		return $style;
	}

	add_filter( 'oraiste_filter_add_inline_style', 'oraiste_core_fullscreen_menu_styles' );
}
