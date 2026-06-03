<?php
/**
 * Footer: partners band + dark footer bar.
 *
 * @package OSHC2026
 */

$oshc_partners = oshc_field( 'partners_image', '' );
$oshc_partners_url = is_array( $oshc_partners ) ? ( $oshc_partners['url'] ?? '' ) : '';
if ( ! $oshc_partners_url ) {
	$oshc_partners_url = OSHC_URI . '/assets/img/osh-support.jpg';
}
?>
</main><!-- .oshc-main -->

<?php if ( $oshc_partners_url ) : ?>
	<section class="oshc-partners">
		<div class="oshc-container">
			<img src="<?php echo esc_url( $oshc_partners_url ); ?>" alt="<?php esc_attr_e( 'Hosted by the Omani Society of Hematology, supported by the Oman Medical Association', 'oshc' ); ?>" loading="lazy">
		</div>
	</section>
<?php endif; ?>

<footer class="oshc-footer">
	<div class="oshc-container oshc-footer__inner">
		<div class="oshc-footer__brand">
			<?php
			if ( has_custom_logo() ) {
				the_custom_logo();
			} else {
				echo '<span class="oshc-logo__text oshc-logo__text--light">OSHC <strong>2026</strong></span>';
			}
			?>
		</div>
		<p class="oshc-footer__copy">
			&copy; <?php echo esc_html( gmdate( 'Y' ) ); ?> <?php echo esc_html( get_bloginfo( 'name' ) ); ?>.
			<?php esc_html_e( 'Organised by MeetingMinds.', 'oshc' ); ?>
			<a href="https://www.meetingmindsgroup.com/privacy-policy" target="_blank" rel="noopener"><?php esc_html_e( 'Privacy Policy', 'oshc' ); ?></a>
		</p>
		<a class="oshc-backtotop" href="#home" aria-label="<?php esc_attr_e( 'Back to top', 'oshc' ); ?>">&uarr;</a>
	</div>
</footer>

<?php wp_footer(); ?>
</body>
</html>
