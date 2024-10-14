<?php
/**
 * Customize sections and settings for search page.
 *
 * @since 2.0.0
 *
 * @package Cream_Magazine
 */

if ( ! class_exists( 'Cream_Magazine_Search_Page_Customize' ) ) {
	/**
	 * Define and register sections and settings for search page.
	 *
	 * @since 2.0.0
	 *
	 * @package Cream_Magazine
	 */
	class Cream_Magazine_Search_Page_Customize {

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
				'cream_magazine_search_page_options',
				array(
					'title' => esc_html__( 'Search Page', 'cream-magazine' ),
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
				'cream_magazine_enable_search_author_meta',
				array(
					'sanitize_callback' => 'wp_validate_boolean',
					'default'           => $defaults['cream_magazine_enable_search_author_meta'],
				)
			);

			$wp_customize->add_control(
				new Cream_Magazine_Toggle_Switch_Control(
					$wp_customize,
					'cream_magazine_enable_search_author_meta',
					array(
						'label'   => esc_html__( 'Enable Post Author Meta', 'cream-magazine' ),
						'section' => 'cream_magazine_search_page_options',
						'type'    => 'checkbox',
					)
				)
			);

			$wp_customize->add_setting(
				'cream_magazine_enable_search_date_meta',
				array(
					'sanitize_callback' => 'wp_validate_boolean',
					'default'           => $defaults['cream_magazine_enable_search_date_meta'],
				)
			);

			$wp_customize->add_control(
				new Cream_Magazine_Toggle_Switch_Control(
					$wp_customize,
					'cream_magazine_enable_search_date_meta',
					array(
						'label'   => esc_html__( 'Enable Posted Date Meta', 'cream-magazine' ),
						'section' => 'cream_magazine_search_page_options',
						'type'    => 'checkbox',
					)
				)
			);

			$wp_customize->add_setting(
				'cream_magazine_enable_search_cmnts_no_meta',
				array(
					'sanitize_callback' => 'wp_validate_boolean',
					'default'           => $defaults['cream_magazine_enable_search_cmnts_no_meta'],
				)
			);

			$wp_customize->add_control(
				new Cream_Magazine_Toggle_Switch_Control(
					$wp_customize,
					'cream_magazine_enable_search_cmnts_no_meta',
					array(
						'label'   => esc_html__( 'Enable Post Comments Number Meta', 'cream-magazine' ),
						'section' => 'cream_magazine_search_page_options',
						'type'    => 'checkbox',
					)
				)
			);

			$wp_customize->add_setting(
				'cream_magazine_enable_search_categories_meta',
				array(
					'sanitize_callback' => 'wp_validate_boolean',
					'default'           => $defaults['cream_magazine_enable_search_categories_meta'],
				)
			);

			$wp_customize->add_control(
				new Cream_Magazine_Toggle_Switch_Control(
					$wp_customize,
					'cream_magazine_enable_search_categories_meta',
					array(
						'label'   => esc_html__( 'Enable Post Categories Meta', 'cream-magazine' ),
						'section' => 'cream_magazine_search_page_options',
						'type'    => 'checkbox',
					)
				)
			);

			$wp_customize->add_setting(
				'cream_magazine_search_page_separator_1',
				array(
					'sanitize_callback' => 'esc_html',
					'default'           => '',
				)
			);

			$wp_customize->add_control(
				new Cream_Magazine_Separator_Control(
					$wp_customize,
					'cream_magazine_search_page_separator_1',
					array(
						'section' => 'cream_magazine_search_page_options',
					)
				)
			);

			$wp_customize->add_setting(
				'cream_magazine_show_search_post_excerpt',
				array(
					'sanitize_callback' => 'wp_validate_boolean',
					'default'           => $defaults['cream_magazine_show_search_post_excerpt'],
				)
			);

			$wp_customize->add_control(
				new Cream_Magazine_Toggle_Switch_Control(
					$wp_customize,
					'cream_magazine_show_search_post_excerpt',
					array(
						'label'   => esc_html__( 'Display Post Excerpt', 'cream-magazine' ),
						'section' => 'cream_magazine_search_page_options',
						'type'    => 'checkbox',
					)
				)
			);

			$wp_customize->add_setting(
				'cream_magazine_hide_pages_on_search_results',
				array(
					'sanitize_callback' => 'wp_validate_boolean',
					'default'           => $defaults['cream_magazine_hide_pages_on_search_results'],
				)
			);

			$wp_customize->add_control(
				new Cream_Magazine_Toggle_Switch_Control(
					$wp_customize,
					'cream_magazine_hide_pages_on_search_results',
					array(
						'label'   => esc_html__( 'Hide Pages On Search Results', 'cream-magazine' ),
						'section' => 'cream_magazine_search_page_options',
						'type'    => 'checkbox',
					)
				)
			);

			$wp_customize->add_setting(
				'cream_magazine_search_page_separator_2',
				array(
					'sanitize_callback' => 'esc_html',
					'default'           => '',
				)
			);

			$wp_customize->add_control(
				new Cream_Magazine_Separator_Control(
					$wp_customize,
					'cream_magazine_search_page_separator_2',
					array(
						'section' => 'cream_magazine_search_page_options',
					)
				)
			);

			$wp_customize->add_setting(
				'cream_magazine_select_search_sidebar_position',
				array(
					'sanitize_callback' => 'cream_magazine_sanitize_select',
					'default'           => $defaults['cream_magazine_select_search_sidebar_position'],
				)
			);

			$wp_customize->add_control(
				new Cream_Magazine_Radio_Image_Control(
					$wp_customize,
					'cream_magazine_select_search_sidebar_position',
					array(
						'label'   => esc_html__( 'Select Sidebar Position', 'cream-magazine' ),
						'section' => 'cream_magazine_search_page_options',
						'type'    => 'select',
						'choices' => cream_magazine_sidebar_positions(),
					)
				)
			);
		}
	}
}

new Cream_Magazine_Search_Page_Customize();
