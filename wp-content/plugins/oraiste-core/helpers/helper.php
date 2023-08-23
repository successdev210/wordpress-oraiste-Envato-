<?php

if ( ! function_exists( 'oraiste_core_include_core_is_installed' ) ) {
	/**
	 * Function that set case is installed element for framework functionality
	 *
	 * @param bool   $installed
	 * @param string $plugin - plugin name
	 *
	 * @return bool
	 */
	function oraiste_core_include_core_is_installed( $installed, $plugin ) {

		if ( 'core' === $plugin ) {
			return class_exists( 'OraisteCore' );
		}

		return $installed;
	}

	add_filter( 'qode_framework_filter_is_plugin_installed', 'oraiste_core_include_core_is_installed', 10, 2 );
}

if ( ! function_exists( 'oraiste_core_list_sc_template_part' ) ) {
	/**
	 * Echo module template part.
	 *
	 * @param string $module   name of the module from inc folder
	 * @param string $template full path of the template to load
	 * @param string $slug
	 * @param array  $params   array of parameters to pass to template
	 */
	function oraiste_core_list_sc_template_part( $module, $template, $slug = '', $params = array() ) {
		echo oraiste_core_get_list_sc_template_part( $module, $template, $slug, $params );
	}
}

if ( ! function_exists( 'oraiste_core_get_list_sc_template_part' ) ) {
	/**
	 * Echo module template part.
	 *
	 * @param string $module   name of the module from inc folder
	 * @param string $template full path of the template to load
	 * @param string $slug
	 * @param array  $params   array of parameters to pass to template
	 *
	 * @return string - string containing html of template
	 */
	function oraiste_core_get_list_sc_template_part( $module, $template, $slug = '', $params = array() ) {
		$root = ORAISTE_CORE_INC_PATH;

		return qode_framework_get_list_sc_template_part( $root, $module, $template, $slug, $params );
	}
}

if ( ! function_exists( 'oraiste_core_template_part' ) ) {
	/**
	 * Echo module template part.
	 *
	 * @param string $module   name of the module from inc folder
	 * @param string $template full path of the template to load
	 * @param string $slug
	 * @param array  $params   array of parameters to pass to template
	 */
	function oraiste_core_template_part( $module, $template, $slug = '', $params = array() ) {
		echo oraiste_core_get_template_part( $module, $template, $slug, $params );
	}
}

if ( ! function_exists( 'oraiste_core_get_template_part' ) ) {
	/**
	 * Loads module template part.
	 *
	 * @param string $module   name of the module from inc folder
	 * @param string $template full path of the template to load
	 * @param string $slug
	 * @param array  $params   array of parameters to pass to template
	 *
	 * @return string - string containing html of template
	 */
	function oraiste_core_get_template_part( $module, $template, $slug = '', $params = array() ) {
		$root = ORAISTE_CORE_INC_PATH;

		return qode_framework_get_template_part( $root, $module, $template, $slug, $params );
	}
}

if ( ! function_exists( 'oraiste_core_theme_template_part' ) ) {
	/**
	 * Function that echo module template part.
	 *
	 * @param string $module   name of the module from inc folder
	 * @param string $template full path of the template to load
	 * @param string $slug
	 * @param array  $params   array of parameters to pass to template
	 */
	function oraiste_core_theme_template_part( $module, $template, $slug = '', $params = array() ) {
		echo oraiste_core_get_theme_template_part( $module, $template, $slug, $params );
	}
}

if ( ! function_exists( 'oraiste_core_get_theme_template_part' ) ) {
	/**
	 * Function that load module template part.
	 *
	 * @param string $module   name of the module from inc folder
	 * @param string $template full path of the template to load
	 * @param string $slug
	 * @param array  $params   array of parameters to pass to template
	 *
	 * @return string - string containing html of template
	 */
	function oraiste_core_get_theme_template_part( $module, $template, $slug = '', $params = array() ) {
		return qode_framework_is_installed( 'theme' ) ? oraiste_get_template_part( $module, $template, $slug, $params ) : '';
	}
}

if ( ! function_exists( 'oraiste_core_get_option_value' ) ) {
	/**
	 * Function that returns option value using framework function but providing it's own scope
	 *
	 * @param string $type          option type
	 * @param string $name          name of option
	 * @param string $default_value option default value
	 * @param int    $post_id       id of
	 *
	 * @return string value of option
	 */
	function oraiste_core_get_option_value( $type, $name, $default_value = '', $post_id = null ) {
		$scope = ORAISTE_CORE_OPTIONS_NAME;

		return qode_framework_get_option_value( $scope, $type, $name, $default_value, $post_id );
	}
}

