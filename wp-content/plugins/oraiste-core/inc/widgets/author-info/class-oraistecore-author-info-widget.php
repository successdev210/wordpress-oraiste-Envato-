<?php

if ( ! function_exists( 'oraiste_core_add_author_info_widget' ) ) {
	/**
	 * Function that add widget into widgets list for registration
	 *
	 * @param array $widgets
	 *
	 * @return array
	 */
	function oraiste_core_add_author_info_widget( $widgets ) {
		$widgets[] = 'OraisteCore_Author_Info_Widget';

		return $widgets;
	}

	add_filter( 'oraiste_core_filter_register_widgets', 'oraiste_core_add_author_info_widget' );
}

if ( class_exists( 'QodeFrameworkWidget' ) ) {
	class OraisteCore_Author_Info_Widget extends QodeFrameworkWidget {

		public function map_widget() {
			$this->set_base( 'oraiste_core_author_info' );
			$this->set_name( esc_html__( 'Oraiste Author Info', 'oraiste-core' ) );
			$this->set_description( esc_html__( 'Add author info element into widget areas', 'oraiste-core' ) );
			$this->set_widget_option(
				array(
					'field_type' => 'text',
					'name'       => 'author_username',
					'title'      => esc_html__( 'Author Username', 'oraiste-core' ),
				)
			);
			$this->set_widget_option(
				array(
					'field_type'  => 'text',
					'name'        => 'author_bio_length',
					'title'       => esc_html__( 'Number of Characters in Bio', 'oraiste-core' ),
					'description' => esc_html__( 'Fill a number of characters in author bio' ),
				)
			);
		}

		public function render( $atts ) {
			$author_id = 1;
			if ( ! empty( $atts['author_username'] ) ) {
				$author = get_user_by( 'login', $atts['author_username'] );

				if ( ! empty( $author ) ) {
					$author_id = $author->ID;
				}
			}

			$author_link = get_author_posts_url( $author_id );
			$author_bio  = get_the_author_meta( 'description', $author_id );

			if ( ! empty( $atts['author_bio_length'] ) ) {
				$author_bio = ( $atts['author_bio_length'] > 0 ) ? substr( $author_bio, 0, intval( $atts['author_bio_length'] ) ) : $author_bio;
			}

			?>
			<div class="widget qodef-author-info">
				<h5 class="qodef-author-info-name vcard author">
					<a itemprop="url" href="<?php echo esc_url( $author_link ); ?>">
						<span class="fn"><?php echo esc_html( get_the_author_meta( 'display_name', $author_id ) ); ?></span>
					</a>
				</h5>
				<a itemprop="url" class="qodef-author-info-image" href="<?php echo esc_url( $author_link ); ?>">
					<?php echo get_avatar( $author_id, 205 ); ?>
				</a>
				<?php if ( ! empty( $author_bio ) ) : ?>
					<p itemprop="description" class="qodef-author-info-description"><?php echo esc_html( $author_bio ); ?></p>
				<?php endif; ?>
			</div>
			<?php
		}
	}
}
