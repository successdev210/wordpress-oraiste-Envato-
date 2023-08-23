<?php

class QodeFrameworkFieldWPYesNo extends QodeFrameworkFieldWPType {

	public function render_field() { ?>
		<div class="qodef-yesno qodef-field" data-option-name="<?php echo esc_attr( $this->name ); ?>" data-option-type="yesno">
			<input type="radio" id="<?php echo esc_attr( $this->params['id'] ); ?>-yes" name="<?php echo esc_attr( $this->name ); ?>" value="yes" <?php echo 'yes' === esc_attr( $this->params['value'] ) ? 'checked' : ''; ?>/>
			<label for="<?php echo esc_attr( $this->name ); ?>-yes">
				<?php esc_html_e( 'Yes', 'qode-framework' ); ?>
			</label>
			<input type="radio" id="<?php echo esc_attr( $this->params['id'] ); ?>-no" name="<?php echo esc_attr( $this->name ); ?>" value="no" <?php echo 'no' === esc_attr( $this->params['value'] ) ? 'checked' : ''; ?>/>
			<label for="<?php echo esc_attr( $this->name ); ?>-no">
				<?php esc_html_e( 'No', 'qode-framework' ); ?>
			</label>
		</div>
		<?php
	}
}
