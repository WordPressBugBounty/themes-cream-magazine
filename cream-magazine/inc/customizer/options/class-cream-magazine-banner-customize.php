<?php
/**
 * Customize sections and settings for banner/slider.
 *
 * @since 2.0.0
 *
 * @package Cream_Magazine
 */

if ( ! class_exists( 'Cream_Magazine_Banner_Customize' ) ) {
	/**
	 * Define and register sections and settings for banner/slider.
	 *
	 * @since 2.0.0
	 *
	 * @package Cream_Magazine
	 */
	class Cream_Magazine_Banner_Customize {

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
				'cream_magazine_banner_options',
				array(
					'title' => esc_html__( 'Banner/Slider', 'cream-magazine' ),
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
				'cream_magazine_enable_banner',
				array(
					'sanitize_callback' => 'wp_validate_boolean',
					'default'           => $defaults['cream_magazine_enable_banner'],
				)
			);

			$wp_customize->add_control(
				new Cream_Magazine_Toggle_Switch_Control(
					$wp_customize,
					'cream_magazine_enable_banner',
					array(
						'label'   => esc_html__( 'Enable Banner/Slider', 'cream-magazine' ),
						'section' => 'cream_magazine_banner_options',
						'type'    => 'checkbox',
					)
				)
			);

			$wp_customize->add_setting(
				'cream_magazine_banner_separator_1',
				array(
					'sanitize_callback' => 'esc_html',
					'default'           => '',
				)
			);

			$wp_customize->add_control(
				new Cream_Magazine_Separator_Control(
					$wp_customize,
					'cream_magazine_banner_separator_1',
					array(
						'section'         => 'cream_magazine_banner_options',
						'active_callback' => 'cream_magaine_is_banner_active',
					)
				)
			);

			$wp_customize->add_setting(
				'cream_magazine_banner_categories',
				array(
					'sanitize_callback' => 'cream_magazine_sanitize_multiple_cat_select',
				)
			);

			if ( 'slug' === cream_magazine_get_option( 'cream_magazine_save_value_as' ) ) {

				$wp_customize->add_control(
					new Cream_Magazine_Dropdown_Select_Control(
						$wp_customize,
						'cream_magazine_banner_categories',
						array(
							'label'           => esc_html__( 'Banner/Slider Post Categories', 'cream-magazine' ),
							'section'         => 'cream_magazine_banner_options',
							'choices'         => cream_magazine_categories_tax_slug(),
							'input_attrs'     => array(
								'multiselect' => true,
							),
							'active_callback' => 'cream_magaine_is_banner_active',
						)
					)
				);
			} else {

				$wp_customize->add_control(
					new Cream_Magazine_Dropdown_Select_Control(
						$wp_customize,
						'cream_magazine_banner_categories',
						array(
							'label'           => esc_html__( 'Banner/Slider Post Categories', 'cream-magazine' ),
							'section'         => 'cream_magazine_banner_options',
							'choices'         => cream_magazine_categories_tax_id(),
							'input_attrs'     => array(
								'multiselect' => true,
							),
							'active_callback' => 'cream_magaine_is_banner_active',
						)
					)
				);
			}

			$wp_customize->add_setting(
				'cream_magazine_banner_separator_2',
				array(
					'sanitize_callback' => 'esc_html',
					'default'           => '',
				)
			);

			$wp_customize->add_control(
				new Cream_Magazine_Separator_Control(
					$wp_customize,
					'cream_magazine_banner_separator_2',
					array(
						'section'         => 'cream_magazine_banner_options',
						'active_callback' => 'cream_magaine_is_banner_active',
					)
				)
			);

			$wp_customize->add_setting(
				'cream_magazine_banner_posts_no',
				array(
					'sanitize_callback' => 'cream_magazine_sanitize_number',
					'default'           => $defaults['cream_magazine_banner_posts_no'],
				)
			);

			$wp_customize->add_control(
				'cream_magazine_banner_posts_no',
				array(
					'label'           => esc_html__( 'Number of Slider Items', 'cream-magazine' ),
					'description'     => esc_html__( 'Note: This option works only for slider part.', 'cream-magazine' ),
					'section'         => 'cream_magazine_banner_options',
					'type'            => 'number',
					'active_callback' => 'cream_magaine_is_banner_active',
				)
			);

			$wp_customize->add_setting(
				'cream_magazine_banner_separator_3',
				array(
					'sanitize_callback' => 'esc_html',
					'default'           => '',
				)
			);

			$wp_customize->add_control(
				new Cream_Magazine_Separator_Control(
					$wp_customize,
					'cream_magazine_banner_separator_3',
					array(
						'section'         => 'cream_magazine_banner_options',
						'active_callback' => 'cream_magaine_is_banner_active',
					)
				)
			);

			$wp_customize->add_setting(
				'cream_magazine_enable_banner_author_meta',
				array(
					'sanitize_callback' => 'wp_validate_boolean',
					'default'           => $defaults['cream_magazine_enable_banner_author_meta'],
				)
			);

			$wp_customize->add_control(
				new Cream_Magazine_Toggle_Switch_Control(
					$wp_customize,
					'cream_magazine_enable_banner_author_meta',
					array(
						'label'           => esc_html__( 'Enable Post Author Meta', 'cream-magazine' ),
						'section'         => 'cream_magazine_banner_options',
						'type'            => 'checkbox',
						'active_callback' => 'cream_magaine_is_banner_active',
					)
				)
			);

			$wp_customize->add_setting(
				'cream_magazine_enable_banner_date_meta',
				array(
					'sanitize_callback' => 'wp_validate_boolean',
					'default'           => $defaults['cream_magazine_enable_banner_date_meta'],
				)
			);

			$wp_customize->add_control(
				new Cream_Magazine_Toggle_Switch_Control(
					$wp_customize,
					'cream_magazine_enable_banner_date_meta',
					array(
						'label'           => esc_html__( 'Enable Posted Date Meta', 'cream-magazine' ),
						'section'         => 'cream_magazine_banner_options',
						'type'            => 'checkbox',
						'active_callback' => 'cream_magaine_is_banner_active',
					)
				)
			);

			$wp_customize->add_setting(
				'cream_magazine_enable_banner_cmnts_no_meta',
				array(
					'sanitize_callback' => 'wp_validate_boolean',
					'default'           => $defaults['cream_magazine_enable_banner_cmnts_no_meta'],
				)
			);

			$wp_customize->add_control(
				new Cream_Magazine_Toggle_Switch_Control(
					$wp_customize,
					'cream_magazine_enable_banner_cmnts_no_meta',
					array(
						'label'           => esc_html__( 'Enable Post Comments Number Meta', 'cream-magazine' ),
						'section'         => 'cream_magazine_banner_options',
						'type'            => 'checkbox',
						'active_callback' => 'cream_magaine_is_banner_active',
					)
				)
			);

			$wp_customize->add_setting(
				'cream_magazine_enable_banner_categories_meta',
				array(
					'sanitize_callback' => 'wp_validate_boolean',
					'default'           => $defaults['cream_magazine_enable_banner_categories_meta'],
				)
			);

			$wp_customize->add_control(
				new Cream_Magazine_Toggle_Switch_Control(
					$wp_customize,
					'cream_magazine_enable_banner_categories_meta',
					array(
						'label'           => esc_html__( 'Enable Post Categories Meta', 'cream-magazine' ),
						'section'         => 'cream_magazine_banner_options',
						'type'            => 'checkbox',
						'active_callback' => 'cream_magaine_is_banner_active',
					)
				)
			);
		}
	}
}

new Cream_Magazine_Banner_Customize();
