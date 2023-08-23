<?php

if ( ! function_exists( 'oraiste_core_add_team_single_meta_box' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function oraiste_core_add_team_single_meta_box() {
		$qode_framework = qode_framework_get_framework_root();

		$page = $qode_framework->add_options_page(
			array(
				'scope' => array( 'team' ),
				'type'  => 'meta',
				'slug'  => 'team',
				'title' => esc_html__( 'Team Single', 'oraiste-core' ),
			)
		);

		if ( $page ) {
			$section = $page->add_section_element(
				array(
					'name'        => 'qodef_team_general_section',
					'title'       => esc_html__( 'General Settings', 'oraiste-core' ),
					'description' => esc_html__( 'General information about team member.', 'oraiste-core' ),
				)
			);

			$section->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_team_member_role',
					'title'       => esc_html__( 'Role', 'oraiste-core' ),
					'description' => esc_html__( 'Enter team member role', 'oraiste-core' ),
				)
			);

			$section->add_field_element(
				array(
					'field_type'  => 'textarea',
					'name'        => 'qodef_team_member_description',
					'title'       => esc_html__( 'Description', 'oraiste-core' ),
					'description' => esc_html__( 'Enter team member description', 'oraiste-core' ),
				)
			);

			$social_networks_repeater = $section->add_repeater_element(
				array(
					'name'        => 'qodef_team_member_social_networks',
					'title'       => esc_html__( 'Social Networks', 'oraiste-core' ),
					'description' => esc_html__( 'Populate team member social networks info', 'oraiste-core' ),
					'button_text' => esc_html__( 'Add New Network', 'oraiste-core' ),
				)
			);

			$social_networks_repeater->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_team_member_social_network_text',
					'title'      => esc_html__( 'Social Network', 'oraiste-core' ),
				)
			);

			$social_networks_repeater->add_field_element(
				array(
					'field_type' => 'text',
					'name'       => 'qodef_team_member_social_network_link',
					'title'      => esc_html__( 'Social Network Link', 'oraiste-core' ),
				)
			);

			$social_networks_repeater->add_field_element(
				array(
					'field_type' => 'select',
					'name'       => 'qodef_team_member_social_network_target',
					'title'      => esc_html__( 'Social Network Target', 'oraiste-core' ),
					'options'    => oraiste_core_get_select_type_options_pool( 'link_target' ),
				)
			);

			// Hook to include additional options after module options
			do_action( 'oraiste_core_action_after_team_meta_box_map', $page );
		}
	}

	add_action( 'oraiste_core_action_default_meta_boxes_init', 'oraiste_core_add_team_single_meta_box' );
}
