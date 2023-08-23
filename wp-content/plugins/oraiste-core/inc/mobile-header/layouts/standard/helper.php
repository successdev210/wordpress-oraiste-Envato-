<?php

if ( ! function_exists( 'oraiste_core_add_standard_mobile_header_global_option' ) ) {
	/**
	 * This function set header type value for global header option map
	 */
	function oraiste_core_add_standard_mobile_header_global_option( $header_layout_options ) {
		$header_layout_options['standard'] = array(
			'image' => ORAISTE_CORE_MOBILE_HEADER_LAYOUTS_URL_PATH . '/standard/assets/img/standard-header.png',
			'label' => esc_html__( 'Standard', 'oraiste-core' ),
		);

		return $header_layout_options;
	}

	add_filter( 'oraiste_core_filter_mobile_header_layout_option', 'oraiste_core_add_standard_mobile_header_global_option' );
}

if ( ! function_exists( 'oraiste_core_add_standard_mobile_header_as_default_global_option' ) ) {
	/**
	 * This function set default value for global mobile header option map
	 */
	function oraiste_core_add_standard_mobile_header_as_default_global_option() {
		return 'standard';
	}

	add_filter( 'oraiste_core_filter_mobile_header_layout_default_option', 'oraiste_core_add_standard_mobile_header_as_default_global_option' );
}

if ( ! function_exists( 'oraiste_core_register_standard_mobile_header_layout' ) ) {
	/**
	 * This function add header layout into global options list
	 *
	 * @param array $mobile_header_layouts
	 *
	 * @return array
	 */
	function oraiste_core_register_standard_mobile_header_layout( $mobile_header_layouts ) {
		$mobile_header_layouts['standard'] = 'OraisteCore_Standard_Mobile_Header';

		return $mobile_header_layouts;
	}

	add_filter( 'oraiste_core_filter_register_mobile_header_layouts', 'oraiste_core_register_standard_mobile_header_layout' );
}
