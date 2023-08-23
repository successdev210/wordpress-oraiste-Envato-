<?php $portfolio_list_image = get_post_meta( $portfolio_item, 'qodef_portfolio_list_image', true ); ?>
<?php if ( ! empty( $portfolio_list_image ) ) : ?>
	<div class="qodef-e-list-media">
		<a itemprop="url" href="<?php echo esc_url( get_permalink( $portfolio_item ) ); ?>">
			<?php echo wp_get_attachment_image( $portfolio_list_image, 'oraiste_core_image_size_square' ); ?>
		</a>
	</div>
<?php endif; ?>
