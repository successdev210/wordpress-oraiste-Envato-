<?php
$selected_icon_pack = str_replace( '-', '_', $main_icon );

if ( ( 'icon-pack' === $icon_type ) && ! empty( $main_icon ) && ! empty( $icon_params[ 'main_icon_' . $selected_icon_pack ] ) ) {
	echo OraisteCore_Icon_Shortcode::call_shortcode( $icon_params );
}
