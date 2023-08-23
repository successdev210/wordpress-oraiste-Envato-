<?php

if ( ! empty( $taxonomy_items ) ) {
	foreach ( $taxonomy_items as $taxonomy_item ) {
		$params['category_slug']   = $taxonomy_item->slug;
		$params['category_name']   = $taxonomy_item->name;
		$params['category_id']     = $taxonomy_item->term_id;
		$params['image_dimension'] = $this_shortcode->get_image_dimension( $params );
		$params['item_classes']    = $this_shortcode->get_item_classes( $params );

		oraiste_core_list_sc_template_part( 'plugins/woocommerce/shortcodes/product-category-list', 'layouts/' . $layout, '', $params );
	}
} else {
	// Include global posts not found
	oraiste_core_theme_template_part( 'content', 'templates/parts/posts-not-found' );
}
