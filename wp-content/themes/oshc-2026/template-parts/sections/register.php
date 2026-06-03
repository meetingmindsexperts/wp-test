<?php
/**
 * Register now — pricing tiers + what's included.
 *
 * @package OSHC2026
 */

$intro    = oshc_field( 'register_intro', __( 'Get ready to mark your calendars for the 8th OSH Conference.', 'oshc' ) );
$group    = oshc_field( 'pricing_group_label', __( 'Early Bird Fees', 'oshc' ) );
$note     = oshc_field( 'pricing_note', __( '*All rates exclusive of 5% VAT', 'oshc' ) );
$reg_url  = oshc_field( 'register_url', 'https://meetingminds.eventsair.com/oshc2026/register-online' );
$included = oshc_lines( oshc_field( 'whats_included', "Access to Session Halls\nAccess to Exhibition Halls\nLunch\nFinal Program\nCoffee Breaks\nMobile App\nWorkshops" ) );
$prices   = oshc_query( 'oshc_pricing' );
?>
<section class="oshc-section" id="register">
	<div class="oshc-container">
		<h2 class="oshc-h2 oshc-center"><?php esc_html_e( 'Register Now', 'oshc' ); ?></h2>
		<?php if ( $intro ) : ?>
			<p class="oshc-lead oshc-center"><?php echo esc_html( $intro ); ?></p>
		<?php endif; ?>

		<div class="oshc-register">
			<div class="oshc-pricing">
				<div class="oshc-pricing__head"><?php echo esc_html( $group ); ?></div>
				<?php if ( $prices->have_posts() ) : ?>
					<ul class="oshc-pricing__list">
						<?php
						while ( $prices->have_posts() ) :
							$prices->the_post();
							$price = oshc_field( 'price', '', get_the_ID() );
							?>
							<li>
								<span class="oshc-pricing__cat"><?php echo esc_html( get_the_title() ); ?></span>
								<span class="oshc-pricing__amt"><?php echo esc_html( $price ); ?></span>
							</li>
						<?php endwhile; wp_reset_postdata(); ?>
					</ul>
				<?php else : ?>
					<p class="oshc-muted"><?php esc_html_e( 'Fees coming soon.', 'oshc' ); ?></p>
				<?php endif; ?>
				<a class="oshc-btn oshc-btn--red oshc-pricing__cta" href="<?php echo oshc_url( $reg_url ); ?>" target="_blank" rel="noopener"><?php esc_html_e( 'Register', 'oshc' ); ?></a>
				<?php if ( $note ) : ?><p class="oshc-pricing__note"><?php echo esc_html( $note ); ?></p><?php endif; ?>
			</div>

			<div class="oshc-included">
				<h3 class="oshc-h3"><?php esc_html_e( "What's Included", 'oshc' ); ?></h3>
				<ul class="oshc-checklist">
					<?php foreach ( $included as $i ) : ?>
						<li><?php echo esc_html( $i ); ?></li>
					<?php endforeach; ?>
				</ul>
			</div>
		</div>
	</div>
</section>
