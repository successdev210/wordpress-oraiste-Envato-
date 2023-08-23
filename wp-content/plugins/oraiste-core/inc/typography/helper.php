<?php

if ( ! function_exists( 'oraiste_core_set_general_typography_styles' ) ) {
	/**
	 * Function that generates module inline styles
	 *
	 * @param string $style
	 *
	 * @return string
	 */
	function oraiste_core_set_general_typography_styles( $style ) {
		$scope = ORAISTE_CORE_OPTIONS_NAME;

		$body_styles       = oraiste_core_get_typography_styles( $scope, 'qodef_p', 'body' );
		$p_styles          = oraiste_core_get_typography_styles( $scope, 'qodef_p', 'p' );
		$h1_styles         = oraiste_core_get_typography_styles( $scope, 'qodef_h1' );
		$h1_link_styles    = oraiste_core_get_typography_hover_styles( $scope, 'qodef_h1_link' );
		$h2_styles         = oraiste_core_get_typography_styles( $scope, 'qodef_h2' );
		$h2_link_styles    = oraiste_core_get_typography_hover_styles( $scope, 'qodef_h2_link' );
		$h3_styles         = oraiste_core_get_typography_styles( $scope, 'qodef_h3' );
		$h3_link_styles    = oraiste_core_get_typography_hover_styles( $scope, 'qodef_h3_link' );
		$h4_styles         = oraiste_core_get_typography_styles( $scope, 'qodef_h4' );
		$h4_link_styles    = oraiste_core_get_typography_hover_styles( $scope, 'qodef_h4_link' );
		$h5_styles         = oraiste_core_get_typography_styles( $scope, 'qodef_h5' );
		$h5_link_styles    = oraiste_core_get_typography_hover_styles( $scope, 'qodef_h5_link' );
		$h6_styles         = oraiste_core_get_typography_styles( $scope, 'qodef_h6' );
		$h6_link_styles    = oraiste_core_get_typography_hover_styles( $scope, 'qodef_h6_link' );
		$link_styles       = oraiste_core_get_typography_styles( $scope, 'qodef_link' );
		$link_hover_styles = oraiste_core_get_typography_hover_styles( $scope, 'qodef_link' );

		if ( ! empty( $body_styles ) ) {
			$style .= qode_framework_dynamic_style( 'body', $body_styles );
		}

		if ( ! empty( $p_styles ) ) {
			$style .= qode_framework_dynamic_style( 'p', $p_styles );
		}

		if ( ! empty( $h1_styles ) ) {
			$style .= qode_framework_dynamic_style( 'h1, .qodef-h1', $h1_styles );
		}

		if ( ! empty( $h2_styles ) ) {
			$style .= qode_framework_dynamic_style( 'h2, .qodef-h2', $h2_styles );
		}

		if ( ! empty( $h3_styles ) ) {
			$style .= qode_framework_dynamic_style( 'h3, .qodef-h3', $h3_styles );
		}

		if ( ! empty( $h4_styles ) ) {
			$style .= qode_framework_dynamic_style( 'h4, .qodef-h4', $h4_styles );
		}

		if ( ! empty( $h5_styles ) ) {
			$style .= qode_framework_dynamic_style( 'h5, .qodef-h5', $h5_styles );
		}

		if ( ! empty( $h6_styles ) ) {
			$style .= qode_framework_dynamic_style( 'h6, .qodef-h6', $h6_styles );
		}

		if ( ! empty( $link_styles ) ) {
			$style .= qode_framework_dynamic_style( array( 'a', 'p a' ), $link_styles );
		}

		if ( ! empty( $link_hover_styles ) ) {
			$style .= qode_framework_dynamic_style( array( 'a:hover', 'p a:hover' ), $link_hover_styles );
		}

		// Headings hover style

		if ( ! empty( $h1_link_styles ) ) {
			$style .= qode_framework_dynamic_style( array( 'h1 a:hover', 'h1 a:focus' ), $h1_link_styles );
		}

		if ( ! empty( $h2_link_styles ) ) {
			$style .= qode_framework_dynamic_style( array( 'h2 a:hover', 'h2 a:focus' ), $h2_link_styles );
		}

		if ( ! empty( $h3_link_styles ) ) {
			$style .= qode_framework_dynamic_style( array( 'h3 a:hover', 'h3 a:focus' ), $h3_link_styles );
		}

		if ( ! empty( $h4_link_styles ) ) {
			$style .= qode_framework_dynamic_style( array( 'h4 a:hover', 'h4 a:focus' ), $h4_link_styles );
		}

		if ( ! empty( $h5_link_styles ) ) {
			$style .= qode_framework_dynamic_style( array( 'h5 a:hover', 'h5 a:focus' ), $h5_link_styles );
		}

		if ( ! empty( $h6_link_styles ) ) {
			$style .= qode_framework_dynamic_style( array( 'h6 a:hover', 'h6 a:focus' ), $h6_link_styles );
		}

		return $style;
	}

	add_filter( 'oraiste_filter_add_inline_style', 'oraiste_core_set_general_typography_styles' );
}

