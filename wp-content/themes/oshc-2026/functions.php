<?php
/**
 * OSHC 2026 theme bootstrap.
 *
 * @package OSHC2026
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'OSHC_VERSION', '1.0.1' );
define( 'OSHC_DIR', get_template_directory() );
define( 'OSHC_URI', get_template_directory_uri() );

/**
 * Theme supports & nav menus.
 */
function oshc_setup() {
	add_theme_support( 'title-tag' );
	add_theme_support( 'post-thumbnails' );
	add_theme_support( 'automatic-feed-links' );
	add_theme_support( 'html5', array( 'search-form', 'gallery', 'caption', 'style', 'script' ) );
	add_theme_support(
		'custom-logo',
		array(
			'height'      => 80,
			'width'       => 240,
			'flex-height' => true,
			'flex-width'  => true,
		)
	);

	register_nav_menus(
		array(
			'primary' => __( 'Primary (anchor) menu', 'oshc' ),
		)
	);
}
add_action( 'after_setup_theme', 'oshc_setup' );

/**
 * Front-end assets.
 */
function oshc_assets() {
	// Google Fonts: Montserrat (headings) + Open Sans (body) — matches the source brand.
	wp_enqueue_style(
		'oshc-fonts',
		'https://fonts.googleapis.com/css2?family=Montserrat:wght@500;600;700;800&family=Open+Sans:wght@400;500;600;700&display=swap',
		array(),
		null
	);

	wp_enqueue_style( 'oshc-main', OSHC_URI . '/assets/css/main.css', array( 'oshc-fonts' ), OSHC_VERSION );

	wp_enqueue_script( 'oshc-main', OSHC_URI . '/assets/js/main.js', array(), OSHC_VERSION, true );
}
add_action( 'wp_enqueue_scripts', 'oshc_assets' );

/**
 * Includes.
 */
require_once OSHC_DIR . '/inc/helpers.php';
require_once OSHC_DIR . '/inc/cpt.php';
require_once OSHC_DIR . '/inc/acf-fields.php';
require_once OSHC_DIR . '/inc/setup-content.php';

/**
 * Admin notice if ACF is missing — the theme degrades gracefully, but editors
 * lose the structured fields, so make it obvious.
 */
function oshc_acf_notice() {
	if ( function_exists( 'get_field' ) ) {
		return;
	}
	echo '<div class="notice notice-warning"><p><strong>OSHC 2026 theme:</strong> ';
	echo 'Please install &amp; activate the free <em>Advanced Custom Fields</em> plugin so editors can manage page content.';
	echo '</p></div>';
}
add_action( 'admin_notices', 'oshc_acf_notice' );
