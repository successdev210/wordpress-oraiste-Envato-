<?php

if ( ! function_exists( 'oraiste_core_add_portfolio_item_list_meta_boxes' ) ) {
	/**
	 * Function that add general meta box options for this module
	 *
	 * @param object $page
	 */
	function oraiste_core_add_portfolio_item_list_meta_boxes( $page ) {

		if ( $page ) {

			$list_tab = $page->add_tab_element(
				array(
					'name'        => 'tab-list',
					'icon'        => 'fa fa-cog',
					'title'       => esc_html__( 'List Settings', 'oraiste-core' ),
					'description' => esc_html__( 'Portfolio list settings', 'oraiste-core' ),
				)
			);

			$list_tab->add_field_element(
				array(
					'field_type'  => 'image',
					'name'        => 'qodef_portfolio_list_image',
					'title'       => esc_html__( 'Portfolio List Image', 'oraiste-core' ),
					'description' => esc_html__( 'Upload image to be displayed on portfolio list instead of featured image', 'oraiste-core' ),
				)
			);

			$list_tab->add_field_element(
				array(
					'field_type'  => 'file',
					'name'        => 'qodef_portfolio_list_video',
					'title'       => esc_html__( 'Portfolio List Video', 'oraiste-core' ),
					'description' => esc_html__( 'Upload mp4 video to be displayed on portfolio list instead of featured image', 'oraiste-core' ),
					'args'        => array(
						'allowed_type' => '[video/mp4]',
					),
				)
			);

			$list_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_masonry_image_dimension_portfolio_item',
					'title'       => esc_html__( 'Image Dimension', 'oraiste-core' ),
					'description' => esc_html__( 'Choose an image layout for "masonry behavior" portfolio list. If you are using fixed image proportions on the list, choose an option other than default', 'oraiste-core' ),
					'options'     => oraiste_core_get_select_type_options_pool( 'masonry_image_dimension' ),
				)
			);

			$list_tab->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_portfolio_item_padding',
					'title'       => esc_html__( 'Portfolio Item Custom Padding', 'oraiste-core' ),
					'description' => esc_html__( 'Choose item padding when it appears in portfolio list (ex. 5% 5% 5% 5%)', 'oraiste-core' ),
				)
			);

			// Hook to include additional options after module options
			do_action( 'oraiste_core_action_after_portfolio_list_meta_box_map', $list_tab );
		}
	}

	add_action( 'oraiste_core_action_after_portfolio_meta_box_map', 'oraiste_core_add_portfolio_item_list_meta_boxes' );
}
