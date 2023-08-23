<?php

if ( ! function_exists( 'oraiste_core_add_fixed_header_option' ) ) {
	/**
	 * This function set header scrolling appearance value for global header option map
	 */
	function oraiste_core_add_fixed_header_option( $options ) {
		$options['fixed'] = esc_html__( 'Fixed', 'oraiste-core' );

		return $options;
	}

	add_filter( 'oraiste_core_filter_header_scroll_appearance_option', 'oraiste_core_add_fixed_header_option' );
}
