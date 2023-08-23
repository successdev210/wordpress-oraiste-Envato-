<div class="<?php echo esc_attr( $item_classes ); ?>">
	<?php if ( 'open-popup' === $image_action ) { ?>
		<a class="qodef-popup-item" itemprop="image" href="<?php echo esc_url( $url ); ?>" data-type="image" title="<?php echo esc_attr( $alt ); ?>">
	<?php } elseif ( 'custom-link' === $image_action && ! empty( $url ) ) { ?>
		<a itemprop="url" href="<?php echo esc_url( $url ); ?>" target="<?php echo esc_attr( $target ); ?>">
	<?php } ?>
		<?php
		if ( is_array( $image_size ) && count( $image_size ) ) {
			echo qode_framework_generate_thumbnail( $image_id, $image_size[0], $image_size[1] );
		} else {
			echo wp_get_attachment_image( $image_id, $image_size );
		}
		?>
	<?php if ( 'open-popup' === $image_action || 'custom-link' === $image_action ) { ?>
		</a>
	<?php } ?>
</div>