if ( ! function_exists( 'oraiste_core_set_general_typography_responsive_1366_styles' ) ) {
	/**
	 * Function that generates module inline styles
	 *
	 * @param string $style
	 *
	 * @return string
	 */
	function oraiste_core_set_general_typography_responsive_1366_styles( $style ) {
		$scope = ORAISTE_CORE_OPTIONS_NAME;

		$p_styles  = oraiste_core_get_typography_styles( $scope, 'qodef_p_responsive_1366' );
		$h1_styles = oraiste_core_get_typography_styles( $scope, 'qodef_h1_responsive_1366' );
		$h2_styles = oraiste_core_get_typography_styles( $scope, 'qodef_h2_responsive_1366' );
		$h3_styles = oraiste_core_get_typography_styles( $scope, 'qodef_h3_responsive_1366' );
		$h4_styles = oraiste_core_get_typography_styles( $scope, 'qodef_h4_responsive_1366' );
		$h5_styles = oraiste_core_get_typography_styles( $scope, 'qodef_h5_responsive_1366' );
		$h6_styles = oraiste_core_get_typography_styles( $scope, 'qodef_h6_responsive_1366' );

		if ( ! empty( $p_styles ) ) {
			$style .= qode_framework_dynamic_style( 'p', $p_styles );
		}

		if ( ! empty( $h1_styles ) ) {
			$style .= qode_framework_dynamic_style( 'h1, .qodef-h1', $h1_styles );
		}

		if ( ! empty( $h2_styles ) ) {
			$style .= qode_framework_dynamic_style( 'h2, .qodef-h2', $h2_styles );
		}

		if ( ! empty( $h3_styles ) ) {
			$style .= qode_framework_dynamic_style( 'h3, .qodef-h3', $h3_styles );
		}

		if ( ! empty( $h4_styles ) ) {
			$style .= qode_framework_dynamic_style( 'h4, .qodef-h4', $h4_styles );
		}

		if ( ! empty( $h5_styles ) ) {
			$style .= qode_framework_dynamic_style( 'h5, .qodef-h5', $h5_styles );
		}

		if ( ! empty( $h6_styles ) ) {
			$style .= qode_framework_dynamic_style( 'h6, .qodef-h6', $h6_styles );
		}

		return $style;
	}

	add_filter( 'oraiste_core_filter_add_responsive_1366_inline_style', 'oraiste_core_set_general_typography_responsive_1366_styles' );
}

if ( ! function_exists( 'oraiste_core_set_general_typography_responsive_1024_styles' ) ) {
	/**
	 * Function that generates module inline styles
	 *
	 * @param string $style
	 *
	 * @return string
	 */
	function oraiste_core_set_general_typography_responsive_1024_styles( $style ) {
		$scope = ORAISTE_CORE_OPTIONS_NAME;

		$p_styles  = oraiste_core_get_typography_styles( $scope, 'qodef_p_responsive_1024' );
		$h1_styles = oraiste_core_get_typography_styles( $scope, 'qodef_h1_responsive_1024' );
		$h2_styles = oraiste_core_get_typography_styles( $scope, 'qodef_h2_responsive_1024' );
		$h3_styles = oraiste_core_get_typography_styles( $scope, 'qodef_h3_responsive_1024' );
		$h4_styles = oraiste_core_get_typography_styles( $scope, 'qodef_h4_responsive_1024' );
		$h5_styles = oraiste_core_get_typography_styles( $scope, 'qodef_h5_responsive_1024' );
		$h6_styles = oraiste_core_get_typography_styles( $scope, 'qodef_h6_responsive_1024' );

		if ( ! empty( $p_styles ) ) {
			$style .= qode_framework_dynamic_style( 'p', $p_styles );
		}

		if ( ! empty( $h1_styles ) ) {
			$style .= qode_framework_dynamic_style( 'h1, .qodef-h1', $h1_styles );
		}

		if ( ! empty( $h2_styles ) ) {
			$style .= qode_framework_dynamic_style( 'h2, .qodef-h2', $h2_styles );
		}

		if ( ! empty( $h3_styles ) ) {
			$style .= qode_framework_dynamic_style( 'h3, .qodef-h3', $h3_styles );
		}

		if ( ! empty( $h4_styles ) ) {
			$style .= qode_framework_dynamic_style( 'h4, .qodef-h4', $h4_styles );
		}

		if ( ! empty( $h5_styles ) ) {
			$style .= qode_framework_dynamic_style( 'h5, .qodef-h5', $h5_styles );
		}

		if ( ! empty( $h6_styles ) ) {
			$style .= qode_framework_dynamic_style( 'h6, .qodef-h6', $h6_styles );
		}

		return $style;
	}

	add_filter( 'oraiste_core_filter_add_responsive_1024_inline_style', 'oraiste_core_set_general_typography_responsive_1024_styles' );
}

