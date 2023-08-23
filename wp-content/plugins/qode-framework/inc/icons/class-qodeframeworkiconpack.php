<?php

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

abstract class QodeFrameworkIconPack {
	private $base;
	private $name;
	private $prefix;
	private $icons;
	private $specific_icons;

	public function __construct() {
		$this->add_icon_pack();

		add_action(
			'wp_ajax_qode_framework_get_icon_pack_' . $this->get_base(),
			array(
				$this,
				'print_icons_as_option',
			)
		);
	}

	abstract public function add_icon_pack();

	public function get_base() {
		return $this->base;
	}

	public function set_base( $base ) {
		$this->base = $base;
	}

	public function get_name() {
		return $this->name;
	}

	public function set_name( $name ) {
		$this->name = $name;
	}

	public function get_prefix() {
		return $this->prefix;
	}

	public function set_prefix( $prefix ) {
		$this->prefix = $prefix;
	}

	public function get_icons() {
		return $this->icons;
	}

	public function set_icons( $icons ) {
		$this->icons = $icons;
	}

	public function print_icons_as_option() {
		$html = '';
		foreach ( $this->icons as $key => $label ) {
			$html .= '<option value="' . esc_attr( $key ) . '">';
			$html .= esc_html( $label );
			$html .= '</option>';
		}

		// html is properly escaped in code above
		echo $html; // phpcs:ignore WordPress.XSS.EscapeOutput.OutputNotEscaped
	}

	public function get_specific_icons() {
		return $this->specific_icons;
	}

	public function set_specific_icons( $icons ) {
		$this->specific_icons = $icons;
	}

	abstract public function get_style_url();

	public function render( $icon, $params = array() ) {
		extract( $params ); // @codingStandardsIgnoreLine

		$icon_attributes_string = '';
		$icon_class             = array(
			'qodef-icon-' . $this->base,
			$icon,
		);

		if ( ! empty( $this->prefix ) ) {
			$icon_class[] = $this->prefix;
		}

		if ( isset( $icon_attributes ) && count( $icon_attributes ) ) {
			foreach ( $icon_attributes as $icon_attr_name => $icon_attr_val ) {
				if ( 'class' === $icon_attr_name ) {
					$icon_class[] = $icon_attr_val;
					unset( $icon_attributes[ $icon_attr_name ] );
				} else {
					$icon_attributes_string .= $icon_attr_name . '="' . $icon_attr_val . '" ';
				}
			}
		}

		return $this->render_html( $icon_class, $icon_attributes_string, $icon );
	}

	public function render_html( $icon_class, $icon_attributes_string, $icon ) {
		return '<span class="' . implode( ' ', $icon_class ) . '" ' . $icon_attributes_string . '></span>';
	}
}
