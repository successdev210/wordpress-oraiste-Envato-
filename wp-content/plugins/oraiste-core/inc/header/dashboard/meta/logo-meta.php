<?php

if ( ! function_exists( 'oraiste_core_add_page_logo_meta_box' ) ) {
	/**
	 * Function that add general meta box options for this module
	 *
	 * @param object $page
	 */
	function oraiste_core_add_page_logo_meta_box( $page ) {

		if ( $page ) {

			$logo_tab = $page->add_tab_element(
				array(
					'name'        => 'tab-logo',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'Logo Settings', 'oraiste-core' ),
					'description' => esc_html__( 'Logo settings', 'oraiste-core' ),
				)
			);

			$header_logo_section = $logo_tab->add_section_element(
				array(
					'name'  => 'qodef_header_logo_section',
					'title' => esc_html__( 'Header Logo Options', 'oraiste-core' ),
				)
			);

			$header_logo_section->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_logo_height',
					'title'       => esc_html__( 'Logo Height', 'oraiste-core' ),
					'description' => esc_html__( 'Enter logo height', 'oraiste-core' ),
					'args'        => array(
						'suffix' => esc_html__( 'px', 'oraiste-core' ),
					),
				)
			);

			$header_logo_section->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_logo_light',
					'title'       => esc_html__( 'Logo - Light', 'oraiste-core' ),
					'description' => esc_html__( 'Choose light skin logo image', 'oraiste-core' ),
					'multiple'    => 'no',
				)
			);

			$header_logo_section->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_logo_beige',
					'title'       => esc_html__( 'Logo - Beige', 'oraiste-core' ),
					'description' => esc_html__( 'Choose beige skin logo image', 'oraiste-core' ),
					'multiple'    => 'no',
				)
			);

			$header_logo_section->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_logo_dark',
					'title'       => esc_html__( 'Logo - Dark', 'oraiste-core' ),
					'description' => esc_html__( 'Choose dark skin logo image', 'oraiste-core' ),
					'multiple'    => 'no',
				)
			);

			$header_logo_section->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_logo_orange',
					'title'       => esc_html__( 'Logo - Orange', 'oraiste-core' ),
					'description' => esc_html__( 'Choose orange skin logo image', 'oraiste-core' ),
					'multiple'    => 'no',
				)
			);

			// Hook to include additional options after module options
			do_action( 'oraiste_core_action_after_page_logo_meta_map', $logo_tab, $header_logo_section );
		}
	}

	add_action( 'oraiste_core_action_after_general_meta_box_map', 'oraiste_core_add_page_logo_meta_box' );
}

if ( ! function_exists( 'oraiste_core_add_general_logo_meta_box_callback' ) ) {
	/**
	 * Function that set current meta box callback as general callback functions
	 *
	 * @param array $callbacks
	 *
	 * @return array
	 */
	function oraiste_core_add_general_logo_meta_box_callback( $callbacks ) {
		$callbacks['logo'] = 'oraiste_core_add_page_logo_meta_box';

		return $callbacks;
	}

	add_filter( 'oraiste_core_filter_general_meta_box_callbacks', 'oraiste_core_add_general_logo_meta_box_callback' );
}
