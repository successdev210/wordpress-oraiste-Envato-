<?php

if ( ! function_exists( 'oraiste_core_add_social_share_variation_text' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function oraiste_core_add_social_share_variation_text( $variations ) {
		$variations['text'] = esc_html__( 'Text', 'oraiste-core' );

		return $variations;
	}

	add_filter( 'oraiste_core_filter_social_share_layouts', 'oraiste_core_add_social_share_variation_text' );
}
