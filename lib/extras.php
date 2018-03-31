<?php
/**
 * Extras
 *
 * @package      Bootstrap for Genesis
 * @since        1.0
 * @link         http://webdevsuperfast.github.io
 * @author       Rotsen Mark Acob <webdevsuperfast.github.io>
 * @copyright    Copyright (c) 2017, Rotsen Mark Acob
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 *
*/
// Add class to images
// @link http://stackoverflow.com/a/22078964
add_filter( 'the_content', 'bfg_image_responsive_class' );
function bfg_image_responsive_class( $content ) {
   global $post;
   
   $pattern ="/<img(.*?)class=\"(.*?)\"(.*?)>/i";
   $replacement = '<img$1class="$2 img-fluid"$3>';
   $content = preg_replace( $pattern, $replacement, $content );
   
   return $content;
}

add_filter( 'body_class', 'page_blog_class' );
function page_blog_class( $classes ) {
    if ( is_page_template( 'page_blog.php' ) ) {
        $classes[] = 'blog';
    }

    return $classes;
}

// Remove Parentheses on Archive/Categories
// @link http://wordpress.stackexchange.com/questions/88545/how-to-remove-the-parentheses-from-the-category-widget
add_filter( 'wp_list_categories', 'bfg_categories_postcount_filter', 10, 2 );
add_filter( 'get_archives_link', 'bfg_categories_postcount_filter', 10, 2 );
function bfg_categories_postcount_filter( $variable ) {
   $variable = str_replace( '(', '<span class="badge badge-pill badge-primary tag-default post-count">', $variable );
   $variable = str_replace( ')', '</span>', $variable );
   return $variable;
}

add_filter( 'the_password_form', function() {
    global $post;

    $label = 'pwbox-'.( empty( $post->ID ) ? rand() : $post->ID );

    $o = '<p>'.__( "To view this protected post, enter the password below:" ).'</p><form class="form-inline" action="' . esc_url( site_url( 'wp-login.php?action=postpass', 'login_post' ) ) . '" method="post"><label for="' . $label . '" class="sr-only">' . __( "Password:" ) . ' </label><input class="form-control mr-2"name="post_password" id="' . $label . '" type="password" size="20" maxlength="20" /><input type="submit" class="btn btn-primary" name="Submit" value="' . esc_attr__( "Submit" ) . '" />
    </form>
    ';
    return $o;
} );

// Filter viewport meta values for Bootstrap
add_filter( 'genesis_viewport_value', 'bfg_viewport_value' );
function bfg_viewport_value() {
    return 'width=device-width, initial-scale=1, shrink-to-fit=no';
}

add_filter( 'genesis_register_widget_area_defaults', function( $defaults ) {
    global $wp_registered_sidebars;
    global $wp_widget_factory;
    // $test = $wp_widget_factory->widgets['WP_Widget_Recent_Posts'];

    // if ( isset( $wp_registered_sidebars['sidebar'] ) ) {
        $defaults = array(
            'before_widget' => genesis_markup( array(
                'open'    => '<section id="%%1$s" class="widget %%2$s">',
                'context' => 'widget-wrap',
                'echo'    => false,
            ) ),
            'after_widget'  => genesis_markup( array(
                'close'   => '</section>' . "\n",
                'context' => 'widget-wrap',
                'echo'    => false
            ) ),
            'before_title'  => '<h4 class="widget-title widgettitle">',
            'after_title'   => '</h4><div class="widget-wrap">',
        );
    // }

    return $defaults;
} );

add_filter( 'wp_link_pages_args', function( $params ) {
    $params['before'] = '<ul class="post-pagination">';
    $params['after'] = '</ul>';
    return $params;
} );

add_filter( 'wp_link_pages_link', function( $link ) {
    // var_dump( $link[1] );
    if ( $link && 'a' !== $link[1] ) {
        $link = '<li class="page-item active"><a href="#">' . $link . '</a></li>';
    } else {
        $link = '<li class="page-item">' . $link . '</li>';
    }
    return $link;
} );

add_filter( 'genesis_footer_creds_text', function( $creds ) {
    if ( get_theme_mod( 'creds', false ) ) {
        $creds = get_theme_mod( 'creds' );
    }

    return $creds;
} );

// Remove P tags wrapping on images
add_filter( 'the_content', 'bfg_filter_ptags_on_images' );
function bfg_filter_ptags_on_images( $content ) {
	return preg_replace( '/<p>\s*(<a .*>)?\s*(<img .* \/>)\s*(\/a>)?\s*<\/p>/iU', '\1\2\3', $content );
}

// Replace custom logo class to bootstrap
add_filter( 'get_custom_logo', function( $html ) {
    $html = str_replace( 'custom-logo-link', 'navbar-brand', $html );

    return $html;
}, 10 );