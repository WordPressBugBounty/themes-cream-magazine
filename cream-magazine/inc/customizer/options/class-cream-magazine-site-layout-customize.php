<?php
/**
 * Customize sections and settings for theme layout.
 *
 * @since 2.0.0
 *
 * @package Cream_Magazine
 */

if ( ! class_exists( 'Cream_Magazine_Site_Layout_Customize' ) ) {
	/**
	 * Define and register sections and settings for theme layout.
	 *
	 * @since 2.0.0
	 *
	 * @package Cream_Magazine
	 */
	class Cream_Magazine_Site_Layout_Customize {

		/**
		 * Register sections and settings.
		 *
		 * @since  1.0.0
		 */
		public function __construct() {

			add_action( 'customize_register', array( $this, 'register_sections' ) );

			add_action( 'customize_register', array( $this, 'register_settings' ) );
		}

		/**
		 * Sets up the customizer sections.
		 *
		 * @since  2.0.0
		 *
		 * @param object $wp_customize WP Customize Manager instance.
		 */
		public function register_sections( $wp_customize ) {

			$wp_customize->add_section(
				'cream_magazine_site_layout_options',
				array(
					'title'    => esc_html__( 'Site Layout', 'cream-magazine' ),
					'priority' => 10,
				)
			);
		}

		/**
		 * Sets up the customizer sections.
		 *
		 * @since  2.0.0
		 *
		 * @param object $wp_customize WP Customize Manager instance.
		 */
		public function register_settings( $wp_customize ) {

			$defaults = cream_magazine_get_default_theme_options();

			$wp_customize->add_setting(
				'cream_magazine_select_site_layout',
				array(
					'sanitize_callback' => 'cream_magazine_sanitize_select',
					'default'           => $defaults['cream_magazine_select_site_layout'],
				)
			);

			$wp_customize->add_control(
				'cream_magazine_select_site_layout',
				array(
					'label'   => esc_html__( 'Select Site Layout', 'cream-magazine' ),
					'section' => 'cream_magazine_site_layout_options',
					'type'    => 'select',
					'choices' => array(
						'boxed'     => esc_html__( 'Boxed Layout', 'cream-magazine' ),
						'fullwidth' => esc_html__( 'Fullwidth Layout', 'cream-magazine' ),
					),
				)
			);
		}
	}
}

new Cream_Magazine_Site_Layout_Customize();
