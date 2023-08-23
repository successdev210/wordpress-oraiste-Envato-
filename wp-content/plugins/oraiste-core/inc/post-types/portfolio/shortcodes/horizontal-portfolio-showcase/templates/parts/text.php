<?php

$text_tag = isset( $text_tag ) && ! empty( $text_tag ) ? $text_tag : 'h1';

if ( ! empty( $text ) && isset( $text ) ) {
	?>
	<div class="qodef-m-text qodef-m-item">
		<<?php echo esc_attr( $text_tag ); ?> class="qodef-text-holder">
			<?php echo qode_framework_wp_kses_html( 'html', $text ); ?>
		</<?php echo esc_attr( $text_tag ); ?>>
	</div>
	<?php
}
