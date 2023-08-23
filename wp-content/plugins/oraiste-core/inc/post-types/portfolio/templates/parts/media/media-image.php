<?php
if ( isset( $media ) && ! empty( $media ) ) {
	$image_title = get_the_title( $media );
	$image_src   = wp_get_attachment_image_src( $media, 'full' );
	?>
	<a itemprop="image" class="qodef-popup-item qodef-grid-item" href="<?php echo esc_url( $image_src[0] ); ?>" data-type="image" title="<?php echo esc_attr( $image_title ); ?>">
		<?php echo wp_get_attachment_image( $media, 'full' ); ?>
	</a>
<?php } ?>
