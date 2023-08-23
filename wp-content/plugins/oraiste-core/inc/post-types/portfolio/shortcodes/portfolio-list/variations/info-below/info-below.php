<?php

if ( ! function_exists( 'oraiste_core_add_portfolio_list_variation_info_below' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function oraiste_core_add_portfolio_list_variation_info_below( $variations ) {
		$variations['info-below'] = esc_html__( 'Info Below', 'oraiste-core' );

		return $variations;
	}

	add_filter( 'oraiste_core_filter_portfolio_list_layouts', 'oraiste_core_add_portfolio_list_variation_info_below' );
}

if ( ! function_exists( 'oraiste_core_add_portfolio_list_options_info_below' ) ) {
	/**
	 * Function that add additional options for variation layout
	 *
	 * @param array $options
	 *
	 * @return array
	 */
	function oraiste_core_add_portfolio_list_options_info_below( $options ) {
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

	add_filter( 'oraiste_core_filter_portfolio_list_extra_options', 'oraiste_core_add_portfolio_list_options_info_below' );
}
