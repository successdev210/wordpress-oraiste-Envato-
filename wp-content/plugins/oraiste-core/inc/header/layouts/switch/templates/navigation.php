<?php if ( has_nav_menu( 'switch-menu-navigation' ) || has_nav_menu( 'main-navigation' ) ) { ?>
	<nav class="qodef-header-switch-navigation qodef-custom-header-navigation" role="navigation" aria-label="<?php esc_attr_e( 'Switch Menu', 'oraiste-core' ); ?>">
		<?php
		// Set main navigation menu as vertical if vertical navigation is not set
		$theme_location = has_nav_menu( 'switch-menu-navigation' ) ? 'switch-menu-navigation' : 'main-navigation';

		wp_nav_menu(
			array(
				'theme_location' => $theme_location,
				'container'      => '',
				'link_before'    => '<span class="qodef-menu-item-text">',
				'link_after'     => '</span>',
				'walker'         => new OraisteCoreRootMainMenuWalker(),
			)
		);
		?>
	</nav>
<?php } ?>
