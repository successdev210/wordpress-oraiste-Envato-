<?php if ( $query_result->have_posts() ) {
	$count = 1;
	while ( $query_result->have_posts() ) :
		$query_result->the_post();

		$params['number']       = $count;
		$params['item_classes'] = $this_shortcode->get_item_classes( $params );
		if ( 'simple-list' === $params['layout'] && 1 === $count ) {
			$params['item_classes'] .= ' qodef--active';
		}

		oraiste_core_list_sc_template_part( 'post-types/portfolio/shortcodes/interactive-portfolio-list', 'layouts/' . $layout, '', $params );
		$count ++;
	endwhile; // End of the loop.
} else {
	// Include global posts not found
	oraiste_core_theme_template_part( 'content', 'templates/parts/posts-not-found' );
}

wp_reset_postdata();
