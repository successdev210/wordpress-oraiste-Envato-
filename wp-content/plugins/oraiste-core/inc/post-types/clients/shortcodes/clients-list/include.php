<?php

include_once ORAISTE_CORE_CPT_PATH . '/clients/shortcodes/clients-list/class-oraistecore-clients-list-shortcode.php';

foreach ( glob( ORAISTE_CORE_CPT_PATH . '/clients/shortcodes/clients-list/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
