<?php

if ( ! function_exists( 'oraiste_core_nav_menu_meta_options' ) ) {
	/**
	 * Function that add general options for this module
	 *
	 * @param object $page
	 */
	function oraiste_core_nav_menu_meta_options( $page ) {

		if ( $page ) {

			$section = $page->add_section_element(
				array(
					'name'  => 'qodef_nav_menu_section',
					'title' => esc_html__( 'Main Menu', 'oraiste-core' ),
				)
			);

			$section->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_dropdown_top_position',
					'title'       => esc_html__( 'Dropdown Position', 'oraiste-core' ),
					'description' => esc_html__( 'Enter value in percentage of entire header height', 'oraiste-core' ),
				)
			);
		}
	}

	add_action( 'oraiste_core_action_after_page_header_meta_map', 'oraiste_core_nav_menu_meta_options' );
}
