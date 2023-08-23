<?php

if ( ! function_exists( 'oraiste_core_add_portfolio_showcase_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes
	 *
	 * @return array
	 */
	function oraiste_core_add_portfolio_showcase_shortcode( $shortcodes ) {
		$shortcodes[] = 'OraisteCore_Portfolio_Showcase_Shortcode';

		return $shortcodes;
	}

	add_filter( 'oraiste_core_filter_register_shortcodes', 'oraiste_core_add_portfolio_showcase_shortcode' );
}

if ( class_exists( 'OraisteCore_Shortcode' ) ) {
	class OraisteCore_Portfolio_Showcase_Shortcode extends OraisteCore_Shortcode {

		public function map_shortcode() {
			$this->set_shortcode_path( ORAISTE_CORE_CPT_URL_PATH . '/portfolio/shortcodes/portfolio-showcase' );
			$this->set_base( 'oraiste_core_portfolio_showcase' );
			$this->set_name( esc_html__( 'Portfolio Showcase', 'oraiste-core' ) );
			$this->set_description( esc_html__( 'Shortcode that adds text and portfolio items element', 'oraiste-core' ) );
			$this->set_category( esc_html__( 'Oraiste Core', 'oraiste-core' ) );
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'custom_class',
					'title'      => esc_html__( 'Custom Class', 'oraiste-core' ),
				)
			);
			$this->set_option( array(
				'field_type'    => 'select',
				'name'          => 'enable_appear',
				'title'         => esc_html__( 'Appear Animation', 'oraiste-core' ),
				'options'       => oraiste_core_get_select_type_options_pool( 'yes_no', false ),
				'default_value' => 'yes'
			) );
			$this->set_option(
				array(
					'field_type' => 'repeater',
					'name'       => 'children',
					'title'      => esc_html__( 'Item Elements', 'oraiste-core' ),
					'items'      => array(
						array(
							'field_type'    => 'select',
							'name'          => 'item_type',
							'title'         => esc_html__( 'Type', 'oraiste-core' ),
							'options'       => array(
								'portfolio-item' => esc_html__( 'Portfolio Item', 'oraiste-core' ),
								'text'           => esc_html__( 'Text', 'oraiste-core' ),
							),
							'default_value' => 'portfolio-item',
						),
						array(
							'field_type'    => 'select',
							'name'          => 'portfolio_item',
							'title'         => esc_html__( 'Portfolio Item', 'oraiste-core' ),
							'options'       => qode_framework_get_cpt_items( 'portfolio-item' ),
							'default_value' => '',
							'dependency'    => array(
								'show' => array(
									'item_type' => array(
										'values'        => 'portfolio-item',
										'default_value' => 'portfolio-item',
									),
								),
							),
						),
						array(
							'field_type' => 'text',
							'name'       => 'text',
							'title'      => esc_html__( 'Text', 'oraiste-core' ),
							'dependency' => array(
								'show' => array(
									'item_type' => array(
										'values'        => 'text',
										'default_value' => '',
									),
								),
							),
						),
						array(
							'field_type'    => 'select',
							'name'          => 'highlight',
							'title'         => esc_html__( 'Highlight Text', 'oraiste-core' ),
							'options'       => oraiste_core_get_select_type_options_pool( 'no_yes', false ),
							'default_value' => 'no',
							'dependency'    => array(
								'show' => array(
									'item_type' => array(
										'values'        => 'text',
										'default_value' => '',
									),
								),
							),
						),
					),
					'group'      => esc_html__( 'Items', 'oraiste-core' ),
				)
			);
		}

		public static function call_shortcode( $params ) {
			$html = qode_framework_call_shortcode( 'oraiste_core_portfolio_showcase', $params );
			$html = str_replace( "\n", '', $html );

			return $html;
		}

		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();

			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['items']          = $this->parse_repeater_items( $atts['children'] );

			$atts['this_shortcode'] = $this;

			return oraiste_core_get_template_part( 'post-types/portfolio/shortcodes/portfolio-showcase', 'templates/content', '', $atts );
		}

		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();
			$holder_classes [] = ! empty ( $atts['enable_appear'] ) && $atts['enable_appear'] == 'yes' ? 'qodef--has-appear' : '';

			$holder_classes[] = 'qodef-portfolio-showcase';

			return implode( ' ', $holder_classes );
		}
	}
}
