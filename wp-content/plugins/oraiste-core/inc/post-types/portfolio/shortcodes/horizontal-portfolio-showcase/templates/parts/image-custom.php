<?php

if ( ! empty( $custom_image ) ) { ?>
	<div class="qodef-e-custom-image">
		<?php echo wp_get_attachment_image( $custom_image, 'full' ); ?>
	</div>
	<?php
}
