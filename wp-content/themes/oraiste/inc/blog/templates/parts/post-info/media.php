<div class="qodef-e-media">
	<?php
	switch ( get_post_format() ) {
		case 'gallery':
			oraiste_template_part( 'blog', 'templates/parts/post-format/gallery' );
			break;
		case 'video':
			oraiste_template_part( 'blog', 'templates/parts/post-format/video' );
			break;
		case 'audio':
			oraiste_template_part( 'blog', 'templates/parts/post-format/audio' );
			break;
		default:
			oraiste_template_part( 'blog', 'templates/parts/post-info/image' );
			break;
	}
	?>
</div>
