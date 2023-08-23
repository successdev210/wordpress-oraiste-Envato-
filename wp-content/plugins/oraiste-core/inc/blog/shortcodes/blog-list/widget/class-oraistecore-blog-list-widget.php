<?php

if ( ! function_exists( 'oraiste_core_add_blog_list_widget' ) ) {
	/**
	 * Function that add widget into widgets list for registration
	 *
	 * @param array $widgets
	 *
	 * @return array
	 */
	function oraiste_core_add_blog_list_widget( $widgets ) {
		$widgets[] = 'OraisteCore_Blog_List_Widget';

		return $widgets;
	}

	add_filter( 'oraiste_core_filter_register_widgets', 'oraiste_core_add_blog_list_widget' );
}

if ( class_exists( 'QodeFrameworkWidget' ) ) {
	class OraisteCore_Blog_List_Widget extends QodeFrameworkWidget {

		public function map_widget() {
			$this->set_widget_option(
				array(
					'field_type' => 'text',
					'name'       => 'widget_title',
					'title'      => esc_html__( 'Title', 'oraiste-core' ),
				)
			);
			$widget_mapped = $this->import_shortcode_options(
				array(
					'shortcode_base' => 'oraiste_core_blog_list',
					'exclude'        => array(
						'behavior',
						'masonry_images_proportion',
						'images_proportion',
						'custom_image_width',
						'custom_image_height',
						'columns',
						'columns_responsive',
						'columns_1440',
						'columns_1366',
						'columns_1024',
						'columns_768',
						'columns_680',
						'columns_480',
						'slider_loop',
						'slider_autoplay',
						'slider_speed',
						'slider_speed_animation',
						'slider_navigation',
						'slider_pagination',
						'layout',
						'title_tag',
						'excerpt_length',
						'enable_filter',
						'pagination_type',
						'pagination_type_load_more_top_margin',
					),
				)
			);

			if ( $widget_mapped ) {
				$this->set_base( 'oraiste_core_blog_list' );
				$this->set_name( esc_html__( 'Oraiste Blog List', 'oraiste-core' ) );
				$this->set_description( esc_html__( 'Display a list of blog posts', 'oraiste-core' ) );
			}
		}

		public function render( $atts ) {
			// force atts
			$atts['behavior']           = 'columns';
			$atts['images_proportion']  = 'thumbnail';
			$atts['columns']            = 1;
			$atts['columns_responsive'] = 'predefined';
			$atts['layout']             = 'simple';
			$atts['title_tag']          = 'h6';

			$params = $this->generate_string_params( $atts );

			echo do_shortcode( "[oraiste_core_blog_list $params]" ); // XSS OK
		}
	}
}
