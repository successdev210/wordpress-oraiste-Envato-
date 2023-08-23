<div <?php post_class( $item_classes ); ?>>
	<div class="qodef-e-inner">
		<div class="qodef-e-image">
			<?php oraiste_core_list_sc_template_part( 'post-types/team/shortcodes/team-list', 'post-info/image', '', $params ); ?>
		</div>
		<div class="qodef-e-content">
			<?php oraiste_core_list_sc_template_part( 'post-types/team/shortcodes/team-list', 'post-info/title', '', $params ); ?>
			<?php oraiste_core_list_sc_template_part( 'post-types/team/shortcodes/team-list', 'post-info/role', '', $params ); ?>
			<?php oraiste_core_list_sc_template_part( 'post-types/team/shortcodes/team-list', 'post-info/description', '', $params ); ?>
			<?php oraiste_core_list_sc_template_part( 'post-types/team/shortcodes/team-list', 'post-info/social-networks', '', $params ); ?>
		</div>
	</div>
</div>
