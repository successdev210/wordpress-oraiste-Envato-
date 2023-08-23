<?php

if ( ! function_exists( 'oraiste_core_add_horizontal_portfolio_list_variation_info_below' ) ) {
	function oraiste_core_add_horizontal_portfolio_list_variation_info_below( $variations ) {
		$variations['info-below'] = esc_html__( 'Info Below', 'oraiste-core' );

		return $variations;
	}

	add_filter( 'oraiste_core_filter_horizontal_portfolio_list_layouts', 'oraiste_core_add_horizontal_portfolio_list_variation_info_below' );
}
