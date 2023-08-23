<?php
/**
 * The template for displaying product widget entries.
 *
 * This template can be overridden by copying it to yourtheme/woocommerce/content-widget-product.php.
 * HOWEVER, on occasion WooCommerce will need to update template files and you
 * (the theme developer) will need to copy the new files to your theme to
 * maintain compatibility. We try to do this as little as possible, but it does
 * happen. When this occurs the version of the template file will be bumped and
 * the readme will list any important changes.
 *
 * @see     https://docs.woocommerce.com/document/template-structure/
 * @package WooCommerce/Templates
 * @version 3.5.5
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

global $product;

if ( ! is_a( $product, 'WC_Product' ) ) {
	return;
}

?>
<li>
	<?php do_action( 'woocommerce_widget_product_item_start', $args ); ?>
	
	<div class="qodef-woo-product-image">
		<a href="<?php echo esc_url( $product->get_permalink() ); ?>">
			<?php echo oraiste_wp_kses_html( 'img', $product->get_image() ); // PHPCS:Ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		</a>
	</div>
	<div class="qodef-woo-product-content">
		<h6 class="qodef-woo-product-title">
			<a itemprop="url" href="<?php echo esc_url( $product->get_permalink() ); ?>"><?php echo oraiste_wp_kses_html( 'content', $product->get_name() ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?></a>
		</h6>
		<?php if ( ! empty( $show_rating ) ) : ?>
			<?php echo wc_get_rating_html( $product->get_average_rating() ); // PHPCS:Ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		<?php endif; ?>
		<div class="qodef-woo-product-price price">
			<?php echo oraiste_wp_kses_html( 'html', $product->get_price_html() ); // PHPCS:Ignore WordPress.Security.EscapeOutput.OutputNotEscaped ?>
		</div>
	</div>

	<?php do_action( 'woocommerce_widget_product_item_end', $args ); ?>
</li>
