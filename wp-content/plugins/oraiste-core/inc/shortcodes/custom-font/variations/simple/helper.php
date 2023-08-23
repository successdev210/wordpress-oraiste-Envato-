<?php

if ( ! function_exists( 'oraiste_core_add_custom_font_variation_simple' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function oraiste_core_add_custom_font_variation_simple( $variations ) {
		$variations['simple'] = esc_html__( 'Simple', 'oraiste-core' );

		return $variations;
	}

	add_filter( 'oraiste_core_filter_custom_font_layouts', 'oraiste_core_add_custom_font_variation_simple' );
}
