<?php
if ( isset( $media ) && ! empty( $media ) ) {
	$image_title     = get_the_title( $media );
	$image_src       = wp_get_attachment_image_src( $media, 'full' );
	$image_size_meta = oraiste_core_get_custom_image_size_meta( 'attachment', 'qodef_image_portfolio_masonry_size', $media );
	?>
	<a itemprop="image" class="qodef-popup-item qodef-grid-item <?php echo esc_attr( $image_size_meta['class'] ); ?>" href="<?php echo esc_url( $image_src[0] ); ?>" data-type="image" title="<?php echo esc_attr( $image_title ); ?>">
		<?php echo wp_get_attachment_image( $media, $image_size_meta['size'] ); ?>
	</a>
<?php } ?>
