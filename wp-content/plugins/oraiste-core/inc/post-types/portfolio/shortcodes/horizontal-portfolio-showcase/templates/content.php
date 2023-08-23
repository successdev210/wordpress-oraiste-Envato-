<div <?php qode_framework_class_attribute( $holder_classes ); ?>>
	<div class="qodef-m-items-holder">
		<?php
		// include intro text template
		oraiste_core_template_part( 'post-types/portfolio/shortcodes/horizontal-portfolio-showcase', 'templates/parts/text', '', $params );

		// include loop template
		oraiste_core_template_part( 'post-types/portfolio/shortcodes/horizontal-portfolio-showcase', 'templates/loop', '', $params );
		?>
	</div>
</div>
