<?php
// Exit if accessed directly
if ( !defined( 'ABSPATH' ) ) exit;

// BEGIN ENQUEUE PARENT ACTION
// AUTO GENERATED - Do not modify or remove comment markers above or below:

if ( !function_exists( 'chld_thm_cfg_locale_css' ) ):
    function chld_thm_cfg_locale_css( $uri ){
        if ( empty( $uri ) && is_rtl() && file_exists( get_template_directory() . '/rtl.css' ) )
            $uri = get_template_directory_uri() . '/rtl.css';
        return $uri;
    }
endif;
add_filter( 'locale_stylesheet_uri', 'chld_thm_cfg_locale_css' );
if ( !function_exists( 'child_theme_configurator_css' ) ):
 
   
  
    function child_theme_configurator_css() {
        wp_enqueue_style( 'chld_thm_cfg_child', trailingslashit( get_stylesheet_directory_uri() ) . 'style.css', array( 'oraiste-main','magnific-popup','oraiste-style','oraiste-style' ) );
    }
endif;
add_action( 'wp_enqueue_scripts', 'child_theme_configurator_css', 10 );

// Load Assets
function load_assets(){
    wp_enqueue_style( 'custom-fonts',  get_stylesheet_directory_uri() . '/assets/css/custom-fonts.css' );
}
add_action( 'wp_enqueue_scripts', 'load_assets' );


// END ENQUEUE PARENT ACTION
/**
 * Add Font Group
 */
add_filter( 'elementor/fonts/groups', function ( $font_groups ) {
    $font_groups['byers_fonts'] = __( 'Custom Fonts' );
    return $font_groups;
} );

add_filter( 'elementor/fonts/additional_fonts', function ( $additional_fonts ) {
    $additional_fonts['Canela'] = 'byers_fonts';
    return $additional_fonts;
} );