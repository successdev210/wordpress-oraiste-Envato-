<?php

$categories = oraiste_core_woo_get_product_categories();

if ( ! empty( $categories ) ) { ?>
	<div class="qodef-woo-product-categories"><?php echo wp_kses_post( $categories ); ?></div>
<?php } ?>
