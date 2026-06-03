<?php
/**
 * One-time content seeding so the site is usable immediately after the theme
 * is activated on a PHP-only host (no wp-cli / no Docker needed).
 *
 * Runs once, only when ACF is active, then sets the `oshc_seeded` flag.
 * Everything it creates is normal editor content — fully editable/removable
 * in wp-admin afterwards.
 *
 * @package OSHC2026
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

/**
 * The default OSHC 2026 data set.
 *
 * @return array
 */
function oshc_default_content() {
	return array(
		'dates'   => array(
			array( 'Abstract submissions open (Oral/Poster)', 'Apr 13' ),
			array( 'Online Registration Open', 'Apr 13' ),
			array( 'Early Bird Registration Opens', 'Apr 13' ),
			array( 'Program Topics Announced', 'Jun 1' ),
			array( 'Invited Faculty Announced', 'Aug 5' ),
			array( 'Early Bird Registration Closes', 'Aug 31' ),
			array( 'Abstract Submission Closes', 'Sep 1' ),
			array( 'Standard Registration Opens', 'Sep 1' ),
			array( 'Final Program', 'Sep 5' ),
			array( 'Author Notifications (Oral/Poster)', 'Sep 25' ),
			array( 'CME Announcement', 'Sep 30' ),
			array( 'Standard Registration Closes', 'Oct 7' ),
			array( 'OSHC Goes Live', 'Oct 8' ),
			array( 'Closing Ceremony', 'Oct 10' ),
		),
		'pricing' => array(
			array( 'Physician', 'USD 400' ),
			array( 'OMA Member', 'USD 350' ),
			array( 'Allied Health', 'USD 150' ),
			array( 'Nurse', 'USD 150' ),
			array( 'Resident', 'USD 150' ),
			array( 'Student', 'USD 100' ),
		),
		// name, designation, institution, country, bio, committee types.
		'people'  => array(
			array( 'Abdulhakim Al-Rawas', "President, Omani Society of Hematology\nSenior Consultant, Pediatric Hematology/Oncology & HSCT", 'Sultan Qaboos University Hospital', 'Oman', 'Dr. Abdulhakim Al-Rawas is a Senior Consultant in Pediatric Hematology/Oncology at Sultan Qaboos University Hospital and President of the Omani Society of Hematology. He trained at Queen’s University and SickKids, Toronto, and has authored 33 peer-reviewed publications.', array( 'Organizing Committee', 'Scientific Committee' ) ),
			array( 'Khalil Al Farsi', 'Senior Consultant, Hematology/BMT, Department of Hematology', 'Sultan Qaboos University Hospital', 'Oman', '', array( 'Organizing Committee', 'Scientific Committee' ) ),
			array( 'Maha Al Yahyai', 'Specialist, Department of Hematology & Blood Transfusion', 'The Royal Hospital', 'Oman', '', array( 'Organizing Committee', 'Scientific Committee' ) ),
			array( 'Muna Al Tarshi', 'Senior Consultant - Hematology and Bone Marrow Transplant', 'The Royal Hospital', 'Oman', 'Dr. Muna Altarshi is a Senior Consultant at the Royal Hospital, Muscat. She trained at McGill University and completed a Bone Marrow Transplant fellowship at Princess Margaret Cancer Centre, University of Toronto. She is Treasurer of the Omani Society of Hematology.', array( 'Organizing Committee', 'Scientific Committee' ) ),
			array( 'Nawal Al Mashaykhi', 'Pediatric Haematologist Oncologist', 'Sultan Qaboos University Hospital', 'Oman', '', array( 'Organizing Committee', 'Scientific Committee' ) ),
			array( 'Shadhiya Al Khan', 'Senior Consultant Hematopathologist and Transfusion Medicine', 'Sultan Qaboos University Hospital, University Medical City', 'Oman', '', array( 'Organizing Committee', 'Scientific Committee' ) ),
			array( 'Yasser Wali', 'Professor & Head of Pediatric Hematology', 'Sultan Qaboos University Hospital', 'Oman', '', array( 'Organizing Committee', 'Scientific Committee' ) ),
			array( 'Bader Al Rawahi', 'Senior Consultant Hematologist, Thrombosis and Hemostasis', 'Sultan Qaboos University Hospital', 'Oman', '', array( 'Scientific Committee' ) ),
			array( 'Khalid Al Hashmi', 'Senior Consultant Internist, Hematology, and Medical Oncology', 'Armed Forces Hospital / Sultan Qaboos University', 'Oman', '', array( 'Scientific Committee' ) ),
			array( 'Mahdiya Al Bulushi', 'Consultant Hematologist', 'The Royal Hospital', 'Oman', '', array( 'Scientific Committee' ) ),
			array( 'Mohammed Alhuneini', 'Senior Consultant Hematologist', 'University Medical City (NOCBMTH)', 'Oman', '', array( 'Scientific Committee' ) ),
			array( 'Murtadha Al Khabori', "Senior Consultant, University Medical City\nProfessor of Hematology, Sultan Qaboos University", 'Sultan Qaboos University', 'Oman', 'Prof. Murtadha Al-Khabori is a Professor of Hematology at Sultan Qaboos University. He completed advanced hematology and stem cell transplant training at Princess Margaret Hospital and has authored over 100 peer-reviewed publications.', array( 'Scientific Committee' ) ),
			array( 'Salam Alkindi', "Professor & Consultant Haematologist\nDirector of Hematology & Bone Marrow Transplant Center", 'Sultan Qaboos University', 'Oman', '', array( 'Scientific Committee' ) ),
			array( 'Sulayma Al Lamki', 'Senior Consultant, Department of Hematology & Blood Transfusion', 'The Royal Hospital', 'Oman', '', array( 'Scientific Committee' ) ),
		),
		'faqs'    => array(
			array( 'Agreement', 'By registering for OSHC 2026 you agree to the conference terms and conditions. Full details will be provided here.' ),
			array( 'Forms of Payments', 'Payments can be made online by credit/debit card during registration. Bank transfer details are available on request.' ),
			array( 'Important Information', 'Please bring a valid photo ID and your registration confirmation to collect your badge on-site.' ),
			array( 'Cancellation', 'Cancellation and refund policy details will be published here. Please contact the secretariat for assistance.' ),
		),
	);
}

