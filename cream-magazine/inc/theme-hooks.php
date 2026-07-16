<?php
/**
 * Definition of theme's custom hook actions.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Cream_Magazine
 */

if ( ! function_exists( 'cream_magazine_doctype_action' ) ) {
	/**
	 * Doctype declaration of the theme.
	 *
	 * @since 1.0.0
	 */
	function cream_magazine_doctype_action() {
		?>
		<!doctype html>
		<html <?php language_attributes(); ?>>
		<?php
	}
}
add_action( 'cream_magazine_doctype', 'cream_magazine_doctype_action', 10 );



if ( ! function_exists( 'cream_magazine_head_action' ) ) {
	/**
	 * Head declaration of the theme.
	 *
	 * @since 1.0.0
	 */
	function cream_magazine_head_action() {
		?>
		<head>
			<meta charset="<?php bloginfo( 'charset' ); ?>">
			<meta name="viewport" content="width=device-width, initial-scale=1">
			<link rel="profile" href="http://gmpg.org/xfn/11">
			<?php wp_head(); ?>
		</head>
		<?php
	}
}
add_action( 'cream_magazine_head', 'cream_magazine_head_action', 10 );



if ( ! function_exists( 'cream_magazine_body_before_action' ) ) {
	/**
	 * Body Before declaration of the theme.
	 *
	 * @since 1.0.0
	 */
	function cream_magazine_body_before_action() {
		?>
		<body <?php body_class(); ?>>
			<?php
			if ( function_exists( 'wp_body_open' ) ) {
				wp_body_open();
			}
			?>
			<a class="skip-link screen-reader-text" href="#content"><?php esc_html_e( 'Skip to content', 'cream-magazine' ); ?></a>
		<?php
	}
}
add_action( 'cream_magazine_body_before', 'cream_magazine_body_before_action', 10 );



if ( ! function_exists( 'cream_magazine_page_wrapper_start_action' ) ) {
	/**
	 * Page Wapper Start declaration of the theme.
	 *
	 * @since 1.0.0
	 */
	function cream_magazine_page_wrapper_start_action() {
		?>
		<div class="page-wrapper">
		<?php
	}
}
add_action( 'cream_magazine_page_wrapper_start', 'cream_magazine_page_wrapper_start_action', 10 );



if ( ! function_exists( 'cream_magazine_header_section_action' ) ) {
	/**
	 * Header layout selection declaration of the theme.
	 *
	 * @since 1.0.0
	 */
	function cream_magazine_header_section_action() {

		$header_layout = cream_magazine_get_option( 'cream_magazine_select_header_layout' );

		if ( 'header_1' === $header_layout ) {
			get_template_part( 'template-parts/header/header', 'one' );
		} else {
			get_template_part( 'template-parts/header/header', 'two' );
		}
	}
}
add_action( 'cream_magazine_header_section', 'cream_magazine_header_section_action', 10 );



if ( ! function_exists( 'cream_magazine_top_header_menu_action' ) ) {
	/**
	 * Header top menu declaration of the theme.
	 *
	 * @since 1.0.0
	 */
	function cream_magazine_top_header_menu_action() {

		if ( has_nav_menu( 'menu-2' ) ) {

			wp_nav_menu(
				array(
					'theme_location' => 'menu-2',
					'container'      => '',
					'depth'          => 1,
				)
			);
		}
	}
}
add_action( 'cream_magazine_top_header_menu', 'cream_magazine_top_header_menu_action', 10 );



if ( ! function_exists( 'cream_magazine_main_menu_action' ) ) {
	/**
	 * Main menu declaration of the theme.
	 *
	 * @since 1.0.0
	 */
	function cream_magazine_main_menu_action() {

		$menu_args = array(
			'theme_location' => 'menu-1',
			'container'      => '',
			'menu_class'     => '',
			'menu_id'        => '',
			'items_wrap'     => cream_magazine_main_menu_wrap(),
			'fallback_cb'    => 'cream_magazine_navigation_fallback',
		);
		wp_nav_menu( $menu_args );
	}
}
add_action( 'cream_magazine_main_menu', 'cream_magazine_main_menu_action', 10 );



