<?php

class OraisteCore_Team_List_Shortcode_Elementor extends OraisteCore_Elementor_Widget_Base {

	function __construct( array $data = [], $args = null ) {
		$this->set_shortcode_slug( 'oraiste_core_team_list' );

		parent::__construct( $data, $args );
	}
}

oraiste_core_get_elementor_widgets_manager()->register_widget_type( new OraisteCore_Team_List_Shortcode_Elementor() );