if ( ! function_exists( 'oraiste_core_get_post_value_through_levels' ) ) {
	/**
	 * Function that returns meta value if exists, otherwise global value using framework function but providing it's own scope
	 *
	 * @param string $name    name of option
	 * @param int    $post_id id of
	 *
	 * @return string|array value of option
	 */
	function oraiste_core_get_post_value_through_levels( $name, $post_id = null ) {
		$scope = ORAISTE_CORE_OPTIONS_NAME;

		return qode_framework_get_post_value_through_levels( $scope, $name, $post_id );
	}
}

if ( ! function_exists( 'oraiste_core_remove_default_post_meta_custom_fields' ) ) {
	/**
	 * Function that remove default custom post types for meta options
	 *
	 * @param array $post_types
	 *
	 * @return array
	 */
	function oraiste_core_remove_default_post_meta_custom_fields( $post_types ) {
		$post_types[] = 'post';
		$post_types[] = 'page';

		return $post_types;
	}

	add_filter( 'qode_framework_filter_meta_box_remove', 'oraiste_core_remove_default_post_meta_custom_fields' );
}

if ( ! function_exists( 'oraiste_core_general_meta_box_callbacks' ) ) {
	/**
	 * Function that return general meta box callback functions
	 *
	 * @return array
	 */
	function oraiste_core_general_meta_box_callbacks() {
		return apply_filters( 'oraiste_core_filter_general_meta_box_callbacks', array() );
	}
}

if ( ! function_exists( 'oraiste_core_get_query_params' ) ) {
	/**
	 * Function that return query parameters
	 *
	 * @param array $atts - options value
	 *
	 * @return array
	 */
	function oraiste_core_get_query_params( $atts ) {
		return qode_framework_is_installed( 'theme' ) ? oraiste_get_query_params( $atts ) : array();
	}
}

if ( ! function_exists( 'oraiste_core_get_pagination_data' ) ) {
	/**
	 * Function that return pagination data
	 *
	 * @param string $plugin    - plugin name
	 * @param string $module    - module name
	 * @param string $shortcode - shortcode name
	 * @param string $post_type - post type value
	 * @param array  $params    - shortcode params
	 *
	 * @return array
	 */
	function oraiste_core_get_pagination_data( $plugin, $module, $shortcode, $post_type, $params ) {
		return qode_framework_is_installed( 'theme' ) ? oraiste_get_pagination_data( $plugin, $module, $shortcode, $post_type, $params ) : array();
	}
}

if ( ! function_exists( 'oraiste_core_get_page_content_sidebar_classes' ) ) {
	/**
	 * Function that returns classes for the content when sidebar is enabled
	 *
	 * @return string
	 */
	function oraiste_core_get_page_content_sidebar_classes() {
		return qode_framework_is_installed( 'theme' ) ? oraiste_get_page_content_sidebar_classes() : '';
	}
}

if ( ! function_exists( 'oraiste_core_get_grid_gutter_classes' ) ) {
	/**
	 * Function that returns classes for the gutter when sidebar is enabled
	 *
	 * @return string
	 */
	function oraiste_core_get_grid_gutter_classes() {
		return qode_framework_is_installed( 'theme' ) ? oraiste_get_grid_gutter_classes() : '';
	}
}

if ( ! function_exists( 'oraiste_core_render_svg_icon' ) ) {
	/**
	 * Function that print svg html icon
	 *
	 * @param string $name       - icon name
	 * @param string $class_name - custom html tag class name
	 */
	function oraiste_core_render_svg_icon( $name, $class_name = '' ) {
		echo oraiste_core_get_svg_icon( $name, $class_name );
	}
}

if ( ! function_exists( 'oraiste_core_get_svg_icon' ) ) {
	/**
	 * Returns svg html
	 *
	 * @param string $name       - icon name
	 * @param string $class_name - custom html tag class name
	 *
	 * @return string|html
	 */
	function oraiste_core_get_svg_icon( $name, $class_name = '' ) {
		return qode_framework_is_installed( 'theme' ) ? oraiste_get_svg_icon( $name, $class_name ) : '';
	}
}

if ( ! function_exists( 'oraiste_core_get_custom_sidebars' ) ) {
	/**
	 * Function that return custom sidebars
	 *
	 * @param bool $enable_default - add first element empty for default value
	 *
	 * @return array
	 */
	function oraiste_core_get_custom_sidebars( $enable_default = true ) {
		$sidebars = array();

		if ( class_exists( 'QodeFrameworkCustomSidebar' ) ) {
			$qode_framework = qode_framework_get_framework_root();

			$sidebars = $qode_framework->get_custom_sidebars()->get_custom_sidebars( $enable_default );
		}

		return $sidebars;
	}
}

