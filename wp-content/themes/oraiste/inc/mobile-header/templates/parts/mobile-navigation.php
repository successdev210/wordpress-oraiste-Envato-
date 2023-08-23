<?php if ( has_nav_menu( 'mobile-navigation' ) || has_nav_menu( 'main-navigation' ) ) { ?>
	<nav class="qodef-mobile-header-navigation qodef-mobile-header-navigation-initial" role="navigation" aria-label="<?php esc_attr_e( 'Mobile Menu', 'oraiste' ); ?>">
		<?php
		// Set main navigation menu as mobile if mobile navigation is not set
		$theme_location = has_nav_menu( 'mobile-navigation' ) ? 'mobile-navigation' : 'main-navigation';

		wp_nav_menu(
			array(
				'theme_location' => $theme_location,
				'container'      => '',
				'menu_class'     => 'qodef-content-grid',
				'link_before'    => '<span class="qodef-menu-item-text">',
				'link_after'     => '</span>',
			)
		);
		?>
	</nav>
<?php } ?>
