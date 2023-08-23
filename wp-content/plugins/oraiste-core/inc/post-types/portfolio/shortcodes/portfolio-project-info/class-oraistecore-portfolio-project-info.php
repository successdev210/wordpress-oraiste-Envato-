<?php

if ( ! function_exists( 'oraiste_core_add_portfolio_project_info_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes
	 *
	 * @return array
	 */
	function oraiste_core_add_portfolio_project_info_shortcode( $shortcodes ) {
		$shortcodes[] = 'OraisteCore_Portfolio_Project_Info_Shortcode';

		return $shortcodes;
	}

	add_filter( 'oraiste_core_filter_register_shortcodes', 'oraiste_core_add_portfolio_project_info_shortcode' );
}

if ( class_exists( 'OraisteCore_Shortcode' ) ) {
	class OraisteCore_Portfolio_Project_Info_Shortcode extends OraisteCore_Shortcode {

		public function __construct() {
			$this->set_layouts( apply_filters( 'oraiste_core_filter_portfolio_project_info_layouts', array() ) );

			parent::__construct();
		}

		public function map_shortcode() {
			$this->set_shortcode_path( ORAISTE_CORE_CPT_URL_PATH . '/portfolio/shortcodes/portfolio-project-info' );
			$this->set_base( 'oraiste_core_portfolio_project_info' );
			$this->set_name( esc_html__( 'Portfolio Project Info', 'oraiste-core' ) );
			$this->set_description( esc_html__( 'Shortcode that display list of category items', 'oraiste-core' ) );
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
					'field_type'    => 'select',
					'name'          => 'portfolio_id',
					'title'         => esc_html__( 'Portfolio Item', 'oraiste-core' ),
					'options'       => qode_framework_get_cpt_items( 'portfolio-item', '', true ),
					'default_value' => '',
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'show_title',
					'title'         => esc_html__( 'Show Title', 'oraiste-core' ),
					'options'       => oraiste_core_get_select_type_options_pool( 'yes_no', false ),
					'default_value' => 'yes',
				)
			);
			$this->set_option(
				array(
					'field_type' => 'select',
					'name'       => 'title_tag',
					'title'      => esc_html__( 'Title Tag', 'oraiste-core' ),
					'options'    => oraiste_core_get_select_type_options_pool( 'title_tag' ),
					'dependency' => array(
						'show' => array(
							'show_title' => array(
								'values'        => 'yes',
								'default_value' => 'yes',
							),
						),
					),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'project_info_layout',
					'title'         => esc_html__( 'Project Info Layout', 'oraiste-core' ),
					'options'       => array(
						'narrow' => esc_html__( 'Narrow', 'oraiste-core' ),
						'wide'   => esc_html__( 'Wide', 'oraiste-core' ),
					),
					'default_value' => 'narrow',
				)
			);
			// $this->set_option(
			// array(
			// 'field_type' => 'select',
			// 'name'       => 'project_info_type',
			// 'title'      => esc_html__( 'Project Info Type', 'oraiste-core' ),
			// 'options'    => array(
			// 'all'        => esc_html__( 'All', 'oraiste-core' ),
			// 'title'      => esc_html__( 'Title', 'oraiste-core' ),
			// 'categories' => esc_html__( 'Category', 'oraiste-core' ),
			// 'tags'       => esc_html__( 'Tag', 'oraiste-core' ),
			// 'author'     => esc_html__( 'Author', 'oraiste-core' ),
			// 'date'       => esc_html__( 'Date', 'oraiste-core' ),
			// 'image'      => esc_html__( 'Featured Image', 'oraiste-core' ),
			// ),
			// )
			// );
			// $this->set_option(
			// array(
			// 'field_type'  => 'text',
			// 'name'        => 'project_info_label',
			// 'title'       => esc_html__( 'Project Info Label', 'oraiste-core' ),
			// 'description' => esc_html__( 'Add project info label before project info element/s', 'oraiste-core' ),
			// 'dependency'  => array(
			// 'hide' => array(
			// 'project_info_type' => array(
			// 'values'        => 'all',
			// 'default_value' => '',
			// ),
			// ),
			// ),
			// )
			// );
		}

		public function render( $options, $content = null ) {
			parent::render( $options );

			$atts = $this->get_atts();

			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['project_id']     = ! empty( $atts['portfolio_id'] ) ? $atts['portfolio_id'] : get_the_ID();
			// $atts['this_shortcode'] = $this;

			return oraiste_core_get_template_part( 'post-types/portfolio/shortcodes/portfolio-project-info', 'templates/content', '', $atts );
		}

		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[] = 'qodef-portfolio-project-info';
			$holder_classes[] = ! empty( $atts['project_info_layout'] ) ? 'qodef-project-info-layout--' . $atts['project_info_layout'] : '';

			return implode( ' ', $holder_classes );
		}
	}
}
