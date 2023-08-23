<?php

if ( ! class_exists( 'OraisteCoreRootMainMenuWalker' ) ) {
	class OraisteCoreRootMainMenuWalker extends Walker_Nav_Menu {

		function display_element( $element, &$children_elements, $max_depth, $depth, $args, &$output ) {
			$id_field = $this->db_fields['id'];
			if ( is_object( $args[0] ) ) {
				$args[0]->has_children = ! empty( $children_elements[ $element->$id_field ] );
			}

			parent::display_element( $element, $children_elements, $max_depth, $depth, $args, $output );
		}

		public function start_lvl( &$output, $depth = 0, $args = null ) {
			if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
				$t = '';
				$n = '';
			} else {
				$t = "\t";
				$n = "\n";
			}
			$indent = str_repeat( $t, $depth );

			$before_item = '';
			if ( 0 === $depth ) {
				$before_item   = '<div class="qodef-drop-down-second">';
				$inner_classes = apply_filters( 'oraiste_core_filter_drop_down_second_inner_classes', array( 'qodef-drop-down-second-inner' ) );
				$before_item  .= '<div class="' . implode( ' ', $inner_classes ) . '">';
			}

			// Default class.
			$classes = array( 'sub-menu' );

			/**
			 * Filters the CSS class(es) applied to a menu list element.
			 *
			 * @param array $classes The CSS classes that are applied to the menu `<ul>` element.
			 * @param stdClass $args An object of `wp_nav_menu()` arguments.
			 * @param int $depth Depth of menu item. Used for padding.
			 *
			 * @since 4.8.0
			 *
			 */
			$class_names = join( ' ', apply_filters( 'nav_menu_submenu_css_class', $classes, $args, $depth ) );
			$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

			$output .= "{$n}{$indent}{$before_item}<ul$class_names>{$n}";
		}

		public function end_lvl( &$output, $depth = 0, $args = null ) {
			if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
				$t = '';
				$n = '';
			} else {
				$t = "\t";
				$n = "\n";
			}

			$after_item = '';
			if ( 0 === $depth ) {
				$after_item = '</div></div>';
			}

			$indent = str_repeat( $t, $depth );
			$output .= "$indent</ul>{$after_item}{$n}";
		}

		public function start_el( &$output, $item, $depth = 0, $args = null, $id = 0 ) {
			if ( isset( $args->item_spacing ) && 'discard' === $args->item_spacing ) {
				$t = '';
				$n = '';
			} else {
				$t = "\t";
				$n = "\n";
			}
			$indent = ( $depth ) ? str_repeat( $t, $depth ) : '';

			$classes   = empty( $item->classes ) ? array() : (array) $item->classes;
			$classes[] = 'menu-item-' . $item->ID;

			$anchor_link      = oraiste_core_get_option_value( 'nav-menu', 'qodef-enable-anchor-link', '', $item->ID );
			$menu_appearance  = oraiste_core_get_option_value( 'nav-menu', 'qodef-menu-item-appearance', '', $item->ID );
			$mega_menu_widget = oraiste_core_get_option_value( 'nav-menu', 'qodef-enable-mega-menu-widget', '', $item->ID );
			$menu_icon_pack   = oraiste_core_get_option_value( 'nav-menu', 'qodef-menu-item-icon-pack', '', $item->ID );
			$menu_icon        = oraiste_core_get_option_value( 'nav-menu', 'qodef-menu-item-icon-pack-icon', '', $item->ID );

			if ( ! empty( $anchor_link ) ) {
				$classes[] = 'qodef-anchor';
			}

			if ( 'hide-link' === $menu_appearance ) {
				$classes[] = 'qodef--hide-link';
			}

			if ( ! empty( $menu_icon_pack ) && ! empty( $menu_icon ) ) {
				$menu_item_icon_html = qode_framework_icons()->render_icon( $menu_icon, $menu_icon_pack, array( 'icon_attributes' => array( 'class' => 'qodef-menu-item-icon' ) ) );
			}
			/**
			 * Filters the arguments for a single nav menu item.
			 *
			 * @param stdClass $args An object of wp_nav_menu() arguments.
			 * @param WP_Post $item Menu item data object.
			 * @param int $depth Depth of menu item. Used for padding.
			 *
			 * @since 4.4.0
			 *
			 */
			$args = apply_filters( 'nav_menu_item_args', $args, $item, $depth );

			/**
			 * Filters the CSS class(es) applied to a menu item's list item element.
			 *
			 * @param array $classes The CSS classes that are applied to the menu item's `<li>` element.
			 * @param WP_Post $item The current menu item.
			 * @param stdClass $args An object of wp_nav_menu() arguments.
			 * @param int $depth Depth of menu item. Used for padding.
			 *
			 * @since 3.0.0
			 * @since 4.1.0 The `$depth` parameter was added.
			 *
			 */
			$class_names = join( ' ', apply_filters( 'nav_menu_css_class', array_filter( $classes ), $item, $args, $depth ) );
			$class_names = $class_names ? ' class="' . esc_attr( $class_names ) . '"' : '';

			/**
			 * Filters the ID applied to a menu item's list item element.
			 *
			 * @param string $menu_id The ID that is applied to the menu item's `<li>` element.
			 * @param WP_Post $item The current menu item.
			 * @param stdClass $args An object of wp_nav_menu() arguments.
			 * @param int $depth Depth of menu item. Used for padding.
			 *
			 * @since 3.0.1
			 * @since 4.1.0 The `$depth` parameter was added.
			 *
			 */
			$id = apply_filters( 'nav_menu_item_id', 'menu-item-' . $item->ID, $item, $args, $depth );
			$id = $id ? ' id="' . esc_attr( $id ) . '"' : '';

			$output .= $indent . '<li' . $id . $class_names . '>';

			$atts           = array();
			$atts['title']  = ! empty( $item->attr_title ) ? $item->attr_title : '';
			$atts['target'] = ! empty( $item->target ) ? $item->target : '';
			$atts['rel']    = ! empty( $item->xfn ) ? $item->xfn : '';
			$atts['href']   = ! empty( $item->url ) ? $item->url : '';

			if ( 'hide-link' === $menu_appearance ) {
				$atts['onclick'] = 'JavaScript: return false;';
			}

			/**
			 * Filters the HTML attributes applied to a menu item's anchor element.
			 *
			 * @param array $atts {
			 *     The HTML attributes applied to the menu item's `<a>` element, empty strings are ignored.
			 *
			 * @type string $title Title attribute.
			 * @type string $target Target attribute.
			 * @type string $rel The rel attribute.
			 * @type string $href The href attribute.
			 * }
			 *
			 * @param WP_Post $item The current menu item.
			 * @param stdClass $args An object of wp_nav_menu() arguments.
			 * @param int $depth Depth of menu item. Used for padding.
			 *
			 * @since 3.6.0
			 * @since 4.1.0 The `$depth` parameter was added.
			 *
			 */
			$atts = apply_filters( 'nav_menu_link_attributes', $atts, $item, $args, $depth );

			$attributes = '';
			foreach ( $atts as $attr => $value ) {
				if ( is_scalar( $value ) && '' !== $value && false !== $value ) {
					$value      = ( 'href' === $attr ) ? esc_url( $value ) : esc_attr( $value );
					$attributes .= ' ' . $attr . '="' . $value . '"';
				}
			}

			/** This filter is documented in wp-includes/post-template.php */
			$title = apply_filters( 'the_title', $item->title, $item->ID );

			/**
			 * Filters a menu item's title.
			 *
			 * @param string $title The menu item's title.
			 * @param WP_Post $item The current menu item.
			 * @param stdClass $args An object of wp_nav_menu() arguments.
			 * @param int $depth Depth of menu item. Used for padding.
			 *
			 * @since 4.4.0
			 *
			 */
			$title = apply_filters( 'nav_menu_item_title', $title, $item, $args, $depth );

			$item_output = $args->before;

			if ( 'hide-item' != $menu_appearance ) {
				if ( 'hide-label' != $menu_appearance ) {
					$item_output .= '<a' . $attributes . '>';
					if ( isset( $menu_item_icon_html ) && ! empty( $menu_item_icon_html ) ) {
						$item_output .= $menu_item_icon_html;
					}
					$item_output .= $args->link_before;
					$item_output .= $title;
					$item_output .= $args->link_after;
					$item_output .= '</a>';
				}
				if ( $mega_menu_widget ) {
					$item_output .= '<div class="qodef-mega-menu-widget-holder">';

					ob_start();
					dynamic_sidebar( $mega_menu_widget );
					$sidebar_content = ob_get_contents();
					ob_end_clean();
					$item_output .= $sidebar_content;

					$item_output .= '</div>';
				}
			}

			$item_output .= $args->after;

			/**
			 * Filters a menu item's starting output.
			 *
			 * The menu item's starting output only includes `$args->before`, the opening `<a>`,
			 * the menu item's title, the closing `</a>`, and `$args->after`. Currently, there is
			 * no filter for modifying the opening and closing `<li>` for a menu item.
			 *
			 * @param string $item_output The menu item's starting HTML output.
			 * @param WP_Post $item Menu item data object.
			 * @param int $depth Depth of menu item. Used for padding.
			 * @param stdClass $args An object of wp_nav_menu() arguments.
			 *
			 * @since 3.0.0
			 *
			 */
			$output .= apply_filters( 'walker_nav_menu_start_el', $item_output, $item, $depth, $args );
		}
	}
}
