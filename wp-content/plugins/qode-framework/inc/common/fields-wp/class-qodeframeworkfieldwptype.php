<?php

abstract class QodeFrameworkFieldWPType {
	public $type;
	public $field_type;
	public $name;
	public $default_value;
	public $title;
	public $description;
	public $options;
	public $args;
	public $dependency;
	public $multiple;
	public $params;

	function __construct( $params ) {
		$this->type          = isset( $params['type'] ) ? $params['type'] : '';
		$this->field_type    = isset( $params['field_type'] ) ? $params['field_type'] : '';
		$this->name          = isset( $params['name'] ) ? $params['name'] : '';
		$this->default_value = isset( $params['default_value'] ) ? $params['default_value'] : '';
		$this->title         = isset( $params['title'] ) ? $params['title'] : '';
		$this->description   = isset( $params['description'] ) ? $params['description'] : '';
		$this->options       = isset( $params['options'] ) ? $params['options'] : array();
		$this->args          = isset( $params['args'] ) ? $params['args'] : array();
		$this->dependency    = isset( $params['dependency'] ) ? $params['dependency'] : array();
		$this->multiple      = isset( $params['multiple'] ) ? $params['multiple'] : '';

		$value           = qode_framework_get_option_value( '', $this->type, $this->name, $this->default_value );
		$params['value'] = $value;

		$layout           = ( 'taxonomy' === $this->type && ! isset( $_GET['tag_ID'] ) ) ? 'div' : 'table';
		$params['layout'] = $layout;

		$id           = $this->name;
		$params['id'] = $id;

		$class   = array();
		$class[] = 'taxonomy' === $this->type ? 'form-field' : 'user-field';
		$class[] = 'qodef-field-' . $this->field_type;

		$dependency_data = array();

		if ( ! empty( $this->dependency ) ) {
			$class[] = 'qodef-dependency-holder';

			$show = array_key_exists( 'show', $this->dependency ) ? qode_framework_return_dependency_options_array( '', $this->type, $this->dependency['show'], true ) : array();
			$hide = array_key_exists( 'hide', $this->dependency ) ? qode_framework_return_dependency_options_array( '', $this->type, $this->dependency['hide'], false ) : array();

			$class[]         = qode_framework_return_dependency_classes( $show, $hide );
			$dependency_data = qode_framework_return_dependency_data( $show, $hide );
		}

		$class = implode( ' ', $class );

		$params['row_class']       = $class;
		$params['dependency_data'] = $dependency_data;

		$this->params = isset( $params ) ? $params : array();
		$this->load_assets();
		$this->render();
	}

	public function load_assets() {
		do_action( 'qode_framework_action_field_wp_type_load_assets', $this->field_type );
	}

	public function render() {
		if ( 'div' === $this->params['layout'] ) { ?>
			<div class="<?php echo esc_attr( $this->params['row_class'] ); ?>" <?php echo qode_framework_get_inline_attrs( $this->params['dependency_data'], true ); ?>>
				<label for="<?php echo esc_attr( $this->name ); ?>">
					<?php echo esc_html( $this->title ); ?>
				</label>
				<div class="qodef-input-holder qodef-field-content">
					<?php echo qode_framework_wp_kses_html( 'html', $this->render_field() ); ?>
				</div>
				<p class="description">
					<?php echo esc_html( $this->description ); ?>
				</p>
			</div>
			<?php
		} else {
			?>
			<tr class="<?php echo esc_attr( $this->params['row_class'] ); ?>" <?php echo qode_framework_get_inline_attrs( $this->params['dependency_data'], true ); ?>>
				<th scope="row" valign="top">
					<label for="<?php echo esc_attr( $this->name ); ?>"><?php echo esc_html( $this->title ); ?></label>
				</th>
				<td class="qodef-input-holder qodef-field-content">
					<?php echo qode_framework_wp_kses_html( 'html', $this->render_field() ); ?>
					<p class="description">
						<?php echo esc_html( $this->description ); ?>
					</p>
				</td>
			</tr>
			<?php
		}
	}

	abstract public function render_field();
}
