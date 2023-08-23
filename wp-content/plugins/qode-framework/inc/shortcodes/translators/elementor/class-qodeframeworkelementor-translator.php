<?php

class QodeFrameworkElementor_Translator {
	private static $instance;

	public function __construct() {
		add_action( 'elementor/elements/categories_registered', array( $this, 'add_elementor_widget_category' ) );
		add_action( 'elementor/editor/before_enqueue_scripts', array( $this, 'enqueue_scripts' ) );
		add_action( 'elementor/editor/before_enqueue_scripts', array( $this, 'add_inline_style' ) );
	}

	/**
	 * @return QodeFrameworkElementor_Translator
	 */
	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	public function generate_option_params( $shortcode ) {
		$shortcode_options = $shortcode->get_options();
		$formatted_options = array();

		if ( $shortcode->get_is_parent_shortcode() ) {
			$children = $shortcode->get_child_elements();

			foreach ( $children as $child ) {
				$child_object = qode_framework_get_framework_root()->get_shortcodes()->get_shortcode( $child );

				$shortcode_options['elements_of_child_widget'] = array(
					'field_type' => 'repeater',
					'name'       => 'elements_of_child_widget',
					'title'      => $child_object->get_name(),
					'items'      => array(),
				);

				foreach ( $child_object->get_options() as $child_option_key => $child_option ) {

					$visibility = isset( $child_option['visibility'] ) ? $child_option['visibility'] : array();
					if ( ! isset( $visibility['map_for_page_builder'] ) || ( isset( $visibility['map_for_page_builder'] ) && true === $visibility['map_for_page_builder'] ) ) {
						$shortcode_options['elements_of_child_widget']['items'][] = $child_option;
					}
				}

				if ( $child_object->get_is_parent_shortcode() ) {
					$shortcode_options['elements_of_child_widget']['items'][] = array(
						'field_type' => 'html',
						'name'       => 'content',
						'title'      => esc_html__( 'Content', 'qode-framework' ),
					);
				}
			}
		}

		foreach ( $shortcode_options as $option_key => $option ) {
			$formatted_options = array_merge_recursive( $formatted_options, $this->generate_options_array( $option_key, $option ) );
		}

		return $formatted_options;
	}

