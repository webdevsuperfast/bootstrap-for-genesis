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
   $variable = str_replace( '(', '<span class="tag tag-pill tag-default post-count">', $variable );
   $variable = str_replace( ')', '</span>', $variable );
   return $variable;
}
