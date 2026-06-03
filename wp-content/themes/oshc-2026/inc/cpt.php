<?php
/**
 * Custom post types & taxonomies for editor-managed, repeatable content.
 *
 * Using CPTs (instead of ACF Pro repeaters) keeps everything editable on the
 * free ACF plugin: editors Add New / Edit / Delete and drag to reorder.
 *
 * @package OSHC2026
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Shared labels builder.
 *
 * @param string $singular Singular label.
 * @param string $plural   Plural label.
 * @return array
 */
function oshc_cpt_labels( $singular, $plural ) {
	return array(
		'name'               => $plural,
		'singular_name'      => $singular,
		'add_new'            => __( 'Add New', 'oshc' ),
		/* translators: %s: singular name. */
		'add_new_item'       => sprintf( __( 'Add New %s', 'oshc' ), $singular ),
		/* translators: %s: singular name. */
		'edit_item'          => sprintf( __( 'Edit %s', 'oshc' ), $singular ),
		/* translators: %s: singular name. */
		'new_item'           => sprintf( __( 'New %s', 'oshc' ), $singular ),
		/* translators: %s: plural name. */
		'all_items'          => $plural,
		/* translators: %s: singular name. */
		'view_item'          => sprintf( __( 'View %s', 'oshc' ), $singular ),
		/* translators: %s: plural name. */
		'search_items'       => sprintf( __( 'Search %s', 'oshc' ), $plural ),
		'menu_name'          => $plural,
	);
}

/**
 * Register all OSHC content types.
 */
function oshc_register_cpts() {

	register_post_type(
		'oshc_faculty',
		array(
			'labels'       => oshc_cpt_labels( __( 'Faculty', 'oshc' ), __( 'Faculty', 'oshc' ) ),
			'public'       => false,
			'show_ui'      => true,
			'show_in_rest' => true,
			'menu_icon'    => 'dashicons-groups',
			'menu_position'=> 21,
			'supports'     => array( 'title', 'thumbnail', 'page-attributes' ),
			'has_archive'  => false,
			'rewrite'      => false,
		)
	);

	register_post_type(
		'oshc_committee',
		array(
			'labels'       => oshc_cpt_labels( __( 'Committee Member', 'oshc' ), __( 'Committee', 'oshc' ) ),
			'public'       => false,
			'show_ui'      => true,
			'show_in_rest' => true,
			'menu_icon'    => 'dashicons-businessperson',
			'menu_position'=> 22,
			'supports'     => array( 'title', 'thumbnail', 'page-attributes' ),
			'has_archive'  => false,
			'rewrite'      => false,
		)
	);

	register_taxonomy(
		'oshc_committee_type',
		'oshc_committee',
		array(
			'labels'            => array(
				'name'          => __( 'Committee Types', 'oshc' ),
				'singular_name' => __( 'Committee Type', 'oshc' ),
				'menu_name'     => __( 'Committee Types', 'oshc' ),
			),
			'public'            => false,
			'show_ui'           => true,
			'show_admin_column' => true,
			'hierarchical'      => true,
			'show_in_rest'      => true,
			'rewrite'           => false,
		)
	);

	register_post_type(
		'oshc_date',
		array(
			'labels'       => oshc_cpt_labels( __( 'Important Date', 'oshc' ), __( 'Important Dates', 'oshc' ) ),
			'public'       => false,
			'show_ui'      => true,
			'show_in_rest' => true,
			'menu_icon'    => 'dashicons-calendar-alt',
			'menu_position'=> 23,
			'supports'     => array( 'title', 'page-attributes' ),
			'has_archive'  => false,
			'rewrite'      => false,
		)
	);

	register_post_type(
		'oshc_pricing',
		array(
			'labels'       => oshc_cpt_labels( __( 'Pricing Tier', 'oshc' ), __( 'Pricing Tiers', 'oshc' ) ),
			'public'       => false,
			'show_ui'      => true,
			'show_in_rest' => true,
			'menu_icon'    => 'dashicons-tickets-alt',
			'menu_position'=> 24,
			'supports'     => array( 'title', 'page-attributes' ),
			'has_archive'  => false,
			'rewrite'      => false,
		)
	);

	register_post_type(
		'oshc_gallery',
		array(
			'labels'       => oshc_cpt_labels( __( 'Gallery Image', 'oshc' ), __( 'Gallery', 'oshc' ) ),
			'public'       => false,
			'show_ui'      => true,
			'show_in_rest' => true,
			'menu_icon'    => 'dashicons-format-gallery',
			'menu_position'=> 25,
			'supports'     => array( 'title', 'thumbnail', 'page-attributes' ),
			'has_archive'  => false,
			'rewrite'      => false,
		)
	);

	register_post_type(
		'oshc_faq',
		array(
			'labels'       => oshc_cpt_labels( __( 'FAQ', 'oshc' ), __( 'FAQs', 'oshc' ) ),
			'public'       => false,
			'show_ui'      => true,
			'show_in_rest' => true,
			'menu_icon'    => 'dashicons-editor-help',
			'menu_position'=> 26,
			'supports'     => array( 'title', 'editor', 'page-attributes' ),
			'has_archive'  => false,
			'rewrite'      => false,
		)
	);

	register_taxonomy(
		'oshc_faq_group',
		'oshc_faq',
		array(
			'labels'            => array(
				'name'          => __( 'FAQ Groups', 'oshc' ),
				'singular_name' => __( 'FAQ Group', 'oshc' ),
				'menu_name'     => __( 'FAQ Groups', 'oshc' ),
			),
			'public'            => false,
			'show_ui'           => true,
			'show_admin_column' => true,
			'hierarchical'      => true,
			'show_in_rest'      => true,
			'rewrite'           => false,
		)
	);
}
add_action( 'init', 'oshc_register_cpts' );

/**
 * Make the FAQ list editor field labelled as the "Answer".
 */
function oshc_faq_editor_label( $title, $post ) {
	if ( $post && 'oshc_faq' === $post->post_type ) {
		return __( 'Question (e.g. "Can I get a refund?")', 'oshc' );
	}
	return $title;
}
add_filter( 'enter_title_here', 'oshc_faq_editor_label', 10, 2 );
