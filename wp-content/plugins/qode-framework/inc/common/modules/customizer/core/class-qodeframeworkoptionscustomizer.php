<?php

class QodeFrameworkOptionsCustomizer extends QodeFrameworkOptions {

	public function __construct() {
		parent::__construct();

		add_action( 'customize_register', array( $this, 'add_sections' ) );
	}

	/**
	 * Add settings to the customizer.
	 *
	 * @param WP_Customize_Manager $wp_customize Theme Customizer object.
	 */
	public function add_sections( $wp_customize ) {
		$panels = apply_filters( 'qode_framework_filter_customizer_panels', array() );

		if ( ! empty( $panels ) ) {
			foreach ( $panels as $panel ) {

				// Hook to include custom customizer fields
				do_action( 'qode_framework_action_customizer_' . esc_attr( $panel ) );

				foreach ( $this->get_child_elements() as $child_key => $child ) {
					$child->display_field_element( esc_attr( $panel ), $wp_customize );
				}
			}
		}
	}
}
