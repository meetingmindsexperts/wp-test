<?php
/**
 * One-time content seeding so the site is fully populated AND fully editable
 * via ACF/CPTs right after the theme is activated on a PHP-only host
 * (no wp-cli / no Docker needed).
 *
 * - Repeatable items become CPT posts (Committee, Dates, Pricing, FAQ).
 * - Every Home-page section field is seeded so 100% of the text comes from ACF
 *   (editors see real content to edit, not blank fields).
 *
 * Re-runnable & non-destructive: it only CREATES missing posts and only fills
 * EMPTY Home fields — it never overwrites edits an editor has made.
 *
 * @package OSHC2026
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

define( 'OSHC_SEED_VERSION', 2 );

/**
 * Repeatable content data set.
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
 * Default text for every Home-page ACF field (so all content is ACF-driven).
 */
function oshc_home_defaults() {
	return array(
		// Top bar & hero.
		'banner_text'         => 'Early Bird Registration Closes : Aug 31',
		'banner_url'          => '#register',
		'hero_subheading'     => 'JW Marriott, Muscat',
		'hero_dateline'       => '8th – 10th October 2026',
		'hero_heading'        => '8th Omani Society of Hematology Conference',
		'hero_intro'          => 'Bringing together hematological experts from across the region to share knowledge and enhance patient care.',
		'register_url'        => 'https://meetingminds.eventsair.com/oshc2026/register-online',
		// Stats.
		'stat1_number'        => '1235',
		'stat1_label'         => 'Attendees expected',
		'stat1_text'          => 'Healthcare professionals, researchers, and students',
		'stat2_number'        => '30',
		'stat2_label'         => 'Sessions',
		'stat2_text'          => 'International collaboration and networking',
		'stat3_number'        => '112',
		'stat3_label'         => 'Talks',
		'stat3_text'          => 'Interactive talks and hands-on workshops',
		'stat4_number'        => '99',
		'stat4_label'         => 'Expert speakers',
		'stat4_text'          => 'Leading voices in hematology medicine',
		// Welcome.
		'welcome_remarks'     => '<p>It is a privilege to welcome you to the <strong>8th Omani Society of Hematology Conference, OSHC 2026</strong>, taking place on October 8–10th, 2026, in Muscat, Oman. This landmark event continues to offer an exceptional platform for hematologists to enhance their knowledge and advance their clinical practices.</p><p>The conference serves as a premier platform for global hematology leaders to converge, explore novel treatment options, and refine professional methodologies, while fostering meaningful networking and collaboration.</p>',
		'chair_name'          => 'Abdulhakim Al-Rawas',
		'chair_role'          => "Conference Chairman\nPresident, Omani Society of Hematology",
		'chair_country'       => 'Oman',
		// Attendees & dates.
		'benefits_pills'      => "Regional Expertise.\nGlobal Insights.\nReal Impact.",
		'who_should_attend'   => "Hematologists\nOncologists\nFellows, residents, and medical students\nClinical Pharmacists\nNurse Practitioners\nClinical Nurse Educators\nRegistered Nurses / General Nursing Staff\nInfection Prevention and Control Professionals\nQuality Management and Patient Safety Officers\nCase Managers\nAcademics and Medical Faculty\nAllied Health Professionals",
		'dates_intro'         => "We've streamlined the key dates below to help you prepare for the conference and make the most of this premier hematology event. Be sure to mark them in your calendar and join us!",
		'dates_calendar_url'  => 'https://meetingmindsonline.com/add-to-calender.php?title=OSHC%202026&date=2026-10-08',
		// Program & faculty.
		'program_intro'       => '<p>We are delighted to welcome you to the <strong>8th Omani Society of Hematology Conference OSHC 2026</strong> — a landmark gathering dedicated to showcasing the latest advancements, research, and innovations shaping the field of hematology.</p>',
		'session_highlights'  => "Hematopathology\nLymphoproliferative Disorders\nPlasma Cell Disorders\nPediatric Hematology\nGeneral Hematology\nAcute Leukemia",
		'cme_accreditation'   => '<h4>Instructions for Claiming CME Certificates:</h4><ul><li>Post the event, registered attendees will receive an online evaluation survey to their registered email address.</li><li>Once the survey is completed, you will automatically receive the CME Certificate by email.</li><li>Please ensure that the email address provided at registration is accurate.</li></ul>',
		'faculty_intro'       => 'The conference features renowned leaders from leading institutions around the world, delivering a scientific program designed to inspire innovation, enhance learning, and drive meaningful progress in hematology.',
		// Abstracts.
		'abstracts_heading'   => 'Scientific Voices',
		'abstracts_intro'     => 'Oral and poster presentations provide a valuable platform to share your research with a focused and engaged audience, enabling direct feedback, discussion, and collaboration.',
		'suggested_topics'    => "Bone Marrow Transplantation\nLeukemias\nMDS & Bone Marrow Failure\nPalliative Care\nTransfusion Medicine\nHematopathology\nLymphoma\nMyeloma and Plasma Cell Disorders\nThrombosis and Hemostasis",
		'abstract_guidelines' => '<p>A special criterion for accepting abstracts will be their topic as well as structure, content and degree of innovation.</p><ul><li>A maximum of 300 words is permitted. Titles and author names are excluded and entered separately. Tables should not be included in the abstract body.</li><li>The methods section should include the type of statistical analysis done, if applicable.</li><li>Statements like “Results will be discussed” are not acceptable and may lead to rejection.</li></ul>',
		'submit_abstract_url' => 'https://meetingminds.eventsair.com/oshc2026/call-for-abstract',
		// Register.
		'register_intro'      => 'Get ready to mark your calendars for the 8th OSH Conference.',
		'pricing_group_label' => 'Early Bird Fees',
		'whats_included'      => "Access to Session Halls\nAccess to Exhibition Halls\nLunch\nFinal Program\nCoffee Breaks\nMobile App\nWorkshops",
		'pricing_note'        => '*All rates exclusive of 5% VAT',
		// Sponsorship.
		'sponsorship_heading' => 'Unlock New Horizons',
		'sponsorship_intro'   => '<p>Step into the future of collaboration at the <strong>8th Omani Society of Hematology Conference</strong>. Bringing together more than 500 leaders and professionals from across the field, this landmark event offers an unmatched opportunity to elevate your presence, showcase your expertise, and forge lasting relationships.</p>',
		'sponsorship_url'     => 'https://meetingmindsexperts.freshworks.com/crm/sales/web_forms/c9c2595c8e5d65fd9bde38019d26e223b6b6b47d3c437a2df94ab6a4d60e4878/form.html',
		// Gallery.
		'gallery_intro'       => 'Here’s a quick glimpse at the 7th Omani Society of Hematology Conference.',
		// Venue.
		'venue_name'          => 'JW Marriott, Muscat',
		'venue_description'   => '<p><strong>JW Marriott</strong> is a conference venue in <strong>Muscat, Oman</strong>, offering dedicated conference and meeting spaces equipped with modern audiovisual and technical infrastructure to support plenary sessions, parallel meetings, and educational activities.</p>',
		'venue_phone'         => '+968 2 492 0000',
		'venue_map_url'       => 'https://maps.app.goo.gl/q8x7SEJd3KSS9kQA8',
		// FAQ.
		'faq_intro'           => "Find information on registration, session details, and networking opportunities. We're here to ensure you have a seamless conference experience.",
		// Contact.
		'contact_email'       => 'oshc@meetingmindsexperts.com',
		'contact_phone'       => '+971 4 276 1444',
		'contact_hours'       => 'Available Mon–Fri, 9am–6pm',
		'contact_address'     => "DSC Tower – Office 508 & 509, Dubai Studio City, Dubai\nPO Box: 502464",
		'contact_map_url'     => 'https://maps.app.goo.gl/ePDCrpsnPRZzYPz8A',
	);
}

