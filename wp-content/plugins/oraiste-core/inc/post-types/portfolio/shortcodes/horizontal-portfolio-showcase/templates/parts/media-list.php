<?php
$template = ! empty( get_post_meta( $portfolio_item, 'qodef_portfolio_list_video', true ) ) ? 'video' : 'image';
oraiste_core_template_part( 'post-types/portfolio/shortcodes/horizontal-portfolio-showcase', 'templates/parts/' . $template, 'list', $params );
