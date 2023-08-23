<?php

include_once ORAISTE_CORE_CPT_PATH . '/team/shortcodes/team-list/class-oraistecore-team-list-shortcode.php';

foreach ( glob( ORAISTE_CORE_CPT_PATH . '/team/shortcodes/team-list/variations/*/include.php' ) as $variation ) {
	include_once $variation;
}
