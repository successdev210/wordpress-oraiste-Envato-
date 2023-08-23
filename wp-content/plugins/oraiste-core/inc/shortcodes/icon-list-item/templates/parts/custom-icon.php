<?php

if ( 'custom-icon' === $icon_type && ! empty( $custom_icon ) ) {
	echo wp_get_attachment_image( $custom_icon, 'full' );
}
