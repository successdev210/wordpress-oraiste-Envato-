<?php

foreach ( $items as $item ) {

	if ( 'text' === $item['item_type'] ) {
		$params['text']      = $item['text'];
		$params['highlight'] = $item['highlight'];

		oraiste_core_template_part( 'post-types/portfolio/shortcodes/portfolio-showcase', 'templates/parts/text', '', $params );
	}
	if ( 'portfolio-item' === $item['item_type'] ) {
		$params['portfolio_item'] = $item['portfolio_item'];

		oraiste_core_template_part( 'post-types/portfolio/shortcodes/portfolio-showcase', 'templates/parts/image', '', $params );
	}
}
