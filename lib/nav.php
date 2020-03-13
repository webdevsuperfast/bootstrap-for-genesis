<?php
/**
 * Navigation
 *
 * @package      Bootstrap for Genesis
 * @since        1.0
 * @link         http://webdevsuperfast.github.io
 * @author       Rotsen Mark Acob <webdevsuperfast.github.io>
 * @copyright    Copyright (c) 2015, Rotsen Mark Acob
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 *
*/

// remove primary & secondary nav from default position
remove_action( 'genesis_after_header', 'genesis_do_nav' );
add_action( 'genesis_header', 'genesis_do_nav' );

add_filter( 'wp_nav_menu_args', function( $args ) {

    // Get Menu Location
    $data_target = 'nav' . sanitize_html_class( '-' . $args['theme_location'] );

    $menu_classes = array(
        'navbar-nav'
    );

    $navextra = get_theme_mod( 'navextra', false );

    if ( $navextra !== '' ) {
        $menu_classes[] = 'mr-auto';
    } else {
        $menu_classes[] = 'ml-auto';
    }
    
    if ( 'primary' === $args['theme_location'] ) {
        $args['container'] = 'div';
        $args['container_class'] = 'collapse navbar-collapse';
        $args['container_id'] = $data_target;
        $args['depth'] = 0;
        $args['menu_class'] = esc_attr( implode( ' ', $menu_classes ) );
        $args['fallback_cb'] = 'WP_Bootstrap_Navwalker::fallback';
        $args['walker'] = new WP_Bootstrap_Navwalker();
    }

    return $args;
} );

// add bootstrap markup around the nav
add_filter( 'wp_nav_menu', 'bfg_nav_menu_markup_filter', 10, 2 );
function bfg_nav_menu_markup_filter( $html, $args ) {
    // only add additional Bootstrap markup to
    // primary and secondary nav locations
    if ( 'primary' !== $args->theme_location ) {
        return $html;
    }

    $data_target = 'nav' . sanitize_html_class( '-' . $args->theme_location );
    
    $output = '';

    // only include blog name and description in the nav
    // if it is the primary nav location
    if ( 'primary' === $args->theme_location ) {
        $output .= apply_filters( 'bfg_navbar_brand', bfg_navbar_brand_markup() );
    }

    $output .= '<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#'.$data_target.'" aria-controls="'.$data_target.'" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>';
    $output .= $html;
    
    $navextra = get_theme_mod( 'navextra', false );
    
    if ( $navextra == true ) {
        $output .= apply_filters( 'bfg_navbar_content', bfg_navbar_content_markup() );
    }
    
    return $output;
}

function bfg_navbar_brand_markup() {
    if ( get_theme_mod( 'custom_logo' ) ) {
        $output = get_custom_logo();
    } else {
        $output = '<a class="navbar-brand" title="'.esc_attr( get_bloginfo( 'name' ) ).'" href="'.esc_url( get_home_url( '/' ) ).'">'.get_bloginfo( 'name' ).'</a>';
    }
    return $output;
}

//* Navigation Extras
function bfg_navbar_content_markup() {
    $url = get_home_url();
    
    $choices = get_theme_mod( 'navextra', 'search' );
    
    $output = '';
    
    switch( $choices ) {
        case 'search':
        default:
            $output .= '<form class="form-inline float-lg-right" method="get" action="'.$url.'" role="search">';
            $output .= '<input class="form-control mr-sm-2" type="text" placeholder="Search" name="s">';
            $output .= '<button class="btn btn-outline-success" type="submit">Search</button>';
            $output .= '</form>';
            break;
        case 'date': 
            $output .= '<p class="navbar-text navbar-right mb-0">';
            $output .= date_i18n( get_option( 'date_format' ) );
            $output .= '</p>';
            break;
        case 'widget':
            ob_start();
            genesis_widget_area( 'header-right', array(
                'before' => '<div class="header-right navbar-text navbar-right mb-0">',
                'after' => '</div>'
            ) );
            $output .= ob_get_clean();
            break;
        case '':
            $output .= '';
            break;
    }

	return $output;
}

// Filter menu link attributes and add missing .nav-link class to parent menu link class attribute 
add_filter( 'nav_menu_link_attributes', function( $atts, $item, $args, $depth ) {
    $item_classes = array();

    // Get the current menu item class
    $item_classes[] = sanitize_html_class( $atts['class'] );

    // Apply .nav-link class to parent menu item only
    if ( $depth == 0 ) {
        $item_classes[] = 'nav-link';
    }

    $atts['class'] = join( ' ', $item_classes ); 
    
    return $atts;
}, 10, 4 );