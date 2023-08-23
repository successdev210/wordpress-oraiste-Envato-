<?php

if ( ! function_exists( 'oraiste_is_installed' ) ) {
	/**
	 * Function that checks if forward plugin installed
	 *
	 * @param string $plugin - plugin name
	 *
	 * @return bool
	 */
	function oraiste_is_installed( $plugin ) {

		switch ( $plugin ) {
			case 'framework':
				return class_exists( 'QodeFramework' );
				break;
			case 'core':
				return class_exists( 'OraisteCore' );
				break;
			case 'woocommerce':
				return class_exists( 'WooCommerce' );
				break;
			case 'gutenberg-page':
				$current_screen = function_exists( 'get_current_screen' ) ? get_current_screen() : array();

				return method_exists( $current_screen, 'is_block_editor' ) && $current_screen->is_block_editor();
				break;
			case 'gutenberg-editor':
				return class_exists( 'WP_Block_Type' );
				break;
			default:
				return false;
		}
	}
}

if ( ! function_exists( 'oraiste_include_theme_is_installed' ) ) {
	/**
	 * Function that set case is installed element for framework functionality
	 *
	 * @param bool   $installed
	 * @param string $plugin - plugin name
	 *
	 * @return bool
	 */
	function oraiste_include_theme_is_installed( $installed, $plugin ) {

		if ( 'theme' === $plugin ) {
			return class_exists( 'Oraiste_Handler' );
		}

		return $installed;
	}

	add_filter( 'qode_framework_filter_is_plugin_installed', 'oraiste_include_theme_is_installed', 10, 2 );
}

