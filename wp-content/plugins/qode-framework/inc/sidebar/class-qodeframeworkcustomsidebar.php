<?php

if ( ! class_exists( 'QodeFrameworkCustomSidebar' ) ) {
	class QodeFrameworkCustomSidebar {
		private $sidebars = array();
		private $db_name  = '';
		private $title    = '';

		function __construct() {
			// Initialize variables
			$this->db_name = 'qode_framework_custom_sidebars';
			$this->title   = esc_html__( 'Custom Sidebar', 'qode-framework' );

			// Add custom sidebar form
			add_action( 'widgets_admin_page', array( $this, 'add_custom_sidebar_form' ) );

			add_action( 'admin_enqueue_scripts', array( $this, 'enqueue_dashboard_sidebar_scripts' ), 5 ); // 5 is set to be same permission as Gutenberg plugin have

			// Register custom sidebar
			add_action( 'widgets_init', array( $this, 'register_custom_sidebar' ), 500 ); // permission 500 is set to custom sidebar be at the last place

			// Add custom sidebar into db
			add_action( 'wp_ajax_qode_framework_add_custom_sidebar', array( $this, 'add_custom_sidebar' ) );

			// Delete custom sidebar from db
			add_action( 'wp_ajax_qode_framework_delete_custom_sidebar', array( $this, 'delete_custom_sidebar' ) );
		}

		function add_custom_sidebar_form() {
			ob_start();

			$this->custom_sidebar_form();

			echo ob_get_clean();
		}

		function custom_sidebar_form() { ?>
			<form class="qodef-custom-sidebar" method="POST">
				<h3 class="qodef-custom-sidebar-title"><?php echo esc_html( $this->title ); ?></h3>
				<p class="qodef-custom-sidebar-description"><?php esc_html_e( 'This area allows you to add Custom widget area on your site', 'qode-framework' ); ?></p>
				<div class="qodef-custom-sidebar-inputs">
					<input type="text" name="qodef-custom-sidebar-name" class="qodef-custom-sidebar-name" value="" placeholder="<?php esc_attr_e( 'Custom Sidebar Name', 'qode-framework' ); ?>" required/>
					<input type="submit" class="qodef-custom-sidebar-button button button-primary" value="<?php esc_attr_e( 'Add Sidebar', 'qode-framework' ); ?>"/>
				</div>
				<div class="qodef-custom-sidebar-response"></div>
				<?php wp_nonce_field( 'qode_framework_validate_custom_sidebar', 'qode_framework_nonce_custom_sidebar' ); ?>
			</form>
			<?php
		}

		function register_custom_sidebar() {

			if ( empty( $this->sidebars ) ) {
				$this->sidebars = get_option( $this->db_name );
			}

			// Sidebar config variables
			$config = $this->get_sidebar_config();

			if ( is_array( $this->sidebars ) ) {
				foreach ( $this->sidebars as $sidebar ) {
					register_sidebar(
						array(
							'id'            => sanitize_title( $sidebar ),
							'class'         => 'qodef-custom-sidebar',
							'name'          => esc_attr( $sidebar ),
							'before_widget' => '<div class="widget %2$s" data-area="' . sanitize_title( $sidebar ) . '">',
							'after_widget'  => '</div>',
							'before_title'  => '<' . esc_attr( $config['title_tag'] ) . ' class="' . esc_attr( $config['title_class'] ) . '">',
							'after_title'   => '</' . esc_attr( $config['title_tag'] ) . '>',
						)
					);
				}
			}
		}

		function add_custom_sidebar() {
			$custom_sidebar_name = isset( $_POST['name'] ) ? sanitize_text_field( $_POST['name'] ) : '';

			if ( ! empty( $custom_sidebar_name ) ) {
				$nonce = $_POST['nonce'];

				if ( wp_verify_nonce( $nonce, 'qode_framework_validate_custom_sidebar' ) ) {
					$this->sidebars = get_option( $this->db_name );
					$sidebar_name   = $this->get_custom_sidebar_name( $custom_sidebar_name );
					$this->sidebars = ! $this->sidebars || empty( $this->sidebars ) ? array( $sidebar_name ) : array_merge( $this->sidebars, array( $sidebar_name ) );

					update_option( $this->db_name, $this->sidebars );

					qode_framework_get_ajax_status( 'success', esc_html__( 'Custom sidebar is added', 'qode-framework' ), null, esc_url( admin_url( 'widgets.php' ) ) );
				} else {
					qode_framework_get_ajax_status( 'error', esc_html__( 'Nonce is invalid', 'qode-framework' ) );
				}
			} else {
				qode_framework_get_ajax_status( 'error', esc_html__( 'POST is invalid', 'qode-framework' ) );
			}
		}

		function delete_custom_sidebar() {
			$custom_sidebar_name = isset( $_POST['name'] ) ? sanitize_text_field( $_POST['name'] ) : '';

			if ( ! empty( $custom_sidebar_name ) ) {
				$nonce = $_POST['nonce'];

				if ( wp_verify_nonce( $nonce, 'qode_framework_validate_custom_sidebar' ) ) {
					$sidebar_name   = stripslashes( $custom_sidebar_name );
					$this->sidebars = get_option( $this->db_name );
					$sidebar_exist  = array_search( $sidebar_name, $this->sidebars );

					if ( false !== $sidebar_exist ) {
						unset( $this->sidebars[ $sidebar_exist ] );
						update_option( $this->db_name, $this->sidebars );

						qode_framework_get_ajax_status( 'success', esc_html__( 'Custom sidebar is deleted', 'qode-framework' ) );
					} else {
						qode_framework_get_ajax_status( 'error', esc_html__( 'Custom sidebar name is invalid', 'qode-framework' ) );
					}
				} else {
					qode_framework_get_ajax_status( 'error', esc_html__( 'Nonce is invalid', 'qode-framework' ) );
				}
			} else {
				qode_framework_get_ajax_status( 'error', esc_html__( 'POST is invalid', 'qode-framework' ) );
			}
		}

		// Checks is custom sidebar submitted and is name available
		function get_custom_sidebar_name( $name ) {

			if ( empty( $GLOBALS['wp_registered_sidebars'] ) ) {
				return $name;
			}

			$taken = array();
			foreach ( $GLOBALS['wp_registered_sidebars'] as $sidebar ) {
				$taken[] = sanitize_text_field( $sidebar['name'] );
			}

			if ( empty( $this->sidebars ) ) {
				$this->sidebars = array();
			}
			$taken = array_merge( $taken, $this->sidebars );

			if ( in_array( $name, $taken, true ) ) {
				$counter  = substr( $name, - 1 );
				$new_name = ! is_numeric( $counter ) ? $name . '1' : substr( $name, 0, - 1 ) . ( (int) $counter + 1 );
				$name     = $this->get_custom_sidebar_name( $new_name );
			}

			return $name;
		}

		public function get_sidebar_config() {

			// Config variables
			$config = apply_filters(
				'qode_framework_filter_main_sidebar_config',
				array(
					'title_tag'   => 'h5',
					'title_class' => 'qodef-widget-title',
				)
			);

			return $config;
		}

		public function get_custom_sidebars( $enable_default = true ) {
			$custom_sidebars = get_option( 'qode_framework_custom_sidebars' );
			$sidebars        = array();

			if ( $enable_default ) {
				$sidebars[''] = esc_html__( 'Default', 'qode-framework' );
			}

			if ( ! empty( $custom_sidebars ) ) {
				foreach ( $custom_sidebars as $custom_sidebar ) {
					$sidebars[ sanitize_title( $custom_sidebar ) ] = $custom_sidebar;
				}
			}

			return $sidebars;
		}

		function enqueue_dashboard_sidebar_scripts( $hook ) {
			if ( 'widgets.php' === $hook ) {
				wp_enqueue_style( 'qode-framework-sidebar', QODE_FRAMEWORK_INC_URL_PATH . '/sidebar/assets/css/sidebar.css' );
				wp_enqueue_script( 'qode-framework-sidebar', QODE_FRAMEWORK_INC_URL_PATH . '/sidebar/assets/js/custom-sidebar.js', array( 'jquery' ) );
			}
		}
	}
}
