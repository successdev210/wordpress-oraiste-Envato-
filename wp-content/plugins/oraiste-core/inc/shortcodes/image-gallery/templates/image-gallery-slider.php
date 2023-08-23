<div <?php qode_framework_class_attribute( $holder_classes ); ?> <?php qode_framework_inline_attr( $slider_attr, 'data-options' ); ?> <?php qode_framework_inline_style( $holder_styles ); ?>>
	<div class="swiper-wrapper">
		<?php
		// Include items
		if ( ! empty( $images ) ) {
			foreach ( $images as $image ) {
				oraiste_core_template_part( 'shortcodes/image-gallery', 'templates/parts/image', '', array_merge( $params, $image ) );
			}
		}
		?>
	</div>
	<?php oraiste_core_template_part( 'content', 'templates/swiper-nav', '', $params ); ?>
	<?php oraiste_core_template_part( 'content', 'templates/swiper-pag', '', $params ); ?>
</div>
