<?php
$is_enabled = oraiste_core_get_post_value_through_levels( 'qodef_blog_single_enable_single_post_navigation' );

if ( 'yes' === $is_enabled ) {
	$through_same_category = 'yes' === oraiste_core_get_post_value_through_levels( 'qodef_blog_single_post_navigation_through_same_category' );
	?>
	<div id="qodef-single-post-navigation" class="qodef-m">
		<div class="qodef-m-inner">
			<?php
			$post_navigation = array(
				'prev' => array(
					'label' => '<span class="qodef-m-nav-label">' . esc_html__( 'Prev post', 'oraiste-core' ) . '</span>',
					'icon'  => oraiste_core_get_svg_icon( 'navigation-arrow-left', 'qodef-m-nav-icon' ),
				),
				'next' => array(
					'label' => '<span class="qodef-m-nav-label">' . esc_html__( 'Next post', 'oraiste-core' ) . '</span>',
					'icon'  => oraiste_core_get_svg_icon( 'navigation-arrow-right', 'qodef-m-nav-icon' ),
				),
			);

			if ( $through_same_category ) {
				if ( '' !== get_previous_post( true ) ) {
					$post_navigation['prev']['post'] = get_previous_post( true );
				}
				if ( '' !== get_next_post( true ) ) {
					$post_navigation['next']['post'] = get_next_post( true );
				}
			} else {
				if ( '' !== get_previous_post() ) {
					$post_navigation['prev']['post'] = get_previous_post();
				}
				if ( '' !== get_next_post() ) {
					$post_navigation['next']['post'] = get_next_post();
				}
			}

			foreach ( $post_navigation as $key => $value ) {
				if ( isset( $post_navigation[$key]['post'] ) ) {
					$current_post = $value['post'];
					$post_id      = $current_post->ID;
					?>
					<a itemprop="url" class="qodef-m-nav qodef--<?php echo esc_attr( $key ); ?>" href="<?php echo get_permalink( $post_id ); ?>">
						<span class="qodef-m-nav-content">
							<?php echo wp_kses( $value['label'], array( 'span' => array( 'class' => true ) ) ); ?>
							<?php echo qode_framework_wp_kses_html( 'svg', $value['icon'] ); ?>
						</span>
						<?php echo get_the_post_thumbnail( $post_id, 'thumbnail', array( 'class' => 'qodef-m-nav-image' ) ); ?>
					</a>
					<?php
				} else {
					echo '<span class="qodef-m-nav"></span>';
				}
			}
			?>
		</div>
	</div>
<?php } ?>
