<div class="qodef-woo-dropdown-items">
	<?php
	foreach ( WC()->cart->get_cart() as $cart_item_key => $cart_item ) {
		$_product   = apply_filters( 'woocommerce_cart_item_product', $cart_item['data'], $cart_item, $cart_item_key );
		$product_id = apply_filters( 'woocommerce_cart_item_product_id', $cart_item['product_id'], $cart_item, $cart_item_key );

		if ( $_product && $_product->exists() && $cart_item['quantity'] > 0 && apply_filters( 'woocommerce_cart_item_visible', true, $cart_item, $cart_item_key ) ) {
			$product_permalink = apply_filters( 'woocommerce_cart_item_permalink', $_product->is_visible() ? $_product->get_permalink( $cart_item ) : '', $cart_item, $cart_item_key );
			?>
			<div class="qodef-woo-dropdown-item qodef-e">
				<div class="qodef-e-image">
					<?php
					$thumbnail = apply_filters( 'woocommerce_cart_item_thumbnail', $_product->get_image(), $cart_item, $cart_item_key );

					if ( ! $product_permalink ) {
						echo qode_framework_wp_kses_html( 'img', $thumbnail );
					} else {
						printf( '<a href="%s">%s</a>', esc_url( $product_permalink ), qode_framework_wp_kses_html( 'img', $thumbnail ) );
					}
					?>
				</div>
				<div class="qodef-e-content">
					<h6 itemprop="name" class="qodef-e-title entry-title">
						<?php
						if ( ! $product_permalink ) {
							echo qode_framework_wp_kses_html( 'content', apply_filters( 'woocommerce_cart_item_name', $_product->get_name(), $cart_item, $cart_item_key ) . '&nbsp;' );
						} else {
							echo qode_framework_wp_kses_html( 'content', apply_filters( 'woocommerce_cart_item_name', sprintf( '<a href="%s">%s</a>', esc_url( $product_permalink ), $_product->get_name() ), $cart_item, $cart_item_key ) );
						}
						?>
					</h6>
					<p class="qodef-e-price-quantity">
						<?php echo esc_html( $cart_item['quantity'] ); ?>x<?php echo apply_filters( 'woocommerce_cart_item_price', WC()->cart->get_product_price( $_product ), $cart_item, $cart_item_key ); ?>
					</p>
					<?php echo sprintf( '<a href="%s" class="qodef-e-remove remove" title="%s"></a>', esc_url( wc_get_cart_remove_url( $cart_item_key ) ), esc_attr__( 'Remove this item', 'oraiste-core' ) ); ?>
				</div>
			</div>
			<?php
		}
	}
	?>
</div>
