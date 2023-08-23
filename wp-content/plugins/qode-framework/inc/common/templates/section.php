<div class="qodef-section-wrapper col-12 <?php echo esc_attr( $class ); ?>" <?php echo qode_framework_get_inline_attrs( $dependency_data, true ); ?>>
	<div class="qodef-section-wrapper-inner">
		<div class="row">
			<?php
			$section_title = $this_object->get_title();

			if ( ! empty( $section_title ) ) {
				?>
				<h2 class="qodef-title qodef-section-title col-12"><?php echo esc_html( $section_title ); ?></h2>
			<?php } ?>
			<?php
			$section_description = $this_object->get_description();

			if ( ! empty( $section_description ) ) {
				?>
				<p class="qodef-description qodef-section-description col-12"><?php echo esc_html( $section_description ); ?></p>
			<?php } ?>
			<?php
			foreach ( $this_object->get_children() as $child ) {
				$child->render();
			}
			?>
		</div>
	</div>
</div>
