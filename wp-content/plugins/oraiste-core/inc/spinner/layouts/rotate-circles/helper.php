<?php

if ( ! function_exists( 'oraiste_core_add_rotate_circles_spinner_layout_option' ) ) {
	/**
	 * Function that set new value into page spinner layout options map
	 *
	 * @param array $layouts - module layouts
	 *
	 * @return array
	 */
	function oraiste_core_add_rotate_circles_spinner_layout_option( $layouts ) {
		$layouts['rotate-circles'] = esc_html__( 'Rotate Circles', 'oraiste-core' );

		return $layouts;
	}

	add_filter( 'oraiste_core_filter_page_spinner_layout_options', 'oraiste_core_add_rotate_circles_spinner_layout_option' );
}