	function generate_options_array( $option_key, $option ) {
		$formatted_options = array();

		/*** Visibility Options ***/
		$visibility = isset( $option['visibility'] ) ? $option['visibility'] : array();
		$group      = isset( $option['group'] ) ? str_replace( ' ', '-', strtolower( $option['group'] ) ) . '-elementor' : 'general';

		if ( ! isset( $visibility['map_for_page_builder'] ) || ( isset( $visibility['map_for_page_builder'] ) && true === $visibility['map_for_page_builder'] ) ) {
			$formatted_options[ $group ]['fields'][ $option_key ]['field_type'] = $option['field_type'];
			$formatted_options[ $group ]['fields'][ $option_key ]['label']      = $option['title'];

			if ( isset( $option['default_value'] ) ) {
				$formatted_options[ $group ]['fields'][ $option_key ]['default'] = $option['default_value'];
			}
			if ( isset( $option['options'] ) ) {
				$formatted_options[ $group ]['fields'][ $option_key ]['options'] = $option['options'];

				if ( ! isset( $option['default_value'] ) && ! empty( key( $option['options'] ) ) ) {
					$formatted_options[ $group ]['fields'][ $option_key ]['default'] = key( $option['options'] );
				}
			}
			if ( isset( $option['description'] ) ) {
				$formatted_options[ $group ]['fields'][ $option_key ]['description'] = $option['description'];
			}
			if ( isset( $option['multiple'] ) ) {
				$formatted_options[ $group ]['fields'][ $option_key ]['multiple'] = $option['multiple'];
			}

			/*** Dependency Options ***/

			if ( isset( $option['dependency'] ) ) {
				if ( isset( $option['dependency']['show'] ) ) {
					$dependency     = $option['dependency']['show'];
					$dependency_key = key( $dependency );

					if ( '' === $dependency[ $dependency_key ]['values'] ) {
						$option['condition'] = array(
							$dependency_key => array( '' ),
						);
					} else {
						$option['condition'] = array(
							$dependency_key => $dependency[ $dependency_key ]['values'],
						);
					}
					$formatted_options[ $group ]['fields'][ $option_key ]['condition'] = $option['condition'];
				}

				if ( isset( $option['dependency']['hide'] ) ) {
					$dependency     = $option['dependency']['hide'];
					$dependency_key = key( $dependency );

					if ( '' === $dependency[ $dependency_key ]['values'] ) {
						$option['condition'] = array(
							$dependency_key . '!' => array( '' ),
						);
					} else {
						$option['condition'] = array(
							$dependency_key . '!' => $dependency[ $dependency_key ]['values'],
						);
					}

					$formatted_options[ $group ]['fields'][ $option_key ]['condition'] = $option['condition'];
				}
			}

			/*** Repeater Options ***/
			if ( 'repeater' === $option['field_type'] ) {
				$formatted_options[ $group ]['fields'][ $option_key ]['title_field'] = esc_html__( 'Item', 'qode-framework' );

				foreach ( $option['items'] as $item_key => $item_value ) {
					$formatted_options[ $group ]['fields'][ $option_key ]['items'][ $item_value['name'] ]['label']      = $item_value['title'];
					$formatted_options[ $group ]['fields'][ $option_key ]['items'][ $item_value['name'] ]['field_type'] = $item_value['field_type'];

					if ( isset( $item_value['default_value'] ) ) {
						$formatted_options[ $group ]['fields'][ $option_key ]['items'][ $item_value['name'] ]['default'] = $item_value['default_value'];
					}

					if ( isset( $item_value['multiple'] ) ) {
						$formatted_options[ $group ]['fields'][ $option_key ]['items'][ $item_value['name'] ]['multiple'] = $item_value['multiple'];
					}

					if ( isset( $item_value['options'] ) ) {
						$formatted_options[ $group ]['fields'][ $option_key ]['items'][ $item_value['name'] ]['options'] = $item_value['options'];
					}

					if ( isset( $item_value['description'] ) ) {
						$formatted_options[ $group ]['fields'][ $option_key ]['items'][ $item_value['name'] ]['description'] = $item_value['description'];
					}

					if ( isset( $item_value['dependency'] ) ) {
						if ( isset( $item_value['dependency']['show'] ) ) {
							$dependency     = $item_value['dependency']['show'];
							$dependency_key = key( $dependency );

							if ( '' === $dependency[ $dependency_key ]['values'] ) {
								$item_value['condition'] = array(
									$dependency_key => array( '' ),
								);
							} else {
								$item_value['condition'] = array(
									$dependency_key => $dependency[ $dependency_key ]['values'],
								);
							}

							$formatted_options[ $group ]['fields'][ $option_key ]['items'][ $item_value['name'] ]['condition'] = $item_value['condition'];
						}

						if ( isset( $item_value['dependency']['hide'] ) ) {
							$dependency     = $item_value['dependency']['hide'];
							$dependency_key = key( $dependency );

							if ( '' === $dependency[ $dependency_key ]['values'] ) {
								$item_value['condition'] = array(
									$dependency_key . '!' => array( '' ),
								);
							} else {
								$item_value['condition'] = array(
									$dependency_key . '!' => $dependency[ $dependency_key ]['values'],
								);
							}

							$formatted_options[ $group ]['fields'][ $option_key ]['items'][ $item_value['name'] ]['condition'] = $item_value['condition'];
						}
					}
				}
			}
		}

		return $formatted_options;
	}

