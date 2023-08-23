<?php if ( isset( $query_result ) && intval( $query_result->max_num_pages ) > 1 ) { ?>
	<div class="qodef-m-pagination qodef--standard">
		<div class="qodef-m-pagination-inner">
			<nav class="qodef-m-pagination-items" role="navigation">
				<a class="qodef-m-pagination-item qodef--prev" href="#" data-paged="1">
					<?php oraiste_render_svg_icon( 'pagination-arrow-left' ); ?>
				</a>
				<?php
				for ( $i = 1; $i <= intval( $query_result->max_num_pages ); $i ++ ) {
					$classes = 1 === $i ? 'qodef--active' : '';
					// $formatted_i = sprintf( '%02d', $i );
					?>
					<a class="qodef-m-pagination-item qodef--number qodef--number-<?php echo esc_attr( $i ); ?> <?php echo esc_attr( $classes ); ?>" href="#" data-paged="<?php echo esc_attr( $i ); ?>"><?php echo esc_html( $i ); ?></a>
				<?php } ?>
				<a class="qodef-m-pagination-item qodef--next" href="#" data-paged="2">
					<?php oraiste_render_svg_icon( 'pagination-arrow-right' ); ?>
				</a>
			</nav>
		</div>
	</div>
	<?php
	// Include loading spinner
	oraiste_render_svg_icon( 'spinner', 'qodef-m-pagination-spinner' );
	?>
<?php } ?>
