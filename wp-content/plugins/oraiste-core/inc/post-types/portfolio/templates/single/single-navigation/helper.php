<?php

if ( ! function_exists( 'oraiste_core_include_portfolio_single_post_navigation_template' ) ) {
	/**
	 * Function which includes additional module on single portfolio page
	 */
	function oraiste_core_include_portfolio_single_post_navigation_template() {
		oraiste_core_template_part( 'post-types/portfolio', 'templates/single/single-navigation/templates/single-navigation' );
	}

	add_action( 'oraiste_core_action_after_portfolio_single_item', 'oraiste_core_include_portfolio_single_post_navigation_template' );
}
