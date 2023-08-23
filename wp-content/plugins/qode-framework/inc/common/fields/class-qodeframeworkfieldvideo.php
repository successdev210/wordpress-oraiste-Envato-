<?php

class QodeFrameworkFieldVideo extends QodeFrameworkFieldType {

	public function render_field() { ?>
		<?php $has_image = ! empty( $this->params['value'] ) ? true : false; ?>
		<div class="qodef-image-uploader" data-file="no" data-allowed-type='<?php echo esc_attr( $this->args['allowed_type'] ); ?>'>
			<div class="qodef-image-thumb<?php echo ! $has_image ? 'qodef-hide' : ''; ?>" style="width: 100px">
            <?php
                if ( '' !== $this->params['value'] ) {
                    $video_src = wp_get_attachment_url( $this->params['value'] );
                    ?>
                    <video class="qodef-file-video" src="<?php echo esc_url( $video_src ); ?>" controls></video>
                    <div class="qodef-file-name"><?php echo basename( get_attached_file( $this->params['value'] ) ); ?></div>
            <?php } ?>
			</div>
			<div class="qodef-image-meta-fields qodef-hide" >
				<input type="hidden" class="qodef-field qodef-image-upload-id" name="<?php echo esc_attr( $this->name ); ?>" value="<?php echo esc_attr( $this->params['value'] ); ?>"/>
			</div>
			<a class="qodef-video-upload-btn" href="javascript:void(0)" data-frame-title="<?php esc_attr_e( 'Select File', 'qode-framework' ); ?>" data-frame-button-text="<?php esc_attr_e( 'Select File', 'qode-framework' ); ?>"><?php esc_html_e( 'Upload', 'qode-framework' ); ?></a>
			<a href="javascript: void(0)" class="qodef-image-remove-btn qodef-hide"><?php esc_html_e( 'Remove', 'qode-framework' ); ?></a>
		</div>
		<?php
	}
}
