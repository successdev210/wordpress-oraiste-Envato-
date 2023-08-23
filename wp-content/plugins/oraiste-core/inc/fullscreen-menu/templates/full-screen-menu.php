<div id="qodef-fullscreen-area">
	<?php $svg_path = oraiste_get_post_value_through_levels( 'qodef_fullscreen_menu_background_svg_path' ); ?>
	<?php if ( ! empty( $svg_path ) ) : ?>
		<div id="qodef-fullscreen-area-background">
			<?php echo qode_framework_wp_kses_html( 'html', $svg_path ); ?>
		</div>
	<?php endif; ?>
	<?php if ( $fullscreen_menu_in_grid ) : ?>
	<div class="qodef-content-grid">
		<?php endif; ?>
		<div id="qodef-fullscreen-area-inner">
			<?php if ( has_nav_menu( 'fullscreen-menu-navigation' ) ) { ?>
				<nav class="qodef-fullscreen-menu">
					<?php
					wp_nav_menu(
						array(
							'theme_location' => 'fullscreen-menu-navigation',
							'container'      => '',
							'link_before'    => '<span class="qodef-menu-item-text">',
							'link_after'     => '</span>',
							'walker'         => new OraisteCoreRootMainMenuWalker(),
						)
					);
					?>
				</nav>
			<?php } ?>

			<?php
			// include widget area three
			oraiste_core_get_header_widget_area( '', 'three' );
			?>
		</div>
		<?php if ( $fullscreen_menu_in_grid ) : ?>
	</div>
<?php endif; ?>
</div>
