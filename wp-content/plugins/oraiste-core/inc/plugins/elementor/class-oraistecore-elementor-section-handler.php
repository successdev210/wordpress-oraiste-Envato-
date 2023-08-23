<?php

class OraisteCore_Elementor_Section_Handler {
	private static $instance;
	public $sections = array();
	public $columns = array();

	public function __construct() {
		// section extension
		add_action( 'elementor/element/section/_section_responsive/after_section_end', array( $this, 'render_parallax_options' ), 10, 2 );
		add_action( 'elementor/element/section/_section_responsive/after_section_end', array( $this, 'render_offset_options' ), 10, 2 );
		add_action( 'elementor/element/section/_section_responsive/after_section_end', array( $this, 'render_grid_options' ), 10, 2 );
		add_action( 'elementor/frontend/section/before_render', array( $this, 'section_before_render' ) );
		add_action( 'elementor/frontend/element/before_render', array( $this, 'section_before_render' ) );

		// column extension
		add_action( 'elementor/element/column/_section_responsive/after_section_end', array( $this, 'render_background_text_options', ), 10, 2 );
		add_action( 'elementor/frontend/column/before_render', array( $this, 'column_before_render' ) );
		add_action( 'elementor/frontend/element/before_render', array( $this, 'column_before_render' ) );

		// common stuff
		add_action( 'elementor/frontend/before_enqueue_styles', array( $this, 'enqueue_styles' ), 9 );
		add_action( 'elementor/frontend/before_enqueue_scripts', array( $this, 'enqueue_scripts' ), 9 );
	}

	/**
	 * @return OraisteCore_Elementor_Section_Handler
	 */
	public static function get_instance() {
		if ( is_null( self::$instance ) ) {
			self::$instance = new self();
		}

		return self::$instance;
	}

