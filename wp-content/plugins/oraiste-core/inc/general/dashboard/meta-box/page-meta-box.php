<?php

if ( ! function_exists( 'oraiste_core_add_general_page_meta_box' ) ) {
	/**
	 * Function that add general meta box options for this module
	 *
	 * @param object $page
	 */
	function oraiste_core_add_general_page_meta_box( $page ) {

		$general_tab = $page->add_tab_element(
			array(
				'name'        => 'tab-page',
				'icon'        => 'fa fa-cog',
				'title'       => esc_html__( 'Page Settings', 'oraiste-core' ),
				'description' => esc_html__( 'General page layout settings', 'oraiste-core' ),
			)
		);

		$general_tab->add_field_element(
			array(
				'field_type'  => 'select',
				'name'        => 'qodef_page_font_skin',
				'title'       => esc_html__( 'Font Skin', 'oraiste-core' ),
				'description' => esc_html__( 'Set font skin', 'oraiste-core' ),
				'options'     => array(
					''          => esc_html__( 'Default', 'oraiste-core' ),
					'cormorant' => esc_html__( 'Cormorant', 'oraiste-core' ),
					'italiana'  => esc_html__( 'Italiana', 'oraiste-core' ),
					'saira'     => esc_html__( 'Saira', 'oraiste-core' ),
					'prompt'    => esc_html__( 'Prompt', 'oraiste-core' ),
				),
			)
		);

		$general_tab->add_field_element(
			array(
				'field_type'  => 'select',
				'name'        => 'qodef_page_color_skin',
				'title'       => esc_html__( 'Color Skin', 'oraiste-core' ),
				'description' => esc_html__( 'Set color skin', 'oraiste-core' ),
				'options'     => array(
					''       => esc_html__( 'Default', 'oraiste-core' ),
					'light'  => esc_html__( 'Light', 'oraiste-core' ),
					'beige'  => esc_html__( 'Beige', 'oraiste-core' ),
					'dark'   => esc_html__( 'Dark', 'oraiste-core' ),
					'orange' => esc_html__( 'Orange', 'oraiste-core' ),
				),
			)
		);

		$general_tab->add_field_element(
			array(
				'field_type'  => 'color',
				'name'        => 'qodef_page_background_color',
				'title'       => esc_html__( 'Page Background Color', 'oraiste-core' ),
				'description' => esc_html__( 'Set background color', 'oraiste-core' ),
			)
		);

		$general_tab->add_field_element(
			array(
				'field_type'  => 'image',
				'name'        => 'qodef_page_background_image',
				'title'       => esc_html__( 'Page Background Image', 'oraiste-core' ),
				'description' => esc_html__( 'Set background image', 'oraiste-core' ),
			)
		);

		$general_tab->add_field_element(
			array(
				'field_type'  => 'select',
				'name'        => 'qodef_page_background_repeat',
				'title'       => esc_html__( 'Page Background Image Repeat', 'oraiste-core' ),
				'description' => esc_html__( 'Set background image repeat', 'oraiste-core' ),
				'options'     => array(
					''          => esc_html__( 'Default', 'oraiste-core' ),
					'no-repeat' => esc_html__( 'No Repeat', 'oraiste-core' ),
					'repeat'    => esc_html__( 'Repeat', 'oraiste-core' ),
					'repeat-x'  => esc_html__( 'Repeat-x', 'oraiste-core' ),
					'repeat-y'  => esc_html__( 'Repeat-y', 'oraiste-core' ),
				),
			)
		);

		$general_tab->add_field_element(
			array(
				'field_type'  => 'select',
				'name'        => 'qodef_page_background_size',
				'title'       => esc_html__( 'Page Background Image Size', 'oraiste-core' ),
				'description' => esc_html__( 'Set background image size', 'oraiste-core' ),
				'options'     => array(
					''        => esc_html__( 'Default', 'oraiste-core' ),
					'contain' => esc_html__( 'Contain', 'oraiste-core' ),
					'cover'   => esc_html__( 'Cover', 'oraiste-core' ),
				),
			)
		);

		$general_tab->add_field_element(
			array(
				'field_type'  => 'select',
				'name'        => 'qodef_page_background_attachment',
				'title'       => esc_html__( 'Page Background Image Attachment', 'oraiste-core' ),
				'description' => esc_html__( 'Set background image attachment', 'oraiste-core' ),
				'options'     => array(
					''       => esc_html__( 'Default', 'oraiste-core' ),
					'fixed'  => esc_html__( 'Fixed', 'oraiste-core' ),
					'scroll' => esc_html__( 'Scroll', 'oraiste-core' ),
				),
			)
		);

		$general_tab->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_page_content_padding',
				'title'       => esc_html__( 'Page Content Padding', 'oraiste-core' ),
				'description' => esc_html__( 'Set padding that will be applied for page content in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'oraiste-core' ),
			)
		);

		$general_tab->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_page_content_padding_mobile',
				'title'       => esc_html__( 'Page Content Padding Mobile', 'oraiste-core' ),
				'description' => esc_html__( 'Set padding that will be applied for page content on mobile screens (1024px and below) in format: top right bottom left (e.g. 10px 5px 10px 5px)', 'oraiste-core' ),
			)
		);

		$general_tab->add_field_element(
			array(
				'field_type'    => 'select',
				'name'          => 'qodef_boxed',
				'title'         => esc_html__( 'Boxed Layout', 'oraiste-core' ),
				'description'   => esc_html__( 'Set boxed layout', 'oraiste-core' ),
				'default_value' => '',
				'options'       => oraiste_core_get_select_type_options_pool( 'yes_no' ),
			)
		);

		$boxed_section = $general_tab->add_section_element(
			array(
				'name'       => 'qodef_boxed_section',
				'title'      => esc_html__( 'Boxed Layout Section', 'oraiste-core' ),
				'dependency' => array(
					'hide' => array(
						'qodef_boxed' => array(
							'values'        => 'no',
							'default_value' => '',
						),
					),
				),
			)
		);

		$boxed_section->add_field_element(
			array(
				'field_type'  => 'color',
				'name'        => 'qodef_boxed_background_color',
				'title'       => esc_html__( 'Boxed Background Color', 'oraiste-core' ),
				'description' => esc_html__( 'Set boxed background color', 'oraiste-core' ),
			)
		);

		$boxed_section->add_field_element(
			array(
				'field_type'  => 'image',
				'name'        => 'qodef_boxed_background_pattern',
				'title'       => esc_html__( 'Boxed Background Pattern', 'oraiste-core' ),
				'description' => esc_html__( 'Set boxed background pattern', 'oraiste-core' ),
			)
		);

		$boxed_section->add_field_element(
			array(
				'field_type'  => 'select',
				'name'        => 'qodef_boxed_background_pattern_behavior',
				'title'       => esc_html__( 'Boxed Background Pattern Behavior', 'oraiste-core' ),
				'description' => esc_html__( 'Set boxed background pattern behavior', 'oraiste-core' ),
				'options'     => array(
					''       => esc_html__( 'Default', 'oraiste-core' ),
					'fixed'  => esc_html__( 'Fixed', 'oraiste-core' ),
					'scroll' => esc_html__( 'Scroll', 'oraiste-core' ),
				),
			)
		);

		$general_tab->add_field_element(
			array(
				'field_type'    => 'select',
				'name'          => 'qodef_passepartout',
				'title'         => esc_html__( 'Passepartout', 'oraiste-core' ),
				'description'   => esc_html__( 'Enabling this option will display a passepartout around website content', 'oraiste-core' ),
				'default_value' => '',
				'options'       => oraiste_core_get_select_type_options_pool( 'yes_no' ),
			)
		);

		$passepartout_section = $general_tab->add_section_element(
			array(
				'name'       => 'qodef_passepartout_section',
				'dependency' => array(
					'hide' => array(
						'qodef_passepartout' => array(
							'values'        => 'no',
							'default_value' => '',
						),
					),
				),
			)
		);

		$passepartout_section->add_field_element(
			array(
				'field_type'  => 'color',
				'name'        => 'qodef_passepartout_color',
				'title'       => esc_html__( 'Passepartout Color', 'oraiste-core' ),
				'description' => esc_html__( 'Choose background color for passepartout', 'oraiste-core' ),
			)
		);

		$passepartout_section->add_field_element(
			array(
				'field_type'  => 'image',
				'name'        => 'qodef_passepartout_image',
				'title'       => esc_html__( 'Passepartout Background Image', 'oraiste-core' ),
				'description' => esc_html__( 'Set background image for passepartout', 'oraiste-core' ),
			)
		);

		$passepartout_section->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_passepartout_size',
				'title'       => esc_html__( 'Passepartout Size', 'oraiste-core' ),
				'description' => esc_html__( 'Enter size amount for passepartout', 'oraiste-core' ),
				'args'        => array(
					'suffix' => esc_html__( 'px or %', 'oraiste-core' ),
				),
			)
		);

		$passepartout_section->add_field_element(
			array(
				'field_type'  => 'text',
				'name'        => 'qodef_passepartout_size_responsive',
				'title'       => esc_html__( 'Passepartout Responsive Size', 'oraiste-core' ),
				'description' => esc_html__( 'Enter size amount for passepartout for smaller screens (1024px and below)', 'oraiste-core' ),
				'args'        => array(
					'suffix' => esc_html__( 'px or %', 'oraiste-core' ),
				),
			)
		);

		$general_tab->add_field_element(
			array(
				'field_type'  => 'select',
				'name'        => 'qodef_content_width',
				'title'       => esc_html__( 'Initial Width of Content', 'oraiste-core' ),
				'description' => esc_html__( 'Choose the initial width of content which is in grid (applies to pages set to "Default Template" and rows set to "In Grid")', 'oraiste-core' ),
				'options'     => oraiste_core_get_select_type_options_pool( 'content_width' ),
			)
		);

		$general_tab->add_field_element(
			array(
				'field_type'    => 'yesno',
				'default_value' => 'no',
				'name'          => 'qodef_content_behind_header',
				'title'         => esc_html__( 'Always put content behind header', 'oraiste-core' ),
				'description'   => esc_html__( 'Enabling this option will put page content behind page header', 'oraiste-core' ),
			)
		);

		$general_tab->add_field_element(
			array(
				'field_type'    => 'yesno',
				'default_value' => 'no',
				'name'          => 'qodef_content_behind_header_mobile',
				'title'         => esc_html__( 'Always put content behind header on mobile devices', 'oraiste-core' ),
				'description'   => esc_html__( 'Enabling this option will put page content behind page header on mobile devices', 'oraiste-core' ),
			)
		);

		// Hook to include additional options after module options
		do_action( 'oraiste_core_action_after_general_page_meta_box_map', $general_tab );
	}

	add_action( 'oraiste_core_action_after_general_meta_box_map', 'oraiste_core_add_general_page_meta_box', 9 );
}

if ( ! function_exists( 'oraiste_core_add_general_page_meta_box_callback' ) ) {
	/**
	 * Function that set current meta box callback as general callback functions
	 *
	 * @param array $callbacks
	 *
	 * @return array
	 */
	function oraiste_core_add_general_page_meta_box_callback( $callbacks ) {
		$callbacks['page'] = 'oraiste_core_add_general_page_meta_box';

		return $callbacks;
	}

	add_filter( 'oraiste_core_filter_general_meta_box_callbacks', 'oraiste_core_add_general_page_meta_box_callback' );
}
