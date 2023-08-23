<?php
$taxonomy_image_meta = get_term_meta( $category_id, 'thumbnail_id', true );
$taxonomy_image      = ! empty( $taxonomy_image_meta ) ? $taxonomy_image_meta : get_option( 'woocommerce_placeholder_image', 0 );

if ( ! empty( $taxonomy_image ) ) {
	$image_dimension     = isset( $image_dimension ) && ! empty( $image_dimension ) ? esc_attr( $image_dimension['size'] ) : 'full';
	$custom_image_width  = isset( $custom_image_width ) && '' !== $custom_image_width ? intval( $custom_image_width ) : 0;
	$custom_image_height = isset( $custom_image_height ) && '' !== $custom_image_height ? intval( $custom_image_height ) : 0;

	echo oraiste_core_get_list_shortcode_item_image( $image_dimension, $taxonomy_image, $custom_image_width, $custom_image_height );
}
