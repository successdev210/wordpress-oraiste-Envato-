<article <?php post_class( $item_classes ); ?>>
	<div class="qodef-e-inner">
		<?php
		// Include post image
		oraiste_core_template_part( 'blog/shortcodes/blog-list', 'templates/post-info/image', '', $params );
		?>
		<div class="qodef-e-content">
			<div class="qodef-e-info qodef-info--top">
				<?php
				// Include post date info
				oraiste_core_theme_template_part( 'blog', 'templates/parts/post-info/date' );
				?>
			</div>
			<div class="qodef-e-text">
				<?php
				// Include post title
				oraiste_core_theme_template_part( 'blog', 'templates/parts/post-info/title', '', $params );

				// Hook to include additional content after blog single content
				do_action( 'oraiste_action_after_blog_single_content' );
				?>
			</div>
		</div>
		<?php
		// Include post image
		oraiste_core_template_part( 'blog/shortcodes/blog-list', 'templates/post-info/link' );
		?>
	</div>
</article>
