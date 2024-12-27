<?php
/**
 * Template part for displaying posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Cream_Magazine
 */

$sidebar_position = cream_magazine_sidebar_position();
$post_class       = '';

if (
	'none' !== $sidebar_position &&
	is_active_sidebar( 'sidebar' )
) {
	$post_class = 'cm-col-lg-6 cm-col-md-6 cm-col-12';
} else {
	$post_class = 'cm-col-lg-4 cm-col-md-6 cm-col-12';
}

$show_categories_meta = true;
$show_author_meta     = true;
$show_date_meta       = true;
$show_cmnt_no_meta    = true;
$show_post_excerpt    = false;

if ( is_archive() ) {

	$show_categories_meta = cream_magazine_get_option( 'cream_magazine_enable_archive_categories_meta' );
	$show_author_meta     = cream_magazine_get_option( 'cream_magazine_enable_archive_author_meta' );
	$show_date_meta       = cream_magazine_get_option( 'cream_magazine_enable_archive_date_meta' );
	$show_cmnt_no_meta    = cream_magazine_get_option( 'cream_magazine_enable_archive_cmnts_no_meta' );
	$show_post_excerpt    = cream_magazine_get_option( 'cream_magazine_show_archive_post_excerpt' );
} elseif ( is_search() ) {

	$show_categories_meta = cream_magazine_get_option( 'cream_magazine_enable_search_categories_meta' );
	$show_author_meta     = cream_magazine_get_option( 'cream_magazine_enable_search_author_meta' );
	$show_date_meta       = cream_magazine_get_option( 'cream_magazine_enable_search_date_meta' );
	$show_cmnt_no_meta    = cream_magazine_get_option( 'cream_magazine_enable_search_cmnts_no_meta' );
	$show_post_excerpt    = cream_magazine_get_option( 'cream_magazine_show_search_post_excerpt' );
} else {

	$show_categories_meta = cream_magazine_get_option( 'cream_magazine_enable_blog_categories_meta' );
	$show_author_meta     = cream_magazine_get_option( 'cream_magazine_enable_blog_author_meta' );
	$show_date_meta       = cream_magazine_get_option( 'cream_magazine_enable_blog_date_meta' );
	$show_cmnt_no_meta    = cream_magazine_get_option( 'cream_magazine_enable_blog_cmnts_no_meta' );
	$show_post_excerpt    = cream_magazine_get_option( 'cream_magazine_show_blog_post_excerpt' );
}
?>
<div class="<?php echo esc_attr( $post_class ); ?>">
	<article id="post-<?php the_ID(); ?>" <?php post_class( 'grid-post-holder' ); ?>>
		<div class="card">
			<?php cream_magazine_post_thumbnail(); ?>
			<div class="card_content">
				<?php cream_magazine_post_categories_meta( $show_categories_meta ); ?>
				<div class="post_title">
					<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
				</div><!-- .post_title -->
				<?php cream_magazine_post_meta( $show_date_meta, $show_author_meta, $show_cmnt_no_meta, false ); ?> 
				<?php
				if ( $show_post_excerpt ) {
					?>
					<div class="cm-post-excerpt">
						<?php the_excerpt(); ?>
					</div>
					<?php
				}
				?>
			</div><!-- .card_content -->
		</div><!-- .card -->
	</article><!-- #post-<?php the_ID(); ?> -->
</div><!-- .col -->
