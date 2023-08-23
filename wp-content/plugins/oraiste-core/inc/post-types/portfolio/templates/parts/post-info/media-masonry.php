<?php
$portfolio_media = get_post_meta( get_the_ID(), 'qodef_portfolio_media', true );

$masonry_classes   = '';
$number_of_columns = oraiste_core_get_post_value_through_levels( 'qodef_portfolio_columns_number' );
$masonry_classes  .= ! empty( $number_of_columns ) ? ' qodef-col-num--' . $number_of_columns : ' qodef-col-num--3';

$space_between_items = oraiste_core_get_post_value_through_levels( 'qodef_portfolio_space_between_items' );
$masonry_classes    .= ! empty( $space_between_items ) ? ' qodef-gutter--' . $space_between_items : ' qodef-gutter--short';

if ( ! empty( $portfolio_media ) ) { ?>
	<div class="qodef-e qodef-grid qodef-layout--masonry qodef-items--fixed qodef-responsive--predefined qodef--no-bottom-space <?php echo esc_attr( $masonry_classes ); ?>">
		<div class="qodef-grid-inner clear qodef-magnific-popup qodef-popup-gallery">
			<?php
			// Include global masonry template from theme
			oraiste_core_theme_template_part( 'masonry', 'templates/sizer-gutter', '', 'masonry' );

			foreach ( $portfolio_media as $media ) {
				$type       = $media['qodef_portfolio_media_type'];
				$media_name = 'qodef_portfolio_' . $type;

				$params          = array();
				$params['media'] = $media[ $media_name ];

				oraiste_core_template_part( 'post-types/portfolio', 'templates/parts/media/media', $type . '-masonry', $params );
			}
			?>
		</div>
	</div>
<?php } ?>
