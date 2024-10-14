<?php
/**
 * Constant definition and call theme's main file and run it.
 *
 * Eventually, some of the functionality here could be replaced by core features.
 *
 * @package Cream_Magazine
 */

$cream_magazine_theme = wp_get_theme( 'cream-magazine' );

define( 'CREAM_MAGAZINE_VERSION', $cream_magazine_theme->get( 'Version' ) );

require get_template_directory() . '/inc/class-cream-magazine.php';

/**
 * Theme's main function.
 *
 * @since 1.0.0
 */
function cream_magazine_run() {

	$cream_magazine = new Cream_Magazine();
}

cream_magazine_run();
