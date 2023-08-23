<?php

include_once ORAISTE_CORE_INC_PATH . '/social-share/shortcodes/social-share/class-oraistecore-social-share-shortcode.php';

foreach ( glob( ORAISTE_CORE_INC_PATH . '/social-share/shortcodes/social-share/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
