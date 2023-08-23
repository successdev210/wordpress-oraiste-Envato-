<?php

include_once ORAISTE_CORE_CPT_PATH . '/portfolio/shortcodes/horizontal-portfolio-list/variations/info-below/hover-animations/hover-animations.php';

foreach ( glob( ORAISTE_CORE_CPT_PATH . '/portfolio/shortcodes/horizontal-portfolio-list/variations/info-below/hover-animations/*/include.php' ) as $animation ) {
	include_once $animation;
}
