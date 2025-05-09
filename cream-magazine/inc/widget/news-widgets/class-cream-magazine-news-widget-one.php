<?php
/**
 * Widget class definition for CM Full: News Widget 1.
 *
 * @since 1.0.0
 *
 * @package Cream_Magazine
 */

/**
 * Widget class - Cream_Magazine_News_Widget_One.
 *
 * @since 1.0.0
 *
 * @package Cream_Magazine
 */
class Cream_Magazine_News_Widget_One extends WP_Widget {

	/**
	 * Slug or ID value.
	 *
	 * @since 2.1.2
	 *
	 * @var string
	 */
	public $key = 'slug';

	/**
	 * Widget setting default values.
	 *
	 * @since 2.1.2
	 *
	 * @var array
	 */
	public $widget_setting_defaults = array();

	/**
	 * Widget setting fields.
	 *
	 * @since 2.1.2
	 *
	 * @var array
	 */
	public $widget_setting_fields = array();

	/**
	 * Define id, name and description of the widget.
	 *
	 * @since 1.0.0
	 */
	public function __construct() {

		parent::__construct(
			'cream-magazine-news-widget-one',
			esc_html__( 'CM Full: News Widget 1', 'cream-magazine' ),
			array(
				'description' => esc_html__( 'Displays posts of selected category.', 'cream-magazine' ),
			)
		);

		$this->key = cream_magazine_get_option( 'cream_magazine_save_value_as' );

		$this->widget_setting_defaults = array(
			'title'                => '',
			'post_cat'             => ( 'slug' === $this->key ) ? 'none' : 0,
			'post_no'              => 6,
			'show_categories_meta' => true,
			'show_author_meta'     => true,
			'show_date_meta'       => true,
			'show_cmnt_no_meta'    => true,
		);

		$this->widget_setting_fields = array(
			'title'                => array(
				'type'  => 'text',
				'label' => esc_html__( 'Title', 'cream-magazine' ),
			),
			'post_cat'             => array(
				'type'        => 'select',
				'label'       => esc_html__( 'Select Category', 'cream-magazine' ),
				'description' => esc_html__( 'If no category is selected, then recent posts will be displayed.', 'cream-magazine' ),
				'choices'     => cream_magazine_get_category_dropdown_choices( $this->key ),
				'key'         => $this->key,
			),
			'post_no'              => array(
				'type'  => 'number',
				'label' => esc_html__( 'No of Posts', 'cream-magazine' ),
			),
			'show_categories_meta' => array(
				'type'  => 'checkbox',
				'label' => esc_html__( 'Show Post Categories', 'cream-magazine' ),
			),
			'show_author_meta'     => array(
				'type'  => 'checkbox',
				'label' => esc_html__( 'Show Post Author', 'cream-magazine' ),
			),
			'show_date_meta'       => array(
				'type'  => 'checkbox',
				'label' => esc_html__( 'Show Posted Date', 'cream-magazine' ),
			),
			'show_cmnt_no_meta'    => array(
				'type'  => 'checkbox',
				'label' => esc_html__( 'Show Post Comments Number', 'cream-magazine' ),
			),
		);
	}

