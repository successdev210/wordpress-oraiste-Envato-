<?php

class OraisteCore_Social_Share_Shortcode_Elementor extends OraisteCore_Elementor_Widget_Base {

	function __construct( array $data = [], $args = null ) {
		$this->set_shortcode_slug( 'oraiste_core_social_share' );

		parent::__construct( $data, $args );
	}
}

oraiste_core_get_elementor_widgets_manager()->register_widget_type( new OraisteCore_Social_Share_Shortcode_Elementor() );
