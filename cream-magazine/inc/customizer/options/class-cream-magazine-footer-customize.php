<?php
/**
 * Customize sections and settings for theme footer.
 *
 * @since 2.0.0
 *
 * @package Cream_Magazine
 */

if ( ! class_exists( 'Cream_Magazine_Footer_Customize' ) ) {
	/**
	 * Define and register sections and settings for theme footer.
	 *
	 * @since 2.0.0
	 *
	 * @package Cream_Magazine
	 */
	class Cream_Magazine_Footer_Customize {

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
				'cream_magazine_footer_options',
				array(
					'title' => esc_html__( 'Footer', 'cream-magazine' ),
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
				'cream_magazine_show_footer_widget_area',
				array(
					'sanitize_callback' => 'wp_validate_boolean',
					'default'           => $defaults['cream_magazine_show_footer_widget_area'],
				)
			);

			$wp_customize->add_control(
				new Cream_Magazine_Toggle_Switch_Control(
					$wp_customize,
					'cream_magazine_show_footer_widget_area',
					array(
						'label'   => esc_html__( 'Display Footer Widget Area', 'cream-magazine' ),
						'section' => 'cream_magazine_footer_options',
						'type'    => 'checkbox',
					)
				)
			);

			$wp_customize->add_setting(
				'cream_magazine_show_footer_widget_area_on_mobile_n_tablet',
				array(
					'sanitize_callback' => 'wp_validate_boolean',
					'default'           => $defaults['cream_magazine_show_footer_widget_area_on_mobile_n_tablet'],
				)
			);

			$wp_customize->add_control(
				new Cream_Magazine_Toggle_Switch_Control(
					$wp_customize,
					'cream_magazine_show_footer_widget_area_on_mobile_n_tablet',
					array(
						'label'           => esc_html__( 'Display Footer Widget Area On Mobile &amp; Tablet Devices', 'cream-magazine' ),
						'section'         => 'cream_magazine_footer_options',
						'type'            => 'checkbox',
						'active_callback' => 'cream_magazine_is_footer_widget_area_active',
					)
				)
			);

			$wp_customize->add_setting(
				'cream_magazine_footer_separator_1',
				array(
					'sanitize_callback' => 'esc_html',
					'default'           => '',
				)
			);

			$wp_customize->add_control(
				new Cream_Magazine_Separator_Control(
					$wp_customize,
					'cream_magazine_footer_separator_1',
					array(
						'section' => 'cream_magazine_footer_options',
					)
				)
			);

			$wp_customize->add_setting(
				'cream_magazine_enable_scroll_top_button',
				array(
					'sanitize_callback' => 'wp_validate_boolean',
					'default'           => $defaults['cream_magazine_enable_scroll_top_button'],
				)
			);

			$wp_customize->add_control(
				new Cream_Magazine_Toggle_Switch_Control(
					$wp_customize,
					'cream_magazine_enable_scroll_top_button',
					array(
						'label'   => esc_html__( 'Enable Scroll Top Button', 'cream-magazine' ),
						'section' => 'cream_magazine_footer_options',
						'type'    => 'checkbox',
					)
				)
			);

			$wp_customize->add_setting(
				'cream_magazine_footer_separator_2',
				array(
					'sanitize_callback' => 'esc_html',
					'default'           => '',
				)
			);

			$wp_customize->add_control(
				new Cream_Magazine_Separator_Control(
					$wp_customize,
					'cream_magazine_footer_separator_2',
					array(
						'section' => 'cream_magazine_footer_options',
					)
				)
			);

			$wp_customize->add_setting(
				'cream_magazine_copyright_credit',
				array(
					'sanitize_callback' => 'sanitize_text_field',
					'default'           => $defaults['cream_magazine_copyright_credit'],
					'transport'         => 'postMessage',
				)
			);

			$wp_customize->add_control(
				'cream_magazine_copyright_credit',
				array(
					'label'   => esc_html__( 'Copyright Text', 'cream-magazine' ),
					'section' => 'cream_magazine_footer_options',
					'type'    => 'text',
				)
			);
		}
	}
}

new Cream_Magazine_Footer_Customize();
