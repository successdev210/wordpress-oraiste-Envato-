<div id="qodef-404-page">
	<div class="qodef-404">
		<p class="qodef-404-title"><?php echo esc_html( $title ); ?></p>
		<p class="qodef-404-text"><?php echo esc_html( $text ); ?></p>
		<div class="qodef-404-button">
			<?php
			$button_params = array(
				'link'          => esc_url( home_url( '/' ) ),
				'text'          => esc_html( $button_text ),
				'button_layout' => 'textual-animated',
				'size_two'      => 'small',
			);

			oraiste_render_button_element( $button_params );
			?>
		</div>
	</div>
</div>
