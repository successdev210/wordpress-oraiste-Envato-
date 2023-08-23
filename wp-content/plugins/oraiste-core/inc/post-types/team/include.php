<?php

include_once ORAISTE_CORE_CPT_PATH . '/team/helper.php';

foreach ( glob( ORAISTE_CORE_CPT_PATH . '/team/dashboard/meta-box/*.php' ) as $module ) {
	include_once $module;
}
