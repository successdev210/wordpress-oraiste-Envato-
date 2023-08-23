<?php

class QodeFrameworkFieldWPTextarea extends QodeFrameworkFieldWPType {

	public function render_field() { ?>
		<textarea name="<?php echo esc_attr( $this->name ); ?>" id="<?php echo esc_attr( $this->params['id'] ); ?>" rows="5"><?php echo esc_html( $this->params['value'] ); ?></textarea>
		<?php
	}
}
