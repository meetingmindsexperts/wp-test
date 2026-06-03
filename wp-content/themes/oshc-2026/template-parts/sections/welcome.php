<?php
/**
 * Welcome remarks + Organizing / Scientific committee tabs.
 *
 * @package OSHC2026
 */

$welcome = oshc_field( 'welcome_remarks', '<p>It is a privilege to welcome you to the <strong>8th Omani Society of Hematology Conference, OSHC 2026</strong>, taking place on October 8–10th, 2026, in Muscat, Oman. This landmark event continues to offer an exceptional platform for hematologists to enhance their knowledge and advance their clinical practices.</p>' );

$chair_name    = oshc_field( 'chair_name', __( 'Abdulhakim Al-Rawas', 'oshc' ) );
$chair_role    = oshc_field( 'chair_role', "Conference Chairman\nPresident, Omani Society of Hematology" );
$chair_country = oshc_field( 'chair_country', __( 'Oman', 'oshc' ) );
$chair_photo   = oshc_field( 'chair_photo', '' );
$chair_url     = is_array( $chair_photo ) ? ( $chair_photo['url'] ?? '' ) : '';

$org = oshc_query( 'oshc_committee', array( 'tax_query' => array( array( 'taxonomy' => 'oshc_committee_type', 'field' => 'slug', 'terms' => 'organizing-committee' ) ) ) );
$sci = oshc_query( 'oshc_committee', array( 'tax_query' => array( array( 'taxonomy' => 'oshc_committee_type', 'field' => 'slug', 'terms' => 'scientific-committee' ) ) ) );
?>
<section class="oshc-section oshc-section--alt" id="welcome">
	<div class="oshc-container">
		<div class="oshc-tabs" data-tabs>
			<div class="oshc-tabs__nav" role="tablist">
				<button class="oshc-tab is-active" role="tab" data-tab="pane-welcome"><?php esc_html_e( 'Welcome Remarks', 'oshc' ); ?></button>
				<button class="oshc-tab" role="tab" data-tab="pane-org"><?php esc_html_e( 'Organizing Committee', 'oshc' ); ?></button>
				<button class="oshc-tab" role="tab" data-tab="pane-sci"><?php esc_html_e( 'Scientific Committee', 'oshc' ); ?></button>
			</div>

			<div class="oshc-tabs__panes">
				<div class="oshc-tabs__pane is-active" id="pane-welcome" role="tabpanel">
					<div class="oshc-welcome">
						<div class="oshc-welcome__text oshc-prose"><?php echo wp_kses_post( $welcome ); ?></div>
						<aside class="oshc-welcome__card">
							<div class="oshc-welcome__photo">
								<?php if ( $chair_url ) : ?>
									<img src="<?php echo esc_url( $chair_url ); ?>" alt="<?php echo esc_attr( $chair_name ); ?>" loading="lazy">
								<?php else : ?>
									<span class="oshc-person__initials"><?php echo esc_html( strtoupper( mb_substr( $chair_name, 0, 1 ) ) ); ?></span>
								<?php endif; ?>
							</div>
							<h4><?php echo esc_html( $chair_name ); ?></h4>
							<?php foreach ( oshc_lines( $chair_role ) as $line ) : ?>
								<p class="oshc-person__role"><?php echo esc_html( $line ); ?></p>
							<?php endforeach; ?>
							<?php if ( $chair_country ) : ?>
								<p class="oshc-person__country"><?php echo esc_html( $chair_country ); ?></p>
							<?php endif; ?>
						</aside>
					</div>
				</div>

				<div class="oshc-tabs__pane" id="pane-org" role="tabpanel">
					<span class="oshc-anchor" id="committee"></span>
					<?php if ( $org->have_posts() ) : ?>
						<div class="oshc-people">
							<?php while ( $org->have_posts() ) : $org->the_post(); ?>
								<?php get_template_part( 'template-parts/person-card', null, array( 'id' => get_the_ID() ) ); ?>
							<?php endwhile; wp_reset_postdata(); ?>
						</div>
					<?php else : ?>
						<p class="oshc-muted"><?php esc_html_e( 'Organizing committee to be announced.', 'oshc' ); ?></p>
					<?php endif; ?>
				</div>

				<div class="oshc-tabs__pane" id="pane-sci" role="tabpanel">
					<?php if ( $sci->have_posts() ) : ?>
						<div class="oshc-people">
							<?php while ( $sci->have_posts() ) : $sci->the_post(); ?>
								<?php get_template_part( 'template-parts/person-card', null, array( 'id' => get_the_ID() ) ); ?>
							<?php endwhile; wp_reset_postdata(); ?>
						</div>
					<?php else : ?>
						<p class="oshc-muted"><?php esc_html_e( 'Scientific committee to be announced.', 'oshc' ); ?></p>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</section>
