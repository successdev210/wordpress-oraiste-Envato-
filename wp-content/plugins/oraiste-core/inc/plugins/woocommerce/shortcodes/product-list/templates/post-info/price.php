<?php

$product = oraiste_core_woo_get_global_product();

if ( ! empty( $product ) ) {
	$price = $product->get_price_html();

	if ( ! empty( $price ) ) {
		?>
		<div class="qodef-woo-product-price price"><?php echo wp_kses_post( $price ); ?></div>
		<?php
	}
}
?>
