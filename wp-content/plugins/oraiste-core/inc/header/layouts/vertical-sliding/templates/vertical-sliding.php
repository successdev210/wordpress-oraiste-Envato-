<?php do_action( 'oraiste_action_before_page_header' ); ?>
<header id="qodef-page-header">
	<div id="qodef-page-header-inner" class="<?php echo implode( ' ', apply_filters( 'oraiste_filter_header_inner_class', array(), 'default' ) ); ?>">
		<div class="qodef-vertical-sliding-area qodef--static">
			<?php
			// include logo
			oraiste_core_get_header_logo_image();

			// include opener
			oraiste_core_get_opener_icon_html(
				array(
					'option_name'  => 'vertical_sliding_menu',
					'custom_class' => 'qodef-vertical-sliding-menu-opener',
				),
				true
			);

			// include widget area one
			oraiste_core_get_header_widget_area();
			?>
		</div>
		<div class="qodef-vertical-sliding-area qodef--dynamic">
			<?php
			// include widget area two
			oraiste_core_get_header_widget_area( '', 'two' );

			// include vertical sliding navigation
			oraiste_core_template_part( 'header', 'layouts/vertical-sliding/templates/navigation' );

			// include widget area three
			oraiste_core_get_header_widget_area( '', 'three' );
			?>
		</div>
	</div>
</header>
