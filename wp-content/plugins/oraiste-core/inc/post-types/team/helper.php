<?php

if ( ! function_exists( 'oraiste_core_team_set_admin_options_map_position' ) ) {
	/**
	 * Function that set dashboard admin options map position for this module
	 *
	 * @param int    $position
	 * @param string $map
	 *
	 * @return int
	 */
	function oraiste_core_team_set_admin_options_map_position( $position, $map ) {

		if ( 'team' === $map ) {
			$position = 52;
		}

		return $position;
	}

	add_filter( 'oraiste_core_filter_admin_options_map_position', 'oraiste_core_team_set_admin_options_map_position', 10, 2 );
}
