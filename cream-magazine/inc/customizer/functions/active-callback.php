<?php
/**
 * Collection of active callback functions.
 *
 * @since 1.0.0
 *
 * @package Cream_Magazine
 */

if ( ! function_exists( 'cream_magaine_is_ticker_news_enabled' ) ) {
	/**
	 * Checks if news ticker is enabled.
	 *
	 * @since 1.0.0
	 *
	 * @param  object $control WP Customize Control.
	 * @return boolean
	 */
	function cream_magaine_is_ticker_news_enabled( $control ) {

		return $control->manager->get_setting( 'cream_magazine_enable_ticker_news' )->value();
	}
}


if ( ! function_exists( 'cream_magaine_is_banner_active' ) ) {
	/**
	 * Checks if banner/slider is enabled.
	 *
	 * @since 1.0.0
	 *
	 * @param  object $control WP Customize Control.
	 * @return boolean
	 */
	function cream_magaine_is_banner_active( $control ) {

		return $control->manager->get_setting( 'cream_magazine_enable_banner' )->value();
	}
}


if ( ! function_exists( 'cream_magaine_is_header_one_active' ) ) {
	/**
	 * Checks if header layout one is enabled.
	 *
	 * @since 1.0.0
	 *
	 * @param  object $control WP Customize Control.
	 * @return boolean
	 */
	function cream_magaine_is_header_one_active( $control ) {

		return ( 'header_1' === $control->manager->get_setting( 'cream_magazine_select_header_layout' )->value() ) ? true : false;
	}
}


if ( ! function_exists( 'cream_magaine_is_header_two_active' ) ) {
	/**
	 * Checks if header layout two is enabled.
	 *
	 * @since 1.0.0
	 *
	 * @param  object $control WP Customize Control.
	 * @return boolean
	 */
	function cream_magaine_is_header_two_active( $control ) {

		return ( 'header_2' === $control->manager->get_setting( 'cream_magazine_select_header_layout' )->value() ) ? true : false;
	}
}


if ( ! function_exists( 'cream_magaine_is_related_section_active' ) ) {
	/**
	 * Checks if related section is enabled.
	 *
	 * @since 1.0.0
	 *
	 * @param  object $control WP Customize Control.
	 * @return boolean
	 */
	function cream_magaine_is_related_section_active( $control ) {

		return $control->manager->get_setting( 'cream_magazine_enable_related_section' )->value();
	}
}


if ( ! function_exists( 'cream_magazine_is_post_common_sidebar_position_active' ) ) {
	/**
	 * Checks if common sidebar position for post single is enabled.
	 *
	 * @since 1.0.0
	 *
	 * @param  object $control WP Customize Control.
	 * @return boolean
	 */
	function cream_magazine_is_post_common_sidebar_position_active( $control ) {

		return $control->manager->get_setting( 'cream_magazine_enable_post_common_sidebar_position' )->value();
	}
}



if ( ! function_exists( 'cream_magazine_is_page_common_sidebar_position_active' ) ) {
	/**
	 * Checks if common sidebar position for page is enabled.
	 *
	 * @since 1.0.0
	 *
	 * @param  object $control WP Customize Control.
	 * @return boolean
	 */
	function cream_magazine_is_page_common_sidebar_position_active( $control ) {

		return $control->manager->get_setting( 'cream_magazine_enable_page_common_sidebar_position' )->value();
	}
}


if ( ! function_exists( 'cream_magazine_is_common_categories_bg_color_active' ) ) {
	/**
	 * Checks if common background color for category meta is enabled.
	 *
	 * @since 1.0.0
	 *
	 * @param  object $control WP Customize Control.
	 * @return boolean
	 */
	function cream_magazine_is_common_categories_bg_color_active( $control ) {

		return $control->manager->get_setting( 'cream_magazine_enable_common_cat_color' )->value();
	}
}


if ( ! function_exists( 'cream_magazine_is_common_categories_bg_color_not_active' ) ) {
	/**
	 * Checks if common background color for category meta is disabled.
	 *
	 * @since 1.0.0
	 *
	 * @param  object $control WP Customize Control.
	 * @return boolean
	 */
	function cream_magazine_is_common_categories_bg_color_not_active( $control ) {

		return ! $control->manager->get_setting( 'cream_magazine_enable_common_cat_color' )->value();
	}
}


if ( ! function_exists( 'cream_magazine_is_footer_widget_area_active' ) ) {
	/**
	 * Checks if footer widget area is enabled.
	 *
	 * @since 1.0.0
	 *
	 * @param  object $control WP Customize Control.
	 * @return boolean
	 */
	function cream_magazine_is_footer_widget_area_active( $control ) {

		return $control->manager->get_setting( 'cream_magazine_show_footer_widget_area' )->value();
	}
}


if ( ! function_exists( 'cream_magazine_is_sidebar_on_mobile_active' ) ) {
	/**
	 * Checks if sidebar is active on mobile devices.
	 *
	 * @since 1.0.0
	 *
	 * @param  object $control WP Customize Control.
	 * @return boolean
	 */
	function cream_magazine_is_sidebar_on_mobile_active( $control ) {

		return $control->manager->get_setting( 'cream_magazine_show_sidebar_on_mobile_n_tablet' )->value();
	}
}


if ( ! function_exists( 'cream_magazine_is_static_home_page_set' ) ) {
	/**
	 * Checks if static home page is set.
	 *
	 * @since 1.0.0
	 *
	 * @param  object $control WP Customize Control.
	 * @return boolean
	 */
	function cream_magazine_is_static_home_page_set( $control ) {

		return ( 'page' === $control->manager->get_setting( 'show_on_front' )->value() ) ? true : false;
	}
}


if ( ! function_exists( 'cream_magazine_is_breadcrumbs_active' ) ) {
	/**
	 * Checks if breadcrumbs is enabled.
	 *
	 * @since 1.0.0
	 *
	 * @param  object $control WP Customize Control.
	 * @return boolean
	 */
	function cream_magazine_is_breadcrumbs_active( $control ) {

		return $control->manager->get_setting( 'cream_magazine_enable_breadcrumb' )->value();
	}
}
