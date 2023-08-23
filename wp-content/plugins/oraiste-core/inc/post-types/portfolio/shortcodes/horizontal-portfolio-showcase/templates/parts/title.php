<?php
$title     = get_the_title( $portfolio_item );
$title_tag = isset( $title_tag ) && ! empty( $title_tag ) ? $title_tag : 'h3';

if ( ! empty( $title ) ) {
	?>
	<<?php echo esc_attr( $title_tag ); ?> itemprop="name" class="qodef-e-title entry-title">
		<a itemprop="url" class="qodef-e-title-link" href="<?php echo esc_url( get_the_permalink( $portfolio_item ) ); ?>">
			<?php echo esc_html( $title ); ?>
		</a>
	</<?php echo esc_attr( $title_tag ); ?>>
	<?php
}
