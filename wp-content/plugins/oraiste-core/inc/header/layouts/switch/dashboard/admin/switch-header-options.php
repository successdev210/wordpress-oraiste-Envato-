<?php

if ( ! function_exists( 'oraiste_core_add_switch_header_options' ) ) {
	/**
	 * Function that add additional header layout options
	 *
	 * @param object $page
	 * @param array  $general_header_tab
	 */
	function oraiste_core_add_switch_header_options( $page, $general_header_tab ) {

		$section = $general_header_tab->add_section_element(
			array(
				'name'        => 'qodef_switch_header_section',
				'title'       => esc_html__( 'Switch Header', 'oraiste-core' ),
				'description' => esc_html__( 'Switch header settings', 'oraiste-core' ),
				'dependency'  => array(
					'show' => array(
						'qodef_header_layout' => array(
							'values'        => 'switch',
							'default_value' => '',
						),
					),
				),
			)
		);

		$section->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_switch_header_height',
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
				'name'        => 'qodef_switch_header_side_padding',
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
				'name'        => 'qodef_switch_header_background_color',
				'title'       => esc_html__( 'Header Background Color', 'oraiste-core' ),
				'description' => esc_html__( 'Enter header background color', 'oraiste-core' ),
			)
		);

		$section->add_field_element(
			array(
				'field_type'    => 'yesno',
				'name'          => 'qodef_switch_header_enable_border',
				'title'         => esc_html__( 'Enable Header Border', 'oraiste-core' ),
				'default_value' => 'yes',
			)
		);

		$section->add_field_element(
			array(
				'field_type'  => 'color',
				'name'        => 'qodef_switch_header_border_color',
				'title'       => esc_html__( 'Header Border Color', 'oraiste-core' ),
				'description' => esc_html__( 'Enter header border color', 'oraiste-core' ),
				'dependency'  => array(
					'show' => array(
						'qodef_switch_header_enable_border' => array(
							'values'        => array( 'yes' ),
							'default_value' => 'yes',
						),
					),
				),
			)
		);
	}

	add_action( 'oraiste_core_action_after_header_options_map', 'oraiste_core_add_switch_header_options', 10, 2 );
}
