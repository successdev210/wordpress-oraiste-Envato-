<?php

$title_tag = isset( $info_on_hover_custom_content_text_title_tag_option ) && ! empty( $info_on_hover_custom_content_text_title_tag_option ) ? $info_on_hover_custom_content_text_title_tag_option : 'h2';
$styles    = array();
if ( ! empty( $info_on_hover_custom_content_margin_top ) ) {
	$margin_top = qode_framework_string_ends_with_space_units( $info_on_hover_custom_content_margin_top ) ? $info_on_hover_custom_content_margin_top : intval( $info_on_hover_custom_content_margin_top ) . 'px';
	$styles[]   = 'margin-top:' . $margin_top;
}
?>

<?php if ( ! empty( $info_on_hover_custom_content_text_title_option ) || ! empty( $info_on_hover_custom_content_text_text_option ) ) : ?>
	<div class="qodef-e-custom-content-item qodef-e-custom-text qodef-grid-item">
		<div class="qodef-e-inner" <?php qode_framework_inline_style( $styles ); ?>>
			<?php if ( ! empty( $info_on_hover_custom_content_text_link_option ) ) : ?>
				<a itemprop="url" class="qodef-e-link" href="<?php echo esc_url( $info_on_hover_custom_content_text_link_option ); ?>" target="<?php echo esc_attr( $info_on_hover_custom_content_text_link_target_option ); ?>"></a>
			<?php endif; ?>
			<?php if ( ! empty( $info_on_hover_custom_content_text_title_option ) ) : ?>
				<?php echo '<' . esc_attr( $title_tag ); ?> class="qodef-e-title">
				<?php echo esc_html( $info_on_hover_custom_content_text_title_option ); ?>
				<?php echo '</' . esc_attr( $title_tag ); ?>>
			<?php endif; ?>
			<?php if ( ! empty( $info_on_hover_custom_content_text_text_option ) ) : ?>
				<p class="qodef-e-text"><?php echo esc_html( $info_on_hover_custom_content_text_text_option ); ?></p>
			<?php endif; ?>
		</div>
	</div>
<?php endif; ?>
