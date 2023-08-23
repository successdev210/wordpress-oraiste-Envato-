<?php

if ( ! function_exists( 'oraiste_core_add_minimal_mobile_header_global_option' ) ) {
	/**
	 * This function set header type value for global header option map
	 *
	 * @param array $header_layout_options
	 *
	 * @return array
	 */
	function oraiste_core_add_minimal_mobile_header_global_option( $header_layout_options ) {
		$header_layout_options['minimal'] = array(
			'image' => ORAISTE_CORE_MOBILE_HEADER_LAYOUTS_URL_PATH . '/minimal/assets/img/minimal-header.png',
			'label' => esc_html__( 'Minimal', 'oraiste-core' ),
		);

		return $header_layout_options;
	}

	add_filter( 'oraiste_core_filter_mobile_header_layout_option', 'oraiste_core_add_minimal_mobile_header_global_option' );
}

if ( ! function_exists( 'oraiste_core_register_minimal_mobile_header_layout' ) ) {
	/**
	 * This function add header layout into global options list
	 *
	 * @param array $mobile_header_layouts
	 *
	 * @return array
	 */
	function oraiste_core_register_minimal_mobile_header_layout( $mobile_header_layouts ) {
		$mobile_header_layouts['minimal'] = 'OraisteCore_Minimal_Mobile_Header';

		return $mobile_header_layouts;
	}

	add_filter( 'oraiste_core_filter_register_mobile_header_layouts', 'oraiste_core_register_minimal_mobile_header_layout' );
}

if ( ! function_exists( 'oraiste_core_minimal_mobile_header_hide_menu_typography' ) ) {
	/**
	 * Function that set dependency option value for specific module layout
	 *
	 * @param array $options
	 *
	 * @return array
	 */
	function oraiste_core_minimal_mobile_header_hide_menu_typography( $options ) {
		$options[] = 'minimal';

		return $options;
	}

	add_filter( 'oraiste_core_filter_mobile_menu_typography_hide_option', 'oraiste_core_minimal_mobile_header_hide_menu_typography' );
}
