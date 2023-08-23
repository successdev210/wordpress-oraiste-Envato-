<div class="qodef-core-dashboard wrap about-wrap">
	<h1 class="qodef-cd-title"><?php esc_html_e( 'System Status', 'oraiste-core' ); ?></h1>
	<h4 class="qodef-cd-subtitle"><?php esc_html_e( 'Here is a general overview of your system status', 'oraiste-core' ); ?></h4>
	<div class="qodef-core-dashboard-inner">
		<div class="qodef-core-dashboard-column">
			<div class="qodef-core-dashboard-box">
				<div class="qodef-cd-box-title-holder">
					<h2><?php esc_html_e( 'WordPress Environment', 'oraiste-core' ); ?></h2>
				</div>
				<div class="qodef-cd-box-inner">
					<?php foreach ( $wordpress_info as $wordpress_info_key => $wordpress_info_value ) : ?>
						<div class="qodef-cd-box-row">
							<div class="qodef-cdb-label"><?php echo esc_attr( $wordpress_info_value['title'] ); ?></div>
							<div class="qodef-cdb-value"><?php echo wp_kses_post( $wordpress_info_value['value'] ); ?></div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
			<div class="qodef-core-dashboard-box">
				<div class="qodef-cd-box-title-holder">
					<h2><?php esc_html_e( 'System Information', 'oraiste-core' ); ?></h2>
				</div>
				<div class="qodef-cd-box-inner">
					<?php
					foreach ( $system_info as $system_info_key => $system_info_value ) :
						$class = ( isset( $system_info_value['pass'] ) && ! $system_info_value['pass'] ) ? 'qodef-cdb-value-false' : '';
						?>
						<div class="qodef-cd-box-row">
							<div class="qodef-cdb-label"><?php echo esc_attr( $system_info_value['title'] ); ?></div>
							<div class="qodef-cdb-value <?php echo esc_attr( $class ); ?>">
								<span><?php echo wp_kses_post( $system_info_value['value'] ); ?></span>
								<?php if ( isset( $system_info_value['notice'] ) && ( isset( $system_info_value['pass'] ) && ! $system_info_value['pass'] ) ) { ?>
									<?php echo esc_html( $system_info_value['notice'] ); ?>
								<?php } ?>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
		<div class="qodef-core-dashboard-column">
			<div class="qodef-core-dashboard-box">
				<div class="qodef-cd-box-title-holder">
					<h2><?php esc_html_e( 'Theme Information', 'oraiste-core' ); ?></h2>
				</div>
				<div class="qodef-cd-box-inner">
					<?php foreach ( $theme_info as $theme_info_key => $theme_info_value ) : ?>
						<div class="qodef-cd-box-row">
							<div class="qodef-cdb-label"><?php echo esc_attr( $theme_info_value['title'] ); ?></div>
							<?php $add_class = ( isset( $theme_info_value['pass'] ) && true == $theme_info_value['pass'] ) ? 'qodef-passed' : 'qodef-not-passed'; ?>
							<div class="qodef-cdb-value <?php echo esc_attr( $add_class ); ?>"><?php echo wp_kses_post( $theme_info_value['value'] ); ?></div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
			<div class="qodef-core-dashboard-box">
				<div class="qodef-cd-box-title-holder">
					<h2><?php esc_html_e( 'Active Plugins', 'oraiste-core' ); ?><sup>(<?php echo count( $plugins ); ?>)</sup></h2>
				</div>
				<div class="qodef-cd-box-inner">
					<?php foreach ( $plugins as $plugin_key => $plugin_value ) : ?>
						<div class="qodef-cd-box-row">
							<div class="qodef-cdb-label"><a href="<?php echo esc_url( $plugin_value['url'] ); ?>" target="_blank"><?php echo wp_kses_post( $plugin_value['title'] ); ?></a>
							</div>
							<div class="qodef-cdb-value">
								<?php esc_html_e( 'by', 'oraiste-core' ); ?> <a href="<?php echo esc_url( $plugin_value['author_url'] ); ?>" target="_blank"><?php echo wp_kses_post( $plugin_value['author'] ); ?></a>- <?php echo wp_kses_post( $plugin_value['version'] ); ?>
							</div>
						</div>
					<?php endforeach; ?>
				</div>
			</div>
		</div>
	</div>
</div>
