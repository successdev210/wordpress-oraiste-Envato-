<header id="qodef-page-mobile-header">
	<?php
	// Hook to include additional content before page mobile header inner
	do_action( 'oraiste_action_before_page_mobile_header_inner' );
	?>
	<div id="qodef-page-mobile-header-inner" <?php oraiste_class_attribute( apply_filters( 'oraiste_filter_mobile_header_inner_class', array(), 'mobile' ) ); ?>>
		<?php
		// Include module content template
		echo apply_filters( 'oraiste_filter_mobile_header_content_template', oraiste_get_template_part( 'mobile-header', 'templates/mobile-header-content' ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
		?>
	</div>
	<?php
	// Hook to include additional content after page mobile header inner
	do_action( 'oraiste_action_after_page_mobile_header_inner' );
	?>
</header>
