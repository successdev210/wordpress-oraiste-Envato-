<?php

class QodeFrameworkFieldWPRadio extends QodeFrameworkFieldWPType {

	public function render_field() { ?>
		<?php
		$use_images   = isset( $this->args['images'] ) && $this->args['images'] ? true : false;
		$holder_class = $use_images ? 'qodef-with-images' : '';
		?>
		<?php if ( is_array( $this->options ) && count( $this->options ) ) { ?>
			<div class="qodef-radio-group-holder <?php echo esc_attr( $holder_class ); ?>" data-option-name="<?php echo esc_attr( $this->name ); ?>" data-option-type="radiogroup">
				<?php
				foreach ( $this->options as $key => $value ) {
					$checked = $this->params['value'] == $key ? 'checked' : '';
					$label   = $use_images ? $value['label'] : $value;
					$id      = $this->params['id'] . '-' . esc_attr( $key );
					?>
					<label class="qodef-inline">
						<input <?php echo esc_attr( $checked ); ?> type="radio" name="<?php echo esc_attr( $this->name ); ?>" value="<?php echo esc_attr( $key ); ?>" id="<?php echo esc_attr( $id ); ?>"/>
						<?php if ( ! empty( $label ) && ! $use_images ) { ?>
							<label for="<?php echo esc_attr( $id ); ?>">
								<?php echo esc_attr( $label ); ?>
							</label>
						<?php } ?>
						<?php if ( $use_images ) { ?>
							<img title="
							<?php
							if ( ! empty( $label ) ) {
								echo esc_attr( $label );
							}
							?>
							" src="<?php echo esc_url( $value['image'] ); ?>" alt="<?php echo esc_attr( $key . 'image' ); ?>"/>
						<?php } ?>
					</label>
				<?php } ?>
			</div>
			<?php
		}
	}
}
