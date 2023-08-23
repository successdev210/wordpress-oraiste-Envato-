<?php
$is_enabled = oraiste_core_get_post_value_through_levels( 'qodef_portfolio_enable_navigation' );

if ( 'yes' === $is_enabled ) {
	$through_same_category = 'yes' === oraiste_core_get_post_value_through_levels( 'qodef_portfolio_navigation_through_same_category' );
	?>
	<div id="qodef-single-portfolio-navigation" class="qodef-m">
		<div class="qodef-m-inner">
			<?php
			$navigation_icon_params = array(
				'icon_attributes' => array(
					'class' => 'qodef-m-nav-icon',
				),
			);
			$post_navigation        = array(
				'prev'      => array(
					'label' => '<span class="qodef-m-nav-label">' . esc_html__( 'Prev Project', 'oraiste-core' ) . '</span>',
					'icon'  => oraiste_core_get_svg_icon( 'navigation-arrow-left', 'qodef-m-nav-icon' ),
				),
				'back-link' => array(),
				'next'      => array(
					'label' => '<span class="qodef-m-nav-label">' . esc_html__( 'Next Project', 'oraiste-core' ) . '</span>',
					'icon'  => oraiste_core_get_svg_icon( 'navigation-arrow-right', 'qodef-m-nav-icon' ),
				),
			);

			if ( $through_same_category ) {
				if ( '' !== get_adjacent_post( true, '', true, 'portfolio-category' ) ) {
					$post_navigation['prev']['post'] = get_adjacent_post( true, '', true, 'portfolio-category' );
				}
				if ( '' !== get_adjacent_post( true, '', false, 'portfolio-category' ) ) {
					$post_navigation['next']['post'] = get_adjacent_post( true, '', false, 'portfolio-category' );
				}
			} else {
				if ( '' !== get_adjacent_post( false, '', true ) ) {
					$post_navigation['prev']['post'] = get_adjacent_post( false, '', true );
				}
				if ( '' !== get_adjacent_post( false, '', false ) ) {
					$post_navigation['next']['post'] = get_adjacent_post( false, '', false );
				}
			}

			$back_to_link = get_post_meta( get_the_ID(), 'qodef_portfolio_single_back_to_link', true );

			if ( '' !== $back_to_link ) {
				$post_navigation['back-link'] = array(
					'post'    => true,
					'post_id' => $back_to_link,
					'label'   => '',
					'icon'    => oraiste_core_get_svg_icon( 'back-to-link', 'qodef-m-nav-icon' ),
				);
			}

			foreach ( $post_navigation as $key => $value ) {
				echo '<span class="qodef-m-nav-holder">';
				if ( isset( $post_navigation[$key]['post'] ) ) {
					$current_post = $value['post'];
					$post_id      = isset( $value['post_id'] ) && ! empty( $value['post_id'] ) ? $value['post_id'] : $current_post->ID;
					?>
					<a itemprop="url" class="qodef-m-nav qodef--<?php echo esc_attr( $key ); ?>" href="<?php echo esc_url( get_permalink( $post_id ) ); ?>">
						<?php echo wp_kses( $value['label'], array( 'span' => array( 'class' => true ) ) ); ?>
						<?php echo qode_framework_wp_kses_html( 'svg', $value['icon'] ); ?>
					</a>
					<?php
				}
				echo '</span>';
			}
			?>
		</div>
	</div>
<?php } ?>
