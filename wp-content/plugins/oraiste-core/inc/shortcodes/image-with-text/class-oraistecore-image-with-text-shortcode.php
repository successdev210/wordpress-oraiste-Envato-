<?php

if ( ! function_exists( 'oraiste_core_add_image_with_text_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes
	 *
	 * @return array
	 */
	function oraiste_core_add_image_with_text_shortcode( $shortcodes ) {
		$shortcodes[] = 'OraisteCore_Image_With_Text_Shortcode';

		return $shortcodes;
	}

	add_filter( 'oraiste_core_filter_register_shortcodes', 'oraiste_core_add_image_with_text_shortcode' );
}

if ( class_exists( 'OraisteCore_Shortcode' ) ) {
	class OraisteCore_Image_With_Text_Shortcode extends OraisteCore_Shortcode {

		public function __construct() {
			$this->set_layouts( apply_filters( 'oraiste_core_filter_image_with_text_layouts', array() ) );
			$this->set_extra_options( apply_filters( 'oraiste_core_filter_image_with_text_extra_options', array() ) );

			parent::__construct();
		}

		public function map_shortcode() {
			$this->set_shortcode_path( ORAISTE_CORE_SHORTCODES_URL_PATH . '/image-with-text' );
			$this->set_base( 'oraiste_core_image_with_text' );
			$this->set_name( esc_html__( 'Image With Text', 'oraiste-core' ) );
			$this->set_description( esc_html__( 'Shortcode that adds image with text element', 'oraiste-core' ) );
			$this->set_category( esc_html__( 'Oraiste Core', 'oraiste-core' ) );
			$this->set_scripts(
				array(
					'jquery-magnific-popup' => array(
						'registered' => true,
					),
				)
			);
			$this->set_necessary_styles(
				array(
					'magnific-popup' => array(
						'registered' => true,
					),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'custom_class',
					'title'      => esc_html__( 'Custom Class', 'oraiste-core' ),
				)
			);

			$options_map = oraiste_core_get_variations_options_map( $this->get_layouts() );

			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'layout',
					'title'         => esc_html__( 'Layout', 'oraiste-core' ),
					'options'       => $this->get_layouts(),
					'default_value' => $options_map['default_value'],
					'visibility'    => array( 'map_for_page_builder' => $options_map['visibility'] ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'image',
					'name'       => 'image',
					'title'      => esc_html__( 'Image', 'oraiste-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'  => 'text',
					'name'        => 'image_size',
					'title'       => esc_html__( 'Image Size', 'oraiste-core' ),
					'description' => esc_html__( 'For predefined image sizes input thumbnail, medium, large or full. If you wish to set a custom image size, type in the desired image dimensions in pixels (e.g. 400x400).', 'oraiste-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'select',
					'name'       => 'image_action',
					'title'      => esc_html__( 'Image Action', 'oraiste-core' ),
					'options'    => array(
						''                => esc_html__( 'No Action', 'oraiste-core' ),
						'open-popup'      => esc_html__( 'Open Popup', 'oraiste-core' ),
						'custom-link'     => esc_html__( 'Custom Link', 'oraiste-core' ),
						'scrolling-image' => esc_html__( 'Scrolling Image', 'oraiste-core' ),
					),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'select',
					'name'       => 'scrolling_direction',
					'title'      => esc_html__( 'Scrolling Direction', 'oraiste-core' ),
					'options'    => array(
						'vertical'   => esc_html__( 'Vertical', 'oraiste-core' ),
						'horizontal' => esc_html__( 'Horizontal', 'oraiste-core' ),
					),
					'dependency' => array(
						'show' => array(
							'image_action' => array(
								'values'        => 'scrolling-image',
								'default_value' => '',
							),
						),
					),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'link',
					'title'      => esc_html__( 'Custom Link', 'oraiste-core' ),
					'dependency' => array(
						'show' => array(
							'image_action' => array(
								'values'        => array( 'custom-link', 'scrolling-image' ),
								'default_value' => '',
							),
						),
					),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'target',
					'title'         => esc_html__( 'Custom Link Target', 'oraiste-core' ),
					'options'       => oraiste_core_get_select_type_options_pool( 'link_target' ),
					'default_value' => '_self',
					'dependency'    => array(
						'show' => array(
							'image_action' => array(
								'values'        => array( 'custom-link', 'scrolling-image' ),
								'default_value' => '',
							),
						),
					),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'title',
					'title'      => esc_html__( 'Title', 'oraiste-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'title_tag',
					'title'         => esc_html__( 'Title Tag', 'oraiste-core' ),
					'options'       => oraiste_core_get_select_type_options_pool( 'title_tag' ),
					'default_value' => 'h4',
					'group'         => esc_html__( 'Title Style', 'oraiste-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'color',
					'name'       => 'title_color',
					'title'      => esc_html__( 'Title Color', 'oraiste-core' ),
					'group'      => esc_html__( 'Title Style', 'oraiste-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'title_margin_top',
					'title'      => esc_html__( 'Title Margin Top', 'oraiste-core' ),
					'group'      => esc_html__( 'Title Style', 'oraiste-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'textarea',
					'name'       => 'text',
					'title'      => esc_html__( 'Text', 'oraiste-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'color',
					'name'       => 'text_color',
					'title'      => esc_html__( 'Text Color', 'oraiste-core' ),
					'group'      => esc_html__( 'Text Style', 'oraiste-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'text_margin_top',
					'title'      => esc_html__( 'Text Margin Top', 'oraiste-core' ),
					'group'      => esc_html__( 'Text Style', 'oraiste-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'image_shadow',
					'title'         => esc_html__( 'Enable Shadow', 'oraiste-core' ),
					'options'       => oraiste_core_get_select_type_options_pool( 'yes_no', false ),
					'default_value' => 'yes',
					'group'         => esc_html__( 'Image Style', 'oraiste-core' ),
				)
			);
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'enable_appear',
				'title'         => esc_html__( 'Appear Animation', 'oraiste-core' ),
				'options'       => oraiste_core_get_select_type_options_pool( 'yes_no', false ),
				'default_value' => 'yes'
			) );
			$this->map_extra_options();
		}

		public static function call_shortcode( $params ) {
			$html = qode_framework_call_shortcode( 'oraiste_core_image_with_text', $params );
			$html = str_replace( "\n", '', $html );

			return $html;
		}

		public function load_assets() {
			$atts = $this->get_atts();

			if ( isset( $atts['image_action'] ) && 'open-popup' === $atts['image_action'] ) {
				wp_enqueue_style( 'magnific-popup' );
				wp_enqueue_script( 'jquery-magnific-popup' );
			}
		}

		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();

			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['title_styles']   = $this->get_title_styles( $atts );
			$atts['text_styles']    = $this->get_text_styles( $atts );
			$atts['image_params']   = $this->generate_image_params( $atts );

			return oraiste_core_get_template_part( 'shortcodes/image-with-text', 'variations/' . $atts['layout'] . '/templates/' . $atts['layout'], '', $atts );
		}

		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[] = 'qodef-image-with-text';
			$holder_classes[] = ! empty( $atts['layout'] ) ? 'qodef-layout--' . $atts['layout'] : '';
			$holder_classes[] = ! empty( $atts['image_action'] ) ? 'qodef-image-action--' . $atts['image_action'] : '';
			$holder_classes[] = ! empty( $atts['scrolling_direction'] ) ? 'qodef-scrolling-direction--' . $atts['scrolling_direction'] : '';
			$holder_classes[] = ( 'yes' === $atts['image_shadow'] ) ? 'qodef-shadow--on' : '';
			$holder_classes[] = ! empty ( $atts['enable_appear'] ) && $atts['enable_appear'] == 'yes' ? 'qodef--has-appear qodef--random-appear-delay' : '';

			return implode( ' ', $holder_classes );
		}

		private function get_title_styles( $atts ) {
			$styles = array();

			if ( '' !== $atts['title_margin_top'] ) {
				if ( qode_framework_string_ends_with_space_units( $atts['title_margin_top'] ) ) {
					$styles[] = 'margin-top: ' . $atts['title_margin_top'];
				} else {
					$styles[] = 'margin-top: ' . intval( $atts['title_margin_top'] ) . 'px';
				}
			}

			if ( ! empty( $atts['title_color'] ) ) {
				$styles[] = 'color: ' . $atts['title_color'];
			}

			return $styles;
		}

		private function get_text_styles( $atts ) {
			$styles = array();

			if ( '' !== $atts['text_margin_top'] ) {
				if ( qode_framework_string_ends_with_space_units( $atts['text_margin_top'] ) ) {
					$styles[] = 'margin-top: ' . $atts['text_margin_top'];
				} else {
					$styles[] = 'margin-top: ' . intval( $atts['text_margin_top'] ) . 'px';
				}
			}

			if ( ! empty( $atts['text_color'] ) ) {
				$styles[] = 'color: ' . $atts['text_color'];
			}

			return $styles;
		}

		private function generate_image_params( $atts ) {
			$image = array();

			if ( ! empty( $atts['image'] ) ) {
				$id = $atts['image'];

				$image['image_id'] = intval( $id );
				$image_original    = wp_get_attachment_image_src( $id, 'full' );
				$image['url']      = $image_original[0];
				$image['alt']      = get_post_meta( $id, '_wp_attachment_image_alt', true );

				$image_size = trim( $atts['image_size'] );
				preg_match_all( '/\d+/', $image_size, $matches ); /* check if numeral width and height are entered */
				if ( in_array( $image_size, array( 'thumbnail', 'thumb', 'medium', 'large', 'full' ), true ) ) {
					$image['image_size'] = $image_size;
				} elseif ( ! empty( $matches[0] ) ) {
					$image['image_size'] = array(
						$matches[0][0],
						$matches[0][1],
					);
				} else {
					$image['image_size'] = 'full';
				}
			}

			return $image;
		}
	}
}
