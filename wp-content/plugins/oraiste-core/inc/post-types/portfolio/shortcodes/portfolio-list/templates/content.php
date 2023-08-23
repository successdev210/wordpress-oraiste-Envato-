<div <?php qode_framework_class_attribute( $holder_classes ); ?> <?php qode_framework_inline_attr( $data_attr, 'data-options' ); ?>>
	<?php
	// Include global filter from theme
	oraiste_core_theme_template_part( 'filter', 'templates/filter', '', $params );
	?>
	<div class="qodef-grid-inner clear">
		<?php
		// Include global masonry template from theme
		oraiste_core_theme_template_part( 'masonry', 'templates/sizer-gutter', '', $params['behavior'] );

		// Include items
		oraiste_core_template_part( 'post-types/portfolio/shortcodes/portfolio-list', 'templates/loop', '', $params );
		?>
	</div>
	<?php
	// Include global pagination from theme
	oraiste_core_theme_template_part( 'pagination', 'templates/pagination', $params['pagination_type'], $params );
	?>
</div>
