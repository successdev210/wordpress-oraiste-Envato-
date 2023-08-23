<?php

if ( ! function_exists( 'oraiste_core_filter_portfolio_list_info_below_animation_options' ) ) {
	/**
	 * Function that add additional options for variation layout
	 *
	 * @param array $options
	 *
	 * @return array
	 */
	function oraiste_core_filter_portfolio_list_info_below_animation_options( $options ) {
		$hover_option  = array();
		$option_filter = apply_filters( 'oraiste_core_filter_portfolio_list_info_below_animation_options', array() );
		$options_map   = oraiste_core_get_variations_options_map( $option_filter );

		$option = array(
			'field_type'    => 'select',
			'name'          => 'hover_animation_info-below',
			'title'         => esc_html__( 'Hover Animation', 'oraiste-core' ),
			'options'       => $option_filter,
			'default_value' => $options_map['default_value'],
			'dependency'    => array(
				'show' => array(
					'layout' => array(
						'values'        => 'info-below',
						'default_value' => 'info-below',
					),
				),
			),
			'group'         => esc_html__( 'Layout', 'oraiste-core' ),
//			'visibility'    => array( 'map_for_page_builder' => $options_map['visibility'] ),
		);

		$hover_option[] = $option;

		return array_merge( $options, $hover_option );
	}

	add_filter( 'oraiste_core_filter_portfolio_list_hover_animation_options', 'oraiste_core_filter_portfolio_list_info_below_animation_options' );
}
