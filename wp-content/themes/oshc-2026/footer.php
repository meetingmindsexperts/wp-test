<?php
/**
 * Footer (light) — partners strip, logo + nav, copyright + subscribe.
 *
 * @package OSHC2026
 */

$oshc_partners     = oshc_field( 'partners_image', '' );
$oshc_partners_url = is_array( $oshc_partners ) ? ( $oshc_partners['url'] ?? '' ) : '';
if ( ! $oshc_partners_url ) {
	$oshc_partners_url = OSHC_URI . '/assets/img/osh-support.jpg';
}

$oshc_foot_nav = array(
	'#committee'   => __( 'Committee', 'oshc' ),
	'#program'     => __( 'Program', 'oshc' ),
	'#sponsorship' => __( 'Sponsor', 'oshc' ),
	'#contact'     => __( 'Contact', 'oshc' ),
);
$oshc_reg = oshc_field( 'register_url', 'https://meetingminds.eventsair.com/oshc2026/register-online' );
?>
</main><!-- .oshc-main -->

<footer class="oshc-footer">
	<div class="oshc-container">
		<?php if ( $oshc_partners_url ) : ?>
			<div class="oshc-footer__partners">
				<img src="<?php echo esc_url( $oshc_partners_url ); ?>" alt="<?php esc_attr_e( 'Hosted by the Omani Society of Hematology, supported by the Oman Medical Association', 'oshc' ); ?>" loading="lazy">
			</div>
		<?php endif; ?>

		<div class="oshc-footer__main">
			<a class="oshc-footer__logo" href="<?php echo esc_url( home_url( '/' ) ); ?>">
				<?php
				if ( has_custom_logo() ) {
					the_custom_logo();
				} else {
					echo '<img src="' . esc_url( OSHC_URI . '/assets/img/osh-logo.png' ) . '" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '">';
				}
				?>
			</a>
			<nav class="oshc-footer__nav" aria-label="<?php esc_attr_e( 'Footer', 'oshc' ); ?>">
				<?php foreach ( $oshc_foot_nav as $href => $label ) : ?>
					<a href="<?php echo esc_attr( $href ); ?>"><?php echo esc_html( $label ); ?></a>
				<?php endforeach; ?>
			</nav>
		</div>

		<div class="oshc-footer__bottom">
			<p class="oshc-footer__copy">&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> Meeting Minds Experts. <?php esc_html_e( 'All Rights Reserved.', 'oshc' ); ?></p>
			<a class="oshc-footer__subscribe" href="<?php echo oshc_url( $oshc_reg ); ?>" target="_blank" rel="noopener"><?php esc_html_e( 'Subscribe', 'oshc' ); ?></a>
		</div>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
