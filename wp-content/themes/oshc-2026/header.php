<?php
/**
 * Header: top banner + sticky navigation.
 *
 * @package OSHC2026
 */

$oshc_banner    = oshc_field( 'banner_text', '' );
$oshc_banner_url = oshc_field( 'banner_url', '#register' );
$oshc_reg_url   = oshc_field( 'register_url', 'https://meetingminds.eventsair.com/oshc2026/register-online' );

$oshc_nav = array(
	'#committee'    => __( 'Committee', 'oshc' ),
	'#program'      => __( 'Program', 'oshc' ),
	'#abstracts'    => __( 'Abstract', 'oshc' ),
	'#sponsorship'  => __( 'Sponsor', 'oshc' ),
	'#gallery'      => __( 'Gallery', 'oshc' ),
	'#venue'        => __( 'Venue', 'oshc' ),
	'#contact'      => __( 'Contact', 'oshc' ),
);
?>
<!doctype html>
<html <?php language_attributes(); ?>>
<head>
	<meta charset="<?php bloginfo( 'charset' ); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<?php wp_head(); ?>
</head>
<body <?php body_class(); ?>>
<?php wp_body_open(); ?>

<?php if ( $oshc_banner ) : ?>
	<a class="oshc-topbanner" href="<?php echo oshc_url( $oshc_banner_url ); ?>">
		<span><?php echo esc_html( $oshc_banner ); ?></span>
	</a>
<?php endif; ?>

<header class="oshc-header" id="home">
	<div class="oshc-container oshc-header__inner">
		<a class="oshc-logo" href="<?php echo esc_url( home_url( '/' ) ); ?>" aria-label="<?php echo esc_attr( get_bloginfo( 'name' ) ); ?>">
			<?php
			if ( has_custom_logo() ) {
				the_custom_logo();
			} else {
				echo '<img class="oshc-logo__img" src="' . esc_url( OSHC_URI . '/assets/img/osh-logo.png' ) . '" alt="' . esc_attr( get_bloginfo( 'name' ) ) . '">';
			}
			?>
		</a>

		<button class="oshc-navtoggle" aria-expanded="false" aria-controls="oshc-nav" aria-label="<?php esc_attr_e( 'Toggle menu', 'oshc' ); ?>">
			<span></span><span></span><span></span>
		</button>

		<nav class="oshc-nav" id="oshc-nav" aria-label="<?php esc_attr_e( 'Primary', 'oshc' ); ?>">
			<ul>
				<?php foreach ( $oshc_nav as $href => $label ) : ?>
					<li><a href="<?php echo esc_attr( $href ); ?>"><?php echo esc_html( $label ); ?></a></li>
				<?php endforeach; ?>
			</ul>
			<a class="oshc-btn oshc-btn--red oshc-nav__cta" href="<?php echo oshc_url( $oshc_reg_url ); ?>" target="_blank" rel="noopener"><?php esc_html_e( 'Register', 'oshc' ); ?></a>
		</nav>
	</div>
</header>

<main id="content" class="oshc-main">
