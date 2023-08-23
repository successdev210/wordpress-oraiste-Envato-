<?php

if ( ! function_exists( 'oraiste_core_add_portfolio_list_variation_info_bottom' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function oraiste_core_add_portfolio_list_variation_info_bottom( $variations ) {
		$variations['info-bottom'] = esc_html__( 'Info Bottom', 'oraiste-core' );

		return $variations;
	}

	add_filter( 'oraiste_core_filter_portfolio_list_layouts', 'oraiste_core_add_portfolio_list_variation_info_bottom' );
}
