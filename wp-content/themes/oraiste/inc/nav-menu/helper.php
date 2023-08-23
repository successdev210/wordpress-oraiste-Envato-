<?php

if ( ! function_exists( 'oraiste_nav_item_classes' ) ) {
	/**
	 * Function that add additional classes for menu items
	 *
	 * @param array $classes The CSS classes that are applied to the menu item's `<li>` element.
	 * @param WP_Post $item The current menu item.
	 * @param stdClass $args An object of wp_nav_menu() arguments.
	 * @param int $depth Depth of menu item. Used for padding.
	 *
	 * @return array
	 */
	function oraiste_nav_item_classes( $classes, $item, $args, $depth ) {

		if ( 0 === $depth && in_array( 'menu-item-has-children', $item->classes, true ) ) {
			$classes[] = 'qodef-menu-item--narrow';
		}

		return $classes;
	}

	add_filter( 'nav_menu_css_class', 'oraiste_nav_item_classes', 10, 4 );
}

if ( ! function_exists( 'oraiste_add_nav_item_icon' ) ) {
	/**
	 * Function that add additional element after the menu title
	 *
	 * @param string $title The menu item's title.
	 * @param WP_Post $item The current menu item.
	 * @param stdClass $args An object of wp_nav_menu() arguments.
	 * @param int $depth Depth of menu item. Used for padding.
	 *
	 * @return string
	 */
	function oraiste_add_nav_item_icon( $title, $item, $args, $depth ) {

		if ( in_array( 'menu-item-has-children', $item->classes, true ) ) {
			$title .= oraiste_get_svg_icon( 'menu-arrow-right', 'qodef-menu-item-arrow' );
		}

		return $title;
	}

	add_filter( 'nav_menu_item_title', 'oraiste_add_nav_item_icon', 10, 4 );
}
