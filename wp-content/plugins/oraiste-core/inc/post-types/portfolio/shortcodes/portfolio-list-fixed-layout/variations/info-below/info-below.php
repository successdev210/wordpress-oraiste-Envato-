<?php

if ( ! function_exists( 'oraiste_core_add_portfolio_list_fixed_layout_variation_info_below' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function oraiste_core_add_portfolio_list_fixed_layout_variation_info_below( $variations ) {
		$variations['info-below'] = esc_html__( 'Info Below', 'oraiste-core' );

		return $variations;
	}

	add_filter( 'oraiste_core_filter_portfolio_list_fixed_layout_layouts', 'oraiste_core_add_portfolio_list_fixed_layout_variation_info_below' );
}

if ( ! function_exists( 'oraiste_core_add_portfolio_list_fixed_layout_options_info_below' ) ) {
	/**
	 * Function that add additional options for variation layout
	 *
	 * @param array $options
	 *
	 * @return array
	 */
	function oraiste_core_add_portfolio_list_fixed_layout_options_info_below( $options ) {
		$info_below_options   = array();
		$margin_option        = array(
			'field_type' => 'text',
			'name'       => 'info_below_content_margin_top',
			'title'      => esc_html__( 'Content Top Margin', 'oraiste-core' ),
			'dependency' => array(
				'show' => array(
					'layout' => array(
						'values'        => 'info-below',
						'default_value' => '',
					),
				),
			),
			'group'      => esc_html__( 'Layout', 'oraiste-core' ),
		);
		$info_below_options[] = $margin_option;

		return array_merge( $options, $info_below_options );
	}

	add_filter( 'oraiste_core_filter_portfolio_list_fixed_layout_extra_options', 'oraiste_core_add_portfolio_list_fixed_layout_options_info_below' );
}

if ( ! function_exists( 'oraiste_core_get_image_dimensions' ) ) {
	function oraiste_core_get_image_dimensions( $count ) {
		$image_dimensions = array();

		$large_landscape = array( 1, 4, 5, 6, 9, 10, 11, 14, 15, 16, 19, 20 );
		$small_portrait  = array( 2, 7, 8, 12, 17, 18 );
		$small_landscape = array( 3, 13 );

		if ( in_array( $count, $large_landscape, true ) ) {
			$image_dimensions['width']  = '965';
			$image_dimensions['height'] = '610';
		} elseif ( in_array( $count, $small_portrait, true ) ) {
			$image_dimensions['width']  = '340';
			$image_dimensions['height'] = '470';
		} elseif ( in_array( $count, $small_landscape, true ) ) {
			$image_dimensions['width']  = '540';
			$image_dimensions['height'] = '390';
		} else {
			$image_dimensions['width']  = '965';
			$image_dimensions['height'] = '610';
		}

		return $image_dimensions;
	}
}