	function enqueue_scripts() {
		// Enqueue page builder global style
		wp_enqueue_style( 'qode-framework-elementor', QODE_FRAMEWORK_SHORTCODES_URL_PATH . '/translators/elementor/assets/css/elementor.css' );

		// Get shortcodes styles and register it during the front-end loading, scripts are enqueued on shortcodes loading
		$shortcodes = qode_framework_get_framework_root()->get_shortcodes()->get_shortcodes();

		if ( ! empty( $shortcodes ) && is_array( $shortcodes ) ) {
			foreach ( $shortcodes as $key => $shortcode ) {
				$shortcode_styles = $shortcode->get_necessary_styles();

				if ( is_array( $shortcode_styles ) && count( $shortcode_styles ) > 0 ) {
					foreach ( $shortcode_styles as $style_key => $style ) {

						if ( ! $style['registered'] ) {
							wp_register_style( $style_key, $style['url'] );
						}
					}
				}
			}
		}
	}

	function add_inline_style() {
		$shortcodes = qode_framework_get_framework_root()->get_shortcodes()->get_shortcodes();
		$style      = apply_filters( 'qode_framework_filter_add_elementor_inline_style', $style = '' );

		if ( ! empty( $shortcodes ) && is_array( $shortcodes ) ) {
			ksort( $shortcodes );

			foreach ( $shortcodes as $key => $shortcode ) {
				$shortcode_path = $shortcode->get_shortcode_path();

				if ( isset( $shortcode_path ) && ! empty( $shortcode_path ) ) {
					$icon      = $shortcode->get_is_child_shortcode() ? 'dashboard_child_icon' : 'dashboard_icon';
					$icon_path = $shortcode_path . '/assets/img/' . esc_attr( $icon ) . '.png';

					$style .= '.qodef-custom-elementor-icon.' . str_replace( '_', '-', $key ) . '{
						background-image: url("' . $icon_path . '") !important;
					}';
				}
			}
		}

