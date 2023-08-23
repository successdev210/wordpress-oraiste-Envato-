<div <?php qode_framework_class_attribute( $holder_classes ); ?> <?php qode_framework_inline_attr( $data_attr, 'data-options' ); ?>>
    <div class="qodef-grid-inner clear">
		<?php
		// Include items
		oraiste_core_template_part( 'post-types/portfolio/shortcodes/portfolio-list-fixed-layout', 'templates/loop', '', $params );
		?>
    </div>
</div>
