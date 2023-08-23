<?php

class OraisteCore_Image_Gallery_Shortcode_Elementor extends OraisteCore_Elementor_Widget_Base {

	function __construct( array $data = [], $args = null ) {
		$this->set_shortcode_slug( 'oraiste_core_image_gallery' );

		parent::__construct( $data, $args );
	}
}

oraiste_core_get_elementor_widgets_manager()->register_widget_type( new OraisteCore_Image_Gallery_Shortcode_Elementor() );
