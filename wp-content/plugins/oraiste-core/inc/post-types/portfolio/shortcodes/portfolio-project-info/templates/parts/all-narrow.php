<div class="qodef-e-content qodef-grid qodef-layout--template <?php echo oraiste_core_get_grid_gutter_classes(); ?>">
	<div class="qodef-grid-inner clear">
		<div class="qodef-grid-item qodef-col--9">
			<?php
			if ( 'yes' === $show_title ) {
				oraiste_core_template_part( 'post-types/portfolio/shortcodes/portfolio-project-info', 'templates/parts/title', '', $params );
			}
			?>
			<?php oraiste_core_template_part( 'post-types/portfolio/shortcodes/portfolio-project-info', 'templates/parts/excerpt' ); ?>
		</div>
		<div class="qodef-grid-item qodef-col--3 qodef-portfolio-info">
			<?php oraiste_core_template_part( 'post-types/portfolio', 'templates/parts/post-info/custom-fields' ); ?>
			<?php oraiste_core_template_part( 'post-types/portfolio', 'templates/parts/post-info/date' ); ?>
			<?php oraiste_core_template_part( 'post-types/portfolio', 'templates/parts/post-info/categories' ); ?>
			<?php oraiste_core_template_part( 'post-types/portfolio', 'templates/parts/post-info/social-share' ); ?>
		</div>
	</div>
</div>
