<?php if ( $query_result -> have_posts() ) {
	$count = 1;
	while ( $query_result -> have_posts() ) :
		$query_result -> the_post();

		$params[ 'image_dimension' ]           = $this_shortcode -> get_list_item_image_dimension( $params );
		$params[ 'item_classes' ]              = $this_shortcode -> get_item_classes( $params );
		$params[ 'image_dimension' ][ 'size' ] = 'custom';

		$image_dimensions                = oraiste_core_get_image_dimensions( $count );
		$params[ 'custom_image_width' ]  = $image_dimensions[ 'width' ];
		$params[ 'custom_image_height' ] = $image_dimensions[ 'height' ];

		oraiste_core_list_sc_template_part( 'post-types/portfolio/shortcodes/portfolio-list-fixed-layout', 'layouts/' . $layout, '', $params );

		$count ++;
	endwhile; // End of the loop.
} else {
	// Include global posts not found
	oraiste_core_theme_template_part( 'content', 'templates/parts/posts-not-found' );
}

wp_reset_postdata();