if ( ! function_exists( 'oraiste_core_get_customizer_logo' ) ) {
	/**
	 * Function that returns customizer image
	 *
	 * @return string that contains html for logo image
	 */
	function oraiste_core_get_customizer_logo() {
		$customizer_image = '';
		$customizer_logo  = get_custom_logo();

		if ( ! empty( $customizer_logo ) ) {
			$customizer_logo_id = get_theme_mod( 'custom_logo' );

			if ( $customizer_logo_id ) {
				$customizer_logo_id_attr = array(
					'class'    => 'qodef-header-logo-image qodef--main qodef--customizer',
					'itemprop' => 'logo',
				);

				$image_alt = get_post_meta( $customizer_logo_id, '_wp_attachment_image_alt', true );
				if ( empty( $image_alt ) ) {
					$customizer_logo_id_attr['alt'] = get_bloginfo( 'name', 'display' );
				}

				$customizer_image = wp_get_attachment_image( $customizer_logo_id, 'full', false, $customizer_logo_id_attr );
			}
		}

		return $customizer_image;
	}
}

if ( ! function_exists( 'oraiste_core_add_responsive_inline_style' ) ) {
	/**
	 * Function that generates global inline styles
	 *
	 * @param string $style
	 *
	 * @return string
	 */
	function oraiste_core_add_responsive_inline_style( $style ) {
		$full_style = '';

		$responsive_sizes = array( '1366', '1024', '768', '680' );
		foreach ( $responsive_sizes as $responsive_size ) {
			$responsive_style = apply_filters( 'oraiste_core_filter_add_responsive_' . $responsive_size . '_inline_style', $responsive_style = '' );

			if ( ! empty( $responsive_style ) ) {
				$responsive_string  = '@media only screen and (max-width: ' . $responsive_size . 'px){';
				$responsive_string .= $responsive_style;
				$responsive_string .= '}';
				$full_style        .= $responsive_string;
			}
		}

		$responsive_range_sizes = array( '1024_1366', '768_1024', '680_768' );
		foreach ( $responsive_range_sizes as $responsive_range_size ) {
			$responsive_style = apply_filters( 'oraiste_core_filter_add_responsive_' . $responsive_range_size . '_inline_style', $responsive_style = '' );
			$responsive_range = explode( '_', $responsive_range_size );

			if ( ! empty( $responsive_style ) ) {
				$responsive_string  = '@media only screen and (min-width: ' . ( intval( $responsive_range[0] ) + 1 ) . 'px) and (max-width: ' . $responsive_range[1] . 'px){';
				$responsive_string .= $responsive_style;
				$responsive_string .= '}';
				$full_style        .= $responsive_string;
			}
		}

		if ( ! empty( $full_style ) ) {
			$style = $style . $full_style;
		}

		return $style;
	}

	add_filter( 'oraiste_filter_add_inline_style', 'oraiste_core_add_responsive_inline_style', 12 ); // Permission 12 is set in order to load it last
}

if ( ! function_exists( 'oraiste_core_print_custom_css_in_footer' ) ) {
	/**
	 * Function that generates global inline styles inside footer area
	 *
	 * @return string
	 */
	function oraiste_core_print_custom_css_in_footer() {
		$full_style = '';

		$responsive_sizes = array( '1440', '1366', '1280', '1024', '768', '680' );
		foreach ( $responsive_sizes as $responsive_size ) {
			$responsive_style = apply_filters( 'oraiste_core_filter_add_responsive_' . $responsive_size . '_inline_style_in_footer', $responsive_style = '' );

			if ( ! empty( $responsive_style ) ) {
				$responsive_string  = '@media only screen and (max-width: ' . $responsive_size . 'px){';
				$responsive_string .= $responsive_style;
				$responsive_string .= '}';
				$full_style        .= $responsive_string;
			}
		}

		$responsive_range_sizes = array( '1366_1440', '1280_1366', '1024_1280', '768_1024', '680_768' );
		foreach ( $responsive_range_sizes as $responsive_range_size ) {
			$responsive_style = apply_filters( 'oraiste_core_filter_add_responsive_' . $responsive_range_size . '_inline_style_in_footer', $responsive_style = '' );
			$responsive_range = explode( '_', $responsive_range_size );

			if ( ! empty( $responsive_style ) ) {
				$responsive_string  = '@media only screen and (min-width: ' . ( intval( $responsive_range[0] ) + 1 ) . 'px) and (max-width: ' . $responsive_range[1] . 'px){';
				$responsive_string .= $responsive_style;
				$responsive_string .= '}';
				$full_style        .= $responsive_string;
			}
		}

		if ( '' !== $full_style ) {
			echo '<div id="oraiste-core-page-inline-style" data-style="' . esc_attr( $full_style ) . '"></div>';
		}
	}

	add_action( 'wp_footer', 'oraiste_core_print_custom_css_in_footer', 999 ); // 999 permission is set in order to add inline style been at the last place
}

