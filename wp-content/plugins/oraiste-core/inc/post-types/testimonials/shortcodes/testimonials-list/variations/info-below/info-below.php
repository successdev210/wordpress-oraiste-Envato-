<?php

if ( ! function_exists( 'oraiste_core_add_testimonials_list_variation_info_below' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function oraiste_core_add_testimonials_list_variation_info_below( $variations ) {
		$variations['info-below'] = esc_html__( 'Info Below', 'oraiste-core' );

		return $variations;
	}

	add_filter( 'oraiste_core_filter_testimonials_list_layouts', 'oraiste_core_add_testimonials_list_variation_info_below' );
}
