<div id="qodef-page" class="qodef-tab-wrapper <?php echo esc_attr( $class ); ?>">
	<ul class="qodef-tab-item-nav-wrapper">
		<?php foreach ( $this_object->get_children() as $child ) { ?>
			<li>
				<a href="#qodef-tab-<?php echo sanitize_title( $child->get_title() ); ?>"><?php echo esc_html( $child->get_title() ); ?></a>
			</li>
		<?php } ?>
	</ul>
	<?php foreach ( $this_object->get_children() as $child ) { ?>
		<div class="qodef-tab-item-content " id="qodef-tab-<?php echo sanitize_title( $child->get_title() ); ?>">
			<div class="row">
				<?php $child->render(); ?>
			</div>
		</div>
	<?php } ?>
</div>
