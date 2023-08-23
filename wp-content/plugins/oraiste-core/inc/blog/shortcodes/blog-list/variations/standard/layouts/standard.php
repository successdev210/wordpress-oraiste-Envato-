<article <?php post_class( $item_classes ); ?>>
	<div class="qodef-e-inner">
		<?php
		// Include post media
		oraiste_core_template_part( 'blog/shortcodes/blog-list', 'templates/post-info/media', '', $params );
		?>
		<div class="qodef-e-content">
			<div class="qodef-e-info qodef-info--top">
				<?php
				// Include post date info
				oraiste_core_theme_template_part( 'blog', 'templates/parts/post-info/date' );

				// Include post category info
				oraiste_core_theme_template_part( 'blog', 'templates/parts/post-info/category' );
				?>
			</div>
			<div class="qodef-e-text">
				<?php
				// Include post title
				oraiste_core_theme_template_part( 'blog', 'templates/parts/post-info/title', '', $params );

				// Include post excerpt
				oraiste_core_theme_template_part( 'blog', 'templates/parts/post-info/excerpt', '', $params );

				// Hook to include additional content after blog single content
				do_action( 'oraiste_action_after_blog_single_content' );
				?>
			</div>
			<div class="qodef-e-info qodef-info--bottom">
				<?php
				// Include post read more
				oraiste_core_theme_template_part( 'blog', 'templates/parts/post-info/read-more' );
				?>
			</div>
		</div>
	</div>
</article>
