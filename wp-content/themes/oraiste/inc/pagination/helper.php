<?php

if ( ! function_exists( 'oraiste_add_rest_api_pagination_global_variables' ) ) {
	/**
	 * Extend main rest api variables with new case
	 *
	 * @param array $global - list of variables
	 * @param string $namespace - rest namespace url
	 *
	 * @return array
	 */
	function oraiste_add_rest_api_pagination_global_variables( $global, $namespace ) {
		$global['paginationRestRoute'] = $namespace . '/get-posts';

		return $global;
	}

	add_filter( 'oraiste_filter_rest_api_global_variables', 'oraiste_add_rest_api_pagination_global_variables', 10, 2 );
}

if ( ! function_exists( 'oraiste_add_rest_api_pagination_route' ) ) {
	/**
	 * Extend main rest api routes with new case
	 *
	 * @param array $routes - list of rest routes
	 *
	 * @return array
	 */
	function oraiste_add_rest_api_pagination_route( $routes ) {
		$routes['pagination'] = array(
			'route'    => 'get-posts',
			'methods'  => WP_REST_Server::READABLE,
			'callback' => 'oraiste_get_new_posts',
			'args'     => array(
				'options' => array(
					'required'          => true,
					'validate_callback' => function ( $param, $request, $key ) {
						// Simple solution for validation can be 'is_array' value instead of callback function
						return is_array( $param ) ? $param : (array) $param;
					},
					'description'       => esc_html__( 'Options data is array with all selected shortcode parameters value', 'oraiste' ),
				),
			),
		);

		return $routes;
	}

	add_filter( 'oraiste_filter_rest_api_routes', 'oraiste_add_rest_api_pagination_route' );
}

if ( ! function_exists( 'oraiste_get_new_posts' ) ) {
	/**
	 * Function that load new posts for pagination functionality
	 *
	 * @return void
	 */
	function oraiste_get_new_posts() {

		if ( ! isset( $_GET ) || empty( $_GET ) ) {
			oraiste_get_ajax_status( 'error', esc_html__( 'Get method is invalid', 'oraiste' ) );
		} else {
			$options = isset( $_GET['options'] ) ? (array) $_GET['options'] : array();

			if ( ! empty( $options ) ) {
				$plugin     = $options['plugin'];
				$module     = $options['module'];
				$shortcode  = $options['shortcode'];
				$query_args = oraiste_get_query_params( $options );

				$options['query_result'] = new \WP_Query( $query_args );
				if ( isset( $options['object_class_name'] ) && ! empty( $options['object_class_name'] ) && class_exists( $options['object_class_name'] ) ) {
					$options['this_shortcode'] = new $options['object_class_name'](); // needed for pagination loading items since object is not transferred via data params
				}

				ob_start();

				$get_template_part = $plugin . '_get_template_part';

				// Variable name is function name - escaped no need
				echo apply_filters( "oraiste_filter_{$get_template_part}", $get_template_part( $module . '/' . $shortcode, 'templates/loop', '', $options ) ); // phpcs:ignore WordPress.Security.EscapeOutput.OutputNotEscaped

				$html = ob_get_contents();

				ob_end_clean();

				if ( 'standard' === $options['pagination_type'] ) {
					$pagination_html = oraiste_core_get_theme_template_part( 'pagination', 'templates/pagination', $options['pagination_type'], $options );
				} else {
					$pagination_html = '';
				}

				$data = apply_filters(
					'oraiste_filter_pagination_data_return',
					array(
						'html'            => $html,
						'max_pages_num'   => $options['query_result']->max_num_pages,
						'pagination_html' => $pagination_html,
					),
					$options
				);

				oraiste_get_ajax_status( 'success', esc_html__( 'Items are loaded', 'oraiste' ), $data );
			} else {
				oraiste_get_ajax_status( 'error', esc_html__( 'Options are invalid', 'oraiste' ) );
			}
		}
	}
}

if ( ! function_exists( 'oraiste_get_query_params' ) ) {
	/**
	 * Function that return query parameters
	 *
	 * @param array $params - options value
	 *
	 * @return array
	 */
	function oraiste_get_query_params( $params ) {
		$post_type      = isset( $params['post_type'] ) && ! empty( $params['post_type'] ) ? $params['post_type'] : 'post';
		$posts_per_page = isset( $params['posts_per_page'] ) && ! empty( $params['posts_per_page'] ) ? $params['posts_per_page'] : 12;

		$args = array(
			'post_status'         => 'publish',
			'post_type'           => esc_attr( $post_type ),
			'posts_per_page'      => $posts_per_page,
			'orderby'             => esc_attr( $params['orderby'] ),
			'order'               => esc_attr( $params['order'] ),
			'ignore_sticky_posts' => 1,
		);

		if ( isset( $params['next_page'] ) && ! empty( $params['next_page'] ) ) {
			$args['paged'] = intval( $params['next_page'] );
		} elseif ( ! empty( max( 1, get_query_var( 'paged' ) ) ) ) {
			$args['paged'] = max( 1, get_query_var( 'paged' ) );
		} else {
			$args['paged'] = 1;
		}

		if ( isset( $params['additional_query_args'] ) && ! empty( $params['additional_query_args'] ) ) {
			foreach ( $params['additional_query_args'] as $key => $value ) {
				$args[ esc_attr( $key ) ] = $value;
			}
		}

		return apply_filters( 'oraiste_filter_query_params', $args, $params );
	}
}

if ( ! function_exists( 'oraiste_get_pagination_data' ) ) {
	/**
	 * Function that return pagination data
	 *
	 * @param string $plugin - plugin name
	 * @param string $module - module name
	 * @param string $shortcode - shortcode name
	 * @param string $post_type - post type value
	 * @param array $params - shortcode params
	 *
	 * @return array
	 */
	function oraiste_get_pagination_data( $plugin, $module, $shortcode, $post_type, $params ) {
		$data = array();

		if ( ! empty( $post_type ) && ! empty( $params ) ) {
			$additional_params = array(
				'plugin'        => str_replace( '-', '_', esc_attr( $plugin ) ),
				'module'        => esc_attr( $module ),
				'shortcode'     => esc_attr( $shortcode ),
				'post_type'     => esc_attr( $post_type ),
				'next_page'     => '2',
				'max_pages_num' => $params['query_result']->max_num_pages,
			);

			unset( $params['query_result'] );

			if ( isset( $params['holder_classes'] ) ) {
				unset( $params['holder_classes'] );
			}

			if ( isset( $params['slider_attr'] ) ) {
				unset( $params['slider_attr'] );
			}

			if ( isset( $params['space'] ) && ! empty( $params['space'] ) ) {
				$params['space_value'] = oraiste_get_space_value( $params['space'] );
			}

			$data = json_encode( array_filter( array_merge( $additional_params, $params ) ) );
		}

		return $data;
	}
}

if ( ! function_exists( 'oraiste_add_link_pages_after_content' ) ) {
	/**
	 * Function which add pagination for blog single and page
	 */
	function oraiste_add_link_pages_after_content() {

		$args_pages = array(
			'before'      => '<div class="qodef-single-links qodef-m"><span class="qodef-m-single-links-title">' . esc_html__( 'Pages: ', 'oraiste' ) . '</span>',
			'after'       => '</div>',
			'link_before' => '<span>',
			'link_after'  => '</span>',
			'pagelink'    => '%',
		);

		wp_link_pages( $args_pages );
	}

	add_action( 'oraiste_action_after_blog_single_content', 'oraiste_add_link_pages_after_content' );
	add_action( 'oraiste_action_after_page_content', 'oraiste_add_link_pages_after_content' );
}
