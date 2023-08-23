<div <?php qode_framework_class_attribute( $holder_classes ); ?>>
	<div class="qodef-m-image-inner-holder">
		<?php oraiste_core_template_part( 'shortcodes/image-with-text', 'templates/parts/image', '', $params ); ?>
		<?php if ( 'scrolling-image' === $params['image_action'] ) : ?>
			<img class="qodef-m-iwt-frame" src="<?php echo esc_url( ORAISTE_CORE_SHORTCODES_URL_PATH . '/image-with-text/assets/img/scrolling-image-frame.png' ); ?>" alt="<?php esc_html_e( 'Scrolling Image Frame', 'oraiste-core' ); ?>" />
		<?php endif; ?>
	</div>
	<div class="qodef-m-content">
		<?php oraiste_core_template_part( 'shortcodes/image-with-text', 'templates/parts/title', '', $params ); ?>
		<?php oraiste_core_template_part( 'shortcodes/image-with-text', 'templates/parts/text', '', $params ); ?>
	</div>
</div>
