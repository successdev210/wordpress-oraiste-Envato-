<?php
if ( ! function_exists( 'oraiste_core_add_image_portfolio_single_options' ) ) {
	/**
	 * Function that add general image size options for this module
	 */
	function oraiste_core_add_image_portfolio_single_options() {
		$qode_framework = qode_framework_get_framework_root();

		$page = $qode_framework->add_options_page(
			array(
				'scope' => 'image',
				'type'  => 'attachment',
				'slug'  => 'qodef_image_masonry',
			)
		);

		if ( $page ) {
			$page->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_image_portfolio_masonry_size',
					'title'       => esc_html__( 'Image Size', 'oraiste-core' ),
					'description' => esc_html__( 'Choose image size for portfolio single item - Masonry Layout', 'oraiste-core' ),
					'options'     => oraiste_core_get_select_type_options_pool( 'masonry_image_dimension' ),
				)
			);
		}
	}

	add_action( 'qode_framework_action_custom_media_fields', 'oraiste_core_add_image_portfolio_single_options', 15 );
}
