<?php

class QodeFrameworkFieldWidgetImage extends QodeFrameworkFieldWidgetType {

	public function render() { ?>
		<span class="qodef-image-uploader" data-file="no">
			<span class="qodef-image-thumb">
				<?php
				if ( '' !== $this->params['value'] ) {
					$image     = wp_get_attachment_image_src( $this->params['value'], 'thumbnail', false );
					$image_src = ! empty( $image ) ? $image[0] : $this->params['value'];
					?>
					<img class="qodef-single-image" src="<?php echo esc_url( $image_src ); ?>" alt="<?php esc_attr_e( 'Image Thumbnail', 'qode-framework' ); ?>"/>
				<?php } ?>
			</span>
			<span class="qodef-image-meta-fields qodef-hide">
				<input type="hidden" class="qodef-field qodef-image-upload-id" id="<?php echo esc_attr( $this->params['id'] ); ?>" name="<?php echo esc_attr( $this->params['name'] ); ?>" value="<?php echo esc_attr( $this->params['value'] ); ?>"/>
			</span>
			<a class="button button-secondary qodef-image-upload-btn" href="javascript:void(0)" data-frame-title="<?php esc_attr_e( 'Select Image', 'qode-framework' ); ?>" data-frame-button-text="<?php esc_attr_e( 'Select Image', 'qode-framework' ); ?>"><?php esc_html_e( 'Upload', 'qode-framework' ); ?></a>
			<a href="javascript: void(0)" class="button button-secondary qodef-image-remove-btn qodef-hide"><?php esc_html_e( 'Remove', 'qode-framework' ); ?></a>
		</span>
		<?php
	}
}