/**
 * Create or update one post by (type, title).
 */
function oshc_upsert( $type, $title, $fields = array(), $order = 0, $content = '' ) {
	$existing = get_posts(
		array(
			'post_type'   => $type,
			'title'       => $title,
			'post_status' => 'any',
			'numberposts' => 1,
			'fields'      => 'ids',
		)
	);
	if ( $existing ) {
		$id = $existing[0];
		wp_update_post( array( 'ID' => $id, 'menu_order' => $order, 'post_content' => $content ) );
	} else {
		$id = wp_insert_post(
			array(
				'post_type'    => $type,
				'post_title'   => $title,
				'post_status'  => 'publish',
				'post_content' => $content,
				'menu_order'   => $order,
			)
		);
	}
	if ( $id && ! is_wp_error( $id ) && function_exists( 'update_field' ) ) {
		foreach ( $fields as $k => $v ) {
			update_field( $k, $v, $id );
		}
	}
	return $id;
}

/**
 * Seed the full default content set. Safe to run repeatedly.
 */
function oshc_seed_content() {
	$data = oshc_default_content();

	// Home page as static front page.
	$home = get_page_by_path( 'home' );
	$home_id = $home ? $home->ID : wp_insert_post(
		array(
			'post_type'   => 'page',
			'post_title'  => 'Home',
			'post_name'   => 'home',
			'post_status' => 'publish',
		)
	);
	if ( $home_id && ! is_wp_error( $home_id ) ) {
		update_option( 'show_on_front', 'page' );
		update_option( 'page_on_front', $home_id );
		if ( function_exists( 'update_field' ) ) {
			update_field( 'banner_text', 'Early Bird Registration Closes : Aug 31', $home_id );
			update_field( 'banner_url', '#register', $home_id );
			update_field( 'register_url', 'https://meetingminds.eventsair.com/oshc2026/register-online', $home_id );
			update_field( 'submit_abstract_url', 'https://meetingminds.eventsair.com/oshc2026/call-for-abstract', $home_id );
		}
	}

	foreach ( $data['dates'] as $i => $row ) {
		oshc_upsert( 'oshc_date', $row[0], array( 'date_badge' => $row[1] ), $i );
	}
	foreach ( $data['pricing'] as $i => $row ) {
		oshc_upsert( 'oshc_pricing', $row[0], array( 'price' => $row[1] ), $i );
	}
	foreach ( $data['people'] as $i => $p ) {
		$id = oshc_upsert(
			'oshc_committee',
			$p[0],
			array(
				'designation' => $p[1],
				'institution' => $p[2],
				'country'     => $p[3],
				'bio'         => $p[4],
			),
			$i
		);
		if ( $id && ! is_wp_error( $id ) ) {
			wp_set_object_terms( $id, $p[5], 'oshc_committee_type' );
		}
	}
	foreach ( $data['faqs'] as $i => $f ) {
		$id = oshc_upsert( 'oshc_faq', $f[0], array(), $i, $f[1] );
		if ( $id && ! is_wp_error( $id ) ) {
			wp_set_object_terms( $id, array( $f[0] ), 'oshc_faq_group' );
		}
	}

	update_option( 'oshc_seeded', '1' );
}

/**
 * Run the seed once, after ACF is available. We use admin_init (not
 * after_switch_theme) so seeding works even if the theme is activated before
 * ACF — it simply runs on the next admin page load once ACF is present.
 */
function oshc_maybe_seed() {
	if ( get_option( 'oshc_seeded' ) ) {
		return;
	}
	if ( ! function_exists( 'get_field' ) ) {
		return; // Wait until ACF is active.
	}
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}
	oshc_seed_content();
}
add_action( 'admin_init', 'oshc_maybe_seed' );
