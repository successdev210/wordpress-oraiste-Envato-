<?php

class QodeFrameworkIcons {
	private static $instance;
	public $icon_packs = array();
	public $icons_object_collection;

	function __construct() {
		$this->register_icon_packs();

		add_action( 'qode_framework_before_dashboard_scripts', array( $this, 'enqueue_style' ) );
		add_action( 'qode_framework_action_before_dashboard_widgets_scripts', array( $this, 'enqueue_style' ) );
		add_action( 'wp_enqueue_scripts', array( $this, 'enqueue_style' ), 5 ); /* Load icons first, before other css files. */
	}

	/**
	 * @return QodeFrameworkIcons
	 */
	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function set_icons_collection( QodeFrameworkIconPack $icon_pack ) {
		$key  = $icon_pack->get_base();
		$name = $icon_pack->get_name();
		$this->set_icon_pack( $key, $name );
		$this->set_icon_object_collection( $key, $icon_pack );
	}

	public function get_icon_packs( $exclude = array(), $first_empty = false ) {

		if ( $first_empty ) {
			$icon_pack = array_merge(
				array( '' => esc_attr__( 'Select Icon Pack', 'qode-framework' ) ),
				$icon_pack = $this->icon_packs
			);
		} else {
			$icon_pack = $this->icon_packs;
		}

		if ( is_array( $exclude ) && count( $exclude ) > 0 ) {
			foreach ( $exclude as $key ) {
				unset( $icon_pack[ $key ] );
			}
		}

		return $icon_pack;
	}

	public function set_icon_pack( $key, $name ) {
		$this->icon_packs[ $key ] = $name;
	}

	public function get_icon_object_collection() {
		return $this->icons_object_collection;
	}

	public function get_icon_object_collection_by_pack( $icon_pack ) {
		return $this->icons_object_collection[ $icon_pack ];
	}

	public function set_icon_object_collection( $key, $object ) {
		$this->icons_object_collection[ $key ] = $object;
	}

	public function register_icon_packs() {
		do_action( 'qode_framework_action_before_icons_register' );

		$icons = apply_filters( 'qode_framework_filter_add_icon', $icons = array() );

		if ( ! empty( $icons ) ) {
			foreach ( $icons as $icon ) {
				$this->set_icons_collection( new $icon() );
			}
		}
	}

	public function render_icon( $icon, $icon_pack, $params = array() ) {
		$icon_object = $this->get_icon_object_collection_by_pack( $icon_pack );

		return ! empty( $icon_object ) ? $icon_object->render( $icon, $params ) : '';
	}

	public function enqueue_style() {
		if ( is_array( $this->icons_object_collection ) && count( $this->icons_object_collection ) ) {
			foreach ( $this->icons_object_collection as $collection_key => $collection_obj ) {
				$collection_key = apply_filters( 'qode_framework_filter_icon_pack_enqueue_handle', $collection_key );

				wp_enqueue_style( $collection_key, $collection_obj->get_style_url() );
			}
		}
	}

	public function get_formatted_icon_field_name( $name, $icon_pack, $concatenation = '_' ) {
		$concatenation_reverse = '_' == $concatenation ? '-' : $concatenation_reverse = '_';

		return $name . $concatenation . str_replace( $concatenation_reverse, $concatenation, $icon_pack );
	}

	public function get_options_icon_fields_value( $scope, $type, $field_name, $params = array(), $post_id = null, $concatenation = '_' ) {
		if ( empty( $type ) ) {
			$type = 'admin';
		}

		$icon_pack_value = qode_framework_get_option_value( $scope, $type, $field_name, '', $post_id );

		if ( ! empty( $icon_pack_value ) ) {
			$icon_value = qode_framework_get_option_value( $scope, $type, $this->get_formatted_icon_field_name( $field_name, $icon_pack_value, $concatenation ), '', $post_id );

			if ( ! empty( $icon_value ) ) {
				return $this->render_icon( $icon_value, $icon_pack_value, $params );
			}

			return '';
		}

		return '';
	}

	public function get_shortcode_icon_fields_value( $icon_pack_name, $atts, $params = array() ) {
		if ( isset( $atts[ $icon_pack_name ] ) ) {
			$shortcode_icon = $this->get_formatted_icon_field_name( $icon_pack_name, $atts[ $icon_pack_name ] );

			if ( ! empty( $atts[ $shortcode_icon ] ) ) {
				return $this->render_icon( $atts[ $shortcode_icon ], $atts[ $icon_pack_name ], $params );
			}

			return '';
		}

		return '';
	}

	public function get_specific_icon_from_pack( $icon_key, $icon_pack, $params = array() ) {
		$icon_object = $this->get_icon_object_collection_by_pack( $icon_pack );

		if ( ! empty( $icon_object ) ) {
			$specific_icons = $icon_object->get_specific_icons();

			if ( ! empty( $specific_icons ) ) {
				if ( array_key_exists( $icon_key, $specific_icons ) ) {
					return $this->render_icon( $specific_icons[ $icon_key ], $icon_pack, $params );
				}

				return '';
			}
		}

		return '';
	}
}

if ( ! function_exists( 'qode_framework_icons' ) ) {
	/**
	 * Function that initialize main framework icons object
	 */
	function qode_framework_icons() {
		return QodeFrameworkIcons::get_instance();
	}
}
