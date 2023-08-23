<?php

if ( ! function_exists( 'oraiste_core_add_single_image_variation_default' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function oraiste_core_add_single_image_variation_default( $variations ) {
		$variations['default'] = esc_html__( 'Default', 'oraiste-core' );

		return $variations;
	}

	add_filter( 'oraiste_core_filter_single_image_layouts', 'oraiste_core_add_single_image_variation_default' );
}
