<?php
/**
 * Venue info.
 *
 * @package OSHC2026
 */

$name  = oshc_field( 'venue_name', __( 'JW Marriott, Muscat', 'oshc' ) );
$desc  = oshc_field( 'venue_description', '<p><strong>JW Marriott</strong> is a conference venue in <strong>Muscat, Oman</strong>, offering dedicated conference and meeting spaces equipped with modern audiovisual and technical infrastructure to support plenary sessions, parallel meetings, and educational activities.</p>' );
$phone = oshc_field( 'venue_phone', '+968 2 492 0000' );
$map   = oshc_field( 'venue_map_url', 'https://maps.app.goo.gl/q8x7SEJd3KSS9kQA8' );
$img   = oshc_field( 'venue_image', '' );
$img_url = is_array( $img ) ? ( $img['url'] ?? '' ) : '';
?>
<section class="oshc-section" id="venue">
	<div class="oshc-container">
		<h2 class="oshc-h2 oshc-center"><?php esc_html_e( 'Venue Info', 'oshc' ); ?></h2>
		<div class="oshc-venue">
			<div class="oshc-venue__media">
				<?php if ( $img_url ) : ?>
					<img src="<?php echo esc_url( $img_url ); ?>" alt="<?php echo esc_attr( $name ); ?>" loading="lazy">
				<?php else : ?>
					<div class="oshc-venue__placeholder"><?php echo esc_html( $name ); ?></div>
				<?php endif; ?>
			</div>
			<div class="oshc-venue__info">
				<h3 class="oshc-h3"><?php echo esc_html( $name ); ?></h3>
				<div class="oshc-prose"><?php echo wp_kses_post( $desc ); ?></div>
				<div class="oshc-venue__actions">
					<?php if ( $phone ) : ?>
						<a class="oshc-btn oshc-btn--blue" href="tel:<?php echo esc_attr( preg_replace( '/\s+/', '', $phone ) ); ?>"><?php echo esc_html( $phone ); ?></a>
					<?php endif; ?>
					<?php if ( $map ) : ?>
						<a class="oshc-btn oshc-btn--ghost-blue" href="<?php echo oshc_url( $map ); ?>" target="_blank" rel="noopener"><?php esc_html_e( 'View Hotel', 'oshc' ); ?></a>
					<?php endif; ?>
				</div>
			</div>
		</div>
	</div>
</section>
