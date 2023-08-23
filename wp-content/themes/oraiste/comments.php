<?php

if ( post_password_required() ) {
	return;
}

if ( comments_open() || get_comments_number() ) {
	// Hook to include page comments template
	do_action( 'oraiste_action_page_comments_template' );
}
