<li class="qodef-<?php echo esc_html( $name ); ?>-share">
	<a itemprop="url" class="qodef-share-link" href="#" onclick="<?php echo esc_attr( $link ); ?>">
		<?php if ( 'text' === $layout ) { ?>
			<span class="qodef-social-network-text"><?php echo esc_html( $text ); ?></span>
		<?php } else { ?>
			<?php echo qode_framework_wp_kses_html( 'html', $icon ); ?>
		<?php } ?>
	</a>
</li>
