<?php
/**
 * Helper functions for this theme.
 *
 * @package Cream_Magazine
 */

if ( ! function_exists( 'cream_magazine_get_option' ) ) {
	/**
	 * Get theme setting value.
	 *
	 * @since 1.0.0
	 *
	 * @param string $key Setting key.
	 * @return mixed $value Setting value.
	 */
	function cream_magazine_get_option( $key ) {

		if ( empty( $key ) ) {
			return;
		}

		$value = '';

		$default = cream_magazine_get_default_theme_options();

		$default_value = null;

		if ( is_array( $default ) && isset( $default[ $key ] ) ) {
			$default_value = $default[ $key ];
		}

		if ( null !== $default_value ) {
			$value = get_theme_mod( $key, $default_value );
		} else {
			$value = get_theme_mod( $key );
		}

		return $value;
	}
}


if ( ! function_exists( 'cream_magazine_get_default_theme_options' ) ) {
	/**
	 * Get default theme options.
	 *
	 * @since 1.0.0
	 *
	 * @return array Default theme options.
	 */
	function cream_magazine_get_default_theme_options() {

		$defaults = array(
			'cream_magazine_enable_home_content'           => false,
			'cream_magazine_select_site_layout'            => 'fullwidth',
			'cream_magazine_enable_ticker_news'            => false,
			'cream_magazine_show_ticker_news'              => 'choice_1',
			'cream_magazine_ticker_news_title'             => esc_html__( 'Breaking News', 'cream-magazine' ),
			'cream_magazine_ticker_news_posts_no'          => 5,
			'cream_magazine_enable_banner'                 => false,
			'cream_magazine_banner_posts_no'               => 3,
			'cream_magazine_enable_banner_categories_meta' => true,
			'cream_magazine_enable_banner_author_meta'     => true,
			'cream_magazine_enable_banner_date_meta'       => true,
			'cream_magazine_enable_banner_cmnts_no_meta'   => true,
			'cream_magazine_homepage_sidebar'              => 'right',
			'cream_magazine_enable_top_header'             => false,
			'cream_magazine_enable_sticky_menu_section'    => false,
			'cream_magazine_enable_home_button'            => false,
			'cream_magazine_enable_search_button'          => false,
			'cream_magazine_enable_menu_description'       => false,
			'cream_magazine_select_header_layout'          => 'header_1',
			'cream_magazine_header_overlay_color'          => 'rgba(0,0,0,0.2)',
			'cream_magazine_enable_scroll_top_button'      => true,
			'cream_magazine_show_footer_widget_area'       => true,
			'cream_magazine_show_footer_widget_area_on_mobile_n_tablet' => true,
			'cream_magazine_copyright_credit'              => '',
			'cream_magazine_enable_blog_categories_meta'   => true,
			'cream_magazine_enable_blog_author_meta'       => true,
			'cream_magazine_enable_blog_date_meta'         => true,
			'cream_magazine_enable_blog_cmnts_no_meta'     => true,
			'cream_magazine_show_blog_post_excerpt'        => false,
			'cream_magazine_select_blog_sidebar_position'  => 'right',
			'cream_magazine_enable_archive_categories_meta' => true,
			'cream_magazine_enable_archive_author_meta'    => true,
			'cream_magazine_enable_archive_date_meta'      => true,
			'cream_magazine_enable_archive_cmnts_no_meta'  => true,
			'cream_magazine_show_archive_post_excerpt'     => false,
			'cream_magazine_select_archive_sidebar_position' => 'right',
			'cream_magazine_enable_search_categories_meta' => true,
			'cream_magazine_enable_search_author_meta'     => true,
			'cream_magazine_enable_search_date_meta'       => true,
			'cream_magazine_enable_search_cmnts_no_meta'   => true,
			'cream_magazine_show_search_post_excerpt'      => false,
			'cream_magazine_show_pages_on_search_results'  => true,
			'cream_magazine_select_search_sidebar_position' => 'right',
			'cream_magazine_hide_pages_on_search_results'  => false,
			'cream_magazine_enable_post_single_tags_meta'  => true,
			'cream_magazine_enable_post_single_author_meta' => true,
			'cream_magazine_enable_post_single_date_meta'  => true,
			'cream_magazine_enable_post_single_categories_meta' => true,
			'cream_magazine_enable_post_single_featured_image' => true,
			'cream_magazine_enable_post_single_featured_image_caption' => false,
			'cream_magazine_enable_post_single_cmnts_no_meta' => true,
			'cream_magazine_enable_author_section'         => true,
			'cream_magazine_enable_related_section'        => true,
			'cream_magazine_related_section_title'         => '',
			'cream_magazine_related_section_posts_number'  => 6,
			'cream_magazine_enable_related_section_categories_meta' => true,
			'cream_magazine_enable_related_section_author_meta' => true,
			'cream_magazine_enable_related_section_date_meta' => true,
			'cream_magazine_enable_related_section_cmnts_no_meta' => true,
			'cream_magazine_enable_post_common_sidebar_position' => false,
			'cream_magazine_select_post_common_sidebar_position' => 'right',
			'cream_magazine_enable_page_single_featured_image' => true,
			'cream_magazine_enable_page_single_featured_image_caption' => false,
			'cream_magazine_enable_page_common_sidebar_position' => false,
			'cream_magazine_select_page_common_sidebar_position' => 'right',
			'cream_magazine_enable_category_meta'          => true,
			'cream_magazine_enable_date_meta'              => true,
			'cream_magazine_enable_author_meta'            => true,
			'cream_magazine_enable_tag_meta'               => true,
			'cream_magazine_enable_comment_meta'           => true,
			'cream_magazine_post_excerpt_length'           => 15,
			'cream_magazine_facebook_link'                 => '',
			'cream_magazine_twitter_link'                  => '',
			'cream_magazine_instagram_link'                => '',
			'cream_magazine_youtube_link'                  => '',
			'cream_magazine_vk_link'                       => '',
			'cream_magazine_linkedin_link'                 => '',
			'cream_magazine_vimeo_link'                    => '',
			'cream_magazine_show_social_links_in_new_tab'  => true,
			'cream_magazine_enable_breadcrumb'             => true,
			'cream_magazine_breadcrumb_sources'            => 'default',
			'cream_magazine_enable_sticky_sidebar'         => true,
			'cream_magazine_show_sidebar_on_mobile_n_tablet' => true,
			'cream_magazine_show_sidebar_after_contents_on_mobile_n_tablet' => false,
			'cream_magazine_primary_theme_color'           => '#FF3D00',
			'cream_magazine_enable_common_cat_color'       => true,
			'cream_magazine_common_cat_bg_color'           => '#FF3D00',
			'cream_magazine_cat_bg_color_1'                => '#FF3D00',
			'cream_magazine_cat_bg_color_2'                => '#FF3D00',
			'cream_magazine_cat_bg_color_3'                => '#FF3D00',
			'cream_magazine_cat_bg_color_4'                => '#FF3D00',
			'cream_magazine_cat_bg_color_5'                => '#FF3D00',
			'cream_magazine_cat_bg_color_6'                => '#FF3D00',
			'cream_magazine_cat_bg_color_7'                => '#FF3D00',
			'cream_magazine_cat_bg_color_8'                => '#FF3D00',
			'cream_magazine_cat_bg_color_9'                => '#FF3D00',
			'cream_magazine_common_cat_txt_color'          => '#fff',
			'cream_magazine_cat_hover_bg_color'            => '#010101',
			'cream_magazine_cat_hover_txt_color'           => '#fff',
			'cream_magazine_content_link_color'            => '#FF3D00',
			'cream_magazine_content_link_hover_color'      => '#010101',
			'cream_magazine_save_value_as'                 => 'slug',
			'cream_magazine_display_top_widget_area'       => true,
			'cream_magazine_display_middle_widget_area'    => true,
			'cream_magazine_display_bottom_widget_area'    => true,
			'cream_magazine_tagline_color'                 => '#000000',
			'cream_magazine_disable_link_focus_outline'    => false,
			'cream_magazine_disable_link_decoration_on_hover' => true,
			'cream_magazine_body_font'                     => wp_json_encode(
				array(
					'source'        => 'websafe',
					'font_family'   => 'Arial, sans-serif',
					'font_variants' => '',
					'font_url'      => '',
					'font_weight'   => 'inherit',
				)
			),
			'cream_magazine_headings_font'                 => wp_json_encode(
				array(
					'source'        => 'websafe',
					'font_family'   => 'Arial, sans-serif',
					'font_variants' => '',
					'font_url'      => '',
					'font_weight'   => 'inherit',
				)
			),
		);

		if ( class_exists( 'WooCommerce' ) ) {

			$defaults['cream_magazine_select_woocommerce_sidebar_position'] = 'right';
		}

		return $defaults;
	}
}


