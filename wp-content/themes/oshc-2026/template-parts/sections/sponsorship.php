<?php
/**
 * Sponsorship — Unlock New Horizons.
 *
 * @package OSHC2026
 */

$heading = oshc_field( 'sponsorship_heading', __( 'Unlock New Horizons', 'oshc' ) );
$body    = oshc_field( 'sponsorship_intro', '<p>Step into the future of collaboration at the <strong>8th Omani Society of Hematology Conference</strong>. Bringing together more than 500 leaders and professionals from across the field, this landmark event offers an unmatched opportunity to elevate your presence, showcase your expertise, and forge lasting relationships.</p>' );
$url     = oshc_field( 'sponsorship_url', 'https://meetingmindsexperts.freshworks.com/crm/sales/web_forms/c9c2595c8e5d65fd9bde38019d26e223b6b6b47d3c437a2df94ab6a4d60e4878/form.html' );
?>
<section class="oshc-section oshc-sponsorship" id="sponsorship">
	<div class="oshc-container oshc-narrow oshc-center">
		<h2 class="oshc-h2"><?php echo esc_html( $heading ); ?></h2>
		<div class="oshc-prose"><?php echo wp_kses_post( $body ); ?></div>
		<a class="oshc-btn oshc-btn--red" href="<?php echo oshc_url( $url ); ?>" target="_blank" rel="noopener"><?php esc_html_e( 'Sponsorship Enquiry', 'oshc' ); ?></a>
	</div>
</section>