if ( ! function_exists( 'cream_magazine_site_identity_action' ) ) {
	/**
	 * Site identity declaration of the theme.
	 *
	 * @since 1.0.0
	 */
	function cream_magazine_site_identity_action() {
		?>
		<div class="logo">
			<?php
			if ( has_custom_logo() ) {
				if (
					(
						is_front_page() &&
						(
							cream_magazine_get_option( 'cream_magazine_enable_home_content' ) === true ||
							is_page_template( 'template-home.php' )
						)
					) ||
					is_home()
				) {
					?>
					<h1 class="site-logo">
					<?php
				}

				the_custom_logo();

				if (
					(
						is_front_page() &&
						(
							cream_magazine_get_option( 'cream_magazine_enable_home_content' ) === true ||
							is_page_template( 'template-home.php' )
						)
					) ||
					is_home()
				) {
					?>
					</h1>
					<?php
				}
			} else {
				if (
					(
						is_front_page() &&
						(
							cream_magazine_get_option( 'cream_magazine_enable_home_content' ) === true ||
							is_page_template( 'template-home.php' )
						)
					) ||
					is_home()
				) {
					?>
					<h1 class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></h1>
					<?php
				} else {
					?>
					<span class="site-title"><a href="<?php echo esc_url( home_url( '/' ) ); ?>" rel="home"><?php bloginfo( 'name' ); ?></a></span>
					<?php
				}

				$site_description = get_bloginfo( 'description', 'display' );
				if ( $site_description || is_customize_preview() ) {
					?>
					<p class="site-description"><?php echo esc_html( $site_description ); // phpcs:ignore ?></p>
					<?php
				}
			}
			?>
		</div><!-- .logo -->
		<?php
	}
}
add_action( 'cream_magazine_site_identity', 'cream_magazine_site_identity_action', 10 );



