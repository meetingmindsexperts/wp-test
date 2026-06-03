<?php
/**
 * Tabbed section: "Attendees and Benefits" + "Important Dates" (matches source).
 *
 * @package OSHC2026
 */

$pills = oshc_lines( oshc_field( 'benefits_pills', "Regional Expertise.\nGlobal Insights.\nReal Impact." ) );
$who   = oshc_lines( oshc_field( 'who_should_attend', "Hematologists\nOncologists\nFellows, residents, and medical students\nClinical Pharmacists\nNurse Practitioners\nClinical Nurse Educators\nRegistered Nurses / General Nursing Staff\nInfection Prevention and Control Professionals\nQuality Management and Patient Safety Officers\nCase Managers\nAcademics and Medical Faculty\nAllied Health Professionals" ) );
$img   = oshc_field( 'attendees_image', '' );
$img_url = is_array( $img ) ? ( $img['url'] ?? '' ) : '';

$dates_intro = oshc_field( 'dates_intro', __( "We've streamlined the key dates below to help you prepare for the conference and make the most of this premier hematology event. Be sure to mark them in your calendar and join us!", 'oshc' ) );
$cal_url     = oshc_field( 'dates_calendar_url', 'https://meetingmindsonline.com/add-to-calender.php?title=OSHC%202026&date=2026-10-08' );
$dates       = oshc_query( 'oshc_date' );
?>
<section class="oshc-section oshc-section--alt" id="attendees">
	<div class="oshc-container">
		<div class="oshc-tabs" data-tabs>
			<div class="oshc-tabs__nav" role="tablist">
				<button class="oshc-tab is-active" role="tab" data-tab="pane-attendees"><?php esc_html_e( 'Attendees and Benefits', 'oshc' ); ?></button>
				<button class="oshc-tab" role="tab" data-tab="pane-dates"><?php esc_html_e( 'Important Dates', 'oshc' ); ?></button>
			</div>

			<div class="oshc-tabs__panes">
				<div class="oshc-tabs__pane is-active" id="pane-attendees" role="tabpanel">
					<div class="oshc-attendees">
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
				</div>

				<div class="oshc-tabs__pane" id="pane-dates" role="tabpanel">
					<span class="oshc-anchor" id="dates"></span>
					<h2 class="oshc-h2 oshc-center"><?php esc_html_e( 'Important Dates', 'oshc' ); ?></h2>
					<?php if ( $dates_intro ) : ?>
						<p class="oshc-lead oshc-center"><?php echo esc_html( $dates_intro ); ?></p>
					<?php endif; ?>

					<?php if ( $dates->have_posts() ) : ?>
						<div class="oshc-timeline">
							<?php
							while ( $dates->have_posts() ) :
								$dates->the_post();
								$badge = oshc_field( 'date_badge', '', get_the_ID() );
								?>
								<div class="oshc-timeline__item">
									<div class="oshc-timeline__badge"><?php echo esc_html( $badge ); ?></div>
									<div class="oshc-timeline__title"><?php echo esc_html( get_the_title() ); ?></div>
								</div>
							<?php endwhile; wp_reset_postdata(); ?>
						</div>
					<?php else : ?>
						<p class="oshc-muted oshc-center"><?php esc_html_e( 'Key dates coming soon.', 'oshc' ); ?></p>
					<?php endif; ?>

					<?php if ( $cal_url ) : ?>
						<div class="oshc-center">
							<a class="oshc-btn oshc-btn--blue" href="<?php echo oshc_url( $cal_url ); ?>" target="_blank" rel="noopener"><?php esc_html_e( 'Add to Calendar', 'oshc' ); ?></a>
						</div>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</section>
