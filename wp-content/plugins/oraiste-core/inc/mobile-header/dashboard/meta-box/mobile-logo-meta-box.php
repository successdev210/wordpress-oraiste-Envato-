<?php

if ( ! function_exists( 'oraiste_core_add_page_mobile_logo_meta_box' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function oraiste_core_add_page_mobile_logo_meta_box( $logo_tab ) {

		if ( $logo_tab ) {

			$mobile_header_logo_section = $logo_tab->add_section_element(
				array(
					'name'  => 'qodef_mobile_header_logo_section',
					'title' => esc_html__( 'Mobile Header Logo Options', 'oraiste-core' ),
				)
			);

			$mobile_header_logo_section->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_mobile_logo_height',
					'title'       => esc_html__( 'Mobile Logo Height', 'oraiste-core' ),
					'description' => esc_html__( 'Enter mobile logo height', 'oraiste-core' ),
					'args'        => array(
						'suffix' => esc_html__( 'px', 'oraiste-core' ),
					),
				)
			);

			$mobile_header_logo_section->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_mobile_logo_light',
					'title'       => esc_html__( 'Mobile Logo - Light', 'oraiste-core' ),
					'description' => esc_html__( 'Choose light skin mobile logo image', 'oraiste-core' ),
					'multiple'    => 'no',
				)
			);

			$mobile_header_logo_section->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_mobile_logo_beige',
					'title'       => esc_html__( 'Mobile Logo - Beige', 'oraiste-core' ),
					'description' => esc_html__( 'Choose beige skin mobile logo image', 'oraiste-core' ),
					'multiple'    => 'no',
				)
			);

			$mobile_header_logo_section->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_mobile_logo_dark',
					'title'       => esc_html__( 'Mobile Logo - Dark', 'oraiste-core' ),
					'description' => esc_html__( 'Choose dark skin mobile logo image', 'oraiste-core' ),
					'multiple'    => 'no',
				)
			);

			$mobile_header_logo_section->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_mobile_logo_orange',
					'title'       => esc_html__( 'Mobile Logo - Orange', 'oraiste-core' ),
					'description' => esc_html__( 'Choose orange skin mobile logo image', 'oraiste-core' ),
					'multiple'    => 'no',
				)
			);

			// Hook to include additional options after module options
			do_action( 'oraiste_core_action_after_page_mobile_logo_meta_map', $mobile_header_logo_section );
		}
	}

	add_action( 'oraiste_core_action_after_page_logo_meta_map', 'oraiste_core_add_page_mobile_logo_meta_box' );
}
