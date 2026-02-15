<?php
/**
 * The template for displaying all single posts
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/#single-post
 *
 * @package Cream_Magazine
 */

get_header();
?>
<div class="cm-container">
	<div class="inner-page-wrapper">
		<div id="primary" class="content-area">
			<main id="main" class="site-main">
				<div class="cm_post_page_lay_wrap">
					<?php
					/**
					 * Hook - cream_magazine_breadcrumb.
					 *
					 * @hooked cream_magazine_breadcrumb_action - 10
					 */
					do_action( 'cream_magazine_breadcrumb' );
					?>
					<div class="single-container">
						<div class="row">  
							<div class="<?php echo esc_attr( cream_magazine_main_container_class() ); ?>">
								<?php
								while ( have_posts() ) :

									the_post();

									get_template_part( 'template-parts/content', 'single' );

									get_template_part( 'template-parts/content', 'author' );

									the_post_navigation(
										array(
											'prev_text' => '<span class="cm-post-nav-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M9.4 233.4c-12.5 12.5-12.5 32.8 0 45.3l192 192c12.5 12.5 32.8 12.5 45.3 0s12.5-32.8 0-45.3L77.3 256 246.6 86.6c12.5-12.5 12.5-32.8 0-45.3s-32.8-12.5-45.3 0l-192 192z"/></svg></span>' . esc_html__( 'Prev', 'cream-magazine' ),
											'next_text' => esc_html__( 'Next', 'cream-magazine' ) . '<span class="cm-post-nav-icon"><svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 320 512"><path d="M310.6 233.4c12.5 12.5 12.5 32.8 0 45.3l-192 192c-12.5 12.5-32.8 12.5-45.3 0s-12.5-32.8 0-45.3L242.7 256 73.4 86.6c-12.5-12.5-12.5-32.8 0-45.3s32.8-12.5 45.3 0l192 192z"/></svg></span>',
										)
									);

									get_template_part( 'template-parts/content', 'related' );

									// If comments are open or we have at least one comment, load up the comment template.
									if ( comments_open() || get_comments_number() ) :
										comments_template();
									endif;

								endwhile; // End of the loop.
								?>
							</div><!-- .col -->
							<?php get_sidebar(); ?>
						</div><!-- .row -->
					</div><!-- .single-container -->
				</div><!-- .cm_post_page_lay_wrap -->
			</main><!-- #main.site-main -->
		</div><!-- #primary.content-area -->
	</div><!-- .inner-page-wrapper -->
</div><!-- .cm-container -->
<?php
get_footer();
