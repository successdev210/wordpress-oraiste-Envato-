<?php

$product = oraiste_core_woo_get_global_product();

if ( ! empty( $product ) && 'no' !== get_option( 'woocommerce_enable_review_rating' ) ) {
	$rating = $product->get_average_rating();

	if ( ! empty( $rating ) ) {
		echo oraiste_core_woo_product_get_rating_html( '', $rating, 0 );
	}
}
