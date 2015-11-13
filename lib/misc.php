<?php
/**
 * Miscellaneous
 *
 * @package      Bootstrap for Genesis
 * @since        1.0
 * @link         http://www.superfastbusiness.com
 * @author       SuperFastBusiness <www.superfastbusiness.com>
 * @copyright    Copyright (c) 2015, SuperFastBusiness
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 *
*/

// Custom Image Function
function bfg_post_image() {
	global $post;
	$image = '';
	$image_id = get_post_thumbnail_id( $post->ID );
	$image = wp_get_attachment_image_src( $image_id, 'full' );
	$image = $image[0];
	if ( $image ) return $image;
	return bfg_get_first_image();
}

// Get the First Image Attachment Function
function bfg_get_first_image() {
	global $post, $posts;
	$first_img = '';
	ob_start();
	ob_end_clean();
	$output = preg_match_all( '/<img.+src=[\'"]([^\'"]+)[\'"].*>/i', $post->post_content, $matches );
	$first_img = "";
	if ( isset( $matches[1][0] ) )
		$first_img = $matches[1][0];
	return $first_img;
}

// Custom Meta
add_action( 'genesis_meta', 'bfg_do_meta' );
function bfg_do_meta() {
	// Jumbotron
	if ( is_front_page() && is_active_sidebar( 'home-featured' ) ) add_action( 'genesis_after_header', 'bfg_do_home_featured' );

	// Body Class
	add_filter( 'body_class', 'bfg_body_class' );
}

// Jumbotron
function bfg_do_home_featured() {
	genesis_markup( array(
		'html5' => '<div %s>',
		'xhtml' => '<div class="home-featured">',
		'context' => 'home-featured'
	) );

	genesis_structural_wrap( 'home-featured' );

	genesis_widget_area( 'home-featured', array(
		'before' => '',
		'after' => ''
	) );

	genesis_structural_wrap( 'home-featured', 'close' );

	echo '</div>';
}

// Body Class
function bfg_body_class( $args ) {
	if ( is_page_template( 'page_blog.php' ) )
		$args[] = 'blog';

	return $args;
}

// Better Linebreaks
// @link https://github.com/jer0dh/bones-for-genesis-2-0-bootstrap/blob/master/functions.php
// remove_filter( 'the_content', 'wpautop' );
// add_filter( 'the_content', 'bfg_wpautop' , 99);
// add_filter( 'the_content', 'shortcode_unautop', 100 );

function bfg_wpautop( $pee ) {
	return wpautop( $pee, false );
}

// Remove Parentheses on Archive/Categories
// @link http://wordpress.stackexchange.com/questions/88545/how-to-remove-the-parentheses-from-the-category-widget
add_filter( 'wp_list_categories', 'bfg_categories_postcount_filter', 10, 2 );
add_filter( 'get_archives_link', 'bfg_categories_postcount_filter', 10, 2 );
function bfg_categories_postcount_filter( $variable ) {
   $variable = str_replace( '(', '<span class="badge post-count">', $variable );
   $variable = str_replace( ')', '</span>', $variable );
   return $variable;
}

// Allow PHP Execution on Widgets
add_filter( 'widget_text','bfg_execute_php', 100 );
function bfg_execute_php( $html ) {
	if( strpos( $html,"<"."?php" ) !== false ){
		ob_start();
		eval( "?".">".$html );
		$html=ob_get_contents();
		ob_end_clean();
	}

	return $html;
}

// Mr Image Resize functionn
function bfg_thumb($url, $width, $height=0, $align='') {
	return mr_image_resize($url, $width, $height, true, $align, false);
}
