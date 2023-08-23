<?php

if ( ! function_exists( 'oraiste_core_add_video_button_shortcode' ) ) {
	/**
	 * Function that add shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes
	 *
	 * @return array
	 */
	function oraiste_core_add_video_button_shortcode( $shortcodes ) {
		$shortcodes[] = 'OraisteCore_Video_Button_Shortcode';

		return $shortcodes;
	}

	add_filter( 'oraiste_core_filter_register_shortcodes', 'oraiste_core_add_video_button_shortcode' );
}

if ( class_exists( 'OraisteCore_Shortcode' ) ) {
	class OraisteCore_Video_Button_Shortcode extends OraisteCore_Shortcode {

		public function map_shortcode() {
			$this->set_shortcode_path( ORAISTE_CORE_SHORTCODES_URL_PATH . '/video-button' );
			$this->set_base( 'oraiste_core_video_button' );
			$this->set_name( esc_html__( 'Video Button', 'oraiste-core' ) );
			$this->set_description( esc_html__( 'Shortcode that adds video button element', 'oraiste-core' ) );
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
					'name'       => 'video_link',
					'title'      => esc_html__( 'Video Link', 'oraiste-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'  => 'image',
					'name'        => 'video_image',
					'title'       => esc_html__( 'Image', 'oraiste-core' ),
					'description' => esc_html__( 'Select image from media library', 'oraiste-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type'    => 'text',
					'name'          => 'play_button_text',
					'title'         => esc_html__( 'Play Button Text', 'oraiste-core' ),
					'default_value' => esc_html__( 'Play Me', 'oraiste-core' ),
				)
			);
			$this->set_option(
				array(
					'field_type' => 'color',
					'name'       => 'play_button_text_color',
					'title'      => esc_html__( 'Play Button Text Color', 'oraiste-core' ),
				)
			);
		}

		public static function call_shortcode( $params ) {
			$html = qode_framework_call_shortcode( 'oraiste_core_video_button', $params );
			$html = str_replace( "\n", '', $html );

			return $html;
		}

		public function render( $options, $content = null ) {
			parent::render( $options );
			$atts = $this->get_atts();

			$atts['holder_classes'] = $this->get_holder_classes( $atts );

			return oraiste_core_get_template_part( 'shortcodes/video-button', 'templates/video-button', '', $atts );
		}

		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[] = 'qodef-video-button';
			$holder_classes[] = ! empty( $atts['video_image'] ) ? 'qodef--has-img' : '';

			return implode( ' ', $holder_classes );
		}
	}
}
