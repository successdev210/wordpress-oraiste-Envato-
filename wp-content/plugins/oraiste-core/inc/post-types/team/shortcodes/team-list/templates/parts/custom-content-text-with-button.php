<?php

$title_tag = isset( $info_on_hover_custom_content_text_with_button_title_tag_option ) && ! empty( $info_on_hover_custom_content_text_with_button_title_tag_option ) ? $info_on_hover_custom_content_text_with_button_title_tag_option : 'h2';
$styles    = array();
if ( ! empty( $info_on_hover_custom_content_margin_top ) ) {
	$margin_top = qode_framework_string_ends_with_space_units( $info_on_hover_custom_content_margin_top ) ? $info_on_hover_custom_content_margin_top : intval( $info_on_hover_custom_content_margin_top ) . 'px';
	$styles[]   = 'margin-top:' . $margin_top;
}

if ( ! empty( $info_on_hover_custom_content_text_with_button_title_option ) || ! empty( $info_on_hover_custom_content_text_with_button_button_text_option ) || ! empty( $info_on_hover_custom_content_text_with_button_text_option ) ) { ?>
	<div class="qodef-e-custom-content-item qodef-e-custom-text-with-button qodef-grid-item">
		<div class="qodef-e-inner" <?php qode_framework_inline_style( $styles ); ?>>
			<?php if ( ! empty( $info_on_hover_custom_content_text_with_button_title_option ) ) { ?>
				<<?php echo esc_attr( $title_tag ); ?> class="qodef-e-title">
					<?php echo esc_html( $info_on_hover_custom_content_text_with_button_title_option ); ?>
				</<?php echo esc_attr( $title_tag ); ?>>
			<?php } ?>
			<?php if ( ! empty( $info_on_hover_custom_content_text_with_button_text_option ) ) { ?>
				<p class="qodef-e-text"><?php echo esc_html( $info_on_hover_custom_content_text_with_button_text_option ); ?></p>
			<?php } ?>
			<?php
			if ( ! empty( $info_on_hover_custom_content_text_with_button_button_link_option ) || ! empty( $info_on_hover_custom_content_text_with_button_button_text_option ) && class_exists( 'OraisteCore_Button_Shortcode' ) ) {
				$button_params = array(
					'link'          => $info_on_hover_custom_content_text_with_button_button_link_option,
					'target'        => $info_on_hover_custom_content_text_with_button_button_target_option,
					'text'          => ! empty( $info_on_hover_custom_content_text_with_button_button_text_option ) ? $info_on_hover_custom_content_text_with_button_button_text_option : esc_html__( 'Join Us', 'oraiste-core' ),
					'button_layout' => 'textual-animated',
				);

				echo OraisteCore_Button_Shortcode::call_shortcode( $button_params );
				?>
			<?php } ?>
		</div>
	</div>
<?php } ?>