if ( ! function_exists( 'cream_magazine_sidebar_position' ) ) {
	/**
	 * Return position of sidebar.
	 *
	 * @since 1.0.0
	 *
	 * @return string
	 */
	function cream_magazine_sidebar_position() {

		$sidebar_position = '';

		if ( class_exists( 'WooCommerce' ) ) {

			if (
				is_woocommerce() ||
				is_cart() ||
				is_account_page() ||
				is_checkout()
			) {

				$sidebar_position = cream_magazine_get_option( 'cream_magazine_select_woocommerce_sidebar_position' );
			} else {

				if ( is_home() ) {
					$sidebar_position = cream_magazine_get_option( 'cream_magazine_select_blog_sidebar_position' );
				}

				if ( is_archive() ) {
					$sidebar_position = cream_magazine_get_option( 'cream_magazine_select_archive_sidebar_position' );
				}

				if ( is_search() ) {
					$sidebar_position = cream_magazine_get_option( 'cream_magazine_select_search_sidebar_position' );
				}

				if ( is_single() ) {

					$common_post_sidebar = cream_magazine_get_option( 'cream_magazine_enable_post_common_sidebar_position' );

					if ( true === $common_post_sidebar ) {
						$sidebar_position = cream_magazine_get_option( 'cream_magazine_select_post_common_sidebar_position' );
					} else {

						$sidebar_position = get_post_meta( get_the_ID(), 'cream_magazine_sidebar_position', true );
					}
				}

				if ( is_page() ) {

					$common_post_sidebar = cream_magazine_get_option( 'cream_magazine_enable_page_common_sidebar_position' );

					if ( true === $common_post_sidebar ) {
						$sidebar_position = cream_magazine_get_option( 'cream_magazine_select_page_common_sidebar_position' );
					} else {

						$sidebar_position = get_post_meta( get_the_ID(), 'cream_magazine_sidebar_position', true );
					}
				}
			}
		} else {
			if ( is_home() ) {
				$sidebar_position = cream_magazine_get_option( 'cream_magazine_select_blog_sidebar_position' );
			}

			if ( is_archive() ) {
				$sidebar_position = cream_magazine_get_option( 'cream_magazine_select_archive_sidebar_position' );
			}

			if ( is_search() ) {
				$sidebar_position = cream_magazine_get_option( 'cream_magazine_select_search_sidebar_position' );
			}

			if ( is_single() ) {

				$common_post_sidebar = cream_magazine_get_option( 'cream_magazine_enable_post_common_sidebar_position' );

				if ( true === $common_post_sidebar ) {
					$sidebar_position = cream_magazine_get_option( 'cream_magazine_select_post_common_sidebar_position' );
				} else {

					$sidebar_position = get_post_meta( get_the_ID(), 'cream_magazine_sidebar_position', true );
				}
			}

			if ( is_page() ) {

				$common_post_sidebar = cream_magazine_get_option( 'cream_magazine_enable_page_common_sidebar_position' );

				if ( true === $common_post_sidebar ) {
					$sidebar_position = cream_magazine_get_option( 'cream_magazine_select_page_common_sidebar_position' );
				} else {

					$sidebar_position = get_post_meta( get_the_ID(), 'cream_magazine_sidebar_position', true );
				}
			}
		}

		if ( empty( $sidebar_position ) ) {
			$sidebar_position = 'right';
		}

		return $sidebar_position;
	}
}


