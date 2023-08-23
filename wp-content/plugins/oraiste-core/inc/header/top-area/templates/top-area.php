<?php if ( $show_header_area ) { ?>
	<div id="qodef-top-area">
		<div id="qodef-top-area-inner" class="<?php echo apply_filters( 'oraiste_core_filter_top_area_inner_class', '' ); ?>">

			<?php
			// Include widget area top left
			if ( is_active_sidebar( 'qodef-top-area-left' ) ) {
				?>
				<div class="qodef-widget-holder qodef-top-area-left">
					<?php oraiste_core_get_header_widget_area( 'top-area-left' ); ?>
				</div>
			<?php } ?>

			<?php
			// Include widget area top right
			if ( is_active_sidebar( 'qodef-top-area-right' ) ) {
				?>
				<div class="qodef-widget-holder qodef-top-area-right">
					<?php oraiste_core_get_header_widget_area( 'top-area-right' ); ?>
				</div>
			<?php } ?>

			<?php do_action( 'oraiste_core_action_after_top_area' ); ?>
		</div>
	</div>
<?php } ?>
