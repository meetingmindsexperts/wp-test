<?php
/**
 * Need assistance — contact details.
 *
 * @package OSHC2026
 */

$email   = oshc_field( 'contact_email', 'oshc@meetingmindsexperts.com' );
$phone   = oshc_field( 'contact_phone', '+971 4 276 1444' );
$hours   = oshc_field( 'contact_hours', __( 'Available Mon–Fri, 9am–6pm', 'oshc' ) );
$address = oshc_field( 'contact_address', "DSC Tower – Office 508 & 509, Dubai Studio City, Dubai\nPO Box: 502464" );
$map     = oshc_field( 'contact_map_url', 'https://maps.app.goo.gl/ePDCrpsnPRZzYPz8A' );
?>
<section class="oshc-section oshc-contact" id="contact">
	<div class="oshc-container">
		<h2 class="oshc-h2 oshc-center"><?php esc_html_e( 'Need Assistance?', 'oshc' ); ?></h2>
		<div class="oshc-contact__grid">
			<div class="oshc-contact__card">
				<div class="oshc-contact__icon" aria-hidden="true">&#9993;</div>
				<h4><?php esc_html_e( 'Email', 'oshc' ); ?></h4>
				<p class="oshc-muted"><?php esc_html_e( 'Send us your questions anytime.', 'oshc' ); ?></p>
				<a href="mailto:<?php echo esc_attr( $email ); ?>"><?php echo esc_html( $email ); ?></a>
			</div>
			<div class="oshc-contact__card">
				<div class="oshc-contact__icon" aria-hidden="true">&#9742;</div>
				<h4><?php esc_html_e( 'Phone', 'oshc' ); ?></h4>
				<p class="oshc-muted"><?php echo esc_html( $hours ); ?></p>
				<a href="tel:<?php echo esc_attr( preg_replace( '/\s+/', '', $phone ) ); ?>"><?php echo esc_html( $phone ); ?></a>
			</div>
			<div class="oshc-contact__card">
				<div class="oshc-contact__icon" aria-hidden="true">&#9678;</div>
				<h4><?php esc_html_e( 'Location', 'oshc' ); ?></h4>
				<p class="oshc-muted">
					<?php
					foreach ( oshc_lines( $address ) as $line ) {
						echo esc_html( $line ) . '<br>';
					}
					?>
				</p>
				<?php if ( $map ) : ?>
					<a href="<?php echo oshc_url( $map ); ?>" target="_blank" rel="noopener"><?php esc_html_e( 'Open in Maps', 'oshc' ); ?></a>
				<?php endif; ?>
			</div>
		</div>
	</div>
</section>
