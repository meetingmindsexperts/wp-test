<?php
/**
 * Front page — the OSHC 2026 one-page site.
 *
 * @package OSHC2026
 */

get_header();

oshc_section( 'hero' );
oshc_section( 'stats' );
oshc_section( 'welcome' );          // Welcome remarks + Organizing/Scientific committee tabs.
oshc_section( 'attendees-dates' );  // Attendees & Benefits / Important Dates tabs.
oshc_section( 'program' );          // Program highlights + CME + Faculty tabs.
oshc_section( 'abstracts' );    // Scientific Voices.
oshc_section( 'register' );     // Pricing + what's included.
oshc_section( 'sponsorship' );  // Unlock New Horizons.
oshc_section( 'gallery' );
oshc_section( 'venue' );
oshc_section( 'faq' );
oshc_section( 'contact' );

get_footer();
