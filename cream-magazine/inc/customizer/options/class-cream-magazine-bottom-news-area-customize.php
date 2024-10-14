<?php
/**
 * Customize sections and settings for bottom news area.
 *
 * @since 2.0.0
 *
 * @package Cream_Magazine
 */

if ( ! class_exists( 'Cream_Magazine_Bottom_News_Area_Customize' ) ) {
	/**
	 * Define and register sections and settings for bottom news area.
	 *
	 * @since 2.0.0
	 *
	 * @package Cream_Magazine
	 */
	class Cream_Magazine_Bottom_News_Area_Customize {

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
				'cream_magazine_bottom_news_area_options',
				array(
					'title' => esc_html__( 'Bottom News Area', 'cream-magazine' ),
					'panel' => 'cream_magazine_homepage_customization',
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
				'cream_magazine_display_bottom_widget_area',
				array(
					'sanitize_callback' => 'wp_validate_boolean',
					'default'           => $defaults['cream_magazine_display_bottom_widget_area'],
				)
			);

			$wp_customize->add_control(
				new Cream_Magazine_Toggle_Switch_Control(
					$wp_customize,
					'cream_magazine_display_bottom_widget_area',
					array(
						'label'   => esc_html__( 'Show Bottom News Area', 'cream-magazine' ),
						'section' => 'cream_magazine_bottom_news_area_options',
						'type'    => 'checkbox',
					)
				)
			);
		}
	}
}

new Cream_Magazine_Bottom_News_Area_Customize();
