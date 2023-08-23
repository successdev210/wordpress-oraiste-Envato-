<?php

if ( ! function_exists( 'oraiste_core_add_switch_header_global_option' ) ) {
	/**
	 * This function set header type value for global header option map
	 */
	function oraiste_core_add_switch_header_global_option( $header_layout_options ) {
		$header_layout_options['switch'] = array(
			'image' => ORAISTE_CORE_HEADER_LAYOUTS_URL_PATH . '/switch/assets/img/switch-header.png',
			'label' => esc_html__( 'Switch', 'oraiste-core' ),
		);

		return $header_layout_options;
	}

	add_filter( 'oraiste_core_filter_header_layout_option', 'oraiste_core_add_switch_header_global_option' );
}

if ( ! function_exists( 'oraiste_core_register_switch_header_layout' ) ) {
	/**
	 * Function which add header layout into global list
	 *
	 * @param array $header_layouts
	 *
	 * @return array
	 */
	function oraiste_core_register_switch_header_layout( $header_layouts ) {
		$header_layout = array(
			'switch' => 'OraisteCore_Switch_Header',
		);

		$header_layouts = array_merge( $header_layouts, $header_layout );

		return $header_layouts;
	}

	add_filter( 'oraiste_core_filter_register_header_layouts', 'oraiste_core_register_switch_header_layout' );
}


if ( ! function_exists( 'oraiste_core_register_switch_menu' ) ) {
	/**
	 * Function which add additional main menu navigation into global list
	 *
	 * @param array $menus
	 *
	 * @return array
	 */
	function oraiste_core_register_switch_menu( $menus ) {
		$menus['switch-menu-navigation'] = esc_html__( 'Switch Navigation', 'oraiste-core' );

		return $menus;
	}

	add_filter( 'oraiste_filter_register_navigation_menus', 'oraiste_core_register_switch_menu' );
}

if ( ! function_exists( 'oraiste_core_switch_header_hide_scroll_appearance' ) ) {
	/**
	 * Function that set dependency option value for specific module layout
	 *
	 * @param array $options
	 *
	 * @return array
	 */
	function oraiste_core_switch_header_hide_scroll_appearance( $options ) {
		$options[] = 'switch';

		return $options;
	}

	add_filter( 'oraiste_core_filter_header_scroll_appearance_hide_option', 'oraiste_core_switch_header_hide_scroll_appearance' );
}
