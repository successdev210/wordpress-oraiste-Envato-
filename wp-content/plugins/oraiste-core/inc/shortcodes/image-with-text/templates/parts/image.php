<div class="qodef-m-image">
	<?php if ( 'open-popup' === $image_action ) : ?>
		<a class="qodef-magnific-popup qodef-popup-item" itemprop="image" href="<?php echo esc_url( $image_params['url'] ); ?>" data-type="image" title="<?php echo esc_attr( $image_params['alt'] ); ?>">
	<?php elseif ( 'custom-link' === $image_action || 'scrolling-image' === $image_action && ! empty( $link ) ) : ?>
		<a itemprop="url" href="<?php echo esc_url( $link ); ?>" target="<?php echo esc_attr( $target ); ?>">
	<?php endif; ?>
			<?php
			if ( is_array( $image_params['image_size'] ) && count( $image_params['image_size'] ) ) {
				echo qode_framework_generate_thumbnail( $image_params['image_id'], $image_params['image_size'][0], $image_params['image_size'][1] );
			} else {
				add_filter( 'wp_calculate_image_srcset_meta', '__return_null' );
				echo wp_get_attachment_image( $image_params['image_id'], $image_params['image_size'] );
				remove_filter( 'wp_calculate_image_srcset_meta', '__return_null' );
			}
			?>
	<?php if ( 'open-popup' === $image_action || 'custom-link' === $image_action || 'scrolling-image' === $image_action ) : ?>
		</a>
	<?php endif; ?>
</div>
