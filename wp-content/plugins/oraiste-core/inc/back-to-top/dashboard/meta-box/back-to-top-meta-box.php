<?php

if ( ! function_exists( 'oraiste_core_add_back_to_top_meta_box' ) ) {
	/**
	 * Function that add general options for this module
	 */
	function oraiste_core_add_back_to_top_meta_box( $general_tab ) {

		if ( $general_tab ) {
			$general_tab->add_field_element(
				array(
					'field_type'  => 'select',
					'name'        => 'qodef_back_to_top',
					'title'       => esc_html__( 'Enable Back to Top', 'oraiste-core' ),
					'description' => esc_html__( 'Enable Back to Top element', 'oraiste-core' ),
					'options'     => oraiste_core_get_select_type_options_pool( 'yes_no' ),
				)
			);
		}
	}

	add_action( 'oraiste_core_action_after_general_page_meta_box_map', 'oraiste_core_add_back_to_top_meta_box' );
}
