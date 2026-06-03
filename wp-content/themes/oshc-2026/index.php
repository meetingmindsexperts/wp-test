<?php
/**
 * Fallback template. The site is a one-pager driven by front-page.php; this
 * keeps the theme valid and renders any stray page/post reasonably.
 *
 * @package OSHC2026
 */

get_header();
?>
<section class="oshc-section">
	<div class="oshc-container oshc-prose">
		<?php
		if ( have_posts() ) :
			while ( have_posts() ) :
				the_post();
				echo '<h1>' . esc_html( get_the_title() ) . '</h1>';
				the_content();
			endwhile;
		else :
			echo '<h1>' . esc_html__( 'Nothing here yet', 'oshc' ) . '</h1>';
		endif;
		?>
	</div>
</section>
<?php
get_footer();
