<?php
/**
 * Collection of helper functions.
 *
 * @since 1.0.0
 *
 * @package Cream_Magazine
 */

if ( ! function_exists( 'cream_magazine_main_menu_wrap' ) ) {
	/**
	 * Callback function for 'item_wrap' in argument of 'wp_nav_menu'.
	 *
	 * @since 1.0.0
	 *
	 * @return string
	 */
	function cream_magazine_main_menu_wrap() {

		$show_home_icon = cream_magazine_get_option( 'cream_magazine_enable_home_button' );

		$wrap = '<ul id="%1$s" class="%2$s">';
		if ( true === $show_home_icon ) {
			$wrap .= '<li class="home-btn"><a href="' . esc_url( home_url( '/' ) ) . '"><i class="feather icon-home" aria-hidden="true"></i></a></li>';
		}
		$wrap .= '%3$s';
		$wrap .= '</ul>';

		return $wrap;
	}
}


if ( ! function_exists( 'cream_magazine_navigation_fallback' ) ) {
	/**
	 * Callback function for 'fallback_cb' in argument of 'wp_nav_menu'.
	 *
	 * @since 1.0.0
	 */
	function cream_magazine_navigation_fallback() {

		$show_home_icon = cream_magazine_get_option( 'cream_magazine_enable_home_button' );
		?>
		<ul>
		<?php
		if ( true === $show_home_icon ) {
			?>
			<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><i class="feather icon-home" aria-hidden="true"></i></a></li>
			<?php
		}

		wp_list_pages(
			array(
				'title_li' => '',
				'depth'    => 3,
			)
		);
		?>
		</ul>
		<?php
	}
}


if ( ! function_exists( 'cream_magazine_banner_query' ) ) {
	/**
	 * Queries posts for banner/slider and returns the post.
	 *
	 * @since 1.0.0
	 *
	 * @return array
	 */
	function cream_magazine_banner_query() {

		$banner_post_no   = '';
		$banner_post_cats = cream_magazine_get_option( 'cream_magazine_banner_categories' );
		$banner_layout    = cream_magazine_get_option( 'cream_magazine_select_banner_layout' );
		$banner_post_no   = absint( cream_magazine_get_option( 'cream_magazine_banner_posts_no' ) ) + 4;

		$banner_args = array(
			'post_type'           => 'post',
			'ignore_sticky_posts' => true,
		);

		if ( absint( $banner_post_no ) > 0 ) {

			$banner_args['posts_per_page'] = absint( $banner_post_no );
		}

		if ( ! empty( $banner_post_cats ) ) {

			if ( 'slug' === cream_magazine_get_option( 'cream_magazine_save_value_as' ) ) {

				$banner_args['category_name'] = implode( ',', $banner_post_cats );
			} else {

				$banner_args['cat'] = implode( ',', $banner_post_cats );
			}
		}

		$banner_query = new WP_Query( $banner_args );

		return $banner_query;
	}
}


if ( ! function_exists( 'cream_magazine_post_meta' ) ) {
	/**
	 * Renders post meta.
	 *
	 * @since 1.0.0
	 *
	 * @param boolean $show_date Show date meta.
	 * @param boolean $show_author Show author meta.
	 * @param boolean $show_comments_no Show comments number meta.
	 * @param boolean $show_categories Show categories meta.
	 */
	function cream_magazine_post_meta( $show_date, $show_author, $show_comments_no, $show_categories ) {

		$time_string = '<time class="entry-date published updated" datetime="%1$s">%2$s</time>';

		if ( get_the_time( 'U' ) !== get_the_modified_time( 'U' ) ) {
			$time_string = '<time class="entry-date published" datetime="%1$s">%2$s</time>';
		}

		$time_string = sprintf(
			$time_string,
			esc_attr( get_the_date( DATE_W3C ) ),
			esc_html( get_the_date() )
		);

		$enable_date = cream_magazine_get_option( 'cream_magazine_enable_date_meta' );

		$enable_author = cream_magazine_get_option( 'cream_magazine_enable_author_meta' );

		$enable_comments_no = cream_magazine_get_option( 'cream_magazine_enable_comment_meta' );

		$enable_categories = cream_magazine_get_option( 'cream_magazine_enable_category_meta' );

		if ( 'post' === get_post_type() ) {
			?>
			<div class="cm-post-meta">
				<ul class="post_meta">
					<?php
					if ( true === $enable_author && true === $show_author ) {
						?>
						<li class="post_author">
							<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>"><?php echo esc_html( get_the_author() ); ?></a>
						</li><!-- .post_author -->
						<?php
					}

					if ( true === $enable_date && true === $show_date ) {
						?>
						<li class="posted_date">
							<a href="<?php echo esc_url( get_permalink() ); ?>"><?php echo $time_string; // phpcs:ignore. ?></a>
						</li><!-- .posted_date -->
						<?php
					}

					if (
						true === $enable_comments_no &&
						true === $show_comments_no &&
						( comments_open() || get_comments_number() )
					) {
						?>
						<li class="comments">
							<a href="<?php echo esc_url( get_permalink() . '#comments' ); ?>"><?php echo esc_html( get_comments_number() ); ?></a>
						</li><!-- .comments -->
						<?php
					}

					if ( true === $enable_categories && true === $show_categories ) {
						/* translators: used between list items, there is a space after the comma */
						$categories_list = get_the_category_list( ', ' );
						if ( $categories_list ) {
							?>
							<li class="entry_cats">
								<?php echo wp_kses_post( $categories_list ); // phpcs:ignore ?>
							</li><!-- .entry_cats -->
							<?php
						}
					}
					?>
				</ul><!-- .post_meta -->
			</div><!-- .meta -->
			<?php
		}
	}
}


