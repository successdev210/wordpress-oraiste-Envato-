<?php

include_once ORAISTE_CORE_SHORTCODES_PATH . '/single-image/class-oraistecore-single-image-shortcode.php';

foreach ( glob( ORAISTE_CORE_SHORTCODES_PATH . '/single-image/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
