<?php if ( ! empty( $portfolio_item ) ) : ?>
	<?php if ( has_post_thumbnail( $portfolio_item ) ) : ?>
		<div class="qodef-e-featured-image">
			<a itemprop="url" href="<?php echo esc_url( get_permalink( $portfolio_item ) ); ?>">
				<?php echo wp_kses_post( get_the_post_thumbnail( $portfolio_item, 'oraiste_core_image_size_square' ) ); ?>
			</a>
		</div>
	<?php endif; ?>
<?php endif; ?>
