<?php

class QodeFrameworkFieldTextareasvg extends QodeFrameworkFieldType {

	public function render_field() { ?>
		<textarea class="form-control qodef-field qodef--field-html" name="<?php echo esc_attr( $this->name ); ?>" rows="10"
			<?php
			if ( isset( $this->args['readonly'] ) ) {
				echo 'readonly';
			}
			?>
		><?php echo qode_framework_wp_kses_html( 'svg', $this->params['value'] ); ?></textarea>
		<?php
	}
}
