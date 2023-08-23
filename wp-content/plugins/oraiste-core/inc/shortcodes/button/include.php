<?php

include_once ORAISTE_CORE_SHORTCODES_PATH . '/button/class-oraistecore-button-shortcode.php';

foreach ( glob( ORAISTE_CORE_SHORTCODES_PATH . '/button/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
