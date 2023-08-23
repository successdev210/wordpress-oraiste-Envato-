<?php

if ( ! function_exists( 'oraiste_core_add_horizontal_portfolio_list_shortcode' ) ) {
	/**
	 * Function that is adding shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes - Array of registered shortcodes
	 *
	 * @return array
	 */
	function oraiste_core_add_horizontal_portfolio_list_shortcode( $shortcodes ) {
		$shortcodes[] = 'OraisteCore_Horizontal_Portfolio_List_Shortcode';

		return $shortcodes;
	}

	add_filter( 'oraiste_core_filter_register_shortcodes', 'oraiste_core_add_horizontal_portfolio_list_shortcode' );
}

if ( class_exists( 'OraisteCore_List_Shortcode' ) ) {
	class OraisteCore_Horizontal_Portfolio_List_Shortcode extends OraisteCore_List_Shortcode {

		public function __construct() {
			$this->set_post_type( 'portfolio-item' );
			$this->set_post_type_taxonomy( 'portfolio-category' );
			$this->set_post_type_additional_taxonomies( array( 'portfolio-tag' ) );
			$this->set_layouts( apply_filters( 'oraiste_core_filter_horizontal_portfolio_list_layouts', array() ) );
			$this->set_hover_animation_options( apply_filters( 'oraiste_core_filter_horizontal_portfolio_list_hover_animation_options', array() ) );

			parent::__construct();
		}

		public function map_shortcode() {
			$this->set_shortcode_path( ORAISTE_CORE_CPT_URL_PATH . '/portfolio/shortcodes/horizontal-portfolio-list' );
			$this->set_base( 'oraiste_core_horizontal_portfolio_list' );
			$this->set_name( esc_html__( 'Horizontal Portfolio List', 'oraiste-core' ) );
			$this->set_description( esc_html__( 'Shortcode that displays list of product categories in horizontal scroll layout', 'oraiste-core' ) );
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
					'overscroll'             => array(
						'registered' => false,
						'url'        => ORAISTE_CORE_INC_URL_PATH . '/horizontal-scroll/assets/js/plugins/overscroll.js',
						'dependency' => array( 'jquery' ),
					),
					'tilt'             => array(
						'registered' => false,
						'url'        => ORAISTE_CORE_INC_URL_PATH . '/post-types/portfolio/shortcodes/horizontal-portfolio-list/variations/info-below/hover-animations/tilt/assets/js/plugins/tilt.jquery.min.js',
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
			$this->map_list_options(
				array(
					'exclude_behavior' => array( 'behavior', 'masonry' ),
					'exclude_option'   => array( 'images_proportion', 'columns' ),
				)
			);
			$this->map_query_options(
				array(
					'post_type' => $this->get_post_type(),
				)
			);
			$this->map_layout_options(
				array(
					'layouts'                 => $this->get_layouts(),
					'hover_animations'        => $this->get_hover_animation_options(),
				)
			);
			$this->set_option(
				array(
					'field_type'  => 'text',
					'name'        => 'item_width',
					'title'       => esc_html__( 'Item Width', 'oraiste-core' ),
					'description' => esc_html__( 'Default width is 300px', 'oraiste-core' ),
					'group'       => esc_html__( 'Layout', 'oraiste-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'custom_padding',
					'title'         => esc_html__( 'Use Item Custom Padding', 'oraiste-core' ),
					'default_value' => 'no',
					'options'       => oraiste_core_get_select_type_options_pool( 'no_yes', false ),
					'group'         => esc_html__( 'Layout', 'oraiste-core' ),
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
		}

		public static function call_shortcode( $params ) {
			$html = qode_framework_call_shortcode( 'oraiste_core_horizontal_portfolio_list', $params );
			$html = str_replace( "\n", '', $html );

			return $html;
		}

		public function render( $options, $content = null ) {
			parent::render( $options );

			$this->set_single_att( 'behavior', 'horizontal-slider' );

			$atts = $this->get_atts();

			$atts['post_type']       = $this->get_post_type();
			$atts['taxonomy_filter'] = $this->get_post_type_taxonomy();

			// Additional query args
			$atts['additional_query_args'] = $this->get_additional_query_args( $atts );

			$atts['query_result']   = new \WP_Query( oraiste_core_get_query_params( $atts ) );
			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['text']           = $this->get_modified_text( $atts );

			$atts['this_shortcode'] = $this;

			return oraiste_core_get_template_part( 'post-types/portfolio/shortcodes/horizontal-portfolio-list', 'templates/content', '', $atts );
		}

		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[] = 'qodef-portfolio-list';
			$holder_classes[] = 'qodef-horizontal-portfolio-list';
			$holder_classes[] = 'yes' === $atts['disable_break_words'] ? 'qodef-text-break--disabled' : '';
			$hover_animation_classes = $this->get_hover_animation_classes( $atts );

			$list_classes = $this->get_list_classes( $atts );

			$holder_classes = array_merge( $holder_classes, $list_classes, $hover_animation_classes );

			return implode( ' ', $holder_classes );
		}

		public function get_item_classes( $atts ) {
			$item_classes      = $this->init_item_classes();
			$list_item_classes = $this->get_list_item_classes( $atts );

			$item_classes = array_merge( $item_classes, $list_item_classes );

			return implode( ' ', $item_classes );
		}

		public function get_title_styles( $atts ) {
			$styles = array();

			if ( ! empty( $atts['text_transform'] ) ) {
				$styles[] = 'text-transform: ' . $atts['text_transform'];
			}

			return $styles;
		}

		public function get_list_item_styles( $atts ) {
			$styles = array();

			if ( ! empty( $atts['item_width'] ) ) {
				if ( qode_framework_string_ends_with_space_units( $atts['item_width'] ) ) {
					$styles[] = 'width: ' . $atts['item_width'];
				} else {
					$styles[] = 'width:' . $atts['item_width'] . 'px';
				}
			}

			if ( isset( $atts['custom_padding'] ) && 'yes' === $atts['custom_padding'] ) {
				$padding = get_post_meta( get_the_ID(), 'qodef_portfolio_item_padding', true );

				if ( empty( $padding ) ) {
					$padding = 0;
				}

				$styles[] = 'padding: ' . $padding;
			}

			return $styles;
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

						if ( isset( $split_text[ $position - 1 ] ) && ! empty( $split_text[ $position - 1 ] ) ) {
							$split_text[ $position - 1 ] = strip_tags( $split_text[ $position - 1 ] );
							$split_text[ $position - 1 ] = '<span class="qodef-text-item qodef--highlight">' . $split_text[ $position - 1 ] . oraiste_core_get_svg_icon( 'ripped-lines', 'qodef-border-lines-1' ) . '</span>';
						}
					}
				}

				if ( ! empty( $atts['line_break_positions'] ) ) {
					$line_break_positions = explode( ',', str_replace( ' ', '', $atts['line_break_positions'] ) );

					foreach ( $line_break_positions as $position ) {
						$position = intval( $position );

						if ( isset( $split_text[ $position - 1 ] ) && ! empty( $split_text[ $position - 1 ] ) ) {
							$split_text[ $position - 1 ] = $split_text[ $position - 1 ] . '<br>';
						}
					}
				}

				$text = implode( ' ', $split_text );
			}

			return $text;
		}
	}
}
