<?php
$portfolio_media = get_post_meta( get_the_ID(), 'qodef_portfolio_media', true );

$gallery_classes   = '';
$number_of_columns = oraiste_core_get_post_value_through_levels( 'qodef_portfolio_columns_number' );
$gallery_classes  .= ! empty( $number_of_columns ) ? ' qodef-col-num--' . $number_of_columns : ' qodef-col-num--3';

$space_between_items = oraiste_core_get_post_value_through_levels( 'qodef_portfolio_space_between_items' );
$gallery_classes    .= ! empty( $space_between_items ) ? ' qodef-gutter--' . $space_between_items : ' qodef-gutter--short';

if ( ! empty( $portfolio_media ) ) { ?>
	<div class="qodef-e qodef-magnific-popup qodef-popup-gallery qodef-grid qodef-layout--columns qodef-responsive--predefined qodef--no-bottom-space <?php echo esc_attr( $gallery_classes ); ?>">
		<div class="qodef-grid-inner clear qodef-magnific-popup qodef-popup-gallery">
			<?php
			foreach ( $portfolio_media as $media ) {
				$type       = $media['qodef_portfolio_media_type'];
				$media_name = 'qodef_portfolio_' . $type;

				$params               = array();
				$params['media_type'] = 'gallery';
				$params['media']      = $media[ $media_name ];

				oraiste_core_template_part( 'post-types/portfolio', 'templates/parts/media/media', $type, $params );
			}
			?>
		</div>
	</div>
<?php } ?>
