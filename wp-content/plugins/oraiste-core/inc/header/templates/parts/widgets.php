<?php

if ( is_active_sidebar( $default_widget_area ) || ( ! empty( $custom_widget_area ) && is_active_sidebar( $custom_widget_area ) ) ) {
	$classes = array();

	if ( ! empty( $widget_area ) ) {
		$classes[] = 'qodef--' . esc_attr( $widget_area );
	}
	?>
	<div class="qodef-widget-holder <?php echo implode( $classes ); ?>">
		<?php
		if ( is_active_sidebar( $default_widget_area ) && empty( $custom_widget_area ) ) {
			dynamic_sidebar( $default_widget_area );
		} elseif ( ! empty( $custom_widget_area ) && is_active_sidebar( $custom_widget_area ) ) {
			dynamic_sidebar( $custom_widget_area );
		}
		?>
	</div>
<?php } ?>
