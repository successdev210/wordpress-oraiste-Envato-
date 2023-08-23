<?php

class QodeFrameworkFieldWPCheckbox extends QodeFrameworkFieldWPType {

	public function render_field() { ?>
		<?php
		if ( is_array( $this->options ) && count( $this->options ) ) {
			$values = $this->params['value'];
			?>
			<div class="qodef-checkbox-group-holder">
				<?php foreach ( $this->options as $key => $label ) : ?>
					<?php
					if ( '' !== $label ) {
						$checked = is_array( $values ) && in_array( is_int( $key ) ? (string) $key : $key, $values, true ) ? 'checked' : '';
						$id      = esc_attr( $this->params['id'] ) . '-' . esc_attr( $key );
						?>
						<div class="qodef-inline">
							<input <?php echo esc_attr( $checked ); ?> type="checkbox" id="<?php echo esc_attr( $this->params['id'] ) . '-' . esc_attr( $key ); ?>" value="<?php echo esc_attr( $key ); ?>" name="<?php echo esc_attr( $this->name . '[]' ); ?>"/>
							<label for="<?php echo esc_attr( $id ); ?>">
								<?php echo esc_html( $label ); ?>
							</label>
						</div>
						<?php
					}
				endforeach;
				?>
			</div>
			<?php
		}
	}
}
