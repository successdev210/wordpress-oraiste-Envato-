<a itemprop="url" class="qodef-m-opener" href="<?php echo esc_url( wc_get_cart_url() ); ?>">
	<span class="qodef-m-opener-text"><?php esc_html_e( 'Cart', 'oraiste-core' ); ?></span>
	<span class="qodef-m-opener-count">(<?php echo WC()->cart->cart_contents_count; ?>)</span>
</a>
