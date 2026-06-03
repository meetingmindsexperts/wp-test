<?php
/**
 * Scientific Voices — abstract submission.
 *
 * @package OSHC2026
 */

$heading    = oshc_field( 'abstracts_heading', __( 'Scientific Voices', 'oshc' ) );
$intro      = oshc_field( 'abstracts_intro', __( 'Oral and poster presentations provide a valuable platform to share your research with a focused and engaged audience, enabling direct feedback, discussion, and collaboration.', 'oshc' ) );
$topics     = oshc_lines( oshc_field( 'suggested_topics', "Bone Marrow Transplantation\nLeukemias\nMDS & Bone Marrow Failure\nPalliative Care\nTransfusion Medicine\nHematopathology\nLymphoma\nMyeloma and Plasma Cell Disorders\nThrombosis and Hemostasis" ) );
$guidelines = oshc_field( 'abstract_guidelines', '<p>A special criterion for accepting abstracts will be their topic as well as structure, content and degree of innovation.</p><ul><li>A maximum of 300 words is permitted. Titles and author names are excluded and entered separately. Tables should not be included in the abstract body.</li><li>The methods section should include the type of statistical analysis done, if applicable.</li><li>Statements like “Results will be discussed” are not acceptable and may lead to rejection.</li></ul>' );
$submit_url = oshc_field( 'submit_abstract_url', 'https://meetingminds.eventsair.com/oshc2026/call-for-abstract' );
?>
<section class="oshc-section oshc-section--alt" id="abstracts">
	<div class="oshc-container">
		<h2 class="oshc-h2 oshc-center"><?php echo esc_html( $heading ); ?></h2>
		<?php if ( $intro ) : ?>
			<p class="oshc-lead oshc-center oshc-narrow"><?php echo esc_html( $intro ); ?></p>
		<?php endif; ?>

		<div class="oshc-abstracts">
			<div class="oshc-abstracts__col">
				<h3 class="oshc-h3"><?php esc_html_e( 'Suggested Topics', 'oshc' ); ?></h3>
				<ul class="oshc-checklist">
					<?php foreach ( $topics as $t ) : ?>
						<li><?php echo esc_html( $t ); ?></li>
					<?php endforeach; ?>
				</ul>
				<a class="oshc-btn oshc-btn--blue" href="<?php echo oshc_url( $submit_url ); ?>" target="_blank" rel="noopener"><?php esc_html_e( 'Submit Abstract', 'oshc' ); ?></a>
			</div>
			<div class="oshc-abstracts__col oshc-prose">
				<h3 class="oshc-h3"><?php esc_html_e( 'Guidelines for submitting an abstract', 'oshc' ); ?></h3>
				<?php echo wp_kses_post( $guidelines ); ?>
			</div>
		</div>
	</div>
</section>
