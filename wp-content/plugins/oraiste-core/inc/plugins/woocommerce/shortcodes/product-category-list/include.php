<?php

include_once ORAISTE_CORE_PLUGINS_PATH . '/woocommerce/shortcodes/product-category-list/media-custom-fields.php';
include_once ORAISTE_CORE_PLUGINS_PATH . '/woocommerce/shortcodes/product-category-list/class-oraistecore-product-category-list-shortcode.php';

foreach ( glob( ORAISTE_CORE_PLUGINS_PATH . '/woocommerce/shortcodes/product-category-list/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