if ( ! function_exists( 'cream_magazine_post_categories_meta' ) ) {
	/**
	 * Renders post categories meta.
	 *
	 * @since 1.0.0
	 *
	 * @param boolean $show_categories Show categories meta.
	 */
	function cream_magazine_post_categories_meta( $show_categories ) {

		if ( false === cream_magazine_get_option( 'cream_magazine_enable_category_meta' ) ) {
			return;
		}

		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() && true === $show_categories ) {

			/* translators: used between list items, there is a space after the comma */
			$categories_list = get_the_category_list();

			if ( $categories_list ) {
				?>
				<div class="entry_cats">
					<?php echo wp_kses_post( $categories_list ); // phpcs:ignore ?>
				</div><!-- .entry_cats -->
				<?php
			}
		}
	}
}


if ( ! function_exists( 'cream_magazine_post_tags_meta' ) ) {
	/**
	 * Renders post tags meta.
	 *
	 * @since 1.0.0
	 *
	 * @param boolean $show_tags Show tags meta.
	 */
	function cream_magazine_post_tags_meta( $show_tags ) {

		if ( ! $show_tags ) {
			return;
		}

		$enable_tags_meta = cream_magazine_get_option( 'cream_magazine_enable_tag_meta' );

		// Hide category and tag text for pages.
		if ( 'post' === get_post_type() && true === $enable_tags_meta ) {

			/* translators: used between list items, there is a space after the comma */
			$tags_list = get_the_tag_list();

			if ( $tags_list ) {
				?>
				<div class="post_tags">
					<?php echo wp_kses_post( $tags_list ); // phpcs:ignore ?>
				</div><!-- .post_tags -->
				<?php
			}
		}
	}
}


if ( ! function_exists( 'cream_magazine_main_row_class' ) ) {
	/**
	 * Sets CSS class for main row container.
	 *
	 * @since 1.0.0
	 */
	function cream_magazine_main_row_class() {

		$row_class = 'row';

		$sidebar_position = cream_magazine_sidebar_position();

		if ( 'left' === $sidebar_position ) {

			$row_class = 'row-reverse';
		}

		return $row_class;

	}
}


if ( ! function_exists( 'cream_magazine_main_container_class' ) ) {
	/**
	 * Sets CSS class for main container.
	 *
	 * @since 1.0.0
	 */
	function cream_magazine_main_container_class() {

		$sidebar_position      = cream_magazine_sidebar_position();
		$is_sticky             = cream_magazine_check_sticky_sidebar();
		$sidebar_after_content = cream_magazine_get_option( 'cream_magazine_show_sidebar_after_contents_on_mobile_n_tablet' );

		$main_class = 'cm-col-lg-8 cm-col-12';

		if (
			is_archive() ||
			is_search() ||
			is_home() ||
			is_single() ||
			is_page()
		) {

			if ( 'none' !== $sidebar_position && is_active_sidebar( 'sidebar' ) ) {

				if ( true === $is_sticky ) {

					$main_class .= ' sticky_portion';
				}

				if ( 'left' === $sidebar_position ) {

					$main_class .= ' order-2';
				}

				if ( $sidebar_after_content ) {

					$main_class .= ' cm-order-1-mobile-tablet';
				}
			} else {

				$main_class = 'cm-col-lg-12 cm-col-12';
			}
		}
		return $main_class;
	}
}


