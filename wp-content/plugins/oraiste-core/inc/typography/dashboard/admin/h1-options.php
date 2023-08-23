<?php

if ( ! function_exists( 'oraiste_core_add_h1_typography_options' ) ) {
	/**
	 * Function that add general options for this module
	 *
	 * @param object $page
	 */
	function oraiste_core_add_h1_typography_options( $page ) {

		if ( $page ) {
			$h1_tab = $page->add_tab_element(
				array(
					'name'        => 'tab-h1',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'H1 Typography', 'oraiste-core' ),
					'description' => esc_html__( 'Set values for Heading 1 HTML element', 'oraiste-core' ),
				)
			);

			$h1_typography_section = $h1_tab->add_section_element(
				array(
					'name'  => 'qodef_h1_typography_section',
					'title' => esc_html__( 'General Typography', 'oraiste-core' ),
				)
			);

			$h1_typography_row = $h1_typography_section->add_row_element(
				array(
					'name' => 'qodef_h1_typography_row',
				)
			);

			$h1_typography_row->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_h1_color',
					'title'      => esc_html__( 'Color', 'oraiste-core' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$h1_typography_row->add_field_element(
				array(
					'field_type' => 'font',
					'name'       => 'qodef_h1_font_family',
					'title'      => esc_html__( 'Font Family', 'oraiste-core' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$h1_typography_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_h1_font_size',
					'title'      => esc_html__( 'Font Size', 'oraiste-core' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$h1_typography_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_h1_line_height',
					'title'      => esc_html__( 'Line Height', 'oraiste-core' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$h1_typography_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_h1_letter_spacing',
					'title'      => esc_html__( 'Letter Spacing', 'oraiste-core' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$h1_typography_row->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_h1_font_weight',
					'title'      => esc_html__( 'Font Weight', 'oraiste-core' ),
					'options'    => oraiste_core_get_select_type_options_pool( 'font_weight' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$h1_typography_row->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_h1_text_transform',
					'title'      => esc_html__( 'Text Transform', 'oraiste-core' ),
					'options'    => oraiste_core_get_select_type_options_pool( 'text_transform' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$h1_typography_row->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_h1_font_style',
					'title'      => esc_html__( 'Font Style', 'oraiste-core' ),
					'options'    => oraiste_core_get_select_type_options_pool( 'font_style' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$h1_typography_row->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_h1_text_decoration',
					'title'      => esc_html__( 'Text Decoration', 'oraiste-core' ),
					'options'    => oraiste_core_get_select_type_options_pool( 'text_decoration' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$h1_typography_row->add_field_element(
				array(
					'field_type' => 'color',
					'name'       => 'qodef_h1_link_hover_color',
					'title'      => esc_html__( 'Link Hover Color', 'oraiste-core' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$h1_typography_row->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_h1_link_hover_text_decoration',
					'title'      => esc_html__( 'Link Hover Text Decoration', 'oraiste-core' ),
					'options'    => oraiste_core_get_select_type_options_pool( 'text_decoration' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$h1_typography_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_h1_margin_top',
					'title'      => esc_html__( 'Margin Top', 'oraiste-core' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			$h1_typography_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_h1_margin_bottom',
					'title'      => esc_html__( 'Margin Bottom', 'oraiste-core' ),
					'args'       => array(
						'col_width' => 3,
					),
				)
			);

			/* 1366 styles */
			$h1_1366_typography_section = $h1_tab->add_section_element(
				array(
					'name'  => 'qodef_responsive_1366_typography_h1',
					'title' => esc_html__( 'Responsive 1366 Typography', 'oraiste-core' ),
				)
			);

			$responsive_1366_typography_h1_row = $h1_1366_typography_section->add_row_element(
				array(
					'name' => 'qodef_responsive_1366_h1_typography_row',
				)
			);

			$responsive_1366_typography_h1_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_h1_responsive_1366_font_size',
					'title'      => esc_html__( 'Font Size', 'oraiste-core' ),
					'args'       => array(
						'col_width' => 4,
					),
				)
			);

			$responsive_1366_typography_h1_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_h1_responsive_1366_line_height',
					'title'      => esc_html__( 'Line Height', 'oraiste-core' ),
					'args'       => array(
						'col_width' => 4,
					),
				)
			);

			$responsive_1366_typography_h1_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_h1_responsive_1366_letter_spacing',
					'title'      => esc_html__( 'Letter Spacing', 'oraiste-core' ),
					'args'       => array(
						'col_width' => 4,
					),
				)
			);

			/* 1024 styles */
			$h1_1024_typography_section = $h1_tab->add_section_element(
				array(
					'name'  => 'qodef_responsive_1024_typography_h1',
					'title' => esc_html__( 'Responsive 1024 Typography', 'oraiste-core' ),
				)
			);

			$responsive_1024_typography_h1_row = $h1_1024_typography_section->add_row_element(
				array(
					'name' => 'qodef_responsive_1024_h1_typography_row',
				)
			);

			$responsive_1024_typography_h1_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_h1_responsive_1024_font_size',
					'title'      => esc_html__( 'Font Size', 'oraiste-core' ),
					'args'       => array(
						'col_width' => 4,
					),
				)
			);

			$responsive_1024_typography_h1_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_h1_responsive_1024_line_height',
					'title'      => esc_html__( 'Line Height', 'oraiste-core' ),
					'args'       => array(
						'col_width' => 4,
					),
				)
			);

			$responsive_1024_typography_h1_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_h1_responsive_1024_letter_spacing',
					'title'      => esc_html__( 'Letter Spacing', 'oraiste-core' ),
					'args'       => array(
						'col_width' => 4,
					),
				)
			);

			/* 768 styles */
			$h1_768_typography_section = $h1_tab->add_section_element(
				array(
					'name'  => 'qodef_responsive_768_typography_h1',
					'title' => esc_html__( 'Responsive 768 Typography', 'oraiste-core' ),
				)
			);

			$responsive_768_typography_h1_row = $h1_768_typography_section->add_row_element(
				array(
					'name' => 'qodef_responsive_768_h1_typography_row',
				)
			);

			$responsive_768_typography_h1_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_h1_responsive_768_font_size',
					'title'      => esc_html__( 'Font Size', 'oraiste-core' ),
					'args'       => array(
						'col_width' => 4,
					),
				)
			);

			$responsive_768_typography_h1_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_h1_responsive_768_line_height',
					'title'      => esc_html__( 'Line Height', 'oraiste-core' ),
					'args'       => array(
						'col_width' => 4,
					),
				)
			);

			$responsive_768_typography_h1_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_h1_responsive_768_letter_spacing',
					'title'      => esc_html__( 'Letter Spacing', 'oraiste-core' ),
					'args'       => array(
						'col_width' => 4,
					),
				)
			);

			/* 680 styles */
			$h1_680_typography_section = $h1_tab->add_section_element(
				array(
					'name'  => 'qodef_responsive_680_typography_h1',
					'title' => esc_html__( 'Responsive 680 Typography', 'oraiste-core' ),
				)
			);

			$responsive_680_typography_h1_row = $h1_680_typography_section->add_row_element(
				array(
					'name' => 'qodef_responsive_680_h1_typography_row',
				)
			);

			$responsive_680_typography_h1_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_h1_responsive_680_font_size',
					'title'      => esc_html__( 'Font Size', 'oraiste-core' ),
					'args'       => array(
						'col_width' => 4,
					),
				)
			);

			$responsive_680_typography_h1_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_h1_responsive_680_line_height',
					'title'      => esc_html__( 'Line Height', 'oraiste-core' ),
					'args'       => array(
						'col_width' => 4,
					),
				)
			);

			$responsive_680_typography_h1_row->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_h1_responsive_680_letter_spacing',
					'title'      => esc_html__( 'Letter Spacing', 'oraiste-core' ),
					'args'       => array(
						'col_width' => 4,
					),
				)
			);
		}
	}

	add_action( 'oraiste_core_action_after_typography_options_map', 'oraiste_core_add_h1_typography_options' );
}
