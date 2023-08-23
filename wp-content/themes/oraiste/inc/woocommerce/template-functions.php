<?php

/**
 * Global templates hooks
 */

if ( ! function_exists( 'oraiste_add_main_woo_page_template_holder' ) ) {
	/**
	 * Function that render additional content for main shop page
	 */
	function oraiste_add_main_woo_page_template_holder() {
		echo '<main id="qodef-page-content" class="qodef-grid qodef-layout--template qodef--no-bottom-space ' . esc_attr( oraiste_get_grid_gutter_classes() ) . '"><div class="qodef-grid-inner clear">';
	}
}

if ( ! function_exists( 'oraiste_add_main_woo_page_template_holder_end' ) ) {
	/**
	 * Function that render additional content for main shop page
	 */
	function oraiste_add_main_woo_page_template_holder_end() {
		echo '</div></main>';
	}
}

if ( ! function_exists( 'oraiste_add_main_woo_page_holder' ) ) {
	/**
	 * Function that render additional content around WooCommerce pages
	 */
	function oraiste_add_main_woo_page_holder() {
		$classes = array();

		// add class to pages with sidebar and on single page
		if ( oraiste_is_woo_page( 'archive' ) || oraiste_is_woo_page( 'single' ) ) {
			$classes[] = 'qodef-grid-item';
		}

		// add class to pages with sidebar
		if ( oraiste_is_woo_page( 'archive' ) ) {
			$classes[] = oraiste_get_page_content_sidebar_classes();
		}

		$classes[] = oraiste_get_woo_main_page_classes();

		echo '<div id="qodef-woo-page" class="' . esc_attr( implode( ' ', $classes ) ) . '">';
	}
}

if ( ! function_exists( 'oraiste_add_main_woo_page_holder_end' ) ) {
	/**
	 * Function that render additional content around WooCommerce pages
	 */
	function oraiste_add_main_woo_page_holder_end() {
		echo '</div>';
	}
}

if ( ! function_exists( 'oraiste_add_main_woo_page_sidebar_holder' ) ) {
	/**
	 * Function that render sidebar layout for main shop page
	 */
	function oraiste_add_main_woo_page_sidebar_holder() {

		if ( ! is_singular( 'product' ) ) {
			// Include page content sidebar
			oraiste_template_part( 'sidebar', 'templates/sidebar' );
		}
	}
}

