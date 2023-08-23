<?php

if ( ! function_exists( 'oraiste_load_page_mobile_header' ) ) {
	/**
	 * Function which loads page template module
	 */
	function oraiste_load_page_mobile_header() {
		// Include mobile header template
		echo apply_filters( 'oraiste_filter_mobile_header_template', oraiste_get_template_part( 'mobile-header', 'templates/mobile-header' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}

	add_action( 'oraiste_action_page_header_template', 'oraiste_load_page_mobile_header' );
}

if ( ! function_exists( 'oraiste_register_mobile_navigation_menus' ) ) {
	/**
	 * Function which registers navigation menus
	 */
	function oraiste_register_mobile_navigation_menus() {
		$navigation_menus = apply_filters( 'oraiste_filter_register_mobile_navigation_menus', array( 'mobile-navigation' => esc_html__( 'Mobile Navigation', 'oraiste' ) ) );

		if ( ! empty( $navigation_menus ) ) {
			register_nav_menus( $navigation_menus );
		}
	}

	add_action( 'oraiste_action_after_include_modules', 'oraiste_register_mobile_navigation_menus' );
}