		if ( ! empty( $style ) ) {
			wp_add_inline_style( 'qode-framework-elementor', $style );
		}
	}

	/**
	 * @param \Elementor\Elements_Manager $elements_manager
	 */
	function add_elementor_widget_category( $elements_manager ) {
		$elements_manager->add_category(
			'qode',
			array(
				'title' => esc_html__( 'Qode', 'qode-framework' ),
				'icon'  => 'fa fa-plug',
			)
		);
	}

	function format_params( $params, $object ) {
		$image_params = $object->get_options_key_by_type( 'image' );

		if ( is_array( $image_params ) && count( $image_params ) > 0 ) {
			foreach ( $image_params as $image_param ) {
				if ( ! empty( $params[ $image_param ] ) ) {
					$option = $object->get_option( $image_param );

					if ( isset( $option['multiple'] ) && 'yes' === $option['multiple'] ) {
						$gallery_array = array();

						foreach ( $params[ $image_param ] as $gallery_item_key => $gallery_item ) {
							$gallery_array[] = $gallery_item['id'];
						}

						$params[ $image_param ] = implode( ',', $gallery_array );
					} else {
						$params[ $image_param ] = $params[ $image_param ]['id'];
					}
				}
			}
		}

		$repeater_params = $object->get_options_key_by_type( 'repeater' );

		if ( is_array( $repeater_params ) && count( $repeater_params ) > 0 ) {
			foreach ( $repeater_params as $repeater_param ) {

				if ( ! empty( $params[ $repeater_param ] ) ) {
					$option = $object->get_option( $repeater_param );

					foreach ( $option['items'] as $item_key => $item ) {

						if ( 'image' === $item['field_type'] ) {

							if ( ! isset( $item['multiple'] ) || ( isset( $item['multiple'] ) && 'yes' !== $item['multiple'] ) ) {
								foreach ( $params[ $repeater_param ] as $repeater_item_key => $repeater_item ) {
									if ( isset( $params[ $repeater_param ][ $repeater_item_key ][ $item['name'] ]['id'] ) ) {
										$params[ $repeater_param ][ $repeater_item_key ][ $item['name'] ] = $params[ $repeater_param ][ $repeater_item_key ][ $item['name'] ]['id'];
									}
								}
							} else {
								foreach ( $params[ $repeater_param ] as $repeater_item_key => $repeater_item ) {
									$gallery_repeater_array = array();

									foreach ( $params[ $repeater_param ][ $repeater_item_key ][ $item['name'] ] as $gallery_repeater_item_key => $gallery_repeater_item ) {
										$gallery_repeater_array[] = $gallery_repeater_item['id'];
									}

									$params[ $repeater_param ][ $repeater_item_key ][ $item['name'] ] = implode( ',', $gallery_repeater_array );
								}
							}
						}
					}
				}

				$params[ $repeater_param ] = urlencode( json_encode( $params[ $repeater_param ] ) );
			}
		}

		if ( ! empty( $params['elements_of_child_widget'] ) ) {
			foreach ( $object->get_child_elements() as $child ) {
				$params['content'] = '';

				foreach ( $params['elements_of_child_widget'] as $child_elements ) {
					$params['content'] .= '[';
					$params['content'] .= $child;
					$params['content'] .= ' ';

					foreach ( $child_elements as $child_element_key => $child_element ) {
						if ( 'content' !== $child_element_key ) {
							$params['content'] .= $child_element_key . '="' . $child_element . '" ';
						}
					}

					if ( isset( $child_elements['content'] ) ) {
						$params['content'] .= ']' . $child_elements['content'];
					}

					$params['content'] .= '[/';
					$params['content'] .= $child;
					$params['content'] .= ']';
				}
			}
		}

		return $params;
	}

	function convert_options_types_to_wpb_types( $option ) {
		$type = $option['field_type'];

		switch ( $type ) :
			case 'text':
				$elementor_type = \Elementor\Controls_Manager::TEXT;
				break;
			case 'textarea':
				$elementor_type = \Elementor\Controls_Manager::TEXTAREA;
				break;
			case 'textarea_html':
				$elementor_type = \Elementor\Controls_Manager::TEXTAREA;
				break;
			case 'html':
				$elementor_type = \Elementor\Controls_Manager::WYSIWYG;
				break;
			case 'select':
				$elementor_type = \Elementor\Controls_Manager::SELECT;
				break;
			case 'checkbox':
				$elementor_type = \Elementor\Controls_Manager::SWITCHER;
				break;
			case 'color':
				$elementor_type = \Elementor\Controls_Manager::COLOR;
				break;
			case 'hidden':
				$elementor_type = \Elementor\Controls_Manager::HIDDEN;
				break;
			case 'image':
				if ( isset( $option['multiple'] ) && 'yes' === $option['multiple'] ) {
					$elementor_type = \Elementor\Controls_Manager::GALLERY;
				} else {
					$elementor_type = \Elementor\Controls_Manager::MEDIA;
				}
				break;
			case 'iconpack':
				$elementor_type = \Elementor\Controls_Manager::SELECT;
				break;
			case 'icon':
				$elementor_type = \Elementor\Controls_Manager::SELECT2;
				break;
			case 'date':
				$elementor_type = \Elementor\Controls_Manager::DATE_TIME;
				break;
			case 'repeater':
				$elementor_type = \Elementor\Controls_Manager::REPEATER;
				break;
			default:
				$elementor_type = \Elementor\Controls_Manager::TEXT;
				break;
		endswitch;

		return $elementor_type;
	}

	function create_controls( $elementor_object, $shortcode_object ) {
		$controls = $this->generate_option_params( $shortcode_object );

		foreach ( $controls as $control_key => $control ) {
			$tab = \Elementor\Controls_Manager::TAB_CONTENT;

			// If options group contain Style word put that options inside Elementor Style tab
			if ( strpos( $control_key, 'style' ) !== false ) {
				$tab = \Elementor\Controls_Manager::TAB_STYLE;
			}

			$elementor_object->start_controls_section(
				$control_key,
				array(
					'label' => ucwords( str_replace( array( '-elementor', '-' ), array( '', ' ' ), $control_key ) ),
					'tab'   => $tab,
				)
			);

			foreach ( $control['fields'] as $field_key => $field ) {
				if ( isset( $field['field_type'] ) && 'repeater' === $field['field_type'] ) {
					$repeater = new \Elementor\Repeater();

					foreach ( $field['items'] as $item_key => $item ) {
						$item['type'] = $this->convert_options_types_to_wpb_types( $item );
						$repeater->add_control(
							$item_key,
							$item
						);
					}

					$field['fields'] = $repeater->get_controls();
					unset( $field['items'] );
				}

				$field['type'] = $this->convert_options_types_to_wpb_types( $field );

				$elementor_object->add_control(
					$field_key,
					$field
				);
			}

			$elementor_object->end_controls_section();
		}

		// Add predefined developer tab content for each shortcode element
		$elementor_object->start_controls_section(
			'developer_tools',
			array(
				'label' => esc_html__( 'Developer Tools', 'qode-framework' ),
				'tab'   => \Elementor\Controls_Manager::TAB_CONTENT,
			)
		);

		$elementor_object->add_control(
			'shortcode_snippet',
			array(
				'label'   => esc_html__( 'Show Shortcode Snippet', 'qode-framework' ),
				'type'    => \Elementor\Controls_Manager::SELECT,
				'default' => 'no',
				'options' => array(
					'no'  => esc_html__( 'No', 'qode-framework' ),
					'yes' => esc_html__( 'Yes', 'qode-framework' ),
				),
			)
		);

		$elementor_object->end_controls_section();
	}

	private function get_shortcode_snippet( $shortcode_object, $params ) {
		$atts = array();

		if ( empty( $shortcode_object ) || ! is_object( $shortcode_object ) ) {
			return '';
		}

		if ( ! empty( $params ) ) {
			foreach ( $params as $key => $value ) {
				if ( is_array( $value ) || 'shortcode_snippet' === $key ) {
					continue;
				}

				$atts[] = $key . '="' . esc_attr( $value ) . '"';
			}
		}

		return sprintf(
			'<textarea rows="3" readonly>[%s %s]</textarea>',
			$shortcode_object->get_base(),
			implode( ' ', $atts )
		);
	}

	function create_render( $shortcode_object, $params ) {
		$params = $this->format_params( $params, $shortcode_object );

		if ( isset( $params['shortcode_snippet'] ) && 'yes' === $params['shortcode_snippet'] ) {
			echo $this->get_shortcode_snippet( $shortcode_object, array_filter( $params ) );
		} elseif ( isset( $params['content'] ) ) { // Handle nested shortcodes
			echo $shortcode_object->render( $params, $params['content'] );
		} else {
			echo $shortcode_object->render( $params );
		}
	}

	function set_scripts( $shortcode ) {
		$shortcode_deps = array();

		if ( is_array( $shortcode->get_scripts() ) && count( $shortcode->get_scripts() ) > 0 ) {
			foreach ( $shortcode->get_scripts() as $handle_key => $handle ) {
				$shortcode_deps[] = $handle_key;
			}
		}

		return $shortcode_deps;
	}

	function set_necessary_styles( $shortcode ) {
		$shortcode_deps = array();

		if ( is_array( $shortcode->get_necessary_styles() ) && count( $shortcode->get_necessary_styles() ) > 0 ) {
			foreach ( $shortcode->get_necessary_styles() as $handle_key => $handle ) {
				$shortcode_deps[] = $handle_key;
			}
		}

		return $shortcode_deps;
	}
}

if ( ! function_exists( 'qode_framework_get_elementor_translator' ) ) {
	/**
	 * Function that return page builder module instance
	 *
	 * @return QodeFrameworkElementor_Translator
	 */
	function qode_framework_get_elementor_translator() {
		if ( qode_framework_is_installed( 'elementor' ) ) {
			return QodeFrameworkElementor_Translator::get_instance();
		}
	}
}

if ( ! function_exists( 'qode_framework_init_elementor_translator' ) ) {
	/**
	 * Function that initialize page builder module
	 */
	function qode_framework_init_elementor_translator() {
		qode_framework_get_elementor_translator();
	}

	add_action( 'init', 'qode_framework_init_elementor_translator', 1 );
}
