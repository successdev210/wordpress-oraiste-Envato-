<?php if ( ! empty( $text ) ): ?>
	<?php $text = explode( ' ', $text ); ?>
	<?php
	$item_classes[] = 'qodef-e-text';
	$item_classes[] = ( 'yes' === $highlight ) ? 'qodef--highlight' : '';

	$item_classes = implode( ' ', $item_classes );
	?>
	<?php foreach ( $text as $text_fragment ): ?>
		<span <?php qode_framework_class_attribute( $item_classes ); ?>>
			<?php echo esc_html( $text_fragment ); ?>
			<?php if ( 'yes' === $highlight ): ?>
				<?php echo oraiste_core_get_svg_icon( 'ripped-lines', 'qodef-border-lines-1' ); ?>
			<?php endif; ?>
		</span>
	<?php endforeach; ?>
<?php endif; ?>
