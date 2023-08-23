<?php

if ( ! function_exists( 'oraiste_core_add_image_with_text_variation_text_below' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function oraiste_core_add_image_with_text_variation_text_below( $variations ) {
		$variations['text-below'] = esc_html__( 'Text Below', 'oraiste-core' );

		return $variations;
	}

	add_filter( 'oraiste_core_filter_image_with_text_layouts', 'oraiste_core_add_image_with_text_variation_text_below' );
}