if ( ! function_exists( 'oraiste_woo_render_product_categories' ) ) {
	/**
	 * Function that render product categories
	 *
	 * @param string $before
	 * @param string $after
	 */
	function oraiste_woo_render_product_categories( $before = '', $after = '' ) {
		echo oraiste_woo_get_product_categories( $before, $after ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}

if ( ! function_exists( 'oraiste_woo_get_product_categories' ) ) {
	/**
	 * Function that render product categories
	 *
	 * @param string $before
	 * @param string $after
	 *
	 * @return string
	 */
	function oraiste_woo_get_product_categories( $before = '', $after = '' ) {
		$product = oraiste_woo_get_global_product();

		return ! empty( $product ) ? wc_get_product_category_list( $product->get_id(), '<span class="qodef-category-separator"></span>', $before, $after ) : '';
	}
}

/**
 * Shop page templates hooks
 */

if ( ! function_exists( 'oraiste_add_results_and_ordering_holder' ) ) {
	/**
	 * Function that render additional content around results and ordering templates on main shop page
	 */
	function oraiste_add_results_and_ordering_holder() {
		echo '<div class="qodef-woo-results">';
	}
}

if ( ! function_exists( 'oraiste_add_results_and_ordering_holder_end' ) ) {
	/**
	 * Function that render additional content around results and ordering templates on main shop page
	 */
	function oraiste_add_results_and_ordering_holder_end() {
		echo '</div>';
	}
}

if ( ! function_exists( 'oraiste_add_product_list_item_holder' ) ) {
	/**
	 * Function that render additional content around product list item on main shop page
	 */
	function oraiste_add_product_list_item_holder() {
		echo '<div class="qodef-woo-product-inner">';
	}
}

if ( ! function_exists( 'oraiste_add_product_list_item_holder_end' ) ) {
	/**
	 * Function that render additional content around product list item on main shop page
	 */
	function oraiste_add_product_list_item_holder_end() {
		echo '</div>';
	}
}

if ( ! function_exists( 'oraiste_add_product_list_item_image_holder' ) ) {
	/**
	 * Function that render additional content around image template on main shop page
	 */
	function oraiste_add_product_list_item_image_holder() {
		echo '<div class="qodef-woo-product-image">';
	}
}

if ( ! function_exists( 'oraiste_add_product_list_item_image_holder_end' ) ) {
	/**
	 * Function that render additional content around image template on main shop page
	 */
	function oraiste_add_product_list_item_image_holder_end() {
		echo '</div>';
	}
}

if ( ! function_exists( 'oraiste_add_product_list_item_additional_image_holder' ) ) {
	/**
	 * Function that render additional content around image and sale templates on main shop page
	 */
	function oraiste_add_product_list_item_additional_image_holder() {
		echo '<div class="qodef-woo-product-image-inner">';
	}
}

if ( ! function_exists( 'oraiste_add_product_list_item_additional_image_holder_end' ) ) {
	/**
	 * Function that render additional content around image and sale templates on main shop page
	 */
	function oraiste_add_product_list_item_additional_image_holder_end() {
		// Hook to include additional content inside product list item image
		do_action( 'oraiste_action_product_list_item_additional_image_content' );

		echo '</div>';
	}
}

if ( ! function_exists( 'oraiste_add_product_list_item_content_holder' ) ) {
	/**
	 * Function that render additional content around product info on main shop page
	 */
	function oraiste_add_product_list_item_content_holder() {
		echo '<div class="qodef-woo-product-content">';
	}
}

if ( ! function_exists( 'oraiste_add_product_list_item_content_holder_end' ) ) {
	/**
	 * Function that render additional content around product info on main shop page
	 */
	function oraiste_add_product_list_item_content_holder_end() {
		echo '</div>';
	}
}

if ( ! function_exists( 'oraiste_add_product_list_item_categories' ) ) {
	/**
	 * Function that render product categories
	 */
	function oraiste_add_product_list_item_categories() {
		oraiste_woo_render_product_categories( '<div class="qodef-woo-product-categories">', '</div>' );
	}
}

/**
 * Product single page templates hooks
 */

if ( ! function_exists( 'oraiste_add_product_single_content_holder' ) ) {
	/**
	 * Function that render additional content around image and summary templates on single product page
	 */
	function oraiste_add_product_single_content_holder() {
		echo '<div class="qodef-woo-single-inner">';
	}
}

if ( ! function_exists( 'oraiste_add_product_single_content_holder_end' ) ) {
	/**
	 * Function that render additional content around image and summary templates on single product page
	 */
	function oraiste_add_product_single_content_holder_end() {
		echo '</div>';
	}
}

if ( ! function_exists( 'oraiste_add_product_single_image_holder' ) ) {
	/**
	 * Function that render additional content around featured image on single product page
	 */
	function oraiste_add_product_single_image_holder() {
		echo '<div class="qodef-woo-single-image">';
	}
}

if ( ! function_exists( 'oraiste_add_product_single_image_holder_end' ) ) {
	/**
	 * Function that render additional content around featured image on single product page
	 */
	function oraiste_add_product_single_image_holder_end() {
		echo '</div>';
	}
}

if ( ! function_exists( 'oraiste_woo_product_render_social_share_html' ) ) {
	/**
	 * Function that render social share html
	 */
	function oraiste_woo_product_render_social_share_html() {

		if ( class_exists( 'OraisteCore_Social_Share_Shortcode' ) ) {
			$params           = array();
			$params['layout'] = 'list';
			$params['title']  = esc_html__( 'Share:', 'oraiste' );

			echo OraisteCore_Social_Share_Shortcode::call_shortcode( $params ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
	}
}

/**
 * Override default WooCommerce templates
 */

if ( ! function_exists( 'oraiste_woo_disable_page_heading' ) ) {
	/**
	 * Function that disable heading template on main shop page
	 *
	 * @return bool
	 */
	function oraiste_woo_disable_page_heading() {
		return false;
	}
}

if ( ! function_exists( 'oraiste_add_product_list_holder' ) ) {
	/**
	 * Function that add additional content around product lists on main shop page
	 *
	 * @param string $html
	 *
	 * @return string which contains html content
	 */
	function oraiste_add_product_list_holder( $html ) {
		$classes = array();
		$layout  = oraiste_get_post_value_through_levels( 'qodef_product_list_item_layout' );
		$option  = oraiste_get_post_value_through_levels( 'qodef_woo_product_list_columns_space' );

		if ( ! empty( $layout ) ) {
			$classes[] = 'qodef-item-layout--' . $layout;
		}

		if ( ! empty( $option ) ) {
			$classes[] = 'qodef-gutter--' . $option;
		}

		return '<div class="qodef-woo-product-list ' . esc_attr( implode( ' ', $classes ) ) . '">' . $html;
	}
}

if ( ! function_exists( 'oraiste_add_product_list_holder_end' ) ) {
	/**
	 * Function that add additional content around product lists on main shop page
	 *
	 * @param string $html
	 *
	 * @return string which contains html content
	 */
	function oraiste_add_product_list_holder_end( $html ) {
		return $html . '</div>';
	}
}

if ( ! function_exists( 'oraiste_woo_product_list_columns' ) ) {
	/**
	 * Function that set number of columns for main shop page
	 *
	 * @return int
	 */
	function oraiste_woo_product_list_columns() {
		$option = oraiste_get_post_value_through_levels( 'qodef_woo_product_list_columns' );

		if ( ! empty( $option ) ) {
			$columns = intval( $option );
		} else {
			$columns = 3;
		}

		return $columns;
	}
}

if ( ! function_exists( 'oraiste_woo_products_per_page' ) ) {
	/**
	 * Function that set number of items for main shop page
	 *
	 * @param int $products_per_page
	 *
	 * @return int
	 */
	function oraiste_woo_products_per_page( $products_per_page ) {
		$option = oraiste_get_post_value_through_levels( 'qodef_woo_product_list_products_per_page' );

		if ( ! empty( $option ) ) {
			$products_per_page = intval( $option );
		}

		return $products_per_page;
	}
}

if ( ! function_exists( 'oraiste_woo_pagination_args' ) ) {
	/**
	 * Function that override pagination args on main shop page
	 *
	 * @param array $args
	 *
	 * @return array
	 */
	function oraiste_woo_pagination_args( $args ) {
		$args['prev_text'] = oraiste_get_svg_icon( 'pagination-arrow-left' );
		$args['next_text'] = oraiste_get_svg_icon( 'pagination-arrow-right' );
		$args['type']      = 'plain';

		return $args;
	}
}

if ( ! function_exists( 'oraiste_add_single_product_classes' ) ) {
	/**
	 * Function that render additional content around WooCommerce pages
	 *
	 * @param array  $classes Default argument array
	 * @param string $class
	 * @param int    $post_id
	 *
	 * @return array
	 */
	function oraiste_add_single_product_classes( $classes, $class = '', $post_id = 0 ) {
		if ( ! $post_id || ! in_array( get_post_type( $post_id ), array( 'product', 'product_variation' ), true ) ) {
			return $classes;
		}

		$product = wc_get_product( $post_id );

		if ( $product ) {
			$new = get_post_meta( $post_id, 'qodef_show_new_sign', true );

			if ( 'yes' === $new ) {
				$classes[] = 'new';
			}
		}

		return $classes;
	}
}

if ( ! function_exists( 'oraiste_add_sale_flash_on_product' ) ) {
	/**
	 * Function for adding on sale template for product
	 */
	function oraiste_add_sale_flash_on_product() {
		echo oraiste_woo_set_sale_flash(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
	}
}

if ( ! function_exists( 'oraiste_woo_set_sale_flash' ) ) {
	/**
	 * Function that override on sale template for product
	 *
	 * @return string which contains html content
	 */
	function oraiste_woo_set_sale_flash() {
		$product = oraiste_woo_get_global_product();

		if ( ! empty( $product ) && $product->is_on_sale() && $product->is_in_stock() ) {
			return oraiste_woo_get_woocommerce_sale( $product );
		}

		return '';
	}
}

if ( ! function_exists( 'oraiste_woo_get_woocommerce_sale' ) ) {
	/**
	 * Function that return sale mark label
	 *
	 * @param object $product
	 *
	 * @return string
	 */
	function oraiste_woo_get_woocommerce_sale( $product ) {
		$enable_percent_mark = oraiste_get_post_value_through_levels( 'qodef_woo_enable_percent_sign_value' );
		$price               = floatval( $product->get_regular_price() );
		$sale_price          = floatval( $product->get_sale_price() );

		if ( $price > 0 && 'yes' === $enable_percent_mark ) {
			$sale_label = '-' . ( 100 - round( ( $sale_price * 100 ) / $price ) ) . '%';
		} else {
			$sale_label = esc_html__( 'Sale', 'oraiste' );
		}

		return '<span class="qodef-woo-product-mark qodef-woo-onsale">' . $sale_label . '</span>';
	}
}

if ( ! function_exists( 'oraiste_add_out_of_stock_mark_on_product' ) ) {
	/**
	 * Function for adding out of stock template for product
	 */
	function oraiste_add_out_of_stock_mark_on_product() {
		$product = oraiste_woo_get_global_product();

		if ( ! empty( $product ) && ! $product->is_in_stock() ) {
			echo oraiste_get_out_of_stock_mark(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
	}
}

if ( ! function_exists( 'oraiste_get_out_of_stock_mark' ) ) {
	/**
	 * Function for adding out of stock template for product
	 *
	 * @return string
	 */
	function oraiste_get_out_of_stock_mark() {
		return '<span class="qodef-woo-product-mark qodef-out-of-stock">' . esc_html__( 'Sold', 'oraiste' ) . '</span>';
	}
}

if ( ! function_exists( 'oraiste_add_new_mark_on_product' ) ) {
	/**
	 * Function for adding out of stock template for product
	 */
	function oraiste_add_new_mark_on_product() {
		$product = oraiste_woo_get_global_product();

		if ( ! empty( $product ) && $product->get_id() !== '' ) {
			echo oraiste_get_new_mark( $product->get_id() ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		}
	}
}

if ( ! function_exists( 'oraiste_get_new_mark' ) ) {
	/**
	 * Function for adding out of stock template for product
	 *
	 * @param int $product_id
	 *
	 * @return string
	 */
	function oraiste_get_new_mark( $product_id ) {
		$option = get_post_meta( $product_id, 'qodef_show_new_sign', true );

		if ( 'yes' === $option ) {
			return '<span class="qodef-woo-product-mark qodef-new">' . esc_html__( 'New', 'oraiste' ) . '</span>';
		}

		return false;
	}
}

if ( ! function_exists( 'oraiste_woo_shop_loop_item_title' ) ) {
	/**
	 * Function that override product list item title template
	 */
	function oraiste_woo_shop_loop_item_title() {
		$option    = oraiste_get_post_value_through_levels( 'qodef_woo_product_list_title_tag' );
		$title_tag = ! empty( $option ) ? esc_attr( $option ) : 'h4';

		echo '<' . esc_attr( $title_tag ) . ' class="qodef-woo-product-title woocommerce-loop-product__title">' . wp_kses_post( get_the_title() ) . '</' . esc_attr( $title_tag ) . '>';
	}
}

if ( ! function_exists( 'oraiste_woo_template_single_title' ) ) {
	/**
	 * Function that override product single item title template
	 */
	function oraiste_woo_template_single_title() {
		$option    = oraiste_get_post_value_through_levels( 'qodef_woo_single_title_tag' );
		$title_tag = ! empty( $option ) ? esc_attr( $option ) : 'h2';

		echo '<' . esc_attr( $title_tag ) . ' class="qodef-woo-product-title product_title entry-title">' . wp_kses_post( get_the_title() ) . '</' . esc_attr( $title_tag ) . '>';
	}
}

if ( ! function_exists( 'oraiste_woo_single_thumbnail_images_columns' ) ) {
	/**
	 * Function that set number of columns for thumbnail images on single product page
	 *
	 * @param int $columns
	 *
	 * @return int
	 */
	function oraiste_woo_single_thumbnail_images_columns( $columns ) {
		$option = oraiste_get_post_value_through_levels( 'qodef_woo_single_thumbnail_images_columns' );

		if ( ! empty( $option ) ) {
			$columns = intval( $option );
		}

		return $columns;
	}
}

if ( ! function_exists( 'oraiste_woo_single_thumbnail_images_size' ) ) {
	/**
	 * Function that set thumbnail images size on single product page
	 *
	 * @return string
	 */
	function oraiste_woo_single_thumbnail_images_size() {
		return apply_filters( 'oraiste_filter_woo_single_thumbnail_size', 'woocommerce_thumbnail' );
	}
}

if ( ! function_exists( 'oraiste_woo_single_thumbnail_images_wrapper' ) ) {
	/**
	 * Function that add additional wrapper around thumbnail images on single product
	 */
	function oraiste_woo_single_thumbnail_images_wrapper() {
		echo '<div class="qodef-woo-thumbnails-wrapper">';
	}
}

if ( ! function_exists( 'oraiste_woo_single_thumbnail_images_wrapper_end' ) ) {
	/**
	 * Function that add additional wrapper around thumbnail images on single product
	 */
	function oraiste_woo_single_thumbnail_images_wrapper_end() {
		echo '</div>';
	}
}

if ( ! function_exists( 'oraiste_woo_single_related_product_list_columns' ) ) {
	/**
	 * Function that set number of columns for related product list on single product page
	 *
	 * @param array $args
	 *
	 * @return array
	 */
	function oraiste_woo_single_related_product_list_columns( $args ) {
		$option = oraiste_get_post_value_through_levels( 'qodef_woo_single_related_product_list_columns' );

		if ( ! empty( $option ) ) {
			$args['posts_per_page'] = intval( $option );
			$args['columns']        = intval( $option );
		}

		return $args;
	}
}

if ( ! function_exists( 'oraiste_woo_product_get_rating_html' ) ) {
	/**
	 * Function that override ratings templates
	 *
	 * @param string $html - contains html content
	 * @param float  $rating
	 *
	 * @return string
	 */
	function oraiste_woo_product_get_rating_html( $html, $rating ) {
		if ( ! empty( $rating ) ) {
			$html = '<div class="qodef-woo-ratings qodef-m"><div class="qodef-m-inner">';
			$html .= '<div class="qodef-m-star qodef--initial">';
			for ( $i = 0; $i < 5; $i ++ ) {
				$html .= oraiste_get_svg_icon( 'star', 'qodef-m-star-item' );
			}
			$html .= '</div>';
			$html .= '<div class="qodef-m-star qodef--active" style="width:' . ( ( $rating / 5 ) * 100 ) . '%">';
			for ( $i = 0; $i < 5; $i ++ ) {
				$html .= oraiste_get_svg_icon( 'star', 'qodef-m-star-item' );
			}
			$html .= '</div>';
			$html .= '</div></div>';
		}

		return $html;
	}
}

if ( ! function_exists( 'oraiste_woo_get_product_search_form' ) ) {
	/**
	 * Function that override product search widget form
	 *
	 * @return string which contains html content
	 */
	function oraiste_woo_get_product_search_form() {
		return oraiste_get_template_part( 'woocommerce', 'templates/product-searchform' );
	}
}

if ( ! function_exists( 'oraiste_woo_get_content_widget_product' ) ) {
	/**
	 * Function that override product content widget
	 *
	 * @param string $located
	 * @param string $template_name
	 *
	 * @return string which contains html content
	 */
	function oraiste_woo_get_content_widget_product( $located, $template_name ) {

		if ( 'content-widget-product.php' === $template_name && file_exists( ORAISTE_INC_ROOT_DIR . '/woocommerce/templates/content-widget-product.php' ) ) {
			$located = ORAISTE_INC_ROOT_DIR . '/woocommerce/templates/content-widget-product.php';
		}

		return $located;
	}
}

if ( ! function_exists( 'oraiste_woo_get_quantity_input' ) ) {
	/**
	 * Function that override quantity input
	 *
	 * @param string $located
	 * @param string $template_name
	 *
	 * @return string which contains html content
	 */
	function oraiste_woo_get_quantity_input( $located, $template_name ) {

		if ( 'global/quantity-input.php' === $template_name && file_exists( ORAISTE_INC_ROOT_DIR . '/woocommerce/templates/global/quantity-input.php' ) ) {
			$located = ORAISTE_INC_ROOT_DIR . '/woocommerce/templates/global/quantity-input.php';
		}

		return $located;
	}
}

if ( ! function_exists( 'oraiste_woo_get_single_product_meta' ) ) {
	/**
	 * Function that override single product meta
	 *
	 * @param string $located
	 * @param string $template_name
	 *
	 * @return string which contains html content
	 */
	function oraiste_woo_get_single_product_meta( $located, $template_name ) {

		if ( 'single-product/meta.php' === $template_name && file_exists( ORAISTE_INC_ROOT_DIR . '/woocommerce/templates/single-product/meta.php' ) ) {
			$located = ORAISTE_INC_ROOT_DIR . '/woocommerce/templates/single-product/meta.php';
		}

		return $located;
	}
}
