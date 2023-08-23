<?php

if ( ! function_exists( 'oraiste_core_add_process_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes
	 *
	 * @return array
	 */
	function oraiste_core_add_process_shortcode( $shortcodes ) {
		$shortcodes[] = 'OraisteCore_Process_Shortcode';

		return $shortcodes;
	}

	add_filter( 'oraiste_core_filter_register_shortcodes', 'oraiste_core_add_process_shortcode' );
}

if ( class_exists( 'OraisteCore_List_Shortcode' ) ) {
	class OraisteCore_Process_Shortcode extends OraisteCore_List_Shortcode {

		public function map_shortcode() {
			$this->set_shortcode_path( ORAISTE_CORE_SHORTCODES_URL_PATH . '/process' );
			$this->set_base( 'oraiste_core_process' );
			$this->set_name( esc_html__( 'Process', 'oraiste-core' ) );
			$this->set_description( esc_html__( 'Shortcode that adds image gallery element', 'oraiste-core' ) );
			$this->set_category( esc_html__( 'Oraiste Core', 'oraiste-core' ) );
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'custom_class',
					'title'      => esc_html__( 'Custom Class', 'oraiste-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'select',
					'name'       => 'title_tag',
					'title'      => esc_html__( 'Title Tag', 'oraiste-core' ),
					'options'    => oraiste_core_get_select_type_options_pool( 'title_tag' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'repeater',
					'name'       => 'process_items',
					'title'      => esc_html__( 'Process Items', 'oraiste-core' ),
					'items'      => array(
						array(
							'field_type'    => 'text',
							'name'          => 'item_subtitle',
							'title'         => esc_html__( 'Subtitle', 'oraiste-core' ),
							'default_value' => '',
						),
						array(
							'field_type' => 'text',
							'name'       => 'item_title',
							'title'      => esc_html__( 'Title', 'oraiste-core' ),
						),
						array(
							'field_type'    => 'select',
							'name'          => 'image_source',
							'title'         => esc_html__( 'Image Source', 'oraiste-core' ),
							'options'       => array(
								'upload-image' => esc_html__( 'Upload Image', 'oraiste-core' ),
								'svg-path'     => esc_html__( 'SVG Path', 'oraiste-core' ),
							),
							'default_value' => 'upload-image',
						),
						array(
							'field_type' => 'image',
							'name'       => 'item_image',
							'title'      => esc_html__( 'Image', 'oraiste-core' ),
							'multiple'   => 'no',
							'dependency' => array(
								'show' => array(
									'image_source' => array(
										'values'        => 'upload-image',
										'default_value' => 'upload-image',
									),
								),
							),
						),
						array(
							'field_type'  => 'textarea',
							'name'        => 'item_svg_path',
							'title'       => esc_html__( 'SVG Path', 'oraiste-core' ),
							'description' => esc_html__( 'When inserting an SVG path, remove the id attribute.', 'oraiste-core' ),
							'dependency'  => array(
								'show' => array(
									'image_source' => array(
										'values'        => 'svg-path',
										'default_value' => 'upload-image',
									),
								),
							),
						),
					),
				)
			);
			$this->map_list_options(
				array(
					'exclude_behavior' => array( 'masonry', 'slider' ),
					'exclude_option'   => array( 'images_proportion' ),
					'group'            => esc_html__( 'Layout Settings', 'oraiste-core' ),
				)
			);
		}

		public static function call_shortcode( $params ) {
			$html = qode_framework_call_shortcode( 'oraiste_core_process', $params );
			$html = str_replace( "\n", '', $html );

			return $html;
		}

		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();

			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['item_classes']   = $this->get_item_classes( $atts );
			$atts['items']          = $this->parse_repeater_items( $atts['process_items'] );

			return oraiste_core_get_template_part( 'shortcodes/process', 'templates/process', $atts['behavior'], $atts );
		}

		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[] = 'qodef-process';

			$list_classes   = $this->get_list_classes( $atts );
			$holder_classes = array_merge( $holder_classes, $list_classes );

			return implode( ' ', $holder_classes );
		}

		public function get_item_classes( $atts ) {
			$item_classes   = $this->init_item_classes();
			$item_classes[] = 'qodef-process-item';

			$list_item_classes = $this->get_list_item_classes( $atts );

			$item_classes = array_merge( $item_classes, $list_item_classes );

			return implode( ' ', $item_classes );
		}
	}
}
