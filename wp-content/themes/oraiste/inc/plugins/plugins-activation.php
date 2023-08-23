<?php

if ( ! function_exists( 'oraiste_register_required_plugins' ) ) {
	/**
	 * Function that registers theme required and optional plugins. Hooks to tgmpa_register hook
	 */
	function oraiste_register_required_plugins() {
		$plugins = array(
			array(
				'name'               => esc_html__( 'Qode Framework', 'oraiste' ),
				'slug'               => 'qode-framework',
				'source'             => ORAISTE_INC_ROOT_DIR . '/plugins/qode-framework.zip',
				'version'            => '1.1.5',
				'required'           => true,
				'force_activation'   => false,
				'force_deactivation' => false,
			),
			array(
				'name'               => esc_html__( 'Oraiste Core', 'oraiste' ),
				'slug'               => 'oraiste-core',
				'source'             => ORAISTE_INC_ROOT_DIR . '/plugins/oraiste-core.zip',
				'version'            => '1.0.1',
				'required'           => true,
				'force_activation'   => false,
				'force_deactivation' => false,
			),
			array(
				'name'               => esc_html__( 'Revolution Slider', 'oraiste' ),
				'slug'               => 'revslider',
				'source'             => ORAISTE_INC_ROOT_DIR . '/plugins/revslider.zip',
				'version'            => '6.4.11',
				'required'           => true,
				'force_activation'   => false,
				'force_deactivation' => false,
			),
			array(
				'name'     => esc_html__( 'Elementor Page Builder', 'oraiste' ),
				'slug'     => 'elementor',
				'required' => true,
			),
			array(
				'name'     => esc_html__( 'Qi Addons for Elementor', 'oraiste' ),
				'slug'     => 'qi-addons-for-elementor',
				'required' => false,
			),
			array(
				'name'     => esc_html__( 'WooCommerce Plugin', 'oraiste' ),
				'slug'     => 'woocommerce',
				'required' => false,
			),
			array(
				'name'     => esc_html__( 'Contact Form 7', 'oraiste' ),
				'slug'     => 'contact-form-7',
				'required' => false,
			),
			array(
				'name'     => esc_html__( 'Custom Twitter Feeds', 'oraiste' ),
				'slug'     => 'custom-twitter-feeds',
				'required' => false,
			),
			array(
				'name'     => esc_html__( 'Instagram Feed', 'oraiste' ),
				'slug'     => 'instagram-feed',
				'required' => false,
			),
			array(
				'name'     => esc_html__( 'Envato Market', 'oraiste' ),
				'slug'     => 'envato-market',
				'source'   => 'https://envato.github.io/wp-envato-market/dist/envato-market.zip',
				'required' => false,
			),
		);

		$config = array(
			'domain'       => 'oraiste',
			'default_path' => '',
			'parent_slug'  => 'themes.php',
			'capability'   => 'edit_theme_options',
			'menu'         => 'install-required-plugins',
			'has_notices'  => true,
			'is_automatic' => false,
			'message'      => '',
			'strings'      => array(
				'page_title'                      => esc_html__( 'Install Required Plugins', 'oraiste' ),
				'menu_title'                      => esc_html__( 'Install Plugins', 'oraiste' ),
				'installing'                      => esc_html__( 'Installing Plugin: %s', 'oraiste' ),
				'oops'                            => esc_html__( 'Something went wrong with the plugin API.', 'oraiste' ),
				'notice_can_install_required'     => _n_noop( 'This theme requires the following plugin: %1$s.', 'This theme requires the following plugins: %1$s.', 'oraiste' ),
				'notice_can_install_recommended'  => _n_noop( 'This theme recommends the following plugin: %1$s.', 'This theme recommends the following plugins: %1$s.', 'oraiste' ),
				'notice_cannot_install'           => _n_noop( 'Sorry, but you do not have the correct permissions to install the %s plugin. Contact the administrator of this website for help on getting the plugin installed.', 'Sorry, but you do not have the correct permissions to install the %s plugins. Contact the administrator of this site for help on getting the plugins installed.', 'oraiste' ),
				'notice_can_activate_required'    => _n_noop( 'The following required plugin is currently inactive: %1$s.', 'The following required plugins are currently inactive: %1$s.', 'oraiste' ),
				'notice_can_activate_recommended' => _n_noop( 'The following recommended plugin is currently inactive: %1$s.', 'The following recommended plugins are currently inactive: %1$s.', 'oraiste' ),
				'notice_cannot_activate'          => _n_noop( 'Sorry, but you do not have the correct permissions to activate the %s plugin. Contact the administrator of this website for help on getting the plugin activated.', 'Sorry, but you do not have the correct permissions to activate the %s plugins. Contact the administrator of this site for help on getting the plugins activated.', 'oraiste' ),
				'notice_ask_to_update'            => _n_noop( 'The following plugin needs to be updated to its latest version to ensure maximum compatibility with this theme: %1$s.', 'The following plugins need to be updated to their latest version to ensure maximum compatibility with this theme: %1$s.', 'oraiste' ),
				'notice_cannot_update'            => _n_noop( 'Sorry, but you do not have the correct permissions to update the %s plugin. Contact the administrator of this website for help on getting the plugin updated.', 'Sorry, but you do not have the correct permissions to update the %s plugins. Contact the administrator of this site for help on getting the plugins updated.', 'oraiste' ),
				'install_link'                    => _n_noop( 'Begin installing plugin', 'Begin installing plugins', 'oraiste' ),
				'activate_link'                   => _n_noop( 'Activate installed plugin', 'Activate installed plugins', 'oraiste' ),
				'return'                          => esc_html__( 'Return to Required Plugins Installer', 'oraiste' ),
				'plugin_activated'                => esc_html__( 'Plugin activated successfully.', 'oraiste' ),
				'complete'                        => esc_html__( 'All plugins installed and activated successfully. %s', 'oraiste' ),
				'nag_type'                        => 'updated',
			),
		);

		tgmpa( $plugins, $config );
	}

	add_action( 'tgmpa_register', 'oraiste_register_required_plugins' );
}
