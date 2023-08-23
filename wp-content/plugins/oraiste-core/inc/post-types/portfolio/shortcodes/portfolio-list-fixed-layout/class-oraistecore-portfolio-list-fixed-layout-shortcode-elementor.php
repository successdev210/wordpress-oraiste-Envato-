<?php

class OraisteCore_Portfolio_List_Fixed_Layout_Shortcode_Elementor extends OraisteCore_Elementor_Widget_Base {

	function __construct( array $data = array(), $args = null ) {
		$this->set_shortcode_slug( 'oraiste_core_portfolio_list_fixed_layout' );

		parent::__construct( $data, $args );
	}
}

oraiste_core_get_elementor_widgets_manager()->register_widget_type( new OraisteCore_Portfolio_List_Fixed_Layout_Shortcode_Elementor() );
