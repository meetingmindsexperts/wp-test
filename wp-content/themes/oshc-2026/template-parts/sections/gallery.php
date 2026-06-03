<?php
/**
 * Gallery.
 *
 * @package OSHC2026
 */

$intro    = oshc_field( 'gallery_intro', __( 'Here’s a quick glimpse at the 7th Omani Society of Hematology Conference.', 'oshc' ) );
$more_url  = oshc_field( 'gallery_view_more_url', '' );
$images    = oshc_query( 'oshc_gallery' );

if ( ! $images->have_posts() ) {
	return; // Hide the whole section until photos are added.
}
?>
<section class="oshc-section oshc-section--alt" id="gallery">
	<div class="oshc-container">
		<h2 class="oshc-h2 oshc-center"><?php esc_html_e( 'Gallery', 'oshc' ); ?></h2>
		<?php if ( $intro ) : ?>
			<p class="oshc-lead oshc-center"><?php echo esc_html( $intro ); ?></p>
		<?php endif; ?>

		<div class="oshc-gallery">
			<?php
			while ( $images->have_posts() ) :
				$images->the_post();
				if ( ! has_post_thumbnail() ) {
					continue;
				}
				$caption = oshc_field( 'caption', '', get_the_ID() );
				$full    = get_the_post_thumbnail_url( get_the_ID(), 'full' );
				?>
				<a class="oshc-gallery__item" href="<?php echo esc_url( $full ); ?>" data-lightbox title="<?php echo esc_attr( $caption ); ?>">
					<?php the_post_thumbnail( 'large', array( 'loading' => 'lazy', 'alt' => esc_attr( $caption ? $caption : get_the_title() ) ) ); ?>
				</a>
			<?php endwhile; wp_reset_postdata(); ?>
		</div>

		<?php if ( $more_url ) : ?>
			<div class="oshc-center">
				<a class="oshc-btn oshc-btn--ghost-blue" href="<?php echo oshc_url( $more_url ); ?>" target="_blank" rel="noopener"><?php esc_html_e( 'View More', 'oshc' ); ?></a>
			</div>
		<?php endif; ?>
	</div>
</section>
