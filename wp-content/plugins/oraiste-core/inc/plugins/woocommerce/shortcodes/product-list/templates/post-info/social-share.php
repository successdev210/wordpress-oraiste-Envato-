<?php if ( class_exists( 'OraisteCore_Social_Share_Shortcode' ) ) { ?>
	<div class="qodef-woo-product-social-share">
		<?php
		$params          = array();
		$params['title'] = esc_html__( 'Share:', 'oraiste-core' );

		echo OraisteCore_Social_Share_Shortcode::call_shortcode( $params );
		?>
	</div>
<?php } ?>
