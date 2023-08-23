<?php

if ( ! function_exists( 'oraiste_core_add_standard_mobile_header_meta' ) ) {
	/**
	 * Function that add additional mobile header layout meta box options
	 *
	 * @param object $page
	 */
	function oraiste_core_add_standard_mobile_header_meta( $page ) {

		$section = $page->add_section_element(
			array(
				'name'       => 'qodef_standard_mobile_header_section',
				'title'      => esc_html__( 'Standard Mobile Header', 'oraiste-core' ),
				'dependency' => array(
					'show' => array(
						'qodef_mobile_header_layout' => array(
							'values'        => 'standard',
							'default_value' => '',
						),
					),
				),
			)
		);

		$section->add_field_element(
			array(
				'field_type'  => 'color',
				'name'        => 'qodef_standard_mobile_header_background_color',
				'title'       => esc_html__( 'Header Background Color', 'oraiste-core' ),
				'description' => esc_html__( 'Enter header background color', 'oraiste-core' ),
			)
		);
	}

	add_action( 'oraiste_core_action_after_page_mobile_header_meta_map', 'oraiste_core_add_standard_mobile_header_meta' );
}
