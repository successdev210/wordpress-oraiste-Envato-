<?php

class QodeFrameworkFieldIcon extends QodeFrameworkFieldType {

	function __construct( $params ) {
		$select_class = '';
		if ( isset( $params['args'] ) && isset( $params['args']['select2'] ) && true == $params['args']['select2'] ) {
			$select_class = 'qodef-select2';
		}
		if ( isset( $params['title'] ) && 'Material Icons' == $params['title'] ) { // Material Icons won't show with fontIconPicker script because of HTML structure. We need to trigger select2 script
			$select_class = 'qodef-select2';
		}
		$params['select_class'] = $select_class;

		parent::__construct( $params );
	}

	public function render_field() { ?>
		<select class="qodef-iconpicker-select <?php echo esc_attr( $this->params['select_class'] ); ?> qodef-field" name="<?php echo esc_attr( $this->name ); ?>" data-option-name="<?php echo esc_attr( $this->name ); ?>" data-option-type="selectbox">
				<?php
				foreach ( $this->options as $key => $label ) {
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
					<?php echo esc_html( $label ); ?>
				</option>
			<?php } ?>
		</select>
		<?php
	}
}
