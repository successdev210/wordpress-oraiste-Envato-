<?php
$title_tag = isset( $title_tag ) && ! empty( $title_tag ) ? $title_tag : 'h2';
?>
<<?php echo esc_attr( $title_tag ); ?> itemprop="name" class="qodef-e-title entry-title" <?php qode_framework_inline_style( $this_shortcode->get_title_styles( $params ) ); ?>>
	<?php the_title(); ?>
</<?php echo esc_attr( $title_tag ); ?>>
