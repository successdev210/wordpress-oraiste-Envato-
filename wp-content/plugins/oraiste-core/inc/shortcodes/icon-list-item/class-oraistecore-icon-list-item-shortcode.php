<?php

if ( ! function_exists( 'oraiste_core_add_icon_list_item_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes
	 *
	 * @return array
	 */
	function oraiste_core_add_icon_list_item_shortcode( $shortcodes ) {
		$shortcodes[] = 'OraisteCore_Icon_List_Item_Shortcode';

		return $shortcodes;
	}

	add_filter( 'oraiste_core_filter_register_shortcodes', 'oraiste_core_add_icon_list_item_shortcode' );
}

if ( class_exists( 'OraisteCore_Shortcode' ) ) {
	class OraisteCore_Icon_List_Item_Shortcode extends OraisteCore_Shortcode {

		public function map_shortcode() {
			$this->set_shortcode_path( ORAISTE_CORE_SHORTCODES_URL_PATH . '/icon-list-item' );
			$this->set_base( 'oraiste_core_icon_list_item' );
			$this->set_name( esc_html__( 'Icon List Item', 'oraiste-core' ) );
			$this->set_description( esc_html__( 'Shortcode that adds icon list item element', 'oraiste-core' ) );
			$this->set_category( esc_html__( 'Oraiste Core', 'oraiste-core' ) );
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'item_margin_bottom',
					'title'      => esc_html__( 'Item Margin Bottom', 'oraiste-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'text',
					'name'          => 'link',
					'title'         => esc_html__( 'Link', 'oraiste-core' ),
					'default_value' => '',
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'target',
					'title'         => esc_html__( 'Link Target', 'oraiste-core' ),
					'options'       => oraiste_core_get_select_type_options_pool( 'link_target' ),
					'default_value' => '_self',
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'icon_type',
					'title'         => esc_html__( 'Icon Type', 'oraiste-core' ),
					'options'       => array(
						'icon-pack'   => esc_html__( 'Icon Pack', 'oraiste-core' ),
						'custom-icon' => esc_html__( 'Custom Icon', 'oraiste-core' ),
					),
					'default_value' => 'icon-pack',
				)
			);
			$this->set_option(
				array(
					'field_type' => 'image',
					'name'       => 'custom_icon',
					'title'      => esc_html__( 'Custom Icon', 'oraiste-core' ),
					'dependency' => array(
						'show' => array(
							'icon_type' => array(
								'values'        => 'custom-icon',
								'default_value' => 'icon-pack',
							),
						),
					),
				)
			);
			$this->import_shortcode_options(
				array(
					'shortcode_base'    => 'oraiste_core_icon',
					'exclude'           => array( 'link', 'target', 'margin', 'size' ),
					'additional_params' => array(
						'group'      => esc_html__( 'Icon', 'oraiste-core' ),
						'dependency' => array(
							'show' => array(
								'icon_type' => array(
									'values'        => 'icon-pack',
									'default_value' => 'icon-pack',
								),
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
					'group'      => esc_html__( 'Title', 'oraiste-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'select',
					'name'          => 'title_tag',
					'title'         => esc_html__( 'Title Tag', 'oraiste-core' ),
					'options'       => oraiste_core_get_select_type_options_pool( 'title_tag' ),
					'default_value' => 'p',
					'group'         => esc_html__( 'Title', 'oraiste-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'color',
					'name'       => 'title_color',
					'title'      => esc_html__( 'Title Color', 'oraiste-core' ),
					'group'      => esc_html__( 'Title', 'oraiste-core' ),
				)
			);
		}

		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();

			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['holder_styles']  = $this->get_holder_styles( $atts );
			$atts['title_styles']   = $this->get_title_styles( $atts );
			$atts['icon_params']    = $this->generate_icon_params( $atts );

			return oraiste_core_get_template_part( 'shortcodes/icon-list-item', 'templates/icon-list-item', '', $atts );
		}

		private function get_holder_classes( $atts ) {
			$holder_classes = array();

			$holder_classes[] = 'qodef-icon-list-item';
			$holder_classes[] = ! empty( $atts['icon_type'] ) ? 'qodef-icon--' . $atts['icon_type'] : '';

			return implode( ' ', $holder_classes );
		}

		private function get_holder_styles( $atts ) {
			$styles = array();

			if ( '' !== $atts['item_margin_bottom'] ) {
				if ( qode_framework_string_ends_with_space_units( $atts['item_margin_bottom'] ) ) {
					$styles[] = 'margin-bottom: ' . $atts['item_margin_bottom'];
				} else {
					$styles[] = 'margin-bottom: ' . intval( $atts['item_margin_bottom'] ) . 'px';
				}
			}

			return $styles;
		}

		private function get_title_styles( $atts ) {
			$styles = array();

			if ( ! empty( $atts['title_color'] ) ) {
				$styles[] = 'color: ' . $atts['title_color'];
			}

			return $styles;
		}

		private function generate_icon_params( $atts ) {
			$params = $this->populate_imported_shortcode_atts(
				array(
					'shortcode_base' => 'oraiste_core_icon',
					'exclude'        => array( 'link', 'target', 'margin', 'size' ),
					'atts'           => $atts,
				)
			);

			return $params;
		}
	}
}
