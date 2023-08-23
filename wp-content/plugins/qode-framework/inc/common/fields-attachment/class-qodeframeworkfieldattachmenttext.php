<?php

class QodeFrameworkFieldAttachmentText extends QodeFrameworkFieldAttachmentType {

	function __construct( $params ) {
		parent::__construct( $params );
	}

	public function render() {
		$html = '<input type="text" name="' . esc_attr( $this->name ) . '" value="' . esc_attr( $this->params['value'] ) . '">';

		$this->form_fields['html'] = $html;
	}
}
