<?php

$portfolio_list_video = get_post_meta( get_the_ID(), 'qodef_portfolio_list_video', true );
$media_template       = ! empty( $portfolio_list_video ) ? 'video' : 'image';

oraiste_core_list_sc_template_part( 'post-types/portfolio/shortcodes/portfolio-list', 'post-info/' . $media_template, '', array_merge( $params, array( 'portfolio_list_video' => $portfolio_list_video ) ) );
