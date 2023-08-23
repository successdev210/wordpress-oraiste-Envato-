<?php if ( 'no' !== $slider_navigation ) {
	$nav_next_classes = '';
	$nav_prev_classes = '';

	if ( isset( $unique ) && ! empty( $unique ) ) {
		$nav_next_classes = 'swiper-button-outside swiper-button-next-' . esc_attr( $unique );
		$nav_prev_classes = 'swiper-button-outside swiper-button-prev-' . esc_attr( $unique );
	}
	?>
	<div class="swiper-button-prev <?php echo esc_attr( $nav_prev_classes ); ?>"><?php oraiste_core_render_svg_icon( 'navigation-arrow-left' ); ?></div>
	<div class="swiper-button-next <?php echo esc_attr( $nav_next_classes ); ?>"><?php oraiste_core_render_svg_icon( 'navigation-arrow-right' ); ?></div>
<?php } ?>
