<?php

include_once ORAISTE_CORE_INC_PATH . '/blog/shortcodes/blog-list/class-oraistecore-blog-list-shortcode.php';

foreach ( glob( ORAISTE_CORE_INC_PATH . '/blog/shortcodes/blog-list/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
