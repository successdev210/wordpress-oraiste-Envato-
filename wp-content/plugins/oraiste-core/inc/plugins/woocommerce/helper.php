<?php

if ( ! function_exists( 'oraiste_core_register_product_for_meta_options' ) ) {
	/**
	 * Function that register product post type for meta box options
	 *
	 * @param array $post_types
	 *
	 * @return array
	 */
	function oraiste_core_register_product_for_meta_options( $post_types ) {
		$post_types[] = 'product';

		return $post_types;
	}

	add_filter( 'qode_framework_filter_meta_box_save', 'oraiste_core_register_product_for_meta_options' );
	add_filter( 'qode_framework_filter_meta_box_remove', 'oraiste_core_register_product_for_meta_options' );
}

if ( ! function_exists( 'oraiste_core_woo_get_global_product' ) ) {
	/**
	 * Function that return global WooCommerce object
	 *
	 * @return object
	 */
	function oraiste_core_woo_get_global_product() {
		global $product;

		return $product;
	}
}

if ( ! function_exists( 'oraiste_core_woo_set_admin_options_map_position' ) ) {
	/**
	 * Function that set dashboard admin options map position for this module
	 *
	 * @param int $position
	 * @param string $map
	 *
	 * @return int
	 */
	function oraiste_core_woo_set_admin_options_map_position( $position, $map ) {

		if ( 'woocommerce' === $map ) {
			$position = 70;
		}

		return $position;
	}

	add_filter( 'oraiste_core_filter_admin_options_map_position', 'oraiste_core_woo_set_admin_options_map_position', 10, 2 );
}

if ( ! function_exists( 'oraiste_core_include_woocommerce_shortcodes' ) ) {
	/**
	 * Function that includes shortcodes
	 */
	function oraiste_core_include_woocommerce_shortcodes() {
		foreach ( glob( ORAISTE_CORE_PLUGINS_PATH . '/woocommerce/shortcodes/*/include.php' ) as $shortcode ) {
			include_once $shortcode;
		}
	}

	add_action( 'qode_framework_action_before_shortcodes_register', 'oraiste_core_include_woocommerce_shortcodes' );
}

if ( ! function_exists( 'oraiste_core_woo_product_get_rating_html' ) ) {
	/**
	 * Function that return ratings templates
	 *
	 * @param string $html - contains html content
	 * @param float $rating
	 * @param int $count - total number of ratings
	 *
	 * @return string
	 */
	function oraiste_core_woo_product_get_rating_html( $html, $rating, $count ) {
		return qode_framework_is_installed( 'theme' ) ? oraiste_woo_product_get_rating_html( $html, $rating, $count ) : '';
	}
}

if ( ! function_exists( 'oraiste_core_woo_get_product_categories' ) ) {
	/**
	 * Function that render product categories
	 *
	 * @param string $before
	 * @param string $after
	 *
	 * @return string
	 */
	function oraiste_core_woo_get_product_categories( $before = '', $after = '' ) {
		return qode_framework_is_installed( 'theme' ) ? oraiste_woo_get_product_categories( $before, $after ) : '';
	}
}

if ( ! function_exists( 'oraiste_core_set_product_styles' ) ) {
	/**
	 * Function that generates module inline styles
	 *
	 * @param string $style
	 *
	 * @return string
	 */
	function oraiste_core_set_product_styles( $style ) {
		$scope = ORAISTE_CORE_OPTIONS_NAME;

		$price_styles        = oraiste_core_get_typography_styles( $scope, 'qodef_product_price' );
		$price_single_styles = oraiste_core_get_typography_styles( $scope, 'qodef_product_single_price' );

		if ( ! empty( $price_styles ) ) {
			$style .= qode_framework_dynamic_style(
				array(
					'#qodef-woo-page .price',
					'.qodef-woo-shortcode .price',
				),
				$price_styles
			);
		}

		if ( ! empty( $price_single_styles ) ) {
			$style .= qode_framework_dynamic_style(
				array(
					'#qodef-woo-page.qodef--single .entry-summary .price',
				),
				$price_single_styles
			);
		}

		$price_discount_styles        = array();
		$price_discount_color         = oraiste_core_get_option_value( 'admin', 'qodef_product_price_discount_color' );
		$price_single_discount_styles = array();
		$price_single_discount_color  = oraiste_core_get_option_value( 'admin', 'qodef_product_single_price_discount_color' );

		if ( ! empty( $price_discount_color ) ) {
			$price_discount_styles['color'] = $price_discount_color;
		}

		if ( ! empty( $price_single_discount_color ) ) {
			$price_single_discount_styles['color'] = $price_single_discount_color;
		}

		if ( ! empty( $price_discount_styles ) ) {
			$style .= qode_framework_dynamic_style(
				array(
					'#qodef-woo-page .price del',
					'.qodef-woo-shortcode .price del',
				),
				$price_discount_styles
			);
		}

		if ( ! empty( $price_single_discount_styles ) ) {
			$style .= qode_framework_dynamic_style(
				array(
					'#qodef-woo-page.qodef--single .entry-summary .price del',
				),
				$price_single_discount_styles
			);
		}

		$label_styles      = oraiste_core_get_typography_styles( $scope, 'qodef_product_label' );
		$info_styles       = oraiste_core_get_typography_styles( $scope, 'qodef_product_info' );
		$info_hover_styles = oraiste_core_get_typography_hover_styles( $scope, 'qodef_product_info' );

		if ( ! empty( $label_styles ) ) {
			$style .= qode_framework_dynamic_style(
				array(
					'#qodef-woo-page.qodef--single .product_meta .qodef-woo-meta-label',
				),
				$label_styles
			);
		}

		if ( ! empty( $info_styles ) ) {
			$style .= qode_framework_dynamic_style(
				array(
					'#qodef-woo-page.qodef--single .product_meta .qodef-woo-meta-value',
					'#qodef-woo-page.qodef--single .shop_attributes th',
					'#qodef-woo-page.qodef--single .woocommerce-Reviews .woocommerce-review__author',
				),
				$info_styles
			);
		}

		if ( ! empty( $info_hover_styles ) ) {
			$style .= qode_framework_dynamic_style(
				array(
					'#qodef-woo-page.qodef--single .product_meta .qodef-woo-meta-value a:hover',
				),
				$info_hover_styles
			);
		}

		return $style;
	}

	add_filter( 'oraiste_filter_add_inline_style', 'oraiste_core_set_product_styles' );
}
