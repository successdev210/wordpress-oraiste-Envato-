<?php
// Unique ID for search form fields
$qodef_unique_id = uniqid( 'qodef-search-form-' );
?>
<form role="search" method="get" class="qodef-search-form" action="<?php echo esc_url( home_url( '/' ) ); ?>">
	<label for="<?php echo esc_attr( $qodef_unique_id ); ?>" class="screen-reader-text"><?php esc_html_e( 'Search for:', 'oraiste' ); ?></label>
	<div class="qodef-search-form-inner clear">
		<input type="search" id="<?php echo esc_attr( $qodef_unique_id ); ?>" class="qodef-search-form-field" value="" name="s" placeholder="<?php esc_attr_e( 'Type here', 'oraiste' ); ?>" />
		<button type="submit" class="qodef-search-form-button"><?php oraiste_render_svg_icon( 'search' ); ?></button>
	</div>
</form>
