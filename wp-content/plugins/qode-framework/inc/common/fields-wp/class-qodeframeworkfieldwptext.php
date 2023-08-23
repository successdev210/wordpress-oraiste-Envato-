<?php

class QodeFrameworkFieldWPText extends QodeFrameworkFieldWPType {

	function __construct( $params ) {
		$params['input_class'] = 'taxonomy' === $params['type'] ? 'taxonomy-text' : 'regular-text';
		parent::__construct( $params );
	}

	public function render_field() { ?>
		<input type="text" name="<?php echo esc_attr( $this->name ); ?>" id="<?php echo esc_attr( $this->params['id'] ); ?>" value="<?php echo esc_attr( $this->params['value'] ); ?>" class="<?php echo esc_attr( $this->params['input_class'] ); ?>">
		<?php
	}
}
