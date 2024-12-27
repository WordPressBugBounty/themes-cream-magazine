<?php
/**
 * Singleton class for handling the theme's customize.
 *
 * @since  1.0.0
 *
 * @package Cream_Magazine
 */

if ( ! class_exists( 'Cream_Magazine_Customize' ) ) {
	/**
	 * Singleton class for handling the theme's customize.
	 *
	 * @since  1.0.0
	 *
	 * @package Cream_Magazine
	 */
	class Cream_Magazine_Customize {

		/**
		 * Setup theme customize.
		 *
		 * @since  1.0.0
		 */
		public function __construct() {

			$this->setup_actions();
		}

		/**
		 * Load customize helper functions.
		 *
		 * @since  1.0.0
		 */
		public function dependencies() {

			require get_template_directory() . '/inc/customizer/functions/control-choices.php';
		}

		/**
		 * Sets up initial actions.
		 *
		 * @since  1.0.0
		 */
		public function setup_actions() {

			// Enqueue scripts and styles for the preview.
			add_action( 'customize_preview_init', array( $this, 'customize_preview_js' ) );

			// Register panels, sections, settings, controls, and partials.
			add_action( 'customize_register', array( $this, 'controls' ) );
			add_action( 'customize_register', array( $this, 'register_panels' ) );
			add_action( 'customize_register', array( $this, 'register_settings' ) );
			add_action( 'customize_register', array( $this, 'add_partials' ) );

			$this->load_options();

			// Register scripts and styles for the controls.
			add_action( 'customize_controls_enqueue_scripts', array( $this, 'customizer_scripts' ), 10 );
		}

		/**
		 * Register Customizer Controls
		 *
		 * @since  1.0.0
		 *
		 * @param object $wp_customize WP Customize Manager instance.
		 */
		public function controls( $wp_customize ) {

			// Select Dropdown Control.
			require get_template_directory() . '/inc/customizer/controls/select/class-cream-magazine-dropdown-select-control.php';
			// Radio Image Control.
			require get_template_directory() . '/inc/customizer/controls/class-cream-magazine-radio-image-control.php';
			// Separator Control.
			require get_template_directory() . '/inc/customizer/controls/class-cream-magazine-separator-control.php';
			// Toggle Switch Control.
			require get_template_directory() . '/inc/customizer/controls/class-cream-magazine-toggle-switch-control.php';
			// Color Alpha Picker Control.
			require get_template_directory() . '/inc/customizer/controls/class-cream-magazine-alpha-color-picker-control.php';

			// Typography Control.
			require get_template_directory() . '/inc/customizer/controls/typography/class-cream-magazine-customize-typography-control.php';
			$wp_customize->register_section_type( 'Cream_Magazine_Customize_Typography_Control' );
		}

		/**
		 * Sets up the customizer panels.
		 *
		 * @since  1.0.0
		 *
		 * @param object $wp_customize WP Customize Manager instance.
		 */
		public function register_panels( $wp_customize ) {

			// Front Page Customization Panel.
			$wp_customize->add_panel(
				'cream_magazine_homepage_customization',
				array(
					'title'    => esc_html__( 'Front Page Customization', 'cream-magazine' ),
					'priority' => 10,
				)
			);

			// Theme Customization Panel.
			$wp_customize->add_panel(
				'cream_magazine_theme_customization',
				array(
					'title'    => esc_html__( 'Theme Customization', 'cream-magazine' ),
					'priority' => 10,
				)
			);

			// Theme Color Customization Panel.
			$wp_customize->add_panel(
				'cream_magazine_color_customization',
				array(
					'title'    => esc_html__( 'Color Customization', 'cream-magazine' ),
					'priority' => 10,
				)
			);

			// Typography Customization Panel.
			$wp_customize->add_panel(
				'cream_magazine_typography_customization',
				array(
					'title'    => esc_html__( 'Typography Customization', 'cream-magazine' ),
					'priority' => 10,
				)
			);

			// Global Customization Panel.
			$wp_customize->add_panel(
				'cream_magazine_global_customization',
				array(
					'title'    => esc_html__( 'Global', 'cream-magazine' ),
					'priority' => 10,
				)
			);
		}

		/**
		 * Sets up the customizer settings.
		 *
		 * @since  1.0.0
		 *
		 * @param object $wp_customize WP Customize Manager instance.
		 */
		public function register_settings( $wp_customize ) {

			// Customizer Sanitization.
			require get_template_directory() . '/inc/customizer/functions/sanitize-callback.php';

			// Set the transport property of existing settings.
			$wp_customize->get_setting( 'blogname' )->transport         = 'postMessage';
			$wp_customize->get_setting( 'blogdescription' )->transport  = 'postMessage';
			$wp_customize->get_setting( 'header_textcolor' )->transport = 'postMessage';

			$wp_customize->get_control( 'header_textcolor' )->section = 'title_tagline';
			$wp_customize->get_control( 'background_color' )->section = 'background_image';
			$wp_customize->get_control( 'header_textcolor' )->label   = esc_html__( 'Site Title Color', 'cream-magazine' );

			$wp_customize->get_section( 'background_image' )->title = esc_html__( 'Site Background', 'cream-magazine' );
		}

		/**
		 * Load theme settings.
		 *
		 * @since  1.0.0
		 */
		public function load_options() {

			// Load Upsell.
			require get_template_directory() . '/inc/customizer/options/class-cream-magazine-upsell-customize.php';

			// Load Top News Area Settings.
			require get_template_directory() . '/inc/customizer/options/class-cream-magazine-top-news-area-customize.php';
			// Load Middle News Area Settings.
			require get_template_directory() . '/inc/customizer/options/class-cream-magazine-middle-news-area-customize.php';
			// Load Bottom News Area Settings.
			require get_template_directory() . '/inc/customizer/options/class-cream-magazine-bottom-news-area-customize.php';

			// Load Banner Settings.
			require get_template_directory() . '/inc/customizer/options/class-cream-magazine-banner-customize.php';
			// Load News Ticker Settings.
			require get_template_directory() . '/inc/customizer/options/class-cream-magazine-news-ticker-customize.php';
			// Load Header Settings.
			require get_template_directory() . '/inc/customizer/options/class-cream-magazine-header-customize.php';
			// Load Footer Settings.
			require get_template_directory() . '/inc/customizer/options/class-cream-magazine-footer-customize.php';
			// Load Blog Page Settings.
			require get_template_directory() . '/inc/customizer/options/class-cream-magazine-blog-page-customize.php';
			// Load Archive Page Settings.
			require get_template_directory() . '/inc/customizer/options/class-cream-magazine-customize-archive-page-customize.php';
			// Load Search Page Settings.
			require get_template_directory() . '/inc/customizer/options/class-cream-magazine-search-page-customize.php';
			// Load Post Single Settings.
			require get_template_directory() . '/inc/customizer/options/class-cream-magazine-post-single-customize.php';
			// Load Page Single Settings.
			require get_template_directory() . '/inc/customizer/options/class-cream-magazine-page-single-customize.php';
			// Load Post Meta Settings.
			require get_template_directory() . '/inc/customizer/options/class-cream-magazine-post-meta-customize.php';
			// Load Post Excerpt Settings.
			require get_template_directory() . '/inc/customizer/options/class-cream-magazine-post-excerpt-customize.php';
			// Load Social Links Settings.
			require get_template_directory() . '/inc/customizer/options/class-cream-magazine-social-links-customize.php';
			// Load Breadcrumb Settings.
			require get_template_directory() . '/inc/customizer/options/class-cream-magazine-breadcrumbs-customize.php';
			// Load Site Sidebar Settings.
			require get_template_directory() . '/inc/customizer/options/class-cream-magazine-site-sidebar-customize.php';
			// Load Color Settings.
			require get_template_directory() . '/inc/customizer/options/class-cream-magazine-colors-customize.php';
			// Load Typography Settings.
			require get_template_directory() . '/inc/customizer/options/class-cream-magazine-typography-customize.php';
			// Load Site Layout Settings.
			require get_template_directory() . '/inc/customizer/options/class-cream-magazine-site-layout-customize.php';
			// Load Global Settings.
			require get_template_directory() . '/inc/customizer/options/class-cream-magazine-global-customize.php';

			// Load Dynamic Styles.
			require get_template_directory() . '/inc/customizer/functions/dynamic-css.php';

			if ( class_exists( 'WooCommerce' ) ) {
				// Load WooCommerce Settings.
				require get_template_directory() . '/inc/customizer/options/class-cream-magazine-woocommerce-customize.php';
			}
		}

		/**
		 * Sets up the customizer partials.
		 *
		 * @since  1.0.0
		 *
		 * @param object $wp_customize WP Customize Manager instance.
		 */
		public function add_partials( $wp_customize ) {

			if ( isset( $wp_customize->selective_refresh ) ) {

				$wp_customize->selective_refresh->add_partial(
					'blogname',
					array(
						'selector'        => '.site-title a',
						'render_callback' => array( $this, 'customize_partial_blogname' ),
					)
				);

				$wp_customize->selective_refresh->add_partial(
					'blogdescription',
					array(
						'selector'        => '.site-description',
						'render_callback' => array( $this, 'customize_partial_blogdescription' ),
					)
				);
			}
		}

		/**
		 * Render the site title for the selective refresh partial.
		 *
		 * @return void
		 */
		public function customize_partial_blogname() {

			bloginfo( 'name' );
		}

		/**
		 * Render the site tagline for the selective refresh partial.
		 *
		 * @return void
		 */
		public function customize_partial_blogdescription() {

			bloginfo( 'description' );
		}

		/**
		 * Loads theme customizer JavaScript.
		 *
		 * @since  1.0.0
		 *
		 * @return void
		 */
		public function customize_preview_js() {

			wp_enqueue_script(
				'cream-magazine-customizer',
				get_template_directory_uri() . '/admin/js/customizer.js',
				array( 'customize-preview', 'customize-selective-refresh', 'jquery' ),
				CREAM_MAGAZINE_VERSION,
				true
			);
		}

		/**
		 * Loads theme customizer CSS.
		 *
		 * @since  1.0.0
		 * @access public
		 * @return void
		 */
		public function customizer_scripts() {

			wp_enqueue_style(
				'cream-magazine-upgrade',
				get_template_directory_uri() . '/inc/customizer/upgrade-to-pro/upgrade.css',
				null,
				CREAM_MAGAZINE_VERSION,
				'all'
			);

			wp_enqueue_style(
				'cream-magazine-customizer-style',
				get_template_directory_uri() . '/admin/css/customizer-style.css',
				null,
				CREAM_MAGAZINE_VERSION,
				'all'
			);

			wp_enqueue_script(
				'cream-magazine-upgrade',
				get_template_directory_uri() . '/inc/customizer/upgrade-to-pro/upgrade.js',
				array( 'jquery' ),
				CREAM_MAGAZINE_VERSION,
				true
			);

			wp_enqueue_script(
				'cream-magazine-customizer-dependency',
				get_template_directory_uri() . '/admin/js/customizer-dependency.js',
				array( 'jquery' ),
				CREAM_MAGAZINE_VERSION,
				true
			);

			wp_enqueue_script(
				'cream-magazine-customizer-script',
				get_template_directory_uri() . '/admin/js/customizer-script.js',
				array( 'jquery' ),
				CREAM_MAGAZINE_VERSION,
				true
			);
		}
	}
}
