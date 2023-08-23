<?php

class QodeFrameworkCustomPostTypes {

	private $custom_post_types;

	public function __construct() {

		$this->custom_post_types = array();

		add_action( 'init', array( $this, 'register' ), 0 );

		add_action( 'admin_init', array( $this, 'handle_permalink_save' ) );
	}

	public function get_custom_post_types() {
		return $this->custom_post_types;
	}

	public function get_custom_post_type( $base ) {
		return $this->custom_post_types[ $base ];
	}

	private function set_custom_post_type( QodeFrameworkCustomPostType $custom_post_type ) {
		$key                             = $custom_post_type->get_base();
		$this->custom_post_types[ $key ] = $custom_post_type;
	}

	public function custom_post_type_exists( $base ) {
		return array_key_exists( $base, $this->custom_post_types );
	}

	public function add_custom_post_type( QodeFrameworkCustomPostType $custom_post_type ) {
		if ( '' !== $custom_post_type->get_base() ) {
			$this->set_custom_post_type( $custom_post_type );

			return $custom_post_type;
		}

		return false;
	}

	public function register() {

		do_action( 'qode_framework_action_before_post_types_register' );

		foreach ( $this->custom_post_types as $custom_post_type ) {
			$custom_post_type->register();
		}

		flush_rewrite_rules();

		do_action( 'qode_framework_action_after_post_types_register' );
	}

	public function handle_permalink_save() {
		if ( isset( $_POST['permalink_structure'] ) && wp_verify_nonce( wp_unslash( $_POST['_wpnonce'] ), 'update-permalink' ) ) { // WPCS: input var ok, sanitization ok.

			$permalinks      = (array) get_option( 'qode_framework_permalinks', array() );
			$mods_to_rewrite = $this->custom_post_types;

			foreach ( $this->custom_post_types as $post_type ) {
				$post_type_taxonomies = $post_type->get_taxonomies();
				if ( ! empty( $post_type_taxonomies ) ) {
					$mods_to_rewrite = array_merge( $mods_to_rewrite, $post_type_taxonomies );
				}
			}

			foreach ( $mods_to_rewrite as $mod ) {
				$name = $mod->get_slug_setting_name();
				if ( isset( $_POST[ $name ] ) ) {
					$permalinks[ $name ] = wp_unslash( $_POST[ $name ] );
				}
			}

			update_option( 'qode_framework_permalinks', $permalinks );
		}
	}
}
