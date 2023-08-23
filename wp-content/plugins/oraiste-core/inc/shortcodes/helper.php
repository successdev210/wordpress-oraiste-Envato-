<?php

if ( ! function_exists( 'oraiste_core_get_list_shortcode_item_image' ) ) {
	/**
	 * Function that generates thumbnail img tag for list shortcodes
	 *
	 * @param string $image_dimension
	 * @param int $attachment_id
	 * @param int $custom_image_width
	 * @param int $custom_image_height
	 *
	 * @return string generated img tag
	 *
	 * @see qode_framework_generate_thumbnail()
	 */
	function oraiste_core_get_list_shortcode_item_image( $image_dimension, $attachment_id = 0, $custom_image_width = 0, $custom_image_height = 0 ) {
		$item_id = get_the_ID();

		if ( 'custom' !== $image_dimension ) {
			if ( ! empty( $attachment_id ) ) {
				$html = wp_get_attachment_image( $attachment_id, $image_dimension );
			} else {
				$html = get_the_post_thumbnail( $item_id, $image_dimension );
			}
		} else {
			if ( ! empty( $custom_image_width ) && ! empty( $custom_image_height ) ) {
				if ( ! empty( $attachment_id ) ) {
					$html = qode_framework_generate_thumbnail( intval( $attachment_id ), $custom_image_width, $custom_image_height );
				} else {
					$html = qode_framework_generate_thumbnail( intval( get_post_thumbnail_id( $item_id ) ), $custom_image_width, $custom_image_height );
				}
			} else {
				$html = get_the_post_thumbnail( $item_id, $image_dimension );
			}
		}

		return apply_filters( 'oraiste_core_filter_list_shortcode_item_image', $html, $attachment_id );
	}
}

if ( ! function_exists( 'oraiste_core_get_list_shortcode_item_image_url' ) ) {
	/**
	 * Function that return thumbnail img url for list shortcodes
	 *
	 * @param string $image_dimension
	 * @param int $attachment_id
	 *
	 * @return string
	 */
	function oraiste_core_get_list_shortcode_item_image_url( $image_dimension, $attachment_id = 0 ) {

		if ( ! empty( $attachment_id ) ) {
			$image = wp_get_attachment_image_src( intval( $attachment_id ), $image_dimension );
			$url   = $image[0];
		} else {
			$url = get_the_post_thumbnail_url( get_the_ID(), $image_dimension );
		}

		return $url;
	}
}
