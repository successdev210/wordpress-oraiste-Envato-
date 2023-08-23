<?php

if ( ! function_exists( 'oraiste_core_include_blog_single_author_info_template' ) ) {
	/**
	 * Function which includes additional module on single posts page
	 */
	function oraiste_core_include_blog_single_author_info_template() {
		if ( is_single() ) {
			include_once ORAISTE_CORE_INC_PATH . '/blog/templates/single/author-info/templates/author-info.php';
		}
	}

	add_action( 'oraiste_action_after_blog_post_item', 'oraiste_core_include_blog_single_author_info_template', 15 );  // permission 15 is set to define template position
}

if ( ! function_exists( 'oraiste_core_get_author_social_networks' ) ) {
	/**
	 * Function which includes author info templates on single posts page
	 */
	function oraiste_core_get_author_social_networks( $user_id ) {
		$labels          = array();
		$social_networks = array(
			'facebook'  => 'fb',
			'twitter'   => 'tw',
			'linkedin'  => 'ln',
			'instagram' => 'ig',
			'pinterest' => 'pn',
		);

		foreach ( $social_networks as $network => $network_shorthand ) {
			$network_meta = get_the_author_meta( 'qodef_user_' . $network, $user_id );

			if ( ! empty( $network_meta ) ) {
				$$network = array(
					'url'   => $network_meta,
					'name'  => $network_shorthand,
					'class' => 'qodef-user-social-' . $network,
				);

				$labels[$network] = $$network;
			}
		}

		return $labels;
	}
}
