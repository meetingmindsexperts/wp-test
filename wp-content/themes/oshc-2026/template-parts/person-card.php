<?php
/**
 * Reusable person card (committee member or faculty).
 *
 * @package OSHC2026
 *
 * Expects $args['id'] = post ID.
 */

$pid = isset( $args['id'] ) ? (int) $args['id'] : get_the_ID();
if ( ! $pid ) {
	return;
}

$name        = get_the_title( $pid );
$designation = oshc_field( 'designation', '', $pid );
$institution = oshc_field( 'institution', '', $pid );
$country     = oshc_field( 'country', '', $pid );
$bio         = oshc_field( 'bio', '', $pid );
$has_bio     = $bio && 'No Bio Available' !== trim( $bio );
?>
<article class="oshc-person<?php echo $has_bio ? ' has-bio' : ''; ?>"<?php echo $has_bio ? ' tabindex="0" role="button" aria-label="' . esc_attr( $name ) . '"' : ''; ?>>
	<div class="oshc-person__photo">
		<?php
		if ( has_post_thumbnail( $pid ) ) {
			echo get_the_post_thumbnail( $pid, 'medium', array( 'loading' => 'lazy', 'alt' => esc_attr( $name ) ) );
		} else {
			echo '<span class="oshc-person__initials">' . esc_html( strtoupper( mb_substr( $name, 0, 1 ) ) ) . '</span>';
		}
		?>
	</div>
	<h4 class="oshc-person__name"><?php echo esc_html( $name ); ?></h4>
	<?php foreach ( oshc_lines( $designation ) as $line ) : ?>
		<p class="oshc-person__role"><?php echo esc_html( $line ); ?></p>
	<?php endforeach; ?>
	<?php if ( $institution ) : ?>
		<p class="oshc-person__org"><?php echo esc_html( $institution ); ?></p>
	<?php endif; ?>
	<?php if ( $country ) : ?>
		<p class="oshc-person__country"><?php echo esc_html( $country ); ?></p>
	<?php endif; ?>

	<?php if ( $has_bio ) : ?>
		<div class="oshc-person__biofull" hidden>
			<?php foreach ( oshc_lines( $bio ) as $p ) : ?>
				<p><?php echo esc_html( $p ); ?></p>
			<?php endforeach; ?>
		</div>
		<span class="oshc-person__more"><?php esc_html_e( 'View bio', 'oshc' ); ?></span>
	<?php endif; ?>
</article>
