<?php

class QodeFrameworkFieldImage extends QodeFrameworkFieldType {

	public function render_field() { ?>
		<?php $has_image = ! empty( $this->params['value'] ); ?>
		<div class="qodef-image-uploader" data-file="no" data-multiple="<?php echo esc_attr( $this->multiple ); ?>">
			<div class="qodef-image-thumb <?php echo ! $has_image ? 'qodef-hide' : ''; ?>">
				<?php if ( 'yes' == $this->multiple ) { ?>
					<ul class="clearfix">
						<?php
						if ( '' !== $this->params['value'] ) {
							$images_array = explode( ',', $this->params['value'] );
							foreach ( $images_array as $image_id ) :
								$image_src = wp_get_attachment_image_src( $image_id, 'thumbnail', false );
								echo '<li ><img src="' . esc_url( $image_src[0] ) . '" alt="' . esc_attr__( 'Image Thumbnail', 'qode-framework' ) . '" /></li>';
							endforeach;
						}
						?>
					</ul>
					<?php
				} elseif ( '' !== $this->params['value'] ) {
					$image     = wp_get_attachment_image_src( $this->params['value'], 'thumbnail', false );
					$image_src = ! empty( $image ) ? $image[0] : $this->params['value'];
					?>
					<img class="qodef-single-image" src="<?php echo esc_url( $image_src ); ?>" alt="<?php esc_attr_e( 'Image Thumbnail', 'qode-framework' ); ?>"/>
					<?php
				}
				?>
			</div>
			<div class="qodef-image-meta-fields qodef-hide">
				<input type="hidden" class="qodef-field qodef-image-upload-id" name="<?php echo esc_attr( $this->name ); ?>" value="<?php echo esc_attr( $this->params['value'] ); ?>"/>
			</div>
			<a class="qodef-image-upload-btn" href="javascript:void(0)" data-frame-title="<?php esc_attr_e( 'Select Image', 'qode-framework' ); ?>" data-frame-button-text="<?php esc_attr_e( 'Select Image', 'qode-framework' ); ?>"><?php esc_html_e( 'Upload', 'qode-framework' ); ?></a>
			<a href="javascript: void(0)" class="qodef-image-remove-btn qodef-hide"><?php esc_html_e( 'Remove', 'qode-framework' ); ?></a>
		</div>
		<?php
	}
}
