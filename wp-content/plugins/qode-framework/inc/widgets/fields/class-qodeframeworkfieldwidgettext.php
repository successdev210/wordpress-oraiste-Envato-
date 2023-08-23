<?php

class QodeFrameworkFieldWidgetText extends QodeFrameworkFieldWidgetType {

	public function render() { ?>
		<input class="widefat" id="<?php echo esc_attr( $this->params['id'] ); ?>" name="<?php echo esc_attr( $this->params['name'] ); ?>" type="text" value="<?php echo esc_attr( $this->params['value'] ); ?>"/>
		<?php
	}
}
