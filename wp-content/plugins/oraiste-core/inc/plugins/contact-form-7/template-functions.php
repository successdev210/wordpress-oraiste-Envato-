<?php

if ( ! function_exists( 'oraiste_core_cf7_add_submit_form_tag' ) ) {
	/**
	 * Function that override default submit buttom html tag
	 */
	function oraiste_core_cf7_add_submit_form_tag() {
		wpcf7_add_form_tag( 'submit', 'oraiste_core_cf7_submit_form_tag_handler' );
	}
}

if ( ! function_exists( 'oraiste_core_cf7_submit_form_tag_handler' ) ) {
	/**
	 * Function that override default submit buttom html tag
	 *
	 * @param array $tag
	 *
	 * @return string
	 */
	function oraiste_core_cf7_submit_form_tag_handler( $tag ) {
		$tag   = new WPCF7_FormTag( $tag );
		$class = wpcf7_form_controls_class( $tag->type );

		$atts             = array();
		$atts['class']    = $tag->get_class_option( $class );
		$atts['class']    .= ' qodef-button qodef-layout--textual qodef-html--link';
		$atts['id']       = $tag->get_id_option();
		$atts['tabindex'] = $tag->get_option( 'tabindex', 'int', true );

		$value = isset( $tag->values[0] ) ? $tag->values[0] : '';
		if ( empty( $value ) ) {
			$value = esc_html__( 'Send', 'oraiste-core' );
		}

		$atts['type'] = 'submit';
		$atts         = wpcf7_format_atts( $atts );

		$html = sprintf( '<button %1$s><span class="qodef-m-text">%2$s</span><span class="qodef-m-arrow">' . oraiste_core_get_svg_icon( 'button-arrow' ) . '</span></button>', $atts, $value );

		return $html;
	}
}
