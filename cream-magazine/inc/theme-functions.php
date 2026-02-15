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
			$wrap .= '<li class="home-btn"><a href="' . esc_url( home_url( '/' ) ) . '"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M575.8 255.5c0 18-15 32.1-32 32.1l-32 0 .7 160.2c0 2.7-.2 5.4-.5 8.1l0 16.2c0 22.1-17.9 40-40 40l-16 0c-1.1 0-2.2 0-3.3-.1c-1.4 .1-2.8 .1-4.2 .1L416 512l-24 0c-22.1 0-40-17.9-40-40l0-24 0-64c0-17.7-14.3-32-32-32l-64 0c-17.7 0-32 14.3-32 32l0 64 0 24c0 22.1-17.9 40-40 40l-24 0-31.9 0c-1.5 0-3-.1-4.5-.2c-1.2 .1-2.4 .2-3.6 .2l-16 0c-22.1 0-40-17.9-40-40l0-112c0-.9 0-1.9 .1-2.8l0-69.7-32 0c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L564.8 231.5c8 7 12 15 11 24z"/></svg></a></li>';
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
			<li><a href="<?php echo esc_url( home_url( '/' ) ); ?>"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M575.8 255.5c0 18-15 32.1-32 32.1l-32 0 .7 160.2c0 2.7-.2 5.4-.5 8.1l0 16.2c0 22.1-17.9 40-40 40l-16 0c-1.1 0-2.2 0-3.3-.1c-1.4 .1-2.8 .1-4.2 .1L416 512l-24 0c-22.1 0-40-17.9-40-40l0-24 0-64c0-17.7-14.3-32-32-32l-64 0c-17.7 0-32 14.3-32 32l0 64 0 24c0 22.1-17.9 40-40 40l-24 0-31.9 0c-1.5 0-3-.1-4.5-.2c-1.2 .1-2.4 .2-3.6 .2l-16 0c-22.1 0-40-17.9-40-40l0-112c0-.9 0-1.9 .1-2.8l0-69.7-32 0c-18 0-32-14-32-32.1c0-9 3-17 10-24L266.4 8c7-7 15-8 22-8s15 2 21 7L564.8 231.5c8 7 12 15 11 24z"/></svg></a></li>
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
							<a href="<?php echo esc_url( get_author_posts_url( get_the_author_meta( 'ID' ) ) ); ?>">
								<span class="cm-meta-icon">
									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M406.5 399.6C387.4 352.9 341.5 320 288 320l-64 0c-53.5 0-99.4 32.9-118.5 79.6C69.9 362.2 48 311.7 48 256C48 141.1 141.1 48 256 48s208 93.1 208 208c0 55.7-21.9 106.2-57.5 143.6zm-40.1 32.7C334.4 452.4 296.6 464 256 464s-78.4-11.6-110.5-31.7c7.3-36.7 39.7-64.3 78.5-64.3l64 0c38.8 0 71.2 27.6 78.5 64.3zM256 512A256 256 0 1 0 256 0a256 256 0 1 0 0 512zm0-272a40 40 0 1 1 0-80 40 40 0 1 1 0 80zm-88-40a88 88 0 1 0 176 0 88 88 0 1 0 -176 0z"/></svg>
								</span>
								<?php echo esc_html( get_the_author() ); ?>
							</a>
						</li><!-- .post_author -->
						<?php
					}

					if ( true === $enable_date && true === $show_date ) {
						?>
						<li class="posted_date">
							<a href="<?php echo esc_url( get_permalink() ); ?>">
								<span class="cm-meta-icon">
									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M152 24c0-13.3-10.7-24-24-24s-24 10.7-24 24l0 40L64 64C28.7 64 0 92.7 0 128l0 16 0 48L0 448c0 35.3 28.7 64 64 64l320 0c35.3 0 64-28.7 64-64l0-256 0-48 0-16c0-35.3-28.7-64-64-64l-40 0 0-40c0-13.3-10.7-24-24-24s-24 10.7-24 24l0 40L152 64l0-40zM48 192l352 0 0 256c0 8.8-7.2 16-16 16L64 464c-8.8 0-16-7.2-16-16l0-256z"/></svg>
								</span>
								<?php echo $time_string; // phpcs:ignore. ?>
							</a>
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
							<a href="<?php echo esc_url( get_permalink() . '#comments' ); ?>">
								<span class="cm-meta-icon">
									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M160 368c26.5 0 48 21.5 48 48l0 16 72.5-54.4c8.3-6.2 18.4-9.6 28.8-9.6L448 368c8.8 0 16-7.2 16-16l0-288c0-8.8-7.2-16-16-16L64 48c-8.8 0-16 7.2-16 16l0 288c0 8.8 7.2 16 16 16l96 0zm48 124l-.2 .2-5.1 3.8-17.1 12.8c-4.8 3.6-11.3 4.2-16.8 1.5s-8.8-8.2-8.8-14.3l0-21.3 0-6.4 0-.3 0-4 0-48-48 0-48 0c-35.3 0-64-28.7-64-64L0 64C0 28.7 28.7 0 64 0L448 0c35.3 0 64 28.7 64 64l0 288c0 35.3-28.7 64-64 64l-138.7 0L208 492z"/></svg>
								</span>
								<?php echo esc_html( get_comments_number() ); ?>
							</a>
						</li><!-- .comments -->
						<?php
					}

					if ( true === $enable_categories && true === $show_categories ) {
						/* translators: used between list items, there is a space after the comma */
						$categories_list = get_the_category_list( ', ' );
						if ( $categories_list ) {
							?>
							<li class="entry_cats">
								<span class="cm-meta-icon">
									<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 384 512"><path d="M320 464c8.8 0 16-7.2 16-16l0-288-80 0c-17.7 0-32-14.3-32-32l0-80L64 48c-8.8 0-16 7.2-16 16l0 384c0 8.8 7.2 16 16 16l256 0zM0 64C0 28.7 28.7 0 64 0L229.5 0c17 0 33.3 6.7 45.3 18.7l90.5 90.5c12 12 18.7 28.3 18.7 45.3L384 448c0 35.3-28.7 64-64 64L64 512c-35.3 0-64-28.7-64-64L0 64z"/></svg>
								</span>
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
