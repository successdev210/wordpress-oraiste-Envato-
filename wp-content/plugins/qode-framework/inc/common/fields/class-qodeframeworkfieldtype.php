<?php

abstract class QodeFrameworkFieldType {

	public $scope;
	public $type;
	public $field_type;
	public $name;
	public $default_value;
	public $title;
	public $description;
	public $options;
	public $data_attrs;
	public $args;
	public $repeater;
	public $dependency;
	public $params;
	public $multiple;

	function __construct( $params ) {
		$this->scope         = isset( $params['scope'] ) ? $params['scope'] : '';
		$this->type          = isset( $params['type'] ) ? $params['type'] : '';
		$this->field_type    = isset( $params['field_type'] ) ? $params['field_type'] : '';
		$this->name          = isset( $params['name'] ) ? $params['name'] : '';
		$this->default_value = isset( $params['default_value'] ) ? $params['default_value'] : '';
		$this->description   = isset( $params['description'] ) ? $params['description'] : '';
		$this->title         = isset( $params['title'] ) ? $params['title'] : '';
		$this->options       = isset( $params['options'] ) ? $params['options'] : array();
		$this->data_attrs    = isset( $params['data_attrs'] ) ? $params['data_attrs'] : array();
		$this->args          = isset( $params['args'] ) ? $params['args'] : array();
		$this->dependency    = isset( $params['dependency'] ) ? $params['dependency'] : array();
		$this->repeater      = isset( $params['repeater'] ) ? $params['repeater'] : array();
		$this->multiple      = isset( $params['multiple'] ) ? $params['multiple'] : '';

		/* Generate suffix */
		$suffix           = ! empty( $this->args['suffix'] ) ? $this->args['suffix'] : false;
		$params['suffix'] = $suffix;

		/* Generate prefix */
		$prefix           = ! empty( $this->args['prefix'] ) ? $this->args['prefix'] : false;
		$params['prefix'] = $prefix;

		/* Generate class */
		$class   = array();
		$class[] = 'qodef-field-holder';
		if ( isset( $this->args['custom_class'] ) && '' !== $this->args['custom_class'] ) {
			$class[] = $this->args['custom_class'];
		} elseif ( 'hidden' === $this->field_type ) {
			$class[] = 'qodef-hidden';
		}

		/* Generate col width */
		$col_width = 12;
		if ( isset( $this->args['col_width'] ) ) {
			$col_width = $this->args['col_width'];
		}
		$class[] = 'col-md-12 col-lg-' . $col_width;

		$option_type = apply_filters( 'qode_framework_filter_option_value_type', $this->type );

		/* Generate value */
		$value = isset( $params['value'] ) ? $params['value'] : qode_framework_get_option_value( $this->scope, $option_type, $this->name, $this->default_value );

		/* Generate id */
		$id = $this->name;

		/* Generate repeat based values */
		if ( ! empty( $this->repeater ) && array_key_exists( 'name', $this->repeater ) && array_key_exists( 'index', $this->repeater ) ) {
			$id         = $this->name . '-' . $this->repeater['index'];
			$this->name = $this->repeater['name'] . '[' . $this->repeater['index'] . '][' . $this->name . ']';
			$value      = $this->repeater['value'];

			if ( ! empty( $this->dependency ) ) {
				$repeater_field_visibility = key( $this->dependency );
				$new_dependency            = array();
				//rename key to match field
				foreach ( $this->dependency[ $repeater_field_visibility ] as $dep_key => $dep_value ) {
					$new_key                    = $this->repeater['name'] . '[' . $this->repeater['index'] . '][' . $dep_key . ']';
					$new_dependency[ $new_key ] = $dep_value;
				}
				$dependency = array(
					$repeater_field_visibility => $new_dependency,
				);

				$this->dependency = $dependency;
			}
		}

		$params['id']    = $id;
		$params['value'] = $value;

		/* Generate container class for dependency */
		$dependency_data = array();

		if ( ! empty( $this->dependency ) ) {
			$class[] = 'qodef-dependency-holder';

			$repeater = ! empty( $this->repeater ) ? true : false;
			$show     = array_key_exists( 'show', $this->dependency ) ? qode_framework_return_dependency_options_array( $this->scope, $this->type, $this->dependency['show'], true, $repeater ) : array();
			$hide     = array_key_exists( 'hide', $this->dependency ) ? qode_framework_return_dependency_options_array( $this->scope, $this->type, $this->dependency['hide'], false, $repeater ) : array();

			$class[]         = qode_framework_return_dependency_classes( $show, $hide );
			$dependency_data = qode_framework_return_dependency_data( $show, $hide );
		}

		$params['class']           = implode( ' ', $class );
		$params['dependency_data'] = $dependency_data;

		$this->params = isset( $params ) ? $params : array();
		$this->load_assets();
		$this->render();
	}

	public function load_assets() {
		do_action( 'qode_framework_action_field_type_load_assets', $this->field_type );
	}

	public function render() { ?>
		<div class="<?php echo esc_attr( $this->params['class'] ); ?>" id="qodef_<?php echo esc_attr( $this->params['id'] ); ?>" <?php echo qode_framework_get_inline_attrs( $this->params['dependency_data'], true ); ?>>
			<div class="qodef-field-section">
				<?php if ( '' !== $this->title || '' !== $this->description ) { ?>
					<div class="qodef-field-desc">
						<?php if ( '' !== $this->title ) { ?>
							<h3 class="qodef-title qodef-field-title"><?php echo esc_html( $this->title ); ?></h3>
						<?php } ?>
						<?php if ( '' !== $this->description ) { ?>
							<p class="qodef-description qodef-field-description"><?php echo esc_html( $this->description ); ?></p>
						<?php } ?>
					</div>
				<?php } ?>
				<div class="qodef-field-content">
					<?php $this->render_field(); ?>
				</div>
			</div>
		</div>
		<?php
	}

	abstract public function render_field();
}
