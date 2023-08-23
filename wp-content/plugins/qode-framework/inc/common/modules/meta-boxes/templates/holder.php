<div class="qodef-meta-box">
	<div class="qodef-meta-box-holder">
		<?php $metabox['args']['box']->render(); ?>
		<?php
		wp_nonce_field(
			'qode_framework_meta_box_' . $metabox['args']['box']->get_slug() . '_save',
			'qode_framework_meta_box_' . $metabox['args']['box']->get_slug() . '_save'
		);
		?>
	</div>
</div>
