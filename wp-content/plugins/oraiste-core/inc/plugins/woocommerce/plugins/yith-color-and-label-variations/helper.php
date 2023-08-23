<?php

if ( ! function_exists( 'oraiste_core_include_yith_color_and_label_variations_plugin_is_installed' ) ) {
	/**
	 * Function that set case is installed element for framework functionality
	 *
	 * @param bool $installed
	 * @param string $plugin - plugin name
	 *
	 * @return bool
	 */
	function oraiste_core_include_yith_color_and_label_variations_plugin_is_installed( $installed, $plugin ) {
		if ( 'yith-color-and-label-variations' === $plugin ) {
			return defined( 'YITH_WCCL' );
		}

		return $installed;
	}

	add_filter( 'qode_framework_filter_is_plugin_installed', 'oraiste_core_include_yith_color_and_label_variations_plugin_is_installed', 10, 2 );
}
