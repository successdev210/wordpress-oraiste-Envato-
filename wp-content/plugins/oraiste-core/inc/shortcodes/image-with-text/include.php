<?php

include_once ORAISTE_CORE_SHORTCODES_PATH . '/image-with-text/class-oraistecore-image-with-text-shortcode.php';

foreach ( glob( ORAISTE_CORE_SHORTCODES_PATH . '/image-with-text/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
