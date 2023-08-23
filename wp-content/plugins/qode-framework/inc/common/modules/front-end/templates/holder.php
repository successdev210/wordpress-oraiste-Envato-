<form method="<?php echo esc_attr( $page->get_method() ); ?>" id="<?php echo esc_attr( $page->get_form_id() ); ?>" class="qodef-front-end-form" data-action="<?php echo esc_attr( $page->get_form_action() ); ?>">
	<input type="hidden" name="qodef_form_name" value="<?php echo esc_attr( $page->get_slug() ); ?>"/>
	<div class="qodef-front-end-fields">
		<?php
		foreach ( $page->get_children() as $child ) {
			$child->render();
		}
		?>
	</div>
	<button type="submit" class="qodef-front-end-submit" <?php echo qode_framework_get_inline_attrs( $page->get_button_args() ); ?>><?php echo esc_html( $page->get_button_label() ); ?></button>
	<div class="qodef-front-end-response"></div>
	<?php wp_nonce_field( $page->get_form_nonce_name(), $page->get_form_nonce_name() ); ?>
</form>
