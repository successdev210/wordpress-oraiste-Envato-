<?php

if ( ! function_exists( 'oraiste_core_add_fonts_options' ) ) {
	/**
	 * Function that add options for this module
	 */
	function oraiste_core_add_fonts_options() {
		$qode_framework = qode_framework_get_framework_root();

		$page = $qode_framework->add_options_page(
			array(
				'scope'       => ORAISTE_CORE_OPTIONS_NAME,
				'type'        => 'admin',
				'slug'        => 'fonts',
				'title'       => esc_html__( 'Fonts', 'oraiste-core' ),
				'description' => esc_html__( 'Global Fonts Options', 'oraiste-core' ),
				'icon'        => 'fa fa-cog',
			)
		);

		if ( $page ) {
			$page->add_field_element(
				array(
					'field_type'    => 'yesno',
					'name'          => 'qodef_enable_google_fonts',
					'title'         => esc_html__( 'Enable Google Fonts', 'oraiste-core' ),
					'default_value' => 'yes',
					'args'          => array(
						'custom_class' => 'qodef-enable-google-fonts',
					),
				)
			);

			$google_fonts_section = $page->add_section_element(
				array(
					'name'       => 'qodef_google_fonts_section',
					'title'      => esc_html__( 'Google Fonts Options', 'oraiste-core' ),
					'dependency' => array(
						'show' => array(
							'qodef_enable_google_fonts' => array(
								'values'        => 'yes',
								'default_value' => '',
							),
						),
					),
				)
			);

			$page_repeater = $google_fonts_section->add_repeater_element(
				array(
					'name'        => 'qodef_choose_google_fonts',
					'title'       => esc_html__( 'Google Fonts to Include', 'oraiste-core' ),
					'description' => esc_html__( 'Choose Google Fonts which you want to use on your website', 'oraiste-core' ),
					'button_text' => esc_html__( 'Add New Google Font', 'oraiste-core' ),
				)
			);

			$page_repeater->add_field_element(
				array(
					'field_type'  => 'googlefont',
					'name'        => 'qodef_choose_google_font',
					'title'       => esc_html__( 'Google Font', 'oraiste-core' ),
					'description' => esc_html__( 'Choose Google Font', 'oraiste-core' ),
					'args'        => array(
						'include' => 'google-fonts',
					),
				)
			);

			$google_fonts_section->add_field_element(
				array(
					'field_type'  => 'checkbox',
					'name'        => 'qodef_google_fonts_weight',
					'title'       => esc_html__( 'Google Fonts Weight', 'oraiste-core' ),
					'description' => esc_html__( 'Choose a default Google Fonts weights for your website. Impact on page load time', 'oraiste-core' ),
					'options'     => array(
						'100'  => esc_html__( '100 Thin', 'oraiste-core' ),
						'100i' => esc_html__( '100 Thin Italic', 'oraiste-core' ),
						'200'  => esc_html__( '200 Extra-Light', 'oraiste-core' ),
						'200i' => esc_html__( '200 Extra-Light Italic', 'oraiste-core' ),
						'300'  => esc_html__( '300 Light', 'oraiste-core' ),
						'300i' => esc_html__( '300 Light Italic', 'oraiste-core' ),
						'400'  => esc_html__( '400 Regular', 'oraiste-core' ),
						'400i' => esc_html__( '400 Regular Italic', 'oraiste-core' ),
						'500'  => esc_html__( '500 Medium', 'oraiste-core' ),
						'500i' => esc_html__( '500 Medium Italic', 'oraiste-core' ),
						'600'  => esc_html__( '600 Semi-Bold', 'oraiste-core' ),
						'600i' => esc_html__( '600 Semi-Bold Italic', 'oraiste-core' ),
						'700'  => esc_html__( '700 Bold', 'oraiste-core' ),
						'700i' => esc_html__( '700 Bold Italic', 'oraiste-core' ),
						'800'  => esc_html__( '800 Extra-Bold', 'oraiste-core' ),
						'800i' => esc_html__( '800 Extra-Bold Italic', 'oraiste-core' ),
						'900'  => esc_html__( '900 Ultra-Bold', 'oraiste-core' ),
						'900i' => esc_html__( '900 Ultra-Bold Italic', 'oraiste-core' ),
					),
				)
			);

			$google_fonts_section->add_field_element(
				array(
					'field_type'  => 'checkbox',
					'name'        => 'qodef_google_fonts_subset',
					'title'       => esc_html__( 'Google Fonts Style', 'oraiste-core' ),
					'description' => esc_html__( 'Choose a default Google Fonts style for your website. Impact on page load time', 'oraiste-core' ),
					'options'     => array(
						'latin'        => esc_html__( 'Latin', 'oraiste-core' ),
						'latin-ext'    => esc_html__( 'Latin Extended', 'oraiste-core' ),
						'cyrillic'     => esc_html__( 'Cyrillic', 'oraiste-core' ),
						'cyrillic-ext' => esc_html__( 'Cyrillic Extended', 'oraiste-core' ),
						'greek'        => esc_html__( 'Greek', 'oraiste-core' ),
						'greek-ext'    => esc_html__( 'Greek Extended', 'oraiste-core' ),
						'vietnamese'   => esc_html__( 'Vietnamese', 'oraiste-core' ),
					),
				)
			);

			$page_repeater = $page->add_repeater_element(
				array(
					'name'        => 'qodef_custom_fonts',
					'title'       => esc_html__( 'Custom Fonts', 'oraiste-core' ),
					'description' => esc_html__( 'Add custom fonts', 'oraiste-core' ),
					'button_text' => esc_html__( 'Add New Custom Font', 'oraiste-core' ),
				)
			);

			$page_repeater->add_field_element(
				array(
					'field_type' => 'file',
					'name'       => 'qodef_custom_font_ttf',
					'title'      => esc_html__( 'Custom Font TTF', 'oraiste-core' ),
					'args'       => array(
						'allowed_type' => 'application/octet-stream',
					),
				)
			);

			$page_repeater->add_field_element(
				array(
					'field_type' => 'file',
					'name'       => 'qodef_custom_font_otf',
					'title'      => esc_html__( 'Custom Font OTF', 'oraiste-core' ),
					'args'       => array(
						'allowed_type' => 'application/octet-stream',
					),
				)
			);

			$page_repeater->add_field_element(
				array(
					'field_type' => 'file',
					'name'       => 'qodef_custom_font_woff',
					'title'      => esc_html__( 'Custom Font WOFF', 'oraiste-core' ),
					'args'       => array(
						'allowed_type' => 'application/octet-stream',
					),
				)
			);

			$page_repeater->add_field_element(
				array(
					'field_type' => 'file',
					'name'       => 'qodef_custom_font_woff2',
					'title'      => esc_html__( 'Custom Font WOFF2', 'oraiste-core' ),
					'args'       => array(
						'allowed_type' => 'application/octet-stream',
					),
				)
			);

			$page_repeater->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_custom_font_name',
					'title'      => esc_html__( 'Custom Font Name', 'oraiste-core' ),
				)
			);

			// Hook to include additional options after module options
			do_action( 'oraiste_core_action_after_page_fonts_options_map', $page );
		}
	}

	add_action( 'oraiste_core_action_default_options_init', 'oraiste_core_add_fonts_options', oraiste_core_get_admin_options_map_position( 'fonts' ) );
}
