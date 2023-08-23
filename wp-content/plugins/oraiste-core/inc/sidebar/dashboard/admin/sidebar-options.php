<?php

if ( ! function_exists( 'oraiste_core_add_page_sidebar_options' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function oraiste_core_add_page_sidebar_options() {
		$qode_framework = qode_framework_get_framework_root();

		$page = $qode_framework->add_options_page(
			array(
				'scope'       => ORAISTE_CORE_OPTIONS_NAME,
				'type'        => 'admin',
				'slug'        => 'sidebar',
				'icon'        => 'fa fa-book',
				'title'       => esc_html__( 'Sidebar', 'oraiste-core' ),
				'description' => esc_html__( 'Global Sidebar Options', 'oraiste-core' ),
			)
		);

		if ( $page ) {
			$page->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_page_sidebar_layout',
					'title'         => esc_html__( 'Sidebar Layout', 'oraiste-core' ),
					'description'   => esc_html__( 'Choose a default sidebar layout for pages', 'oraiste-core' ),
					'options'       => oraiste_core_get_select_type_options_pool( 'sidebar_layouts', false ),
					'default_value' => 'no-sidebar',
				)
			);

			$custom_sidebars = oraiste_core_get_custom_sidebars();
			if ( ! empty( $custom_sidebars ) && count( $custom_sidebars ) > 1 ) {
				$page->add_field_element(
					array(
						'field_type'  => 'select',
						'name'        => 'qodef_page_custom_sidebar',
						'title'       => esc_html__( 'Custom Sidebar', 'oraiste-core' ),
						'description' => esc_html__( 'Choose a custom sidebar to display on pages', 'oraiste-core' ),
						'options'     => $custom_sidebars,
					)
				);
			}

			$page->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_page_sidebar_grid_gutter',
					'title'       => esc_html__( 'Set Grid Gutter', 'oraiste-core' ),
					'description' => esc_html__( 'Choose grid gutter size to set space between content and sidebar', 'oraiste-core' ),
					'options'     => oraiste_core_get_select_type_options_pool( 'items_space' ),
				)
			);

			$page->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_page_sidebar_widgets_margin_bottom',
					'title'       => esc_html__( 'Widgets Margin Bottom', 'oraiste-core' ),
					'description' => esc_html__( 'Set space value between widgets', 'oraiste-core' ),
				)
			);

			// Hook to include additional options after module options
			do_action( 'oraiste_core_action_after_page_sidebar_options_map', $page );
		}
	}

	add_action( 'oraiste_core_action_default_options_init', 'oraiste_core_add_page_sidebar_options', oraiste_core_get_admin_options_map_position( 'sidebar' ) );
}
