<?php

class QodeFrameworkFieldCheckbox extends QodeFrameworkFieldType {

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
						?>
						<div class="qodef-inline">
							<input class="qodef-field" <?php echo esc_attr( $checked ); ?> type="checkbox" id="<?php echo esc_attr( $this->name . $key ); ?>" value="<?php echo esc_attr( $key ); ?>" name="<?php echo esc_attr( $this->name . '[]' ); ?>" />
							<label for="<?php echo esc_attr( $this->name . $key ); ?>">
								<span class="qodef-label-view"></span>
								<span class="qodef-label-text">
									<?php echo esc_html( $label ); ?>
								</span>
							</label>
						</div>
						<?php
					}
				endforeach;
				?>
				<!-- Needed for font weight and fonts group of option in order to save empty value -->
				<div class="qodef-inline qodef-hide">
					<label>
						<input checked type="checkbox" value="" name="<?php echo esc_attr( $this->name . '[]' ); ?>">
					</label>
				</div>
			</div>
			<?php
		}
	}
}
