<div <?php qode_framework_class_attribute( $holder_classes ); ?>>
	<span class="qodef-m-letter" <?php qode_framework_inline_style( $letter_styles ); ?>><?php echo esc_html( $letter ); ?></span>
	<?php if ( ! empty( $text ) ) { ?>
		<p class="qodef-m-text" <?php qode_framework_inline_style( $text_styles ); ?>><?php echo esc_html( $text ); ?></p>
	<?php } ?>
</div>
