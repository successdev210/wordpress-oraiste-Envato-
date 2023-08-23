<?php

class OraisteCore_Order_Tracking_Shortcode_Elementor extends OraisteCore_Elementor_Widget_Base {

	function __construct( array $data = [], $args = null ) {
		$this->set_shortcode_slug( 'oraiste_core_order_tracking' );

		parent::__construct( $data, $args );
	}
}

if ( qode_framework_is_installed( 'woocommerce' ) ) {
	oraiste_core_get_elementor_widgets_manager()->register_widget_type( new OraisteCore_Order_Tracking_Shortcode_Elementor() );
}


// class OraisteCore_Icon_Shortcode_Elementor extends OraisteCore_Elementor_Widget_Base {
//
// 	function __construct( array $data = [], $args = null ) {
// 		$this->set_shortcode_slug( 'oraiste_core_icon' );
//
// 		parent::__construct( $data, $args );
// 	}
// }
//
// oraiste_core_get_elementor_widgets_manager()->register_widget_type( new OraisteCore_Icon_Shortcode_Elementor() );