if ( ! function_exists( 'cream_magazine_check_sticky_sidebar' ) ) {
	/**
	 * Checks if sidebar is set sticky.
	 *
	 * @since 1.0.0
	 *
	 * @return boolean.
	 */
	function cream_magazine_check_sticky_sidebar() {

		return cream_magazine_get_option( 'cream_magazine_enable_sticky_sidebar' );
	}
}



if ( ! function_exists( 'cream_magazine_woocommerce_sidebar' ) ) {
	/**
	 * Return position of WooCommerce sidebar.
	 *
	 * @since 1.0.0
	 *
	 * @return string
	 */
	function cream_magazine_woocommerce_sidebar() {

		$sidebar_position = cream_magazine_get_option( 'cream_magazine_select_woocommerce_sidebar_position' );

		if (
			! is_active_sidebar( 'woocommerce-sidebar' ) ||
			'none' === $sidebar_position
		) {

			return;
		}

		$sidebar_class = 'cm-col-lg-4 cm-col-12';

		$is_sticky = cream_magazine_check_sticky_sidebar();

		$show_sidebar_on_mobile_n_tablet = cream_magazine_get_option( 'cream_magazine_show_sidebar_on_mobile_n_tablet' );

		$sidebar_after_content = cream_magazine_get_option( 'cream_magazine_show_sidebar_after_contents_on_mobile_n_tablet' );

		if ( 'left' === $sidebar_position ) {

			$sidebar_class .= ' order-1';
		}

		if ( true === $is_sticky ) {

			$sidebar_class .= ' sticky_portion';
		}

		if ( ! $show_sidebar_on_mobile_n_tablet ) {

			$sidebar_class .= ' hide-tablet hide-mobile';
		}

		if ( $sidebar_after_content ) {

			$sidebar_class .= ' cm-order-2-mobile-tablet';
		}
		?>
		<div class="<?php echo esc_attr( $sidebar_class ); ?>">
			<aside id="secondary" class="sidebar-widget-area">
				<?php dynamic_sidebar( 'woocommerce-sidebar' ); ?>
			</aside><!-- #secondary -->
		</div><!-- .col.sticky_portion -->
		<?php
	}
}


