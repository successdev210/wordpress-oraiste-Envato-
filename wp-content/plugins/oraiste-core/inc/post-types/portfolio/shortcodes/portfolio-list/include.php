<?php

include_once ORAISTE_CORE_CPT_PATH . '/portfolio/shortcodes/portfolio-list/class-oraistecore-portfolio-list-shortcode.php';

foreach ( glob( ORAISTE_CORE_CPT_PATH . '/portfolio/shortcodes/portfolio-list/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
