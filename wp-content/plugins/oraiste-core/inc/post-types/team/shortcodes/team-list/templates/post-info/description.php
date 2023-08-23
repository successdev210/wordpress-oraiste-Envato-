<?php
$description = get_post_meta( get_the_ID(), 'qodef_team_member_description', true );

if ( ! empty( $description ) ) { ?>
	<p class="qodef-e-description"><?php echo esc_html( $description ); ?></p>
<?php } ?>
