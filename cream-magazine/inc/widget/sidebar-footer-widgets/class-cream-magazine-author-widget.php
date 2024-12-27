<?php
/**
 * Widget class definition for CM: Author Widget.
 *
 * @since 1.0.0
 *
 * @package Cream_Magazine
 */

/**
 * Widget class - Cream_Magazine_Author_Widget.
 *
 * @since 1.0.0
 *
 * @package Cream_Magazine
 */
class Cream_Magazine_Author_Widget extends WP_Widget {

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
			'cream-magazine-author-widget',
			esc_html__( 'CM: Author Widget', 'cream-magazine' ),
			array(
				'description' => esc_html__( 'Displays Brief Author Description.', 'cream-magazine' ),
			)
		);

		$this->widget_setting_defaults = array(
			'title'             => '',
			'author_page'       => '',
			'author_link_title' => '',
		);

		$this->widget_setting_fields = array(
			'title'             => array(
				'type'  => 'text',
				'label' => esc_html__( 'Title', 'cream-magazine' ),
			),
			'author_page'       => array(
				'type'      => 'select',
				'label'     => esc_html__( 'Author Page', 'cream-magazine' ),
				'choices'   => cream_magazine_get_pages_dropdown_choices(),
				'data_type' => 'number',
			),
			'author_link_title' => array(
				'type'  => 'text',
				'label' => esc_html__( 'Author Link Title', 'cream-magazine' ),
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

			$author_page_query_args = array(
				'post_type'      => 'page',
				'posts_per_page' => 1,
			);

			if ( isset( $instance['author_page'] ) ) {
				$author_page_query_args['page_id'] = absint( $instance['author_page'] );
			}

			$author = new WP_Query( $author_page_query_args );

			if ( $author->have_posts() ) {

				if ( ! empty( $title ) ) {
					echo $args['before_title']; // phpcs:ignore
					echo esc_html( $title );
					echo $args['after_title']; // phpcs:ignore
				}
				while ( $author->have_posts() ) {
					$author->the_post();
					?>
					<div class="cm_author_widget">
						<?php
						if ( has_post_thumbnail() ) {
							?>
							<div class="author_thumb <?php cream_magazine_thumbnail_class(); ?>">
								<?php cream_magazine_get_post_thumbnail( 'cream-magazine-thumbnail-3' ); ?>
							</div><!-- .author_thumb -->
							<?php
						}
						?>
						<div class="author_name">
							<h4><?php the_title(); ?></h4>
						</div><!-- .author_name -->
						<?php
						if ( get_the_excerpt() ) {
							?>
							<div class="author_desc">
								<?php the_excerpt(); ?>
							</div><!-- .author_desc -->
							<?php
						}

						if ( isset( $instance['author_link_title'] ) ) {
							?>
							<div class="author-detail-link">
								<a href="<?php the_permalink(); ?>"><?php echo isset( $instance['author_link_title'] ) ? esc_html( $instance['author_link_title'] ) : esc_html( $widget_setting_defaults['author_link_title'] ); ?></a>
							</div>
							<?php
						}
						?>
					</div><!-- .cm_author_widget -->
					<?php
				}
				wp_reset_postdata();
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
			<img src="<?php echo esc_url( get_template_directory_uri() . '/admin/images/widget-placeholders/cm-author-widget.png' ); ?>" style="max-width: 100%; height: auto;"> 
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
