<?php
/**
 * Widget class definition for CM: Posts Widget.
 *
 * @since 1.0.0
 *
 * @package Cream_Magazine
 */

/**
 * Widget class - Cream_Magazine_Post_Widget.
 *
 * @since 1.0.0
 *
 * @package Cream_Magazine
 */
class Cream_Magazine_Post_Widget extends WP_Widget {

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
			'cream-magazine-post-widget',
			esc_html__( 'CM: Posts Widget', 'cream-magazine' ),
			array(
				'description' => esc_html__( 'Displays Recent, Most Commented or Editor Picked Posts.', 'cream-magazine' ),
			)
		);

		$this->widget_setting_defaults = array(
			'title'             => '',
			'post_choice'       => 'recent',
			'post_no'           => 5,
			'show_author_meta'  => true,
			'show_date_meta'    => true,
			'show_cmnt_no_meta' => true,
		);

		$this->widget_setting_fields = array(
			'title'             => array(
				'type'  => 'text',
				'label' => esc_html__( 'Title', 'cream-magazine' ),
			),
			'post_choice'       => array(
				'type'    => 'select',
				'label'   => esc_html__( 'Type of Posts', 'cream-magazine' ),
				'choices' => array(
					'recent'         => esc_html__( 'Recent Posts', 'cream-magazine' ),
					'most_commented' => esc_html__( 'Most Commented', 'cream-magazine' ),
				),
			),
			'post_no'           => array(
				'type'  => 'number',
				'label' => esc_html__( 'No of Posts', 'cream-magazine' ),
			),
			'show_author_meta'  => array(
				'type'  => 'checkbox',
				'label' => esc_html__( 'Show Post Author', 'cream-magazine' ),
			),
			'show_date_meta'    => array(
				'type'  => 'checkbox',
				'label' => esc_html__( 'Show Posted Date', 'cream-magazine' ),
			),
			'show_cmnt_no_meta' => array(
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

		echo $args['before_widget']; // phpcs:ignore

		$post_query_args = array(
			'posts_per_page' => isset( $instance['post_no'] ) ? absint( $instance['post_no'] ) : $widget_setting_defaults['post_no'],
			'post_type'      => 'post',
		);

		if ( isset( $instance['post_choice'] ) ) {

			if ( 'most_commented' === $instance['post_choice'] ) {
				$post_query_args['orderby'] = 'comment_count';
				$post_query_args['order']   = 'desc';
			}
		}

		$post_query = new WP_Query( $post_query_args );

		if ( $post_query->have_posts() ) {
			echo $args['before_title']; // phpcs:ignore
			echo esc_html( $title );
			echo $args['after_title']; // phpcs:ignore
			?>
			<div class="cm_recent_posts_widget">
				<?php
				while ( $post_query->have_posts() ) {

					$post_query->the_post();
					?>
					<div class="box">
						<div class="row">
							<?php
							if ( has_post_thumbnail() ) {
								?>
								<div class="cm-col-lg-5 cm-col-md-5 cm-col-4">
									<div class="<?php cream_magazine_thumbnail_class(); ?>">
										<?php cream_magazine_get_post_thumbnail( 'cream-magazine-thumbnail-3' ); ?>
									</div><!-- .post_thumb.imghover -->
								</div>
								<?php
							}
							?>
							<div class="<?php echo ( ! has_post_thumbnail() ) ? 'cm-col-lg-12 cm-col-md-12 cm-col-12' : 'cm-col-lg-7 cm-col-md-7 cm-col-8'; ?>">
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
							</div>
						</div><!-- .box.clearfix -->
					</div><!-- .row -->
					<?php
				}
				wp_reset_postdata();
				?>
			</div><!-- .cm_relatedpost_widget -->
			<?php
		}

		echo $args['after_widget']; // phpcs:ignore
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
			<img src="<?php echo esc_url( get_template_directory_uri() . '/admin/images/widget-placeholders/cm-post-widget.png' ); ?>" style="max-width: 100%; height: auto;"> 
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
	 * @return array Sanitized instance of the widget.
	 */
	public function update( $new_instance, $old_instance ) {

		return cream_magazine_sanitize_widget_setting_fields( $this->widget_setting_fields, $this->widget_setting_defaults, $new_instance, $old_instance );
	}
}
