<?php
/**
 * Collection of widget helper functions.
 *
 * @since 2.1.2
 *
 * @package Cream_Magazine
 */

if ( ! function_exists( 'cream_magazine_render_widget_setting_field' ) ) {
	/**
	 * Renders widget setting field.
	 *
	 * @since 2.1.2
	 *
	 * @param array $args Field arguments.
	 */
	function cream_magazine_render_widget_setting_field( $args ) {

		if ( ! isset( $args['type'] ) ) {

			return;
		}

		$field = '<p class="cm-widget-' . $args['type'] . '-field-wrapper">';

		switch ( $args['type'] ) {
			case 'number':
				$field .= '<label id="' . esc_attr( $args['id'] ) . '"><strong>' . $args['label'] . '</strong></label>';
				$field .= '<input type="number" class="widefat" id="' . esc_attr( $args['id'] ) . '" name="' . esc_attr( $args['name'] ) . '" value="' . esc_attr( $args['value'] ) . '" />';
				break;
			case 'checkbox':
				$field .= '<label id="' . esc_attr( $args['id'] ) . '">';
				$field .= '<input type="checkbox" id="' . esc_attr( $args['id'] ) . '" name="' . esc_attr( $args['name'] ) . '"' . ( ( true === $args['value'] ) ? 'checked' : '' ) . '/>';
				$field .= $args['label'];
				$field .= '</label>';
				break;
			case 'select':
				$field .= '<label id="' . esc_attr( $args['id'] ) . '"><strong>' . $args['label'] . '</strong></label>';
				$field .= '<select class="widefat" id="' . esc_attr( $args['id'] ) . '" name="' . esc_attr( $args['name'] ) . '">';
				foreach ( $args['choices'] as $option_value => $option_label ) {
					$field .= '<option value="' . esc_attr( $option_value ) . '"' . ( ( $args['value'] === $option_value ) ? 'selected' : '' ) . '>' . esc_html( $option_label ) . '</option>';
				}
				$field .= '</select>';
				break;
			case 'textarea':
				$field .= '<label id="' . esc_attr( $args['id'] ) . '"><strong>' . $args['label'] . '</strong></label>';
				$field .= '<textarea type="number" class="widefat" id="' . esc_attr( $args['id'] ) . '" name="' . esc_attr( $args['name'] ) . '">' . esc_attr( $args['value'] ) . '</textarea>';
				break;
			default:
				$field .= '<label id="' . esc_attr( $args['id'] ) . '"><strong>' . $args['label'] . '</strong></label>';
				$field .= '<input type="text" class="widefat" id="' . esc_attr( $args['id'] ) . '" name="' . esc_attr( $args['name'] ) . '" value="' . esc_attr( $args['value'] ) . '" />';
		}

		if ( isset( $args['description'] ) ) {
			$field .= '<small>' . esc_html( $args['description'] ) . '</small>';
		}

		$field .= '</p>';

		echo $field; // phpcs:ignore
	}
}

if ( ! function_exists( 'cream_magazine_sanitize_widget_setting_fields' ) ) {
	/**
	 * Sanitizes widget setting field values.
	 *
	 * @since 2.1.2
	 *
	 * @param array $widget_setting_fields Widget setting fields.
	 * @param array $widget_setting_defaults Default values of widget setting fields.
	 * @param array $new_instance The settings for the new instance of the widget.
	 * @param array $old_instance The settings for the old instance of the widget.
	 * @return array $instance Sanitized instance of the widget.
	 */
	function cream_magazine_sanitize_widget_setting_fields( $widget_setting_fields, $widget_setting_defaults, $new_instance, $old_instance ) {

		$instance = $old_instance;

		foreach ( $widget_setting_fields as $setting_field_id => $setting_field ) {

			switch ( $setting_field['type'] ) {
				case 'number':
					$instance[ $setting_field_id ] = isset( $new_instance[ $setting_field_id ] ) ? absint( $new_instance[ $setting_field_id ] ) : $widget_setting_defaults[ $setting_field_id ];
					break;
				case 'checkbox':
					$instance[ $setting_field_id ] = isset( $new_instance[ $setting_field_id ] ) ? true : false;
					break;
				case 'select':
					$select_value   = isset( $new_instance[ $setting_field_id ] ) ? $new_instance[ $setting_field_id ] : '';
					$select_choices = $setting_field['choices'];
					if ( isset( $setting_field['key'] ) ) {
						if ( 'slug' === $setting_field['key'] ) {
							$instance[ $setting_field_id ] = array_key_exists( $select_value, $select_choices ) ? sanitize_text_field( $select_value ) : $widget_setting_defaults[ $setting_field_id ];
						} else {
							$instance[ $setting_field_id ] = array_key_exists( $select_value, $select_choices ) ? absint( $select_value ) : $widget_setting_defaults[ $setting_field_id ];
						}
					} else {
						if ( isset( $setting_field['data_type'] ) && 'number' === $setting_field['data_type'] ) {
							$instance[ $setting_field_id ] = array_key_exists( $select_value, $select_choices ) ? absint( $select_value ) : $widget_setting_defaults[ $setting_field_id ];
						} else {
							$instance[ $setting_field_id ] = array_key_exists( $select_value, $select_choices ) ? sanitize_text_field( $select_value ) : $widget_setting_defaults[ $setting_field_id ];
						}
					}
					break;
				case 'text':
					$instance[ $setting_field_id ] = isset( $new_instance[ $setting_field_id ] ) ? sanitize_text_field( $new_instance[ $setting_field_id ] ) : $widget_setting_defaults[ $setting_field_id ];
					break;
				case 'textarea':
					$instance[ $setting_field_id ] = isset( $new_instance[ $setting_field_id ] ) ? sanitize_textarea_field( $new_instance[ $setting_field_id ] ) : $widget_setting_defaults[ $setting_field_id ];
					break;
				case 'url':
					$instance[ $setting_field_id ] = isset( $new_instance[ $setting_field_id ] ) ? esc_url_raw( $new_instance[ $setting_field_id ] ) : $widget_setting_defaults[ $setting_field_id ];
					break;
				default:
					$instance[ $setting_field_id ] = $widget_setting_defaults[ $setting_field_id ];
			}
		}

		return $instance;
	}
}



if ( ! function_exists( 'cream_magazine_get_category_dropdown_choices' ) ) {
	/**
	 * Generates choices for category dropdown.
	 *
	 * @since 2.1.2
	 *
	 * @param string $key Slug or ID.
	 */
	function cream_magazine_get_category_dropdown_choices( $key = 'slug' ) {

		return cream_magazine_get_post_taxonomy_select_choices( 'category', $key );
	}
}


if ( ! function_exists( 'cream_magazine_get_pages_dropdown_choices' ) ) {
	/**
	 * Generates choices for page select dropdown.
	 *
	 * @since 2.1.2
	 */
	function cream_magazine_get_pages_dropdown_choices() {

		$page_choices = array(
			0 => esc_html__( 'Select Page', 'cream-magazine' ),
		);

		$all_pages = get_pages();

		if ( $all_pages ) {

			foreach ( $all_pages as $page ) {

				$page_choices[ $page->ID ] = $page->post_title;
			}
		}

		return $page_choices;
	}
}
