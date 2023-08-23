<?php

if ( ! function_exists( 'oraiste_core_include_instagram_shortcodes' ) ) {
	/**
	 * Function that includes shortcodes
	 */
	function oraiste_core_include_instagram_shortcodes() {
		foreach ( glob( ORAISTE_CORE_PLUGINS_PATH . '/instagram/shortcodes/*/include.php' ) as $shortcode ) {
			include_once $shortcode;
		}
	}

	add_action( 'qode_framework_action_before_shortcodes_register', 'oraiste_core_include_instagram_shortcodes' );
}

if ( ! function_exists( 'oraiste_core_include_instagram_widgets' ) ) {
	/**
	 * Function that includes widgets
	 */
	function oraiste_core_include_instagram_widgets() {
		foreach ( glob( ORAISTE_CORE_PLUGINS_PATH . '/instagram/shortcodes/*/widget/include.php' ) as $widget ) {
			include_once $widget;
		}
	}

	add_action( 'qode_framework_action_before_widgets_register', 'oraiste_core_include_instagram_widgets' );
}

if ( ! function_exists( 'oraiste_core_include_instagram_plugin_is_installed' ) ) {
	/**
	 * Function that set case is installed element for framework functionality
	 *
	 * @param bool $installed
	 * @param string $plugin - plugin name
	 *
	 * @return bool
	 */
	function oraiste_core_include_instagram_plugin_is_installed( $installed, $plugin ) {
		if ( 'instagram' === $plugin ) {
			return defined( 'SBIVER' );
		}

		return $installed;
	}

	add_filter( 'qode_framework_filter_is_plugin_installed', 'oraiste_core_include_instagram_plugin_is_installed', 10, 2 );
}
