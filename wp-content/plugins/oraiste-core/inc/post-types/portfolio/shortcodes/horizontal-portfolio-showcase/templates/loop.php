<?php foreach ( $items as $item ) : ?>
	<?php
	$params['portfolio_item'] = $item['portfolio_item'];
	$params['custom_image']   = $item['custom_image'];
	?>
	<div class="qodef-m-item">
		<div class="qodef-e-inner">
			<?php
			oraiste_core_template_part( 'post-types/portfolio/shortcodes/horizontal-portfolio-showcase', 'templates/parts/image', 'custom', $params );
			oraiste_core_template_part( 'post-types/portfolio/shortcodes/horizontal-portfolio-showcase', 'templates/parts/image', 'featured', $params );
			oraiste_core_template_part( 'post-types/portfolio/shortcodes/horizontal-portfolio-showcase', 'templates/parts/media', 'list', $params );
			oraiste_core_template_part( 'post-types/portfolio/shortcodes/horizontal-portfolio-showcase', 'templates/parts/categories', '', $params );
			oraiste_core_template_part( 'post-types/portfolio/shortcodes/horizontal-portfolio-showcase', 'templates/parts/title', '', $params );
			?>
		</div>
	</div>
<?php endforeach; ?>
