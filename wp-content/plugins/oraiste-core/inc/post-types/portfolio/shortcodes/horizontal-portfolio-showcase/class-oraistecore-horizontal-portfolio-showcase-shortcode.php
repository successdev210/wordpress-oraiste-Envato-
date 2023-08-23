<?php

if ( ! function_exists( 'oraiste_core_add_horizontal_portfolio_showcase_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes
	 *
	 * @return array
	 */
	function oraiste_core_add_horizontal_portfolio_showcase_shortcode( $shortcodes ) {
		$shortcodes[] = 'OraisteCore_Horizontal_Portfolio_Showcase_Shortcode';

		return $shortcodes;
	}

	add_filter( 'oraiste_core_filter_register_shortcodes', 'oraiste_core_add_horizontal_portfolio_showcase_shortcode' );
}

if ( class_exists( 'OraisteCore_Shortcode' ) ) {
	class OraisteCore_Horizontal_Portfolio_Showcase_Shortcode extends OraisteCore_Shortcode {

		public function map_shortcode() {
			$this->set_shortcode_path( ORAISTE_CORE_CPT_URL_PATH . '/portfolio/shortcodes/horizontal-portfolio-showcase' );
			$this->set_base( 'oraiste_core_horizontal_portfolio_showcase' );
			$this->set_name( esc_html__( 'Horizontal Portfolio Showcase', 'oraiste-core' ) );
			$this->set_description( esc_html__( 'Shortcode that adds Horizontal Portfolio Showcase element', 'oraiste-core' ) );
			$this->set_category( esc_html__( 'Oraiste Core', 'oraiste-core' ) );
			$this->set_scripts(
				array(
					'SmoothScrollbar'        => array(
						'registered' => false,
						'url'        => ORAISTE_CORE_INC_URL_PATH . '/horizontal-scroll/assets/js/plugins/smooth-scrollbar.js',
						'dependency' => array( 'jquery' ),
					),
					'HorizontalScrollPlugin' => array(
						'registered' => false,
						'url'        => ORAISTE_CORE_INC_URL_PATH . '/horizontal-scroll/assets/js/plugins/HorizontalScrollPlugin.js',
						'dependency' => array( 'jquery' ),
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
			$this->set_option(
				array(
					'field_type'    => 'textarea',
					'name'          => 'text',
					'title'         => esc_html__( 'Intro Text', 'oraiste-core' ),
					'default_value' => esc_html__( 'Intro Text Title', 'oraiste-core' ),
					'group'         => esc_html__( 'Intro Section', 'oraiste-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'  => 'text',
					'name'        => 'line_break_positions',
					'title'       => esc_html__( 'Positions of Line Break', 'oraiste-core' ),
					'description' => esc_html__( 'Enter the positions of the words after which you would like to create a line break. Separate the positions with commas (e.g. if you would like the first, third, and fourth word to have a line break, you would enter "1,3,4")', 'oraiste-core' ),
					'group'       => esc_html__( 'Intro Section', 'oraiste-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'disable_break_words',
					'title'         => esc_html__( 'Disable Line Break', 'oraiste-core' ),
					'description'   => esc_html__( 'Enabling this option will disable title line breaks for screen size 1024 and lower', 'oraiste-core' ),
					'options'       => oraiste_core_get_select_type_options_pool( 'no_yes', false ),
					'default_value' => 'no',
					'group'         => esc_html__( 'Intro Section', 'oraiste-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'  => 'text',
					'name'        => 'highlight_words_positions',
					'title'       => esc_html__( 'Positions of Highlighted Words ', 'oraiste-core' ),
					'description' => esc_html__( 'Enter the positions of the words you would like to display as highlighted. Separate the positions with commas (e.g. if you would like the first, third, and fourth word to have a line break, you would enter "1,3,4")', 'oraiste-core' ),
					'group'       => esc_html__( 'Intro Section', 'oraiste-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'repeater',
					'name'       => 'children',
					'title'      => esc_html__( 'Item Elements', 'oraiste-core' ),
					'items'      => array(
						array(
							'field_type'    => 'select',
							'name'          => 'portfolio_item',
							'title'         => esc_html__( 'Portfolio Item', 'oraiste-core' ),
							'options'       => qode_framework_get_cpt_items( 'portfolio-item' ),
							'default_value' => '',
						),
						array(
							'field_type' => 'image',
							'name'       => 'custom_image',
							'title'      => esc_html__( 'Custom Image', 'oraiste-core' ),
						),
					),
					'group'      => esc_html__( 'Items', 'oraiste-core' ),
				)
			);
		}

		public static function call_shortcode( $params ) {
			$html = qode_framework_call_shortcode( 'oraiste_core_horizontal_portfolio_showcase', $params );
			$html = str_replace( "\n", '', $html );

			return $html;
		}

		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();

			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['items']          = $this->parse_repeater_items( $atts['children'] );
			$atts['text']           = $this->get_modified_text( $atts );

			$atts['this_shortcode'] = $this;

			return oraiste_core_get_template_part( 'post-types/portfolio/shortcodes/horizontal-portfolio-showcase', 'templates/content', '', $atts );
		}

		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[] = 'qodef-horizontal-portfolio-showcase';
			$holder_classes[] = 'yes' === $atts['disable_break_words'] ? 'qodef-text-break--disabled' : '';

			return implode( ' ', $holder_classes );
		}

		private function get_modified_text( $atts ) {
			$text = $atts['text'];

			if ( ! empty( $text ) ) {
				$text       = explode( ' ', $text );
				$split_text = array();

				foreach ( $text as $text_item ) {
					$split_text[] = '<span class="qodef-text-item">' . $text_item . '</span>';
				}

				if ( ! empty( $atts['highlight_words_positions'] ) ) {
					$highlight_words_positions = explode( ',', str_replace( ' ', '', $atts['highlight_words_positions'] ) );

					foreach ( $highlight_words_positions as $position ) {
						$position = intval( $position );

						if ( isset( $split_text[$position - 1] ) && ! empty( $split_text[$position - 1] ) ) {
							$split_text[$position - 1] = strip_tags( $split_text[$position - 1] );
							$split_text[$position - 1] = '<span class="qodef-text-item qodef--highlight">' . $split_text[$position - 1] . oraiste_core_get_svg_icon( 'ripped-lines', 'qodef-border-lines-1' ) . '</span>';
						}
					}
				}

				if ( ! empty( $atts['line_break_positions'] ) ) {
					$line_break_positions = explode( ',', str_replace( ' ', '', $atts['line_break_positions'] ) );

					foreach ( $line_break_positions as $position ) {
						$position = intval( $position );

						if ( isset( $split_text[$position - 1] ) && ! empty( $split_text[$position - 1] ) ) {
							$split_text[$position - 1] = $split_text[$position - 1] . '<br>';
						}
					}
				}

				$text = implode( ' ', $split_text );
			}

			return $text;
		}
	}
}
