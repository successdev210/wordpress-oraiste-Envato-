<?php if ( isset( $query_result ) && intval( $query_result->max_num_pages ) > 1 ) { ?>
	<div class="qodef-m-pagination qodef--infinite-scroll">
		<?php oraiste_render_svg_icon( 'spinner', 'qodef-m-pagination-spinner' ); ?>
	</div>
<?php } ?>
