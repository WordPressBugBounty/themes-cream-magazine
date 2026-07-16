<?php
/**
 * Customize Separator Control.
 *
 * @since 1.0.0
 *
 * @package Cream_Magazine
 */

if ( ! class_exists( 'Cream_Magazine_Separator_Control' ) ) {
	/**
	 * Customize Separator Control Class.
	 *
	 * @since 1.0.0
	 *
	 * @see WP_Customize_Control
	 */
	class Cream_Magazine_Separator_Control extends WP_Customize_Control {
		/**
		 * Control type
		 *
		 * @var string
		 */
		public $type = 'separator';

		/**
		 * Renders the control wrapper and calls $this->render_content() for the internals.
		 *
		 * @since 1.0.0
		 */
		public function render_content() {
			?>
			<p><hr></p>
			<?php
		}
	}
}
