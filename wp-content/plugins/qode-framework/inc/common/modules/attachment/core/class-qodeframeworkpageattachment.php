<?php

class QodeFrameworkPageAttachment extends QodeFrameworkPage {

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
		$params['type']          = 'attachment';
		$params['default_value'] = isset( $params['default_value'] ) ? $params['default_value'] : '';
		qode_framework_get_framework_root()->get_attachment_options()->set_option( $params['name'], $params['default_value'], $params['field_type'] );
		parent::add_field_element( $params );
	}

	function display_field_element( $post ) {
		$fields = array();
		$render = false;

		if ( in_array( 'image', $this->get_scope(), true ) ) {
			if ( wp_attachment_is( 'image', $post->ID ) ) {
				$render = true;
			}
		} elseif ( in_array( 'audio', $this->get_scope(), true ) ) {
			if ( wp_attachment_is( 'audio', $post->ID ) ) {
				$render = true;
			}
		} elseif ( in_array( 'video', $this->get_scope(), true ) ) {
			if ( wp_attachment_is( 'video', $post->ID ) ) {
				$render = true;
			}
		}

		if ( $render ) {
			foreach ( $this->get_children() as $name => $child ) {
				$child_rendered  = $child->render( true, $post->ID );
				$fields[ $name ] = $child_rendered->form_fields;
			}
		}

		return $fields;
	}

	function save_field_element( $post, $attachment ) {
		$render = false;

		if ( in_array( 'image', $this->get_scope(), true ) ) {
			if ( wp_attachment_is( 'image', $post['ID'] ) ) {
				$render = true;
			}
		} elseif ( in_array( 'audio', $this->get_scope(), true ) ) {
			if ( wp_attachment_is( 'audio', $post['ID'] ) ) {
				$render = true;
			}
		} elseif ( in_array( 'video', $this->get_scope(), true ) ) {
			if ( wp_attachment_is( 'video', $post['ID'] ) ) {
				$render = true;
			}
		}

		if ( $render ) {
			foreach ( $this->get_children() as $name => $child ) {
				if ( isset( $attachment[ $name ] ) && trim( $attachment[ $name ] ) !== '' ) {
					update_post_meta( $post['ID'], $name, $attachment[ $name ] );
				}
			}
		}
	}
}
