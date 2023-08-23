<?php

class QodeFrameworkFieldCustomizerPanel extends QodeFrameworkFieldCustomizerType {

	function __construct( $params ) {
		parent::__construct( $params );
	}

	public function render() {
		$this->params['wp_customize']->add_panel(
			$this->params['panel'],
			array(
				'title'    => $this->title,
				'priority' => $this->priority,
			)
		);
	}
}
