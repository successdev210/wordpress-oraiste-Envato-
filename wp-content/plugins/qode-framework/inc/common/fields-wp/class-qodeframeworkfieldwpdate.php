<?php

class QodeFrameworkFieldWPDate extends QodeFrameworkFieldWPType {

	public function load_assets() {
		parent::load_assets();

		wp_enqueue_script( 'jquery-ui-datepicker' );
	}

	public function render_field() { ?>
		<input type="text" class="qodef-datepicker" name="<?php echo esc_attr( $this->name ); ?>" id="<?php echo esc_attr( $this->params['id'] ); ?>" value="<?php echo esc_attr( $this->params['value'] ); ?>" autocomplete="off" readonly />
		<?php
	}
}
