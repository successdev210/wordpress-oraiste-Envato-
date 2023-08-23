<?php

class QodeFrameworkFieldNavMenuSelect extends QodeFrameworkFieldNavMenuType {

	function __construct( $params ) {
		parent::__construct( $params );
	}

	public function render() {
		?>
		<p class="description description-<?php echo esc_attr( $this->params['width'] ); ?> <?php echo esc_attr( $this->params['class'] ); ?>" <?php echo qode_framework_get_inline_attrs( $this->params['dependency_data'], true ); ?>>
			<label for="<?php echo esc_attr( $this->params['id'] ); ?>"><?php echo esc_html( $this->title ); ?><br/>
				<select type="text" id="<?php echo esc_attr( $this->params['id'] ); ?>" class="widefat qodef-menu-item-field <?php echo esc_attr( $this->params['id'] ); ?>" data-option-type="selectbox" data-option-name="<?php echo esc_attr( $this->params['field_name'] ); ?>" name="<?php echo esc_attr( $this->params['field_name'] ); ?>">
					<?php
					foreach ( $this->options as $key => $label ) {
						$selected = $this->params['value'] == $key ? ' selected="selected"' : '';
						?>
						<option <?php echo esc_attr( $selected ); ?> value="<?php echo esc_attr( $key ); ?>">
							<?php echo esc_html( $label ); ?>
						</option>
					<?php } ?>
				</select>
				<span class="description"><?php echo esc_html( $this->description ); ?></span>
			</label>
		</p>
		<?php
	}
}
