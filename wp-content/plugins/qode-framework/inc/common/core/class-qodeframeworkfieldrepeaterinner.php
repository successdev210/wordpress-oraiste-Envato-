<?php

class QodeFrameworkFieldRepeaterInner implements QodeFrameworkTreeInterface, QodeFrameworkChildInterface {

	private $name;
	private $title;
	private $description;
	private $button_text;
	private $layout;
	private $args;

	private $type;
	private $row_number;
	private $children;
	private $parent;
	private $value;
	public $params;

	function __construct( $params ) {
		$this->name        = isset( $params['name'] ) ? $params['name'] : '';
		$this->title       = isset( $params['title'] ) ? $params['title'] : '';
		$this->description = isset( $params['description'] ) ? $params['description'] : '';
		$this->button_text = isset( $params['button_text'] ) ? $params['button_text'] : esc_html__( 'Add New Item', 'qode-framework' );
		$this->layout      = isset( $params['layout'] ) ? $params['layout'] : 'normal';
		$this->args        = isset( $params['args'] ) ? $params['args'] : array();

		$this->type       = isset( $params['type'] ) ? $params['type'] : '';
		$this->parent     = isset( $params['parent'] ) ? $params['parent'] : array();
		$this->value      = isset( $params['value'] ) ? $params['value'] : array();
		$this->row_number = isset( $params['num_of_rows'] ) ? $params['num_of_rows'] : 1;
		$this->children   = isset( $params['children'] ) ? $params['children'] : array();
		$this->params     = isset( $params['params'] ) ? $params['params'] : array();

		$params['default_value'] = '';

		$sortable_class = 'sortable';
		foreach ( $this->children as $child ) {
			if ( 'textareahtml' === $child->params['type'] ) {
				$sortable_class = 'not-sortable';
				break;
			}
		}
		$params['sortable_class'] = $sortable_class;

		$wrapper_classes           = array();
		$wrapper_classes[]         = 'qodef-repeater-inner-wrapper col-12';
		$wrapper_classes[]         = 'qodef-repeater-' . $this->layout;
		$wrapper_classes[]         = 'qodef-repeater-name-' . $this->name;
		$params['wrapper_classes'] = $wrapper_classes;

		$wrapper_data                       = array();
		$wrapper_data['data-repeater-name'] = $this->name;
		$params['wrapper_data']             = $wrapper_data;

		$col_width = '12';
		if ( isset( $this->args['col_width'] ) ) {
			$col_width = $this->args['col_width'];
		}
		$params['col_width'] = $col_width;

		$this->params = isset( $params ) ? $params : array();
	}

	public function get_name() {
		return $this->name;
	}

	public function get_children() {
		return $this->children;
	}

	public function has_children() {
		return count( $this->children ) > 0;
	}

	public function get_child( $key ) {
		return $this->children[ $key ];
	}

	public function add_child( QodeFrameworkChildInterface $field ) {
		$key                    = $field->get_name();
		$this->children[ $key ] = $field;
	}

	function add_field_element( $params ) {

		if ( isset( $params['name'] ) && ! empty( $params['name'] ) ) {
			$params['type']          = $this->type;
			$params['default_value'] = isset( $params['default_value'] ) ? $params['default_value'] : '';
			$field                   = new QodeFrameworkFieldMapper( $params );
			$this->add_child( $field );

			if ( 'iconpack' === $params['field_type'] ) {

				$icons_object     = qode_framework_icons();
				$icon_collections = $icons_object->get_icon_object_collection();

				foreach ( $icon_collections as $icon_collection_key => $icon_collection_value ) {
					$icon_name   = $icons_object->get_formatted_icon_field_name( $params['name'], $icon_collection_key, '-' );
					$params_icon = array(
						'type'       => $this->type,
						'name'       => $icon_name,
						'field_type' => 'icon',
						'title'      => $icon_collection_value->get_name(),
						'options'    => $icon_collection_value->get_icons(),
						'dependency' => array(
							'show' => array(
								$params['name'] => array(
									'values'        => $icon_collection_key,
									'default_value' => $params['default_value'],
								),
							),
						),
					);

					$field_icon = new QodeFrameworkFieldMapper( $params_icon );
					$this->add_child( $field_icon );
				}
			}

			return $field;
		}

		return false;
	}

