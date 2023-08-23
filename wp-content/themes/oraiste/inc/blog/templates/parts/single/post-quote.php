<article <?php post_class( 'qodef-blog-item qodef-e' ); ?>>
	<div class="qodef-e-inner">
		<?php
		// Include post format part
		oraiste_template_part( 'blog', 'templates/parts/post-format/quote' );
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
				// Include post content
				the_content();

				// Hook to include additional content after blog single content
				do_action( 'oraiste_action_after_blog_single_content' );
				?>
			</div>
			<div class="qodef-e-info qodef-info--bottom">
				<div class="qodef-e-info-left">
					<?php
					// Include post tags info
					oraiste_template_part( 'blog', 'templates/parts/post-info/tags' );
					?>
				</div>
				<?php if ( oraiste_is_installed( 'framework' ) && oraiste_is_installed( 'core' ) ) : ?>
					<div class="qodef-e-info-right">
						<?php
						// Include post share
						oraiste_template_part( 'blog', 'templates/parts/post-info/share' );
						?>
					</div>
				<?php endif; ?>
			</div>
		</div>
	</div>
</article>