	// section extension
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	public function render_parallax_options( $section, $args ) {
		$section->start_controls_section(
			'qodef_parallax',
			[
				'label' => esc_html__( 'Oraiste Parallax', 'oraiste-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_ADVANCED,
			]
		);

		$section->add_control(
			'qodef_parallax_type',
			[
				'label'       => esc_html__( 'Enable Parallax', 'oraiste-core' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'default'     => 'no',
				'options'     => [
					'no'       => esc_html__( 'No', 'oraiste-core' ),
					'parallax' => esc_html__( 'Yes', 'oraiste-core' ),
				],
				'render_type' => 'template',
			]
		);

		$section->add_control(
			'qodef_parallax_image',
			[
				'label'       => esc_html__( 'Parallax Background Image', 'oraiste-core' ),
				'type'        => \Elementor\Controls_Manager::MEDIA,
				'condition'   => [
					'qodef_parallax_type' => 'parallax',
				],
				'render_type' => 'template',
			]
		);

		$section->add_control(
			'qodef_parallax_hide_on_mobile',
			[
				'label'        => esc_html__( 'Hide Image On Mobile', 'oraiste-core' ),
				'description'  => esc_html__( 'Enable this option to prevent the image from being displayed on devices with screens below 1024px (recommended). Note that if the image remains displayed on mobile devices, the parallax effect will not be applied.', 'oraiste-core' ),
				'type'         => \Elementor\Controls_Manager::SELECT,
				'default'      => 'show',
				'options'      => [
					'show' => esc_html__( 'No', 'oraiste-core' ),
					'hide' => esc_html__( 'Yes', 'oraiste-core' ),
				],
				'condition'    => [
					'qodef_parallax_type' => 'parallax',
				],
				'render_type'  => 'template',
				'prefix_class' => 'qodef-parallax-mobile--',
			]
		);

		$section->end_controls_section();
	}

	public function render_offset_options( $section, $args ) {
		$section->start_controls_section(
			'qodef_offset',
			[
				'label' => esc_html__( 'Oraiste Offset Image', 'oraiste-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_ADVANCED,
			]
		);

		$section->add_control(
			'qodef_offset_type',
			[
				'label'       => esc_html__( 'Enable Offset Image', 'oraiste-core' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'default'     => 'no',
				'options'     => [
					'no'     => esc_html__( 'No', 'oraiste-core' ),
					'offset' => esc_html__( 'Yes', 'oraiste-core' ),
				],
				'render_type' => 'template',
			]
		);

		$section->add_control(
			'qodef_offset_image',
			[
				'label'       => esc_html__( 'Offset Image', 'oraiste-core' ),
				'type'        => \Elementor\Controls_Manager::MEDIA,
				'condition'   => [
					'qodef_offset_type' => 'offset',
				],
				'render_type' => 'template',
			]
		);

		$section->add_control(
			'qodef_offset_top',
			[
				'label'       => esc_html__( 'Offset Image Top Position', 'oraiste-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => '50%',
				'condition'   => [
					'qodef_offset_type' => 'offset',
				],
				'render_type' => 'template',
			]
		);

		$section->add_control(
			'qodef_offset_left',
			[
				'label'       => esc_html__( 'Offset Image Left Position', 'oraiste-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'default'     => '50%',
				'condition'   => [
					'qodef_offset_type' => 'offset',
				],
				'render_type' => 'template',
			]
		);

		$section->end_controls_section();
	}

	public function render_grid_options( $section, $args ) {
		$section->start_controls_section(
			'qodef_grid_row',
			[
				'label' => esc_html__( 'Oraiste Grid', 'oraiste-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_ADVANCED,
			]
		);

		$section->add_control(
			'qodef_enable_grid_row',
			[
				'label'        => esc_html__( 'Make this row "In Grid"', 'oraiste-core' ),
				'type'         => \Elementor\Controls_Manager::SELECT,
				'default'      => 'no',
				'options'      => [
					'no'   => esc_html__( 'No', 'oraiste-core' ),
					'grid' => esc_html__( 'Yes', 'oraiste-core' ),
				],
				'prefix_class' => 'qodef-elementor-content-',
			]
		);

		$section->add_control(
			'qodef_grid_row_behavior',
			[
				'label'        => esc_html__( 'Grid Row Behavior', 'oraiste-core' ),
				'type'         => \Elementor\Controls_Manager::SELECT,
				'default'      => '',
				'options'      => [
					''      => esc_html__( 'Default', 'oraiste-core' ),
					'right' => esc_html__( 'Extend Grid Right', 'oraiste-core' ),
					'left'  => esc_html__( 'Extend Grid Left', 'oraiste-core' ),
				],
				'condition'    => [
					'qodef_enable_grid_row' => 'grid',
				],
				'prefix_class' => 'qodef-extended-grid qodef-extended-grid--',
			]
		);

		$section->end_controls_section();
	}

	public function section_before_render( $widget ) {
		$data     = $widget->get_data();
		$type     = isset( $data['elType'] ) ? $data['elType'] : 'section';
		$settings = $data['settings'];

		if ( 'section' === $type ) {
			if ( isset( $settings['qodef_parallax_type'] ) && 'parallax' === $settings['qodef_parallax_type'] ) {
				$parallax_type  = $widget->get_settings_for_display( 'qodef_parallax_type' );
				$parallax_image = $widget->get_settings_for_display( 'qodef_parallax_image' );

				if ( ! in_array( $data['id'], $this->sections, true ) ) {
					$this->sections[$data['id']][] = array(
						'parallax_type'  => $parallax_type,
						'parallax_image' => $parallax_image,
					);
				}
			}

			if ( isset( $settings['qodef_offset_type'] ) && 'offset' === $settings['qodef_offset_type'] ) {
				$offset_type  = $widget->get_settings_for_display( 'qodef_offset_type' );
				$offset_image = $widget->get_settings_for_display( 'qodef_offset_image' );
				$offset_top   = $widget->get_settings_for_display( 'qodef_offset_top' );
				$offset_left  = $widget->get_settings_for_display( 'qodef_offset_left' );

				if ( ! in_array( $data['id'], $this->sections, true ) ) {
					$this->sections[$data['id']][] = array(
						'offset_type'  => $offset_type,
						'offset_image' => $offset_image,
						'offset_top'   => $offset_top,
						'offset_left'  => $offset_left,
					);
				}
			}
		}
	}

	// column extension
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	public function render_background_text_options( $column, $args ) {
		$column->start_controls_section(
			'qodef_background_text_holder',
			[
				'label' => esc_html__( 'Oraiste Core Background Text', 'oraiste-core' ),
				'tab'   => \Elementor\Controls_Manager::TAB_ADVANCED,
			]
		);

		$column->add_control(
			'qodef_background_text_enable',
			[
				'label'       => esc_html__( 'Enable Background Text', 'oraiste-core' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'default'     => 'no',
				'options'     => [
					'no'  => esc_html__( 'No', 'oraiste-core' ),
					'yes' => esc_html__( 'Yes', 'oraiste-core' ),
				],
				'render_type' => 'template',
			]
		);

		$column->add_control(
			'qodef_background_text',
			[
				'label'       => esc_html__( 'Text', 'oraiste-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'condition'   => [
					'qodef_background_text_enable' => 'yes',
				],
				'render_type' => 'template',
			]
		);

		$column->add_control(
			'qodef_background_text_color',
			[
				'label'       => esc_html__( 'Text Color', 'oraiste-core' ),
				'type'        => \Elementor\Controls_Manager::COLOR,
				'condition'   => [
					'qodef_background_text_enable' => 'yes',
				],
				'render_type' => 'template',
			]
		);

		$column->add_control(
			'qodef_background_text_size',
			[
				'label'       => esc_html__( 'Text Size (px)', 'oraiste-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'condition'   => [
					'qodef_background_text_enable' => 'yes',
				],
				'render_type' => 'template',
			]
		);

		$column->add_control(
			'qodef_background_text_size_1440',
			[
				'label'       => esc_html__( 'Text Size - between 1440 and 1367 (px)', 'oraiste-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'condition'   => [
					'qodef_background_text_enable' => 'yes',
				],
				'render_type' => 'template',
			]
		);

		$column->add_control(
			'qodef_background_text_size_1366',
			[
				'label'       => esc_html__( 'Text Size - between 1366 and 1025 (px)', 'oraiste-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'condition'   => [
					'qodef_background_text_enable' => 'yes',
				],
				'render_type' => 'template',
			]
		);

		$column->add_control(
			'qodef_background_text_size_1024',
			[
				'label'       => esc_html__( 'Text Size - below 1024 (px)', 'oraiste-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'condition'   => [
					'qodef_background_text_enable' => 'yes',
				],
				'render_type' => 'template',
			]
		);

		$column->add_control(
			'qodef_background_text_vertical_offset',
			[
				'label'       => esc_html__( 'Vertical Offset (px)', 'oraiste-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'condition'   => [
					'qodef_background_text_enable' => 'yes',
				],
				'render_type' => 'template',
			]
		);

		$column->add_control(
			'qodef_background_text_vertical_offset_1440',
			[
				'label'       => esc_html__( 'Vertical Offset - between 1440 and 1367 (px)', 'oraiste-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'condition'   => [
					'qodef_background_text_enable' => 'yes',
				],
				'render_type' => 'template',
			]
		);

		$column->add_control(
			'qodef_background_text_vertical_offset_1366',
			[
				'label'       => esc_html__( 'Vertical Offset - between 1366 and 1025 (px)', 'oraiste-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'condition'   => [
					'qodef_background_text_enable' => 'yes',
				],
				'render_type' => 'template',
			]
		);

		$column->add_control(
			'qodef_background_text_vertical_offset_1024',
			[
				'label'       => esc_html__( 'Vertical Offset - below 1024 (px)', 'oraiste-core' ),
				'type'        => \Elementor\Controls_Manager::TEXT,
				'condition'   => [
					'qodef_background_text_enable' => 'yes',
				],
				'render_type' => 'template',
			]
		);

		$column->add_control(
			'qodef_background_text_horizontal_align',
			[
				'label'       => esc_html__( 'Horizontal Align', 'oraiste-core' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'default'     => 'flex-start',
				'options'     => [
					'flex-start' => esc_html__( 'Left', 'oraiste-core' ),
					'center'     => esc_html__( 'Center', 'oraiste-core' ),
					'flex-end'   => esc_html__( 'Right', 'oraiste-core' ),
				],
				'condition'   => [
					'qodef_background_text_enable' => 'yes',
				],
				'render_type' => 'template',
			]
		);

		$column->add_control(
			'qodef_background_text_vertical_align',
			[
				'label'       => esc_html__( 'Vertical Align', 'oraiste-core' ),
				'type'        => \Elementor\Controls_Manager::SELECT,
				'default'     => 'flex-start',
				'options'     => [
					'flex-start' => esc_html__( 'Top', 'oraiste-core' ),
					'center'     => esc_html__( 'Middle', 'oraiste-core' ),
					'flex-end'   => esc_html__( 'Bottom', 'oraiste-core' ),
				],
				'condition'   => [
					'qodef_background_text_enable' => 'yes',
				],
				'render_type' => 'template',
			]
		);

		$column->end_controls_section();
	}

	public function column_before_render( $widget ) {
		$data     = $widget->get_data();
		$type     = isset( $data['elType'] ) ? $data['elType'] : 'column';
		$settings = $data['settings'];

		if ( 'column' === $type ) {
			if ( isset( $settings['qodef_background_text_enable'] ) && $settings['qodef_background_text_enable'] == 'yes' ) {
				$background_text                      = $widget->get_settings_for_display( 'qodef_background_text' );
				$background_text_color                = $widget->get_settings_for_display( 'qodef_background_text_color' );
				$background_text_size                 = $widget->get_settings_for_display( 'qodef_background_text_size' );
				$background_text_size_1440            = $widget->get_settings_for_display( 'qodef_background_text_size_1440' );
				$background_text_size_1366            = $widget->get_settings_for_display( 'qodef_background_text_size_1366' );
				$background_text_size_1024            = $widget->get_settings_for_display( 'qodef_background_text_size_1024' );
				$background_text_vertical_offset      = $widget->get_settings_for_display( 'qodef_background_text_vertical_offset' );
				$background_text_vertical_offset_1440 = $widget->get_settings_for_display( 'qodef_background_text_vertical_offset_1440' );
				$background_text_vertical_offset_1366 = $widget->get_settings_for_display( 'qodef_background_text_vertical_offset_1366' );
				$background_text_vertical_offset_1024 = $widget->get_settings_for_display( 'qodef_background_text_vertical_offset_1024' );
				$background_text_horizontal_align     = $widget->get_settings_for_display( 'qodef_background_text_horizontal_align' );
				$background_text_vertical_align       = $widget->get_settings_for_display( 'qodef_background_text_vertical_align' );

				if ( ! in_array( $data['id'], $this->columns ) ) {
					$this->columns[$data['id']] = [
						$background_text,
						$background_text_color,
						$background_text_size,
						$background_text_size_1440,
						$background_text_size_1366,
						$background_text_size_1024,
						$background_text_vertical_offset,
						$background_text_vertical_offset_1440,
						$background_text_vertical_offset_1366,
						$background_text_vertical_offset_1024,
						$background_text_horizontal_align,
						$background_text_vertical_align,
					];
				}

				$widget->add_render_attribute( '_wrapper', 'class', 'qodef-background-text' );
			}
		}
	}

	// common stuff
	//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	public function enqueue_styles() {
		wp_enqueue_style( 'oraiste-core-elementor', ORAISTE_CORE_PLUGINS_URL_PATH . '/elementor/assets/css/elementor.min.css' );
	}

	public function enqueue_scripts() {
		wp_enqueue_script( 'oraiste-core-elementor', ORAISTE_CORE_PLUGINS_URL_PATH . '/elementor/assets/js/elementor.js', array( 'jquery', 'elementor-frontend' ) );

		$elementor_global_vars = array(
			'elementorSectionHandler' => $this->sections,
			'elementorColumnHandler'  => $this->columns,
		);

		wp_localize_script(
			'oraiste-core-elementor',
			'qodefElementorGlobal',
			array(
				'vars' => $elementor_global_vars,
			)
		);
	}
}

if ( ! function_exists( 'oraiste_core_init_elementor_section_handler' ) ) {
	/**
	 * Function that initialize main page builder handler
	 */
	function oraiste_core_init_elementor_section_handler() {
		OraisteCore_Elementor_Section_Handler::get_instance();
	}

	add_action( 'init', 'oraiste_core_init_elementor_section_handler', 1 );
}
