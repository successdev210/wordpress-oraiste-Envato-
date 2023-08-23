<?php

class QodeFrameworkFieldNavMenuText extends QodeFrameworkFieldNavMenuType {

	function __construct( $params ) {
		parent::__construct( $params );
	}

	public function render() {
		?>
		<p class="description description-wide <?php echo esc_attr( $this->params['class'] ); ?>">
			<label for="<?php echo esc_attr( $this->params['id'] ); ?>"><?php echo esc_html( $this->title ); ?><br/>
				<input type="text" id="<?php echo esc_attr( $this->params['id'] ); ?>" class="widefat <?php echo esc_attr( $this->params['id'] ); ?>" name="<?php echo esc_attr( $this->params['field_name'] ); ?>" value="<?php echo esc_attr( $this->params['value'] ); ?>"/>
				<span class="description"><?php echo esc_html( $this->description ); ?></span>
			</label>
		</p>
		<?php
	}
}
