<?php
$custom_icon    = oraiste_core_get_custom_svg_opener_icon_html( 'back_to_top' );
$holder_classes = array();
if ( empty( $custom_icon ) ) {
	$holder_classes[] = 'qodef--predefined';
}
?>
<a id="qodef-back-to-top" href="#" <?php qode_framework_class_attribute( $holder_classes ); ?>>
	<span class="qodef-back-to-top-icon">
		<?php
		if ( ! empty( $custom_icon ) ) {
			echo oraiste_core_get_custom_svg_opener_icon_html( 'back_to_top' );
		} else {
			oraiste_core_render_svg_icon( 'back-to-top' );
		}
		?>
	</span>
</a>
