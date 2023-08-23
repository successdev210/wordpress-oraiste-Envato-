<?php

if ( ! function_exists( 'oraiste_core_add_twitter_list_shortcode' ) ) {
	/**
	 * Function that is adding shortcode into shortcodes list for registration
	 *
	 * @param array $shortcodes - Array of registered shortcodes
	 *
	 * @return array
	 */
	function oraiste_core_add_twitter_list_shortcode( $shortcodes ) {
		if ( qode_framework_is_installed( 'twitter' ) ) {
			$shortcodes[] = 'OraisteCore_Twitter_List_Shortcode';
		}

		return $shortcodes;
	}

	add_filter( 'oraiste_core_filter_register_shortcodes', 'oraiste_core_add_twitter_list_shortcode' );
}

if ( class_exists( 'OraisteCore_List_Shortcode' ) ) {
	class OraisteCore_Twitter_List_Shortcode extends OraisteCore_List_Shortcode {

		public function map_shortcode() {
			$this->set_shortcode_path( ORAISTE_CORE_PLUGINS_URL_PATH . '/twitter/shortcodes/twitter-list' );
			$this->set_base( 'oraiste_core_twitter_list' );
			$this->set_name( esc_html__( 'Twitter List', 'oraiste-core' ) );
			$this->set_description( esc_html__( 'Shortcode that displays twitter list', 'oraiste-core' ) );
			$this->set_category( esc_html__( 'Oraiste Core', 'oraiste-core' ) );
			$this->set_option(
				array(
					'field_type' => 'text',
					'name'       => 'custom_class',
					'title'      => esc_html__( 'Custom Class', 'oraiste-core' ),
				)
			);
			$this->map_list_options(
				array(
					'exclude_behavior' => array( 'masonry', 'slider' ),
					'exclude_option'   => array( 'images_proportion' ),
				)
			);
			$this->set_option(
				array(
					'name'       => 'number_of_items',
					'field_type' => 'text',
					'title'      => esc_html__( 'Number of Tweets', 'oraiste-core' ),
					'group'      => esc_html__( 'Info', 'oraiste-core' ),
				)
			);
			$this->set_option(
				array(
					'name'          => 'show_retweeted_text',
					'field_type'    => 'select',
					'title'         => esc_html__( 'Show Retweeted Text', 'oraiste-core' ),
					'options'       => oraiste_core_get_select_type_options_pool( 'yes_no' ),
					'default_value' => 'yes',
					'group'         => esc_html__( 'Info', 'oraiste-core' ),
				)
			);
			$this->set_option(
				array(
					'name'          => 'show_avatar_image',
					'field_type'    => 'select',
					'title'         => esc_html__( 'Show Avatar Image', 'oraiste-core' ),
					'options'       => oraiste_core_get_select_type_options_pool( 'yes_no' ),
					'default_value' => 'yes',
					'group'         => esc_html__( 'Info', 'oraiste-core' ),
				)
			);
			$this->set_option(
				array(
					'name'          => 'show_author_name',
					'field_type'    => 'select',
					'title'         => esc_html__( 'Show Author Name', 'oraiste-core' ),
					'options'       => oraiste_core_get_select_type_options_pool( 'yes_no' ),
					'default_value' => 'yes',
					'group'         => esc_html__( 'Info', 'oraiste-core' ),
				)
			);
			$this->set_option(
				array(
					'name'          => 'show_tweet_text',
					'field_type'    => 'select',
					'title'         => esc_html__( 'Show Tweet Text', 'oraiste-core' ),
					'options'       => oraiste_core_get_select_type_options_pool( 'yes_no' ),
					'default_value' => 'yes',
					'group'         => esc_html__( 'Info', 'oraiste-core' ),
				)
			);
			$this->set_option(
				array(
					'name'          => 'show_media_placeholder',
					'field_type'    => 'select',
					'title'         => esc_html__( 'Show Media Placeholder', 'oraiste-core' ),
					'options'       => oraiste_core_get_select_type_options_pool( 'no_yes' ),
					'default_value' => 'no',
					'group'         => esc_html__( 'Info', 'oraiste-core' ),
				)
			);
			$this->set_option(
				array(
					'name'          => 'show_date',
					'field_type'    => 'select',
					'title'         => esc_html__( 'Show Date', 'oraiste-core' ),
					'options'       => oraiste_core_get_select_type_options_pool( 'yes_no' ),
					'default_value' => 'yes',
					'group'         => esc_html__( 'Info', 'oraiste-core' ),
				)
			);
			$this->set_option(
				array(
					'name'          => 'show_tweet_actions',
					'field_type'    => 'select',
					'title'         => esc_html__( 'Show Tweet Actions', 'oraiste-core' ),
					'options'       => oraiste_core_get_select_type_options_pool( 'yes_no' ),
					'default_value' => 'yes',
					'group'         => esc_html__( 'Info', 'oraiste-core' ),
				)
			);
			$this->set_option(
				array(
					'name'          => 'show_twitter_link',
					'field_type'    => 'select',
					'title'         => esc_html__( 'Show Twitter Link', 'oraiste-core' ),
					'options'       => oraiste_core_get_select_type_options_pool( 'no_yes' ),
					'default_value' => 'no',
					'group'         => esc_html__( 'Info', 'oraiste-core' ),
				)
			);
		}

		public function render( $options, $content = null ) {
			parent::render( $options );

			$atts = $this->get_atts();

			$atts['holder_classes'] = $this->get_holder_classes( $atts );
			$atts['twitter_params'] = $this->get_twitter_params( $atts );

			return oraiste_core_get_template_part( 'plugins/twitter/shortcodes/twitter-list', 'templates/twitter-list', '', $atts );
		}

		private function get_holder_classes( $atts ) {
			$holder_classes = $this->init_holder_classes();

			$holder_classes[] = 'qodef-twitter-list';

			$list_classes   = $this->get_list_classes( $atts );
			$list_classes[] = 'qodef--no-bottom-space';
			if ( isset( $atts['show_tweet_actions'] ) && 'no' === $atts['show_tweet_actions'] && isset( $atts['show_twitter_link'] ) && 'no' === $atts['show_twitter_link'] ) {
				$list_classes[] = 'qodef--no-bottom-info';
			}
			$holder_classes = array_merge( $holder_classes, $list_classes );

			$holder_classes = array_merge( $holder_classes );

			return implode( ' ', $holder_classes );
		}

		private function get_twitter_params( $atts ) {
			$params = array();

			$params['num']        = isset( $atts['number_of_items'] ) && ! empty( $atts['number_of_items'] ) ? $atts['number_of_items'] : 3;
			$params['showheader'] = false;
			$params['creditctf']  = false;
			$params['showbutton'] = false;

			$include = array();
			$exclude = array();
			if ( isset( $atts['show_retweeted_text'] ) && ! empty( $atts['show_retweeted_text'] ) ) {
				if ( 'yes' === $atts['show_retweeted_text'] ) {
					$include[] = 'retweeter';
				} elseif ( 'no' === $atts['show_retweeted_text'] ) {
					$exclude[] = 'retweeter';
				}
			}
			if ( isset( $atts['show_avatar_image'] ) && ! empty( $atts['show_avatar_image'] ) ) {
				if ( 'yes' === $atts['show_avatar_image'] ) {
					$include[] = 'avatar';
				} elseif ( 'no' === $atts['show_avatar_image'] ) {
					$exclude[] = 'avatar';
				}
			}
			if ( isset( $atts['show_author_name'] ) && ! empty( $atts['show_author_name'] ) ) {
				if ( 'yes' === $atts['show_author_name'] ) {
					$include[] = 'author';
				} elseif ( 'no' === $atts['show_author_name'] ) {
					$exclude[] = 'author';
				}
			}
			if ( isset( $atts['show_tweet_text'] ) && ! empty( $atts['show_tweet_text'] ) ) {
				if ( 'yes' === $atts['show_tweet_text'] ) {
					$include[] = 'text';
				} elseif ( 'no' === $atts['show_tweet_text'] ) {
					$exclude[] = 'text';
				}
			}
			if ( isset( $atts['show_media_placeholder'] ) && ! empty( $atts['show_media_placeholder'] ) ) {
				if ( 'yes' === $atts['show_media_placeholder'] ) {
					$include[] = 'placeholder';
				} elseif ( 'no' === $atts['show_media_placeholder'] ) {
					$exclude[] = 'placeholder';
				}
			}
			if ( isset( $atts['show_date'] ) && ! empty( $atts['show_date'] ) ) {
				if ( 'yes' === $atts['show_date'] ) {
					$include[] = 'date';
				} elseif ( 'no' === $atts['show_date'] ) {
					$exclude[] = 'date';
				}
			}
			if ( isset( $atts['show_tweet_actions'] ) && ! empty( $atts['show_tweet_actions'] ) ) {
				if ( 'yes' === $atts['show_tweet_actions'] ) {
					$include[] = 'actions';
				} elseif ( 'no' === $atts['show_tweet_actions'] ) {
					$exclude[] = 'actions';
				}
			}
			if ( isset( $atts['show_twitter_link'] ) && ! empty( $atts['show_twitter_link'] ) ) {
				if ( 'yes' === $atts['show_twitter_link'] ) {
					$include[] = 'twitterlink';
				} elseif ( 'no' === $atts['show_twitter_link'] ) {
					$exclude[] = 'twitterlink';
				}
			}

			$params['include'] = implode( ',', $include );
			$params['exclude'] = implode( ',', $exclude );

			if ( is_array( $params ) && count( $params ) ) {
				foreach ( $params as $key => $value ) {
					if ( '' !== $value ) {
						$params[] = $key . "='" . esc_attr( str_replace( ' ', '', $value ) ) . "'";
					}
				}
			}

			return implode( ' ', $params );
		}
	}
}
