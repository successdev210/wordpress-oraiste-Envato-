<article <?php post_class( $item_classes ); ?>>
	<div class="qodef-e-image">
		<?php oraiste_core_list_sc_template_part( 'post-types/portfolio/shortcodes/portfolio-list', 'post-info/image', '', $params ); ?>
	</div>
	<div class="qodef-e-content">
		<?php oraiste_core_list_sc_template_part( 'post-types/portfolio/shortcodes/interactive-portfolio-list', 'post-info/number', '', $params ); ?>
		<?php oraiste_core_list_sc_template_part( 'post-types/portfolio/shortcodes/portfolio-list', 'post-info/title', '', $params ); ?>
		<?php oraiste_core_list_sc_template_part( 'post-types/portfolio/shortcodes/portfolio-list', 'post-info/category', '', $params ); ?>
		<?php oraiste_core_list_sc_template_part( 'post-types/portfolio/shortcodes/interactive-portfolio-list', 'post-info/link', '', $params ); ?>
	</div>
</article>
