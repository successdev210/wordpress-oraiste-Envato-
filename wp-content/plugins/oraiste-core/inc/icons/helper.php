<?php

if ( ! function_exists( 'oraiste_core_include_icons' ) ) {
	/**
	 * Function that includes icons
	 */
	function oraiste_core_include_icons() {

		foreach ( glob( ORAISTE_CORE_INC_PATH . '/icons/*/include.php' ) as $icon_pack ) {
			$is_disabled = oraiste_core_performance_get_option_value( dirname( $icon_pack ), 'oraiste_core_performance_icon_pack_' );

			if ( empty( $is_disabled ) ) {
				include_once $icon_pack;
			}
		}
	}

	add_action( 'qode_framework_action_before_icons_register', 'oraiste_core_include_icons' );
}