/**
 * Create a post by (type, title) only if it doesn't already exist.
 * Returns the post ID. Never modifies an existing post (preserves editor edits).
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
		return $existing[0];
	}
	$id = wp_insert_post(
		array(
			'post_type'    => $type,
			'post_title'   => $title,
			'post_status'  => 'publish',
			'post_content' => $content,
			'menu_order'   => $order,
		)
	);
	if ( $id && ! is_wp_error( $id ) && function_exists( 'update_field' ) ) {
		foreach ( $fields as $k => $v ) {
			update_field( $k, $v, $id );
		}
	}
	return $id;
}

/**
 * Set an ACF field only when it is currently empty (won't clobber edits).
 */
function oshc_set_if_empty( $field, $value, $post_id ) {
	if ( ! function_exists( 'get_field' ) ) {
		return;
	}
	$current = get_field( $field, $post_id );
	if ( null === $current || '' === $current || false === $current ) {
		update_field( $field, $value, $post_id );
	}
}

/**
 * Seed the full default content set. Safe to re-run (additive only).
 */
function oshc_seed_content() {
	$data = oshc_default_content();

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
		foreach ( oshc_home_defaults() as $field => $value ) {
			oshc_set_if_empty( $field, $value, $home_id );
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
	update_option( 'oshc_seeded_version', OSHC_SEED_VERSION );
}

/**
 * Run the seed once per seed-version, after ACF is available.
 */
function oshc_maybe_seed() {
	if ( (int) get_option( 'oshc_seeded_version', 0 ) >= OSHC_SEED_VERSION ) {
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
