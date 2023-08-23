<?php

class QodeFrameworkFieldCustomizerSection extends QodeFrameworkFieldCustomizerType {

	function __construct( $params ) {
		parent::__construct( $params );
	}

	public function render() {
		$this->params['wp_customize']->add_section(
			$this->name,
			array(
				'panel'       => $this->params['panel'],
				'priority'    => $this->priority,
				'title'       => $this->title,
				'description' => $this->description,
			)
		);
	}
}