	/**
	 * Renders widget at the frontend.
	 *
	 * @since 1.0.0
	 *
	 * @param array $args Provides the HTML you can use to display the widget title class and widget content class.
	 * @param array $instance The settings for the instance of the widget..
	 */
	public function widget( $args, $instance ) {

		$title = apply_filters( 'widget_title', empty( $instance['title'] ) ? '' : $instance['title'], $instance, $this->id_base );

		$widget_setting_defaults = $this->widget_setting_defaults;

		$post_args = array(
			'post_type'           => 'post',
			'ignore_sticky_posts' => true,
			'posts_per_page'      => isset( $instance['post_no'] ) ? absint( $instance['post_no'] ) : $widget_setting_defaults['post_no'],
		);

		if ( 'slug' === $this->key ) {
			if ( isset( $instance['post_cat'] ) && 'none' !== $instance['post_cat'] ) {
				$post_args['category_name'] = $instance['post_cat'];
			}
		} else {
			$post_args['cat'] = isset( $instance['post_cat'] ) ? absint( $instance['post_cat'] ) : $widget_setting_defaults['post_cat'];
		}

		$post_query = new WP_Query( $post_args );

		if ( $post_query->have_posts() ) {
			?>
			<section class="cm-post-widget-section cm-post-widget-two">
				<div class="section_inner">
					<?php
					if ( ! empty( $title ) ) {
						?>
						<div class="section-title">
							<h2><?php echo esc_html( $title ); ?></h2>
						</div><!-- .section-title -->
						<?php
					}
					?>
					<div class="row cm-row-large-posts">
						<?php
						$count = 0;
						while ( $post_query->have_posts() ) {
							$post_query->the_post();

							if ( $count <= 1 ) {
								?>
								<div class="cm-col-lg-6 cm-col-md-12 cm-col-12">
									<article class="big-card">
										<div class="<?php cream_magazine_thumbnail_class(); ?>">
											<?php
											if ( has_post_thumbnail() ) {
												cream_magazine_get_post_thumbnail( 'cream-magazine-thumbnail-2' );
											}
											?>
											<div class="post-holder">
												<?php cream_magazine_post_categories_meta( isset( $instance['show_categories_meta'] ) ? $instance['show_categories_meta'] : $widget_setting_defaults['show_categories_meta'] ); ?>
												<div class="post_title">
													<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
												</div>
												<?php
												cream_magazine_post_meta(
													isset( $instance['show_date_meta'] ) ? $instance['show_date_meta'] : $widget_setting_defaults['show_date_meta'],
													isset( $instance['show_author_meta'] ) ? $instance['show_author_meta'] : $widget_setting_defaults['show_author_meta'],
													isset( $instance['show_cmnt_no_meta'] ) ? $instance['show_cmnt_no_meta'] : $widget_setting_defaults['show_cmnt_no_meta'],
													false
												);
												?>
											</div><!-- .post-holder -->
										</div><!-- .post_thumb -->
									</article><!-- .card -->
									<!-- <div class="mask"></div> --><!-- .mask -->
								</div><!-- .col -->
								<?php
							}
							$count++;
						}
						wp_reset_postdata();
						?>
					</div><!-- .row.clearfix -->
					<div class="row cm-row-small-posts">
						<?php
						$count = 0;
						while ( $post_query->have_posts() ) {
							$post_query->the_post();

							if ( $count > 1 ) {
								?>
								<div class="cm-col-lg-3 cm-col-md-6 cm-col-12">
									<div class="small-card">
										<div class="<?php cream_magazine_thumbnail_class(); ?>">
											<?php
											if ( has_post_thumbnail() ) {
												cream_magazine_get_post_thumbnail( 'cream-magazine-thumbnail-2' );
											}
											?>
										</div><!-- .post_thumb -->
										<div class="post-holder">
											<div class="post_title">
												<h2><a href="<?php the_permalink(); ?>"><?php the_title(); ?></a></h2>
											</div>
											<?php
											cream_magazine_post_meta(
												$instance['show_date_meta'],
												$instance['show_author_meta'],
												$instance['show_cmnt_no_meta'],
												false
											);
											?>
										</div><!-- .post-holder -->
									</div><!-- .small-card -->
									<!-- <div class="mask"></div> --><!-- .mask -->
								</div><!-- .col -->
								<?php
							}
							$count++;
						}
						wp_reset_postdata();
						?>
					</div><!-- .row -->
				</div><!-- .section_inner -->
			</section><!-- .cm-post-widget-two -->
			<?php
		}
	}

	/**
	 * Adds setting fields to the widget and renders them in the form.
	 *
	 * @since 1.0.0
	 *
	 * @param array $instance The settings for the instance of the widget..
	 */
	public function form( $instance ) {

		$instance = wp_parse_args( (array) $instance, $this->widget_setting_defaults );

		$widget_setting_fields = $this->widget_setting_fields;

		$widget_setting_fields_copy = $widget_setting_fields;

		foreach ( $widget_setting_fields_copy as $widget_setting_key => $widget_setting_field_detail ) {
			$widget_setting_fields[ $widget_setting_key ]['id']    = $this->get_field_id( $widget_setting_key );
			$widget_setting_fields[ $widget_setting_key ]['name']  = $this->get_field_name( $widget_setting_key );
			$widget_setting_fields[ $widget_setting_key ]['value'] = $instance[ $widget_setting_key ];
		}
		?>
		<p class="cm-widget-frontend-sample-wrapper">
			<strong><?php esc_html_e( 'At frontend this widget looks like as below:', 'cream-magazine' ); ?></strong> 
			<img src="<?php echo esc_url( get_template_directory_uri() . '/admin/images/widget-placeholders/cm-full-widget-one.png' ); ?>" style="max-width: 100%; height: auto;"> 
		</p>
		<?php
		foreach ( $widget_setting_fields as $field ) {

			cream_magazine_render_widget_setting_field( $field );
		}
	}

	/**
	 * Sanitizes and saves the instance of the widget.
	 *
	 * @since 1.0.0
	 *
	 * @param array $new_instance The settings for the new instance of the widget.
	 * @param array $old_instance The settings for the old instance of the widget.
	 * @return array $instance Sanitized instance of the widget.
	 */
	public function update( $new_instance, $old_instance ) {

		return cream_magazine_sanitize_widget_setting_fields( $this->widget_setting_fields, $this->widget_setting_defaults, $new_instance, $old_instance );
	}
}
