<?php

if ( ! function_exists( 'oraiste_core_add_scroll_appearance_header_options' ) ) {
	/**
	 * Function that add general options for this module
	 *
	 * @param object $page
	 */
	function oraiste_core_add_scroll_appearance_header_options( $page ) {

		if ( $page ) {
			$scroll_appearance_tab = $page->add_tab_element(
				array(
					'name'  => 'tab-header-scroll-appearance',
					'icon'  => 'fa fa-cog',
					'title' => esc_html__( 'Scroll Appearance Settings', 'oraiste-core' ),
				)
			);

			$section = $scroll_appearance_tab->add_section_element(
				array(
					'name'       => 'qodef_header_scroll_appearance_section',
					'title'      => esc_html__( 'Scroll Appearance Section', 'oraiste-core' ),
					'dependency' => array(
						'hide' => array(
							'qodef_header_layout' => array(
								'values'        => oraiste_core_dependency_for_scroll_appearance_options(),
								'default_value' => apply_filters( 'oraiste_core_filter_header_layout_default_option_value', '' ),
							),
						),
					),
				)
			);

			$section->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_header_scroll_appearance',
					'title'         => esc_html__( 'Header Scroll Appearance', 'oraiste-core' ),
					'description'   => esc_html__( 'Choose how header will act on scroll', 'oraiste-core' ),
					'options'       => apply_filters( 'oraiste_core_filter_header_scroll_appearance_option', array( 'none' => esc_html__( 'None', 'oraiste-core' ) ) ),
					'default_value' => 'none',
				)
			);

			// Hook to include additional options after module options
			do_action( 'oraiste_core_action_after_header_scroll_appearance_options_map', $page, $section );
		}
	}

	add_action( 'oraiste_core_action_after_header_options_map', 'oraiste_core_add_scroll_appearance_header_options', 15 );
}
