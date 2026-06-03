<?php
/**
 * Template helpers — keep section templates clean and ACF-optional.
 *
 * @package OSHC2026
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Get an ACF field with a safe fallback when ACF isn't active or the field is empty.
 *
 * @param string     $name    Field name.
 * @param mixed      $default Fallback value.
 * @param int|string $post_id Optional post/option id.
 * @return mixed
 */
function oshc_field( $name, $default = '', $post_id = false ) {
	if ( function_exists( 'get_field' ) ) {
		$value = get_field( $name, $post_id );
		if ( null !== $value && '' !== $value && false !== $value ) {
			return $value;
		}
	}
	return $default;
}

/**
 * Split a textarea value into a trimmed array of non-empty lines.
 *
 * @param string $value Raw textarea content.
 * @return string[]
 */
function oshc_lines( $value ) {
	if ( empty( $value ) ) {
		return array();
	}
	$lines = preg_split( '/\r\n|\r|\n/', (string) $value );
	$lines = array_map( 'trim', $lines );
	return array_values( array_filter( $lines, 'strlen' ) );
}

/**
 * Output an attribute-safe URL with a fallback of "#".
 *
 * @param string $url URL.
 * @return string
 */
function oshc_url( $url ) {
	$url = trim( (string) $url );
	return $url ? esc_url( $url ) : '#';
}

/**
 * Render one section template part.
 *
 * @param string $name Section slug under template-parts/sections/.
 */
function oshc_section( $name ) {
	get_template_part( 'template-parts/sections/' . $name );
}

/**
 * Query a custom post type ordered by menu_order then title.
 *
 * @param string $post_type Post type key.
 * @param array  $args      Extra WP_Query args.
 * @return WP_Query
 */
function oshc_query( $post_type, $args = array() ) {
	$defaults = array(
		'post_type'      => $post_type,
		'posts_per_page' => -1,
		'orderby'        => array(
			'menu_order' => 'ASC',
			'date'       => 'ASC',
		),
		'order'          => 'ASC',
		'no_found_rows'  => true,
	);
	return new WP_Query( wp_parse_args( $args, $defaults ) );
}
