<?php

include_once ORAISTE_CORE_CPT_PATH . '/clients/shortcodes/clients-list/variations/image-only/hover-animations/hover-animations.php';

foreach ( glob( ORAISTE_CORE_CPT_PATH . '/clients/shortcodes/clients-list/variations/image-only/hover-animations/*/include.php' ) as $animation ) {
	include_once $animation;
}
