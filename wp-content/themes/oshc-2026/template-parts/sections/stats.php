<?php
/**
 * Stats bar (animated count-up).
 *
 * @package OSHC2026
 */

$stats = array(
	array( oshc_field( 'stat1_number', '1235' ), oshc_field( 'stat1_label', __( 'Attendees expected', 'oshc' ) ), oshc_field( 'stat1_text', __( 'Healthcare professionals, researchers, and students', 'oshc' ) ) ),
	array( oshc_field( 'stat2_number', '30' ), oshc_field( 'stat2_label', __( 'Sessions', 'oshc' ) ), oshc_field( 'stat2_text', __( 'International collaboration and networking', 'oshc' ) ) ),
	array( oshc_field( 'stat3_number', '112' ), oshc_field( 'stat3_label', __( 'Talks', 'oshc' ) ), oshc_field( 'stat3_text', __( 'Interactive talks and hands-on workshops', 'oshc' ) ) ),
	array( oshc_field( 'stat4_number', '99' ), oshc_field( 'stat4_label', __( 'Expert speakers', 'oshc' ) ), oshc_field( 'stat4_text', __( 'Leading voices in hematology medicine', 'oshc' ) ) ),
);
?>
<section class="oshc-stats">
	<div class="oshc-container oshc-stats__grid">
		<?php foreach ( $stats as $s ) : ?>
			<?php if ( '' === trim( (string) $s[0] ) && '' === trim( (string) $s[1] ) ) { continue; } ?>
			<div class="oshc-stat">
				<div class="oshc-stat__num"><span class="oshc-count" data-count="<?php echo esc_attr( preg_replace( '/[^0-9]/', '', $s[0] ) ); ?>"><?php echo esc_html( $s[0] ); ?></span><span class="oshc-stat__plus">+</span></div>
				<div class="oshc-stat__label"><?php echo esc_html( $s[1] ); ?></div>
				<div class="oshc-stat__text"><?php echo esc_html( $s[2] ); ?></div>
			</div>
		<?php endforeach; ?>
	</div>
</section>
