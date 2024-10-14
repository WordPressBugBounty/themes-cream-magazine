<?php
/**
 * Customize sections and settings for pro upsell.
 *
 * @since 2.0.0
 *
 * @package Cream_Magazine
 */

if ( ! class_exists( 'Cream_Magazine_Upsell_Customize' ) ) {
	/**
	 * Define and register sections and settings for pro upsell.
	 *
	 * @since 2.0.0
	 *
	 * @package Cream_Magazine
	 */
	class Cream_Magazine_Upsell_Customize {

		/**
		 * Register sections and settings.
		 *
		 * @since  1.0.0
		 */
		public function __construct() {

			add_action( 'customize_register', array( $this, 'register_sections' ) );
		}

		/**
		 * Sets up the customizer sections.
		 *
		 * @since  2.0.0
		 *
		 * @param object $wp_customize WP Customize Manager instance.
		 */
		public function register_sections( $wp_customize ) {

			require get_template_directory() . '/inc/customizer/upgrade-to-pro/class-cream-magazine-section-upsell.php';

			$wp_customize->register_section_type( 'Cream_Magazine_Section_Upsell' );

			$wp_customize->add_section(
				new Cream_Magazine_Section_Upsell(
					$wp_customize,
					'theme_upsell',
					array(
						'title'    => esc_html__( 'Cream Magazine Pro', 'cream-magazine' ),
						'pro_text' => esc_html__( 'Get Pro', 'cream-magazine' ),
						'pro_url'  => 'https://themebeez.com/themes/cream-magazine-pro/?ref=cm-upsell-button',
						'priority' => 1,
					)
				)
			);
		}
	}
}

new Cream_Magazine_Upsell_Customize();