if ( ! function_exists( 'cream_magazine_social_links_action' ) ) {
	/**
	 * Social links declaration of the theme.
	 *
	 * @since 1.0.0
	 */
	function cream_magazine_social_links_action() {

		$show_on_new_tab = cream_magazine_get_option( 'cream_magazine_show_social_links_in_new_tab' );
		?>
		<ul class="social-icons">
			<?php
			$facebook_link = cream_magazine_get_option( 'cream_magazine_facebook_link' );
			if ( ! empty( $facebook_link ) ) {
				?>
				<li>
					<a
						href="<?php echo esc_url( $facebook_link ); ?>"
						<?php
						if ( $show_on_new_tab ) {
							?>
							target="_blank"
							<?php
						}
						?>
					><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M512 256C512 114.6 397.4 0 256 0S0 114.6 0 256C0 376 82.7 476.8 194.2 504.5V334.2H141.4V256h52.8V222.3c0-87.1 39.4-127.5 125-127.5c16.2 0 44.2 3.2 55.7 6.4V172c-6-.6-16.5-1-29.6-1c-42 0-58.2 15.9-58.2 57.2V256h83.6l-14.4 78.2H287V510.1C413.8 494.8 512 386.9 512 256h0z"/></svg><?php echo esc_html__( 'Facebook', 'cream-magazine' ); ?></a></li>
				<?php
			}

			$twitter_link = cream_magazine_get_option( 'cream_magazine_twitter_link' );
			if ( ! empty( $twitter_link ) ) {
				?>
				<li>
					<a
						href="<?php echo esc_url( $twitter_link ); ?>"
						<?php
						if ( $show_on_new_tab ) {
							?>
							target="_blank"
							<?php
						}
						?>
					><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z"/></svg><?php echo esc_html__( 'Twitter', 'cream-magazine' ); ?></a></li>
				<?php
			}

			$instagram_link = cream_magazine_get_option( 'cream_magazine_instagram_link' );
			if ( ! empty( $instagram_link ) ) {
				?>
				<li>
					<a
						href="<?php echo esc_url( $instagram_link ); ?>"
						<?php
						if ( $show_on_new_tab ) {
							?>
							target="_blank"
							<?php
						}
						?>
					><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"/></svg><?php echo esc_html__( 'Instagram', 'cream-magazine' ); ?></a></li>
				<?php
			}

			$youtube_link = cream_magazine_get_option( 'cream_magazine_youtube_link' );
			if ( ! empty( $youtube_link ) ) {
				?>
				<li>
					<a
						href="<?php echo esc_url( $youtube_link ); ?>"
						<?php
						if ( $show_on_new_tab ) {
							?>
							target="_blank"
							<?php
						}
						?>
					><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M549.7 124.1c-6.3-23.7-24.8-42.3-48.3-48.6C458.8 64 288 64 288 64S117.2 64 74.6 75.5c-23.5 6.3-42 24.9-48.3 48.6-11.4 42.9-11.4 132.3-11.4 132.3s0 89.4 11.4 132.3c6.3 23.7 24.8 41.5 48.3 47.8C117.2 448 288 448 288 448s170.8 0 213.4-11.5c23.5-6.3 42-24.2 48.3-47.8 11.4-42.9 11.4-132.3 11.4-132.3s0-89.4-11.4-132.3zm-317.5 213.5V175.2l142.7 81.2-142.7 81.2z"/></svg><?php echo esc_html__( 'YouTube', 'cream-magazine' ); ?></a></li>
				<?php
			}

			$vk_link = cream_magazine_get_option( 'cream_magazine_vk_link' );
			if ( ! empty( $vk_link ) ) {
				?>
				<li>
					<a
						href="<?php echo esc_url( $vk_link ); ?>"
						<?php
						if ( $show_on_new_tab ) {
							?>
							target="_blank"
							<?php
						}
						?>
					><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M31.5 63.5C0 95 0 145.7 0 247V265C0 366.3 0 417 31.5 448.5C63 480 113.7 480 215 480H233C334.3 480 385 480 416.5 448.5C448 417 448 366.3 448 265V247C448 145.7 448 95 416.5 63.5C385 32 334.3 32 233 32H215C113.7 32 63 32 31.5 63.5zM75.6 168.3H126.7C128.4 253.8 166.1 290 196 297.4V168.3H244.2V242C273.7 238.8 304.6 205.2 315.1 168.3H363.3C359.3 187.4 351.5 205.6 340.2 221.6C328.9 237.6 314.5 251.1 297.7 261.2C316.4 270.5 332.9 283.6 346.1 299.8C359.4 315.9 369 334.6 374.5 354.7H321.4C316.6 337.3 306.6 321.6 292.9 309.8C279.1 297.9 262.2 290.4 244.2 288.1V354.7H238.4C136.3 354.7 78 284.7 75.6 168.3z"/></svg><?php echo esc_html__( 'VK', 'cream-magazine' ); ?></a></li>
				<?php
			}

			$linkedin_link = cream_magazine_get_option( 'cream_magazine_linkedin_link' );
			if ( ! empty( $linkedin_link ) ) {
				?>
				<li>
					<a
						href="<?php echo esc_url( $linkedin_link ); ?>"
						<?php
						if ( $show_on_new_tab ) {
							?>
							target="_blank"
							<?php
						}
						?>
					><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M100.3 448H7.4V148.9h92.9zM53.8 108.1C24.1 108.1 0 83.5 0 53.8a53.8 53.8 0 0 1 107.6 0c0 29.7-24.1 54.3-53.8 54.3zM447.9 448h-92.7V302.4c0-34.7-.7-79.2-48.3-79.2-48.3 0-55.7 37.7-55.7 76.7V448h-92.8V148.9h89.1v40.8h1.3c12.4-23.5 42.7-48.3 87.9-48.3 94 0 111.3 61.9 111.3 142.3V448z"/></svg><?php echo esc_html__( 'LinkedIn', 'cream-magazine' ); ?></a></li>
				<?php
			}

			$vimeo_link = cream_magazine_get_option( 'cream_magazine_vimeo_link' );
			if ( ! empty( $vimeo_link ) ) {
				?>
				<li>
					<a
						href="<?php echo esc_url( $vimeo_link ); ?>"
						<?php
						if ( $show_on_new_tab ) {
							?>
							target="_blank"
							<?php
						}
						?>
					><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M447.8 153.6c-2 43.6-32.4 103.3-91.4 179.1-60.9 79.2-112.4 118.8-154.6 118.8-26.1 0-48.2-24.1-66.3-72.3C100.3 250 85.3 174.3 56.2 174.3c-3.4 0-15.1 7.1-35.2 21.1L0 168.2c51.6-45.3 100.9-95.7 131.8-98.5 34.9-3.4 56.3 20.5 64.4 71.5 28.7 181.5 41.4 208.9 93.6 126.7 18.7-29.6 28.8-52.1 30.2-67.6 4.8-45.9-35.8-42.8-63.3-31 22-72.1 64.1-107.1 126.2-105.1 45.8 1.2 67.5 31.1 64.9 89.4z"/></svg><?php echo esc_html__( 'Vimeo', 'cream-magazine' ); ?></a></li>
				<?php
			}
			?>
		</ul>
		<?php
	}
}
add_action( 'cream_magazine_social_links', 'cream_magazine_social_links_action', 10 );


