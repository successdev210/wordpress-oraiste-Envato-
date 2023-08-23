<?php

if ( ! function_exists( 'oraiste_get_filter_items' ) ) {
	/**
	 * Function that return filter items from query parameters
	 *
	 * @param array $params - options value
	 *
	 * @return array
	 */
	function oraiste_get_filter_items( $params ) {
		$taxonomy = isset( $params['taxonomy_filter'] ) && ! empty( $params['taxonomy_filter'] ) ? esc_attr( $params['taxonomy_filter'] ) : 'category';

		// Check is taxonomy set through option and set that value instead of the default one
		if ( isset( $params['tax'] ) && ! empty( $params['tax'] ) ) {
			$taxonomy = esc_attr( $params['tax'] );
		}

		$custom_query = false;

		$args = array(
			'taxonomy' => $taxonomy,
		);

		if ( isset( $params['tax_slug'] ) && ! empty( $params['tax_slug'] ) ) {
			$custom_query      = true;
			$specific_taxonomy = get_term_by( 'slug', esc_attr( $params['tax_slug'] ), $taxonomy );

			if ( isset( $specific_taxonomy->term_id ) && '' !== $specific_taxonomy->term_id ) {
				$child_taxonomies = get_term_children( $specific_taxonomy->term_id, $taxonomy );

				if ( ! empty( $child_taxonomies ) ) {
					$args['include'] = $child_taxonomies;
				} else {
					$args['slug'] = esc_attr( $params['tax_slug'] );
				}
			}
		}

		if ( isset( $params['tax__in'] ) && ! empty( $params['tax__in'] ) ) {
			$custom_query    = true;
			$args['include'] = explode( ',', str_replace( ' ', '', $params['tax__in'] ) );
		}

		if ( ! $custom_query ) {
			$args['parent'] = 0;
		}

		$terms = get_terms( $args );
		$items = ! empty( $terms ) ? $terms : '';

		return apply_filters( 'oraiste_filter_get_filter_items', $items, $params );
	}
}
