<?php

if ( ! function_exists( 'oraiste_core_filter_portfolio_list_fixed_layout_info_below_tilt' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function oraiste_core_filter_portfolio_list_fixed_layout_info_below_tilt( $variations ) {
		$variations['tilt'] = esc_html__( 'Tilt', 'oraiste-core' );
		
		return $variations;
	}
	
	add_filter( 'oraiste_core_filter_portfolio_list_fixed_layout_info_below_animation_options', 'oraiste_core_filter_portfolio_list_fixed_layout_info_below_tilt' );
}

if ( ! function_exists( 'oraiste_core_include_tilt_scripts' ) ) {
	/**
	 * Function that enqueue modules 3rd party scripts
	 *
	 * @param array $atts
	 */
	function oraiste_core_include_tilt_scripts( $atts ) {

		if ( $atts['layout'] == 'info-below' && $atts['hover_animation_info-below'] == 'tilt' ) {
			wp_enqueue_script( 'tilt');
		}
	}

	add_action( 'oraiste_core_action_portfolio_list_fixed_layout_load_assets', 'oraiste_core_include_tilt_scripts' );
}

if ( ! function_exists( 'oraiste_core_register_tilt_scripts' ) ) {
	/**
	 * Function that register modules 3rd party scripts
	 *
	 * @param array $scripts
	 *
	 * @return array
	 */
	function oraiste_core_register_tilt_scripts( $scripts ) {

		$scripts['tilt'] = array(
				'registered'	=> false,
				'url'			=> ORAISTE_CORE_INC_URL_PATH . '/post-types/portfolio/shortcodes/portfolio-list-fixed-layout/variations/info-below/hover-animations/tilt/assets/js/plugins/tilt.jquery.min.js',
				'dependency'	=> array( 'jquery' )
			);

		return $scripts;
	}

	add_filter( 'oraiste_core_filter_portfolio_list_fixed_layout_register_assets', 'oraiste_core_register_tilt_scripts' );
}