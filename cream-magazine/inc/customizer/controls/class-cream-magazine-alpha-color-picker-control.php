<?php
/**
 * Customize Alpha Color Picker Control.
 *
 * @since 1.0.0
 *
 * @package Cream_Magazine
 */

/**
 * Customize Alpha Color Picker Control Class.
 *
 * @since 1.0.0
 *
 * @see WP_Customize_Control
 */
class Cream_Magazine_Alpha_Color_Picker_Control extends WP_Customize_Control {
	/**
	 * The type of control being rendered.
	 *
	 * @var string
	 */
	public $type = 'alpha-color';

	/**
	 * Add support for palettes to be passed in.
	 *
	 * Supported palette values are true, false, or an array of RGBa and Hex colors.
	 *
	 * @var string
	 */
	public $palette;

	/**
	 * Add support for showing the opacity value on the slider handle.
	 *
	 * @var string
	 */
	public $show_opacity;
	/**
	 * Render the control in the customizer
	 */
	public function render_content() {

		// Process the palette.
		if ( is_array( $this->palette ) ) {
			$palette = implode( '|', $this->palette );
		} else {
			// Default to true.
			$palette = ( false === $this->palette || 'false' === $this->palette ) ? 'false' : 'true';
		}

		// Support passing show_opacity as string or boolean. Default to true.
		$show_opacity = ( false === $this->show_opacity || 'false' === $this->show_opacity ) ? 'false' : 'true';
		?>
		<label>
			<?php
			// Output the label and description if they were passed in.
			if (
				isset( $this->label ) &&
				'' !== $this->label
			) {
				echo '<span class="customize-control-title">' . esc_html( $this->label ) . '</span>';
			}

			if (
				isset( $this->description ) &&
				'' !== $this->description
			) {
				echo '<span class="description customize-control-description">' . esc_html( $this->description ) . '</span>';
			}
			?>
		</label>
		<input
			class="alpha-color-control"
			type="text"
			data-show-opacity="<?php echo esc_attr( $show_opacity ); ?>"
			data-palette="<?php echo esc_attr( $palette ); ?>"
			data-default-color="<?php echo esc_attr( $this->settings['default']->default ); ?>"
			<?php $this->link(); ?>
		/>
		<?php
	}
}
