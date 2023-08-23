<?php if ( class_exists( 'OraisteCore_Social_Share_Shortcode' ) ) { ?>
	<div class="qodef-e qodef-info--social-share">
		<?php
		$params = array(
			'title'  => esc_html__( 'Share:', 'oraiste-core' ),
			'layout' => 'text',
		);

		echo OraisteCore_Social_Share_Shortcode::call_shortcode( $params );
		?>
	</div>
<?php } ?>