if ( ! function_exists( 'oraiste_core_get_admin_options_map_position' ) ) {
	/**
	 * Function that set dashboard admin options map position
	 *
	 * @param string $map
	 *
	 * @return int
	 */
	function oraiste_core_get_admin_options_map_position( $map ) {
		$position = 10;

		switch ( $map ) {
			case 'general':
				$position = 1;
				break;
			case 'logo':
				$position = 2;
				break;
			case 'fonts':
				$position = 4;
				break;
			case 'typography':
				$position = 6;
				break;
			case 'header':
				$position = 8;
				break;
			case 'mobile-header':
				$position = 10;
				break;
			case 'fullscreen-menu':
				$position = 12;
				break;
			case 'title':
				$position = 14;
				break;
			case 'sidebar':
				$position = 16;
				break;
			case 'footer':
				$position = 18;
				break;
			case 'search':
				$position = 20;
				break;
			case 'side-area':
				$position = 22;
				break;
			case 'blog':
				$position = 24;
				break;
			case 'social-share':
				$position = 26;
				break;
			case 'maps':
				$position = 28;
				break;
			case 'subscribe-popup':
				$position = 99;
				break;
			case '404':
				$position = 100;
				break;
		}

		return apply_filters( 'oraiste_core_filter_admin_options_map_position', $position, $map );
	}
}

if ( ! function_exists( 'oraiste_core_get_variations_options_map' ) ) {
	/**
	 * Function that return options map for module variations
	 *
	 * @param array   $variations
	 * @param boolean $default_empty
	 *
	 * @return array
	 */
	function oraiste_core_get_variations_options_map( $variations, $default_empty = false ) {
		$map = array();

		if ( ! empty( $variations ) ) {
			$map['visibility'] = sizeof( $variations ) > 1;

			reset( $variations );
			$map['default_value'] = key( $variations );

			if ( $default_empty ) {
				$map['default_value'] = '';
			}
		} else {
			$map['visibility']    = false;
			$map['default_value'] = '';
		}

		return $map;
	}
}

