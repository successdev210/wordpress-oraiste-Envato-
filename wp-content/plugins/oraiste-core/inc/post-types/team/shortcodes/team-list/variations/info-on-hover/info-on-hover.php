<?php

if ( ! function_exists( 'oraiste_core_add_team_list_variation_info_on_hover' ) ) {
	/**
	 * Function that add variation layout for this module
	 *
	 * @param array $variations
	 *
	 * @return array
	 */
	function oraiste_core_add_team_list_variation_info_on_hover( $variations ) {
		$variations['info-on-hover'] = esc_html__( 'Info on Hover', 'oraiste-core' );

		return $variations;
	}

	add_filter( 'oraiste_core_filter_team_list_layouts', 'oraiste_core_add_team_list_variation_info_on_hover' );
}

if ( ! function_exists( 'oraiste_core_add_team_list_options_info_on_hover' ) ) {
	/**
	 * Function that add additional options for variation layout
	 *
	 * @param array $options
	 *
	 * @return array
	 */
	function oraiste_core_add_team_list_options_info_on_hover( $options ) {
		$info_on_hover_options = array();

		$custom_content_option   = array(
			'field_type' => 'select',
			'name'       => 'info_on_hover_custom_content_option',
			'title'      => esc_html__( 'Custom Content', 'oraiste-core' ),
			'options'    => array(
				'none'             => esc_html__( 'None', 'oraiste-core' ),
				'text'             => esc_html__( 'Text', 'oraiste-core' ),
				'text-with-button' => esc_html__( 'Text With Button', 'oraiste-core' ),
			),
			'dependency' => array(
				'show' => array(
					'layout' => array(
						'values'        => 'info-on-hover',
						'default_value' => '',
					),
				),
			),
			'group'      => esc_html__( 'Custom Content', 'oraiste-core' ),
		);
		$info_on_hover_options[] = $custom_content_option;

		$custom_content_column_span_option = array(
			'field_type' => 'select',
			'name'       => 'info_on_hover_custom_content_column_span_option',
			'title'      => esc_html__( 'Custom Content Column Span', 'oraiste-core' ),
			'options'    => array(
				'1' => esc_html__( '1', 'oraiste-core' ),
				'2' => esc_html__( '2', 'oraiste-core' ),
			),
			'dependency' => array(
				'hide' => array(
					'info_on_hover_custom_content_option' => array(
						'values'        => 'none',
						'default_value' => '',
					),
				),
			),
			'group'      => esc_html__( 'Custom Content', 'oraiste-core' ),
		);
		$info_on_hover_options[]           = $custom_content_column_span_option;

		$custom_content_text_title_option = array(
			'field_type' => 'text',
			'name'       => 'info_on_hover_custom_content_text_title_option',
			'title'      => esc_html__( 'Custom Content Title', 'oraiste-core' ),
			'dependency' => array(
				'show' => array(
					'info_on_hover_custom_content_option' => array(
						'values'        => 'text',
						'default_value' => '',
					),
				),
			),
			'group'      => esc_html__( 'Custom Content', 'oraiste-core' ),
		);
		$info_on_hover_options[]          = $custom_content_text_title_option;

		$custom_content_text_title_tag_option = array(
			'field_type' => 'select',
			'name'       => 'info_on_hover_custom_content_text_title_tag_option',
			'title'      => esc_html__( 'Custom Content Title Tag', 'oraiste-core' ),
			'options'    => oraiste_core_get_select_type_options_pool( 'title_tag' ),
			'dependency' => array(
				'show' => array(
					'info_on_hover_custom_content_option' => array(
						'values'        => 'text',
						'default_value' => '',
					),
				),
			),
			'group'      => esc_html__( 'Custom Content', 'oraiste-core' ),
		);
		$info_on_hover_options[]              = $custom_content_text_title_tag_option;

		$custom_content_text_text_option = array(
			'field_type' => 'textarea',
			'name'       => 'info_on_hover_custom_content_text_text_option',
			'title'      => esc_html__( 'Custom Content Text', 'oraiste-core' ),
			'dependency' => array(
				'show' => array(
					'info_on_hover_custom_content_option' => array(
						'values'        => 'text',
						'default_value' => '',
					),
				),
			),
			'group'      => esc_html__( 'Custom Content', 'oraiste-core' ),
		);
		$info_on_hover_options[]         = $custom_content_text_text_option;

		$custom_content_text_link_option = array(
			'field_type' => 'text',
			'name'       => 'info_on_hover_custom_content_text_link_option',
			'title'      => esc_html__( 'Custom Content Link', 'oraiste-core' ),
			'dependency' => array(
				'show' => array(
					'info_on_hover_custom_content_option' => array(
						'values'        => 'text',
						'default_value' => '',
					),
				),
			),
			'group'      => esc_html__( 'Custom Content', 'oraiste-core' ),
		);
		$info_on_hover_options[]         = $custom_content_text_link_option;

		$custom_content_text_link_target_option = array(
			'field_type'    => 'select',
			'name'          => 'info_on_hover_custom_content_text_link_target_option',
			'title'         => esc_html__( 'Custom Content Link Target', 'oraiste-core' ),
			'options'       => oraiste_core_get_select_type_options_pool( 'link_target' ),
			'default_value' => '_self',
			'dependency'    => array(
				'show' => array(
					'info_on_hover_custom_content_option' => array(
						'values'        => 'text',
						'default_value' => '',
					),
				),
			),
			'group'         => esc_html__( 'Custom Content', 'oraiste-core' ),
		);
		$info_on_hover_options[]                = $custom_content_text_link_target_option;

		$custom_content_text_with_button_title_option = array(
			'field_type' => 'text',
			'name'       => 'info_on_hover_custom_content_text_with_button_title_option',
			'title'      => esc_html__( 'Custom Content Title', 'oraiste-core' ),
			'dependency' => array(
				'show' => array(
					'info_on_hover_custom_content_option' => array(
						'values'        => 'text-with-button',
						'default_value' => '',
					),
				),
			),
			'group'      => esc_html__( 'Custom Content', 'oraiste-core' ),
		);
		$info_on_hover_options[]                      = $custom_content_text_with_button_title_option;

		$custom_content_text_with_button_title_tag_option = array(
			'field_type' => 'select',
			'name'       => 'info_on_hover_custom_content_text_with_button_title_tag_option',
			'title'      => esc_html__( 'Custom Content Title Tag', 'oraiste-core' ),
			'options'    => oraiste_core_get_select_type_options_pool( 'title_tag' ),
			'dependency' => array(
				'show' => array(
					'info_on_hover_custom_content_option' => array(
						'values'        => 'text-with-button',
						'default_value' => '',
					),
				),
			),
			'group'      => esc_html__( 'Custom Content', 'oraiste-core' ),
		);
		$info_on_hover_options[]                          = $custom_content_text_with_button_title_tag_option;

		$custom_content_text_with_button_text_option = array(
			'field_type' => 'textarea',
			'name'       => 'info_on_hover_custom_content_text_with_button_text_option',
			'title'      => esc_html__( 'Custom Content Text', 'oraiste-core' ),
			'dependency' => array(
				'show' => array(
					'info_on_hover_custom_content_option' => array(
						'values'        => 'text-with-button',
						'default_value' => '',
					),
				),
			),
			'group'      => esc_html__( 'Custom Content', 'oraiste-core' ),
		);
		$info_on_hover_options[]                     = $custom_content_text_with_button_text_option;

		$custom_content_text_with_button_button_text_option = array(
			'field_type' => 'text',
			'name'       => 'info_on_hover_custom_content_text_with_button_button_text_option',
			'title'      => esc_html__( 'Button Text', 'oraiste-core' ),
			'dependency' => array(
				'show' => array(
					'info_on_hover_custom_content_option' => array(
						'values'        => 'text-with-button',
						'default_value' => '',
					),
				),
			),
			'group'      => esc_html__( 'Custom Content', 'oraiste-core' ),
		);
		$info_on_hover_options[]                            = $custom_content_text_with_button_button_text_option;

		$custom_content_text_with_button_button_link_option = array(
			'field_type' => 'text',
			'name'       => 'info_on_hover_custom_content_text_with_button_button_link_option',
			'title'      => esc_html__( 'Button Link', 'oraiste-core' ),
			'dependency' => array(
				'show' => array(
					'info_on_hover_custom_content_option' => array(
						'values'        => 'text-with-button',
						'default_value' => '',
					),
				),
			),
			'group'      => esc_html__( 'Custom Content', 'oraiste-core' ),
		);
		$info_on_hover_options[]                            = $custom_content_text_with_button_button_link_option;

		$custom_content_text_with_button_button_target_option = array(
			'field_type'    => 'select',
			'name'          => 'info_on_hover_custom_content_text_with_button_button_target_option',
			'title'         => esc_html__( 'Button Target', 'oraiste-core' ),
			'options'       => oraiste_core_get_select_type_options_pool( 'link_target' ),
			'default_value' => '_self',
			'dependency'    => array(
				'show' => array(
					'info_on_hover_custom_content_option' => array(
						'values'        => 'text-with-button',
						'default_value' => '',
					),
				),
			),
			'group'         => esc_html__( 'Custom Content', 'oraiste-core' ),
		);
		$info_on_hover_options[]                              = $custom_content_text_with_button_button_target_option;

		$custom_content_margin_option = array(
			'field_type' => 'text',
			'name'       => 'info_on_hover_custom_content_margin_top',
			'title'      => esc_html__( 'Custom Content Top Margin', 'oraiste-core' ),
			'dependency' => array(
				'hide' => array(
					'info_on_hover_custom_content_option' => array(
						'values'        => 'none',
						'default_value' => '',
					),
				),
			),
			'group'      => esc_html__( 'Custom Content', 'oraiste-core' ),
		);
		$info_on_hover_options[]      = $custom_content_margin_option;

		return array_merge( $options, $info_on_hover_options );
	}

	add_filter( 'oraiste_core_filter_team_list_extra_options', 'oraiste_core_add_team_list_options_info_on_hover' );
}


if ( ! function_exists( 'oraiste_core_add_custom_content_classes_column_span' ) ) {
	/**
	 * Function that return additional holder classes for this module
	 *
	 * @param array $holder_classes
	 * @param array $atts
	 *
	 * @return array
	 */
	function oraiste_core_add_custom_content_classes_column_span( $holder_classes, $atts ) {

		if ( 'info-on-hover' === $atts['layout'] ) {
			$holder_classes[] = ! empty( $atts['info_on_hover_custom_content_column_span_option'] ) ? 'qodef-column-span--' . $atts['info_on_hover_custom_content_column_span_option'] : '1';
		}

		return $holder_classes;
	}

	add_filter( 'oraiste_core_filter_team_list_item_variation_classes', 'oraiste_core_add_custom_content_classes_column_span', 10, 2 );
}
