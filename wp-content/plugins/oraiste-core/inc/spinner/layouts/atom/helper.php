<?php

if ( ! function_exists( 'oraiste_core_add_atom_spinner_layout_option' ) ) {
	/**
	 * Function that set new value into page spinner layout options map
	 *
	 * @param array $layouts - module layouts
	 *
	 * @return array
	 */
	function oraiste_core_add_atom_spinner_layout_option( $layouts ) {
		$layouts['atom'] = esc_html__( 'Atom', 'oraiste-core' );

		return $layouts;
	}

	add_filter( 'oraiste_core_filter_page_spinner_layout_options', 'oraiste_core_add_atom_spinner_layout_option' );
}
