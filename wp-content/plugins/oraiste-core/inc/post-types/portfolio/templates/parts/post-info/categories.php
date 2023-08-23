<?php
$categories = wp_get_post_terms( get_the_ID(), 'portfolio-category' );

if ( is_array( $categories ) && count( $categories ) ) { ?>
	<div class="qodef-e qodef-info--category">
		<span class="qodef-e-label"><?php esc_html_e( 'Category: ', 'oraiste-core' ); ?></span>
		<div class="qodef-e-categories">
			<?php foreach ( $categories as $cat ) { ?>
				<a itemprop="url" class="qodef-e-category" href="<?php echo esc_url( get_term_link( $cat->term_id ) ); ?>"><?php echo esc_html( $cat->name ); ?></a>
			<?php } ?>
		</div>
	</div>
<?php } ?>
