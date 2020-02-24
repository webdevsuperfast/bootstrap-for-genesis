<?php
/**
 * Template Name: Archive
 */

remove_action( 'genesis_entry_content', 'genesis_do_post_content' );
add_action( 'genesis_entry_content', 'genesis_page_archive_content' );

function genesis_page_archive_content() {
    $heading = ( genesis_a11y( 'headings' ) ? 'h2' : 'h4' );

    genesis_sitemap( $heading );
}

genesis();