if ( ! function_exists( 'oraiste_core_get_select_type_options_pool' ) ) {
	/**
	 * Function that returns array with pool of options for select fields in framework
	 *
	 * @param string $type           - type of select field
	 * @param bool   $enable_default - add first element empty for default value
	 * @param array  $exclude        - array of items to exclude
	 * @param array  $include        - array of items to include
	 *
	 * @return array escaped output
	 */
	function oraiste_core_get_select_type_options_pool( $type, $enable_default = true, $exclude = array(), $include = array() ) {
		$options = array();
		if ( $enable_default ) {
			$options[''] = esc_html__( 'Default', 'oraiste-core' );
		}
		switch ( $type ) {
			case 'content_width':
				$options['1400'] = esc_html__( '1400px', 'oraiste-core' );
				$options['1300'] = esc_html__( '1300px', 'oraiste-core' );
				$options['1200'] = esc_html__( '1200px', 'oraiste-core' );
				$options['1100'] = esc_html__( '1100px', 'oraiste-core' );
				$options['1000'] = esc_html__( '1000px', 'oraiste-core' );
				$options['800']  = esc_html__( '800px', 'oraiste-core' );
				break;
			case 'title_tag':
				$options['h1'] = 'H1';
				$options['h2'] = 'H2';
				$options['h3'] = 'H3';
				$options['h4'] = 'H4';
				$options['h5'] = 'H5';
				$options['h6'] = 'H6';
				$options['p']  = 'P';
				break;
			case 'link_target':
				$options['_self']  = esc_html__( 'Same Window', 'oraiste-core' );
				$options['_blank'] = esc_html__( 'New Window', 'oraiste-core' );
				break;
			case 'border_style':
				$options['solid']  = esc_html__( 'Solid', 'oraiste-core' );
				$options['dashed'] = esc_html__( 'Dashed', 'oraiste-core' );
				$options['dotted'] = esc_html__( 'Dotted', 'oraiste-core' );
				break;
			case 'font_weight':
				$options['100'] = esc_html__( 'Thin (100)', 'oraiste-core' );
				$options['200'] = esc_html__( 'Extra Light (200)', 'oraiste-core' );
				$options['300'] = esc_html__( 'Light (300)', 'oraiste-core' );
				$options['400'] = esc_html__( 'Normal (400)', 'oraiste-core' );
				$options['500'] = esc_html__( 'Medium (500)', 'oraiste-core' );
				$options['600'] = esc_html__( 'Semi Bold (600)', 'oraiste-core' );
				$options['700'] = esc_html__( 'Bold (700)', 'oraiste-core' );
				$options['800'] = esc_html__( 'Extra Bold (800)', 'oraiste-core' );
				$options['900'] = esc_html__( 'Black (900)', 'oraiste-core' );
				break;
			case 'font_style':
				$options['normal']  = esc_html__( 'Normal', 'oraiste-core' );
				$options['italic']  = esc_html__( 'Italic', 'oraiste-core' );
				$options['oblique'] = esc_html__( 'Oblique', 'oraiste-core' );
				$options['initial'] = esc_html__( 'Initial', 'oraiste-core' );
				$options['inherit'] = esc_html__( 'Inherit', 'oraiste-core' );
				break;
			case 'text_transform':
				$options['none']       = esc_html__( 'None', 'oraiste-core' );
				$options['capitalize'] = esc_html__( 'Capitalize', 'oraiste-core' );
				$options['uppercase']  = esc_html__( 'Uppercase', 'oraiste-core' );
				$options['lowercase']  = esc_html__( 'Lowercase', 'oraiste-core' );
				$options['initial']    = esc_html__( 'Initial', 'oraiste-core' );
				$options['inherit']    = esc_html__( 'Inherit', 'oraiste-core' );
				break;
				break;
			case 'text_decoration':
				$options['none']         = esc_html__( 'None', 'oraiste-core' );
				$options['underline']    = esc_html__( 'Underline', 'oraiste-core' );
				$options['overline']     = esc_html__( 'Overline', 'oraiste-core' );
				$options['line-through'] = esc_html__( 'Line-Through', 'oraiste-core' );
				$options['initial']      = esc_html__( 'Initial', 'oraiste-core' );
				$options['inherit']      = esc_html__( 'Inherit', 'oraiste-core' );
				break;
			case 'list_behavior':
				$options['columns'] = esc_html__( 'Gallery', 'oraiste-core' );
				$options['masonry'] = esc_html__( 'Masonry', 'oraiste-core' );
				$options['slider']  = esc_html__( 'Slider', 'oraiste-core' );
				break;
			case 'columns_number':
				$options['1'] = esc_html__( 'One', 'oraiste-core' );
				$options['2'] = esc_html__( 'Two', 'oraiste-core' );
				$options['3'] = esc_html__( 'Three', 'oraiste-core' );
				$options['4'] = esc_html__( 'Four', 'oraiste-core' );
				$options['5'] = esc_html__( 'Five', 'oraiste-core' );
				$options['6'] = esc_html__( 'Six', 'oraiste-core' );
				break;
			case 'items_space':
				$options['huge']   = esc_html__( 'Huge (40)', 'oraiste-core' );
				$options['mega']   = esc_html__( 'Mega (30)', 'oraiste-core' );
				$options['large']  = esc_html__( 'Large (25)', 'oraiste-core' );
				$options['medium'] = esc_html__( 'Medium (20)', 'oraiste-core' );
				$options['normal'] = esc_html__( 'Normal (15)', 'oraiste-core' );
				$options['short']  = esc_html__( 'Short (13)', 'oraiste-core' );
				$options['small']  = esc_html__( 'Small (10)', 'oraiste-core' );
				$options['tiny']   = esc_html__( 'Tiny (5)', 'oraiste-core' );
				$options['no']     = esc_html__( 'No (0)', 'oraiste-core' );
				break;
			case 'order_by':
				$options['date']       = esc_html__( 'Date', 'oraiste-core' );
				$options['ID']         = esc_html__( 'ID', 'oraiste-core' );
				$options['menu_order'] = esc_html__( 'Menu Order', 'oraiste-core' );
				$options['name']       = esc_html__( 'Post Name', 'oraiste-core' );
				$options['rand']       = esc_html__( 'Random', 'oraiste-core' );
				$options['title']      = esc_html__( 'Title', 'oraiste-core' );
				break;
			case 'order':
				$options['DESC'] = esc_html__( 'Descending', 'oraiste-core' );
				$options['ASC']  = esc_html__( 'Ascending', 'oraiste-core' );
				break;
			case 'pagination_type':
				$options['no-pagination']   = esc_html__( 'No Pagination', 'oraiste-core' );
				$options['standard']        = esc_html__( 'Standard', 'oraiste-core' );
				$options['load-more']       = esc_html__( 'Load More', 'oraiste-core' );
				$options['infinite-scroll'] = esc_html__( 'Infinite Scroll', 'oraiste-core' );
				break;
			case 'columns_responsive':
				$options['predefined'] = esc_html__( 'Predefined', 'oraiste-core' );
				$options['custom']     = esc_html__( 'Custom', 'oraiste-core' );
				break;
			case 'yes_no':
				$options['yes'] = esc_html__( 'Yes', 'oraiste-core' );
				$options['no']  = esc_html__( 'No', 'oraiste-core' );
				break;
			case 'no_yes':
				$options['no']  = esc_html__( 'No', 'oraiste-core' );
				$options['yes'] = esc_html__( 'Yes', 'oraiste-core' );
				break;
			case 'sidebar_layouts':
				$options['no-sidebar']       = esc_html__( 'No Sidebar', 'oraiste-core' );
				$options['sidebar-33-right'] = esc_html__( 'Sidebar 1/3 Right', 'oraiste-core' );
				$options['sidebar-25-right'] = esc_html__( 'Sidebar 1/4 Right', 'oraiste-core' );
				$options['sidebar-33-left']  = esc_html__( 'Sidebar 1/3 Left', 'oraiste-core' );
				$options['sidebar-25-left']  = esc_html__( 'Sidebar 1/4 Left', 'oraiste-core' );
				break;
			case 'icon_source':
				$options['icon_pack']  = esc_html__( 'Icon Pack', 'oraiste-core' );
				$options['svg_path']   = esc_html__( 'SVG Path', 'oraiste-core' );
				$options['predefined'] = esc_html__( 'Predefined', 'oraiste-core' );
				break;
			case 'list_image_dimension':
				$options['full']      = esc_html__( 'Original', 'oraiste-core' );
				$options['thumbnail'] = esc_html__( 'Thumbnail', 'oraiste-core' );
				$options['medium']    = esc_html__( 'Medium', 'oraiste-core' );
				$options['large']     = esc_html__( 'Large', 'oraiste-core' );
				$options['custom']    = esc_html__( 'Custom', 'oraiste-core' );
				$options              = apply_filters( 'qode_framework_filter_pool_list_image_dimension', $options );
				break;
			case 'weekdays':
				$options['monday']    = esc_html__( 'Monday', 'oraiste-core' );
				$options['tuesday']   = esc_html__( 'Tuesday', 'oraiste-core' );
				$options['wednesday'] = esc_html__( 'Wednesday', 'oraiste-core' );
				$options['thursday']  = esc_html__( 'Thursday', 'oraiste-core' );
				$options['friday']    = esc_html__( 'Friday', 'oraiste-core' );
				$options['saturday']  = esc_html__( 'Saturday', 'oraiste-core' );
				$options['sunday']    = esc_html__( 'Sunday', 'oraiste-core' );
				break;
		}

		if ( ! empty( $exclude ) ) {
			foreach ( $exclude as $e ) {
				if ( array_key_exists( $e, $options ) ) {
					unset( $options[ $e ] );
				}
			}
		}

		if ( ! empty( $include ) ) {
			foreach ( $include as $key => $value ) {
				if ( ! array_key_exists( $key, $options ) ) {
					$options[ $key ] = $value;
				}
			}
		}

		return apply_filters( 'oraiste_core_filter_select_type_option', $options, $type, $enable_default, $exclude );
	}
}

