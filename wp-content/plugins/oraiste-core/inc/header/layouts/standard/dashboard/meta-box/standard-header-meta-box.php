<?php

if ( ! function_exists( 'oraiste_core_add_standard_header_meta' ) ) {
	/**
	 * Function that add additional header layout meta box options
	 *
	 * @param object $page
	 */
	function oraiste_core_add_standard_header_meta( $page ) {
		$section = $page->add_section_element(
			array(
				'name'       => 'qodef_standard_header_section',
				'title'      => esc_html__( 'Standard Header', 'oraiste-core' ),
				'dependency' => array(
					'show' => array(
						'qodef_header_layout' => array(
							'values'        => array( '', 'standard' ),
							'default_value' => '',
						),
					),
				),
			)
		);

		$section->add_field_element(
			array(
				'field_type'    => 'select',
				'name'          => 'qodef_standard_header_in_grid',
				'title'         => esc_html__( 'Content in Grid', 'oraiste-core' ),
				'description'   => esc_html__( 'Set content to be in grid', 'oraiste-core' ),
				'default_value' => '',
				'options'       => oraiste_core_get_select_type_options_pool( 'no_yes' ),
			)
		);

		$section->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_standard_header_height',
				'title'       => esc_html__( 'Header Height', 'oraiste-core' ),
				'description' => esc_html__( 'Enter header height', 'oraiste-core' ),
				'args'        => array(
					'suffix' => esc_html__( 'px', 'oraiste-core' ),
				),
			)
		);

		$section->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_standard_header_side_padding',
				'title'       => esc_html__( 'Header Side Padding', 'oraiste-core' ),
				'description' => esc_html__( 'Enter side padding for header area', 'oraiste-core' ),
				'args'        => array(
					'suffix' => esc_html__( 'px or %', 'oraiste-core' ),
				),
			)
		);

		$section->add_field_element(
			array(
				'field_type'  => 'color',
				'name'        => 'qodef_standard_header_background_color',
				'title'       => esc_html__( 'Header Background Color', 'oraiste-core' ),
				'description' => esc_html__( 'Enter header background color', 'oraiste-core' ),
			)
		);

		$section->add_field_element(
			array(
				'field_type'  => 'color',
				'name'        => 'qodef_standard_header_border_color',
				'title'       => esc_html__( 'Header Border Color', 'oraiste-core' ),
				'description' => esc_html__( 'Enter header border color', 'oraiste-core' ),
			)
		);

		$section->add_field_element(
			array(
				'field_type'    => 'select',
				'name'          => 'qodef_standard_header_menu_position',
				'title'         => esc_html__( 'Menu position', 'oraiste-core' ),
				'default_value' => '',
				'options'       => array(
					''       => esc_html__( 'Default', 'oraiste-core' ),
					'left'   => esc_html__( 'Left', 'oraiste-core' ),
					'center' => esc_html__( 'Center', 'oraiste-core' ),
					'right'  => esc_html__( 'Right', 'oraiste-core' ),
				),
			)
		);
	}

	add_action( 'oraiste_core_action_after_page_header_meta_map', 'oraiste_core_add_standard_header_meta' );
}
