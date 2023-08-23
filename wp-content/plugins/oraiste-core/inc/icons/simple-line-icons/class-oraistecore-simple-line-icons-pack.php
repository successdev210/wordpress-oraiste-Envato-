<?php

if ( ! function_exists( 'oraiste_core_add_simple_line_icons_to_collection' ) ) {
	/**
	 * Function that add icon font pack into the global list
	 *
	 * @param array $icons
	 *
	 * @return array
	 */
	function oraiste_core_add_simple_line_icons_to_collection( $icons ) {
		$icons[] = 'OraisteCore_Simple_Line_Icons_Pack';

		return $icons;
	}

	add_filter( 'qode_framework_filter_add_icon', 'oraiste_core_add_simple_line_icons_to_collection' );
}

if ( class_exists( 'QodeFrameworkIconPack' ) ) {
	class OraisteCore_Simple_Line_Icons_Pack extends QodeFrameworkIconPack {

		public function __construct() {
			parent::__construct();
		}

		public function add_icon_pack() {
			$this->set_base( 'simple-line-icons' );
			$this->set_name( 'Simple Line Icons' );
			$this->set_icons( $this->icons_array() );
			$this->set_specific_icons( $this->specific_icons() );
		}

		public function get_style_url() {
			return ORAISTE_CORE_INC_URL_PATH . '/icons/' . $this->get_base() . '/assets/css/' . $this->get_base() . '.min.css';
		}

		private function icons_array() {
			$icons = array(
				''                        => '',
				'icon-action-redo'        => '\e051',
				'icon-action-undo'        => '\e050',
				'icon-anchor'             => '\e029',
				'icon-arrow-down'         => '\e604',
				'icon-arrow-down-circle'  => '\e07b',
				'icon-arrow-left'         => '\e605',
				'icon-arrow-left-circle'  => '\e07a',
				'icon-arrow-right'        => '\e606',
				'icon-arrow-right-circle' => '\e079',
				'icon-arrow-up'           => '\e607',
				'icon-arrow-up-circle'    => '\e078',
				'icon-badge'              => '\e028',
				'icon-bag'                => '\e04f',
				'icon-ban'                => '\e07c',
				'icon-basket'             => '\e04e',
				'icon-basket-loaded'      => '\e04d',
				'icon-bell'               => '\e027',
				'icon-book-open'          => '\e04c',
				'icon-briefcase'          => '\e04b',
				'icon-bubble'             => '\e07d',
				'icon-bubbles'            => '\e04a',
				'icon-bulb'               => '\e076',
				'icon-calculator'         => '\e049',
				'icon-calendar'           => '\e075',
				'icon-call-end'           => '\e048',
				'icon-call-in'            => '\e047',
				'icon-call-out'           => '\e046',
				'icon-camera'             => '\e07f',
				'icon-camrecorder'        => '\e07e',
				'icon-chart'              => '\e077',
				'icon-check'              => '\e080',
				'icon-chemistry'          => '\e026',
				'icon-clock'              => '\e081',
				'icon-close'              => '\e082',
				'icon-cloud-download'     => '\e083',
				'icon-cloud-upload'       => '\e084',
				'icon-compass'            => '\e045',
				'icon-control-end'        => '\e074',
				'icon-control-forward'    => '\e073',
				'icon-control-pause'      => '\e072',
				'icon-control-play'       => '\e071',
				'icon-control-rewind'     => '\e070',
				'icon-control-start'      => '\e06f',
				'icon-credit-card'        => '\e025',
				'icon-crop'               => '\e024',
				'icon-cup'                => '\e044',
				'icon-cursor'             => '\e06e',
				'icon-cursor-move'        => '\e023',
				'icon-diamond'            => '\e043',
				'icon-direction'          => '\e042',
				'icon-directions'         => '\e041',
				'icon-disc'               => '\e022',
				'icon-dislike'            => '\e06d',
				'icon-doc'                => '\e085',
				'icon-docs'               => '\e040',
				'icon-drawer'             => '\e03f',
				'icon-drop'               => '\e03e',
				'icon-earphones'          => '\e03d',
				'icon-earphones-alt'      => '\e03c',
				'icon-emotsmile'          => '\e021',
				'icon-energy'             => '\e020',
				'icon-envelope'           => '\e086',
				'icon-envelope-letter'    => '\e01f',
				'icon-envelope-open'      => '\e01e',
				'icon-equalizer'          => '\e06c',
				'icon-eye'                => '\e087',
				'icon-eyeglass'           => '\e01d',
				'icon-feed'               => '\e03b',
				'icon-film'               => '\e03a',
				'icon-fire'               => '\e01c',
				'icon-flag'               => '\e088',
				'icon-folder'             => '\e089',
				'icon-folder-alt'         => '\e039',
				'icon-frame'              => '\e038',
				'icon-game-controller'    => '\e01b',
				'icon-ghost'              => '\e01a',
				'icon-globe'              => '\e037',
				'icon-globe-alt'          => '\e036',
				'icon-graduation'         => '\e019',
				'icon-graph'              => '\e06b',
				'icon-grid'               => '\e06a',
				'icon-handbag'            => '\e035',
				'icon-heart'              => '\e08a',
				'icon-home'               => '\e069',
				'icon-hourglass'          => '\e018',
				'icon-info'               => '\e08b',
				'icon-key'                => '\e08c',
				'icon-layers'             => '\e034',
				'icon-like'               => '\e068',
				'icon-link'               => '\e08d',
				'icon-list'               => '\e067',
				'icon-location-pin'       => '\e096',
				'icon-lock'               => '\e08e',
				'icon-lock-open'          => '\e08f',
				'icon-login'              => '\e066',
				'icon-logout'             => '\e065',
				'icon-loop'               => '\e064',
				'icon-magic-wand'         => '\e017',
				'icon-magnet'             => '\e016',
				'icon-magnifier'          => '\e090',
				'icon-magnifier-add'      => '\e091',
				'icon-magnifier-remove'   => '\e092',
				'icon-map'                => '\e033',
				'icon-menu'               => '\e601',
				'icon-microphone'         => '\e063',
				'icon-mouse'              => '\e015',
				'icon-music-tone'         => '\e062',
				'icon-music-tone-alt'     => '\e061',
				'icon-mustache'           => '\e014',
				'icon-note'               => '\e060',
				'icon-notebook'           => '\e013',
				'icon-options'            => '\e603',
				'icon-options-vertical'   => '\e602',
				'icon-paper-clip'         => '\e093',
				'icon-paper-plane'        => '\e094',
				'icon-paypal'             => '\e608',
				'icon-pencil'             => '\e05f',
				'icon-people'             => '\e001',
				'icon-phone'              => '\e600',
				'icon-picture'            => '\e032',
				'icon-pie-chart'          => '\e05e',
				'icon-pin'                => '\e031',
				'icon-plane'              => '\e012',
				'icon-playlist'           => '\e030',
				'icon-plus'               => '\e095',
				'icon-power'              => '\e097',
				'icon-present'            => '\e02f',
				'icon-printer'            => '\e02e',
				'icon-puzzle'             => '\e02d',
				'icon-question'           => '\e05d',
				'icon-refresh'            => '\e098',
				'icon-reload'             => '\e099',
				'icon-rocket'             => '\e05c',
				'icon-screen-desktop'     => '\e011',
				'icon-screen-smartphone'  => '\e010',
				'icon-screen-tablet'      => '\e00f',
				'icon-settings'           => '\e09a',
				'icon-share'              => '\e05b',
				'icon-share-alt'          => '\e05a',
				'icon-shield'             => '\e00e',
				'icon-shuffle'            => '\e059',
				'icon-size-actual'        => '\e058',
				'icon-size-fullscreen'    => '\e057',
				'icon-social-behance'     => '\e610',
				'icon-social-dribbble'    => '\e00d',
				'icon-social-dropbox'     => '\e00c',
				'icon-social-facebook'    => '\e00b',
				'icon-social-foursqare'   => '\e611',
				'icon-social-github'      => '\e60c',
				'icon-social-google'      => '\e60d',
				'icon-social-instagram'   => '\e609',
				'icon-social-linkedin'    => '\e60a',
				'icon-social-pinterest'   => '\e60b',
				'icon-social-reddit'      => '\e60e',
				'icon-social-skype'       => '\e60f',
				'icon-social-soundcloud'  => '\e612',
				'icon-social-spotify'     => '\e613',
				'icon-social-stumbleupon' => '\e614',
				'icon-social-tumblr'      => '\e00a',
				'icon-social-twitter'     => '\e009',
				'icon-social-youtube'     => '\e008',
				'icon-speech'             => '\e02c',
				'icon-speedometer'        => '\e007',
				'icon-star'               => '\e09b',
				'icon-support'            => '\e056',
				'icon-symbol-female'      => '\e09c',
				'icon-symbol-male'        => '\e09d',
				'icon-tag'                => '\e055',
				'icon-target'             => '\e09e',
				'icon-trash'              => '\e054',
				'icon-trophy'             => '\e006',
				'icon-umbrella'           => '\e053',
				'icon-user'               => '\e005',
				'icon-user-female'        => '\e000',
				'icon-user-follow'        => '\e002',
				'icon-user-following'     => '\e003',
				'icon-user-unfollow'      => '\e004',
				'icon-vector'             => '\e02b',
				'icon-volume-1'           => '\e09f',
				'icon-volume-2'           => '\e0a0',
				'icon-volume-off'         => '\e0a1',
				'icon-wallet'             => '\e02a',
				'icon-wrench'             => '\e052',
			);

			$formated_icons = array();
			foreach ( $icons as $icon_key => $icon_value ) {
				$formated_icons[ $icon_key ] = $icon_key;
			}

			return $formated_icons;

		}

		function specific_icons() {
			return array(
				'back-to-top' => 'icon-arrow-up',
				'facebook'    => 'icon-social-facebook',
				'twitter'     => 'icon-social-twitter',
				'linkedin'    => 'icon-social-linkedin',
				'pinterest'   => 'icon-social-pinterest',
				'tumblr'      => 'icon-social-tumblr',
			);
		}
	}
}
