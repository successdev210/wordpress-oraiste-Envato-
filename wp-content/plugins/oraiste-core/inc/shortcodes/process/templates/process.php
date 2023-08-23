<div <?php qode_framework_class_attribute( $holder_classes ); ?>>
	<div class="qodef-grid-inner clear">
		<?php

		$title_tag = isset( $title_tag ) && ! empty( $title_tag ) ? $title_tag : 'h2';

		// include items
		if ( ! empty( $items ) ) {
			foreach ( $items as $item ) {
				?>
				<div class="<?php echo esc_attr( $item_classes ); ?>">
					<div class="qodef-e-inner">
						<?php if ( isset( $item['item_subtitle'] ) && ! empty( $item['item_subtitle'] ) ) { ?>
							<p class="qodef-e-subtitle"><?php echo esc_html( $item['item_subtitle'] ); ?></p>
						<?php } ?>
						<span class="qodef-e-image">
							<?php
							if ( ! empty( $item['item_image'] ) ) {
								echo wp_get_attachment_image( $item['item_image'], 'full' );
							} elseif ( ! empty( $item['item_svg_path'] ) ) {
								echo qode_framework_wp_kses_html( 'html', $item['item_svg_path'] );
							}
							?>
						</span>
						<?php if ( ! empty( $item['item_title'] ) ) { ?>
							<<?php echo esc_attr( $title_tag ); ?> class="qodef-e-title">
								<?php echo esc_html( $item['item_title'] ); ?>
							</<?php echo esc_attr( $title_tag ); ?>>
						<?php } ?>
					</div>
				</div>
				<?php
			}
		}
		?>
	</div>
</div>
