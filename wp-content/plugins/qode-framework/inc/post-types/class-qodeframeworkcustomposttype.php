<?php

abstract class QodeFrameworkCustomPostType {
	private $base;
	private $slug;
	private $slug_setting_name;
	private $menu_position;
	private $menu_icon;
	private $name;
	private $labels;
	private $public;
	private $archive;
	private $show_ui;
	private $show_in_menu;
	private $show_in_rest;
	private $supports;
	private $capability_type;
	private $taxonomies;
	private $path;

	public function __construct() {
		$this->taxonomies = array();
		$this->map_post_type();

		add_action( 'admin_init', array( $this, 'settings_init' ) );
		add_filter( 'single_template', array( $this, 'register_single_template' ) );
	}

	abstract public function map_post_type();

	public function get_base() {
		return $this->base;
	}

	public function set_base( $base ) {
		$this->base = $base;
		$this->set_slug_setting_name();
	}

	public function get_slug_setting_name() {
		return $this->slug_setting_name;
	}

	public function set_slug_setting_name() {
		$this->slug_setting_name = $this->get_base() . '_slug';
	}

	public function get_slug() {
		$slugs             = get_option( 'qode_framework_permalinks' );
		$slug_option_value = isset( $slugs[ $this->get_slug_setting_name() ] ) ? $slugs[ $this->get_slug_setting_name() ] : '';

		return ! empty( $slug_option_value ) ? $slug_option_value : $this->slug;
	}

	public function set_slug( $slug ) {
		$slug       = ! empty( $slug ) ? $slug : $this->get_base();
		$this->slug = $slug;
	}

	public function get_menu_position() {
		return isset( $this->menu_position ) && ! empty( $this->menu_position ) ? $this->menu_position : 5;
	}

	public function set_menu_position( $menu_position ) {
		$this->menu_position = $menu_position;
	}

	public function get_menu_icon() {
		return isset( $this->menu_icon ) && ! empty( $this->menu_icon ) ? $this->menu_icon : 'dashicons-location';
	}

	public function set_menu_icon( $menu_icon ) {
		$this->menu_icon = $menu_icon;
	}

	public function get_name() {
		return isset( $this->name ) && ! empty( $this->name ) ? $this->name : $this->base;
	}

	public function set_name( $name ) {
		$this->name = $name;
	}

	public function get_labels() {
		return isset( $this->labels ) && ! empty( $this->labels ) ? $this->labels : array();
	}

	public function set_labels( $labels ) {
		$this->labels = $labels;
	}

	public function get_public() {
		return isset( $this->public ) ? $this->public : true;
	}

	public function set_public( $public ) {
		$this->public = $public;
	}

	public function get_archive() {
		return isset( $this->archive ) ? $this->archive : true;
	}

	public function set_archive( $archive ) {
		$this->archive = $archive;
	}

	public function get_show_ui() {
		return isset( $this->show_ui ) ? $this->show_ui : true;
	}

	public function set_show_ui( $show_ui ) {
		$this->show_ui = $show_ui;
	}

	public function get_supports() {
		return isset( $this->supports ) && ! empty( $this->supports ) ? $this->supports : array(
			'author',
			'title',
			'editor',
			'thumbnail',
			'excerpt',
			'page-attributes',
			'comments',
		);
	}

	public function set_supports( $supports ) {
		$this->supports = $supports;
	}

	public function get_capability_type() {
		return isset( $this->capability_type ) && ! empty( $this->capability_type ) ? $this->capability_type : 'post';
	}

	public function set_capability_type( $capability_type ) {
		$this->capability_type = $capability_type;
	}

	public function get_path() {
		return isset( $this->path ) && ! empty( $this->path ) ? $this->path : '';
	}

	public function set_path( $path ) {
		$this->path = $path;
	}

	public function get_show_in_menu() {
		return isset( $this->show_in_menu ) && ! empty( $this->show_in_menu ) ? (bool) $this->show_in_menu : true;
	}

	public function set_show_in_menu( $show_in_menu ) {
		$this->show_in_menu = $show_in_menu;
	}

	public function get_show_in_rest() {
		return isset( $this->show_in_rest ) && ! empty( $this->show_in_rest ) ? (bool) $this->show_in_rest : false;
	}

	public function set_show_in_rest( $show_in_rest ) {
		$this->show_in_rest = $show_in_rest;
	}

	public function get_taxonomies() {
		return $this->taxonomies;
	}

	public function get_taxonomy( $base ) {
		return $this->taxonomies[ $base ];
	}

	private function add_taxonomy( QodeFrameworkCustomPostTypeTaxonomy $taxonomy ) {
		$key                      = $taxonomy->get_base();
		$this->taxonomies[ $key ] = $taxonomy;
	}

	function add_post_taxonomy( $params ) {
		if ( isset( $params['base'] ) && ! empty( $params['base'] ) ) {
			$params['post_type']      = $this->get_base();
			$params['post_type_name'] = $this->get_name();
			$params['path']           = $this->get_path();
			$params['has_archive']    = $this->get_archive();
			$taxonomy                 = new QodeFrameworkCustomPostTypeTaxonomy( $params );
			$this->add_taxonomy( $taxonomy );

			return $taxonomy;
		}

		return false;
	}

	public function register() {
		if ( isset( $this->base ) && ! empty( $this->base ) ) {
			$this->register_post_type();
			$this->register_taxonomies();
		}
	}

	private function register_post_type() {
		$capabilities = array();

		if ( $this->get_capability_type() !== 'post' ) {
			$capabilities = array(
				'capability_type' => $this->get_capability_type(),
				'map_meta_cap'    => true,
			);
		}

		register_post_type(
			$this->get_base(),
			array_merge(
				array(
					'labels'        => $this->get_labels(),
					'public'        => $this->get_public(),
					'has_archive'   => $this->get_archive(),
					'rewrite'       => array( 'slug' => $this->get_slug() ),
					'menu_position' => $this->get_menu_position(),
					'show_ui'       => $this->get_show_ui(),
					'show_in_menu'  => $this->get_show_in_menu(),
					'show_in_rest'  => $this->get_show_in_rest(),
					'supports'      => $this->get_supports(),
					'menu_icon'     => $this->get_menu_icon(),
				),
				$capabilities
			)
		);
	}

	private function register_taxonomies() {
		foreach ( $this->get_taxonomies() as $taxonomy ) {
			$taxonomy->register();
		}
	}

	public function settings_init() {
		if ( $this->get_public() ) {
			add_settings_field(
				$this->get_slug_setting_name(),
				$this->get_name() . ' ' . esc_html__( 'base', 'qode-framework' ),
				array( $this, 'post_type_slug_input' ),
				'permalink',
				'optional'
			);
		}
	}

	public function post_type_slug_input() { ?>
		<input name="<?php echo esc_attr( $this->get_slug_setting_name() ); ?>" type="text" class="regular-text code" value="<?php echo esc_attr( $this->get_slug() ); ?>" placeholder="<?php echo esc_attr( $this->get_base() ); ?>"/>
		<?php
	}

	public function register_single_template( $single ) {
		global $post;

		if ( ! empty( $post ) && $post->post_type === $this->get_base() ) {
			if ( ! file_exists( get_stylesheet_directory() . '/single-' . $this->get_base() . '.php' ) ) {
				if ( file_exists( $this->get_path() . '/templates/single-' . $this->get_base() . '.php' ) ) {
					return $this->get_path() . '/templates/single-' . $this->get_base() . '.php';
				}
			}
		}

		return $single;
	}
}
