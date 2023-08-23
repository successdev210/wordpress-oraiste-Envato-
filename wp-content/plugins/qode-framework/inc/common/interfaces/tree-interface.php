<?php

interface QodeFrameworkTreeInterface {
	public function has_children();

	public function get_children();

	public function get_child( $key );

	public function add_child( QodeFrameworkChildInterface $field );
}
