<?php

if ( ! function_exists( 'oraiste_core_add_twitter_list_widget' ) ) {
	/**
	 * Function that add widget into widgets list for registration
	 *
	 * @param array $widgets
	 *
	 * @return array
	 */
	function oraiste_core_add_twitter_list_widget( $widgets ) {
		if ( qode_framework_is_installed( 'twitter' ) ) {
			$widgets[] = 'OraisteCore_Twitter_List_Widget';
		}

		return $widgets;
	}

	add_filter( 'oraiste_core_filter_register_widgets', 'oraiste_core_add_twitter_list_widget' );
}

if ( class_exists( 'QodeFrameworkWidget' ) ) {
	class OraisteCore_Twitter_List_Widget extends QodeFrameworkWidget {

		public function map_widget() {
			$this->set_widget_option(
				array(
					'name'       => 'widget_title',
					'field_type' => 'text',
					'title'      => esc_html__( 'Title', 'oraiste-core' ),
				)
			);
			$widget_mapped = $this->import_shortcode_options(
				array(
					'shortcode_base' => 'oraiste_core_twitter_list',
				)
			);
			if ( $widget_mapped ) {
				$this->set_base( 'oraiste_core_twitter_list' );
				$this->set_name( esc_html__( 'Oraiste Twitter List', 'oraiste-core' ) );
				$this->set_description( esc_html__( 'Add a twitter list element into widget areas', 'oraiste-core' ) );
			}
		}

		public function render( $atts ) {
			$params = $this->generate_string_params( $atts );

			echo do_shortcode( "[oraiste_core_twitter_list $params]" ); // XSS OK
		}
	}
}
