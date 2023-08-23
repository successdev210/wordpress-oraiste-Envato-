<?php

class QodeFrameworkFieldMapper implements QodeFrameworkChildInterface {

	public $params;
	public $name;
	public $type;

	function __construct( $params ) {
		$this->params = isset( $params ) ? $params : array();
		$this->name   = $params['name'];
		$this->type   = $params['type'];
	}

	public function get_name() {
		return $this->name;
	}

	public function render( $return = false, $post_id = null ) {
		if ( 'taxonomy' === $this->type || 'user' === $this->type ) {
			$class = 'QodeFrameworkFieldWP' . ucfirst( $this->params['field_type'] );
		} elseif ( 'attachment' === $this->type ) {
			$class = 'QodeFrameworkFieldAttachment' . ucfirst( $this->params['field_type'] );
		} elseif ( 'nav-menu' === $this->type ) {
			$class = 'QodeFrameworkFieldNavMenu' . ucfirst( $this->params['field_type'] );
		} elseif ( 'widget' === $this->type ) {
			$class = 'QodeFrameworkFieldWidget' . ucfirst( $this->params['field_type'] );
		} elseif ( 'customizer' === $this->type ) {
			$class = 'QodeFrameworkFieldCustomizer' . ucfirst( $this->params['field_type'] );
		} else {
			$class = 'QodeFrameworkField' . ucfirst( $this->params['field_type'] );
		}

		$class = apply_filters( 'qode_framework_filter_field_mapping', $class, $post_id );

		if ( class_exists( $class ) ) {
			$this->params['post_id'] = $post_id;

			if ( $return ) {
				return new $class( $this->params );
			} else {
				new $class( $this->params );
			}
		}

		return $return;
	}
}
