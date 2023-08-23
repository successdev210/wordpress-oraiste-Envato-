<?php

class QodeFrameworkFieldIconpack extends QodeFrameworkFieldType {

	function __construct( $params ) {
		$select_class = 'qodef-select2';
		if ( isset( $params['args'] ) && isset( $params['args']['select2'] ) && false == $params['args']['select2'] ) {
			$select_class = '';
		}
		$params['select_class'] = $select_class;
		$params['icons_object'] = qode_framework_icons();
		$params['icon_packs']   = $params['icons_object']->get_icon_packs();

		parent::__construct( $params );
	}

	public function render_field() { ?>
		<select class="<?php echo esc_attr( $this->params['select_class'] ); ?> qodef-field" name="<?php echo esc_attr( $this->name ); ?>" data-option-name="<?php echo esc_attr( $this->name ); ?>" data-option-type="selectbox">
			<option value="">
				<?php echo esc_html__( 'Select Icon Pack', 'qode-framework' ); ?>
			</option>
			<?php
			foreach ( $this->params['icon_packs'] as $key => $label ) {
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
