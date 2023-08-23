<?php

if ( ! function_exists( 'oraiste_core_filter_portfolio_list_info_on_hover_fade_in' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function oraiste_core_filter_portfolio_list_info_on_hover_fade_in( $variations ) {
		$variations['fade-in'] = esc_html__( 'Fade In', 'oraiste-core' );

		return $variations;
	}

	add_filter( 'oraiste_core_filter_portfolio_list_info_on_hover_animation_options', 'oraiste_core_filter_portfolio_list_info_on_hover_fade_in' );
}
