<?php

class QodeFrameworkPageNavMenu extends QodeFrameworkPage {

	function __construct( $params ) {
		parent::__construct( $params );
	}

	function add_tab_element( $params ) {
		throw new BadMethodCallException();
	}

	function add_section_element( $params ) {
		throw new BadMethodCallException();
	}

	function add_row_element( $params ) {
		throw new BadMethodCallException();
	}

	function add_repeater_element( $params ) {
		throw new BadMethodCallException();
	}

	function add_field_element( $params ) {
		$params['type']          = 'nav-menu';
		$params['default_value'] = isset( $params['default_value'] ) ? $params['default_value'] : '';
		qode_framework_get_framework_root()->get_nav_menu_options()->set_option( $params['name'], $params['default_value'], $params['field_type'] );
		parent::add_field_element( $params );

		if ( 'iconpack' === $params['field_type'] ) {

			$params_icon = array(
				'type'       => 'nav-menu',
				'name'       => $params['name'] . '-icon',
				'field_type' => 'icon',
				'title'      => esc_html__( 'Icon', 'qode-framework' ),
				'options'    => array(),
				'args'       => array(
					'width' => 'thin',
				),
			);

			qode_framework_get_framework_root()->get_nav_menu_options()->set_option( $params['name'] . '-icon', '', 'icon' );

			parent::add_field_element( $params_icon );
		}
	}

	function display_field_element( $item, $depth ) {

		foreach ( $this->get_children() as $name => $child ) {
			if ( isset( $child->params['args']['depth'] ) ) {
				if ( $child->params['args']['depth'] == $depth ) {
					$child->render( false, $item->ID );
				}
			} else {
				$child->render( false, $item->ID );
			}
		}
	}

	function save_field_element( $menu_id, $menu_item_db_id, $menu_item_args ) {
		if ( defined( 'DOING_AJAX' ) && DOING_AJAX ) {
			return;
		}

		$children = $this->get_children();
		if ( ! empty( $children ) ) {
			foreach ( $this->get_children() as $name => $child ) {
				$key   = esc_attr( sprintf( 'menu-item-%s', $name ) );
				$value = null;

				if ( isset( $_POST[ $key ][ $menu_item_db_id ] ) && ! empty( $_POST[ $key ][ $menu_item_db_id ] ) ) {
					$value = $_POST[ $key ][ $menu_item_db_id ];
				}

				if ( ! is_null( $value ) ) {
					update_post_meta( $menu_item_db_id, $key, $value );
				} else {
					delete_post_meta( $menu_item_db_id, $key );
				}
			}
		}
	}

	function add_field_columns() {
		$additional_columns = array();
		foreach ( $this->get_children() as $name => $child ) {
			$additional_columns[ $name ] = $child->params['title'];
		}

		return $additional_columns;
	}
}
