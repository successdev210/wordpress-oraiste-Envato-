<?php

class QodeFrameworkFieldWPSelect extends QodeFrameworkFieldWPType {

	function __construct( $params ) {
		$select_class = 'no-select2';
		if ( isset( $params['args'] ) && isset( $params['args']['select2'] ) && true == $params['args']['select2'] ) {
			$select_class = 'select2';
		}
		$type_class             = 'taxonomy' === $params['type'] ? 'postform' : '';
		$select_class          .= ' ' . $type_class;
		$params['select_class'] = $select_class;
		parent::__construct( $params );
	}

	public function render_field() { ?>
		<select name="<?php echo esc_attr( $this->name ); ?>" class="<?php echo esc_attr( $this->params['select_class'] ); ?> qodef-field" id="<?php echo esc_attr( $this->params['id'] ); ?>" data-option-name="<?php echo esc_attr( $this->name ); ?>" data-option-type="selectbox">
				<?php
				foreach ( $this->options as $key => $value ) {
					if ( '-1' == $key ) {
						$key = '';
					}
					?>
				<option
					<?php
					if ( $this->params['value'] == $key ) {
						echo " selected='selected'";
					}
					?>
						 value="<?php echo esc_attr( $key ); ?>">
					<?php echo esc_html( $value ); ?>
				</option>
			<?php } ?>
		</select>
		<?php
	}
}
