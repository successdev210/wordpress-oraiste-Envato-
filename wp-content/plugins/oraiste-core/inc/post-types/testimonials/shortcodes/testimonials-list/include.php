<?php

include_once ORAISTE_CORE_CPT_PATH . '/testimonials/shortcodes/testimonials-list/class-oraistecore-testimonials-list-shortcode.php';

foreach ( glob( ORAISTE_CORE_CPT_PATH . '/testimonials/shortcodes/testimonials-list/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
