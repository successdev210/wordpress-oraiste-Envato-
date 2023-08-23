<?php

if ( ! function_exists( 'oraiste_core_filter_portfolio_list_info_follow' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function oraiste_core_filter_portfolio_list_info_follow( $variations ) {
		$variations['follow'] = esc_html__( 'Follow', 'oraiste-core' );

		return $variations;
	}

	add_filter( 'oraiste_core_filter_portfolio_list_info_follow_animation_options', 'oraiste_core_filter_portfolio_list_info_follow' );
}
