<?php if ( class_exists( 'OraisteCore_Social_Share_Shortcode' ) ) : ?>
	<div class="qodef-e-info-item qodef-e-info-social-share">
		<?php
		$params = array(
			'title' => esc_html__( 'Share:', 'oraiste' ),
		);

		echo OraisteCore_Social_Share_Shortcode::call_shortcode( $params );
		?>
	</div>
<?php endif; ?>