if ( ! function_exists( 'cream_magazine_ticker_news_action' ) ) {
	/**
	 * Ticker news declaration of the theme.
	 *
	 * @since 1.0.0
	 */
	function cream_magazine_ticker_news_action() {

		$news_ticker_section_title = cream_magazine_get_option( 'cream_magazine_ticker_news_title' );
		$news_ticker_post_cats     = cream_magazine_get_option( 'cream_magazine_ticker_news_categories' );
		$news_ticker_post_nos      = cream_magazine_get_option( 'cream_magazine_ticker_news_posts_no' );

		$news_ticker_args = array(
			'post_type'           => 'post',
			'ignore_sticky_posts' => true,
		);

		if ( ! empty( $news_ticker_post_cats ) ) {

			if ( cream_magazine_get_option( 'cream_magazine_save_value_as' ) === 'slug' ) {

				$news_ticker_args['category_name'] = implode( ',', $news_ticker_post_cats );
			} else {

				$news_ticker_args['cat'] = implode( ',', $news_ticker_post_cats );
			}
		}

		if ( absint( $news_ticker_post_nos ) > 0 ) {
			$news_ticker_args['posts_per_page'] = absint( $news_ticker_post_nos );
		} else {
			$news_ticker_args['posts_per_page'] = 6;
		}

		$news_ticker_query = new WP_Query( $news_ticker_args );

		if ( $news_ticker_query->have_posts() ) {
			?>
			<div class="news_ticker_wrap clearfix">
				<?php if ( ! empty( $news_ticker_section_title ) ) { ?>
					<div class="ticker_head">
						<span class="ticker_icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512" height="14" width="14"><path d="M349.4 44.6c5.9-13.7 1.5-29.7-10.6-38.5s-28.6-8-39.9 1.8l-256 224c-10 8.8-13.6 22.9-8.9 35.3S50.7 288 64 288l111.5 0L98.6 467.4c-5.9 13.7-1.5 29.7 10.6 38.5s28.6 8 39.9-1.8l256-224c10-8.8 13.6-22.9 8.9-35.3s-16.6-20.7-30-20.7l-111.5 0L349.4 44.6z"/></svg></span>
						<div class="ticker_title"><?php echo esc_html( $news_ticker_section_title ); ?></div>
					</div><!-- .ticker_head -->
				<?php } ?>
				<div class="ticker_items">
					<div class="owl-carousel ticker_carousel">
						<?php
						while ( $news_ticker_query->have_posts() ) {
							$news_ticker_query->the_post();
							?>
							<div class="item">
								<p><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></p>
							</div><!-- .item -->
							<?php
						}
						wp_reset_postdata();
						?>
					</div><!-- .owl-carousel -->
				</div><!-- .ticker_items -->
			</div><!-- .news_ticker_wrap.clearfix -->
			<?php
		}
	}
}
add_action( 'cream_magazine_ticker_news', 'cream_magazine_ticker_news_action', 10 );


if ( ! function_exists( 'cream_magazine_breadcrumb_action' ) ) {
	/**
	 * Breadcrumb declaration of the theme.
	 *
	 * @since 1.0.0
	 */
	function cream_magazine_breadcrumb_action() {

		if ( is_front_page() ) {
			return;
		}

		$enable_breadcrumb = cream_magazine_get_option( 'cream_magazine_enable_breadcrumb' );

		$breadcrumb_class = '';

		if ( true === $enable_breadcrumb ) {

			$breadcrumb_source = cream_magazine_get_option( 'cream_magazine_breadcrumb_sources' );

			switch ( $breadcrumb_source ) {
				case 'yoast':
					$breadcrumb_class .= ' yoast-breadcrumb';
					break;
				case 'rank_math':
					$breadcrumb_class .= ' rank_math-breadcrumb';
					break;
				case 'bcn':
					$breadcrumb_class .= ' navxt-breadcrumb';
					break;
				default:
					$breadcrumb_class .= ' default-breadcrumb';
			}
			?>
			<div class="breadcrumb <?php echo ( $breadcrumb_class ) ? esc_attr( $breadcrumb_class ) : ''; ?>">
				<?php
				switch ( $breadcrumb_source ) {
					case 'yoast':
						yoast_breadcrumb();
						break;
					case 'rank_math':
						rank_math_the_breadcrumbs();
						break;
					case 'bcn':
						bcn_display();
						break;
					default:
						$breadcrumb_args = array(
							'show_browse' => false,
						);
						cream_magazine_breadcrumb_trail( $breadcrumb_args );
				}
				?>
			</div>
			<?php
		}
	}
}
add_action( 'cream_magazine_breadcrumb', 'cream_magazine_breadcrumb_action', 10 );


