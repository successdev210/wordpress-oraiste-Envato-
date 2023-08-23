<?php

foreach ( glob( ORAISTE_CORE_CPT_PATH . '/testimonials/dashboard/meta-box/*.php' ) as $module ) {
	include_once $module;
}
