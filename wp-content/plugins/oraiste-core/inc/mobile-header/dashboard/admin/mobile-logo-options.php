<?php

if ( ! function_exists( 'oraiste_core_add_mobile_logo_options' ) ) {
	/**
	 * Function that add general options for this module
	 *
	 * @param object $page
	 * @param object $header_tab
	 */
	function oraiste_core_add_mobile_logo_options( $page, $header_tab ) {

		if ( $page ) {

			$mobile_header_tab = $page->add_tab_element(
				array(
					'name'        => 'tab-mobile-header',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'Mobile Header Logo Options', 'oraiste-core' ),
					'description' => esc_html__( 'Set options for mobile headers', 'oraiste-core' ),
				)
			);

			$mobile_header_tab->add_field_element(
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

			$mobile_header_tab->add_field_element(
				array(
					'field_type'    => 'image',
					'name'          => 'qodef_mobile_logo_light',
					'title'         => esc_html__( 'Mobile Logo - Light', 'oraiste-core' ),
					'description'   => esc_html__( 'Choose light skin mobile logo image', 'oraiste-core' ),
					'default_value' => defined( 'ORAISTE_ASSETS_ROOT' ) ? ORAISTE_ASSETS_ROOT . '/img/logo-light.svg' : '',
					'multiple'      => 'no',
				)
			);

			$mobile_header_tab->add_field_element(
				array(
					'field_type'    => 'image',
					'name'          => 'qodef_mobile_logo_beige',
					'title'         => esc_html__( 'Mobile Logo - Beige', 'oraiste-core' ),
					'description'   => esc_html__( 'Choose beige skin mobile logo image', 'oraiste-core' ),
					'default_value' => defined( 'ORAISTE_ASSETS_ROOT' ) ? ORAISTE_ASSETS_ROOT . '/img/logo-beige.svg' : '',
					'multiple'      => 'no',
				)
			);

			$mobile_header_tab->add_field_element(
				array(
					'field_type'    => 'image',
					'name'          => 'qodef_mobile_logo_dark',
					'title'         => esc_html__( 'Mobile Logo - Dark', 'oraiste-core' ),
					'description'   => esc_html__( 'Choose dark skin mobile logo image', 'oraiste-core' ),
					'default_value' => defined( 'ORAISTE_ASSETS_ROOT' ) ? ORAISTE_ASSETS_ROOT . '/img/logo-dark.svg' : '',
					'multiple'      => 'no',
				)
			);

			$mobile_header_tab->add_field_element(
				array(
					'field_type'    => 'image',
					'name'          => 'qodef_mobile_logo_orange',
					'title'         => esc_html__( 'Mobile Logo - Orange', 'oraiste-core' ),
					'description'   => esc_html__( 'Choose orange skin mobile logo image', 'oraiste-core' ),
					'default_value' => defined( 'ORAISTE_ASSETS_ROOT' ) ? ORAISTE_ASSETS_ROOT . '/img/logo-orange.svg' : '',
					'multiple'      => 'no',
				)
			);

			do_action( 'oraiste_core_action_after_mobile_logo_options_map', $page );
		}
	}

	add_action( 'oraiste_core_action_after_header_logo_options_map', 'oraiste_core_add_mobile_logo_options', 10, 2 );
}
