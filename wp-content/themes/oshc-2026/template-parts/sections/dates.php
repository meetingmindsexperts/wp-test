<?php
/**
 * Important dates timeline.
 *
 * @package OSHC2026
 */

$intro    = oshc_field( 'dates_intro', __( "We've streamlined the key dates below to help you prepare for the conference and make the most of this premier hematology event. Be sure to mark them in your calendar and join us!", 'oshc' ) );
$cal_url  = oshc_field( 'dates_calendar_url', 'https://meetingmindsonline.com/add-to-calender.php?title=OSHC%202026&date=2026-10-08' );
$dates    = oshc_query( 'oshc_date' );
?>
<section class="oshc-section oshc-section--alt" id="dates">
	<div class="oshc-container">
		<h2 class="oshc-h2 oshc-center"><?php esc_html_e( 'Important Dates', 'oshc' ); ?></h2>
		<?php if ( $intro ) : ?>
			<p class="oshc-lead oshc-center"><?php echo esc_html( $intro ); ?></p>
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
</section>
