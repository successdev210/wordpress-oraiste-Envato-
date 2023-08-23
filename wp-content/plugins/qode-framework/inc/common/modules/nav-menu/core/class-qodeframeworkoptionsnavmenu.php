<?php

class QodeFrameworkOptionsNavMenu extends QodeFrameworkOptions {

	protected static $fields = array();

	public function __construct() {
		parent::__construct();

		add_filter( 'wp_edit_nav_menu_walker', array( $this, 'nav_menu_filter_walker' ), 10, 2 );
		add_action( 'init', array( $this, 'init_nav_menu_fields' ) );
		add_action( 'wp_nav_menu_item_custom_fields', array( $this, 'add_nav_menu_custom_fields' ), 11, 4 );
		add_action( 'wp_update_nav_menu_item', array( $this, 'save_nav_menu_custom_fields' ), 10, 3 );
		add_filter( 'manage_nav-menus_columns', array( $this, 'add_nav_menu_columns' ), 99 );

		add_action( 'admin_enqueue_scripts', array( $this, 'load_nav_menu_options_assets' ), 5 ); // 5 is set to be same permission as Gutenberg plugin have
	}

	function nav_menu_filter_walker( $walker, $menu_id ) {
		// Compatibility function for wordpress lover than 5.4. Should remove in some moment
		if ( version_compare( $GLOBALS['wp_version'], '5.4' ) < 0 ) {
			$walker = 'QodeFrameworkMenuCustomFieldsWalker';
			if ( ! class_exists( $walker ) ) {
				require_once QODE_FRAMEWORK_INC_PATH . '/common/modules/nav-menu/core/class-qodeframeworkmenucustomfieldswalker.php';
			}
		}

		return $walker;
	}

	function init_nav_menu_fields() {
		do_action( 'qode_framework_action_custom_nav_menu_fields' );
	}

	function add_nav_menu_custom_fields( $id, $item, $depth, $args ) {

		foreach ( $this->get_child_elements() as $key => $child ) {
			$child->display_field_element( $item, $depth );
		}
	}

	function save_nav_menu_custom_fields( $menu_id, $menu_item_db_id, $menu_item_args ) {
		foreach ( $this->get_child_elements() as $child ) {
			$child->save_field_element( $menu_id, $menu_item_db_id, $menu_item_args );
		}
	}

	function add_nav_menu_columns( $columns ) {
		$additional_columns = array();

		foreach ( $this->get_child_elements() as $key => $child ) {
			$additional_columns = $child->add_field_columns();
		}
		$columns = array_merge( $columns, $additional_columns );

		return $columns;
	}

	function load_nav_menu_options_assets( $hook ) {
		if ( 'nav-menus.php' === $hook ) {
			wp_enqueue_script( 'qode-framework-nav-menu', QODE_FRAMEWORK_INC_URL_PATH . '/common/modules/nav-menu/assets/js/nav-menu.js' );
		}
	}
}
