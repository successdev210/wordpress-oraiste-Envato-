<?php
$portfolio_media = get_post_meta( get_the_ID(), 'qodef_portfolio_media', true );

if ( ! empty( $portfolio_media ) ) { ?>
	<div class="qodef-e qodef-magnific-popup qodef-popup-gallery">
		<?php
		foreach ( $portfolio_media as $media ) {
			$type       = $media['qodef_portfolio_media_type'];
			$media_name = 'qodef_portfolio_' . $type;

			$params          = array();
			$params['media'] = $media[ $media_name ];

			oraiste_core_template_part( 'post-types/portfolio', 'templates/parts/media/media', $type, $params );
		}
		?>
	</div>
<?php } ?>
