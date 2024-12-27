<?php
/**
 * Collection of helper functions for customize.
 *
 * @since 1.0.0
 *
 * @package Cream_Magazine
 */

if ( ! function_exists( 'cream_magazine_categories_tax_slug' ) ) {
	/**
	 * Generates array of category terms. Value is term slug and label is the term name.
	 *
	 * @since 1.0.0
	 *
	 * @return array $dropdown
	 */
	function cream_magazine_categories_tax_slug() {

		$taxonomy = 'category';

		$cat_terms = get_terms( $taxonomy );

		$dropdown = array();

		if ( ! empty( $cat_terms ) ) {

			foreach ( $cat_terms as $cat_term ) {

				$dropdown[ $cat_term->slug ] = $cat_term->name;
			}
		}

		return $dropdown;
	}
}



if ( ! function_exists( 'cream_magazine_categories_tax_id' ) ) {
	/**
	 * Generates array of category terms. Value is term ID and label is the term name.
	 *
	 * @since 1.0.0
	 *
	 * @return array $dropdown
	 */
	function cream_magazine_categories_tax_id() {

		$taxonomy = 'category';

		$cat_terms = get_terms( $taxonomy );

		$dropdown = array();

		if ( ! empty( $cat_terms ) ) {

			foreach ( $cat_terms as $cat_term ) {

				$dropdown[ $cat_term->term_id ] = $cat_term->name;
			}
		}

		return $dropdown;
	}
}


if ( ! function_exists( 'cream_magazine_ticker_news_on_pages' ) ) {
	/**
	 * Generates array choices for displaying ticker news.
	 *
	 * @since 1.0.0
	 */
	function cream_magazine_ticker_news_on_pages() {

		return array(
			'choice_1' => esc_html__( 'Front Page Only', 'cream-magazine' ),
			'choice_2' => esc_html__( 'Blog Page Only', 'cream-magazine' ),
			'choice_3' => esc_html__( 'Both Front Page & Blog Page', 'cream-magazine' ),
		);
	}
}


if ( ! function_exists( 'cream_magazine_save_value_as' ) ) {
	/**
	 * Generates array choices for saving page, posts, and terms values as.
	 *
	 * @since 1.0.0
	 */
	function cream_magazine_save_value_as() {

		return array(
			'slug' => esc_html__( 'Slug', 'cream-magazine' ),
			'id'   => esc_html__( 'ID', 'cream-magazine' ),
		);
	}
}


if ( ! function_exists( 'cream_magazine_header_layouts' ) ) {
	/**
	 * Generates array choices for header layouts.
	 *
	 * @since 1.0.0
	 */
	function cream_magazine_header_layouts() {

		return array(
			'header_1' => get_template_directory_uri() . '/admin/images/header-placeholders/header_1.png',
			'header_2' => get_template_directory_uri() . '/admin/images/header-placeholders/header_2.png',
		);
	}
}


if ( ! function_exists( 'cream_magazine_sidebar_positions' ) ) {
	/**
	 * Generates array choices for sidebar positions.
	 *
	 * @since 1.0.0
	 */
	function cream_magazine_sidebar_positions() {

		return array(
			'left'  => get_template_directory_uri() . '/admin/images/sidebar-placeholders/sidebar_left.png',
			'right' => get_template_directory_uri() . '/admin/images/sidebar-placeholders/sidebar_right.png',
			'none'  => get_template_directory_uri() . '/admin/images/sidebar-placeholders/sidebar_none.png',
		);
	}
}


if ( ! function_exists( 'cream_magazine_breadcrumb_sources' ) ) {
	/**
	 * Generates array choices for breadcrumbs sources.
	 *
	 * @since 1.0.0
	 */
	function cream_magazine_breadcrumb_sources() {

		$sources = array(
			'default' => __( 'Default', 'cream-magazine' ),
		);

		if ( function_exists( 'yoast_breadcrumb' ) ) {
			$sources['yoast'] = __( 'Yoast SEO', 'cream-magazine' );
		}

		if ( function_exists( 'rank_math' ) && rank_math()->settings->get( 'general.breadcrumbs' ) ) {
			$sources['rank_math'] = __( 'Rank Math', 'cream-magazine' );
		}

		if ( function_exists( 'bcn_display' ) ) {
			$sources['bcn'] = __( 'Breadcrumb NavXT', 'cream-magazine' );
		}

		return apply_filters( 'cream_magazine_breadcrumb_sources', $sources );
	}
}

if ( ! function_exists( 'cream_magazine_get_customize_responsive_icon_desktop' ) ) {
	/**
	 * Renders desktop device switcher.
	 *
	 * @since 1.0.0
	 */
	function cream_magazine_get_customize_responsive_icon_desktop() {
		?>
		<li class="desktop">
			<button type="button" class="preview-desktop active" data-device="desktop">
				<?php
				echo apply_filters( // phpcs:ignore
					'cream_magazine_filter_responsive_icon_desktop',
					'<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M4 5v11h16V5H4zm-2-.993C2 3.451 2.455 3 2.992 3h18.016c.548 0 .992.449.992 1.007V18H2V4.007zM1 19h22v2H1v-2z"/></svg>'
				);
				?>
			</button>
		</li>
		<?php
	}
}


if ( ! function_exists( 'cream_magazine_get_customize_responsive_icon_tablet' ) ) {
	/**
	 * Renders tablet device switcher.
	 *
	 * @since 1.0.0
	 */
	function cream_magazine_get_customize_responsive_icon_tablet() {
		?>
		<li class="tablet">
			<button type="button" class="preview-tablet" data-device="tablet">
				<?php
				echo apply_filters( // phpcs:ignore
					'cream_magazine_filter_responsive_icon_tablet',
					'<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M6 4v16h12V4H6zM5 2h14a1 1 0 0 1 1 1v18a1 1 0 0 1-1 1H5a1 1 0 0 1-1-1V3a1 1 0 0 1 1-1zm7 15a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/></svg>'
				);
				?>
			</button>
		</li>
		<?php
	}
}


if ( ! function_exists( 'cream_magazine_get_customize_responsive_icon_mobile' ) ) {
	/**
	 * Renders mobile device switcher.
	 *
	 * @since 1.0.0
	 */
	function cream_magazine_get_customize_responsive_icon_mobile() {
		?>
		<li class="tablet">
			<button type="button" class="preview-mobile" data-device="mobile">
				<?php
				echo apply_filters( // phpcs:ignore
					'cream_magazine_filter_responsive_icon_mobile',
					'<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" width="24" height="24"><path fill="none" d="M0 0h24v24H0z"/><path d="M7 4v16h10V4H7zM6 2h12a1 1 0 0 1 1 1v18a1 1 0 0 1-1 1H6a1 1 0 0 1-1-1V3a1 1 0 0 1 1-1zm6 15a1 1 0 1 1 0 2 1 1 0 0 1 0-2z"/></svg>'
				);
				?>
			</button>
		</li>
		<?php
	}
}
