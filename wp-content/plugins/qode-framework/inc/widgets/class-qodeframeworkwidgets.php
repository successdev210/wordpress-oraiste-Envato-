<?php

class QodeFrameworkWidgets {
	private $widgets;

	public function __construct() {
		$this->widgets = array();

		add_action( 'widgets_init', array( $this, 'register' ) );

		add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_dashboard_framework_scripts' ), 5 ); // 5 is set to be same permission as Gutenberg plugin have
	}

	public function get_widgets() {
		return $this->widgets;
	}

	public function get_widget( $base ) {
		return $this->widgets[ $base ];
	}

	private function set_widget( QodeFrameworkWidget $widget ) {
		$key                   = $widget->get_base();
		$this->widgets[ $key ] = $widget;
	}

	public function widget_exists( $base ) {
		return array_key_exists( $base, $this->widgets );
	}

	public function add_widget( QodeFrameworkWidget $widget ) {
		if ( '' !== $widget->get_base() ) {
			$this->set_widget( $widget );

			return $widget;
		}

		return false;
	}

	public function register() {
		do_action( 'qode_framework_action_before_widgets_register' );

		foreach ( $this->widgets as $widget ) {
			$widget->register();
		}

		do_action( 'qode_framework_action_after_widgets_register' );
	}

	public function enqueue_dashboard_framework_scripts( $hook ) {
		if ( 'widgets.php' === $hook ) {
			// Widgets css scripts
			wp_enqueue_style( 'qode-framework-widgets', QODE_FRAMEWORK_INC_URL_PATH . '/widgets/assets/css/widgets.min.css' );

			// Widgets js scripts
			wp_enqueue_script( 'jquery-ui-sortable' );
			wp_enqueue_style( 'fonticonpicker', QODE_FRAMEWORK_INC_URL_PATH . '/common/assets/plugins/fonticonpicker/jquery.fonticonpicker.min.css' );
			wp_enqueue_script( 'fonticonpicker', QODE_FRAMEWORK_INC_URL_PATH . '/common/assets/plugins/fonticonpicker/jquery.fonticonpicker.min.js', array(), false, true );

			// Hook to include additional scripts before dashboard widgets scripts
			do_action( 'qode_framework_action_before_dashboard_widgets_scripts' );

			// Main dashboard js scripts
			wp_enqueue_script( 'qode-framework-script', QODE_FRAMEWORK_INC_URL_PATH . '/common/assets/js/dashboard.min.js', array( 'jquery' ), false, true );
		}
	}
}
