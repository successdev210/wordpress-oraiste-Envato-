<?php

require_once QODE_FRAMEWORK_SHORTCODES_PATH . '/class-qodeframeworkshortcodes.php';
require_once QODE_FRAMEWORK_SHORTCODES_PATH . '/class-qodeframeworkshortcode.php';

foreach ( glob( QODE_FRAMEWORK_SHORTCODES_PATH . '/translators/*/*-translator.php' ) as $translator ) {
	require_once $translator;
}
