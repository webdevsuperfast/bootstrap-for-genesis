<?php
/**
 * Bootstrap
 *
 * @package      Bootstrap for Genesis
 * @since        1.0
 * @link         http://www.recommendwp.com
 * @author       RecommendWP <www.recommendwp.com>
 * @copyright    Copyright (c) 2015, RecommendWP
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 *
*/

// add bootstrap classes
add_filter( 'genesis_attr_nav-primary', 'bfg_add_markup_class', 10, 2 );
add_filter( 'genesis_attr_nav-secondary', 'bfg_add_markup_class', 10, 2 );
add_filter( 'genesis_attr_site-header', 'bfg_add_markup_class', 10, 2 );
add_filter( 'genesis_attr_content-sidebar-wrap','bfg_add_markup_class', 10, 2 );
add_filter( 'genesis_attr_content', 'bfg_add_markup_class', 10, 2 );
add_filter( 'genesis_attr_sidebar-primary', 'bfg_add_markup_class', 10, 2 );
add_filter( 'genesis_attr_sidebar-secondary', 'bfg_add_markup_class', 10, 2 );
add_filter( 'genesis_attr_archive-pagination', 'bfg_add_markup_class', 10, 2 );
add_filter( 'genesis_attr_entry-content', 'bfg_add_markup_class', 10, 2 );
add_filter( 'genesis_attr_entry-pagination', 'bfg_add_markup_class', 10, 2 );
add_filter( 'genesis_attr_structural-wrap', 'bfg_add_markup_class', 10,2 );
add_filter( 'genesis_attr_title-area', 'bfg_add_markup_class', 10, 2 );
add_filter( 'genesis_attr_header-widget-area', 'bfg_add_markup_class', 10, 2 );
add_filter( 'genesis_attr_copyright', 'bfg_add_markup_class', 10,2 );
add_filter( 'genesis_attr_footer-widget-area', 'bfg_add_markup_class', 10, 2 );
add_filter( 'genesis_attr_comment-list', 'bfg_add_markup_class', 10, 2 );
add_filter( 'genesis_attr_home-featured', 'bfg_add_markup_class', 10, 2 );

function bfg_add_markup_class( $attr, $context ) {
    // default classes to add
    $classes_to_add = apply_filters ('bfg-classes-to-add',
        // default bootstrap markup values
        array(
            'site-header' => 'navbar navbar-default navbar-static-top',
            // 'nav-secondary' => 'navbar navbar-inverse navbar-static-top',
            // 'site-header' => 'page-header',
            'content-sidebar-wrap' => 'row',
            'content' => 'col-sm-8',
            'sidebar-primary' => 'col-sm-4',
            'sidebar-secondary' => 'col-sm-2',
            'archive-pagination' => 'clearfix',
            'entry-content' => 'clearfix',
            'entry-pagination' => 'clearfix bfg-pagination-numeric',
            'structural-wrap' => 'container',
            // 'title-area' => !is_active_sidebar( 'header-right' ) ? 'col-sm-12' : 'col-sm-4',
            // 'header-widget-area' => 'col-sm-8',
            // 'copyright' => !is_active_sidebar( 'footer-right' ) ? 'col-sm-12 no-widget-area' : 'col-sm-6',
            'footer-widget-area' => 'col-sm-6',
            'comment-list' => 'list-unstyled',
            'home-featured' => 'jumbotron'
        ),
        $context,
        $attr
    );
    // populate $classes_array based on $classes_to_add
    $value = isset( $classes_to_add[ $context ] ) ? $classes_to_add[ $context ] : array();
    if ( is_array( $value ) ) {
        $classes_array = $value;
    } else {
        $classes_array = explode( ' ', (string) $value );
    }
    // apply any filters to modify the class
    $classes_array = apply_filters( 'bfg-add-class', $classes_array, $context, $attr );
    $classes_array = array_map( 'sanitize_html_class', $classes_array );
    // append the class(es) string (e.g. 'span9 custom-class1 custom-class2')
    $attr['class'] .= ' ' . implode( ' ', $classes_array );
    return $attr;
}

// Add row class after wrap
// add_filter( 'genesis_structural_wrap-header', 'bfg_filter_structural_wrap', 10, 2 );
// add_filter( 'genesis_structural_wrap-site-inner', 'bfg_filter_structural_wrap', 10, 2 );
// add_filter( 'genesis_structural_wrap-footer', 'bfg_filter_structural_wrap', 10, 2 );
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

// Layout
// modify bootstrap classes based on genesis_site_layout
add_filter('bfg-classes-to-add', 'bfg_modify_classes_based_on_template', 10, 3);

// remove unused layouts
function bfg_layout_options_modify_classes_to_add( $classes_to_add ) {

    $layout = genesis_site_layout();

    // content-sidebar          // default

    // full-width-content       // supported
    if ( 'full-width-content' === $layout ) {
        $classes_to_add['content'] = 'col-sm-12';
    }

    // sidebar-content          // supported
    if ( 'sidebar-content' === $layout ) {
        $classes_to_add['content'] = 'col-sm-8 col-sm-push-4';
        $classes_to_add['sidebar-primary'] = 'col-sm-4 col-sm-pull-8';
    }

    // content-sidebar-sidebar  // supported
    if ( 'content-sidebar-sidebar' === $layout ) {
        $classes_to_add['content'] = 'col-sm-6';
        $classes_to_add['sidebar-primary'] = 'col-sm-4';
        $classes_to_add['sidebar-secondary'] = 'col-sm-2';
    }


    // sidebar-sidebar-content  // supported
    if ( 'sidebar-sidebar-content' === $layout ) {
        $classes_to_add['content'] = 'col-sm-6 col-sm-push-6';
        $classes_to_add['sidebar-primary'] = 'col-sm-4 col-sm-pull-4';
        $classes_to_add['sidebar-secondary'] = 'col-sm-2 col-sm-pull-10';
    }


    // sidebar-content-sidebar  // supported
    if ( 'sidebar-content-sidebar' === $layout ) {
        $classes_to_add['content'] = 'col-sm-6 col-sm-push-2';
        $classes_to_add['sidebar-primary'] = 'col-sm-4 col-sm-push-2';
        $classes_to_add['sidebar-secondary'] = 'col-sm-2 col-sm-pull-10';
    }

    return $classes_to_add;
};

function bfg_modify_classes_based_on_template( $classes_to_add, $context, $attr ) {
    $classes_to_add = bfg_layout_options_modify_classes_to_add( $classes_to_add );

    return $classes_to_add;
}

// Skip Navigation
add_action( 'genesis_before', 'bfg_skip_navigation' );
function bfg_skip_navigation() {
    echo '<a href="#content" class="sr-only sr-only-focusable">Skip to main content</a>';
}

add_filter( 'genesis_attr_content', 'bfg_attr_content' );
function bfg_attr_content( $attr ) {
    $attr['id'] = 'content';
    return $attr;
}