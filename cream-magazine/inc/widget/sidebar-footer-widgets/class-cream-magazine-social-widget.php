<?php
/**
 * Widget class definition for CM: Social Widget.
 *
 * @since 1.0.0
 *
 * @package Cream_Magazine
 */

/**
 * Widget class - Cream_Magazine_Social_Widget.
 *
 * @since 1.0.0
 *
 * @package Cream_Magazine
 */
class Cream_Magazine_Social_Widget extends WP_Widget {
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
			'cream-magazine-social-widget',
			esc_html__( 'CM: Social Widget', 'cream-magazine' ),
			array(
				'classname'   => 'social_widget_style_1',
				'description' => esc_html__( 'Displays links to social sites.', 'cream-magazine' ),
			)
		);

		$this->widget_setting_defaults = array(
			'title'           => '',
			'facebook_title'  => esc_html__( 'Like', 'cream-magazine' ),
			'facebook'        => '',
			'twitter_title'   => esc_html__( 'Follow', 'cream-magazine' ),
			'twitter'         => '',
			'instagram_title' => esc_html__( 'Follow', 'cream-magazine' ),
			'instagram'       => '',
			'linkedin_title'  => esc_html__( 'Connect', 'cream-magazine' ),
			'linkedin'        => '',
			'youtube_title'   => esc_html__( 'Follow', 'cream-magazine' ),
			'youtube'         => '',
			'pinterest_title' => esc_html__( 'Follow', 'cream-magazine' ),
			'pinterest'       => '',
		);

		$this->widget_setting_fields = array(
			'title'           => array(
				'type'  => 'text',
				'label' => esc_html__( 'Title', 'cream-magazine' ),
			),
			'facebook_title'  => array(
				'type'  => 'text',
				'label' => esc_html__( 'Facebook Link Label', 'cream-magazine' ),
			),
			'facebook'        => array(
				'type'  => 'url',
				'label' => esc_html__( 'Facebook Link', 'cream-magazine' ),
			),
			'twitter_title'   => array(
				'type'  => 'text',
				'label' => esc_html__( 'Twitter Link Label', 'cream-magazine' ),
			),
			'twitter'         => array(
				'type'  => 'url',
				'label' => esc_html__( 'Twitter Link', 'cream-magazine' ),
			),
			'instagram_title' => array(
				'type'  => 'text',
				'label' => esc_html__( 'Instagram Link Label', 'cream-magazine' ),
			),
			'instagram'       => array(
				'type'  => 'url',
				'label' => esc_html__( 'Instagram Link', 'cream-magazine' ),
			),
			'linkedin_title'  => array(
				'type'  => 'text',
				'label' => esc_html__( 'LinkedIn Link Label', 'cream-magazine' ),
			),
			'linkedin'        => array(
				'type'  => 'url',
				'label' => esc_html__( 'LinkedIn Link', 'cream-magazine' ),
			),
			'youtube_title'   => array(
				'type'  => 'text',
				'label' => esc_html__( 'YouTube Link Label', 'cream-magazine' ),
			),
			'youtube'         => array(
				'type'  => 'url',
				'label' => esc_html__( 'YouTube Link', 'cream-magazine' ),
			),
			'pinterest_title' => array(
				'type'  => 'text',
				'label' => esc_html__( 'Pinterest Link Label', 'cream-magazine' ),
			),
			'pinterest'       => array(
				'type'  => 'url',
				'label' => esc_html__( 'Pinterest Link', 'cream-magazine' ),
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

		if ( ! empty( $title ) ) {
			echo $args['before_title']; // phpcs:ignore
			echo esc_html( $title );
			echo $args['after_title']; // phpcs:ignore
		}
		?>
		<div class="widget-contents">
			<ul>
				<?php
				if ( isset( $instance['facebook'] ) ) {
					?>
					<li class="fb">
						<a href="<?php echo esc_url( $instance['facebook'] ); ?>" target="_blank">
							<i class="fa fa-facebook-f"></i><span><?php echo isset( $instance['facebook_title'] ) ? esc_html( $instance['facebook_title'] ) : esc_html( $widget_setting_defaults['facebook_title'] ); ?></span>
						</a>
					</li>
					<?php
				}
				if ( isset( $instance['twitter'] ) ) {
					?>
					<li class="tw">
						<a href="<?php echo esc_url( $instance['twitter'] ); ?>" target="_blank">
							<i class="fa fa-twitter"></i><span><?php echo isset( $instance['twitter_title'] ) ? esc_html( $instance['twitter_title'] ) : esc_html( $widget_setting_defaults['twitter_title'] ); ?></span>
						</a>
					</li>
					<?php
				}
				if ( isset( $instance['instagram'] ) ) {
					?>
					<li class="insta">
						<a href="<?php echo esc_url( $instance['instagram'] ); ?>" target="_blank">
							<i class="fa fa-instagram"></i><span><?php echo isset( $instance['instagram_title'] ) ? esc_html( $instance['instagram_title'] ) : esc_html( $widget_setting_defaults['instagram_title'] ); ?></span>
						</a>
					</li>
					<?php
				}
				if ( isset( $instance['linkedin'] ) ) {
					?>
					<li class="linken">
						<a href="<?php echo esc_url( $instance['linkedin'] ); ?>" target="_blank">
							<i class="fa fa-linkedin"></i><span><?php echo isset( $instance['linkedin_title'] ) ? esc_html( $instance['linkedin_title'] ) : esc_html( $widget_setting_defaults['linkedin_title'] ); ?></span>
						</a>
					</li>
					<?php
				}
				if ( isset( $instance['pinterest'] ) ) {
					?>
					<li class="pin">
						<a href="<?php echo esc_url( $instance['pinterest'] ); ?>" target="_blank">
							<i class="fa fa-pinterest"></i><span><?php echo isset( $instance['pinterest_title'] ) ? esc_html( $instance['pinterest_title'] ) : esc_html( $widget_setting_defaults['pinterest_title'] ); ?></span>
						</a>
					</li>
					<?php
				}
				if ( isset( $instance['youtube'] ) ) {
					?>
					<li class="yt">
						<a href="<?php echo esc_url( $instance['youtube'] ); ?>" target="_blank">
							<i class="fa fa-youtube-play"></i><span><?php echo isset( $instance['youtube_title'] ) ? esc_html( $instance['youtube_title'] ) : esc_html( $widget_setting_defaults['youtube_title'] ); ?></span>
						</a>
					</li>
					<?php
				}
				?>
			</ul>
		</div><!-- .widget-contents -->
		<?php

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
			<img src="<?php echo esc_url( get_template_directory_uri() . '/admin/images/widget-placeholders/cm-social-widget.png' ); ?>" style="max-width: 100%; height: auto;"> 
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
