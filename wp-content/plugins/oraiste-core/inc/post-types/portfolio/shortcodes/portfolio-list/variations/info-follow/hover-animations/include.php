<?php

include_once ORAISTE_CORE_CPT_PATH . '/portfolio/shortcodes/portfolio-list/variations/info-follow/hover-animations/hover-animations.php';

foreach ( glob( ORAISTE_CORE_CPT_PATH . '/portfolio/shortcodes/portfolio-list/variations/info-follow/hover-animations/*/include.php' ) as $animation ) {
	include_once $animation;
}
