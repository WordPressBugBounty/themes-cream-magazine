<?php
/**
 * Renders dynamic CSS from customize.
 *
 * @since 1.0.0
 *
 * @package Cream_Magazine
 */

if ( ! function_exists( 'cream_magazine_dynamic_styles' ) ) {
	/**
	 * Print dynamic CSS.
	 *
	 * @since 1.0.0
	 */
	function cream_magazine_dynamic_styles() {

		$body_font = cream_magazine_get_option( 'cream_magazine_body_font' );
		$body_font = json_decode( $body_font, true );

		$headings_font = cream_magazine_get_option( 'cream_magazine_headings_font' );
		$headings_font = json_decode( $headings_font, true );

		$primary_theme_color = cream_magazine_get_option( 'cream_magazine_primary_theme_color' );

		$header_overlay = cream_magazine_get_option( 'cream_magazine_header_overlay_color' );

		$css = '<style>';

		if ( cream_magazine_get_option( 'cream_magazine_disable_link_focus_outline' ) ) {
			$css .= 'a:focus {';
			$css .= 'outline: none !important;';
			$css .= '}';
		}

		if ( cream_magazine_get_option( 'cream_magazine_disable_link_decoration_on_hover' ) ) {
			$css .= 'a:hover {';
			$css .= 'text-decoration: none !important;';
			$css .= '}';
		}

		if ( ! empty( $primary_theme_color ) ) {
			$css .= 'button,
				input[type="button"],
				input[type="reset"],
				input[type="submit"],
				.primary-navigation > ul > li.home-btn,
				.cm_header_lay_three .primary-navigation > ul > li.home-btn,
				.news_ticker_wrap .ticker_head,
				#toTop,
				.section-title h2::after,
				.sidebar-widget-area .widget .widget-title h2::after,
				.footer-widget-container .widget .widget-title h2::after,
				#comments div#respond h3#reply-title::after,
				#comments h2.comments-title:after,
				.post_tags a,
				.owl-carousel .owl-nav button.owl-prev, 
				.owl-carousel .owl-nav button.owl-next,
				.cm_author_widget .author-detail-link a,
				.error_foot form input[type="submit"], 
				.widget_search form input[type="submit"],
				.header-search-container input[type="submit"],
				.trending_widget_carousel .owl-dots button.owl-dot,
				.pagination .page-numbers.current,
				.post-navigation .nav-links .nav-previous a, 
				.post-navigation .nav-links .nav-next a,
				#comments form input[type="submit"],
				footer .widget.widget_search form input[type="submit"]:hover,
				.widget_product_search .woocommerce-product-search button[type="submit"],
				.woocommerce ul.products li.product .button,
				.woocommerce .woocommerce-pagination ul.page-numbers li span.current,
				.woocommerce .product div.summary .cart button.single_add_to_cart_button,
				.woocommerce .product div.woocommerce-tabs div.panel #reviews #review_form_wrapper .comment-form p.form-submit .submit,
				.woocommerce .product section.related > h2::after,
				.woocommerce .cart .button:hover, 
				.woocommerce .cart .button:focus, 
				.woocommerce .cart input.button:hover, 
				.woocommerce .cart input.button:focus, 
				.woocommerce #respond input#submit:hover, 
				.woocommerce #respond input#submit:focus, 
				.woocommerce button.button:hover, 
				.woocommerce button.button:focus, 
				.woocommerce input.button:hover, 
				.woocommerce input.button:focus,
				.woocommerce #respond input#submit.alt:hover, 
				.woocommerce a.button.alt:hover, 
				.woocommerce button.button.alt:hover, 
				.woocommerce input.button.alt:hover,
				.woocommerce a.remove:hover,
				.woocommerce-account .woocommerce-MyAccount-navigation ul li.is-active a,
				.woocommerce a.button:hover, 
				.woocommerce a.button:focus,
				.widget_product_tag_cloud .tagcloud a:hover, 
				.widget_product_tag_cloud .tagcloud a:focus,
				.woocommerce .widget_price_filter .price_slider_wrapper .ui-slider .ui-slider-handle,
				.error_page_top_portion,
				.primary-navigation ul li a span.menu-item-description {';
			$css .= "background-color: {$primary_theme_color}";
			$css .= '}';

			$css .= 'a:hover,
				.post_title h2 a:hover,
				.post_title h2 a:focus,
				.post_meta li a:hover,
				.post_meta li a:focus,
				ul.social-icons li a[href*=".com"]:hover::before,
				.ticker_carousel .owl-nav button.owl-prev i, 
				.ticker_carousel .owl-nav button.owl-next i,
				.news_ticker_wrap .ticker_items .item a:hover,
				.news_ticker_wrap .ticker_items .item a:focus,
				.cm_banner .post_title h2 a:hover,
				.cm_banner .post_meta li a:hover,
				.cm_middle_post_widget_one .post_title h2 a:hover, 
				.cm_middle_post_widget_one .post_meta li a:hover,
				.cm_middle_post_widget_three .post_thumb .post-holder a:hover,
				.cm_middle_post_widget_three .post_thumb .post-holder a:focus,
				.cm_middle_post_widget_six .middle_widget_six_carousel .item .card .card_content a:hover, 
				.cm_middle_post_widget_six .middle_widget_six_carousel .item .card .card_content a:focus,
				.cm_post_widget_twelve .card .post-holder a:hover, 
				.cm_post_widget_twelve .card .post-holder a:focus,
				.cm_post_widget_seven .card .card_content a:hover, 
				.cm_post_widget_seven .card .card_content a:focus,
				.copyright_section a:hover,
				.footer_nav ul li a:hover,
				.breadcrumb ul li:last-child span,
				.pagination .page-numbers:hover,
				#comments ol.comment-list li article footer.comment-meta .comment-metadata span.edit-link a:hover,
				#comments ol.comment-list li article .reply a:hover,
				.social-share ul li a:hover,
				ul.social-icons li a:hover,
				ul.social-icons li a:focus,
				.woocommerce ul.products li.product a:hover,
				.woocommerce ul.products li.product .price,
				.woocommerce .woocommerce-pagination ul.page-numbers li a.page-numbers:hover,
				.woocommerce div.product p.price, 
				.woocommerce div.product span.price,
				.video_section .video_details .post_title h2 a:hover,
				.primary-navigation.dark li a:hover,
				footer .footer_inner a:hover,
				.footer-widget-container ul.post_meta li:hover span, 
				.footer-widget-container ul.post_meta li:hover a,
				ul.post_meta li a:hover,
				.cm-post-widget-two .big-card .post-holder .post_title h2 a:hover,
				.cm-post-widget-two .big-card .post_meta li a:hover,
				.copyright_section .copyrights a,
				.breadcrumb ul li a:hover, 
				.breadcrumb ul li a:hover span {';
			$css .= "color: {$primary_theme_color}";
			$css .= '}';

			$css .= '.ticker_carousel .owl-nav button.owl-prev, 
				.ticker_carousel .owl-nav button.owl-next,
				.error_foot form input[type="submit"], 
				.widget_search form input[type="submit"],
				.pagination .page-numbers:hover,
				#comments form input[type="submit"],
				.social-share ul li a:hover,
				.header-search-container .search-form-entry,
				.widget_product_search .woocommerce-product-search button[type="submit"],
				.woocommerce .woocommerce-pagination ul.page-numbers li span.current,
				.woocommerce .woocommerce-pagination ul.page-numbers li a.page-numbers:hover,
				.woocommerce a.remove:hover,
				.ticker_carousel .owl-nav button.owl-prev:hover, 
				.ticker_carousel .owl-nav button.owl-next:hover,
				footer .widget.widget_search form input[type="submit"]:hover,
				.trending_widget_carousel .owl-dots button.owl-dot,
				.the_content blockquote,
				.widget_tag_cloud .tagcloud a:hover {';
			$css .= "border-color: {$primary_theme_color}";
			$css .= '}';
		}

		if ( ! empty( $header_overlay ) ) {
			$css .= 'header .mask {';
			$css .= "background-color: {$header_overlay};";
			$css .= '}';
		}

		if ( has_header_image() ) {
			$css .= 'header.cm-header-style-one {';
			$css .= 'background-image: url(' . esc_url( get_header_image() ) . ');';
			$css .= '}';
		}

		if ( cream_magazine_get_option( 'cream_magazine_tagline_color' ) ) {
			$css .= '.site-description {';
			$css .= 'color: ' . esc_attr( cream_magazine_get_option( 'cream_magazine_tagline_color' ) ) . ';';
			$css .= '}';
		}

		if ( $body_font ) {
			$css .= 'body {';
			if ( isset( $body_font['font_family'] ) && ! empty( $body_font['font_family'] ) ) {
				$css .= 'font-family: ' . esc_attr( $body_font['font_family'] ) . ';';
			}
			if ( isset( $body_font['font_weight'] ) && ! empty( $body_font['font_weight'] ) ) {
				$css .= 'font-weight: ' . esc_attr( $body_font['font_weight'] ) . ';';
			}
			$css .= '}';
		}

		if ( $headings_font ) {
			$css .= 'h1,h2,h3,h4,h5,h6,.site-title {';
			if ( isset( $headings_font['font_family'] ) && ! empty( $headings_font['font_family'] ) ) {
				$css .= 'font-family: ' . esc_attr( $headings_font['font_family'] ) . ';';
			}
			if ( isset( $headings_font['font_weight'] ) && ! empty( $headings_font['font_weight'] ) ) {
				$css .= 'font-weight: ' . esc_attr( $headings_font['font_weight'] ) . ';';
			}
			$css .= '}';
		}

		if ( cream_magazine_get_option( 'cream_magazine_enable_common_cat_color' ) ) {

			$css .= '.entry_cats ul.post-categories li a {';
			if ( cream_magazine_get_option( 'cream_magazine_common_cat_bg_color' ) ) {
				$css .= 'background-color: ' . esc_attr( cream_magazine_get_option( 'cream_magazine_common_cat_bg_color' ) ) . ';';
			}

			if ( cream_magazine_get_option( 'cream_magazine_common_cat_txt_color' ) ) {
				$css .= 'color: ' . esc_attr( cream_magazine_get_option( 'cream_magazine_common_cat_txt_color' ) ) . ';';
			}
			$css .= '}';

			$css .= '.entry_cats ul.post-categories li a:hover {';
			if ( cream_magazine_get_option( 'cream_magazine_cat_hover_bg_color' ) ) {
				$css .= 'background-color: ' . esc_attr( cream_magazine_get_option( 'cream_magazine_cat_hover_bg_color' ) ) . ';';
			}

			if ( cream_magazine_get_option( 'cream_magazine_cat_hover_txt_color' ) ) {
				$css .= 'color: ' . esc_attr( cream_magazine_get_option( 'cream_magazine_cat_hover_txt_color' ) ) . ';';
			}
			$css .= '}';
		} else {
			if ( cream_magazine_get_option( 'cream_magazine_cat_bg_color_1' ) ) {
				$css .= '.entry_cats ul.post-categories li:nth-child(9n+1) a {';
				$css .= 'background-color: ' . esc_attr( cream_magazine_get_option( 'cream_magazine_cat_bg_color_1' ) ) . ';';
				$css .= '}';
			}

			if ( cream_magazine_get_option( 'cream_magazine_cat_bg_color_2' ) ) {
				$css .= '.entry_cats ul.post-categories li:nth-child(9n+2) a {';
				$css .= 'background-color: ' . esc_attr( cream_magazine_get_option( 'cream_magazine_cat_bg_color_2' ) ) . ';';
				$css .= '}';
			}

			if ( cream_magazine_get_option( 'cream_magazine_cat_bg_color_3' ) ) {
				$css .= '.entry_cats ul.post-categories li:nth-child(9n+3) a {';
				$css .= 'background-color: ' . esc_attr( cream_magazine_get_option( 'cream_magazine_cat_bg_color_3' ) ) . ';';
				$css .= '}';
			}

			if ( cream_magazine_get_option( 'cream_magazine_cat_bg_color_4' ) ) {
				$css .= '.entry_cats ul.post-categories li:nth-child(9n+4) a {';
				$css .= 'background-color: ' . esc_attr( cream_magazine_get_option( 'cream_magazine_cat_bg_color_4' ) ) . ';';
				$css .= '}';
			}

			if ( cream_magazine_get_option( 'cream_magazine_cat_bg_color_5' ) ) {
				$css .= '.entry_cats ul.post-categories li:nth-child(9n+5) a {';
				$css .= 'background-color: ' . esc_attr( cream_magazine_get_option( 'cream_magazine_cat_bg_color_5' ) ) . ';';
				$css .= '}';
			}

			if ( cream_magazine_get_option( 'cream_magazine_cat_bg_color_6' ) ) {
				$css .= '.entry_cats ul.post-categories li:nth-child(9n+6) a {';
				$css .= 'background-color: ' . esc_attr( cream_magazine_get_option( 'cream_magazine_cat_bg_color_6' ) ) . ';';
				$css .= '}';
			}

			if ( cream_magazine_get_option( 'cream_magazine_cat_bg_color_7' ) ) {
				$css .= '.entry_cats ul.post-categories li:nth-child(9n+7) a {';
				$css .= 'background-color: ' . esc_attr( cream_magazine_get_option( 'cream_magazine_cat_bg_color_7' ) ) . ';';
				$css .= '}';
			}

			if ( cream_magazine_get_option( 'cream_magazine_cat_bg_color_8' ) ) {
				$css .= '.entry_cats ul.post-categories li:nth-child(9n+8) a {';
				$css .= 'background-color: ' . esc_attr( cream_magazine_get_option( 'cream_magazine_cat_bg_color_8' ) ) . ';';
				$css .= '}';
			}

			if ( cream_magazine_get_option( 'cream_magazine_cat_bg_color_9' ) ) {
				$css .= '.entry_cats ul.post-categories li:nth-child(9n+9) a {';
				$css .= 'background-color: ' . esc_attr( cream_magazine_get_option( 'cream_magazine_cat_bg_color_9' ) ) . ';';
				$css .= '}';
			}

			$css .= '.entry_cats ul.post-categories li a {';
			if ( cream_magazine_get_option( 'cream_magazine_common_cat_txt_color' ) ) {
				$css .= 'color: ' . esc_attr( cream_magazine_get_option( 'cream_magazine_common_cat_txt_color' ) ) . ';';
			}
			$css .= '}';

			$css .= '.entry_cats ul.post-categories li a:hover {';
			if ( cream_magazine_get_option( 'cream_magazine_cat_hover_bg_color' ) ) {
				$css .= 'background-color: ' . esc_attr( cream_magazine_get_option( 'cream_magazine_cat_hover_bg_color' ) ) . ';';
			}

			if ( cream_magazine_get_option( 'cream_magazine_cat_hover_txt_color' ) ) {
				$css .= 'color: ' . esc_attr( cream_magazine_get_option( 'cream_magazine_cat_hover_txt_color' ) ) . ';';
			}
			$css .= '}';
		}

		if ( cream_magazine_get_option( 'cream_magazine_content_link_color' ) ) {
			$css .= '.the_content a {';
			$css .= 'color: ' . esc_attr( cream_magazine_get_option( 'cream_magazine_content_link_color' ) ) . ';';
			$css .= '}';
		}

		if ( cream_magazine_get_option( 'cream_magazine_content_link_hover_color' ) ) {
			$css .= '.the_content a:hover {';
			$css .= 'color: ' . esc_attr( cream_magazine_get_option( 'cream_magazine_content_link_hover_color' ) ) . ';';
			$css .= '}';
		}

		if ( function_exists( 'rank_math' ) && rank_math()->settings->get( 'general.breadcrumbs' ) ) {
			$css .= '.rank-math-breadcrumb > p {';
			$css .= 'margin-bottom: 0;';
			$css .= '}';
		}

		$css .= '.post-display-grid .card_content .cm-post-excerpt {';
		$css .= 'margin-top: 15px;';
		$css .= '}';

		$css .= '</style>';

		echo cream_magazine_minify_css( $css ); // phpcs:ignore
	}
}
add_action( 'wp_head', 'cream_magazine_dynamic_styles', 10 );


if ( ! function_exists( 'cream_magazine_minify_css' ) ) {
	/**
	 * Simple minification of CSS codes.
	 *
	 * @since 2.1.2
	 *
	 * @param string $css CSS codes.
	 * @return string
	 */
	function cream_magazine_minify_css( $css ) {

		$css = preg_replace( '/\s+/', ' ', $css );
		$css = preg_replace( '/\/\*[^\!](.*?)\*\//', '', $css );
		$css = preg_replace( '/(,|:|;|\{|}) /', '$1', $css );
		$css = preg_replace( '/ (,|;|\{|})/', '$1', $css );
		$css = preg_replace( '/(:| )0\.([0-9]+)(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}.${2}${3}', $css );
		$css = preg_replace( '/(:| )(\.?)0(%|em|ex|px|in|cm|mm|pt|pc)/i', '${1}0', $css );

		return trim( (string) $css );
	}
}
