<?php
/**
 * Comments
 *
 * @package      Bootstrap for Genesis
 * @since        1.0
 * @link         http://webdevsuperfast.github.io
 * @author       Rotsen Mark Acob <webdevsuperfast.github.io>
 * @copyright    Copyright (c) 2015, Rotsen Mark Acob
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 *
*/

// Comment Form
// @link http://www.codecheese.com/2013/11/wordpress-comment-form-with-twitter-bootstrap-3-supports/
add_filter( 'comment_form_defaults', 'bfg_comment_form_args' );
function bfg_comment_form_args( $args ) {
	$args['comment_field'] = '<div class="form-group comment-form-comment">
	        <label for="comment">' . _x( 'Comment', 'noun' ) . '</label> 
	        <textarea class="form-control" id="comment" name="comment" cols="45" rows="8" aria-required="true"></textarea>
	    </div>';
	$args['class_submit'] = 'btn btn-default'; // since WP 4.1
	
	return $args;
}

// @link http://www.codecheese.com/2013/11/wordpress-comment-form-with-twitter-bootstrap-3-supports/
add_filter( 'comment_form_default_fields', 'bfg_comment_form_fields' );
function bfg_comment_form_fields( $fields ) {
    $commenter = wp_get_current_commenter();
    
    $req      = get_option( 'require_name_email' );
    $aria_req = ( $req ? " aria-required='true'" : '' );
    $html5    = current_theme_supports( 'html5', 'comment-form' ) ? 1 : 0;
    
    $fields   =  array(
        'author' => '<div class="form-group comment-form-author">' . '<label for="author">' . __( 'Name' ) . ( $req ? ' <span class="text-muted required">*</span>' : '' ) . '</label> ' .
                    '<input class="form-control" id="author" name="author" type="text" value="' . esc_attr( $commenter['comment_author'] ) . '" size="30"' . $aria_req . ' /></div>',
        'email'  => '<div class="form-group comment-form-email"><label for="email">' . __( 'Email' ) . ( $req ? ' <span class="text-muted required">*</span>' : '' ) . '</label> ' .
                    '<input class="form-control" id="email" name="email" ' . ( $html5 ? 'type="email"' : 'type="text"' ) . ' value="' . esc_attr(  $commenter['comment_author_email'] ) . '" size="30"' . $aria_req . ' /></div>',
        'url'    => '<div class="form-group comment-form-url"><label for="url">' . __( 'Website' ) . '</label> ' .
                    '<input class="form-control" id="url" name="url" ' . ( $html5 ? 'type="url"' : 'type="text"' ) . ' value="' . esc_attr( $commenter['comment_author_url'] ) . '" size="30" /></div>'        
    );
    
    return $fields;
}
