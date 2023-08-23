<?php

class QodeFrameworkFieldCustomizerControl extends QodeFrameworkFieldCustomizerType {

	function __construct( $params ) {
		parent::__construct( $params );
	}

	public function render() {
		$this->params['wp_customize']->add_control(
			$this->name,
			array(
				'section'  => $this->section,
				'settings' => $this->settings,
				'type'     => $this->option_type,
				'label'    => $this->title,
			)
		);
	}
}
