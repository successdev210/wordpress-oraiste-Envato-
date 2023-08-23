<?php

$title_tag = ! empty( $title_tag ) ? esc_attr( $title_tag ) : 'h2';
?>
<<?php echo esc_attr( $title_tag ); ?> itemprop="name" class="qodef-e-title entry-title qodef-portfolio-title"><?php the_title(); ?></<?php echo esc_attr( $title_tag ); ?>>
