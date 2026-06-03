<?php
/**
 * ACF field groups, registered in code so they ship with the theme and need
 * no manual setup on the server. Works with the FREE Advanced Custom Fields
 * plugin (no Pro-only field types are used).
 *
 * @package OSHC2026
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * Small helpers to keep the definitions readable.
 */
function oshc_f( $key, $label, $name, $type = 'text', $extra = array() ) {
	return array_merge(
		array(
			'key'   => 'field_oshc_' . $key,
			'label' => $label,
			'name'  => $name,
			'type'  => $type,
		),
		$extra
	);
}
function oshc_tab( $key, $label ) {
	return array(
		'key'       => 'field_oshc_tab_' . $key,
		'label'     => $label,
		'type'      => 'tab',
		'placement' => 'left',
	);
}
function oshc_img( $key, $label, $name, $instructions = '' ) {
	return oshc_f(
		$key,
		$label,
		$name,
		'image',
		array(
			'return_format' => 'array',
			'preview_size'  => 'medium',
			'library'       => 'all',
			'instructions'  => $instructions,
		)
	);
}

add_action(
	'acf/init',
	function () {
		if ( ! function_exists( 'acf_add_local_field_group' ) ) {
			return;
		}

		/* ---------------------------------------------------------------
		 * FRONT PAGE — all section text, edited on the "Home" page.
		 * --------------------------------------------------------------- */
		acf_add_local_field_group(
			array(
				'key'      => 'group_oshc_front',
				'title'    => __( 'OSHC Home Page Content', 'oshc' ),
				'location' => array(
					array(
						array(
							'param'    => 'page_type',
							'operator' => '==',
							'value'    => 'front_page',
						),
					),
				),
				'menu_order'            => 0,
				'position'              => 'normal',
				'style'                 => 'default',
				'hide_on_screen'        => array( 'the_content' ),
				'fields'   => array(

					// --- Top bar & Hero ---
					oshc_tab( 'hero', __( 'Top bar & Hero', 'oshc' ) ),
					oshc_f( 'banner_text', __( 'Top banner text', 'oshc' ), 'banner_text', 'text', array( 'instructions' => __( 'e.g. "Early Bird Registration Closes : Sept 8". Leave blank to hide.', 'oshc' ) ) ),
					oshc_f( 'banner_url', __( 'Top banner link', 'oshc' ), 'banner_url', 'url' ),
					oshc_f( 'hero_subheading', __( 'Hero — small line above title', 'oshc' ), 'hero_subheading', 'text' ),
					oshc_f( 'hero_heading', __( 'Hero — main heading', 'oshc' ), 'hero_heading', 'text' ),
					oshc_f( 'hero_dateline', __( 'Hero — date & location line', 'oshc' ), 'hero_dateline', 'text' ),
					oshc_f( 'hero_intro', __( 'Hero — intro paragraph', 'oshc' ), 'hero_intro', 'textarea', array( 'rows' => 4 ) ),
					oshc_f( 'register_url', __( 'Register button URL', 'oshc' ), 'register_url', 'url' ),
					oshc_img( 'hero_bg', __( 'Hero background image', 'oshc' ), 'hero_bg', __( 'Optional. A theme default is used if empty.', 'oshc' ) ),

					// --- Stats ---
					oshc_tab( 'stats', __( 'Stats bar', 'oshc' ) ),
					oshc_f( 'stat1_number', __( 'Stat 1 — number', 'oshc' ), 'stat1_number', 'text' ),
					oshc_f( 'stat1_label', __( 'Stat 1 — label', 'oshc' ), 'stat1_label', 'text' ),
					oshc_f( 'stat1_text', __( 'Stat 1 — description', 'oshc' ), 'stat1_text', 'text' ),
					oshc_f( 'stat2_number', __( 'Stat 2 — number', 'oshc' ), 'stat2_number', 'text' ),
					oshc_f( 'stat2_label', __( 'Stat 2 — label', 'oshc' ), 'stat2_label', 'text' ),
					oshc_f( 'stat2_text', __( 'Stat 2 — description', 'oshc' ), 'stat2_text', 'text' ),
					oshc_f( 'stat3_number', __( 'Stat 3 — number', 'oshc' ), 'stat3_number', 'text' ),
					oshc_f( 'stat3_label', __( 'Stat 3 — label', 'oshc' ), 'stat3_label', 'text' ),
					oshc_f( 'stat3_text', __( 'Stat 3 — description', 'oshc' ), 'stat3_text', 'text' ),
					oshc_f( 'stat4_number', __( 'Stat 4 — number', 'oshc' ), 'stat4_number', 'text' ),
					oshc_f( 'stat4_label', __( 'Stat 4 — label', 'oshc' ), 'stat4_label', 'text' ),
					oshc_f( 'stat4_text', __( 'Stat 4 — description', 'oshc' ), 'stat4_text', 'text' ),

					// --- Welcome & Committee ---
					oshc_tab( 'welcome', __( 'Welcome & Committee', 'oshc' ) ),
					oshc_f( 'welcome_remarks', __( 'Welcome remarks', 'oshc' ), 'welcome_remarks', 'wysiwyg', array( 'media_upload' => 0 ) ),
					oshc_f( 'chair_name', __( 'Chair — name', 'oshc' ), 'chair_name', 'text' ),
					oshc_f( 'chair_role', __( 'Chair — role lines', 'oshc' ), 'chair_role', 'textarea', array( 'rows' => 3, 'instructions' => __( 'One line per role, e.g. "Conference Chairman" / "President".', 'oshc' ) ) ),
					oshc_f( 'chair_country', __( 'Chair — country', 'oshc' ), 'chair_country', 'text' ),
					oshc_img( 'chair_photo', __( 'Chair — photo', 'oshc' ), 'chair_photo' ),
					array(
						'key'     => 'field_oshc_committee_msg',
						'label'   => __( 'Committee members', 'oshc' ),
						'type'    => 'message',
						'message' => __( 'Add / edit / reorder Organizing & Scientific Committee members under the <strong>Committee</strong> menu. Assign each one a Committee Type (Organizing or Scientific).', 'oshc' ),
					),

					// --- Attendees & Dates ---
					oshc_tab( 'attendees', __( 'Attendees & Dates', 'oshc' ) ),
					oshc_f( 'benefits_pills', __( 'Benefit pills', 'oshc' ), 'benefits_pills', 'textarea', array( 'rows' => 3, 'instructions' => __( 'One per line, e.g. "Regional Expertise.".', 'oshc' ) ) ),
					oshc_img( 'attendees_image', __( 'Attendees image', 'oshc' ), 'attendees_image' ),
					oshc_f( 'who_should_attend', __( 'Who should attend', 'oshc' ), 'who_should_attend', 'textarea', array( 'rows' => 8, 'instructions' => __( 'One audience per line.', 'oshc' ) ) ),
					oshc_f( 'dates_intro', __( 'Important dates — intro', 'oshc' ), 'dates_intro', 'textarea', array( 'rows' => 3 ) ),
					oshc_f( 'dates_calendar_url', __( '"Add to Calendar" URL', 'oshc' ), 'dates_calendar_url', 'url' ),
					array(
						'key'     => 'field_oshc_dates_msg',
						'label'   => __( 'Date milestones', 'oshc' ),
						'type'    => 'message',
						'message' => __( 'Add / edit / reorder milestones under the <strong>Important Dates</strong> menu.', 'oshc' ),
					),

					// --- Program & Faculty ---
					oshc_tab( 'program', __( 'Program & Faculty', 'oshc' ) ),
					oshc_f( 'program_intro', __( 'Program — intro', 'oshc' ), 'program_intro', 'wysiwyg', array( 'media_upload' => 0 ) ),
					oshc_f( 'session_highlights', __( 'Session highlights', 'oshc' ), 'session_highlights', 'textarea', array( 'rows' => 8, 'instructions' => __( 'One topic per line.', 'oshc' ) ) ),
					oshc_f( 'cme_accreditation', __( 'CME accreditation', 'oshc' ), 'cme_accreditation', 'wysiwyg', array( 'media_upload' => 0 ) ),
					oshc_f( 'faculty_intro', __( 'Faculty — intro', 'oshc' ), 'faculty_intro', 'textarea', array( 'rows' => 4 ) ),
					array(
						'key'     => 'field_oshc_faculty_msg',
						'label'   => __( 'Faculty members', 'oshc' ),
						'type'    => 'message',
						'message' => __( 'Add / edit / reorder speakers under the <strong>Faculty</strong> menu.', 'oshc' ),
					),

					// --- Abstracts ---
					oshc_tab( 'abstracts', __( 'Abstracts', 'oshc' ) ),
					oshc_f( 'abstracts_heading', __( 'Heading', 'oshc' ), 'abstracts_heading', 'text' ),
					oshc_f( 'abstracts_intro', __( 'Intro', 'oshc' ), 'abstracts_intro', 'textarea', array( 'rows' => 4 ) ),
					oshc_f( 'suggested_topics', __( 'Suggested topics', 'oshc' ), 'suggested_topics', 'textarea', array( 'rows' => 8, 'instructions' => __( 'One per line.', 'oshc' ) ) ),
					oshc_f( 'abstract_guidelines', __( 'Submission guidelines', 'oshc' ), 'abstract_guidelines', 'wysiwyg', array( 'media_upload' => 0 ) ),
					oshc_f( 'submit_abstract_url', __( '"Submit Abstract" URL', 'oshc' ), 'submit_abstract_url', 'url' ),

					// --- Register ---
					oshc_tab( 'register', __( 'Register', 'oshc' ) ),
					oshc_f( 'register_intro', __( 'Intro', 'oshc' ), 'register_intro', 'textarea', array( 'rows' => 3 ) ),
					oshc_f( 'pricing_group_label', __( 'Pricing group label', 'oshc' ), 'pricing_group_label', 'text', array( 'instructions' => __( 'e.g. "Early Bird Fees".', 'oshc' ) ) ),
					oshc_f( 'whats_included', __( "What's included", 'oshc' ), 'whats_included', 'textarea', array( 'rows' => 8, 'instructions' => __( 'One item per line.', 'oshc' ) ) ),
					oshc_f( 'pricing_note', __( 'Pricing note', 'oshc' ), 'pricing_note', 'text', array( 'instructions' => __( 'e.g. "*All rates exclusive of 5% VAT".', 'oshc' ) ) ),
					array(
						'key'     => 'field_oshc_pricing_msg',
						'label'   => __( 'Pricing tiers', 'oshc' ),
						'type'    => 'message',
						'message' => __( 'Add / edit / reorder fee categories under the <strong>Pricing Tiers</strong> menu.', 'oshc' ),
					),

					// --- Sponsorship ---
					oshc_tab( 'sponsorship', __( 'Sponsorship', 'oshc' ) ),
					oshc_f( 'sponsorship_heading', __( 'Heading', 'oshc' ), 'sponsorship_heading', 'text' ),
					oshc_f( 'sponsorship_intro', __( 'Body', 'oshc' ), 'sponsorship_intro', 'wysiwyg', array( 'media_upload' => 0 ) ),
					oshc_f( 'sponsorship_url', __( '"Sponsorship Enquiry" URL', 'oshc' ), 'sponsorship_url', 'url' ),

					// --- Gallery ---
					oshc_tab( 'gallery', __( 'Gallery', 'oshc' ) ),
					oshc_f( 'gallery_intro', __( 'Intro', 'oshc' ), 'gallery_intro', 'text' ),
					oshc_f( 'gallery_view_more_url', __( '"View More" URL', 'oshc' ), 'gallery_view_more_url', 'url' ),
					array(
						'key'     => 'field_oshc_gallery_msg',
						'label'   => __( 'Gallery images', 'oshc' ),
						'type'    => 'message',
						'message' => __( 'Add / edit / reorder photos under the <strong>Gallery</strong> menu (set each photo as the Featured Image).', 'oshc' ),
					),

					// --- Venue ---
					oshc_tab( 'venue', __( 'Venue', 'oshc' ) ),
					oshc_f( 'venue_name', __( 'Venue name', 'oshc' ), 'venue_name', 'text' ),
					oshc_img( 'venue_image', __( 'Venue image', 'oshc' ), 'venue_image' ),
					oshc_f( 'venue_description', __( 'Description', 'oshc' ), 'venue_description', 'wysiwyg', array( 'media_upload' => 0 ) ),
					oshc_f( 'venue_phone', __( 'Phone', 'oshc' ), 'venue_phone', 'text' ),
					oshc_f( 'venue_map_url', __( 'Map / Hotel URL', 'oshc' ), 'venue_map_url', 'url' ),

					// --- FAQ ---
					oshc_tab( 'faq', __( 'FAQ', 'oshc' ) ),
					oshc_f( 'faq_intro', __( 'FAQ — intro', 'oshc' ), 'faq_intro', 'textarea', array( 'rows' => 3 ) ),
					array(
						'key'     => 'field_oshc_faq_msg',
						'label'   => __( 'FAQ items', 'oshc' ),
						'type'    => 'message',
						'message' => __( 'Add / edit / reorder questions under the <strong>FAQs</strong> menu. Group them with FAQ Groups (Agreement, Forms of Payments, etc.).', 'oshc' ),
					),

					// --- Contact / Footer ---
					oshc_tab( 'contact', __( 'Contact & Footer', 'oshc' ) ),
					oshc_f( 'contact_email', __( 'Contact email', 'oshc' ), 'contact_email', 'email' ),
					oshc_f( 'contact_phone', __( 'Contact phone', 'oshc' ), 'contact_phone', 'text' ),
					oshc_f( 'contact_hours', __( 'Phone hours', 'oshc' ), 'contact_hours', 'text' ),
					oshc_f( 'contact_address', __( 'Office address', 'oshc' ), 'contact_address', 'textarea', array( 'rows' => 4 ) ),
					oshc_f( 'contact_map_url', __( 'Office map URL', 'oshc' ), 'contact_map_url', 'url' ),
					oshc_img( 'partners_image', __( '“Hosted by / Supported by” strip', 'oshc' ), 'partners_image', __( 'Shown just above the footer. A theme default is used if empty.', 'oshc' ) ),
				),
			)
		);

		/* ---------------------------------------------------------------
		 * FACULTY fields
		 * --------------------------------------------------------------- */
		$person_fields = array(
			oshc_f( 'designation', __( 'Designation / role', 'oshc' ), 'designation', 'textarea', array( 'rows' => 3, 'instructions' => __( 'One line per role; shown under the name.', 'oshc' ) ) ),
			oshc_f( 'institution', __( 'Institution', 'oshc' ), 'institution', 'text' ),
			oshc_f( 'country', __( 'Country', 'oshc' ), 'country', 'text' ),
			oshc_f( 'bio', __( 'Biography', 'oshc' ), 'bio', 'textarea', array( 'rows' => 6, 'instructions' => __( 'Optional. Shown in the profile pop-up.', 'oshc' ) ) ),
		);

		acf_add_local_field_group(
			array(
				'key'      => 'group_oshc_faculty',
				'title'    => __( 'Faculty details', 'oshc' ),
				'location' => array( array( array( 'param' => 'post_type', 'operator' => '==', 'value' => 'oshc_faculty' ) ) ),
				'fields'   => $person_fields,
			)
		);

		acf_add_local_field_group(
			array(
				'key'      => 'group_oshc_committee',
				'title'    => __( 'Committee member details', 'oshc' ),
				'location' => array( array( array( 'param' => 'post_type', 'operator' => '==', 'value' => 'oshc_committee' ) ) ),
				'fields'   => array(
					oshc_f( 'c_designation', __( 'Designation / role', 'oshc' ), 'designation', 'textarea', array( 'rows' => 3 ) ),
					oshc_f( 'c_institution', __( 'Institution', 'oshc' ), 'institution', 'text' ),
					oshc_f( 'c_country', __( 'Country', 'oshc' ), 'country', 'text' ),
					oshc_f( 'c_bio', __( 'Biography', 'oshc' ), 'bio', 'textarea', array( 'rows' => 6 ) ),
				),
			)
		);

		/* ---------------------------------------------------------------
		 * IMPORTANT DATE fields
		 * --------------------------------------------------------------- */
		acf_add_local_field_group(
			array(
				'key'      => 'group_oshc_date',
				'title'    => __( 'Date details', 'oshc' ),
				'location' => array( array( array( 'param' => 'post_type', 'operator' => '==', 'value' => 'oshc_date' ) ) ),
				'fields'   => array(
					oshc_f( 'date_badge', __( 'Date badge', 'oshc' ), 'date_badge', 'text', array( 'instructions' => __( 'Short date shown big, e.g. "Apr 13".', 'oshc' ) ) ),
				),
			)
		);

		/* ---------------------------------------------------------------
		 * PRICING fields
		 * --------------------------------------------------------------- */
		acf_add_local_field_group(
			array(
				'key'      => 'group_oshc_pricing',
				'title'    => __( 'Pricing details', 'oshc' ),
				'location' => array( array( array( 'param' => 'post_type', 'operator' => '==', 'value' => 'oshc_pricing' ) ) ),
				'fields'   => array(
					oshc_f( 'price', __( 'Price', 'oshc' ), 'price', 'text', array( 'instructions' => __( 'e.g. "USD 400".', 'oshc' ) ) ),
				),
			)
		);

		/* ---------------------------------------------------------------
		 * GALLERY fields
		 * --------------------------------------------------------------- */
		acf_add_local_field_group(
			array(
				'key'      => 'group_oshc_gallery',
				'title'    => __( 'Image details', 'oshc' ),
				'location' => array( array( array( 'param' => 'post_type', 'operator' => '==', 'value' => 'oshc_gallery' ) ) ),
				'fields'   => array(
					array(
						'key'     => 'field_oshc_gallery_hint',
						'label'   => __( 'Photo', 'oshc' ),
						'type'    => 'message',
						'message' => __( 'Set the photo as the <strong>Featured Image</strong> (right-hand panel).', 'oshc' ),
					),
					oshc_f( 'caption', __( 'Caption', 'oshc' ), 'caption', 'text' ),
				),
			)
		);
	}
);
