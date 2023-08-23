<?php

if ( ! function_exists( 'oraiste_core_add_page_spinner_options' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function oraiste_core_add_page_spinner_options( $page ) {

		if ( $page ) {
			$page->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_enable_page_spinner',
					'title'         => esc_html__( 'Enable Page Spinner', 'oraiste-core' ),
					'description'   => esc_html__( 'Enable Page Spinner Effect', 'oraiste-core' ),
					'default_value' => 'no',
				)
			);

			$spinner_section = $page->add_section_element(
				array(
					'name'       => 'qodef_page_spinner_section',
					'title'      => esc_html__( 'Page Spinner Section', 'oraiste-core' ),
					'dependency' => array(
						'show' => array(
							'qodef_enable_page_spinner' => array(
								'values'        => 'yes',
								'default_value' => 'no',
							),
						),
					),
				)
			);

			$spinner_section->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_page_spinner_type',
					'title'         => esc_html__( 'Select Page Spinner Type', 'oraiste-core' ),
					'description'   => esc_html__( 'Choose a page spinner animation style', 'oraiste-core' ),
					'options'       => apply_filters( 'oraiste_core_filter_page_spinner_layout_options', array() ),
					'default_value' => apply_filters( 'oraiste_core_filter_page_spinner_default_layout_option', '' ),
				)
			);

			$spinner_section->add_field_element(
				array(
					'field_type'  => 'color',
					'name'        => 'qodef_page_spinner_background_color',
					'title'       => esc_html__( 'Spinner Background Color', 'oraiste-core' ),
					'description' => esc_html__( 'Choose the spinner background color', 'oraiste-core' ),
				)
			);

			$spinner_section->add_field_element(
				array(
					'field_type'  => 'color',
					'name'        => 'qodef_page_spinner_color',
					'title'       => esc_html__( 'Spinner Color', 'oraiste-core' ),
					'description' => esc_html__( 'Choose the spinner color', 'oraiste-core' ),
				)
			);

			$spinner_section->add_field_element(
				array(
					'field_type'    => 'text',
					'name'          => 'qodef_page_spinner_text',
					'title'         => esc_html__( 'Spinner Text', 'oraiste-core' ),
					'description'   => esc_html__( 'Choose the spinner text', 'oraiste-core' ),
					'default_value' => 'LOADING...',
					'dependency'    => array(
						'show' => array(
							'qodef_page_spinner_type' => array(
								'values'        => 'textual',
								'default_value' => 'no'
							)
						)
					)

				)
			);

			$spinner_section->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_page_spinner_fade_out_animation',
					'title'         => esc_html__( 'Enable Fade Out Animation', 'oraiste-core' ),
					'description'   => esc_html__( 'Enabling this option will turn on fade out animation when leaving page', 'oraiste-core' ),
					'default_value' => 'no',
				)
			);
		}
	}

	add_action( 'oraiste_core_action_after_general_options_map', 'oraiste_core_add_page_spinner_options' );
}
