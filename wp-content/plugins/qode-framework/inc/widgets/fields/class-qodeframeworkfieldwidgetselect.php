<?php

class QodeFrameworkFieldWidgetSelect extends QodeFrameworkFieldWidgetType {

	public function render() { ?>
		<select class="qodef-widget-field widefat" id="<?php echo esc_attr( $this->params['id'] ); ?>" data-option-type="selectbox" data-option-name="<?php echo esc_attr( $this->params['name'] ); ?>" name="<?php echo esc_attr( $this->params['name'] ); ?>">
			<?php
			foreach ( $this->options as $option_key => $option_value ) {
				$option_selected = '';
				if ( $this->params['value'] == $option_key ) {
					$option_selected = 'selected';
				}
				?>
				<option <?php echo esc_attr( $option_selected ); ?> value="<?php echo esc_attr( $option_key ); ?>">
					<?php echo esc_attr( $option_value ); ?>
				</option>
			<?php } ?>
		</select>
		<?php
	}
}
