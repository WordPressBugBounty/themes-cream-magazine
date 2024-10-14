<?php
/**
 * Customize sections and settings for breadcrumbs.
 *
 * @since 2.0.0
 *
 * @package Cream_Magazine
 */

if ( ! class_exists( 'Cream_Magazine_Breadcrumbs_Customize' ) ) {
	/**
	 * Define and register sections and settings for breadcrumbs.
	 *
	 * @since 2.0.0
	 *
	 * @package Cream_Magazine
	 */
	class Cream_Magazine_Breadcrumbs_Customize {

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
				'cream_magazine_breadcrumb_options',
				array(
					'title' => esc_html__( 'Breadcrumb', 'cream-magazine' ),
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
				'cream_magazine_enable_breadcrumb',
				array(
					'sanitize_callback' => 'wp_validate_boolean',
					'default'           => $defaults['cream_magazine_enable_breadcrumb'],
				)
			);

			$wp_customize->add_control(
				new Cream_Magazine_Toggle_Switch_Control(
					$wp_customize,
					'cream_magazine_enable_breadcrumb',
					array(
						'label'   => esc_html__( 'Enable Breadcrumb', 'cream-magazine' ),
						'section' => 'cream_magazine_breadcrumb_options',
						'type'    => 'checkbox',
					)
				)
			);

			$wp_customize->add_setting(
				'cream_magazine_breadcrumb_separator_1',
				array(
					'sanitize_callback' => 'esc_html',
					'default'           => '',
				)
			);

			$wp_customize->add_control(
				new Cream_Magazine_Separator_Control(
					$wp_customize,
					'cream_magazine_breadcrumb_separator_1',
					array(
						'section'         => 'cream_magazine_breadcrumb_options',
						'active_callback' => 'cream_magazine_is_breadcrumbs_active',
					)
				)
			);

			$wp_customize->add_setting(
				'cream_magazine_breadcrumb_sources',
				array(
					'sanitize_callback' => 'cream_magazine_sanitize_select',
					'default'           => $defaults['cream_magazine_breadcrumb_sources'],
				)
			);

			$wp_customize->add_control(
				'cream_magazine_breadcrumb_sources',
				array(
					'label'           => esc_html__( 'Breadcrumb Source', 'cream-magazine' ),
					'description'     => sprintf(
						/* translators: 1: breadcrumb-navxt open anchor, 2: breadcrumb-navxt close anchor, 3: wordpress-seo open anchor, 4: wordpress-seo close anchor, 5: seo-by-rank-math open anchor, 6: seo-by-rank-math close anchor. */
						__( 'You can use theme&rsquo;s default breadcrumb or use any one of the plugin for breadcrumb, %1$sBreadcrumb NavXT%2$s or %3$sYoast SEO%4$s or %5$sRank Math%6$s', 'cream-magazine' ),
						'<a href="https://wordpress.org/plugins/breadcrumb-navxt/" target="_blank">',
						'</a>',
						'<a href="https://wordpress.org/plugins/wordpress-seo/" target="_blank">',
						'</a>',
						'<a href="https://wordpress.org/plugins/seo-by-rank-math/" target="_blank">',
						'</a>'
					),
					'section'         => 'cream_magazine_breadcrumb_options',
					'type'            => 'select',
					'choices'         => cream_magazine_breadcrumb_sources(),
					'active_callback' => 'cream_magazine_is_breadcrumbs_active',
				)
			);
		}
	}
}

new Cream_Magazine_Breadcrumbs_Customize();