	public function render() {
		$this->parent = isset( $this->params['repeater'] ) ? $this->params['repeater'] : array();
		$this->value  = ! empty( $this->parent ) && array_key_exists( 'value', $this->parent ) ? $this->parent['value'] : array();
		?>
		<div <?php qode_framework_class_attribute( $this->params['wrapper_classes'] ); ?> <?php qode_framework_inline_attrs( $this->params['wrapper_data'] ); ?>>
			<div class="qodef-repeater-inner-wrapper-inner">
				<div class="row">
					<?php if ( '' !== $this->title ) { ?>
						<h3 class="qodef-title qodef-repeater-title col-12"><?php echo esc_attr( $this->title ); ?></h3>
					<?php } ?>
					<?php if ( '' !== $this->description ) { ?>
						<p class="qodef-description qodef-repeater-description col-12"><?php echo esc_attr( $this->description ); ?></p>
					<?php } ?>
					<div class="qodef-repeater-inner-wrapper-main col-12 <?php echo esc_attr( $this->params['sortable_class'] ); ?>" data-template="<?php echo str_replace( '_', '-', $this->name ); ?>">
						<?php
						if ( ! empty( $this->value ) && is_array( $this->value ) && count( $this->value ) > 0 ) {
							$counter = 0;
							foreach ( $this->value as $row ) {
								?>
								<div class="qodef-repeater-inner-fields-holder qodef-second-level clearfix" data-index="<?php echo esc_attr( $counter ); ?>">
									<div class="qodef-repeater-inner-fields">
										<?php
										foreach ( $this->children as $child ) {
											if ( isset( $row[ $child->params['name'] ] ) ) {
												if ( '' == $row[ $child->params['name'] ] && isset( $child->params['default_value'] ) && '' !== $child->params['default_value'] ) {
													$repeater_field_value = $child->params['default_value'];
												} else {
													$repeater_field_value = $row[ $child->params['name'] ];
												}
											} else {
												$repeater_field_value = '';
											}

											$repeater                  = array(
												'name'  => $this->parent['name'] . '[' . $this->parent['index'] . '][' . $this->name . ']',
												'index' => $counter,
												'value' => $repeater_field_value,
											);
											$child->params['repeater'] = $repeater;
											$child->render();
										}
										?>
									</div>
									<div class="qodef-repeater-actions-holder">
										<div class="qodef-repeater-sort">
											<?php qode_framework_svg_icon( 'expand' ); ?>
										</div>
										<div class="qodef-repeater-remove">
											<a class="qodef-clone-inner-remove" href="#"><?php qode_framework_svg_icon( 'trash' ); ?></a>
										</div>
									</div>
								</div>
								<?php
								$counter ++;
							}
						}
						?>
					</div>
					<div class="col-12">
						<div class="qodef-repeater-inner-add">
							<a class="qodef-inner-clone qodef-btn qodef-btn-solid" data-count="<?php echo esc_attr( $this->row_number ); ?>" href="#"><?php echo esc_html( $this->button_text ); ?></a>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?php
	}

	public function renderScript() {
		?>
		<script type="text/html" class="qodef-repeater-template" id="tmpl-qodef-repeater-inner-template-<?php echo str_replace( '_', '-', $this->name ); ?>">
			<div class="qodef-repeater-inner-fields-holder <?php echo esc_attr( $this->params['sortable_class'] ); ?> clearfix" data-index="{{{ data.rowInnerIndex }}}">
				<div class="qodef-repeater-inner-fields">
					<?php
					foreach ( $this->children as $child ) {
						$repeater_template_field_value = ( isset( $child->params['default_value'] ) && '' !== $child->params['default_value'] ) ? $child->params['default_value'] : '';
						$repeater                   = array(
							'name'  => $this->parent['name'] . '[' . $this->parent['index'] . '][' . $this->name . ']',
							'index' => '{{{ data.rowInnerIndex }}}',
							'value' => $repeater_template_field_value,
						);
						$child->params['repeater']  = $repeater;
						$child->render();
					}
					?>
				</div>
				<div class="qodef-repeater-actions-holder">
					<div class="qodef-repeater-sort">
						<?php qode_framework_svg_icon( 'expand' ); ?>
					</div>
					<div class="qodef-repeater-remove">
						<a class="qodef-clone-inner-remove" href="#"><?php qode_framework_svg_icon( 'trash' ); ?></a>
					</div>
				</div>
			</div>
		</script>
		<?php
	}
}
