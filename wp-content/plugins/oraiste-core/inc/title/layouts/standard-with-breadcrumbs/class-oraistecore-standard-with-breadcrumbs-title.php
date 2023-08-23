<?php

class OraisteCore_Standard_With_Breadcrumbs_Title extends OraisteCore_Title {
	private static $instance;

	public function __construct() {
		$this->slug       = 'standard-with-breadcrumbs';
		$this->parameters = $this->get_parameters();
	}

	/**
	 * @return OraisteCore_Standard_With_Breadcrumbs_Title
	 */
	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	function get_parameters() {
		$parameters = array();

		$parameters = array_merge( $parameters, array( 'title_tag' => oraiste_core_get_post_value_through_levels( 'qodef_page_title_tag' ) ) );

		return $parameters;
	}
}
