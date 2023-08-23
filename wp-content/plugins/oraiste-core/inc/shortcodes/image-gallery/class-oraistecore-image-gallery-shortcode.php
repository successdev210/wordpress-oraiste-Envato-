<?php

if ( ! function_exists( 'oraiste_core_add_image_gallery_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes
	 *
	 * @return array
	 */
	function oraiste_core_add_image_gallery_shortcode( $shortcodes ) {
		$shortcodes[] = 'OraisteCore_Image_Gallery_Shortcode';

		return $shortcodes;
	}

	add_filter( 'oraiste_core_filter_register_shortcodes', 'oraiste_core_add_image_gallery_shortcode' );
}

if ( class_exists( 'OraisteCore_List_Shortcode' ) ) {
	class OraisteCore_Image_Gallery_Shortcode extends OraisteCore_List_Shortcode {

		public function map_shortcode() {
			$this->set_shortcode_path( ORAISTE_CORE_SHORTCODES_URL_PATH . '/image-gallery' );
			$this->set_base( 'oraiste_core_image_gallery' );
			$this->set_name( esc_html__( 'Image Gallery', 'oraiste-core' ) );
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
					'field_type' => 'image',
					'name'       => 'images',
					'multiple'   => 'yes',
					'title'      => esc_html__( 'Images', 'oraiste-core' ),
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
						''            => esc_html__( 'No Action', 'oraiste-core' ),
						'open-popup'  => esc_html__( 'Open Popup', 'oraiste-core' ),
						'custom-link' => esc_html__( 'Custom Link', 'oraiste-core' ),
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
								'values'        => 'custom-link',
								'default_value' => '',
							),
						),
					),
				)
			);
			$this->map_list_options(
				array(
					'exclude_option'   => array( 'images_proportion' ),
					'include_behavior' => array( 'slider-auto-width' => esc_html__( 'Slider Auto Width' ) ),
					'group'            => esc_html__( 'Gallery Settings', 'oraiste-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'text',
					'name'          => 'height',
					'title'         => esc_html__( 'Slider Height', 'oraiste-core' ),
					'description'   => esc_html__( 'Set slider height in pixels. Default value is 400px', 'oraiste-core' ),
					'default_value' => '400',
					'group'         => esc_html__( 'Gallery Settings', 'oraiste-core' ),
					'dependency'    => array(
						'show' => array(
							'behavior' => array(
								'values'        => 'slider-auto-width',
								'default_value' => 'columns',
							),
						),
					),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'text',
					'name'          => 'height_1366',
					'title'         => esc_html__( 'Slider Height 1366', 'oraiste-core' ),
					'description'   => esc_html__( 'Set responsive slider height in pixels for screen size 1366', 'oraiste-core' ),
					'default_value' => '',
					'group'         => esc_html__( 'Gallery Settings', 'oraiste-core' ),
					'dependency'    => array(
						'show' => array(
							'behavior' => array(
								'values'        => 'slider-auto-width',
								'default_value' => 'columns',
							),
						),
					),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'text',
					'name'          => 'height_1024',
					'title'         => esc_html__( 'Slider Height 1024', 'oraiste-core' ),
					'description'   => esc_html__( 'Set responsive slider height in pixels for screen size 1024', 'oraiste-core' ),
					'default_value' => '',
					'group'         => esc_html__( 'Gallery Settings', 'oraiste-core' ),
					'dependency'    => array(
						'show' => array(
							'behavior' => array(
								'values'        => 'slider-auto-width',
								'default_value' => 'columns',
							),
						),
					),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'text',
					'name'          => 'height_768',
					'title'         => esc_html__( 'Slider Height 768', 'oraiste-core' ),
					'description'   => esc_html__( 'Set responsive slider height in pixels for screen size 768', 'oraiste-core' ),
					'default_value' => '',
					'group'         => esc_html__( 'Gallery Settings', 'oraiste-core' ),
					'dependency'    => array(
						'show' => array(
							'behavior' => array(
								'values'        => 'slider-auto-width',
								'default_value' => 'columns',
							),
						),
					),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'text',
					'name'          => 'height_480',
					'title'         => esc_html__( 'Slider Height 480', 'oraiste-core' ),
					'description'   => esc_html__( 'Set responsive slider height in pixels for screen size 480', 'oraiste-core' ),
					'default_value' => '',
					'group'         => esc_html__( 'Gallery Settings', 'oraiste-core' ),
					'dependency'    => array(
						'show' => array(
							'behavior' => array(
								'values'        => 'slider-auto-width',
								'default_value' => 'columns',
							),
						),
					),
				)
			);
		}

		public static function call_shortcode( $params ) {
			$html = qode_framework_call_shortcode( 'oraiste_core_image_gallery', $params );
			$html = str_replace( "\n", '', $html );

			return $html;
		}

		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();

			$atts['unique_class']   = 'qodef-image-gallery-' . rand( 0, 1000 );
			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['holder_styles']  = $this->get_holder_styles( $atts );
			$atts['item_classes']   = $this->get_item_classes( $atts );
			$atts['slider_attr']    = $this->get_slider_data( $atts );
			$atts['images']         = $this->generate_images_params( $atts );

			$slug = stristr( $atts['behavior'], 'slider' ) ? 'slider' : '';
			$this->set_responsive_styles( $atts );

			return oraiste_core_get_template_part( 'shortcodes/image-gallery', 'templates/image-gallery', $slug, $atts );
		}

		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[] = 'qodef-image-gallery';
			$holder_classes[] = $atts['unique_class'];
			$holder_classes[] = ! empty( $atts['image_action'] ) && 'open-popup' === $atts['image_action'] ? 'qodef-magnific-popup qodef-popup-gallery' : '';

			$list_classes = $this->get_list_classes( $atts );

			$holder_classes = array_merge( $holder_classes, $list_classes );

			return implode( ' ', $holder_classes );
		}

		public function get_holder_styles( $atts ) {
			$styles = array();

			$slider_height = $atts['height'];
			if ( ! empty( $slider_height ) ) {
				if ( qode_framework_string_ends_with_space_units( $slider_height ) ) {
					$styles[] = 'height: ' . $slider_height;
				} else {
					$styles[] = 'height: ' . intval( $slider_height ) . 'px';
				}
			}

			return $styles;
		}

		public function get_item_classes( $atts ) {
			$item_classes   = $this->init_item_classes();
			$item_classes[] = 'qodef-image-wrapper';

			$list_item_classes = $this->get_list_item_classes( $atts );

			$item_classes = array_merge( $item_classes, $list_item_classes );

			return implode( ' ', $item_classes );
		}

		private function generate_images_params( $atts ) {
			$image_ids = array();
			$images    = array();
			$i         = 0;

			if ( '' !== $atts['images'] ) {
				$image_ids = explode( ',', $atts['images'] );
			}

			$image_size = $this->generate_image_size( $atts );

			foreach ( $image_ids as $id ) {

				$image['image_id']   = intval( $id );
				$image_original      = wp_get_attachment_image_src( $id, 'full' );
				$image['url']        = $this->generate_image_url( $id, $atts, $image_original[0] );
				$image['alt']        = get_post_meta( $id, '_wp_attachment_image_alt', true );
				$image['image_size'] = $image_size;

				$images[$i] = $image;
				$i ++;
			}

			return $images;
		}

		private function generate_image_size( $atts ) {
			$image_size = trim( $atts['image_size'] );
			preg_match_all( '/\d+/', $image_size, $matches ); /* check if numeral width and height are entered */
			if ( in_array( $image_size, array( 'thumbnail', 'thumb', 'medium', 'large', 'full' ), true ) ) {
				return $image_size;
			} elseif ( ! empty( $matches[0] ) ) {
				return array(
					$matches[0][0],
					$matches[0][1],
				);
			} else {
				return 'full';
			}
		}

		private function generate_image_url( $id, $atts, $default ) {
			if ( 'custom-link' === $atts['image_action'] ) {
				$url = get_post_meta( $id, 'qodef_image_gallery_custom_link', true );
				if ( empty( $url ) ) {
					$url = $default;
				}
			} else {
				$url = $default;
			}

			return $url;
		}

		private function set_responsive_styles( $atts ) {
			$unique_class = '.' . $atts['unique_class'];
			$screen_sizes = array( '1366', '1024', '768', '480' );
			$option_keys  = array( 'height' );

			foreach ( $screen_sizes as $screen_size ) {
				$styles = array();

				foreach ( $option_keys as $option_key ) {
					$option_value = $atts[$option_key . '_' . $screen_size];
					$style_key    = str_replace( '_', '-', $option_key );

					if ( '' !== $option_value ) {
						if ( qode_framework_string_ends_with_space_units( $option_value ) ) {
							$styles[$style_key] = $option_value . '!important';
						} else {
							$styles[$style_key] = intval( $option_value ) . 'px !important';
						}
					}
				}

				if ( ! empty( $styles ) ) {
					add_filter(
						'oraiste_core_filter_add_responsive_' . $screen_size . '_inline_style_in_footer', function ( $style ) use ( $unique_class, $styles ) {
						$style .= qode_framework_dynamic_style( $unique_class, $styles );

						return $style;
					}
					);
				}
			}
		}
	}
}
