<?php

if ( ! function_exists( 'oraiste_core_filter_clients_list_image_only_no_hover' ) ) {
    /**
     * Function that add variation layout for this module
     *
     * @param array $variations
     *
     * @return array
     */
    function oraiste_core_filter_clients_list_image_only_no_hover( $variations ) {
        $variations['no-hover'] = esc_html__( 'No Hover', 'oraiste-core' );

        return $variations;
    }

    add_filter( 'oraiste_core_filter_clients_list_image_only_animation_options', 'oraiste_core_filter_clients_list_image_only_no_hover' );
}