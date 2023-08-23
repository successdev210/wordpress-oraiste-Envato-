<?php

if ( ! function_exists( 'oraiste_core_add_image_shortcode_media_options' ) ) {
	/**
	 * Function that add global media option for current module
	 */
	function oraiste_core_add_image_shortcode_media_options() {
		$qode_framework = qode_framework_get_framework_root();

		$page = $qode_framework->add_options_page(
			array(
				'scope' => 'image',
				'type'  => 'attachment',
				'slug'  => 'qodef_image_gallery',
			)
		);

		if ( $page ) {
			$page->add_field_element(
				array(
					'field_type'  => 'text',
					'name'        => 'qodef_image_gallery_custom_link',
					'title'       => esc_html__( 'Custom Link URL', 'oraiste-core' ),
					'description' => esc_html__( 'Enter URL where image should navigate to if custom link option is selected in image gallery shortcode', 'oraiste-core' ),
				)
			);

			$page->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_image_gallery_masonry_size',
					'title'       => esc_html__( 'Image Size', 'oraiste-core' ),
					'description' => esc_html__( 'Choose image size for list shortcode item if masonry layout > fixed image size is selected in image gallery shortcode', 'oraiste-core' ),
					'options'     => oraiste_core_get_select_type_options_pool( 'masonry_image_dimension' ),
				)
			);
		}
	}

	add_action( 'qode_framework_action_custom_media_fields', 'oraiste_core_add_image_shortcode_media_options', 11 );
}
