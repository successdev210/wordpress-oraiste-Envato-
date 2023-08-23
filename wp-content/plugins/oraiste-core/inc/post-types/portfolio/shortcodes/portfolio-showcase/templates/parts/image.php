<?php if ( ! empty( $portfolio_item ) ): ?>
	<?php if ( has_post_thumbnail( $portfolio_item ) ) : ?>
		<span class="qodef-e-image">
			<a itemprop="url" href="<?php echo esc_url( get_permalink( $portfolio_item ) ); ?>">
				<?php echo wp_kses_post( get_the_post_thumbnail( $portfolio_item, 'full', array( 'class' => 'qodef--main' ) ) ); ?>
				<?php $portfolio_list_image = get_post_meta( $portfolio_item, 'qodef_portfolio_list_image', true ); ?>
				<?php if ( ! empty( $portfolio_list_image ) ) : ?>
					<?php echo wp_get_attachment_image( $portfolio_list_image, 'full', false, array( 'class' => 'qodef--hover' ) ); ?>
				<?php endif; ?>
			</a>
		</span>
	<?php endif; ?>
<?php endif; ?>
