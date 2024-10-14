<?php
/**
 * Customize sections and settings for post excerpt.
 *
 * @since 2.0.0
 *
 * @package Cream_Magazine
 */

if ( ! class_exists( 'Cream_Magazine_Post_Excerpt_Customize' ) ) {
	/**
	 * Define and register sections and settings for post excerpt.
	 *
	 * @since 2.0.0
	 *
	 * @package Cream_Magazine
	 */
	class Cream_Magazine_Post_Excerpt_Customize {

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
				'cream_magazine_post_excerpt_options',
				array(
					'title' => esc_html__( 'Post Excerpt', 'cream-magazine' ),
					'panel' => 'cream_magazine_theme_customization',
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
				'cream_magazine_post_excerpt_length',
				array(
					'sanitize_callback' => 'cream_magazine_sanitize_number',
					'default'           => $defaults['cream_magazine_post_excerpt_length'],
				)
			);

			$wp_customize->add_control(
				'cream_magazine_post_excerpt_length',
				array(
					'label'   => esc_html__( 'Excerpt Length', 'cream-magazine' ),
					'section' => 'cream_magazine_post_excerpt_options',
					'type'    => 'number',
				)
			);
		}
	}
}

new Cream_Magazine_Post_Excerpt_Customize();
