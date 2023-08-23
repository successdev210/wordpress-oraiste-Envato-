<?php
// Include mobile logo
oraiste_core_get_mobile_header_logo_image();

// Include mobile widget area one
if ( is_active_sidebar( 'qodef-mobile-header-widget-area' ) ) { ?>
	<div class="qodef-widget-holder qodef--one">
		<?php dynamic_sidebar( 'qodef-mobile-header-widget-area' ); ?>
	</div>
<?php } ?>
<?php
oraiste_core_get_opener_icon_html(
	array(
		'option_name'  => 'fullscreen_menu',
		'custom_class' => 'qodef-fullscreen-menu-opener',
	),
	true
);
?>
