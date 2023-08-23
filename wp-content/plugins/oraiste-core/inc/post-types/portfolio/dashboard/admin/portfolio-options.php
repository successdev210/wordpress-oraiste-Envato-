<?php

if ( ! function_exists( 'oraiste_core_add_portfolio_options' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function oraiste_core_add_portfolio_options() {
		$qode_framework = qode_framework_get_framework_root();

		$page = $qode_framework->add_options_page(
			array(
				'scope'       => ORAISTE_CORE_OPTIONS_NAME,
				'type'        => 'admin',
				'slug'        => 'portfolio-item',
				'layout'      => 'tabbed',
				'icon'        => 'fa fa-cog',
				'title'       => esc_html__( 'Portfolio', 'oraiste-core' ),
				'description' => esc_html__( 'Global settings related to portfolio', 'oraiste-core' ),
			)
		);

		if ( $page ) {
			$archive_tab = $page->add_tab_element(
				array(
					'name'        => 'tab-archive',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'Portfolio List', 'oraiste-core' ),
					'description' => esc_html__( 'Settings related to portfolio archive pages', 'oraiste-core' ),
				)
			);

			// Hook to include additional options after archive module options
			do_action( 'oraiste_core_action_after_portfolio_options_archive', $archive_tab );

			$single_tab = $page->add_tab_element(
				array(
					'name'        => 'tab-single',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'Portfolio Single', 'oraiste-core' ),
					'description' => esc_html__( 'Settings related to portfolio single pages', 'oraiste-core' ),
				)
			);
			$single_tab->add_field_element(
				array(
					'field_type'    => 'select',
					'name'          => 'qodef_portfolio_single_layout',
					'title'         => esc_html__( 'Single Layout', 'oraiste-core' ),
					'description'   => esc_html__( 'Choose default layout for portfolio single', 'oraiste-core' ),
					'default_value' => apply_filters( 'oraiste_core_filter_portfolio_single_layout_default_value', '' ),
					'options'       => apply_filters( 'oraiste_core_filter_portfolio_single_layout_options', array() ),
				)
			);

			$single_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_portfolio_single_title_tag',
					'title'       => esc_html__( 'Title Tag', 'oraiste-core' ),
					'description' => esc_html__( 'Choose title tag for portfolio item on portfolio single page', 'oraiste-core' ),
					'options'     => oraiste_core_get_select_type_options_pool( 'title_tag' ),
				)
			);

			$single_tab->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_portfolio_single_info_holder_margin_top',
					'title'      => esc_html__( 'Portfolio Info Margin Top', 'oraiste-core' ),
					'args'       => array(
						'suffix' => 'px',
					),
				)
			);

			// Hook to include additional options after single module options
			do_action( 'oraiste_core_action_after_portfolio_options_single', $single_tab );

			// Hook to include additional options after module options
			do_action( 'oraiste_core_action_after_portfolio_options_map', $page );
		}
	}

	add_action( 'oraiste_core_action_default_options_init', 'oraiste_core_add_portfolio_options', oraiste_core_get_admin_options_map_position( 'portfolio' ) );
}