if ( ! function_exists( 'oraiste_core_set_general_typography_responsive_768_styles' ) ) {
	/**
	 * Function that generates module inline styles
	 *
	 * @param string $style
	 *
	 * @return string
	 */
	function oraiste_core_set_general_typography_responsive_768_styles( $style ) {
		$scope = ORAISTE_CORE_OPTIONS_NAME;

		$p_styles  = oraiste_core_get_typography_styles( $scope, 'qodef_p_responsive_768' );
		$h1_styles = oraiste_core_get_typography_styles( $scope, 'qodef_h1_responsive_768' );
		$h2_styles = oraiste_core_get_typography_styles( $scope, 'qodef_h2_responsive_768' );
		$h3_styles = oraiste_core_get_typography_styles( $scope, 'qodef_h3_responsive_768' );
		$h4_styles = oraiste_core_get_typography_styles( $scope, 'qodef_h4_responsive_768' );
		$h5_styles = oraiste_core_get_typography_styles( $scope, 'qodef_h5_responsive_768' );
		$h6_styles = oraiste_core_get_typography_styles( $scope, 'qodef_h6_responsive_768' );

		if ( ! empty( $p_styles ) ) {
			$style .= qode_framework_dynamic_style( 'p', $p_styles );
		}

		if ( ! empty( $h1_styles ) ) {
			$style .= qode_framework_dynamic_style( 'h1, .qodef-h1', $h1_styles );
		}

		if ( ! empty( $h2_styles ) ) {
			$style .= qode_framework_dynamic_style( 'h2, .qodef-h2', $h2_styles );
		}

		if ( ! empty( $h3_styles ) ) {
			$style .= qode_framework_dynamic_style( 'h3, .qodef-h3', $h3_styles );
		}

		if ( ! empty( $h4_styles ) ) {
			$style .= qode_framework_dynamic_style( 'h4, .qodef-h4', $h4_styles );
		}

		if ( ! empty( $h5_styles ) ) {
			$style .= qode_framework_dynamic_style( 'h5, .qodef-h5', $h5_styles );
		}

		if ( ! empty( $h6_styles ) ) {
			$style .= qode_framework_dynamic_style( 'h6, .qodef-h6', $h6_styles );
		}

		return $style;
	}

	add_filter( 'oraiste_core_filter_add_responsive_768_inline_style', 'oraiste_core_set_general_typography_responsive_768_styles' );
}

if ( ! function_exists( 'oraiste_core_set_general_typography_responsive_680_styles' ) ) {
	/**
	 * Function that generates module inline styles
	 *
	 * @param string $style
	 *
	 * @return string
	 */
	function oraiste_core_set_general_typography_responsive_680_styles( $style ) {
		$scope = ORAISTE_CORE_OPTIONS_NAME;

		$p_styles  = oraiste_core_get_typography_styles( $scope, 'qodef_p_responsive_680' );
		$h1_styles = oraiste_core_get_typography_styles( $scope, 'qodef_h1_responsive_680' );
		$h2_styles = oraiste_core_get_typography_styles( $scope, 'qodef_h2_responsive_680' );
		$h3_styles = oraiste_core_get_typography_styles( $scope, 'qodef_h3_responsive_680' );
		$h4_styles = oraiste_core_get_typography_styles( $scope, 'qodef_h4_responsive_680' );
		$h5_styles = oraiste_core_get_typography_styles( $scope, 'qodef_h5_responsive_680' );
		$h6_styles = oraiste_core_get_typography_styles( $scope, 'qodef_h6_responsive_680' );

		if ( ! empty( $p_styles ) ) {
			$style .= qode_framework_dynamic_style( 'p', $p_styles );
		}

		if ( ! empty( $h1_styles ) ) {
			$style .= qode_framework_dynamic_style( 'h1, .qodef-h1', $h1_styles );
		}

		if ( ! empty( $h2_styles ) ) {
			$style .= qode_framework_dynamic_style( 'h2, .qodef-h2', $h2_styles );
		}

		if ( ! empty( $h3_styles ) ) {
			$style .= qode_framework_dynamic_style( 'h3, .qodef-h3', $h3_styles );
		}

		if ( ! empty( $h4_styles ) ) {
			$style .= qode_framework_dynamic_style( 'h4, .qodef-h4', $h4_styles );
		}

		if ( ! empty( $h5_styles ) ) {
			$style .= qode_framework_dynamic_style( 'h5, .qodef-h5', $h5_styles );
		}

		if ( ! empty( $h6_styles ) ) {
			$style .= qode_framework_dynamic_style( 'h6, .qodef-h6', $h6_styles );
		}

		return $style;
	}

	add_filter( 'oraiste_core_filter_add_responsive_680_inline_style', 'oraiste_core_set_general_typography_responsive_680_styles' );
}
