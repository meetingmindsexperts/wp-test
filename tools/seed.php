<?php
/**
 * Dev helper: seed/refresh OSHC 2026 content from the command line.
 *   wp eval-file tools/seed.php
 *
 * Delegates to the theme's own seeding routine (inc/setup-content.php) so the
 * data set is defined in exactly one place. Not part of the deployed theme.
 */

if ( ! defined( 'ABSPATH' ) ) {
	exit;
}

if ( ! function_exists( 'oshc_seed_content' ) ) {
	WP_CLI::error( 'The OSHC 2026 theme must be active (it defines oshc_seed_content()).' );
}

oshc_seed_content();
WP_CLI::success( 'OSHC 2026 content seeded / refreshed.' );
