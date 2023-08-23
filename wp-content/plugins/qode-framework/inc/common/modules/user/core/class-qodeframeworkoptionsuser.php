<?php

class QodeFrameworkOptionsUser extends QodeFrameworkOptions {

	public function __construct() {
		parent::__construct();

		add_action( 'init', array( $this, 'init_user_fields' ) );
		add_action( 'show_user_profile', array( $this, 'user_fields_display' ) );
		add_action( 'edit_user_profile', array( $this, 'user_fields_display' ) );
		add_action( 'personal_options_update', array( $this, 'save_user_fields' ) );
		add_action( 'edit_user_profile_update', array( $this, 'save_user_fields' ) );

		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_framework_user_scripts' ), 5 ); // 5 is set to be same permission as Gutenberg plugin have
	}

	function init_user_fields() {
		do_action( 'qode_framework_action_custom_user_fields' );
	}

	function user_fields_display( $user ) {
		$params                = array();
		$params['this_object'] = $this;
		$params['roles']       = $user->roles;
		qode_framework_template_part( QODE_FRAMEWORK_INC_PATH, 'common', 'modules/user/templates/holder', '', $params );
	}

	function save_user_fields( $user_id ) {
		foreach ( $this->get_options() as $key => $value ) {
			$value = array_key_exists( $key, $_POST ) ? $_POST[ $key ] : '';

			if ( ( '0' === $value || ! empty( $value ) ) && '' !== trim( $value ) ) {
				update_user_meta( $user_id, $key, sanitize_text_field( $value ) );
			} else {
				delete_user_meta( $user_id, $key );
			}
		}
	}

	function enqueue_framework_user_scripts( $hook ) {
		if ( 'profile.php' === $hook || 'user-edit.php' === $hook ) {
			$this->enqueue_dashboard_framework_scripts();
		}
	}
}
