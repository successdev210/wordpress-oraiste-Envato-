<?php

include_once ORAISTE_CORE_INC_PATH . '/header/top-area/class-oraistecore-top-area.php';
include_once ORAISTE_CORE_INC_PATH . '/header/top-area/helper.php';

foreach ( glob( ORAISTE_CORE_INC_PATH . '/header/top-area/dashboard/*/*.php' ) as $dashboard ) {
	include_once $dashboard;
}
