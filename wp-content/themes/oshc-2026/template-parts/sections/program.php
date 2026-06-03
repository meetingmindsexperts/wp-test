<?php
/**
 * Program highlights + CME, and Faculty — tabbed.
 *
 * @package OSHC2026
 */

$program_intro = oshc_field( 'program_intro', '<p>We are delighted to welcome you to the <strong>8th Omani Society of Hematology Conference OSHC 2026</strong> — a landmark gathering dedicated to showcasing the latest advancements, research, and innovations shaping the field of hematology.</p>' );
$highlights    = oshc_lines( oshc_field( 'session_highlights', "Hematopathology\nLymphoproliferative Disorders\nPlasma Cell Disorders\nPediatric Hematology\nGeneral Hematology\nAcute Leukemia" ) );
$cme           = oshc_field( 'cme_accreditation', '<h4>Instructions for Claiming CME Certificates:</h4><ul><li>Post the event, registered attendees will receive an online evaluation survey to their registered email address.</li><li>Once the survey is completed, you will automatically receive the CME Certificate by email.</li><li>Please ensure that the email address provided at registration is accurate.</li></ul>' );
$faculty_intro = oshc_field( 'faculty_intro', __( 'The conference features renowned leaders from leading institutions around the world, delivering a scientific program designed to inspire innovation, enhance learning, and drive meaningful progress in hematology.', 'oshc' ) );

$faculty = oshc_query( 'oshc_faculty' );
?>
<section class="oshc-section" id="program">
	<div class="oshc-container">
		<div class="oshc-tabs" data-tabs>
			<div class="oshc-tabs__nav" role="tablist">
				<button class="oshc-tab is-active" role="tab" data-tab="pane-program"><?php esc_html_e( 'Program', 'oshc' ); ?></button>
				<button class="oshc-tab" role="tab" data-tab="pane-faculty"><?php esc_html_e( 'Faculty', 'oshc' ); ?></button>
			</div>

			<div class="oshc-tabs__panes">
				<div class="oshc-tabs__pane is-active" id="pane-program" role="tabpanel">
					<div class="oshc-prose oshc-center oshc-narrow"><?php echo wp_kses_post( $program_intro ); ?></div>

					<?php if ( $highlights ) : ?>
						<h3 class="oshc-h3 oshc-center"><?php esc_html_e( 'Session highlights at a glance', 'oshc' ); ?></h3>
						<div class="oshc-chips">
							<?php foreach ( $highlights as $h ) : ?>
								<span class="oshc-chip"><?php echo esc_html( $h ); ?></span>
							<?php endforeach; ?>
						</div>
					<?php endif; ?>

					<?php if ( $cme ) : ?>
						<div class="oshc-cme">
							<h3 class="oshc-h3"><?php esc_html_e( 'CME Accreditation', 'oshc' ); ?></h3>
							<div class="oshc-prose"><?php echo wp_kses_post( $cme ); ?></div>
						</div>
					<?php endif; ?>
				</div>

				<div class="oshc-tabs__pane" id="pane-faculty" role="tabpanel">
					<span class="oshc-anchor" id="faculty"></span>
					<?php if ( $faculty_intro ) : ?>
						<p class="oshc-lead oshc-center oshc-narrow"><?php echo esc_html( $faculty_intro ); ?></p>
					<?php endif; ?>
					<?php if ( $faculty->have_posts() ) : ?>
						<div class="oshc-people">
							<?php while ( $faculty->have_posts() ) : $faculty->the_post(); ?>
								<?php get_template_part( 'template-parts/person-card', null, array( 'id' => get_the_ID() ) ); ?>
							<?php endwhile; wp_reset_postdata(); ?>
						</div>
					<?php else : ?>
						<p class="oshc-muted oshc-center"><?php esc_html_e( 'Faculty list is currently being updated.', 'oshc' ); ?></p>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</section>
