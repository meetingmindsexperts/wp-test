<?php
/**
 * Hero section.
 *
 * @package OSHC2026
 */

$sub     = oshc_field( 'hero_subheading', __( 'Stay informed, prepared, and inspired', 'oshc' ) );
$heading = oshc_field( 'hero_heading', __( '8th Omani Society of Hematology Conference', 'oshc' ) );
$dateline= oshc_field( 'hero_dateline', __( 'October 8–10, 2026  ·  Muscat, Oman', 'oshc' ) );
$intro   = oshc_field( 'hero_intro', __( 'Explore the scientific agenda, speaker profiles, abstract submissions, CME details, exhibitor opportunities, and exclusive announcements — your go-to hub for professionals advancing hematology.', 'oshc' ) );
$reg     = oshc_field( 'register_url', 'https://meetingminds.eventsair.com/oshc2026/register-online' );
$bg      = oshc_field( 'hero_bg', '' );
$bg_url  = is_array( $bg ) ? ( $bg['url'] ?? '' ) : '';
if ( ! $bg_url ) {
	$bg_url = OSHC_URI . '/assets/img/osh-banner.jpg';
}

$style = ' style="background-image:linear-gradient(rgba(43,57,144,.82),rgba(150,29,33,.86)),url(' . esc_url( $bg_url ) . ')"';
?>
<section class="oshc-hero"<?php echo $style; // phpcs:ignore ?>>
	<div class="oshc-container oshc-hero__inner">
		<p class="oshc-hero__sub"><?php echo esc_html( $sub ); ?></p>
		<h1 class="oshc-hero__title"><?php echo esc_html( $heading ); ?></h1>
		<?php if ( $dateline ) : ?>
			<p class="oshc-hero__date"><?php echo esc_html( $dateline ); ?></p>
		<?php endif; ?>
		<?php if ( $intro ) : ?>
			<p class="oshc-hero__intro"><?php echo esc_html( $intro ); ?></p>
		<?php endif; ?>
		<div class="oshc-hero__actions">
			<a class="oshc-btn oshc-btn--red" href="<?php echo oshc_url( $reg ); ?>" target="_blank" rel="noopener"><?php esc_html_e( 'Register Now', 'oshc' ); ?></a>
			<a class="oshc-btn oshc-btn--ghost" href="#welcome"><?php esc_html_e( 'Learn More', 'oshc' ); ?></a>
		</div>
	</div>
</section>
