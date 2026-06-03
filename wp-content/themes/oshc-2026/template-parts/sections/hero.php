<?php
/**
 * Hero section — light skyline banner, left-aligned navy text (matches source).
 *
 * @package OSHC2026
 */

$venue   = oshc_field( 'hero_subheading', __( 'JW Marriott, Muscat', 'oshc' ) );
$dateline= oshc_field( 'hero_dateline', __( '8th – 10th October 2026', 'oshc' ) );
$heading = oshc_field( 'hero_heading', __( '8th Omani Society of Hematology Conference', 'oshc' ) );
$intro   = oshc_field( 'hero_intro', __( 'Bringing together hematological experts from across the region to share knowledge and enhance patient care.', 'oshc' ) );

$bg      = oshc_field( 'hero_bg', '' );
$bg_url  = is_array( $bg ) ? ( $bg['url'] ?? '' ) : '';
if ( ! $bg_url ) {
	$bg_url = OSHC_URI . '/assets/img/osh-banner.jpg';
}

$partners = oshc_field( 'partners_image', '' );
$partners_url = is_array( $partners ) ? ( $partners['url'] ?? '' ) : '';
if ( ! $partners_url ) {
	$partners_url = OSHC_URI . '/assets/img/osh-support.jpg';
}
?>
<section class="oshc-hero" style="background-image:url(<?php echo esc_url( $bg_url ); ?>)">
	<div class="oshc-hero__scrim"></div>
	<div class="oshc-container oshc-hero__inner">
		<div class="oshc-hero__content">
			<?php if ( $venue ) : ?><p class="oshc-hero__eyebrow"><?php echo esc_html( $venue ); ?></p><?php endif; ?>
			<?php if ( $dateline ) : ?><p class="oshc-hero__eyebrow oshc-hero__eyebrow--date"><?php echo esc_html( $dateline ); ?></p><?php endif; ?>
			<h1 class="oshc-hero__title"><?php echo esc_html( $heading ); ?></h1>
			<?php if ( $intro ) : ?><p class="oshc-hero__intro"><?php echo esc_html( $intro ); ?></p><?php endif; ?>
			<?php if ( $partners_url ) : ?>
				<div class="oshc-hero__partners">
					<img src="<?php echo esc_url( $partners_url ); ?>" alt="<?php esc_attr_e( 'Hosted by the Omani Society of Hematology, supported by the Oman Medical Association', 'oshc' ); ?>">
				</div>
			<?php endif; ?>
		</div>
	</div>
</section>
