<?php
if ( ! function_exists( 'oraiste_core_add_top_area_meta_options' ) ) {
	/**
	 * Function that add additional header layout meta box options
	 *
	 * @param object $page
	 */
	function oraiste_core_add_top_area_meta_options( $page ) {
		$top_area_section = $page->add_section_element(
			array(
				'name'       => 'qodef_top_area_section',
				'title'      => esc_html__( 'Top Area', 'oraiste-core' ),
				'dependency' => array(
					'hide' => array(
						'qodef_header_layout' => array(
							'values'        => oraiste_core_dependency_for_top_area_options(),
							'default_value' => '',
						),
					),
				),
			)
		);

		$top_area_section->add_field_element(
			array(
				'field_type'  => 'select',
				'name'        => 'qodef_top_area_header',
				'title'       => esc_html__( 'Top Area', 'oraiste-core' ),
				'description' => esc_html__( 'Enable top area', 'oraiste-core' ),
				'options'     => oraiste_core_get_select_type_options_pool( 'yes_no' ),
			)
		);

		$top_area_options_section = $top_area_section->add_section_element(
			array(
				'name'        => 'qodef_top_area_options_section',
				'title'       => esc_html__( 'Top Area Options', 'oraiste-core' ),
				'description' => esc_html__( 'Set desired values for top area', 'oraiste-core' ),
				'dependency'  => array(
					'show' => array(
						'qodef_top_area_header' => array(
							'values'        => 'yes',
							'default_value' => 'no',
						),
					),
				),
			)
		);

		$top_area_options_section->add_field_element(
			array(
				'field_type'    => 'yesno',
				'name'          => 'qodef_top_area_header_in_grid',
				'title'         => esc_html__( 'Content in Grid', 'oraiste-core' ),
				'description'   => esc_html__( 'Set content to be in grid', 'oraiste-core' ),
				'default_value' => 'no',
			)
		);

		$top_area_options_section->add_field_element(
			array(
				'field_type'  => 'color',
				'name'        => 'qodef_top_area_header_background_color',
				'title'       => esc_html__( 'Top Area Background Color', 'oraiste-core' ),
				'description' => esc_html__( 'Choose top area background color', 'oraiste-core' ),
			)
		);

		$top_area_options_section->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_top_area_header_height',
				'title'       => esc_html__( 'Top Area Height', 'oraiste-core' ),
				'description' => esc_html__( 'Enter top area height (default is 30px)', 'oraiste-core' ),
				'args'        => array(
					'suffix' => esc_html__( 'px', 'oraiste-core' ),
				),
			)
		);

		$top_area_options_section->add_field_element(
			array(
				'field_type' => 'text',
				'name'       => 'qodef_top_area_header_side_padding',
				'title'      => esc_html__( 'Top Area Side Padding', 'oraiste-core' ),
				'args'       => array(
					'suffix' => esc_html__( 'px or %', 'oraiste-core' ),
				),
			)
		);
	}

	add_action( 'oraiste_core_action_after_page_header_meta_map', 'oraiste_core_add_top_area_meta_options', 20 );
}
