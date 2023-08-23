<?php
include_once ORAISTE_CORE_CPT_PATH . '/portfolio/shortcodes/portfolio-list-fixed-layout/variations/info-below/hover-animations/hover-animations.php';

foreach ( glob( ORAISTE_CORE_CPT_PATH . '/portfolio/shortcodes/portfolio-list-fixed-layout/variations/info-below/hover-animations/*/include.php' ) as $variation ) {
	include_once $variation;
}