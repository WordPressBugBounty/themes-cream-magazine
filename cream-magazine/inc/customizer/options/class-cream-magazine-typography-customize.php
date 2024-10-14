<?php
/**
 * Customize sections and settings for typography.
 *
 * @since 2.0.0
 *
 * @package Cream_Magazine
 */

if ( ! class_exists( 'Cream_Magazine_Typography_Customize' ) ) {
	/**
	 * Define and register sections and settings for typography.
	 *
	 * @since 2.0.0
	 *
	 * @package Cream_Magazine
	 */
	class Cream_Magazine_Typography_Customize {

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
				'cream_magazine_body_typo_options',
				array(
					'title' => esc_html__( 'Body', 'cream-magazine' ),
					'panel' => 'cream_magazine_typography_customization',
				)
			);

			$wp_customize->add_section(
				'cream_magazine_headings_typo_options',
				array(
					'title' => esc_html__( 'Headings(H1-H6)', 'cream-magazine' ),
					'panel' => 'cream_magazine_typography_customization',
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
				'cream_magazine_body_font',
				array(
					'default'           => $defaults['cream_magazine_body_font'],
					'sanitize_callback' => 'cream_magazine_sanitize_font',
				)
			);

			$wp_customize->add_control(
				new Cream_Magazine_Customize_Typography_Control(
					$wp_customize,
					'cream_magazine_body_font',
					array(
						'label'   => esc_html__( 'Font Family', 'cream-magazine' ),
						'section' => 'cream_magazine_body_typo_options',
					)
				)
			);

			$wp_customize->add_setting(
				'cream_magazine_headings_font',
				array(
					'default'           => $defaults['cream_magazine_headings_font'],
					'sanitize_callback' => 'cream_magazine_sanitize_font',
				)
			);

			$wp_customize->add_control(
				new Cream_Magazine_Customize_Typography_Control(
					$wp_customize,
					'cream_magazine_headings_font',
					array(
						'label'   => esc_html__( 'Font Family', 'cream-magazine' ),
						'section' => 'cream_magazine_headings_typo_options',
					)
				)
			);
		}
	}
}

new Cream_Magazine_Typography_Customize();
