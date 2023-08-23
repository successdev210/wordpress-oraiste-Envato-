<?php if ( ! empty( $video_link ) && class_exists( 'OraisteCore_Button_Shortcode' ) ) { ?>
	<a itemprop="url" class="qodef-m-play qodef-magnific-popup qodef-popup-item" href="<?php echo esc_url( $video_link ); ?>" data-type="iframe"></a>
	<?php
	$button_params = array(
		'link'          => '#',
		'text'          => ! empty( $play_button_text ) ? $play_button_text : esc_html__( 'Play Me', 'oraiste-core' ),
		'color'         => esc_attr( $play_button_text_color ),
		'button_layout' => 'textual-animated',
	);

	echo OraisteCore_Button_Shortcode::call_shortcode( $button_params );
	?>
<?php } ?>
