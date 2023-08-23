<div class="qodef-tabs-content">
	<?php
	foreach ( $pages as $page ) { ?>
		<?php
		$page_slug    = $page->get_slug();
		$section_slug = empty( $page_slug ) ? $options_name : $options_name . '_' . $page_slug;
		?>
		<div class="tab-content qodef-hide-pane" data-section="<?php echo esc_attr( $section_slug ); ?>">
			<div class="tab-pane">
				<div class="qodef-tab-content">
					<div class="qodef-page-title">
						<span class="qodef-page-title-text"><?php echo esc_html( $page->get_title() ); ?></span>
						<span class="qodef-title-separator">/</span>
						<span class="qodef-page-description"><?php echo esc_html( $page->get_description() ); ?></span>
					</div>
					<?php $page->render(); ?>
				</div>
			</div>
		</div>
	<?php } ?>
</div>
