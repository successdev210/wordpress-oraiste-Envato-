<?php

if ( ! function_exists( 'oraiste_core_set_page_content_styles' ) ) {
	/**
	 * Function that generates module inline styles
	 *
	 * @param string $style
	 *
	 * @return string
	 */
	function oraiste_core_set_page_content_styles( $style ) {
		$styles = array();

		$content_margin = apply_filters( 'oraiste_core_filter_content_margin', 0 );

		if ( 0 !== $content_margin ) {
			$styles['margin-top'] = '-' . intval( $content_margin ) . 'px';
		}

		if ( ! empty( $styles ) ) {
			$style .= qode_framework_dynamic_style( '#qodef-page-outer', $styles );
		}

		$style_mobile          = array();
		$content_margin_mobile = apply_filters( 'oraiste_core_filter_content_margin_mobile', 0 );

		if ( 0 !== $content_margin_mobile ) {
			$style_mobile['margin-top'] = '-' . intval( $content_margin_mobile ) . 'px';
		}

		if ( ! empty( $style_mobile ) ) {
			$style .= qode_framework_dynamic_style_responsive( '#qodef-page-outer', $style_mobile, '', '1024' );
		}

		return $style;
	}

	add_filter( 'oraiste_filter_add_inline_style', 'oraiste_core_set_page_content_styles' );
}
