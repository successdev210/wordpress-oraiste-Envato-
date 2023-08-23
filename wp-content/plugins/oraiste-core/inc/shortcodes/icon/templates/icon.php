<span <?php qode_framework_class_attribute( $holder_classes ); ?> <?php qode_framework_inline_attrs( $data_attrs ); ?> <?php qode_framework_inline_style( $styles ); ?>>
	<?php if ( ! empty( $link ) ) : ?>
		<a itemprop="url" href="<?php echo esc_url( $link ); ?>" target="<?php echo esc_attr( $target ); ?>">
	<?php endif; ?>
		<?php echo qode_framework_icons()->get_shortcode_icon_fields_value( 'main_icon', $params, $icon_params ); ?>
	<?php if ( ! empty( $link ) ) : ?>
		</a>
	<?php endif; ?>
</span>
