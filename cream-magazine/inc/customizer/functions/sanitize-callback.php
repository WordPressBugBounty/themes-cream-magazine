<?php
/**
 * Collection of sanitization callback functions.
 *
 * @since 1.0.0
 *
 * @package Cream_Magazine
 */

if ( ! function_exists( 'cream_magazine_sanitize_multiple_cat_select' ) ) {
	/**
	 * Sanitizes multi select value.
	 *
	 * @param array  $value Setting value.
	 * @param object $setting Setting object.
	 * @return array
	 */
	function cream_magazine_sanitize_multiple_cat_select( $value, $setting ) {

		if ( ! empty( $value ) ) {

			return array_map( 'sanitize_text_field', $value );
		} else {
			return $setting->default;
		}
	}
}


if ( ! function_exists( 'cream_magazine_sanitize_select' ) ) {
	/**
	 * Sanitizes single select value.
	 *
	 * @param string $value Setting value.
	 * @param object $setting Setting object.
	 * @return string
	 */
	function cream_magazine_sanitize_select( $value, $setting ) {

		// Ensure input is a slug.
		$value = sanitize_key( $value );

		// Get list of choices from the control associated with the setting.
		$choices = $setting->manager->get_control( $setting->id )->choices;

		// If the input is a valid key, return it; otherwise, return the default.
		return ( array_key_exists( $value, $choices ) ? $value : $setting->default );
	}
}


if ( ! function_exists( 'cream_magazine_sanitize_number' ) ) {
	/**
	 * Sanitizes number value.
	 *
	 * @param string $value Setting value.
	 * @param object $setting Setting object.
	 * @return string
	 */
	function cream_magazine_sanitize_number( $value, $setting ) {

		$number = absint( $value );
		// If the input is a positibe number, return it; otherwise, return the default.
		return ( $number ? $number : $setting->default );
	}
}


if ( ! function_exists( 'cream_magazine_color_sanitize_callback' ) ) {
	/**
	 * Sanitizes RGBA color value.
	 *
	 * @param string $value Setting value.
	 * @param object $setting Setting object.
	 * @return string
	 */
	function cream_magazine_color_sanitize_callback( $value, $setting ) {

		// This pattern will check and match 3/6/8-character hex, rgb, rgba, hsl, & hsla colors.
		$pattern = '/^(\#[\da-f]{3}|\#[\da-f]{6}|\#[\da-f]{8}|rgba\(((\d{1,2}|1\d\d|2([0-4]\d|5[0-5]))\s*,\s*){2}((\d{1,2}|1\d\d|2([0-4]\d|5[0-5]))\s*)(,\s*(0\.\d+|1))\)|hsla\(\s*((\d{1,2}|[1-2]\d{2}|3([0-5]\d|60)))\s*,\s*((\d{1,2}|100)\s*%)\s*,\s*((\d{1,2}|100)\s*%)(,\s*(0\.\d+|1))\)|rgb\(((\d{1,2}|1\d\d|2([0-4]\d|5[0-5]))\s*,\s*){2}((\d{1,2}|1\d\d|2([0-4]\d|5[0-5]))\s*)|hsl\(\s*((\d{1,2}|[1-2]\d{2}|3([0-5]\d|60)))\s*,\s*((\d{1,2}|100)\s*%)\s*,\s*((\d{1,2}|100)\s*%)\))$/';

		\preg_match( $pattern, $value, $matches );

		// Return the 1st match found.
		if ( isset( $matches[0] ) ) {
			if ( is_string( $matches[0] ) ) {
				return $matches[0];
			}
			if ( is_array( $matches[0] ) && isset( $matches[0][0] ) ) {
				return $matches[0][0];
			}
		}

		// If no match was found, return an empty string.
		return $setting->default;
	}
}


if ( ! function_exists( 'cream_magazine_sanitize_font' ) ) {
	/**
	 * Sanitizes font control value.
	 *
	 * @param string $value Setting value.
	 * @param object $setting Setting object.
	 * @return string
	 */
	function cream_magazine_sanitize_font( $value, $setting ) {

		$value = json_decode( $value, true );

		$sanitized_value = array();

		if (
			! isset( $value['source'] ) ||
			(
				'google' !== $value['source'] &&
				'websafe' !== $value['source']
			)
		) {
			return $setting->default;
		} else {
			$sanitized_value['source'] = sanitize_text_field( $value['source'] );
		}

		if ( ! isset( $value['font_family'] ) ) {
			return $setting->value;
		} else {
			$sanitized_value['font_family'] = sanitize_text_field( $value['font_family'] );
		}

		if ( ! isset( $value['font_variants'] ) ) {
			return $setting->value;
		} else {
			$sanitized_value['font_variants'] = sanitize_text_field( $value['font_variants'] );
		}

		if ( ! isset( $value['font_url'] ) ) {
			return $setting->value;
		} else {
			$sanitized_value['font_url'] = sanitize_text_field( $value['font_url'] );
		}

		if ( ! isset( $value['font_weight'] ) ) {
			return $setting->value;
		} else {
			$sanitized_value['font_weight'] = sanitize_text_field( $value['font_weight'] );
		}

		return wp_json_encode( $sanitized_value );
	}
}
