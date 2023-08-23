<?php

if ( ! function_exists( 'oraiste_core_add_portfolio_list_variation_info_on_hover' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function oraiste_core_add_portfolio_list_variation_info_on_hover( $variations ) {
		$variations['info-on-hover'] = esc_html__( 'Info On Hover', 'oraiste-core' );

		return $variations;
	}

	add_filter( 'oraiste_core_filter_portfolio_list_layouts', 'oraiste_core_add_portfolio_list_variation_info_on_hover' );
}
