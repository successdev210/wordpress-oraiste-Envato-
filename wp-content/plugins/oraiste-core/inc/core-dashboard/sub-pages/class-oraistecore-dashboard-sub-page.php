<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

abstract class OraisteCore_Dashboard_Sub_Page {
	private $base;
	private $title;
	private $atts = array();

	public function __construct() {
		$this->add_sub_page();
	}

	abstract public function add_sub_page();

	public function get_base() {
		return $this->base;
	}

	public function set_base( $base ) {
		$this->base = $base;
	}

	public function get_title() {
		return $this->title;
	}

	public function set_title( $title ) {
		$this->title = $title;
	}

	public function get_atts() {
		return $this->atts;
	}

	public function set_atts( $atts ) {
		$this->atts = $atts;
	}

	public function render() {
		oraiste_core_template_part( 'core-dashboard/sub-pages/' . $this->get_base() . '/templates', $this->get_base(), '', $this->get_atts() );
	}
}
