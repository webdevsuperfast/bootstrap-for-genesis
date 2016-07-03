<?php
/**
 * Pagination
 *
 * @package      Bootstrap for Genesis
 * @since        1.0
 * @link         http://www.recommendwp.com
 * @author       RecommendWP <www.recommendwp.com>
 * @copyright    Copyright (c) 2015, RecommendWP
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 *
*/

// Add Type Class
remove_filter( 'genesis_attr_archive-pagination', 'genesis_attributes_pagination' );
add_filter( 'bfg-add-class', 'bfg_prev_next_or_numeric_archive_pagination', 10, 2 );

function bfg_prev_next_or_numeric_archive_pagination( $classes_array, $context ) {
    if ( 'archive-pagination' !== $context ) {
        return $classes_array;
    }

    if ( 'numeric' === genesis_get_option( 'posts_nav' ) ) {
        $classes_array[] = 'bfg-pagination-numeric';
    } else {
        $classes_array[] = 'bfg-pagination-prev-next';
    }
    
    return $classes_array;
}

// Pagination Numeric
add_filter( 'genesis_prev_link_text', 'bfg_genesis_prev_link_text_numeric' );
add_filter( 'genesis_next_link_text', 'bfg_genesis_next_link_text_numeric' );

function bfg_genesis_prev_link_text_numeric( $text ) {
    if ( 'numeric' === genesis_get_option( 'posts_nav' ) ) {
        return '<span aria-hidden="true">&laquo;</span>'
            . '<span class="sr-only">' . __( 'Previous Page', 'genesis' ) . '</span>';
    }
    return $text;
}

function bfg_genesis_next_link_text_numeric( $text ) {
    if ( 'numeric' === genesis_get_option( 'posts_nav' ) ) {
        return '<span class="sr-only">' . __( 'Next Page', 'genesis' ) . '</span>'
            . '<span aria-hidden="true">&raquo;</span>';
    }
    return $text;
}

// Pagination Prev/Next
remove_action( 'genesis_after_endwhile', 'genesis_posts_nav' );
add_action( 'genesis_after_endwhile', 'bfg_genesis_posts_nav' );

function bfg_genesis_posts_nav() {
    if ( 'numeric' === genesis_get_option( 'posts_nav' ) ) {
		genesis_numeric_posts_nav();
    } else {
        bfg_genesis_prev_next_posts_nav();
    }
}

function bfg_genesis_prev_next_posts_nav() {
	$prev_link = get_previous_posts_link( apply_filters( 'genesis_prev_link_text', '<span aria-hidden="true">&larr;</span> ' . __( 'Previous Page', 'genesis' ) ) );
	$next_link = get_next_posts_link( apply_filters( 'genesis_next_link_text', __( 'Next Page', 'genesis' ) . ' <span aria-hidden="true">&rarr;</span>' ) );

	$prev = $prev_link ? '<li class="previous">' . $prev_link . '</li>' : '';
	$next = $next_link ? '<li class="next">' . $next_link . '</li>' : '';

	$nav = genesis_markup( array(
		'html5'   => '<nav %s><ul class="pager">',
		'xhtml'   => '<div class="navigation">',
		'context' => 'archive-pagination',
		'echo'    => false,
	) );

	$nav .= $prev;
	$nav .= $next;
	$nav .= '</ul></nav>';

	if ( $prev || $next )
		echo $nav;
}

// Content Navigation
remove_action( 'genesis_entry_content', 'genesis_do_post_content_nav', 12 );
add_action( 'genesis_entry_content', 'bsg_do_post_content_nav', 12 );
add_filter( 'wp_link_pages_link', 'bsg_wp_link_pages_link' );

function bsg_wp_link_pages_link( $link ) {
    if ( $link && '<' !== $link[0] ) {
        return '<li class="active"><a href="#">' . $link . '</a></li>';
    } else {
        return '<li>' . $link . '</li>';
    }
}

function bsg_do_post_content_nav( $attr ) {
    wp_link_pages( array(
        'before' => '<div class="bsg-post-content-nav">'
                . '<p>' . __( 'Pages:', 'genesis' ) . '</p>'
                . genesis_markup( array(
                    'html5'   => '<div %s><ul>',
                    'xhtml'   => '<div %s><ul>',
                    'context' => 'entry-pagination',
                    'echo'    => false,
                ) ),
        'after'  => '</ul></div></div>',
    ) );
}