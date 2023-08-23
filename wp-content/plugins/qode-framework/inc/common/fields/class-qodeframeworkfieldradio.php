<?php

class QodeFrameworkFieldRadio extends QodeFrameworkFieldType {

	public function render_field() { ?>
		<?php
		$use_images = isset( $this->args['images'] ) && $this->args['images'] ? true : false;
		if ( is_array( $this->options ) && count( $this->options ) ) {
			?>
			<div class="qodef-radio-group-holder qodef-field
			<?php
			if ( $use_images ) {
				echo ' qodef-with-images';
			}
			?>
			" data-option-name="<?php echo esc_attr( $this->name ); ?>" data-option-type="radiogroup">
				<?php
				foreach ( $this->options as $key => $value ) {
					$checked = $this->params['value'] == $key ? 'checked' : '';
					$label   = $use_images ? $value['label'] : $value;
					?>
					<div class="qodef-inline">
						<?php if ( ! $use_images ) { ?>
							<input class="qodef-field" <?php echo esc_attr( $checked ); ?> type="radio" id="<?php echo esc_attr( $this->name . $key ); ?>" name="<?php echo esc_attr( $this->name ); ?>" value="<?php echo esc_attr( $key ); ?>">
							<?php if ( ! empty( $label ) ) { ?>
								<label for="<?php echo esc_attr( $this->name . $key ); ?>">
									<span class="qodef-label-view"></span>
									<span class="qodef-label-text">
									<?php echo esc_html( $label ); ?>
								</span>
								</label>
							<?php } ?>
						<?php } else { ?>
							<label for="<?php echo esc_attr( $this->name . $key ); ?>">
								<input class="qodef-field" <?php echo esc_attr( $checked ); ?> type="radio" id="<?php echo esc_attr( $this->name . $key ); ?>" name="<?php echo esc_attr( $this->name ); ?>" value="<?php echo esc_attr( $key ); ?>">
								<img title="
								<?php
								if ( ! empty( $label ) ) {
									echo esc_attr( $label );
								}
								?>
								" src="<?php echo esc_url( $value['image'] ); ?>" alt="<?php echo esc_attr( $key . ' image' ); ?>"/>
							</label>
						<?php } ?>
					</div>
				<?php } ?>
			</div>
			<?php
		}
	}
}
