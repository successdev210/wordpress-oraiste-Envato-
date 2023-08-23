<?php

if ( isset( $media ) && ! empty( $media ) ) {
	$images = explode( ',', $media );

	foreach ( $images as $image ) {
		if ( isset( $image ) && ! empty( $image ) ) {
			$image_title = get_the_title( $image );
			$image_src   = wp_get_attachment_image_src( $image, 'full' );
			?>
			<div class="swiper-slide" itemprop="image" data-type="image" title="<?php echo esc_attr( $image_title ); ?>">
				<?php echo wp_get_attachment_image( $image, 'full' ); ?>
			</div>
			<?php
		}
	}
}
