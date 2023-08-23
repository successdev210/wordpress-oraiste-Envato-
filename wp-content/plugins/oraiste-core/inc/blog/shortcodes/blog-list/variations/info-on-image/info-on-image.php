<?php

if ( ! function_exists( 'oraiste_core_add_blog_list_variation_info_on_image' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function oraiste_core_add_blog_list_variation_info_on_image( $variations ) {
		$variations['info-on-image'] = esc_html__( 'Info On Image', 'oraiste-core' );

		return $variations;
	}

	add_filter( 'oraiste_core_filter_blog_list_layouts', 'oraiste_core_add_blog_list_variation_info_on_image' );
}
