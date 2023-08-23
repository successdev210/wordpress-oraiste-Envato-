<?php $portfolio_list_video = get_post_meta( $portfolio_item, 'qodef_portfolio_list_video', true ); ?>

<?php if ( ! empty( $portfolio_list_video ) ) : ?>
	<div class="qodef-e-list-media">
		<a itemprop="url" href="<?php echo esc_url( get_permalink( $portfolio_item ) ); ?>">
			<video autoplay="autoplay" loop="loop" muted="muted" playsinline>
				<source src="<?php echo wp_get_attachment_url( $portfolio_list_video ); ?>" type="video/mp4">
			</video>
		</a>
	</div>
<?php endif; ?>
