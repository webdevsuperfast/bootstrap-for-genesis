<?php
/**
 * Bootstrap
 *
 * @package      Bootstrap for Genesis
 * @since        1.0
 * @link         http://webdevsuperfast.github.io
 * @author       Rotsen Mark Acob <webdevsuperfast.github.io>
 * @copyright    Copyright (c) 2015, Rotsen Mark Acob
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 *
*/

// Add row class after wrap
add_filter( 'genesis_structural_wrap-footer-widgets', 'bfg_filter_structural_wrap', 10, 2 );
function bfg_filter_structural_wrap( $output, $original_output ) {
    if( 'close' == $original_output ) {
        $output = '</div>' . $output;
    }

    if ( 'open' == $original_output )  {
    	$output = $output . '<div class="row">';
    }
    return $output;
}

// Adds Filters Automatically from Array Keys
// @link https://gist.github.com/bryanwillis/0f22c3ddb0d0b9453ad0
add_action( 'genesis_meta', 'bfg_add_array_filters_genesis_attr' );
function bfg_add_array_filters_genesis_attr() {
    $filters = bfg_merge_genesis_attr_classes();
    
    foreach( array_keys( $filters ) as $context ) {
        $context = "genesis_attr_$context";
        add_filter( $context, 'bfg_add_markup_sanitize_classes', 10, 2 );
    }
}

// Clean classes output
function bfg_add_markup_sanitize_classes( $attr, $context ) {
    $classes = array();
    
    if ( has_filter( 'bfg_clean_classes_output' ) ) {
        $classes = apply_filters( 'bfg_clean_classes_output', $classes, $context, $attr );
    }
    
    $value = isset( $classes[$context] ) ? $classes[$context] : array();
    
    if ( is_array( $value ) ) {
        $classes_array = $value;
    } else {
        $classes_array = explode( ' ', ( string )$value );
    }

    $classes_array = array_map( 'sanitize_html_class', $classes_array );
    $attr['class'].= ' ' . implode( ' ', $classes_array );
    return $attr;
}

// Default array of classes to add
function bfg_merge_genesis_attr_classes() {
    global $wp_registered_sidebar;
    $classes = array(
            'content-sidebar-wrap'      => 'row',
            'content'                   => 'col-sm-8',
            'sidebar-primary'           => 'col-sm-4',
            'sidebar-secondary'         => 'col-sm-2',
            'archive-pagination'        => 'clearfix',
            'entry-content'             => 'clearfix',
            'entry-pagination'          => 'clearfix',
            'structural-wrap'           => 'container',
            'comment-list'              => 'list-unstyled',
            'home-featured'             => 'jumbotron',
            'entry-image'               => 'img-fluid'
    );

    $navclasses = array();

    $navclasses[] = 'navbar';

    $navposition = get_theme_mod( 'navposition', false );

    $navclasses[] = $navposition;

    $navcontainer = get_theme_mod( 'navcontainer', 'lg' );
    $navclasses[] = 'navbar-expand-' . $navcontainer;

    $navcolor = get_theme_mod( 'navcolor', 'dark' );

    switch( $navcolor ) {
        case 'light':
            $navclasses[] = 'navbar-light';
            $navclasses[] = 'bg-light';
            break;
        case 'dark':
        default:
            $navclasses[] = 'navbar-dark';
            $navclasses[] = 'bg-dark';
            break;
        case 'primary':
            $navclasses[] = 'navbar-dark';
            $navclasses[] = 'bg-primary';
            break;
    }

    $classes['site-header'] = esc_attr( implode( ' ', $navclasses ) );

    // Footer Class
    $footerwidgetbg = get_theme_mod( 'footerwidgetbg', 'dark' );
    
    $footerwidgetclasses = array();
    
    if ( $footerwidgetbg !== 'primary' ) {
        $footerwidgetclasses[] = 'text-muted';
    }

    $footerwidgetclasses[] = 'bg-' . $footerwidgetbg;

    $classes['footer-widgets'] = esc_attr( implode( ' ', $footerwidgetclasses ) );

    // Footer Class
    $footerbg = get_theme_mod( 'footerbg', 'dark' );

    $footerclasses = array();

    if ( $footerbg !== 'primary' ) {
        $footerclasses[] = 'text-muted';
    }

    $footerclasses[] = 'bg-' . $footerbg;

    $classes['site-footer'] = esc_attr( implode( ' ', $footerclasses ) );
    
    if ( has_filter( 'bfg_add_classes' ) ) {
        $classes = apply_filters( 'bfg_add_classes', $classes );
    }

    return $classes;
}

// Adds classes array to bfg_add_markup_class() for cleaning
add_filter( 'bfg_clean_classes_output', 'bfg_modify_classes_based_on_extras', 10, 3) ;
function bfg_modify_classes_based_on_extras( $classes, $context, $attr ) {
    $classes = bfg_merge_genesis_attr_classes( $classes );
    return $classes;
}

// Layout
// Modify bootstrap classes based on genesis_site_layout
add_filter('bfg_add_classes', 'bfg_modify_classes_based_on_template', 10, 3);

// Remove unused layouts
function bfg_layout_options_modify_classes_to_add( $classes_to_add ) {

    $layout = genesis_site_layout();
    
    if ( 'full-width-content' === $layout ) {
        $classes_to_add['content'] = 'col-sm-12';
    }

    // sidebar-content          // supported
    if ( 'sidebar-content' === $layout ) {
        $classes_to_add['content'] = 'col-sm-8';
        $classes_to_add['sidebar-primary'] = 'order-first col-sm-4';
    }

    // content-sidebar-sidebar  // supported
    if ( 'content-sidebar-sidebar' === $layout ) {
        $classes_to_add['content'] = 'col-sm-6';
        $classes_to_add['sidebar-primary'] = 'col-sm-4';
        $classes_to_add['sidebar-secondary'] = 'col-sm-2';
    }


    // sidebar-sidebar-content  // supported
    if ( 'sidebar-sidebar-content' === $layout ) {
        $classes_to_add['content'] = 'col-sm-6 order-3';
        $classes_to_add['sidebar-primary'] = 'col-sm-4 order-2';
        $classes_to_add['sidebar-secondary'] = 'col-sm-2 order-first';
    }


    // sidebar-content-sidebar  // supported
    if ( 'sidebar-content-sidebar' === $layout ) {
        $classes_to_add['content'] = 'col-sm-6';
        $classes_to_add['sidebar-primary'] = 'col-sm-4';
        $classes_to_add['sidebar-secondary'] = 'col-sm-2 order-first';
    }

    return $classes_to_add;
};

function bfg_modify_classes_based_on_template( $classes_to_add ) {
    $classes_to_add = bfg_layout_options_modify_classes_to_add( $classes_to_add );

    return $classes_to_add;
}