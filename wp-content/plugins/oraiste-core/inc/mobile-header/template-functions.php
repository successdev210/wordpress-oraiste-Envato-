<?php

if ( ! function_exists( 'oraiste_core_get_mobile_header_logo_image' ) ) {
	/**
	 * Function that return logo image html for current module
	 *
	 * @return string that contains html content
	 */
	function oraiste_core_get_mobile_header_logo_image() {
		$page_skin       = oraiste_core_get_post_value_through_levels( 'qodef_page_skin' );
		$logo_height_mobile        = oraiste_core_get_post_value_through_levels( 'qodef_mobile_logo_height' );
		$logo_height               = ! empty( $logo_height_mobile ) ? $logo_height_mobile : oraiste_core_get_post_value_through_levels( 'qodef_logo_height' );
		$mobile_logo_main_image_id = oraiste_core_get_post_value_through_levels( 'qodef_mobile_logo_light' );
		$logo_main_image_id        = ! empty( $mobile_logo_main_image_id ) ? $mobile_logo_main_image_id : oraiste_core_get_post_value_through_levels( 'qodef_logo_light' );
		$customizer_logo           = oraiste_core_get_customizer_logo();

		$parameters = array(
			'logo_height'     => ! empty( $logo_height ) ? 'height:' . intval( $logo_height ) . 'px' : '',
			'logo_main_image' => '',
		);

		$available_logos = array(
			'light',
			'beige',
			'dark',
			'orange',
		);

		foreach ( $available_logos as $logo ) {
			$parameters['mobile_logo_' . $logo . '_image'] = '';

			$logo_image_id = oraiste_core_get_post_value_through_levels( 'qodef_mobile_logo_' . $logo );

			if ( empty( $logo_image_id ) && ! empty( $page_skin ) ) {
				$logo_image_id = oraiste_core_get_post_value_through_levels( 'qodef_mobile_logo_light' );
			}

			if ( ! empty( $logo_image_id ) ) {
				$logo_image_attr = array(
					'class'    => 'qodef-header-logo-image qodef--' . $logo,
					'itemprop' => 'image',
					'alt'      => sprintf( esc_attr__( 'logo %s', 'oraiste-core' ), $logo ),
				);

				$image      = wp_get_attachment_image( $logo_image_id, 'full', false, $logo_image_attr );
				$image_html = ! empty( $image ) ? $image : qode_framework_get_image_html_from_src( $logo_image_id, $logo_image_attr );

				$parameters['mobile_logo_' . $logo . '_image'] = $image_html;
			}
		}

		// if ( ! empty( $logo_main_image_id ) ) {
		// 	$logo_main_image_attr = array(
		// 		'class'    => 'qodef-header-logo-image qodef--light',
		// 		'itemprop' => 'image',
		// 		'alt'      => esc_attr__( 'logo main', 'oraiste-core' ),
		// 	);
		//
		// 	$image      = wp_get_attachment_image( $logo_main_image_id, 'full', false, $logo_main_image_attr );
		// 	$image_html = ! empty( $image ) ? $image : qode_framework_get_image_html_from_src( $logo_main_image_id, $logo_main_image_attr );
		//
		// 	$parameters['logo_main_image'] = $image_html;
		// }

		if ( ! empty( $logo_main_image_id ) ) {
			oraiste_core_template_part( 'mobile-header/templates', 'parts/mobile-logo', '', $parameters );
		} elseif ( ! empty( $customizer_logo ) ) {
			echo qode_framework_wp_kses_html( 'html', $customizer_logo );
		}
	}
}
