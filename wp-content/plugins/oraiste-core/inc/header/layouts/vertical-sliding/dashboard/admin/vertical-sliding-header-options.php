<?php

if ( ! function_exists( 'oraiste_core_add_vertical_sliding_header_options' ) ) {
	/**
	 * Function that add additional header layout options
	 *
	 * @param object $page
	 * @param array $general_header_tab
	 */
	function oraiste_core_add_vertical_sliding_header_options( $page, $general_header_tab ) {

		$section = $general_header_tab->add_section_element(
			array(
				'name'       => 'qodef_vertical_sliding_header_section',
				'title'      => esc_html__( 'Vertical Sliding Header', 'oraiste-core' ),
				'dependency' => array(
					'show' => array(
						'qodef_header_layout' => array(
							'values'        => 'vertical-sliding',
							'default_value' => '',
						),
					),
				),
			)
		);

		$section->add_field_element(
			array(
				'field_type'  => 'color',
				'name'        => 'qodef_vertical_sliding_header_background_color',
				'title'       => esc_html__( 'Header Background Color', 'oraiste-core' ),
				'description' => esc_html__( 'Enter header background color', 'oraiste-core' ),
			)
		);

		$section->add_field_element(
			array(
				'field_type'    => 'select',
				'name'          => 'qodef_vertical_sliding_menu_icon_source',
				'title'         => esc_html__( 'Icon Source', 'oraiste-core' ),
				'options'       => oraiste_core_get_select_type_options_pool( 'icon_source', false ),
				'default_value' => 'predefined',
			)
		);

		$section->add_field_element(
			array(
				'field_type'    => 'select',
				'name'          => 'qodef_vertical_sliding_menu_icon_pack',
				'title'         => esc_html__( 'Icon Pack', 'oraiste-core' ),
				'options'       => qode_framework_icons()->get_icon_packs( array( 'linea-icons', 'dripicons', 'simple-line-icons' ) ),
				'default_value' => 'elegant-icons',
				'dependency'    => array(
					'show' => array(
						'qodef_vertical_sliding_menu_icon_source' => array(
							'values'        => 'icon_pack',
							'default_value' => 'predefined',
						),
					),
				),
			)
		);

		$section_svg_path = $general_header_tab->add_section_element(
			array(
				'title'      => esc_html__( 'SVG Path', 'oraiste-core' ),
				'name'       => 'qodef_vertical_sliding_menu_svg_path_section',
				'dependency' => array(
					'show' => array(
						'qodef_vertical_sliding_menu_icon_source' => array(
							'values'        => 'svg_path',
							'default_value' => 'predefined',
						),
					),
				),
			)
		);

		$section_svg_path->add_field_element(
			array(
				'field_type'  => 'textarea',
				'name'        => 'qodef_vertical_sliding_menu_icon_svg_path',
				'title'       => esc_html__( 'Full Screen Menu Open Icon SVG Path', 'oraiste-core' ),
				'description' => esc_html__( 'Enter your full screen menu open icon SVG path here. Please remove version and id attributes from your SVG path because of HTML validation', 'oraiste-core' ),
			)
		);

		$section_svg_path->add_field_element(
			array(
				'field_type'  => 'textarea',
				'name'        => 'qodef_vertical_sliding_menu_close_icon_svg_path',
				'title'       => esc_html__( 'Full Screen Menu Close Icon SVG Path', 'oraiste-core' ),
				'description' => esc_html__( 'Enter your full screen menu close icon SVG path here. Please remove version and id attributes from your SVG path because of HTML validation', 'oraiste-core' ),
			)
		);
	}

	add_action( 'oraiste_core_action_after_header_options_map', 'oraiste_core_add_vertical_sliding_header_options', 10, 2 );
}

if ( ! function_exists( 'oraiste_core_add_vertical_sliding_header_logo_options' ) ) {
	/**
	 * Function that add additional header logo options
	 *
	 * @param object $page
	 * @param array $header_tab
	 */
	function oraiste_core_add_vertical_sliding_header_logo_options( $page, $header_tab ) {

		if ( $header_tab ) {
			$header_tab->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_logo_vertical_sliding',
					'title'       => esc_html__( 'Logo - Vertical Sliding', 'oraiste-core' ),
					'description' => esc_html__( 'Choose vertical sliding area logo image', 'oraiste-core' ),
					'multiple'    => 'no',
				)
			);
		}
	}

	add_action( 'oraiste_core_action_after_header_logo_options_map', 'oraiste_core_add_vertical_sliding_header_logo_options', 10, 2 );
}
