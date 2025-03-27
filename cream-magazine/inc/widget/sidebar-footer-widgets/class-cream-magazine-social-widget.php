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
				'label' => esc_html__( 'Twitter/X Link Label', 'cream-magazine' ),
			),
			'twitter'         => array(
				'type'  => 'url',
				'label' => esc_html__( 'Twitter/X Link', 'cream-magazine' ),
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
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M512 256C512 114.6 397.4 0 256 0S0 114.6 0 256C0 376 82.7 476.8 194.2 504.5V334.2H141.4V256h52.8V222.3c0-87.1 39.4-127.5 125-127.5c16.2 0 44.2 3.2 55.7 6.4V172c-6-.6-16.5-1-29.6-1c-42 0-58.2 15.9-58.2 57.2V256h83.6l-14.4 78.2H287V510.1C413.8 494.8 512 386.9 512 256h0z"/></svg><span><?php echo isset( $instance['facebook_title'] ) ? esc_html( $instance['facebook_title'] ) : esc_html( $widget_setting_defaults['facebook_title'] ); ?></span>
						</a>
					</li>
					<?php
				}
				if ( isset( $instance['twitter'] ) ) {
					?>
					<li class="tw">
						<a href="<?php echo esc_url( $instance['twitter'] ); ?>" target="_blank">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512"><path d="M389.2 48h70.6L305.6 224.2 487 464H345L233.7 318.6 106.5 464H35.8L200.7 275.5 26.8 48H172.4L272.9 180.9 389.2 48zM364.4 421.8h39.1L151.1 88h-42L364.4 421.8z"/></svg><span><?php echo isset( $instance['twitter_title'] ) ? esc_html( $instance['twitter_title'] ) : esc_html( $widget_setting_defaults['twitter_title'] ); ?></span>
						</a>
					</li>
					<?php
				}
				if ( isset( $instance['instagram'] ) ) {
					?>
					<li class="insta">
						<a href="<?php echo esc_url( $instance['instagram'] ); ?>" target="_blank">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M224.1 141c-63.6 0-114.9 51.3-114.9 114.9s51.3 114.9 114.9 114.9S339 319.5 339 255.9 287.7 141 224.1 141zm0 189.6c-41.1 0-74.7-33.5-74.7-74.7s33.5-74.7 74.7-74.7 74.7 33.5 74.7 74.7-33.6 74.7-74.7 74.7zm146.4-194.3c0 14.9-12 26.8-26.8 26.8-14.9 0-26.8-12-26.8-26.8s12-26.8 26.8-26.8 26.8 12 26.8 26.8zm76.1 27.2c-1.7-35.9-9.9-67.7-36.2-93.9-26.2-26.2-58-34.4-93.9-36.2-37-2.1-147.9-2.1-184.9 0-35.8 1.7-67.6 9.9-93.9 36.1s-34.4 58-36.2 93.9c-2.1 37-2.1 147.9 0 184.9 1.7 35.9 9.9 67.7 36.2 93.9s58 34.4 93.9 36.2c37 2.1 147.9 2.1 184.9 0 35.9-1.7 67.7-9.9 93.9-36.2 26.2-26.2 34.4-58 36.2-93.9 2.1-37 2.1-147.8 0-184.8zM398.8 388c-7.8 19.6-22.9 34.7-42.6 42.6-29.5 11.7-99.5 9-132.1 9s-102.7 2.6-132.1-9c-19.6-7.8-34.7-22.9-42.6-42.6-11.7-29.5-9-99.5-9-132.1s-2.6-102.7 9-132.1c7.8-19.6 22.9-34.7 42.6-42.6 29.5-11.7 99.5-9 132.1-9s102.7-2.6 132.1 9c19.6 7.8 34.7 22.9 42.6 42.6 11.7 29.5 9 99.5 9 132.1s2.7 102.7-9 132.1z"/></svg><span><?php echo isset( $instance['instagram_title'] ) ? esc_html( $instance['instagram_title'] ) : esc_html( $widget_setting_defaults['instagram_title'] ); ?></span>
						</a>
					</li>
					<?php
				}
				if ( isset( $instance['linkedin'] ) ) {
					?>
					<li class="linken">
						<a href="<?php echo esc_url( $instance['linkedin'] ); ?>" target="_blank">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 448 512"><path d="M100.3 448H7.4V148.9h92.9zM53.8 108.1C24.1 108.1 0 83.5 0 53.8a53.8 53.8 0 0 1 107.6 0c0 29.7-24.1 54.3-53.8 54.3zM447.9 448h-92.7V302.4c0-34.7-.7-79.2-48.3-79.2-48.3 0-55.7 37.7-55.7 76.7V448h-92.8V148.9h89.1v40.8h1.3c12.4-23.5 42.7-48.3 87.9-48.3 94 0 111.3 61.9 111.3 142.3V448z"/></svg><span><?php echo isset( $instance['linkedin_title'] ) ? esc_html( $instance['linkedin_title'] ) : esc_html( $widget_setting_defaults['linkedin_title'] ); ?></span>
						</a>
					</li>
					<?php
				}
				if ( isset( $instance['pinterest'] ) ) {
					?>
					<li class="pin">
						<a href="<?php echo esc_url( $instance['pinterest'] ); ?>" target="_blank">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 496 512"><path d="M496 256c0 137-111 248-248 248-25.6 0-50.2-3.9-73.4-11.1 10.1-16.5 25.2-43.5 30.8-65 3-11.6 15.4-59 15.4-59 8.1 15.4 31.7 28.5 56.8 28.5 74.8 0 128.7-68.8 128.7-154.3 0-81.9-66.9-143.2-152.9-143.2-107 0-163.9 71.8-163.9 150.1 0 36.4 19.4 81.7 50.3 96.1 4.7 2.2 7.2 1.2 8.3-3.3 .8-3.4 5-20.3 6.9-28.1 .6-2.5 .3-4.7-1.7-7.1-10.1-12.5-18.3-35.3-18.3-56.6 0-54.7 41.4-107.6 112-107.6 60.9 0 103.6 41.5 103.6 100.9 0 67.1-33.9 113.6-78 113.6-24.3 0-42.6-20.1-36.7-44.8 7-29.5 20.5-61.3 20.5-82.6 0-19-10.2-34.9-31.4-34.9-24.9 0-44.9 25.7-44.9 60.2 0 22 7.4 36.8 7.4 36.8s-24.5 103.8-29 123.2c-5 21.4-3 51.6-.9 71.2C65.4 450.9 0 361.1 0 256 0 119 111 8 248 8s248 111 248 248z"/></svg><span><?php echo isset( $instance['pinterest_title'] ) ? esc_html( $instance['pinterest_title'] ) : esc_html( $widget_setting_defaults['pinterest_title'] ); ?></span>
						</a>
					</li>
					<?php
				}
				if ( isset( $instance['youtube'] ) ) {
					?>
					<li class="yt">
						<a href="<?php echo esc_url( $instance['youtube'] ); ?>" target="_blank">
							<svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 576 512"><path d="M549.7 124.1c-6.3-23.7-24.8-42.3-48.3-48.6C458.8 64 288 64 288 64S117.2 64 74.6 75.5c-23.5 6.3-42 24.9-48.3 48.6-11.4 42.9-11.4 132.3-11.4 132.3s0 89.4 11.4 132.3c6.3 23.7 24.8 41.5 48.3 47.8C117.2 448 288 448 288 448s170.8 0 213.4-11.5c23.5-6.3 42-24.2 48.3-47.8 11.4-42.9 11.4-132.3 11.4-132.3s0-89.4-11.4-132.3zm-317.5 213.5V175.2l142.7 81.2-142.7 81.2z"/></svg><span><?php echo isset( $instance['youtube_title'] ) ? esc_html( $instance['youtube_title'] ) : esc_html( $widget_setting_defaults['youtube_title'] ); ?></span>
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