if ( ! function_exists( 'cream_magazine_post_thumbnail' ) ) {
	/**
	 * Renders an optional post thumbnail.
	 *
	 * Wraps the post thumbnail in an anchor element on index views, or a div
	 * element when on single views.
	 */
	function cream_magazine_post_thumbnail() {

		if ( post_password_required() || is_attachment() ) {

			return;
		}

		if (
			is_archive() ||
			is_search() ||
			is_home()
		) {

			$thumbnail_size = '';

			if ( is_archive() || is_home() ) {
				$thumbnail_size = 'cream-magazine-thumbnail-2';
			}

			if ( is_search() ) {
				$thumbnail_size = 'cream-magazine-thumbnail-3';
			}

			if ( has_post_thumbnail() ) {
				?>
				<div class="<?php cream_magazine_thumbnail_class(); ?>">
					<?php cream_magazine_get_post_thumbnail( $thumbnail_size ); ?>
				</div>
				<?php
			}
		}

		if ( is_single() || is_page() ) {

			if ( has_post_thumbnail() ) {
				?>
				<div class="post_thumb">
					<figure>
					<?php

					the_post_thumbnail( 'full', array( 'alt' => the_title_attribute( array( 'echo' => false ) ) ) );

					if (
						(
							is_single() &&
							cream_magazine_get_option( 'cream_magazine_enable_post_single_featured_image_caption' )
						) ||
						(
							is_page() &&
							cream_magazine_get_option( 'cream_magazine_enable_page_single_featured_image_caption' )
						)
					) {

						$thumbnail_attachment_caption = wp_get_attachment_caption( get_post_thumbnail_id( get_the_ID() ) );
						?>
						<figcaption><?php echo esc_html( $thumbnail_attachment_caption ); ?></figcaption>
						<?php
					}
					?>
					</figure>
				</div>
				<?php
			}
		}
	}
}



if ( ! function_exists( 'cream_magazine_get_post_thumbnail' ) ) {
	/**
	 * Renders an post thumbnail.
	 *
	 * @since 1.0.0
	 *
	 * @param string $thumbnail_size Post thumbnail size.
	 */
	function cream_magazine_get_post_thumbnail( $thumbnail_size ) {
		?>
		<a href="<?php the_permalink(); ?>">
			<figure class="imghover">
				<?php
				the_post_thumbnail(
					$thumbnail_size,
					array(
						'alt' => the_title_attribute(
							array(
								'echo' => false,
							)
						),
					)
				);
				?>
			</figure>
		</a>
		<?php
	}
}


if ( ! function_exists( 'cream_magazine_thumbnail_alt_text' ) ) {
	/**
	 * Renders alternate text if post thumbnail is not found.
	 *
	 * @since 1.0.0
	 *
	 * @param int $post_id Post thumbnail ID.
	 */
	function cream_magazine_thumbnail_alt_text( $post_id ) {

		$post_thumbnail_id = get_post_thumbnail_id( $post_id );

		$alt_text = '';

		if ( ! empty( $post_thumbnail_id ) ) {

			$alt_text = get_post_meta( $post_thumbnail_id, '_wp_attachment_image_alt', true );
		}

		if ( ! empty( $alt_text ) ) {

			echo esc_attr( $alt_text );
		} else {

			the_title_attribute();
		}
	}
}


if ( ! function_exists( 'cream_magazine_show_news_ticker' ) ) {
	/**
	 * Checks if new ticker is enabled.
	 *
	 * @since 1.0.0
	 *
	 * @return boolean
	 */
	function cream_magazine_show_news_ticker() {

		if ( cream_magazine_get_option( 'cream_magazine_enable_ticker_news' ) ) {

			$show_on = cream_magazine_get_option( 'cream_magazine_show_ticker_news' );

			switch ( $show_on ) {

				case 'choice_2':
					if ( is_home() && is_front_page() ) {
						return true;
					} else {
						if ( is_home() && ! is_front_page() ) {
							return true;
						}
					}
					break;
				case 'choice_1':
					if ( ! is_home() && is_front_page() ) {
						return true;
					}
					break;
				case 'choice_3':
					if ( is_home() || is_front_page() ) {
						return true;
					}
					break;
				default:
					return false;
			}

			return false;
		} else {

			return false;
		}
	}
}


