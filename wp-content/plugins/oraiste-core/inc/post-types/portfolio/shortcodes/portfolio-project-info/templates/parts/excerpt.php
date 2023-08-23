<?php

if ( post_password_required() ) {
	echo get_the_password_form(); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped
} else {
	$excerpt = get_the_excerpt();

	if ( ! empty( $excerpt ) ) {
		?>
		<p itemprop="description" class="qodef-e-excerpt"><?php echo wp_kses_post( strip_shortcodes( $excerpt ) ); ?></p>
	<?php }
} ?>
