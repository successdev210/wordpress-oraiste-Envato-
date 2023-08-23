<?php

if ( ! function_exists( 'oraiste_core_get_opener_icon_class' ) ) {
	/**
	 * Returns class for icon sources
	 *
	 * @param string $option_name
	 * @param string $custom_class
	 *
	 * @return string
	 */
	function oraiste_core_get_opener_icon_class( $option_name, $custom_class = '' ) {
		$class = array();

		if ( ! empty( $option_name ) ) {
			$icon_source  = oraiste_core_get_option_value( 'admin', 'qodef_' . esc_attr( $option_name ) . '_icon_source' );
			$class_prefix = 'qodef-source';

			if ( 'icon_pack' === $icon_source ) {
				$class[] = $class_prefix . '--icon-pack';
			} elseif ( 'svg_path' === $icon_source ) {
				$class[] = $class_prefix . '--svg-path';
			} elseif ( 'predefined' === $icon_source ) {
				$class[] = $class_prefix . '--predefined';
			}

			if ( ! empty( $custom_class ) ) {
				$class[] = esc_attr( $custom_class );
			}
		}

		return implode( ' ', $class );
	}
}

if ( ! function_exists( 'oraiste_core_get_opener_icon_html' ) ) {
	/**
	 * Returns html for opener icon sources
	 *
	 * @param array $params - opener settings
	 * @param bool  $has_close_icon
	 * @param bool  $set_icon_as_close
	 */
	function oraiste_core_get_opener_icon_html( $params = array(), $has_close_icon = false, $set_icon_as_close = false ) {
		$args = array(
			'html_tag'          => '',
			'option_name'       => '',
			'custom_icon'       => '',
			'custom_id'         => '',
			'custom_class'      => '',
			'inline_style'      => '',
			'inline_attr'       => '',
			'custom_html'       => '',
			'set_icon_as_close' => $set_icon_as_close,
			'has_close_icon'    => $has_close_icon,
		);

		$args = array_merge( $args, $params );

		oraiste_core_template_part( 'opener-icon', 'templates/opener-icon', $args['html_tag'], $args );
	}
}

if ( ! function_exists( 'oraiste_core_get_opener_icon_html_content' ) ) {
	/**
	 * Returns html for opener icon sources
	 *
	 * @param string $option_name - option name
	 * @param bool   $is_close_icon
	 * @param string $custom_icon
	 *
	 * @return string/html
	 */
	function oraiste_core_get_opener_icon_html_content( $option_name, $is_close_icon = false, $custom_icon = '' ) {
		$html = '';

		if ( empty( $option_name ) ) {
			return '';
		}

		if ( empty( $custom_icon ) ) {
			$custom_icon = 'menu';
		}

		$icon_source = oraiste_core_get_option_value( 'admin', 'qodef_' . esc_attr( $option_name ) . '_icon_source' );
		$icon_pack   = oraiste_core_get_option_value( 'admin', 'qodef_' . esc_attr( $option_name ) . '_icon_pack' );

		if ( 'icon_pack' === $icon_source && ! empty( $icon_pack ) ) {
			if ( $is_close_icon ) {
				$html .= qode_framework_icons()->get_specific_icon_from_pack( 'close', $icon_pack );
			} else {
				$html .= qode_framework_icons()->get_specific_icon_from_pack( $custom_icon, $icon_pack );
			}
		} elseif ( 'svg_path' === $icon_source ) {
			$html .= oraiste_core_get_custom_svg_opener_icon_html( $option_name, $is_close_icon );
		} elseif ( 'predefined' === $icon_source ) {
			if ( ! $is_close_icon ) {
				$html .= oraiste_core_get_svg_icon( 'menu' );
			} else {
				$html .= oraiste_core_get_svg_icon( 'close' );
			}
		}

		return $html;
	}
}

if ( ! function_exists( 'oraiste_core_get_custom_svg_opener_icon_html' ) ) {
	/**
	 * Returns html for opener icon
	 *
	 * @param string $option_name - option name
	 * @param bool   $is_close_icon
	 *
	 * @return string/html
	 */
	function oraiste_core_get_custom_svg_opener_icon_html( $option_name, $is_close_icon = false ) {
		$html = '';

		if ( empty( $option_name ) ) {
			return '';
		}

		$icon_svg_path       = oraiste_core_get_option_value( 'admin', 'qodef_' . esc_attr( $option_name ) . '_icon_svg_path' );
		$close_icon_svg_path = oraiste_core_get_option_value( 'admin', 'qodef_' . esc_attr( $option_name ) . '_close_icon_svg_path' );

		if ( $is_close_icon && ! empty( $close_icon_svg_path ) ) {
			$html .= $close_icon_svg_path;
		} elseif ( ! $is_close_icon && ! empty( $icon_svg_path ) ) {
			$html .= $icon_svg_path;
		}

		return $html;
	}
}
