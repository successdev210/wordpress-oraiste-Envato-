<?php

include_once ORAISTE_CORE_CPT_PATH . '/portfolio/shortcodes/interactive-portfolio-list/class-oraistecore-interactive-portfolio-list-shortcode.php';

foreach ( glob( ORAISTE_CORE_CPT_PATH . '/portfolio/shortcodes/interactive-portfolio-list/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