if ( ! function_exists( 'cream_magazine_excerpt_length' ) ) {
	/**
	 * Set the length of post excerpt.
	 *
	 * @since 1.0.0
	 *
	 * @param int $length Length of post excerpt.
	 * @return int
	 */
	function cream_magazine_excerpt_length( $length ) {

		if ( is_admin() ) {
			return $length;
		}

		$excerpt_length = cream_magazine_get_option( 'cream_magazine_post_excerpt_length' );

		if ( absint( $excerpt_length ) > 0 ) {
			$excerpt_length = absint( $excerpt_length );
		}

		return $excerpt_length;
	}

	add_filter( 'excerpt_length', 'cream_magazine_excerpt_length' );
}

if ( ! function_exists( 'cream_magazine_menu_description' ) ) {
	/**
	 * Adds menu description in primary menu.
	 *
	 * @since 1.0.0
	 *
	 * @param string $item_output The menu item's starting HTML output.
	 * @param object $item Menu item data object.
	 * @param int    $depth Depth of menu item. Used for padding.
	 * @param object $args An object of 'wp_nav_menu()' arguments.
	 */
	function cream_magazine_menu_description( $item_output, $item, $depth, $args ) {

		if ( ! cream_magazine_get_option( 'cream_magazine_enable_menu_description' ) ) {

			return $item_output;
		}

		if ( ! empty( $item->description ) ) {

			$item_output = str_replace( $args->link_after . '</a>', '<span class="menu-item-description">' . $item->description . '</span>' . $args->link_after . '</a>', $item_output );
		}

		return $item_output;
	}

	add_filter( 'walker_nav_menu_start_el', 'cream_magazine_menu_description', 10, 4 );
}




if ( ! function_exists( 'cream_magazine_has_google_fonts' ) ) {
	/**
	 * Checks if Google font is used.
	 *
	 * @since 2.1.2
	 */
	function cream_magazine_has_google_fonts() {

		$body_font = cream_magazine_get_option( 'cream_magazine_body_font' );
		$body_font = json_decode( $body_font, true );

		$headings_font = cream_magazine_get_option( 'cream_magazine_headings_font' );
		$headings_font = json_decode( $headings_font, true );

		return ( 'google' === $body_font['source'] || 'google' === $headings_font['source'] ) ? true : false;
	}
}



if ( ! function_exists( 'cream_magazine_google_fonts_urls' ) ) {
	/**
	 * Returns the array of Google fonts URL.
	 *
	 * @since 2.1.2
	 *
	 * @return array $fonts_urls Fonts URLs.
	 */
	function cream_magazine_google_fonts_urls() {

		if ( ! cream_magazine_has_google_fonts() ) {
			return false;
		}

		$fonts_urls = array();

		$body_font = cream_magazine_get_option( 'cream_magazine_body_font' );
		$body_font = json_decode( $body_font, true );

		$headings_font = cream_magazine_get_option( 'cream_magazine_headings_font' );
		$headings_font = json_decode( $headings_font, true );

		if ( 'google' === $body_font['source'] ) {
			$fonts_urls[] = $body_font['font_url'];
		}

		if ( 'google' === $headings_font['source'] ) {
			$fonts_urls[] = $headings_font['font_url'];
		}

		return $fonts_urls;
	}
}

if ( ! function_exists( 'cream_magazine_render_google_fonts_header' ) ) {
	/**
	 * Renders <link> tags for Google fonts embedd in the <head> tag.
	 *
	 * @since 2.1.2
	 */
	function cream_magazine_render_google_fonts_header() {

		if ( ! cream_magazine_has_google_fonts() ) {
			return;
		}
		?>
		<link rel="preconnect" href="https://fonts.googleapis.com">
		<link rel="preconnect" href="https://fonts.gstatic.com" crossorigin> 
		<?php
	}

	add_action( 'wp_head', 'cream_magazine_render_google_fonts_header', 5 );
}

if ( ! function_exists( 'cream_magazine_get_google_fonts_url' ) ) {
	/**
	 * Returns the URL of Google fonts.
	 *
	 * @since 2.1.2
	 *
	 * @return string $google_fonts_url Google Fonts URL.
	 */
	function cream_magazine_get_google_fonts_url() {

		$google_fonts_urls = cream_magazine_google_fonts_urls();

		if ( empty( $google_fonts_urls ) ) {

			return false;
		}

		$google_fonts_url = add_query_arg(
			array(
				'family'  => implode( '&family=', $google_fonts_urls ),
				'display' => 'swap',
			),
			'https://fonts.googleapis.com/css2'
		);

		return esc_url( $google_fonts_url );
	}
}
