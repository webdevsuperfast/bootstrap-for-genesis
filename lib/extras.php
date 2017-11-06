<?php
/**
 * Extras
 *
 * @package      B4Genesis
 * @since        1.0
 * @link         http://rotsenacob.com
 * @author       Rotsen Mark Acob <rotsenacob.com>
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