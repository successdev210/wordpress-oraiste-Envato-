<?php

if ( post_password_required() ) {
	echo get_the_password_form(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
} else {
	$excerpt = get_the_excerpt();

	if ( ! empty( $excerpt ) ) {
		$excerpt_length = oraiste_get_search_page_excerpt_length();
		$new_excerpt    = ( $excerpt_length > 0 ) ? substr( $excerpt, 0, intval( $excerpt_length ) ) : $excerpt;
		?>
		<p itemprop="description" class="qodef-e-excerpt">
			<?php echo esc_html( strip_tags( strip_shortcodes( $new_excerpt ) ) ); ?>
		</p>
	<?php }
} ?>
