<?php
/**
 * Miscellaneous
 *
 * @package      Bootstrap for Genesis
 * @since        1.0
 * @link         http://webdevsuperfast.github.io
 * @author       Rotsen Mark Acob <webdevsuperfast.github.io>
 * @copyright    Copyright (c) 2015, Rotsen Mark Acob
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
		'open' => '<div %s>',
		'context' => 'home-featured'
	) );

	genesis_structural_wrap( 'home-featured' );

	genesis_widget_area( 'home-featured', array(
		'before' => '',
		'after' => ''
	) );

	genesis_structural_wrap( 'home-featured', 'close' );

	genesis_markup( array(
		'close' => '</div>',
		'context' => 'home-featured'
	) );
}

// Body Class
function bfg_body_class( $args ) {
	if ( is_page_template( 'page_blog.php' ) )
		$args[] = 'blog';

	return $args;
}