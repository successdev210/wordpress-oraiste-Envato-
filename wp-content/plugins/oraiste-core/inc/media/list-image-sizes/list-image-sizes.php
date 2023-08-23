<?php

if ( ! function_exists( 'oraiste_core_add_list_image_sizes' ) ) {
	/**
	 * Function that extended global image size options
	 *
	 * @param array $image_sizes
	 *
	 * @return array
	 */
	function oraiste_core_add_list_image_sizes( $image_sizes ) {
		$image_sizes[] = array(
			'slug'           => 'oraiste_core_image_size_square',
			'label'          => esc_html__( 'Square Size', 'oraiste-core' ),
			'label_simple'   => esc_html__( 'Square', 'oraiste-core' ),
			'default_crop'   => true,
			'default_width'  => 650,
			'default_height' => 650,
		);

		$image_sizes[] = array(
			'slug'           => 'oraiste_core_image_size_landscape',
			'label'          => esc_html__( 'Landscape Size', 'oraiste-core' ),
			'label_simple'   => esc_html__( 'Landscape', 'oraiste-core' ),
			'default_crop'   => true,
			'default_width'  => 1300,
			'default_height' => 650,
		);

		$image_sizes[] = array(
			'slug'           => 'oraiste_core_image_size_portrait',
			'label'          => esc_html__( 'Portrait Size', 'oraiste-core' ),
			'label_simple'   => esc_html__( 'Portrait', 'oraiste-core' ),
			'default_crop'   => true,
			'default_width'  => 650,
			'default_height' => 1300,
		);

		$image_sizes[] = array(
			'slug'           => 'oraiste_core_image_size_huge-square',
			'label'          => esc_html__( 'Huge Square Size', 'oraiste-core' ),
			'label_simple'   => esc_html__( 'Huge Square', 'oraiste-core' ),
			'default_crop'   => true,
			'default_width'  => 1300,
			'default_height' => 1300,
		);

		return $image_sizes;
	}

	add_filter( 'qode_framework_filter_populate_image_sizes', 'oraiste_core_add_list_image_sizes' );
}

if ( ! function_exists( 'oraiste_core_add_pool_masonry_list_image_sizes' ) ) {
	/**
	 * Function that add global masonry image size options
	 *
	 * @param array $options
	 * @param string $type
	 *
	 * @return array
	 */
	function oraiste_core_add_pool_masonry_list_image_sizes( $options, $type ) {
		if ( 'masonry_image_dimension' === $type ) {
			$options['oraiste_core_image_size_square']      = esc_html__( 'Square', 'oraiste-core' );
			$options['oraiste_core_image_size_landscape']   = esc_html__( 'Landscape', 'oraiste-core' );
			$options['oraiste_core_image_size_portrait']    = esc_html__( 'Portrait', 'oraiste-core' );
			$options['oraiste_core_image_size_huge-square'] = esc_html__( 'Huge Square', 'oraiste-core' );
		}

		return $options;
	}

	add_filter( 'oraiste_core_filter_select_type_option', 'oraiste_core_add_pool_masonry_list_image_sizes', 10, 2 );
}

if ( ! function_exists( 'oraiste_core_get_custom_image_size_class_name' ) ) {
	/**
	 * Function that return custom image size class name
	 *
	 * @param string $image_size
	 *
	 * @return string
	 */
	function oraiste_core_get_custom_image_size_class_name( $image_size ) {
		return ! empty( $image_size ) ? 'qodef-item--' . str_replace( 'oraiste_core_image_size_', '', $image_size ) : '';
	}
}

if ( ! function_exists( 'oraiste_core_get_custom_image_size_meta' ) ) {
	/**
	 * Function that return custom image size meta value
	 *
	 * @param string $type
	 * @param string $name
	 * @param int $post_id
	 *
	 * @return array
	 */
	function oraiste_core_get_custom_image_size_meta( $type, $name, $post_id ) {
		$image_size_meta = qode_framework_get_option_value( '', $type, $name, '', $post_id );
		$image_size      = ! empty( $image_size_meta ) ? esc_attr( $image_size_meta ) : 'full';

		return array(
			'size'  => $image_size,
			'class' => oraiste_core_get_custom_image_size_class_name( $image_size ),
		);
	}
}
