<?php

if ( ! function_exists( 'oraiste_core_add_interactive_portfolio_list_variation_numbered_list' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function oraiste_core_add_interactive_portfolio_list_variation_numbered_list( $variations ) {
		$variations['numbered-list'] = esc_html__( 'Numbered List', 'oraiste-core' );

		return $variations;
	}

	add_filter( 'oraiste_core_filter_interactive_portfolio_list_layouts', 'oraiste_core_add_interactive_portfolio_list_variation_numbered_list' );
}