if ( ! function_exists( 'cream_magazine_pagination_action' ) ) {
	/**
	 * Pagination declaration of the theme.
	 *
	 * @since 1.0.0
	 */
	function cream_magazine_pagination_action() {

		global $wp_query;

		if ( 1 !== $wp_query->max_num_pages ) {
			?>
			<div class="pagination">
				<?php
				the_posts_pagination(
					array(
						'mid_size'  => 2,
						'prev_text' => esc_html__( 'Prev', 'cream-magazine' ),
						'next_text' => esc_html__( 'Next', 'cream-magazine' ),
					)
				);
				?>
			</div>
			<?php
		}
	}
}
add_action( 'cream_magazine_pagination', 'cream_magazine_pagination_action', 10 );


if ( ! function_exists( 'cream_magazine_banner_slider_action' ) ) {
	/**
	 * Banner/Slider layout selection declaration of the theme.
	 *
	 * @since 1.0.0
	 */
	function cream_magazine_banner_slider_action() {

		get_template_part( 'template-parts/banner/banner', 'five' );
	}
}
add_action( 'cream_magazine_banner_slider', 'cream_magazine_banner_slider_action', 10 );



if ( ! function_exists( 'cream_magazine_top_news_action' ) ) {
	/**
	 * Top news section contents declaration of the theme.
	 *
	 * @since 1.0.0
	 */
	function cream_magazine_top_news_action() {

		if ( is_active_sidebar( 'home-top-news-area' ) ) {

			dynamic_sidebar( 'home-top-news-area' );
		}
	}
}
add_action( 'cream_magazine_top_news', 'cream_magazine_top_news_action', 10 );



if ( ! function_exists( 'cream_magazine_middle_news_action' ) ) {
	/**
	 * Middle news section contents declaration of the theme.
	 *
	 * @since 1.0.0
	 */
	function cream_magazine_middle_news_action() {

		if ( is_active_sidebar( 'home-middle-news-area' ) ) {

			dynamic_sidebar( 'home-middle-news-area' );
		}
	}
}
add_action( 'cream_magazine_middle_news', 'cream_magazine_middle_news_action', 10 );



if ( ! function_exists( 'cream_magazine_bottom_news_action' ) ) {
	/**
	 * Bottom news section contents declaration of the theme.
	 *
	 * @since 1.0.0
	 */
	function cream_magazine_bottom_news_action() {

		if ( is_active_sidebar( 'home-bottom-news-area' ) ) {

			dynamic_sidebar( 'home-bottom-news-area' );
		}
	}
}
add_action( 'cream_magazine_bottom_news', 'cream_magazine_bottom_news_action', 10 );



if ( ! function_exists( 'cream_magazine_page_wrapper_end_action' ) ) {
	/**
	 * Page Wapper End declaration of the theme.
	 *
	 * @since 1.0.0
	 */
	function cream_magazine_page_wrapper_end_action() {
		?>
		</div><!-- .page_wrap -->
		<?php
	}
}
add_action( 'cream_magazine_page_wrapper_end', 'cream_magazine_page_wrapper_end_action', 10 );



if ( ! function_exists( 'cream_magazine_footer_wrapper_start_action' ) ) {
	/**
	 * Footer Wapper Start declaration of the theme.
	 *
	 * @since 1.0.0
	 */
	function cream_magazine_footer_wrapper_start_action() {

		$footer_inner_class = 'footer_inner';

		if ( cream_magazine_get_option( 'cream_magazine_show_footer_widget_area' ) === false ) {

			$footer_inner_class .= ' no-footer-widget-areas';
		}
		?>
		<footer class="footer">
			<div class="<?php echo esc_attr( $footer_inner_class ); ?>">
				<div class="cm-container">
		<?php
	}
}
add_action( 'cream_magazine_footer_wrapper_start', 'cream_magazine_footer_wrapper_start_action', 10 );



