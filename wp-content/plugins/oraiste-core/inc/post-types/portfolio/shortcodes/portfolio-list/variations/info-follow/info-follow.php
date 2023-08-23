<?php

if ( ! function_exists( 'oraiste_core_add_portfolio_list_variation_info_follow' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function oraiste_core_add_portfolio_list_variation_info_follow( $variations ) {
		$variations['info-follow'] = esc_html__( 'Info Follow', 'oraiste-core' );

		return $variations;
	}

	add_filter( 'oraiste_core_filter_portfolio_list_layouts', 'oraiste_core_add_portfolio_list_variation_info_follow' );
}

if ( ! function_exists( 'oraiste_core_add_portfolio_list_options_info_follow' ) ) {
	/**
	 * Function that add additional options for variation layout
	 *
	 * @param array $options
	 *
	 * @return array
	 */
	function oraiste_core_add_portfolio_list_options_info_follow( $options ) {
		$options[] = array(
			'field_type' => 'select',
			'name'       => 'info_follow_predefined',
			'title'      => esc_html__( 'Predefined Layout for 4 columns', 'oraiste-core' ),
			'options'    => oraiste_core_get_select_type_options_pool( 'no_yes' ),
			'dependency' => array(
				'show' => array(
					'layout' => array(
						'values'        => 'info-follow',
						'default_value' => '',
					),
				),
			),
			'group'      => esc_html__( 'Layout', 'oraiste-core' ),
		);

		$options[] = array(
			'field_type' => 'select',
			'name'       => 'info_follow_parallax_scrolling',
			'title'      => esc_html__( 'Enable Parallax Scrolling', 'oraiste-core' ),
			'options'    => oraiste_core_get_select_type_options_pool( 'no_yes' ),
			'dependency' => array(
				'show' => array(
					'layout' => array(
						'values'        => 'info-follow',
						'default_value' => '',
					),
				),
			),
			'group'      => esc_html__( 'Layout', 'oraiste-core' ),
		);

		return $options;
	}

	add_filter( 'oraiste_core_filter_portfolio_list_extra_options', 'oraiste_core_add_portfolio_list_options_info_follow' );
}