if ( ! function_exists( 'oraiste_core_get_space_value' ) ) {
	/**
	 * Function that returns spacing value based on selected option
	 *
	 * @param string $text_value - textual value of spacing
	 *
	 * @return int
	 */
	function oraiste_core_get_space_value( $text_value ) {
		switch ( $text_value ) {
			case 'huge':
				return 40;
			case 'mega':
				return 30;
			case 'large':
				return 25;
			case 'medium':
				return 20;
			case 'normal':
				return 15;
			case 'small':
				return 10;
			case 'tiny':
				return 5;
			default:
				return is_int( $text_value ) ? $text_value : 0;
		}
	}
}

if ( ! function_exists( 'oraiste_core_get_typography_styles' ) ) {
	/**
	 * Generates typography styles
	 *
	 * @param string $scope
	 * @param string $field_name
	 * @param string $selector
	 *
	 * @return array
	 */
	function oraiste_core_get_typography_styles( $scope, $field_name, $selector = '' ) {
		$color           = qode_framework_get_option_value( $scope, 'admin', $field_name . '_color' );
		$font_family     = qode_framework_get_option_value( $scope, 'admin', $field_name . '_font_family' );
		$font_size       = qode_framework_get_option_value( $scope, 'admin', $field_name . '_font_size' );
		$line_height     = qode_framework_get_option_value( $scope, 'admin', $field_name . '_line_height' );
		$letter_spacing  = qode_framework_get_option_value( $scope, 'admin', $field_name . '_letter_spacing' );
		$font_weight     = qode_framework_get_option_value( $scope, 'admin', $field_name . '_font_weight' );
		$text_transform  = qode_framework_get_option_value( $scope, 'admin', $field_name . '_text_transform' );
		$font_style      = qode_framework_get_option_value( $scope, 'admin', $field_name . '_font_style' );
		$text_decoration = qode_framework_get_option_value( $scope, 'admin', $field_name . '_text_decoration' );
		$margin_top      = qode_framework_get_option_value( $scope, 'admin', $field_name . '_margin_top' );
		$margin_bottom   = qode_framework_get_option_value( $scope, 'admin', $field_name . '_margin_bottom' );

		$styles = array();

		if ( 'p' !== $selector ) {

			if ( ! empty( $color ) ) {
				$styles['color'] = $color;
			}

			if ( isset( $font_family ) && false !== $font_family && '-1' !== $font_family && '' !== $font_family ) {
				$styles['font-family'] = qode_framework_get_formatted_font_family( $font_family );
			}

			if ( ! empty( $font_size ) ) {
				if ( qode_framework_string_ends_with_typography_units( $font_size ) ) {
					$styles['font-size'] = $font_size;
				} else {
					$styles['font-size'] = intval( $font_size ) . 'px';
				}
			}

			if ( ! empty( $line_height ) ) {
				if ( qode_framework_string_ends_with_typography_units( $line_height ) ) {
					$styles['line-height'] = $line_height;
				} else {
					$styles['line-height'] = floatval( $line_height ) . 'px';
				}
			}

			if ( ! empty( $font_style ) ) {
				$styles['font-style'] = $font_style;
			}

			if ( ! empty( $font_weight ) ) {
				$styles['font-weight'] = $font_weight;
			}

			if ( ! empty( $text_decoration ) ) {
				$styles['text-decoration'] = $text_decoration;
			}

			if ( '' !== $letter_spacing && ! is_bool( $letter_spacing ) ) {
				if ( qode_framework_string_ends_with_typography_units( $letter_spacing ) ) {
					$styles['letter-spacing'] = $letter_spacing;
				} else {
					$styles['letter-spacing'] = floatval( $letter_spacing ) . 'px';
				}
			}

			if ( ! empty( $text_transform ) ) {
				$styles['text-transform'] = $text_transform;
			}
		}

		if ( 'body' !== $selector ) {

			if ( ! empty( $margin_top ) ) {
				if ( qode_framework_string_ends_with_space_units( $margin_top, true ) ) {
					$styles['margin-top'] = $margin_top;
				} else {
					$styles['margin-top'] = intval( $margin_top ) . 'px';
				}
			}

			if ( ! empty( $margin_bottom ) ) {
				if ( qode_framework_string_ends_with_space_units( $margin_bottom, true ) ) {
					$styles['margin-bottom'] = $margin_bottom;
				} else {
					$styles['margin-bottom'] = intval( $margin_bottom ) . 'px';
				}
			}
		}

		return $styles;
	}
}

