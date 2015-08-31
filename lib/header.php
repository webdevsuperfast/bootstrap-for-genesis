<?php
/**
 * Custom Header
 *
 * @package      Bootstrap for Genesis
 * @since        1.0
 * @link         http://www.superfastbusiness.com
 * @author       SuperFastBusiness <www.superfastbusiness.com>
 * @copyright    Copyright (c) 2015, SuperFastBusiness
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 *
*/

// Custom Header
remove_action( 'wp_head', 'genesis_custom_header_style' );
remove_action( 'genesis_header', 'genesis_do_header' );
add_action( 'genesis_header', 'mb_do_header' );

function mb_do_header() {
    global $wp_registered_sidebars;

    genesis_markup( array(
        'html5'   => '<div %s>',
        'xhtml'   => '<div class="title-area" id="title-area">',
        'context' => 'title-area'
    ) );
    if ( get_theme_mod( 'logo', false ) ) {
        echo '<h1 class="site-title" itemprop="headline">';
            echo '<a href="'.get_bloginfo( 'url' ).'" class="logo" title="'.get_bloginfo( 'name' ).'">';
                echo '<img src="'.get_theme_mod( 'logo' ).'" width="'.$width.'" height="'.$height.'" alt="'.get_bloginfo( 'name' ).'"/>';
            echo '</a>';
        echo '</h1>';
    } else {
        do_action( 'genesis_site_title' );
        do_action( 'genesis_site_description' );
    }
    echo '</div>';

    if ( ( isset( $wp_registered_sidebars['header-right'] ) && is_active_sidebar( 'header-right' ) ) || has_action( 'genesis_header_right' ) ) {
        genesis_markup( array(
            'html5'   => '<aside %s>',
            'xhtml'   => '<div class="widget-area header-widget-area">',
            'context' => 'header-widget-area',
        ) );

            do_action( 'genesis_header_right' );
            add_filter( 'wp_nav_menu_args', 'genesis_header_menu_args' );
            add_filter( 'wp_nav_menu', 'genesis_header_menu_wrap' );
            dynamic_sidebar( 'header-right' );
            remove_filter( 'wp_nav_menu_args', 'genesis_header_menu_args' );
            remove_filter( 'wp_nav_menu', 'genesis_header_menu_wrap' );

        genesis_markup( array(
            'html5' => '</aside>',
            'xhtml' => '</div>',
        ) );
    }
}