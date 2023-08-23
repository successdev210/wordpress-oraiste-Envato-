<?php

$tab_description = $this_object->get_description();

if ( ! empty( $tab_description ) ) {
	?>
	<div class="col-12"><p class="qodef-tab-description"><?php echo esc_html( $tab_description ); ?></p></div>
<?php } ?>
<?php
foreach ( $this_object->get_children() as $child ) {
	$child->render();
}
