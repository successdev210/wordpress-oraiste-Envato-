<?php
$social_networks = get_post_meta( get_the_ID(), 'qodef_team_member_social_networks', true );

if ( ! empty( $social_networks ) ) {
	?>
	<div class="qodef-team-member-social-networks">
		<?php
		foreach ( $social_networks as $network ) {
			if ( ! empty( $network['qodef_team_member_social_network_text'] ) ) {
				$social_text   = $network['qodef_team_member_social_network_text'];
				$social_link   = $network['qodef_team_member_social_network_link'];
				$social_target = ! empty( $network['qodef_team_member_social_network_target'] ) ? $network['qodef_team_member_social_network_target'] : '_blank';
				?>

				<a class="qodef-team-member-social-network" href="<?php echo esc_url( $social_link ); ?>" target="<?php echo esc_attr( $social_target ); ?>">
					<span class="qodef-team-member-social-text"><?php echo qode_framework_wp_kses_html( 'html', $social_text ); ?></span>
				</a>
			<?php } ?>
		<?php } ?>
	</div>
<?php } ?>
