<?php

if ( ! function_exists( 'oraiste_core_add_portfolio_single_variation_gallery_big' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function oraiste_core_add_portfolio_single_variation_gallery_big( $variations ) {
		$variations['gallery-big'] = esc_html__( 'Gallery - Big', 'oraiste-core' );

		return $variations;
	}

	add_filter( 'oraiste_core_filter_portfolio_single_layout_options', 'oraiste_core_add_portfolio_single_variation_gallery_big' );
}
