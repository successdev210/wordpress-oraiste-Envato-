<?php if ( isset( $media ) && ! empty( $media ) ) {
	$images = explode( ',', $media );

	foreach ( $images as $image ) {
		if ( isset( $image ) && ! empty( $image ) ) {
			$image_title     = get_the_title( $image );
			$image_src       = wp_get_attachment_image_src( $image, 'full' );
			$image_size_meta = oraiste_core_get_custom_image_size_meta( 'attachment', 'qodef_image_portfolio_masonry_size', $image );
			?>
			<a itemprop="image" class="qodef-popup-item qodef-grid-item <?php echo esc_attr( $image_size_meta['class'] ); ?>" href="<?php echo esc_url( $image_src[0] ); ?>" data-type="image" title="<?php echo esc_attr( $image_title ); ?>">
				<?php echo wp_get_attachment_image( $image, $image_size_meta['size'] ); ?>
			</a>
			<?php
		}
	}
}
