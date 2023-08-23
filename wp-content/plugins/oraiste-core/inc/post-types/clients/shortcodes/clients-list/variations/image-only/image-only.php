<?php

if ( ! function_exists( 'oraiste_core_add_clients_list_variation_image_only' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function oraiste_core_add_clients_list_variation_image_only( $variations ) {
		$variations['image-only'] = esc_html__( 'Image Only', 'oraiste-core' );

		return $variations;
	}

	add_filter( 'oraiste_core_filter_clients_list_layouts', 'oraiste_core_add_clients_list_variation_image_only' );
}
