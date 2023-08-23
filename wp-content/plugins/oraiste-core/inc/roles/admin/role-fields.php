<?php

if ( ! function_exists( 'oraiste_core_add_admin_user_options' ) ) {
	/**
	 * Function that add global user options
	 */
	function oraiste_core_add_admin_user_options() {
		$qode_framework     = qode_framework_get_framework_root();
		$roles_social_scope = apply_filters( 'oraiste_core_filter_role_social_array', array( 'administrator', 'author' ) );

		$page = $qode_framework->add_options_page(
			array(
				'scope' => $roles_social_scope,
				'type'  => 'user',
				'title' => esc_html__( 'Social Networks', 'oraiste-core' ),
				'slug'  => 'admin-options',
			)
		);

		if ( $page ) {
			$page->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_user_facebook',
					'title'       => esc_html__( 'Facebook', 'oraiste-core' ),
					'description' => esc_html__( 'Enter user Facebook profile URL', 'oraiste-core' ),
				)
			);

			$page->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_user_instagram',
					'title'       => esc_html__( 'Instagram', 'oraiste-core' ),
					'description' => esc_html__( 'Enter user Instagram profile URL', 'oraiste-core' ),
				)
			);

			$page->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_user_twitter',
					'title'       => esc_html__( 'Twitter', 'oraiste-core' ),
					'description' => esc_html__( 'Enter user Twitter profile URL', 'oraiste-core' ),
				)
			);

			$page->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_user_linkedin',
					'title'       => esc_html__( 'LinkedIn', 'oraiste-core' ),
					'description' => esc_html__( 'Enter user LinkedIn profile URL', 'oraiste-core' ),
				)
			);

			$page->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_user_pinterest',
					'title'       => esc_html__( 'Pinterest', 'oraiste-core' ),
					'description' => esc_html__( 'Enter user Pinterest profile URL', 'oraiste-core' ),
				)
			);

			// Hook to include additional options after module options
			do_action( 'oraiste_core_action_after_admin_user_options_map', $page );
		}
	}

	add_action( 'oraiste_core_action_register_role_custom_fields', 'oraiste_core_add_admin_user_options' );
}
