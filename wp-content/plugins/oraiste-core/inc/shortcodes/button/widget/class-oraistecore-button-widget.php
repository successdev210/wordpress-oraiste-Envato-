<?php

if ( ! function_exists( 'oraiste_core_add_button_widget' ) ) {
	/**
	 * Function that add widget into widgets list for registration
	 *
	 * @param array $widgets
	 *
	 * @return array
	 */
	function oraiste_core_add_button_widget( $widgets ) {
		$widgets[] = 'OraisteCore_Button_Widget';

		return $widgets;
	}

	add_filter( 'oraiste_core_filter_register_widgets', 'oraiste_core_add_button_widget' );
}

if ( class_exists( 'QodeFrameworkWidget' ) ) {
	class OraisteCore_Button_Widget extends QodeFrameworkWidget {

		public function map_widget() {
			$widget_mapped = $this->import_shortcode_options(
				array(
					'shortcode_base' => 'oraiste_core_button',
				)
			);
			if ( $widget_mapped ) {
				$this->set_base( 'oraiste_core_button' );
				$this->set_name( esc_html__( 'Oraiste Button', 'oraiste-core' ) );
				$this->set_description( esc_html__( 'Add a button element into widget areas', 'oraiste-core' ) );
			}
		}

		public function render( $atts ) {
			$params = $this->generate_string_params( $atts );

			echo do_shortcode( "[oraiste_core_button $params]" ); // XSS OK
		}
	}
}
