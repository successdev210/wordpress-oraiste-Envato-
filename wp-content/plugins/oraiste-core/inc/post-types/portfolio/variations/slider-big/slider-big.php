<?php

if ( ! function_exists( 'oraiste_core_add_portfolio_single_variation_slider_big' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function oraiste_core_add_portfolio_single_variation_slider_big( $variations ) {
		$variations['slider-big'] = esc_html__( 'Slider - Big', 'oraiste-core' );

		return $variations;
	}

	add_filter( 'oraiste_core_filter_portfolio_single_layout_options', 'oraiste_core_add_portfolio_single_variation_slider_big' );
}
