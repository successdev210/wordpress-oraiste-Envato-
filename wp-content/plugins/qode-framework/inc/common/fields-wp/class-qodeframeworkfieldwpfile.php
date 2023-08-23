<?php

class QodeFrameworkFieldWPFile extends QodeFrameworkFieldWPType {

	public function render_field() { ?>
		<?php
		$has_image = ! empty( $this->params['value'] ) ? true : false;
		?>
		<div class="qodef-image-uploader" data-file="yes" data-allowed-type="<?php echo esc_attr( $this->args['allowed_type'] ); ?>">
			<div class="qodef-image-thumb <?php echo ! $has_image ? 'qodef-hide' : ''; ?>">
				<?php
				if ( '' !== $this->params['value'] ) {
					$image_src = wp_get_attachment_image_src( $this->params['value'], 'full', true );
					?>
					<img class="qodef-file-image" src="<?php echo esc_url( $image_src[0] ); ?>" alt="<?php esc_attr_e( 'File Thumbnail', 'qode-framework' ); ?>"/>
					<div><?php echo basename( get_attached_file( $this->params['value'] ) ); ?></div>
				<?php } ?>
			</div>
			<div class="qodef-image-meta-fields qodef-hide">
				<input type="hidden" class="qodef-image-upload-id" name="<?php echo esc_attr( $this->name ); ?>" value="<?php echo esc_attr( $this->params['value'] ); ?>"/>
			</div>
			<a class="qodef-image-upload-btn" href="javascript:void(0)" data-frame-title="<?php esc_attr_e( 'Select File', 'qode-framework' ); ?>" data-frame-button-text="<?php esc_attr_e( 'Select File', 'qode-framework' ); ?>"><?php esc_html_e( 'Upload', 'qode-framework' ); ?></a>
			<a href="javascript: void(0)" class="qodef-image-remove-btn qodef-hide"><?php esc_html_e( 'Remove', 'qode-framework' ); ?></a>
		</div>
		<?php
	}
}
