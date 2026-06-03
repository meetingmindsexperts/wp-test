<?php
/**
 * Attendees & benefits — "Who should attend" + benefit pills.
 *
 * @package OSHC2026
 */

$pills = oshc_lines( oshc_field( 'benefits_pills', "Regional Expertise.\nGlobal Insights.\nReal Impact." ) );
$who   = oshc_lines( oshc_field( 'who_should_attend', "Hematologists\nOncologists\nFellows, residents, and medical students\nClinical Pharmacists\nNurse Practitioners\nClinical Nurse Educators\nRegistered Nurses / General Nursing Staff\nInfection Prevention and Control Professionals\nQuality Management and Patient Safety Officers\nCase Managers\nAcademics and Medical Faculty\nAllied Health Professionals" ) );
$img   = oshc_field( 'attendees_image', '' );
$img_url = is_array( $img ) ? ( $img['url'] ?? '' ) : '';
?>
<section class="oshc-section" id="attendees">
	<div class="oshc-container oshc-attendees">
		<div class="oshc-attendees__media"<?php echo $img_url ? ' style="background-image:linear-gradient(rgba(43,57,144,.35),rgba(120,29,33,.55)),url(' . esc_url( $img_url ) . ')"' : ''; ?>>
			<div class="oshc-attendees__pills">
				<?php foreach ( $pills as $p ) : ?>
					<span class="oshc-pill"><?php echo esc_html( $p ); ?></span>
				<?php endforeach; ?>
			</div>
		</div>
		<div class="oshc-attendees__list">
			<h2 class="oshc-h2"><?php esc_html_e( 'Who Should Attend?', 'oshc' ); ?></h2>
			<ul class="oshc-checklist">
				<?php foreach ( $who as $w ) : ?>
					<li><?php echo esc_html( $w ); ?></li>
				<?php endforeach; ?>
			</ul>
		</div>
	</div>
</section>