if ( ! function_exists( 'oraiste_core_get_typography_hover_styles' ) ) {
	/**
	 * Generates hover typography styles
	 *
	 * @param string $scope
	 * @param string $field_name
	 *
	 * @return array
	 */
	function oraiste_core_get_typography_hover_styles( $scope, $field_name ) {
		$hover_color           = qode_framework_get_option_value( $scope, 'admin', $field_name . '_hover_color' );
		$hover_text_decoration = qode_framework_get_option_value( $scope, 'admin', $field_name . '_hover_text_decoration' );

		$styles = array();

		if ( ! empty( $hover_color ) ) {
			$styles['color'] = $hover_color;
		}

		if ( ! empty( $hover_text_decoration ) ) {
			$styles['text-decoration'] = $hover_text_decoration;
		}

		return $styles;
	}
}

if ( ! function_exists( 'oraiste_core_get_custom_post_type_related_posts' ) ) {
	/**
	 * Function which return related posts for forward post item
	 *
	 * @param int   $post_id
	 * @param array $allowed_types
	 *
	 * @return array
	 */
	function oraiste_core_get_custom_post_type_related_posts( $post_id, $allowed_types ) {
		$related_posts = array();

		if ( ! empty( $post_id ) && ! empty( $allowed_types ) ) {
			foreach ( $allowed_types as $key => $value ) {
				$term_ids = array();

				if ( ! empty( $value ) ) {
					foreach ( $value as $term ) {
						$term_ids[] = $term->term_id;
					}
				}

				if ( ! empty( $term_ids ) ) {
					$related_posts_by_term = oraiste_core_get_custom_post_type_related_posts_by_term( $post_id, $term_ids, $key );

					if ( ! empty( $related_posts_by_term->posts ) ) {
						$items_id = array();

						foreach ( $related_posts_by_term->posts as $related_post ) {
							$items_id[] = $related_post->ID;
						}

						$related_posts = array(
							'items' => implode( ',', $items_id ),
						);

						return $related_posts;
						break;
					}
				}
			}
		}

		return $related_posts;
	}
}

