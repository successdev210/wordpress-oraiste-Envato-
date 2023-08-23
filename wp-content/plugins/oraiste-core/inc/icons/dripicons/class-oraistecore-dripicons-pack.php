<?php

if ( ! function_exists( 'oraiste_core_add_dripicons_to_collection' ) ) {
	/**
	 * Function that add icon font pack into the global list
	 *
	 * @param array $icons
	 *
	 * @return array
	 */
	function oraiste_core_add_dripicons_to_collection( $icons ) {
		$icons[] = 'OraisteCore_Dripicons_Icon_Pack';

		return $icons;
	}

	add_filter( 'qode_framework_filter_add_icon', 'oraiste_core_add_dripicons_to_collection' );
}

if ( class_exists( 'QodeFrameworkIconPack' ) ) {
	class OraisteCore_Dripicons_Icon_Pack extends QodeFrameworkIconPack {

		public function __construct() {
			parent::__construct();
		}

		public function add_icon_pack() {
			$this->set_base( 'dripicons' );
			$this->set_name( 'Dripicons' );
			$this->set_icons( $this->icons_array() );
			$this->set_specific_icons( $this->specific_icons() );
		}

		public function get_style_url() {
			return ORAISTE_CORE_INC_URL_PATH . '/icons/' . $this->get_base() . '/assets/css/' . $this->get_base() . '.min.css';
		}

		public function icons_array() {
			$icons = array(
				''                            => '',
				'dripicons-alarm'             => '\61',
				'dripicons-align-center'      => '\62',
				'dripicons-align-justify'     => '\63',
				'dripicons-align-left'        => '\64',
				'dripicons-align-right'       => '\65',
				'dripicons-anchor'            => '\66',
				'dripicons-archive'           => '\67',
				'dripicons-arrow-down'        => '\68',
				'dripicons-arrow-left'        => '\69',
				'dripicons-arrow-right'       => '\6a',
				'dripicons-arrow-thin-down'   => '\6b',
				'dripicons-arrow-thin-left'   => '\6c',
				'dripicons-arrow-thin-right'  => '\6d',
				'dripicons-arrow-thin-up'     => '\6e',
				'dripicons-arrow-up'          => '\6f',
				'dripicons-article'           => '\70',
				'dripicons-backspace'         => '\71',
				'dripicons-basket'            => '\72',
				'dripicons-basketball'        => '\73',
				'dripicons-battery-empty'     => '\74',
				'dripicons-battery-full'      => '\75',
				'dripicons-battery-low'       => '\76',
				'dripicons-battery-medium'    => '\77',
				'dripicons-bell'              => '\78',
				'dripicons-blog'              => '\79',
				'dripicons-bluetooth'         => '\7a',
				'dripicons-bold'              => '\41',
				'dripicons-bookmark'          => '\42',
				'dripicons-bookmarks'         => '\43',
				'dripicons-box'               => '\44',
				'dripicons-briefcase'         => '\45',
				'dripicons-brightness-low'    => '\46',
				'dripicons-brightness-max'    => '\47',
				'dripicons-brightness-medium' => '\48',
				'dripicons-broadcast'         => '\49',
				'dripicons-browser'           => '\4a',
				'dripicons-browser-upload'    => '\4b',
				'dripicons-brush'             => '\4c',
				'dripicons-calendar'          => '\4d',
				'dripicons-camcorder'         => '\4e',
				'dripicons-camera'            => '\4f',
				'dripicons-card'              => '\50',
				'dripicons-cart'              => '\51',
				'dripicons-checklist'         => '\52',
				'dripicons-checkmark'         => '\53',
				'dripicons-chevron-down'      => '\54',
				'dripicons-chevron-left'      => '\55',
				'dripicons-chevron-right'     => '\56',
				'dripicons-chevron-up'        => '\57',
				'dripicons-clipboard'         => '\58',
				'dripicons-clock'             => '\59',
				'dripicons-clockwise'         => '\5a',
				'dripicons-cloud'             => '\30',
				'dripicons-cloud-download'    => '\31',
				'dripicons-cloud-upload'      => '\32',
				'dripicons-code'              => '\33',
				'dripicons-contract'          => '\34',
				'dripicons-contract-2'        => '\35',
				'dripicons-conversation'      => '\36',
				'dripicons-copy'              => '\37',
				'dripicons-crop'              => '\38',
				'dripicons-cross'             => '\39',
				'dripicons-crosshair'         => '\21',
				'dripicons-cutlery'           => '\22',
				'dripicons-device-desktop'    => '\23',
				'dripicons-device-mobile'     => '\24',
				'dripicons-device-tablet'     => '\25',
				'dripicons-direction'         => '\26',
				'dripicons-disc'              => '\27',
				'dripicons-document'          => '\28',
				'dripicons-document-delete'   => '\29',
				'dripicons-document-edit'     => '\2a',
				'dripicons-document-new'      => '\2b',
				'dripicons-document-remove'   => '\2c',
				'dripicons-dot'               => '\2d',
				'dripicons-dots-2'            => '\2e',
				'dripicons-dots-3'            => '\2f',
				'dripicons-download'          => '\3a',
				'dripicons-duplicate'         => '\3b',
				'dripicons-enter'             => '\3c',
				'dripicons-exit'              => '\3d',
				'dripicons-expand'            => '\3e',
				'dripicons-expand-2'          => '\3f',
				'dripicons-experiment'        => '\40',
				'dripicons-export'            => '\5b',
				'dripicons-feed'              => '\5d',
				'dripicons-flag'              => '\5e',
				'dripicons-flashlight'        => '\5f',
				'dripicons-folder'            => '\60',
				'dripicons-folder-open'       => '\7b',
				'dripicons-forward'           => '\7c',
				'dripicons-gaming'            => '\7d',
				'dripicons-gear'              => '\7e',
				'dripicons-graduation'        => '\5c',
				'dripicons-graph-bar'         => '\e000',
				'dripicons-graph-line'        => '\e001',
				'dripicons-graph-pie'         => '\e002',
				'dripicons-headset'           => '\e003',
				'dripicons-heart'             => '\e004',
				'dripicons-help'              => '\e005',
				'dripicons-home'              => '\e006',
				'dripicons-hourglass'         => '\e007',
				'dripicons-inbox'             => '\e008',
				'dripicons-information'       => '\e009',
				'dripicons-italic'            => '\e00a',
				'dripicons-jewel'             => '\e00b',
				'dripicons-lifting'           => '\e00c',
				'dripicons-lightbulb'         => '\e00d',
				'dripicons-link'              => '\e00e',
				'dripicons-link-broken'       => '\e00f',
				'dripicons-list'              => '\e010',
				'dripicons-loading'           => '\e011',
				'dripicons-location'          => '\e012',
				'dripicons-lock'              => '\e013',
				'dripicons-lock-open'         => '\e014',
				'dripicons-mail'              => '\e015',
				'dripicons-map'               => '\e016',
				'dripicons-media-loop'        => '\e017',
				'dripicons-media-next'        => '\e018',
				'dripicons-media-pause'       => '\e019',
				'dripicons-media-play'        => '\e01a',
				'dripicons-media-previous'    => '\e01b',
				'dripicons-media-record'      => '\e01c',
				'dripicons-media-shuffle'     => '\e01d',
				'dripicons-media-stop'        => '\e01e',
				'dripicons-medical'           => '\e01f',
				'dripicons-menu'              => '\e020',
				'dripicons-message'           => '\e021',
				'dripicons-meter'             => '\e022',
				'dripicons-microphone'        => '\e023',
				'dripicons-minus'             => '\e024',
				'dripicons-monitor'           => '\e025',
				'dripicons-move'              => '\e026',
				'dripicons-music'             => '\e027',
				'dripicons-network-1'         => '\e028',
				'dripicons-network-2'         => '\e029',
				'dripicons-network-3'         => '\e02a',
				'dripicons-network-4'         => '\e02b',
				'dripicons-network-5'         => '\e02c',
				'dripicons-pamphlet'          => '\e02d',
				'dripicons-paperclip'         => '\e02e',
				'dripicons-pencil'            => '\e02f',
				'dripicons-phone'             => '\e030',
				'dripicons-photo'             => '\e031',
				'dripicons-photo-group'       => '\e032',
				'dripicons-pill'              => '\e033',
				'dripicons-pin'               => '\e034',
				'dripicons-plus'              => '\e035',
				'dripicons-power'             => '\e036',
				'dripicons-preview'           => '\e037',
				'dripicons-print'             => '\e038',
				'dripicons-pulse'             => '\e039',
				'dripicons-question'          => '\e03a',
				'dripicons-reply'             => '\e03b',
				'dripicons-reply-all'         => '\e03c',
				'dripicons-return'            => '\e03d',
				'dripicons-retweet'           => '\e03e',
				'dripicons-rocket'            => '\e03f',
				'dripicons-scale'             => '\e040',
				'dripicons-search'            => '\e041',
				'dripicons-shopping-bag'      => '\e042',
				'dripicons-skip'              => '\e043',
				'dripicons-stack'             => '\e044',
				'dripicons-star'              => '\e045',
				'dripicons-stopwatch'         => '\e046',
				'dripicons-store'             => '\e047',
				'dripicons-suitcase'          => '\e048',
				'dripicons-swap'              => '\e049',
				'dripicons-tag'               => '\e04a',
				'dripicons-tag-delete'        => '\e04b',
				'dripicons-tags'              => '\e04c',
				'dripicons-thumbs-down'       => '\e04d',
				'dripicons-thumbs-up'         => '\e04e',
				'dripicons-ticket'            => '\e04f',
				'dripicons-time-reverse'      => '\e050',
				'dripicons-to-do'             => '\e051',
				'dripicons-toggles'           => '\e052',
				'dripicons-trash'             => '\e053',
				'dripicons-trophy'            => '\e054',
				'dripicons-upload'            => '\e055',
				'dripicons-user'              => '\e056',
				'dripicons-user-group'        => '\e057',
				'dripicons-user-id'           => '\e058',
				'dripicons-vibrate'           => '\e059',
				'dripicons-view-apps'         => '\e05a',
				'dripicons-view-list'         => '\e05b',
				'dripicons-view-list-large'   => '\e05c',
				'dripicons-view-thumb'        => '\e05d',
				'dripicons-volume-full'       => '\e05e',
				'dripicons-volume-low'        => '\e05f',
				'dripicons-volume-medium'     => '\e060',
				'dripicons-volume-off'        => '\e061',
				'dripicons-wallet'            => '\e062',
				'dripicons-warning'           => '\e063',
				'dripicons-web'               => '\e064',
				'dripicons-weight'            => '\e065',
				'dripicons-wifi'              => '\e066',
				'dripicons-wrong'             => '\e067',
				'dripicons-zoom-in'           => '\e068',
				'dripicons-zoom-out'          => '\e069',
			);

			$formatted_icons = array();
			foreach ( $icons as $icon_key => $icon_value ) {
				$formatted_icons[ $icon_key ] = $icon_key;
			}

			return $formatted_icons;
		}

		function specific_icons() {
			return array(
				'search' => 'dripicons-search',
			);
		}
	}
}
