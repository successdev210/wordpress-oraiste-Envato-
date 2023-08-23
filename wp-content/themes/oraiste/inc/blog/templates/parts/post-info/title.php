<?php
$title_tag = isset( $title_tag ) && ! empty( $title_tag ) ? $title_tag : 'h1';
?>
<?php echo '<' . esc_attr( $title_tag ); ?> itemprop="name" class="qodef-e-title entry-title">
<?php if ( ! is_single() ) : ?>
<a itemprop="url" class="qodef-e-title-link" href="<?php the_permalink(); ?>">
	<?php endif; ?>
	<?php the_title(); ?>
	<?php if ( ! is_single() ) : ?>
</a>
<?php endif; ?>
<?php echo '</' . esc_attr( $title_tag ); ?>>