if ( ! function_exists( 'cream_magazine_thumbnail_class' ) ) {
	/**
	 * Print CSS class for post thumbnail wrapper.
	 *
	 * @since 1.0.0
	 */
	function cream_magazine_thumbnail_class() {

		echo 'post_thumb';
	}
}


if ( ! function_exists( 'cream_magazine_front_page_middle_area_class' ) ) {
	/**
	 * Set CSS class for front page middle area.
	 *
	 * @since 1.0.0
	 */
	function cream_magazine_front_page_middle_area_class() {

		$container_class = '';

		$sidebar_position = cream_magazine_get_option( 'cream_magazine_homepage_sidebar' );

		$is_sticky = cream_magazine_check_sticky_sidebar();

		if (
			'none' !== $sidebar_position &&
			is_active_sidebar( 'sidebar' )
		) {

			$container_class = ( $is_sticky ) ? 'cm-col-lg-8 cm-col-12 sticky_portion' : 'cm-col-lg-8 cm-col-12';

			if ( 'left' === $sidebar_position ) {
				$container_class .= ' order-2';
			}
		} else {

			$container_class = 'cm-col-lg-12 cm-col-12';
		}

		return $container_class;
	}
}



if ( ! function_exists( 'cream_magazine_main_query_filter' ) ) {
	/**
	 * Removes pages from search results.
	 *
	 * @since 1.0.0
	 *
	 * @param object $query WP Query instance.
	 * @return object
	 */
	function cream_magazine_main_query_filter( $query ) {

		if ( is_admin() ) {

			return $query;
		}

		if (
			$query->is_search &&
			true === cream_magazine_get_option( 'cream_magazine_hide_pages_on_search_results' )
		) {
			$query->set( 'post_type', 'post' );
		}

		return $query;
	}

	add_action( 'pre_get_posts', 'cream_magazine_main_query_filter' );
}



if ( ! function_exists( 'cream_magazine_get_post_taxonomy_select_choices' ) ) {
	/**
	 * Gets all terms associated to given taxonomy, and returns array of taxonomy id/slug and name pairs.
	 *
	 * @since 2.1.2
	 *
	 * @param string $taxonomy Post taxonomy.
	 * @param string $key Slug or ID.
	 */
	function cream_magazine_get_post_taxonomy_select_choices( $taxonomy, $key = 'slug' ) {

		$select_choices = array();
		$taxonomy_terms = get_terms( $taxonomy );

		if ( 'slug' === $key ) {
			$select_choices['none'] = esc_html__( 'Select Category', 'cream-magazine' );
		} else {
			$select_choices[0] = esc_html__( 'Select Category', 'cream-magazine' );
		}

		if ( $taxonomy_terms ) {

			foreach ( $taxonomy_terms as $taxonomy_term ) {

				if ( 'id' === $key ) {

					$select_choices[ $taxonomy_term->term_id ] = $taxonomy_term->name;
				} else {
					$select_choices[ $taxonomy_term->slug ] = $taxonomy_term->name;
				}
			}
		}

		return $select_choices;
	}
}


if ( ! function_exists( 'cream_magazine_recursive_parse_args' ) ) {
	/**
	 * Recursively merge two arrays.
	 *
	 * @since 2.1.3
	 *
	 * @param array $args Target array.
	 * @param array $defaults Default array.
	 */
	function cream_magazine_recursive_parse_args( $args, $defaults ) {

		$new_args = (array) $defaults;

		foreach ( $args as $key => $value ) {

			if ( is_array( $value ) && isset( $new_args[ $key ] ) ) {

				$new_args[ $key ] = cream_magazine_recursive_parse_args( $value, $new_args[ $key ] );
			} else {

				$new_args[ $key ] = $value;
			}
		}

		return $new_args;
	}
}
