<?php

class QodeFrameworkFieldAddress extends QodeFrameworkFieldType {

	public function is_map_enabled() {
		return apply_filters( 'qode_framework_filter_address_field_type_api_key_is_set', false );
	}

	public function load_assets() {
		parent::load_assets();

		if ( $this->is_map_enabled() ) {
			wp_enqueue_script( 'google-map-api' );
			wp_enqueue_script( 'geocomplete', QODE_FRAMEWORK_INC_URL_PATH . '/common/assets/plugins/geocomplete/jquery.geocomplete.min.js' );
		}
	}

	public function render_field() { ?>
		<div class="qodef-address-field-holder" data-country data-lng="<?php echo esc_attr( $this->args['longitude_field'] ); ?>" data-lat="<?php echo esc_attr( $this->args['latitude_field'] ); ?>">
			<input type="text" name="<?php echo esc_attr( $this->name ); ?>" value="<?php echo esc_attr( htmlspecialchars( $this->params['value'] ) ); ?>" class="qodef-field qodef-input qodef-address-field"/>
			<?php if ( ! $this->is_map_enabled() ) { ?>
				<p class="description"><?php esc_html_e( 'In order for the map functionality to be enabled please input the Google Map API key in the General section of the Masterds Options', 'qode-framework' ); ?></p>
			<?php } else { ?>
				<a class="qodef-reset-marker qodef-hide" href="#"><?php esc_html_e( 'Reset Marker', 'qode-framework' ); ?></a>
				<div class="qodef-map-canvas"></div>
			<?php } ?>
		</div>
		<?php
	}
}
