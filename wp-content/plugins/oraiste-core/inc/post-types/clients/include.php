<?php

include_once ORAISTE_CORE_CPT_PATH . '/clients/helper.php';

foreach ( glob( ORAISTE_CORE_CPT_PATH . '/clients/dashboard/meta-box/*.php' ) as $module ) {
	include_once $module;
}
