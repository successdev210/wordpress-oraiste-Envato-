<?php

foreach ( $this_object->get_child_elements() as $key => $child ) {
	foreach ( $child->get_scope() as $scope ) {
		if ( $taxonomy === $scope ) {
			$child->set_layout( $layout );
			$child->render();
		}
	}
}
