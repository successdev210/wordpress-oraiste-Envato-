<?php

if ( ! function_exists( 'oraiste_get_blog_holder_classes' ) ) {
	/**
	 * Function that return classes for the main blog holder
	 *
	 * @return string
	 */
	function oraiste_get_blog_holder_classes() {
		$classes = array();

		if ( is_single() ) {
			$classes[] = 'qodef--single';
		} else {
			$classes[] = 'qodef--list';
		}

		return implode( ' ', apply_filters( 'oraiste_filter_blog_holder_classes', $classes ) );
	}
}

if ( ! function_exists( 'oraiste_get_blog_list_excerpt_length' ) ) {
	/**
	 * Function that return number of characters for excerpt on blog list page
	 *
	 * @return int
	 */
	function oraiste_get_blog_list_excerpt_length() {
		$length = apply_filters( 'oraiste_filter_post_excerpt_length', 180 );

		return intval( $length );
	}
}

if ( ! function_exists( 'oraiste_post_has_read_more' ) ) {
	/**
	 * Function that checks if current post has read more tag set
	 *
	 * @return int position of read more tag text. It will return false if read more tag isn't set
	 */
	function oraiste_post_has_read_more() {
		global $post;

		return ! empty( $post ) ? strpos( $post->post_content, '<!--more-->' ) : false;
	}
}
