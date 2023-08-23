<?php

class QodeFrameworkFieldWidgetTextarea extends QodeFrameworkFieldWidgetType {

	public function render() { ?>
		<textarea class="widefat" rows="16" cols="20" id="<?php echo esc_attr( $this->params['id'] ); ?>" name="<?php echo esc_attr( $this->params['name'] ); ?>" type="text"><?php echo esc_html( $this->params['value'] ); ?></textarea>
		<?php
	}
}
