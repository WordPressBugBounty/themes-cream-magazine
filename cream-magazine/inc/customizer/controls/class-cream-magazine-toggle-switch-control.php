<?php
/**
 * Customize Toggle Switch Control.
 *
 * @since 1.0.0
 *
 * @package Cream_Magazine
 */

if ( ! class_exists( 'Cream_Magazine_Toggle_Switch_Control' ) ) {
	/**
	 * Customize Toggle Switch Control Class.
	 *
	 * @since 1.0.0
	 *
	 * @see WP_Customize_Control
	 */
	class Cream_Magazine_Toggle_Switch_Control extends WP_Customize_Control {

		/**
		 * Control type
		 *
		 * @var string
		 */
		public $type = 'toogle-switch';

		/**
		 * Enqueue control related scripts/styles.
		 *
		 * @since 1.0.0
		 */
		public function enqueue() {

			wp_enqueue_style(
				'cream-magazine-toggle-switch',
				get_template_directory_uri() . '/admin/css/toggle-switch.css',
				null,
				CREAM_MAGAZINE_VERSION,
				'all'
			);
		}

		/**
		 * Renders the control wrapper and calls $this->render_content() for the internals.
		 *
		 * @since 1.0.0
		 */
		public function render_content() {
			?>
			<div class="checkbox_switch">
				<div class="onoffswitch">
					<input
						type="checkbox"
						id="<?php echo esc_attr( $this->id ); ?>"
						name="<?php echo esc_attr( $this->id ); ?>"
						class="onoffswitch-checkbox"
						value="<?php echo esc_attr( $this->value() ); ?>"
						<?php $this->link(); ?>
						<?php $this->link() . checked( $this->value() ); ?>
					>
					<label class="onoffswitch-label" for="<?php echo esc_attr( $this->id ); ?>"></label>
				</div>
				<span class="customize-control-title onoffswitch_label"><?php echo esc_html( $this->label ); ?></span>
				<?php
				if ( ! empty( $this->description ) ) {
					?>
					<span class="customize-control-desc"><?php echo esc_html( $this->description ); ?></span>
					<?php
				}
				?>
			</div>
			<?php
		}
	}
}
