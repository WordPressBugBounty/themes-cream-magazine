<?php
/**
 * Customize Dropdown Select Control.
 *
 * @since 2.1.2
 *
 * @package Cream_Magazine
 */

if ( ! class_exists( 'WP_Customize_Control' ) ) {
	return;
}

/**
 * Customize dropdown select control.
 *
 * @since 2.1.2
 */
class Cream_Magazine_Dropdown_Select_Control extends WP_Customize_Control {

	/**
	 * The type of control being rendered
	 *
	 * @since 2.1.2
	 *
	 * @var string
	 */
	public $type = 'cream-magazine-dropdown-select';

	/**
	 * Enqueue control related styles and scripts.
	 *
	 * @since 2.1.2
	 */
	public function enqueue() {

		wp_enqueue_style(
			'slimselect',
			get_template_directory_uri() . '/admin/css/slimselect.min.css',
			null,
			CREAM_MAGAZINE_VERSION,
			'all'
		);

		wp_enqueue_style(
			'cream-magazine-dropdown-select',
			get_template_directory_uri() . '/inc/customizer/controls/select/select.css',
			null,
			CREAM_MAGAZINE_VERSION,
			'all'
		);

		wp_enqueue_script(
			'slimselect',
			get_template_directory_uri() . '/admin/js/slimselect.min.js',
			null,
			CREAM_MAGAZINE_VERSION,
			true
		);

		wp_enqueue_script(
			'cream-magazine-dropdown-select',
			get_template_directory_uri() . '/inc/customizer/controls/select/select.js',
			null,
			CREAM_MAGAZINE_VERSION,
			true
		);
	}

	/**
	 * Render the the control.
	 *
	 * @since 2.1.2
	 */
	public function render_content() {

		$attrs = array(
			'multiselect' => ( isset( $this->input_attrs['multiselect'] ) && $this->input_attrs['multiselect'] ) ? true : false,
			'showsearch'  => ( isset( $this->input_attrs['showsearch'] ) && $this->input_attrs['showsearch'] ) ? true : false,
		);

		if ( $this->label ) {
			?>
			<span class="customize-control-title"><?php echo esc_html( $this->label ); ?></span>
			<?php
		}
		?>
		<select
			name="<?php echo esc_attr( $this->id ); ?>"
			id="<?php echo esc_attr( $this->id ); ?>"
			<?php echo ( $attrs['multiselect'] ) ? 'multiple' : ''; ?>
			<?php echo ( $attrs['multiselect'] ) ? 'data-showsearch="enable"' : 'data-showsearch="disable"'; ?>
			<?php $this->link(); ?>
		>
			<?php
			if ( $this->choices ) {

				$saved_values = ( $this->value() ) ? $this->value() : array();

				if ( isset( $attrs['multiselect'] ) && true === $attrs['multiselect'] ) {

					foreach ( $this->choices as $value => $label ) {
						$selected = ( in_array( $value, $saved_values, true ) ) ? 'selected' : '';
						?>
						<option
							value="<?php echo esc_attr( $value ); ?>"
							<?php echo esc_attr( $selected ); ?>
						>
							<?php echo esc_html( $label ); ?>
						</option>
						<?php
					}
				} else {

					$saved_value = ( $this->value() ) ? $this->value() : '';

					foreach ( $this->choices as $value => $label ) {
						?>
						<option
							value="<?php echo esc_attr( $value ); ?>"
							<?php selected( $value, $saved_value ); ?>
						>
							<?php echo esc_html( $label ); ?>
						</option>
						<?php
					}
				}
			}
			?>
		</select>
		<?php
		if ( $this->description ) {
			?>
			<span class="description customize-control-description">
				<?php echo wp_kses_post( $this->description ); ?>
			</span>
			<?php
		}
	}
}
