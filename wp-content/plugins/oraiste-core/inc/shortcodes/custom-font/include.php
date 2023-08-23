<?php

include_once ORAISTE_CORE_SHORTCODES_PATH . '/custom-font/class-oraistecore-custom-font-shortcode.php';

foreach ( glob( ORAISTE_CORE_SHORTCODES_PATH . '/custom-font/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
