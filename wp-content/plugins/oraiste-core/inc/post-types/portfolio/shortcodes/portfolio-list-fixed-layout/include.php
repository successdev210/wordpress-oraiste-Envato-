<?php

include_once ORAISTE_CORE_CPT_PATH . '/portfolio/shortcodes/portfolio-list-fixed-layout/class-oraistecore-portfolio-list-fixed-layout-shortcode.php';

foreach ( glob( ORAISTE_CORE_CPT_PATH . '/portfolio/shortcodes/portfolio-list-fixed-layout/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
