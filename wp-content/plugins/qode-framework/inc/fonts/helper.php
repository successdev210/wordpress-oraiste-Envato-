<?php

if ( ! function_exists( 'qode_framework_get_formatted_font_family' ) ) {
	/**
	 * Function that returns formatted font family name
	 *
	 * @param string $value
	 * @param bool $reverse
	 *
	 * @return string
	 */
	function qode_framework_get_formatted_font_family( $value, $reverse = false ) {
		return $reverse ? str_replace( ' ', '+', $value ) : str_replace( '+', ' ', $value );
	}
}

if ( ! function_exists( 'qode_framework_get_web_safe_fonts_list' ) ) {
	/**
	 * Function that returns array of web safe fonts
	 *
	 * @return array
	 */
	function qode_framework_get_web_safe_fonts_list() {

		return apply_filters(
			'qode_framework_filter_web_safe_fonts_list',
			array(
				'Arial',
				'Arial Black',
				'Comic Sans MS',
				'Courier New',
				'Georgia',
				'Impact',
				'Lucida Console',
				'Lucida Sans Unicode',
				'Palatino Linotype',
				'Tahoma',
				'Times New Roman',
				'Trebuchet MS',
				'Verdana',
			)
		);
	}
}

if ( ! function_exists( 'qode_framework_is_web_safe_font' ) ) {
	/**
	 * Function that checks if given font is native font
	 *
	 * @param string $font_family
	 *
	 * @return bool
	 */
	function qode_framework_is_web_safe_font( $font_family ) {
		return in_array( qode_framework_get_formatted_font_family( $font_family ), qode_framework_get_web_safe_fonts_list(), true );
	}
}

if ( ! function_exists( 'qode_framework_get_web_safe_fonts' ) ) {
	/**
	 * Function that returns array of web safe fonts
	 *
	 * @return array
	 */
	function qode_framework_get_web_safe_fonts() {
		$fonts_array    = array();
		$web_safe_fonts = qode_framework_get_web_safe_fonts_list();

		if ( ! empty( $web_safe_fonts ) ) {
			foreach ( $web_safe_fonts as $web_safe_font ) {
				$font_key                 = qode_framework_get_formatted_font_family( $web_safe_font, true );
				$fonts_array[ $font_key ] = $web_safe_font;
			}
		}

		return $fonts_array;
	}
}

if ( ! function_exists( 'qode_framework_get_google_fonts' ) ) {
	/**
	 * Function that returns array of google fonts
	 *
	 * @return array
	 */
	function qode_framework_get_google_fonts() {
		$google_fonts_array = array();

		$google_fonts_json         = qode_framework_get_google_fonts_json();
		$google_fonts_json_decoded = json_decode( $google_fonts_json, true );
		$google_fonts_json_decoded = $google_fonts_json_decoded['items'];

		foreach ( $google_fonts_json_decoded as $font ) {
			$font_key                        = qode_framework_get_formatted_font_family( $font['family'], true );
			$google_fonts_array[ $font_key ] = $font['family'];
		}

		return apply_filters( 'qode_framework_filter_google_fonts', $google_fonts_array );
	}
}

if ( ! function_exists( 'qode_framework_get_complete_fonts_array' ) ) {
	/**
	 * Function that returns array of fonts
	 *
	 * @return array
	 */
	function qode_framework_get_complete_fonts_array() {
		$web_safe_fonts = qode_framework_get_web_safe_fonts();

		$complete_fonts_array = array_merge( array( '' => esc_attr__( 'Default', 'qode-framework' ) ), $web_safe_fonts );

		return apply_filters( 'qode_framework_filter_complete_fonts_list', $complete_fonts_array );
	}
}

if ( ! function_exists( 'qode_framework_add_custom_upload_mimes' ) ) {
	/**
	 * Function that extend default upload mimes types
	 *
	 * @return array
	 */
	function qode_framework_add_custom_upload_mimes( $existing_mimes ) {
		$existing_mimes['ttf']   = 'font/ttf';
		$existing_mimes['otf']   = 'font/otf';
		$existing_mimes['woff']  = 'font/woff';
		$existing_mimes['woff2'] = 'font/woff2';

		return $existing_mimes;
	}

	add_filter( 'upload_mimes', 'qode_framework_add_custom_upload_mimes' );
}
