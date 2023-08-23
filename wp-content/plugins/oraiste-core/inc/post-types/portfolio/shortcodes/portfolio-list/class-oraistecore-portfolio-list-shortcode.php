<?php

if ( ! function_exists( 'oraiste_core_add_portfolio_list_shortcode' ) ) {
	/**
	 * Function that isadding shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes - Array of registered shortcodes
	 *
	 * @return array
	 */
	function oraiste_core_add_portfolio_list_shortcode( $shortcodes ) {
		$shortcodes[] = 'OraisteCore_Portfolio_List_Shortcode';

		return $shortcodes;
	}

	add_filter( 'oraiste_core_filter_register_shortcodes', 'oraiste_core_add_portfolio_list_shortcode' );
}

if ( class_exists( 'OraisteCore_List_Shortcode' ) ) {
	class OraisteCore_Portfolio_List_Shortcode extends OraisteCore_List_Shortcode {

		public function __construct() {
			$this->set_post_type( 'portfolio-item' );
			$this->set_post_type_taxonomy( 'portfolio-category' );
			$this->set_post_type_additional_taxonomies( array( 'portfolio-tag' ) );
			$this->set_layouts( apply_filters( 'oraiste_core_filter_portfolio_list_layouts', array() ) );
			$this->set_extra_options( apply_filters( 'oraiste_core_filter_portfolio_list_extra_options', array() ) );
			$this->set_hover_animation_options( apply_filters( 'oraiste_core_filter_portfolio_list_hover_animation_options', array() ) );

			parent::__construct();
		}

		public function map_shortcode() {
			$this->set_shortcode_path( ORAISTE_CORE_CPT_URL_PATH . '/portfolio/shortcodes/portfolio-list' );
			$this->set_base( 'oraiste_core_portfolio_list' );
			$this->set_name( esc_html__( 'Portfolio List', 'oraiste-core' ) );
			$this->set_description( esc_html__( 'Shortcode that displays list of portfolios', 'oraiste-core' ) );
			$this->set_category( esc_html__( 'Oraiste Core', 'oraiste-core' ) );
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'custom_class',
					'title'      => esc_html__( 'Custom Class', 'oraiste-core' ),
				)
			);
			$this->map_list_options();
			$this->map_query_options( array( 'post_type' => $this->get_post_type() ) );
			$this->map_layout_options(
				array(
					'layouts'                 => $this->get_layouts(),
					'hover_animations'        => $this->get_hover_animation_options(),
					'default_value_title_tag' => 'h3',
				)
			);
			if ( empty( $exclude_option ) || ( ! empty( $exclude_option ) && ! in_array( 'custom_padding', $exclude_option, true ) ) ) {
				$this->set_option(
					array(
						'field_type'    => 'select',
						'name'          => 'custom_padding',
						'title'         => esc_html__( 'Use Item Custom Padding', 'oraiste-core' ),
						'group'         => esc_html__( 'Layout', 'oraiste-core' ),
						'default_value' => 'no',
						'options'       => oraiste_core_get_select_type_options_pool( 'no_yes', false ),
					)
				);
			}
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'enable_appear',
				'title'         => esc_html__( 'Appear Animation', 'oraiste-core' ),
				'options'       => oraiste_core_get_select_type_options_pool( 'yes_no', false ),
				'default_value' => 'yes'
			) );
			$this->map_additional_options();
			$this->map_extra_options();
			$this->set_scripts(
				apply_filters( 'oraiste_core_filter_portfolio_list_register_assets', array() )
			);
		}

		public static function call_shortcode( $params ) {
			$html = qode_framework_call_shortcode( 'oraiste_core_portfolio_list', $params );
			$html = str_replace( "\n", '', $html );

			return $html;
		}

		public function load_assets() {
			parent::load_assets();

			do_action( 'oraiste_core_action_portfolio_list_load_assets', $this->get_atts() );
		}

		public function render( $options, $content = null ) {
			parent::render( $options );

			$atts = $this->get_atts();

			$atts['post_type']       = $this->get_post_type();
			$atts['taxonomy_filter'] = $this->get_post_type_taxonomy();

			// Additional query args
			$atts['additional_query_args'] = $this->get_additional_query_args( $atts );

			$atts['query_result']   = new \WP_Query( oraiste_core_get_query_params( $atts ) );
			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['slider_attr']    = $this->get_slider_data( $atts );
			// $atts['bottom_links']   = $this->parse_repeater_items( $atts['children'] );
			$atts['data_attr'] = oraiste_core_get_pagination_data( ORAISTE_CORE_REL_PATH, 'post-types/portfolio/shortcodes', 'portfolio-list', 'portfolio', $atts );

			$atts['this_shortcode'] = $this;

			return oraiste_core_get_template_part( 'post-types/portfolio/shortcodes/portfolio-list', 'templates/content', $atts['behavior'], $atts );
		}

		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[] = 'qodef-portfolio-list';
			$holder_classes[] = ! empty( $atts['layout'] ) ? 'qodef-item-layout--' . $atts['layout'] : '';
			$holder_classes[] = 'info-follow' === $atts['layout'] && 'yes' === $atts['info_follow_parallax_scrolling'] ? 'qodef-parallax-scroll' : '';


			$list_classes            = $this->get_list_classes( $atts );
			$hover_animation_classes = $this->get_hover_animation_classes( $atts );
			$additional_classes      = $this->get_additional_classes( $atts );
			$holder_classes          = array_merge( $holder_classes, $list_classes, $hover_animation_classes, $additional_classes );

			return implode( ' ', $holder_classes );
		}

		public function get_item_classes( $atts ) {
			$item_classes = $this->init_item_classes();

			$item_classes[] = 'qodef-portfolio-list-item';

			$item_classes[] = ! empty ( $atts['enable_appear'] ) && $atts['enable_appear'] == 'yes' ? 'qodef--has-appear qodef--random-appear-delay' : '';

			$list_item_classes = $this->get_list_item_classes( $atts );

			$item_classes = array_merge( $item_classes, $list_item_classes );

			return implode( ' ', $item_classes );
		}

		public function get_additional_classes( $atts ) {
			$holder_classes = array();

			if ( isset( $atts['info_follow_predefined'] ) && $atts['info_follow_predefined'] == 'yes' ) {
				$holder_classes[] = 'qodef-info-follow-predefined--on';
			}

			return $holder_classes;
		}

		public function get_title_styles( $atts ) {
			$styles = array();

			if ( ! empty( $atts['text_transform'] ) ) {
				$styles[] = 'text-transform: ' . $atts['text_transform'];
			}

			return $styles;
		}

		public function get_list_item_style( $atts ) {
			$styles = array();

			if ( isset( $atts['custom_padding'] ) && 'yes' === $atts['custom_padding'] ) {
				$styles[] = 'margin: ' . get_post_meta( get_the_ID(), 'qodef_portfolio_item_padding', true );
			}

			return $styles;
		}
	}
}
