<?php

if ( ! function_exists( 'oraiste_set_404_page_inner_classes' ) ) {
	/**
	 * Function that return classes for the page inner div from header.php
	 *
	 * @param string $classes
	 *
	 * @return string
	 */
	function oraiste_set_404_page_inner_classes( $classes ) {

		if ( is_404() ) {
			$classes = 'qodef-content-full-width';
		}

		return $classes;
	}

	add_filter( 'oraiste_filter_page_inner_classes', 'oraiste_set_404_page_inner_classes' );
}

if ( ! function_exists( 'oraiste_get_404_page_parameters' ) ) {
	/**
	 * Function that set 404 page area content parameters
	 */
	function oraiste_get_404_page_parameters() {

		$params = array(
			'title'       => esc_html__( 'Page Not Found', 'oraiste' ),
			'text'        => esc_html__( 'The page you are looking for does not exist.  It might have been moved or deleted.', 'oraiste' ),
			'button_text' => esc_html__( 'Discover All', 'oraiste' ),
		);

		return apply_filters( 'oraiste_filter_404_page_template_params', $params );
	}
}
