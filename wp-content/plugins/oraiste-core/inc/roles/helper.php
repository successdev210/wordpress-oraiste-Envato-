<?php

if ( ! function_exists( 'oraiste_core_include_role_custom_fields' ) ) {
	/**
	 * Function that includes role custom fields files
	 */
	function oraiste_core_include_role_custom_fields() {
		foreach ( glob( ORAISTE_CORE_INC_PATH . '/roles/*/role-fields.php' ) as $role_fields ) {
			include_once $role_fields;
		}
	}

	add_action( 'qode_framework_action_custom_user_fields', 'oraiste_core_include_role_custom_fields' );
}

if ( ! function_exists( 'oraiste_core_register_role_custom_fields' ) ) {
	/**
	 * Function that registers role custom fields files
	 */
	function oraiste_core_register_role_custom_fields() {
		do_action( 'oraiste_core_action_register_role_custom_fields' );
	}

	add_action( 'qode_framework_action_custom_user_fields', 'oraiste_core_register_role_custom_fields', 11 );
}

if ( ! function_exists( 'oraiste_core_profile_get_social_params' ) ) {
	/**
	 * Returns owner params
	 */
	function oraiste_core_profile_get_social_params( $params ) {
		$roles_social_scope = apply_filters( 'oraiste_core_filter_role_social_array', array( 'administrator', 'author' ) );
		$enable             = false;

		foreach ( $params['user']->roles as $role ) {
			if ( in_array( $role, $roles_social_scope, true ) ) {
				$enable = true;
				break;
			}
		}

		if ( $enable ) {
			$user_id = $params['user']->data->ID;

			$params['facebook']  = get_user_meta( $user_id, 'qodef_user_facebook', true );
			$params['instagram'] = get_user_meta( $user_id, 'qodef_user_instagram', true );
			$params['twitter']   = get_user_meta( $user_id, 'qodef_user_twitter', true );
			$params['linkedin']  = get_user_meta( $user_id, 'qodef_user_linkedin', true );
			$params['pinterest'] = get_user_meta( $user_id, 'qodef_user_pinterest', true );
		}

		return $params;
	}

	add_filter( 'oraiste_membership_filter_user_params', 'oraiste_core_profile_get_social_params' );
}

if ( ! function_exists( 'oraiste_core_social_edit_profile_fields' ) ) {
	function oraiste_core_social_edit_profile_fields( $page, $params ) {
		$roles_social_scope = apply_filters( 'oraiste_core_filter_role_social_array', array( 'administrator', 'author' ) );
		$enable             = false;

		foreach ( $params['user']->roles as $role ) {
			if ( in_array( $role, $roles_social_scope, true ) ) {
				$enable = true;
				break;
			}
		}

		if ( $enable ) {
			extract( $params ); // @codingStandardsIgnoreLine

			if ( $page ) {
				$page->add_field_element(
					array(
						'field_type'    => 'text',
						'name'          => 'qodef_user_facebook',
						'title'         => esc_html__( 'Facebook', 'tiare-core' ),
						'default_value' => $facebook,
						'args'          => array(
							'col_width' => 6,
						),
					)
				);

				$page->add_field_element(
					array(
						'field_type'    => 'text',
						'name'          => 'qodef_user_instagram',
						'title'         => esc_html__( 'Instagram', 'tiare-core' ),
						'default_value' => $instagram,
						'args'          => array(
							'col_width' => 6,
						),
					)
				);

				$page->add_field_element(
					array(
						'field_type'    => 'text',
						'name'          => 'qodef_user_twitter',
						'title'         => esc_html__( 'Twitter', 'tiare-core' ),
						'default_value' => $twitter,
						'args'          => array(
							'col_width' => 6,
						),
					)
				);

				$page->add_field_element(
					array(
						'field_type'    => 'text',
						'name'          => 'qodef_user_linkedin',
						'title'         => esc_html__( 'LinkedIn', 'tiare-core' ),
						'default_value' => $linkedin,
						'args'          => array(
							'col_width' => 6,
						),
					)
				);

				$page->add_field_element(
					array(
						'field_type'    => 'text',
						'name'          => 'qodef_user_pinterest',
						'title'         => esc_html__( 'Pinterest', 'tiare-core' ),
						'default_value' => $pinterest,
						'args'          => array(
							'col_width' => 6,
						),
					)
				);
			}
		}
	}

	add_action( 'oraiste_membership_action_after_dashboard_edit_profile_fields', 'oraiste_core_social_edit_profile_fields', 15, 2 );
}

if ( ! function_exists( 'oraiste_core_user_profile_social_update' ) ) {
	function oraiste_core_user_profile_social_update( $options, $user_id ) {
		$user_meta  = get_userdata( $user_id );
		$user_roles = $user_meta->roles;

		$roles_social_scope = apply_filters( 'oraiste_core_filter_role_social_array', array( 'administrator', 'author' ) );
		$enable             = false;

		foreach ( $user_roles as $role ) {
			if ( in_array( $role, $roles_social_scope, true ) ) {
				$enable = true;
				break;
			}
		}

		if ( $enable ) {
			update_user_meta( $user_id, 'qodef_user_facebook', $options['qodef_user_facebook'] );
			update_user_meta( $user_id, 'qodef_user_instagram', $options['qodef_user_instagram'] );
			update_user_meta( $user_id, 'qodef_user_twitter', $options['qodef_user_twitter'] );
			update_user_meta( $user_id, 'qodef_user_linkedin', $options['qodef_user_linkedin'] );
			update_user_meta( $user_id, 'qodef_user_pinterest', $options['qodef_user_pinterest'] );
		}
	}

	add_action( 'oraiste_membership_action_update_user_profile', 'oraiste_core_user_profile_social_update', 10, 2 );
}