if ( ! function_exists( 'oraiste_core_get_custom_post_type_related_posts_by_term' ) ) {
	/**
	 * Function which return related posts query object
	 *
	 * @param int    $post_id
	 * @param array  $term_ids
	 * @param string $slug
	 *
	 * @return WP_Query
	 */
	function oraiste_core_get_custom_post_type_related_posts_by_term( $post_id, $term_ids, $slug ) {
		$args = apply_filters(
			'oraiste_core_filter_custom_post_type_related_posts_by_term',
			array(
				'post_status'    => 'publish',
				'post_type'      => get_post_type( $post_id ),
				'post__not_in'   => array( $post_id ),
				$slug . '__in'   => $term_ids,
				'orderby'        => 'rand',
				'posts_per_page' => 6,
				// 6 is random value in case that someone change with filter number of posts for related posts item
			)
		);

		$related_posts = new \WP_Query( $args );

		return $related_posts;
	}
}

if ( ! function_exists( 'oraiste_core_get_custom_post_type_taxonomy_query_args' ) ) {
	/**
	 * Function that return query parameters
	 *
	 * @param array $params  - options value
	 * @param array $include - additional query arguments
	 *
	 * @return array
	 */
	function oraiste_core_get_custom_post_type_taxonomy_query_args( $params, $include = array() ) {
		$args = array();

		if ( isset( $params['taxonomy'] ) && ! empty( $params['taxonomy'] ) ) {
			$args['taxonomy'] = $params['taxonomy'];
		}

		if ( isset( $params['posts_per_page'] ) && ! empty( $params['posts_per_page'] ) ) {
			$args['number'] = $params['posts_per_page'];
		}

		if ( isset( $params['orderby'] ) && ! empty( $params['orderby'] ) ) {
			$args['orderby'] = $params['orderby'];
		}

		if ( isset( $params['order'] ) && ! empty( $params['order'] ) ) {
			$args['order'] = $params['order'];
		}

		$args['hide_empty'] = isset( $params['hide_empty'] ) && 'yes' === $params['hide_empty'];

		if ( isset( $params['taxonomy_ids'] ) && ! empty( $params['taxonomy_ids'] ) ) {
			$args['include'] = explode( ',', trim( $params['taxonomy_ids'] ) );
		}

		if ( ! empty( $include ) ) {
			foreach ( $include as $key => $value ) {
				if ( ! array_key_exists( $key, $args ) ) {
					$args[ $key ] = $value;
				}
			}
		}

		return $args;
	}
}

if ( ! function_exists( 'oraiste_core_get_custom_post_type_excerpt' ) ) {
	/**
	 * Return excerpt text for current custom post type item
	 *
	 * @param int    $excerpt_length
	 * @param string $custom_excerpt
	 *
	 * @return string
	 */
	function oraiste_core_get_custom_post_type_excerpt( $excerpt_length, $custom_excerpt = '' ) {
		$excerpt      = '';
		$item_excerpt = get_the_excerpt();

		if ( empty( $item_excerpt ) && ! empty( $custom_excerpt ) ) {
			$item_excerpt = esc_html( $custom_excerpt );
		}

		if ( empty( $excerpt_length ) ) {
			$excerpt_length = apply_filters( 'oraiste_core_filter_post_excerpt_length', 180 ); // 180 is number of characters
		}

		if ( ! empty( $item_excerpt ) ) {
			$excerpt = ( $excerpt_length > 0 ) ? substr( $item_excerpt, 0, intval( $excerpt_length ) ) : $item_excerpt;
		}

		return strip_tags( strip_shortcodes( $excerpt ) );
	}
}

if ( ! function_exists( 'oraiste_core_render_page_builder_post_content' ) ) {
	/**
	 * Function that print post content unmodified by page builder
	 *
	 * @param int $id post id
	 */
	function oraiste_core_render_page_builder_post_content( $id ) {

		if ( qode_framework_is_installed( 'elementor' ) ) {
			echo oraiste_core_get_elementor_instance()->frontend->get_builder_content( $id, true );
		} else {
			the_content();
		}
	}
}

if ( ! function_exists( 'oraiste_core_add_color_skin_body_class' ) ) {
	/**
	 * Function that add page skin body classes
	 *
	 * @param $classes
	 *
	 * @return mixed
	 */
	function oraiste_core_add_color_skin_body_class( $classes ) {
		$page_color_skin = oraiste_core_get_post_value_through_levels( 'qodef_page_color_skin' );

		$classes[] = ! empty( $page_color_skin ) ? 'qodef-color-skin--' . $page_color_skin : '';

		return $classes;
	}

	add_filter( 'body_class', 'oraiste_core_add_color_skin_body_class' );
}