if ( ! function_exists( 'oraiste_template_part' ) ) {
	/**
	 * Function that echo module template part.
	 *
	 * @param string $module   name of the module from inc folder
	 * @param string $template full path of the template to load
	 * @param string $slug
	 * @param array  $params   array of parameters to pass to template
	 */
	function oraiste_template_part( $module, $template, $slug = '', $params = array() ) {
		echo oraiste_get_template_part( $module, $template, $slug, $params ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}

if ( ! function_exists( 'oraiste_get_template_part' ) ) {
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
	function oraiste_get_template_part( $module, $template, $slug = '', $params = array() ) {
		// HTML Content from template
		$html          = '';
		$template_path = ORAISTE_INC_ROOT_DIR . '/' . $module;

		$temp = $template_path . '/' . $template;
		if ( is_array( $params ) && count( $params ) ) {
			extract( $params ); // @codingStandardsIgnoreLine
		}

		$template = '';

		if ( ! empty( $temp ) ) {
			if ( ! empty( $slug ) ) {
				$template = "{$temp}-{$slug}.php";

				if ( ! file_exists( $template ) ) {
					$template = $temp . '.php';
				}
			} else {
				$template = $temp . '.php';
			}
		}

		if ( $template ) {
			ob_start();
			include $template; // phpcs:ignore WPThemeReview.CoreFunctionality.FileInclude.FileIncludeFound
			$html = ob_get_clean();
		}

		return $html;
	}
}

if ( ! function_exists( 'oraiste_get_page_id' ) ) {
	/**
	 * Function that returns current page id
	 * Additional conditional is to check if current page is any wp archive page (archive, category, tag, date etc.) and returns -1
	 *
	 * @return int
	 */
	function oraiste_get_page_id() {
		$page_id = get_queried_object_id();

		if ( oraiste_is_wp_template() ) {
			$page_id = - 1;
		}

		return apply_filters( 'oraiste_filter_page_id', $page_id );
	}
}

if ( ! function_exists( 'oraiste_is_wp_template' ) ) {
	/**
	 * Function that checks if current page default wp page
	 *
	 * @return bool
	 */
	function oraiste_is_wp_template() {
		return is_archive() || is_search() || is_404() || ( is_front_page() && is_home() );
	}
}

if ( ! function_exists( 'oraiste_get_ajax_status' ) ) {
	/**
	 * Function that return status from ajax functions
	 *
	 * @param string       $status   - success or error
	 * @param string       $message  - ajax message value
	 * @param string|array $data     - returned value
	 * @param string       $redirect - url address
	 */
	function oraiste_get_ajax_status( $status, $message, $data = null, $redirect = '' ) {
		$response = array(
			'status'   => esc_attr( $status ),
			'message'  => esc_html( $message ),
			'data'     => $data,
			'redirect' => ! empty( $redirect ) ? esc_url( $redirect ) : '',
		);

		$output = json_encode( $response );

		exit( $output ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}

if ( ! function_exists( 'oraiste_get_button_element' ) ) {
	/**
	 * Function that returns button with provided params
	 *
	 * @param array $params - array of parameters
	 *
	 * @return string - string representing button html
	 */
	function oraiste_get_button_element( $params ) {
		if ( class_exists( 'OraisteCore_Button_Shortcode' ) ) {
			return OraisteCore_Button_Shortcode::call_shortcode( $params );
		} else {
			$link   = isset( $params['link'] ) ? $params['link'] : '#';
			$target = isset( $params['target'] ) ? $params['target'] : '_self';
			$text   = isset( $params['text'] ) ? $params['text'] : '';

			return '<a itemprop="url" class="qodef-theme-button" href="' . esc_url( $link ) . '" target="' . esc_attr( $target ) . '">' . esc_html( $text ) . '</a>';
		}
	}
}

if ( ! function_exists( 'oraiste_render_button_element' ) ) {
	/**
	 * Function that render button with provided params
	 *
	 * @param array $params - array of parameters
	 */
	function oraiste_render_button_element( $params ) {
		echo oraiste_get_button_element( $params ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}

if ( ! function_exists( 'oraiste_class_attribute' ) ) {
	/**
	 * Function that render class attribute
	 *
	 * @param string|array $class
	 */
	function oraiste_class_attribute( $class ) {
		echo oraiste_get_class_attribute( $class ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}

if ( ! function_exists( 'oraiste_get_class_attribute' ) ) {
	/**
	 * Function that return class attribute
	 *
	 * @param string|array $class
	 *
	 * @return string|mixed
	 */
	function oraiste_get_class_attribute( $class ) {
		$value = oraiste_is_installed( 'framework' ) ? qode_framework_get_class_attribute( $class ) : '';

		return $value;
	}
}

if ( ! function_exists( 'oraiste_get_post_value_through_levels' ) ) {
	/**
	 * Function that returns meta value if exists
	 *
	 * @param string $name    name of option
	 * @param int    $post_id id of
	 *
	 * @return string value of option
	 */
	function oraiste_get_post_value_through_levels( $name, $post_id = null ) {
		return oraiste_is_installed( 'framework' ) && oraiste_is_installed( 'core' ) ? oraiste_core_get_post_value_through_levels( $name, $post_id ) : '';
	}
}

if ( ! function_exists( 'oraiste_get_space_value' ) ) {
	/**
	 * Function that returns spacing value based on selected option
	 *
	 * @param string $text_value - textual value of spacing
	 *
	 * @return int
	 */
	function oraiste_get_space_value( $text_value ) {
		return oraiste_is_installed( 'core' ) ? oraiste_core_get_space_value( $text_value ) : 0;
	}
}

if ( ! function_exists( 'oraiste_wp_kses_html' ) ) {
	/**
	 * Function that does escaping of specific html.
	 * It uses wp_kses function with predefined attributes array.
	 *
	 * @param string $type    - type of html element
	 * @param string $content - string to escape
	 *
	 * @return string escaped output
	 * @see wp_kses()
	 */
	function oraiste_wp_kses_html( $type, $content ) {
		return oraiste_is_installed( 'framework' ) ? qode_framework_wp_kses_html( $type, $content ) : $content;
	}
}

if ( ! function_exists( 'oraiste_render_svg_icon' ) ) {
	/**
	 * Function that print svg html icon
	 *
	 * @param string $name       - icon name
	 * @param string $class_name - custom html tag class name
	 */
	function oraiste_render_svg_icon( $name, $class_name = '' ) {
		echo oraiste_get_svg_icon( $name, $class_name ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}

if ( ! function_exists( 'oraiste_get_svg_icon' ) ) {
	/**
	 * Returns svg html
	 *
	 * @param string $name       - icon name
	 * @param string $class_name - custom html tag class name
	 *
	 * @return string|html
	 */
	function oraiste_get_svg_icon( $name, $class_name = '' ) {
		$html  = '';
		$class = isset( $class_name ) && ! empty( $class_name ) ? 'class="' . esc_attr( $class_name ) . '"' : '';

		switch ( $name ) {
			case 'menu': // FIXED
				$html = '<svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="29px" height="21px" viewBox="0 0 29 21" xml:space="preserve"><g><line x1="0" y1="7.5" x2="29" y2="7.5"></line><line x1="0" y1="14.5" x2="29" y2="14.5"></line></g></svg>';
				break;
			case 'search': // FIXED
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="24px" height="24px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve"><g><path d="M19.5,10.6c0,1.7-0.6,3.1-1.8,4.3c-1.2,1.2-2.6,1.8-4.3,1.8c-1.4,0-2.7-0.4-3.8-1.3l-4,4 c-0.1,0.1-0.3,0.2-0.5,0.2c-0.2,0-0.3-0.1-0.5-0.2c-0.1-0.1-0.2-0.3-0.2-0.5c0-0.2,0.1-0.3,0.2-0.5l4-4c-0.9-1.1-1.3-2.4-1.3-3.8 c0-1.7,0.6-3.1,1.8-4.3c1.2-1.2,2.6-1.8,4.3-1.8c1.7,0,3.1,0.6,4.3,1.8C18.9,7.4,19.5,8.9,19.5,10.6z M18.6,10.6 c0-1.4-0.5-2.6-1.5-3.6c-1-1-2.2-1.5-3.6-1.5c-1.4,0-2.6,0.5-3.6,1.5c-1,1-1.5,2.2-1.5,3.6c0,1.4,0.5,2.6,1.5,3.6 c1,1,2.2,1.5,3.6,1.5c1.4,0,2.6-0.5,3.6-1.5C18.1,13.2,18.6,12,18.6,10.6z"/></g></svg>';
				break;
			case 'star':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="32" height="32" viewBox="0 0 32 32"><g><path d="M 20.756,11.768L 15.856,1.84L 10.956,11.768L0,13.36L 7.928,21.088L 6.056,32L 15.856,26.848L 25.656,32L 23.784,21.088L 31.712,13.36 z"></path></g></svg>';
				break;
			case 'menu-arrow-right': // [ 1, short right]
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 19 9" style="enable-background:new 0 0 19 9;" xml:space="preserve"><line x1="0.1" y1="4.5" x2="18.2" y2="4.5"/><polyline points="14.3,0.6 18.2,4.4 14.3,8.4 "/></svg>';
				break;
			case 'slider-arrow-left': // [ 3 REVERSE, large left ]
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 38 74" style="enable-background:new 0 0 38 74;" xml:space="preserve"><polyline points="38,73.3 1.7,36.9 38,0.7 "/></svg>';
				break;
			case 'slider-arrow-right': // [ 3, large right ]
				$html = '<svg  ' . $class . ' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 38 74" style="enable-background:new 0 0 38 74;" xml:space="preserve"><polyline points="0.4,0.7 36.7,36.9 0.4,73.3 "/></svg>';
				break;
			case 'pagination-arrow-left': // [ 2 REVERSE, long right ]
				$html = '<svg  ' . $class . ' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 34 11" style="enable-background:new 0 0 34 11;" xml:space="preserve"><line x1="1.2" y1="5.5" x2="33.3" y2="5.5"/><polyline points="5.5,10.3 0.7,5.5 5.5,0.7 "/></svg>';
				break;
			case 'pagination-arrow-right': // [ 2, long right ]
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 34 11" style="enable-background:new 0 0 34 11;" xml:space="preserve"><line x1="0" y1="5.5" x2="32.1" y2="5.5"/><polyline points="27.8,0.7 32.6,5.5 27.8,10.3 "/></svg>';
				break;
			case 'navigation-arrow-left': // [ 1 REVERSE, short left ]
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 19 9" style="enable-background:new 0 0 19 9;" xml:space="preserve"><line x1="0.7" y1="4.5" x2="18.8" y2="4.5"/><polyline points="4.6,8.4 0.7,4.4 4.6,0.6 "/></svg>';
				break;
			case 'navigation-arrow-right': // [ 1, short right ]
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 19 9" style="enable-background:new 0 0 19 9;" xml:space="preserve"><line x1="0.1" y1="4.5" x2="18.2" y2="4.5"/><polyline points="14.3,0.6 18.2,4.4 14.3,8.4 "/></svg>';
				break;
			case 'close': // FIXED
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="57px" height="41.7px" viewBox="0 0 57 41.7" style="enable-background:new 0 0 57 41.7;" xml:space="preserve" preserveAspectRatio="none"><g><line x1="8.3" y1="41" x2="48.7" y2="0.7"/><line x1="48.7" y1="41" x2="8.3" y2="0.7"/></g></svg>';
				break;
			case 'spinner':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" width="512" height="512" viewBox="0 0 512 512"><path d="M304 48c0 26.51-21.49 48-48 48s-48-21.49-48-48 21.49-48 48-48 48 21.49 48 48zm-48 368c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48-21.49-48-48-48zm208-208c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48-21.49-48-48-48zM96 256c0-26.51-21.49-48-48-48S0 229.49 0 256s21.49 48 48 48 48-21.49 48-48zm12.922 99.078c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48c0-26.509-21.491-48-48-48zm294.156 0c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48c0-26.509-21.49-48-48-48zM108.922 60.922c-26.51 0-48 21.49-48 48s21.49 48 48 48 48-21.49 48-48-21.491-48-48-48z"></path></svg>';
				break;
			case 'link':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="84.7px" height="67.3px" viewBox="0 0 84.7 67.3" style="enable-background:new 0 0 84.7 67.3;" xml:space="preserve"><g><path d="M45.8,41L19.3,54.3c-6.4,3.2-14.2,0.6-17.4-5.8l0,0c-3.2-6.4-0.6-14.2,5.8-17.4l26.6-13.3 c6.4-3.2,14.2-0.6,17.4,5.8l0,0C54.8,30,52.2,37.8,45.8,41z"/><path d="M77.1,36.2L50.5,49.5c-6.4,3.2-14.2,0.6-17.4-5.8l0,0c-3.2-6.4-0.6-14.2,5.8-17.4L65.5,13 c6.4-3.2,14.2-0.6,17.4,5.8l0,0C86.1,25.2,83.4,33,77.1,36.2z"/></g></svg>';
				break;
			case 'quote':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="84.7px" height="67.3px" viewBox="0 0 84.7 67.3" style="enable-background:new 0 0 84.7 67.3;" xml:space="preserve"><g><path d="M41.8,12.5c3,4,4.5,9.8,4.5,17.2c0,7-1.5,13.4-4.6,19.2C38.6,54.8,34,60.7,28,66.6c-0.2,0.2-0.4,0.2-0.7,0.2 c-0.5,0-0.9-0.2-1.2-0.7c-0.3-0.5-0.3-0.9,0-1.2c7.8-7.9,11.6-17.2,11.6-28c0-4.4-0.8-7.7-2.4-9.7c-1.4,2.4-4.2,3.6-8.3,3.6 c-3.5,0-6.3-1.1-8.3-3.2c-2.1-2.1-3.1-5-3.1-8.7c0-4,1.2-7,3.7-9.1c2.5-2.1,5.8-3.2,10.1-3.2C34.7,6.5,38.8,8.5,41.8,12.5z"/><path d="M62.9,5.5c3.3,3.8,5.4,9.3,6,16.7c0.6,6.9-0.4,13.5-2.9,19.6c-2.6,6.1-6.6,12.3-12,18.7 c-0.1,0.2-0.4,0.3-0.7,0.3c-0.5,0-0.9-0.2-1.2-0.6c-0.4-0.4-0.4-0.8-0.1-1.2c7-8.6,10.1-18.2,9.1-28.9c-0.4-4.4-1.5-7.6-3.2-9.5 c-1.2,2.5-3.9,3.9-8,4.3c-3.5,0.3-6.3-0.5-8.6-2.5c-2.2-1.9-3.5-4.7-3.8-8.4C37.1,10.2,38,7,40.3,4.7C42.5,2.3,45.8,1,50,0.6 C55.2,0.1,59.5,1.8,62.9,5.5z"/></g></svg>';
				break;
			case 'animated-button-arrow': // [ 2, long right ]
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 34 11" style="enable-background:new 0 0 34 11;" xml:space="preserve"><line x1="0" y1="5.5" x2="32.1" y2="5.5"/><polyline points="27.8,0.7 32.6,5.5 27.8,10.3 "/></svg>';
				break;
			case 'animated-button-circle': // done
				$html = '<svg ' . $class . ' viewBox="0 0 100 100"><path d="M72.3 27.41 C 74.53166666666667 29.97 78.22 33.70666666666666 79.59 36.82 80.96000000000001 39.93333333333334 80.10833333333333 42.79666666666667 80.52 46.09 80.93166666666666 49.38333333333334 82.13666666666667 53.36 82.06 56.58 81.98333333333333 59.8 81.79 62.346666666666664 80.06 65.41 78.33 68.47333333333333 74.51833333333335 72.82333333333332 71.68 74.96 68.84166666666667 77.09666666666666 65.95 76.95666666666668 63.03 78.23 60.11 79.50333333333333 57.364999999999995 81.62166666666667 54.16 82.6 50.955 83.57833333333332 46.968333333333334 84.47333333333333 43.8 84.1 40.63166666666666 83.72666666666666 37.946666666666665 82.13666666666667 35.15 80.36 32.35333333333333 78.58333333333333 29.301666666666666 76.33666666666666 27.02 73.44 24.738333333333333 70.54333333333334 22.775000000000002 66.185 21.46 62.98 20.145 59.775 19.988333333333333 57.33 19.13 54.21 18.271666666666665 51.09 16.044999999999998 47.78333333333333 16.31 44.26 16.575 40.736666666666665 18.796666666666667 36.21333333333333 20.72 33.07 22.64333333333333 29.926666666666666 25.378333333333334 27.341666666666665 27.85 25.4 30.32166666666667 23.458333333333332 32.541666666666664 22.683333333333334 35.55 21.42 38.55833333333333 20.15666666666667 42.42 18.196666666666665 45.9 17.82 49.379999999999995 17.443333333333335 53.04666666666667 18.553333333333335 56.43 19.16 59.81333333333333 19.766666666666666 63.55500000000001 20.085 66.2 21.46 68.845 22.835 70.06833333333333 24.85 72.3 27.41z"></path></svg>';
				break;
			case 'button-arrow': // [ 1, short right ]
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 19 9" style="enable-background:new 0 0 19 9;" xml:space="preserve"><line x1="0.1" y1="4.5" x2="18.2" y2="4.5"/><polyline points="14.3,0.6 18.2,4.4 14.3,8.4 "/></svg>';
				break;
			case 'ripped-lines':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="789.5px" height="238.9px" viewBox="0 0 789.5 238.9" style="enable-background:new 0 0 789.5 238.9;" xml:space="preserve" preserveAspectRatio="none"><path d="M1.6,160.2c0,0,17.2-27.5,26.4-45.8s26.9-58.2,26.9-58.2s7.7-7.3,8.8-12.9S63.3,31.8,69,25.9  C74.7,20,86,8.1,93.9,5.7s11-3.1,18.5-2.8s23.3-1.6,37.1-1.9c13.8-0.3,70.6,8.7,78.4,8.6c7.8-0.1,23.6,3.7,29.6,3.9  c6,0.2,32.5,1.9,42.8,2.4c10.3,0.5,19.7,3.2,32.5,6.8s20.6,4,34.2,5.9c13.6,1.9,17.2,2.9,22.7,5.4s18.4,10,33.9,10.6  c15.5,0.6,53.8,2.8,74.2,4.7c20.4,1.9,31.8,4.5,40.8,4.2c8.9-0.3,32.3-5.1,42.5-5c10.2,0.1,44.6,3.5,53.5,2.8  c8.9-0.7,54.3-9.3,63.1-10.2s18.7-2.5,20.8-3.5c2.1-1,8.6-9.7,10.2-8.8s2.9,4.7,4.2,9.8s4.7,9.4,5,16.6s2.4,39.1,2.4,39.1  s1.1,23.2,3,31.7c1.9,8.5,7.2,23.5,7.4,26.6c0.2,3.1,0,7,0,7s2.2-0.2,1.9,1.2c-0.3,1.4-2.8,9.7-2.8,9.7s-5.7-4.3-13.1-2.5  c-7.4,1.8-9,4.4-12.3,8.8c-3.3,4.4-4.1,9.2-29.3,9.3c-25.2,0.1-36.5-0.6-65.6,2.1c-29.1,2.6-37.1,2.2-53.4,8.1  c-16.3,5.9-27.5,12.6-50.6,10.3c-23.2-2.3-18.9-4.3-37-2.8c-18.1,1.5-57.7,5.9-78.8,7s-54.6,3.3-67.8,1.1s-46-3.6-59.5-3.4  s-45.2-6.4-66.6-10s-31.3-4.1-36.2-5.1c-4.9-0.9-22.1-8.6-38.6-13.5c-16.5-4.9-48.7-5.3-56.6-6.7s-13.2-5.5-18.2-5.8  c-5-0.3-21.5,0.4-34.6-1.5C18.4,163.9,1.6,160.2,1.6,160.2z"/><path class="st0" d="M37.1,65l2.6-9.1c0,0,10.8,5.3,16.5,2.8s9.8-12.6,18.2-14.5c8.5-1.9,18.5-0.4,50-2c31.6-1.6,47.8,1.5,68.1-4.3  S230.2,24,245,23.1c14.9-0.9,42.8,5.9,58.5,4.7c15.7-1.2,29-5.2,61.4-5.5s63.2-4.2,76.6-0.5s58.4,3.2,73.4,4.7  c15,1.5,46.8,7.1,59.8,12.1c13,5,29.7,3.1,40.4,6.7C625.8,49,647,62.7,672.3,65c25.3,2.3,30.4,2.1,40,4.9s21.5,0,37,2.7  s31,5,36.4,6.5s1.3,3.7,1.3,3.7s-35,60.2-40.9,77.9c-5.9,17.7-18.5,23.9-19.5,31.1c-0.9,7.2-0.5,11.1-4.9,16.4  c-4.5,5.3-16.6,24.1-35.4,26.6c-18.8,2.5-52.2,3.9-63.2,2.5c-11-1.4-45.2-7.7-59.7-8.8c-14.5-1-29.4-6.1-55.4-6.4  s-64.9-16.6-83-17.5c-18.1-0.9-29.9-6.6-40.5-12.6c-10.5-6-29.6-3.2-45.1-4.5c-15.5-1.2-57.3-4.7-77.1-8.1s-36.6,0-51,0  c-14.4,0-27.7-4.4-51.4-3.2c-23.7,1.2-50.5,9.3-65.9,11c-15.4,1.7-27.8-0.2-31.5,5.6c-3.8,5.8-4.8,9.7-7.3-0.2  c-2.6-9.9-8.9-40.8-7.5-57.4s0.7-25.5-3.3-39.9S37.1,65,37.1,65z"/></svg>';
				break;
			case 'ripped-square':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="198.1px" height="114.2px" viewBox="0 0 198.1 114.2" style="enable-background:new 0 0 198.1 114.2;" xml:space="preserve"><path d="M8.9,16.5c19.8-5.4,40.7-5.4,61.3-5.4c39.8,0.1,79.5,0.1,119.3,0.2c0.1,13.5,0.2,27,0.4,40.5  c0.1,8.1,0.1,16.3-1.1,24.4c-1.4,9.2-4.4,18.1-4.9,27.3c-17.2-9-37.7-7.5-57.1-6.4c-38.1,2-76.3,1.3-114.5,0.6  c5.9-32.1,7.8-64.9,5.5-97.4c0.6,4.1,0.3,8.4-0.6,12.5c58.3,0.5,116.5,1,174.8,1.5c-0.9,16.6,2.2,33.2,4,49.7s2.6,33.7-2.9,49.5  C131.5,92.3,65.3,88.6,0.3,91c3.3-20.8,5.6-42.7,5.5-63.7"/></svg>';
				break;
			case 'ripped-circle':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="93.9px" height="94.7px" viewBox="0 0 93.9 94.7" style="enable-background:new 0 0 93.9 94.7;" xml:space="preserve"><path class="st0" d="M2.9,30.6c-0.5,3-2,5.8-1.9,8.8c0.2,5.9,0.5,11.9,0.7,17.8c0.1,2.4,0.2,4.9,1,7.2c1,2.9,3.1,5.3,5.1,7.6  c6.5,7.4,13.4,15,22.6,18c2.7,0.9,5.5,1.3,8.3,1.8c4.9,0.8,8.3,0.3,13.1,1.1c3,0.5,6.5,1.4,9.2,0c1.6-0.8,3.7-2.5,5-3.7  c4.2-3.8,9.6-5.4,13.7-9.3c8.3-7.9,11.3-20.1,12.8-31.7c0.8-6.4,0.1-11.4-2-17.4c-1.2-3.6-2.2-8.4-4.5-11.4  C76.9,8.1,63.1,1.7,48.9,1C39.6,0.6,29.4,4,24.7,6.4c-2.7,1.4-6.5,2.5-9.3,4.3C8.7,15.2,4.3,22.2,2.9,30.6z"/></svg>';
				break;
			case 'back-to-top':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="10.3px" height="33.3px" viewBox="0 0 10.3 33.3" style="enable-background:new 0 0 10.3 33.3;" xml:space="preserve"><line x1="5.2" y1="33.3" x2="5.2" y2="1.2"/><polyline points="0.4,5.5 5.2,0.7 10,5.5 "/></svg>';
				break;
			case 'back-to-link':
				$html = '<svg ' . $class . ' xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" width="24px" height="24px" viewBox="0 0 24 24" style="enable-background:new 0 0 24 24;" xml:space="preserve"><rect x="0.5" y="0.5" width="8" height="8"/><rect x="15.5" y="0.5" width="8" height="8"/><rect x="0.5" y="15.5" transform="matrix(6.123234e-17 -1 1 6.123234e-17 -15 24)" width="8" height="8"/><rect x="15.5" y="15.5" transform="matrix(6.123234e-17 -1 1 6.123234e-17 0 39)" width="8" height="8"/></svg>';
				break;
		}

		return apply_filters( 'oraiste_filter_svg_icon', $html );
	}
}

if ( ! function_exists( 'oraiste_get_font' ) ) {
	/**
	 * Function that set font
	 */
	function oraiste_get_font() {
		if ( oraiste_is_installed( 'core' ) ) {
			$font_subset_array = array(
				'latin-ext',
			);

			$font_weight_array = array(
				'300',
				'400',
			);

			$first_font_family = array(
				'Italiana',
				'Prompt',
			);

			$font_family_skin = oraiste_core_get_post_value_through_levels( 'qodef_page_font_skin' );

			if ( $font_family_skin === 'saira' ) {
				$first_font_family = array(
					'Saira Extra Condensed',
					'Prompt',
				);

				$font_weight_array = array(
					'300',
					'600',
				);
			}
			if ( $font_family_skin === 'prompt' ) {
				$first_font_family = array(
					'Prompt',
				);

				$font_weight_array = array(
					'300',
					'400',
					'500',
				);
			}

			if ( $font_family_skin === 'cormorant' ) {
				$font_weight_array = array(
					'300',
					'400',
				);

				$first_font_family = array(
					'Cormorant',
					'Prompt',
				);
			}

			$font_weight_str = implode( ',', array_unique( apply_filters( 'oraiste_filter_google_fonts_weight_list', $font_weight_array ) ) );
			$font_subset_str = implode( ',', array_unique( apply_filters( 'oraiste_filter_google_fonts_subset_list', $font_subset_array ) ) );
			$fonts_array     = apply_filters( 'oraiste_filter_google_fonts_list', $first_font_family );

			if ( ! empty( $fonts_array ) ) {
				$modified_default_font_family = array();

				foreach ( $fonts_array as $font ) {
					$modified_default_font_family[] = $font . ':' . $font_weight_str;
				}

				$default_font_string = implode( '|', $modified_default_font_family );

				$fonts_full_list_args = array(
					'family'  => urlencode( $default_font_string ),
					'subset'  => urlencode( $font_subset_str ),
					'display' => 'swap',
				);

				$google_fonts_url = add_query_arg( $fonts_full_list_args, 'https://fonts.googleapis.com/css' );

				wp_enqueue_style( 'oraiste-google-fonts', esc_url_raw( $google_fonts_url ), array(), '1.0.0' );
			}
		}
	}

	add_action( 'oraiste_action_before_main_css', 'oraiste_get_font' );
}

if ( ! function_exists( 'oraiste_add_font_body_classes' ) ) {
	/**
	 * Function that add font skin body classes
	 *
	 * @param $classes
	 *
	 * @return mixed
	 */
	function oraiste_add_font_body_classes( $classes ) {
		if ( oraiste_is_installed( 'core' ) ) {
			$font_family_skin = oraiste_core_get_post_value_through_levels( 'qodef_page_font_skin' );

			$classes[] = 'cormorant' === $font_family_skin ? 'qodef-font-skin--cormorant' : '';
			$classes[] = 'italiana' === $font_family_skin ? 'qodef-font-skin--italiana' : '';
			$classes[] = 'saira' === $font_family_skin ? 'qodef-font-skin--saira' : '';
			$classes[] = 'prompt' === $font_family_skin ? 'qodef-font-skin--prompt' : '';
		}

		return $classes;
	}

	add_filter( 'body_class', 'oraiste_add_font_body_classes' );
}
