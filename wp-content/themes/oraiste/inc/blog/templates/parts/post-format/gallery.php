<?php
$gallery_meta = get_post_meta( get_the_ID(), 'qodef_post_format_gallery_images', true );

if ( ! empty( $gallery_meta ) ) { ?>
	<div class="qodef-e-media-gallery qodef-swiper-container">
		<div class="swiper-wrapper">
			<?php
			$gallery_images = explode( ',', $gallery_meta );

			foreach ( $gallery_images as $image_id ) {
				?>
				<div class="qodef-e-media-gallery-item swiper-slide">
					<?php if ( ! is_single() ) { ?>
						<a itemprop="url" href="<?php the_permalink(); ?>">
					<?php } ?>
						<?php echo wp_get_attachment_image( $image_id, 'full' ); ?>
					<?php if ( ! is_single() ) { ?>
						</a>
					<?php } ?>
				</div>
			<?php } ?>
		</div>
		<div class="swiper-button-prev"><?php oraiste_render_svg_icon( 'navigation-arrow-left' ); ?></div>
		<div class="swiper-button-next"><?php oraiste_render_svg_icon( 'navigation-arrow-right' ); ?></div>
	</div>
<?php } else {
	// Include featured image
	oraiste_template_part( 'blog', 'templates/parts/post-info/image' );
} ?>
