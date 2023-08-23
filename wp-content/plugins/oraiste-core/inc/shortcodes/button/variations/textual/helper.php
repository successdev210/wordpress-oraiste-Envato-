<?php

if ( ! function_exists( 'oraiste_core_add_button_variation_textual' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function oraiste_core_add_button_variation_textual( $variations ) {
		$variations['textual'] = esc_html__( 'Textual', 'oraiste-core' );

		return $variations;
	}

	add_filter( 'oraiste_core_filter_button_layouts', 'oraiste_core_add_button_variation_textual' );
}
