<?php
$categories = wp_get_post_terms( $portfolio_item, 'portfolio-category' );

if ( ! empty( $categories ) ) {
	?>
	<div class="qodef-e-categories">
		<?php foreach ( $categories as $cat ) { ?>
			<a itemprop="url" class="qodef-e-category" href="<?php echo esc_url( get_term_link( $cat->term_id ) ); ?>">
				<?php echo esc_html( $cat->name ); ?>
			</a>
		<?php } ?>
	</div>
<?php } ?>
