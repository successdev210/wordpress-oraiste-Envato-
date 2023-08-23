<?php

include_once ORAISTE_CORE_PLUGINS_PATH . '/woocommerce/shortcodes/product-list/class-oraistecore-product-list-shortcode.php';

foreach ( glob( ORAISTE_CORE_PLUGINS_PATH . '/woocommerce/shortcodes/product-list/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