if ( ! function_exists( 'cream_magazine_footer_widget_wrapper_start_action' ) ) {
	/**
	 * Footer Widget Wapper Start declaration of the theme.
	 *
	 * @since 1.0.0
	 */
	function cream_magazine_footer_widget_wrapper_start_action() {

		$footer_widget_area_class = 'row footer-widget-container';

		$show_on_mobile_n_tablet = cream_magazine_get_option( 'cream_magazine_show_footer_widget_area_on_mobile_n_tablet' );

		if ( ! $show_on_mobile_n_tablet ) {

			$footer_widget_area_class .= ' hide-tablet hide-mobile';
		}
		?>
		<div class="<?php echo esc_attr( $footer_widget_area_class ); ?>">
		<?php
	}
}
add_action( 'cream_magazine_footer_widget_wrapper_start', 'cream_magazine_footer_widget_wrapper_start_action', 10 );


if ( ! function_exists( 'cream_magazine_left_footer_widgetarea_action' ) ) {
	/**
	 * Left Footer Widgetarea declaration of the theme.
	 *
	 * @since 1.0.0
	 */
	function cream_magazine_left_footer_widgetarea_action() {
		?>
		<div class="cm-col-lg-4 cm-col-12">
			<div class="blocks">
				<?php
				if ( is_active_sidebar( 'footer-left' ) ) {

					dynamic_sidebar( 'footer-left' );
				}
				?>
			</div><!-- .blocks -->
		</div><!-- .cm-col-->
		<?php
	}
}
add_action( 'cream_magazine_left_footer_widgetarea', 'cream_magazine_left_footer_widgetarea_action', 10 );



if ( ! function_exists( 'cream_magazine_middle_footer_widgetarea_action' ) ) {
	/**
	 * Middle Footer Widgetarea declaration of the theme.
	 *
	 * @since 1.0.0
	 */
	function cream_magazine_middle_footer_widgetarea_action() {
		?>
		<div class="cm-col-lg-4 cm-col-12">
			<div class="blocks">
				<?php
				if ( is_active_sidebar( 'footer-middle' ) ) {

					dynamic_sidebar( 'footer-middle' );
				}
				?>
			</div><!-- .blocks -->
		</div><!-- .cm-col-->
		<?php
	}
}
add_action( 'cream_magazine_middle_footer_widgetarea', 'cream_magazine_middle_footer_widgetarea_action', 10 );



if ( ! function_exists( 'cream_magazine_right_footer_widgetarea_action' ) ) {
	/**
	 * Right Footer Widgetarea declaration of the theme.
	 *
	 * @since 1.0.0
	 */
	function cream_magazine_right_footer_widgetarea_action() {
		?>
		<div class="cm-col-lg-4 cm-col-12">
			<div class="blocks">
				<?php
				if ( is_active_sidebar( 'footer-right' ) ) {

					dynamic_sidebar( 'footer-right' );
				}
				?>
			</div><!-- .blocks -->
		</div><!-- .cm-col-->
		<?php
	}
}
add_action( 'cream_magazine_right_footer_widgetarea', 'cream_magazine_right_footer_widgetarea_action', 10 );


if ( ! function_exists( 'cream_magazine_footer_widget_wrapper_end_action' ) ) {
	/**
	 * Footer Widget Wapper End declaration of the theme.
	 *
	 * @since 1.0.0
	 */
	function cream_magazine_footer_widget_wrapper_end_action() {
		?>
		</div><!-- .row -->
		<?php
	}
}
add_action( 'cream_magazine_footer_widget_wrapper_end', 'cream_magazine_footer_widget_wrapper_end_action', 10 );


if ( ! function_exists( 'cream_magazine_footer_copyright_wrapper_start_action' ) ) {
	/**
	 * Footer Copyright Wapper Start declaration of the theme.
	 *
	 * @since 1.0.0
	 */
	function cream_magazine_footer_copyright_wrapper_start_action() {
		?>
		<div class="copyright_section">
		<div class="row">
		<?php
	}
}
add_action( 'cream_magazine_footer_copyright_wrapper_start', 'cream_magazine_footer_copyright_wrapper_start_action', 10 );



