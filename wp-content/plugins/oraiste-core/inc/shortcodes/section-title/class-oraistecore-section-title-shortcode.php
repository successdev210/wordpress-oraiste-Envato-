<?php

if ( ! function_exists( 'oraiste_core_add_section_title_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes
	 *
	 * @return array
	 */
	function oraiste_core_add_section_title_shortcode( $shortcodes ) {
		$shortcodes[] = 'OraisteCore_Section_Title_Shortcode';

		return $shortcodes;
	}

	add_filter( 'oraiste_core_filter_register_shortcodes', 'oraiste_core_add_section_title_shortcode' );
}

if ( class_exists( 'OraisteCore_Shortcode' ) ) {
	class OraisteCore_Section_Title_Shortcode extends OraisteCore_Shortcode {

		public function map_shortcode() {
			$this->set_shortcode_path( ORAISTE_CORE_SHORTCODES_URL_PATH . '/section-title' );
			$this->set_base( 'oraiste_core_section_title' );
			$this->set_name( esc_html__( 'Section Title', 'oraiste-core' ) );
			$this->set_description( esc_html__( 'Shortcode that adds section title element', 'oraiste-core' ) );
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
					'field_type' => 'text',
					'name'       => 'title',
					'title'      => esc_html__( 'Title', 'oraiste-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'  => 'text',
					'name'        => 'line_break_positions',
					'title'       => esc_html__( 'Positions of Line Break', 'oraiste-core' ),
					'description' => esc_html__( 'Enter the positions of the words after which you would like to create a line break. Separate the positions with commas (e.g. if you would like the first, third, and fourth word to have a line break, you would enter "1,3,4")', 'oraiste-core' ),
					'group'       => esc_html__( 'Title Style', 'oraiste-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'disable_title_break_words',
					'title'         => esc_html__( 'Disable Title Line Break', 'oraiste-core' ),
					'description'   => esc_html__( 'Enabling this option will disable title line breaks for screen size 680 and lower', 'oraiste-core' ),
					'options'       => oraiste_core_get_select_type_options_pool( 'no_yes', false ),
					'default_value' => 'no',
					'group'         => esc_html__( 'Title Style', 'oraiste-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'  => 'text',
					'name'        => 'highlight_words_positions',
					'title'       => esc_html__( 'Positions of Highlighted Words ', 'oraiste-core' ),
					'description' => esc_html__( 'Enter the positions of the words you would like to display as highlighted. Separate the positions with commas (e.g. if you would like the first, third, and fourth word to have a line break, you would enter "1,3,4")', 'oraiste-core' ),
					'group'       => esc_html__( 'Title Style', 'oraiste-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'title_tag',
					'title'         => esc_html__( 'Title Tag', 'oraiste-core' ),
					'options'       => oraiste_core_get_select_type_options_pool( 'title_tag', false, array(), array( 'span' => esc_attr__( 'Theme Specific', 'oraiste-core' ) ) ),
					'default_value' => 'h2',
					'group'         => esc_html__( 'Title Style', 'oraiste-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'title_font_size',
					'title'      => esc_html__( 'Title Font Size', 'oraiste-core' ),
					'dependency' => array(
						'show' => array(
							'title_tag' => array(
								'values'        => 'span',
								'default_value' => 'h2',
							),
						),
					),
					'group'      => esc_html__( 'Title Style', 'oraiste-core' ),
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
					'name'       => 'link',
					'title'      => esc_html__( 'Title Custom Link', 'oraiste-core' ),
					'group'      => esc_html__( 'Title Style', 'oraiste-core' ),
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
					'group'         => esc_html__( 'Title Style', 'oraiste-core' ),
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
					'field_type' => 'select',
					'name'       => 'content_alignment',
					'title'      => esc_html__( 'Content Alignment', 'oraiste-core' ),
					'options'    => array(
						''       => esc_html__( 'Default', 'oraiste-core' ),
						'left'   => esc_html__( 'Left', 'oraiste-core' ),
						'center' => esc_html__( 'Center', 'oraiste-core' ),
						'right'  => esc_html__( 'Right', 'oraiste-core' ),
					),
				)
			);

			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'enable_appear',
				'title'         => esc_html__( 'Appear Animation', 'oraiste-core' ),
				'options'       => oraiste_core_get_select_type_options_pool( 'yes_no', false ),
				'default_value' => 'yes'
			) );
		}


		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();

			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['title']          = $this->get_modified_title( $atts );
			$atts['title_styles']   = $this->get_title_styles( $atts );
			$atts['text_styles']    = $this->get_text_styles( $atts );

			return oraiste_core_get_template_part( 'shortcodes/section-title', 'templates/section-title', '', $atts );
		}

		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[] = 'qodef-section-title';
			$holder_classes[] = ! empty( $atts['content_alignment'] ) ? 'qodef-alignment--' . $atts['content_alignment'] : 'qodef-alignment--left';
			$holder_classes[] = 'yes' === $atts['disable_title_break_words'] ? 'qodef-title-break--disabled' : '';
			$holder_classes[] = ! empty ( $atts['enable_appear'] ) && $atts['enable_appear'] == 'yes' ? 'qodef--has-appear' : '';

			return implode( ' ', $holder_classes );
		}

		private function get_modified_title( $atts ) {
			$title = $atts['title'];

			if ( ! empty( $title ) ) {
				$title       = explode( ' ', $title );
				$split_title = array();

				foreach ( $title as $title_item ) {
					$split_title[] = '<span class="qodef-title-item">' . $title_item . '</span>';
				}

				if ( ! empty( $atts['highlight_words_positions'] ) ) {
					$highlight_words_positions = explode( ',', str_replace( ' ', '', $atts['highlight_words_positions'] ) );

					foreach ( $highlight_words_positions as $position ) {
						$position = intval( $position );

						if ( isset( $split_title[ $position - 1 ] ) && ! empty( $split_title[ $position - 1 ] ) ) {
							$split_title[ $position - 1 ] = strip_tags( $split_title[ $position - 1 ] );
							$split_title[ $position - 1 ] = '<span class="qodef-text-item qodef--highlight">' . $split_title[ $position - 1 ] . oraiste_core_get_svg_icon( 'ripped-square','qodef-border-lines-3' ) . '</span>';
						}
					}
				}

				if ( ! empty( $atts['line_break_positions'] ) ) {
					$line_break_positions = explode( ',', str_replace( ' ', '', $atts['line_break_positions'] ) );

					foreach ( $line_break_positions as $position ) {
						$position = intval( $position );

						if ( isset( $split_title[ $position - 1 ] ) && ! empty( $split_title[ $position - 1 ] ) ) {
							$split_title[ $position - 1 ] = $split_title[ $position - 1 ] . '<br>';
						}
					}
				}

				$title = implode( ' ', $split_title );
			}

			return $title;
		}

		private function get_title_styles( $atts ) {
			$styles = array();

			if ( ! empty( $atts['title_color'] ) ) {
				$styles[] = 'color: ' . $atts['title_color'];
			}

			$title_font_size = $atts['title_font_size'];
			if ( ! empty( $title_font_size ) ) {
				if ( qode_framework_string_ends_with_typography_units( $title_font_size ) ) {
					$styles[] = 'font-size: ' . $title_font_size;
				} else {
					$styles[] = 'font-size: ' . intval( $title_font_size ) . 'px';
				}
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
	}
}
