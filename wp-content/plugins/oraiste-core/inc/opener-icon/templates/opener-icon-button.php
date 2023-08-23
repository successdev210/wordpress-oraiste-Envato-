<button type="submit" <?php echo ! empty( $custom_id ) ? 'id="' . esc_attr( $custom_id ) . '"' : ''; ?> class="qodef-opener-icon qodef-m <?php echo oraiste_core_get_opener_icon_class( $option_name, $custom_class ); ?>" <?php qode_framework_inline_style( $inline_style ); ?> <?php echo ! empty( $inline_attr ) ? $inline_attr : ''; ?>>
	<?php
	echo oraiste_core_get_opener_icon_html_content( $option_name, $set_icon_as_close, $custom_icon );
	if ( $custom_html ) {
		echo wp_kses_post( $custom_html );
	}
	?>
</button>
