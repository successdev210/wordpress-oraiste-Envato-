<?php

include_once ORAISTE_CORE_CPT_PATH . '/portfolio/shortcodes/horizontal-portfolio-list/class-oraistecore-horizontal-portfolio-list.php';

foreach ( glob( ORAISTE_CORE_CPT_PATH . '/portfolio/shortcodes/horizontal-portfolio-list/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
