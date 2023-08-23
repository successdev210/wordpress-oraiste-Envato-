<article <?php post_class( 'qodef-blog-item qodef-e' ); ?>>
	<div class="qodef-e-inner">
		<?php
		// Include post media
		oraiste_template_part( 'blog', 'templates/parts/post-info/media' );
		?>
		<div class="qodef-e-content">
			<div class="qodef-e-info qodef-info--top">
				<?php
				// Include post date info
				oraiste_template_part( 'blog', 'templates/parts/post-info/date' );

				// Include post category info
				oraiste_template_part( 'blog', 'templates/parts/post-info/category' );
				?>
			</div>
			<div class="qodef-e-text">
				<?php
				// Include post title
				oraiste_template_part( 'blog', 'templates/parts/post-info/title', '', array( 'title_tag' => 'h2' ) );

				// Include post excerpt
				oraiste_template_part( 'blog', 'templates/parts/post-info/excerpt' );

				// Hook to include additional content after blog single content
				do_action( 'oraiste_action_after_blog_single_content' );
				?>
			</div>
			<div class="qodef-e-info qodef-info--bottom">
				<?php
				// Include post read more
				oraiste_template_part( 'blog', 'templates/parts/post-info/read-more' );
				?>
			</div>
		</div>
	</div>
</article>
