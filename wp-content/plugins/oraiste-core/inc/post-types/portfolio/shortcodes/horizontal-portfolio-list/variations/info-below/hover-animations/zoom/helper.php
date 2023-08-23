<?php

if ( ! function_exists( 'oraiste_core_filter_horizontal_portfolio_list_info_below_zoom' ) ) {
	function oraiste_core_filter_horizontal_portfolio_list_info_below_zoom( $variations ) {
		$variations['zoom'] = esc_html__( 'Zoom', 'oraiste-core' );
		
		return $variations;
	}
	
	add_filter( 'oraiste_core_filter_horizontal_portfolio_list_info_below_animation_options', 'oraiste_core_filter_horizontal_portfolio_list_info_below_zoom' );
}