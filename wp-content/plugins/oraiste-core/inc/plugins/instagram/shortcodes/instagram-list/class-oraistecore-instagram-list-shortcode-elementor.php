<?php

class OraisteCore_Instagram_List_Shortcode_Elementor extends OraisteCore_Elementor_Widget_Base {

	function __construct( array $data = [], $args = null ) {
		$this->set_shortcode_slug( 'oraiste_core_instagram_list' );

		parent::__construct( $data, $args );
	}
}

if ( qode_framework_is_installed( 'instagram' ) ) {
	oraiste_core_get_elementor_widgets_manager()->register_widget_type( new OraisteCore_Instagram_List_Shortcode_Elementor() );
}
