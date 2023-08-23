<?php

if ( ! function_exists( 'oraiste_core_add_team_list_variation_info_on_side' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function oraiste_core_add_team_list_variation_info_on_side( $variations ) {
		$variations['info-on-side'] = esc_html__( 'Info On Side', 'oraiste-core' );

		return $variations;
	}

	add_filter( 'oraiste_core_filter_team_list_layouts', 'oraiste_core_add_team_list_variation_info_on_side' );
}
