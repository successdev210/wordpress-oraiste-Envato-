<?php

if ( ! function_exists( 'oraiste_core_get_post_items' ) ) {
	/**
	 * Function that return list of posts for given post type
	 *
	 * @param $post_type - string
	 *
	 * @return array
	 */
	function oraiste_core_get_post_items( $post_type ) {
		$items[''] = esc_html__( 'Current Item', 'oraiste-core' );
		$args      = array(
			'numberposts' => - 1,
			'post_type'   => $post_type,
		);

		$query_results = get_posts( $args );

		foreach ( $query_results as $query_result ) {
			$items[$query_result->post_name] = $query_result->post_title;
		}

		return $items;
	}
}
