<div <?php qode_framework_class_attribute( $holder_classes ); ?>>
	<?php if ( ! empty( $title ) ) { ?>
		<span class="qodef-social-title"><?php echo esc_html( $title ); ?></span>
	<?php } ?>
	<ul class="qodef-shortcode-list">
		<?php
		foreach ( $social_networks as $net ) {
			echo wp_kses(
				$net,
				array(
					'li'   => array(
						'class' => true,
					),
					'a'    => array(
						'itemprop' => true,
						'class'    => true,
						'href'     => true,
						'target'   => true,
						'onclick'  => true,
					),
					'img'  => array(
						'itemprop' => true,
						'class'    => true,
						'src'      => true,
						'alt'      => true,
					),
					'span' => array(
						'class' => true,
					),
				)
			);
		}
		?>
	</ul>
</div>
