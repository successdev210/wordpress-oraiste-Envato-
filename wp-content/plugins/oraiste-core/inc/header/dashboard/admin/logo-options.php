<?php

if ( ! function_exists( 'oraiste_core_add_logo_options' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function oraiste_core_add_logo_options() {
		$qode_framework = qode_framework_get_framework_root();

		$page = $qode_framework->add_options_page(
			array(
				'scope'       => ORAISTE_CORE_OPTIONS_NAME,
				'type'        => 'admin',
				'slug'        => 'logo',
				'icon'        => 'fa fa-cog',
				'title'       => esc_html__( 'Logo', 'oraiste-core' ),
				'description' => esc_html__( 'Global Logo Options', 'oraiste-core' ),
				'layout'      => 'tabbed',
			)
		);

		if ( $page ) {

			$header_tab = $page->add_tab_element(
				array(
					'name'        => 'tab-header',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'Header Logo Options', 'oraiste-core' ),
					'description' => esc_html__( 'Set options for initial headers', 'oraiste-core' ),
				)
			);

			$header_tab->add_field_element(
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

			$header_tab->add_field_element(
				array(
					'field_type'    => 'image',
					'name'          => 'qodef_logo_light',
					'title'         => esc_html__( 'Logo - Light', 'oraiste-core' ),
					'description'   => esc_html__( 'Choose light skin logo image', 'oraiste-core' ),
					'default_value' => defined( 'ORAISTE_ASSETS_ROOT' ) ? ORAISTE_ASSETS_ROOT . '/img/logo-light.svg' : '',
					'multiple'      => 'no',
				)
			);

			$header_tab->add_field_element(
				array(
					'field_type'    => 'image',
					'name'          => 'qodef_logo_beige',
					'title'         => esc_html__( 'Logo - Beige', 'oraiste-core' ),
					'description'   => esc_html__( 'Choose beige skin logo image', 'oraiste-core' ),
					'default_value' => defined( 'ORAISTE_ASSETS_ROOT' ) ? ORAISTE_ASSETS_ROOT . '/img/logo-beige.svg' : '',
					'multiple'      => 'no',
				)
			);

			$header_tab->add_field_element(
				array(
					'field_type'    => 'image',
					'name'          => 'qodef_logo_dark',
					'title'         => esc_html__( 'Logo - Dark', 'oraiste-core' ),
					'description'   => esc_html__( 'Choose dark skin logo image', 'oraiste-core' ),
					'default_value' => defined( 'ORAISTE_ASSETS_ROOT' ) ? ORAISTE_ASSETS_ROOT . '/img/logo-dark.svg' : '',
					'multiple'      => 'no',
				)
			);

			$header_tab->add_field_element(
				array(
					'field_type'    => 'image',
					'name'          => 'qodef_logo_orange',
					'title'         => esc_html__( 'Logo - Orange', 'oraiste-core' ),
					'description'   => esc_html__( 'Choose orange skin logo image', 'oraiste-core' ),
					'default_value' => defined( 'ORAISTE_ASSETS_ROOT' ) ? ORAISTE_ASSETS_ROOT . '/img/logo-orange.svg' : '',
					'multiple'      => 'no',
				)
			);

			// Hook to include additional options after module options
			do_action( 'oraiste_core_action_after_header_logo_options_map', $page, $header_tab );
		}
	}

	add_action( 'oraiste_core_action_default_options_init', 'oraiste_core_add_logo_options', oraiste_core_get_admin_options_map_position( 'logo' ) );
}
