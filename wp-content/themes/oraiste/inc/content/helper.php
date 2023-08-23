<?php

if ( ! function_exists( 'oraiste_get_page_wrapper_classes' ) ) {
	/**
	 * Function that return classes for the page wrapper div from header.php
	 *
	 * @return string
	 */
	function oraiste_get_page_wrapper_classes() {
		return apply_filters( 'oraiste_filter_page_wrapper_classes', '' );
	}
}

if ( ! function_exists( 'oraiste_get_page_inner_classes' ) ) {
	/**
	 * Function that return classes for the page inner div from header.php
	 *
	 * @return string
	 */
	function oraiste_get_page_inner_classes() {
		$classes = 'qodef-content-grid';

		if ( is_page_template( 'page-full-width.php' ) ) {
			$classes = 'qodef-content-full-width';
		}

		return apply_filters( 'oraiste_filter_page_inner_classes', $classes );
	}
}

if ( ! function_exists( 'oraiste_get_grid_gutter_classes' ) ) {
	/**
	 * Function that returns grid gutter classes
	 *
	 * @return string
	 */
	function oraiste_get_grid_gutter_classes() {
		return apply_filters( 'oraiste_filter_grid_gutter_classes', '' );
	}
}
