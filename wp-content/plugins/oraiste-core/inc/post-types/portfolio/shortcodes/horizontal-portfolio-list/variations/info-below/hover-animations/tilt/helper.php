<?php

if ( ! function_exists( 'oraiste_core_filter_horizontal_portfolio_list_info_below_tilt' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function oraiste_core_filter_horizontal_portfolio_list_info_below_tilt( $variations ) {
		$variations['tilt'] = esc_html__( 'Tilt', 'oraiste-core' );
		
		return $variations;
	}
	
	add_filter( 'oraiste_core_filter_horizontal_portfolio_list_info_below_animation_options', 'oraiste_core_filter_horizontal_portfolio_list_info_below_tilt' );
}