if ( ! function_exists( 'cream_magazine_copyright_action' ) ) {
	/**
	 * Copyright Declaration of the theme.
	 *
	 * @since 1.0.0
	 */
	function cream_magazine_copyright_action() {

		$copyright_text = cream_magazine_get_option( 'cream_magazine_copyright_credit' );
		?>
		<div class="cm-col-lg-7 cm-col-md-6 cm-col-12">
			<div class="copyrights">
				<p>
					<?php
					if ( ! empty( $copyright_text ) ) {
						if ( str_contains( $copyright_text, '{copy}' ) ) {
							$copy_right_symbol = '&copy;';
							$copyright_text    = str_replace( '{copy}', $copy_right_symbol, $copyright_text );
						}

						if ( str_contains( $copyright_text, '{year}' ) ) {
							$year           = gmdate( 'Y' );
							$copyright_text = str_replace( '{year}', $year, $copyright_text );
						}

						if ( str_contains( $copyright_text, '{site_title}' ) ) {
							$title          = get_bloginfo( 'name' );
							$copyright_text = str_replace( '{site_title}', $title, $copyright_text );
						}

						if ( str_contains( $copyright_text, '{theme_author}' ) ) {
							$theme_author   = '<a href="https://themebeez.com" rel="author" target="_blank">Themebeez</a>';
							$copyright_text = str_replace( '{theme_author}', $theme_author, $copyright_text );
						}

						echo wp_kses_post( $copyright_text );

					}
					?>
				</p>
			</div>
		</div><!-- .col -->
		<?php
	}
}
add_action( 'cream_magazine_copyright', 'cream_magazine_copyright_action', 10 );





if ( ! function_exists( 'cream_magazine_footer_menu_action' ) ) {
	/**
	 * Footer menu declaration of the theme.
	 *
	 * @since 1.0.0
	 */
	function cream_magazine_footer_menu_action() {
		?>
		<div class="cm-col-lg-5 cm-col-md-6 cm-col-12">
			<div class="footer_nav">
				<?php
				if ( has_nav_menu( 'menu-3' ) ) {
					wp_nav_menu(
						array(
							'theme_location' => 'menu-3',
							'container'      => '',
							'depth'          => 1,
						)
					);
				}
				?>
			</div><!-- .footer_nav -->
		</div><!-- .col -->
		<?php
	}
}
add_action( 'cream_magazine_footer_menu', 'cream_magazine_footer_menu_action', 10 );



if ( ! function_exists( 'cream_magazine_footer_copyright_wrapper_end_action' ) ) {
	/**
	 * Footer Copyright Wapper End declaration of the theme.
	 *
	 * @since 1.0.0
	 */
	function cream_magazine_footer_copyright_wrapper_end_action() {
		?>
		</div><!-- .row -->
		</div><!-- .copyright_section -->
		<?php
	}
}
add_action( 'cream_magazine_footer_copyright_wrapper_end', 'cream_magazine_footer_copyright_wrapper_end_action', 10 );


if ( ! function_exists( 'cream_magazine_footer_wrapper_end_action' ) ) {
	/**
	 * Footer Wapper End declaration of the theme.
	 *
	 * @since 1.0.0
	 */
	function cream_magazine_footer_wrapper_end_action() {
		?>
		</div><!-- .cm-container -->
		</div><!-- .footer_inner -->
		</footer><!-- .footer -->
		<?php
	}
}
add_action( 'cream_magazine_footer_wrapper_end', 'cream_magazine_footer_wrapper_end_action', 10 );



if ( ! function_exists( 'cream_magazine_footer_action' ) ) {
	/**
	 * Footer Declaration of the theme.
	 *
	 * @since 1.0.0
	 */
	function cream_magazine_footer_action() {

		wp_footer();
		?>
		</body>
		</html>
		<?php
	}
}
add_action( 'cream_magazine_footer', 'cream_magazine_footer_action', 10 );


if ( ! function_exists( 'cream_magazine_scroll_top_button_template' ) ) {
	/**
	 * Render scroll top button.
	 *
	 * @since 2.0.0
	 */
	function cream_magazine_scroll_top_button_template() {

		if ( cream_magazine_get_option( 'cream_magazine_enable_scroll_top_button' ) === true ) {
			?>
			<div class="backtoptop">
				<button id="toTop" class="btn btn-info">
					<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" height="14" width="14"><path d="M233.4 105.4c12.5-12.5 32.8-12.5 45.3 0l192 192c12.5 12.5 12.5 32.8 0 45.3s-32.8 12.5-45.3 0L256 173.3 86.6 342.6c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3l192-192z"/></svg>
				</button>
			</div><!-- ./ backtoptop -->
			<?php
		}
	}
}
add_action( 'cream_magazine_scroll_top_button', 'cream_magazine_scroll_top_button_template', 10 );
