<?php
/**
 * FAQ accordion (optionally grouped by FAQ Group).
 *
 * @package OSHC2026
 */

$intro = oshc_field( 'faq_intro', __( "Find information on registration, session details, and networking opportunities. We're here to ensure you have a seamless conference experience.", 'oshc' ) );

/**
 * Render an accordion list for a WP_Query of FAQ posts.
 */
$render_items = function ( $query ) {
	echo '<div class="oshc-accordion" data-accordion>';
	while ( $query->have_posts() ) {
		$query->the_post();
		echo '<div class="oshc-acc">';
		echo '<button class="oshc-acc__q" aria-expanded="false"><span>' . esc_html( get_the_title() ) . '</span><i class="oshc-acc__icon" aria-hidden="true"></i></button>';
		echo '<div class="oshc-acc__a"><div class="oshc-prose">' . wp_kses_post( get_the_content() ) . '</div></div>';
		echo '</div>';
	}
	wp_reset_postdata();
	echo '</div>';
};

$groups = get_terms(
	array(
		'taxonomy'   => 'oshc_faq_group',
		'hide_empty' => true,
		'orderby'    => 'term_order',
	)
);

$all = oshc_query( 'oshc_faq' );
if ( ! $all->have_posts() && ( is_wp_error( $groups ) || empty( $groups ) ) ) {
	return;
}
?>
<section class="oshc-section oshc-section--alt" id="faq">
	<div class="oshc-container oshc-narrow">
		<p class="oshc-eyebrow oshc-center"><?php esc_html_e( 'Frequently Asked Questions', 'oshc' ); ?></p>
		<h2 class="oshc-h2 oshc-center"><?php esc_html_e( 'Comprehensive answers for attendees', 'oshc' ); ?></h2>
		<?php if ( $intro ) : ?>
			<p class="oshc-lead oshc-center"><?php echo esc_html( $intro ); ?></p>
		<?php endif; ?>

		<?php
		if ( ! is_wp_error( $groups ) && ! empty( $groups ) ) {
			foreach ( $groups as $group ) {
				$q = oshc_query(
					'oshc_faq',
					array(
						'tax_query' => array(
							array(
								'taxonomy' => 'oshc_faq_group',
								'field'    => 'term_id',
								'terms'    => $group->term_id,
							),
						),
					)
				);
				if ( ! $q->have_posts() ) {
					continue;
				}
				echo '<h3 class="oshc-h3 oshc-faq__group">' . esc_html( $group->name ) . '</h3>';
				$render_items( $q );
			}
		} else {
			$render_items( $all );
		}
		?>
	</div>
</section>
