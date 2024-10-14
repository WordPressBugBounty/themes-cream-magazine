<?php
/**
 * Customize sections and settings for WooCommerce.
 *
 * @since 2.0.0
 *
 * @package Cream_Magazine
 */

if ( ! class_exists( 'Cream_Magazine_WooCommerce_Customize' ) ) {
	/**
	 * Define and register sections and settings for WooCommerce.
	 *
	 * @since 2.0.0
	 *
	 * @package Cream_Magazine
	 */
	class Cream_Magazine_WooCommerce_Customize {

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
				'cream_magazine_woocommerce_sidebar_position',
				array(
					'title' => esc_html__( 'Woocommerce Sidebar Position', 'cream-magazine' ),
					'panel' => 'woocommerce',
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
				'cream_magazine_select_woocommerce_sidebar_position',
				array(
					'sanitize_callback' => 'cream_magazine_sanitize_select',
					'default'           => $defaults['cream_magazine_select_woocommerce_sidebar_position'],
				)
			);

			$wp_customize->add_control(
				new Cream_Magazine_Radio_Image_Control(
					$wp_customize,
					'cream_magazine_select_woocommerce_sidebar_position',
					array(
						'label'   => esc_html__( 'Woocommerce Sidebar Position', 'cream-magazine' ),
						'section' => 'cream_magazine_woocommerce_sidebar_position',
						'type'    => 'select',
						'choices' => cream_magazine_sidebar_positions(),
					)
				)
			);
		}
	}
}

new Cream_Magazine_WooCommerce_Customize();
