<div <?php qode_framework_class_attribute( $holder_classes ); ?>>
	<?php if ( ! empty( $text ) ) : ?>
		<div class="qodef-m-text">
			<h1><?php echo qode_framework_wp_kses_html( 'html', $text ); ?></h1>
		</div>
		<div class="qodef-m-scroll-indicator q-m-morph-idle">
			<?php echo esc_html__( 'Scroll', 'oraiste-core' ); ?>
			<?php oraiste_render_svg_icon( 'animated-button-circle' ); ?>
		</div>
	<?php endif; ?>
	<div class="qodef-m-items-holder">
		<?php
		// Include items
		oraiste_core_template_part( 'post-types/portfolio/shortcodes/horizontal-portfolio-list', 'templates/loop', '', $params );
		?>
	</div>
</div>
