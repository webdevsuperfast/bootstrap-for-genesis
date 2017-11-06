<?php
/**
 * Pagination
 *
 * @package      B4Genesis
 * @since        1.0
 * @link         http://rotsenacob.com
 * @author       Rotsen Mark Acob <rotsenacob.com>
 * @copyright    Copyright (c) 2017, Rotsen Mark Acob
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 *
*/

// Remove default pagination class
remove_filter( 'genesis_attr_archive-pagination', 'genesis_attributes_pagination' );

// Pagination Numeric
add_filter( 'genesis_prev_link_text', 'bfg_genesis_prev_link_text_numeric' );
add_filter( 'genesis_next_link_text', 'bfg_genesis_next_link_text_numeric' );

function bfg_genesis_prev_link_text_numeric( $text ) {
    if ( 'numeric' === genesis_get_option( 'posts_nav' ) ) {
        return '<span aria-hidden="true">&laquo;</span>'
            . '<span class="sr-only">' . __( 'Previous Page', 'b4genesis' ) . '</span>';
    }
    return $text;
}

function bfg_genesis_next_link_text_numeric( $text ) {
    if ( 'numeric' === genesis_get_option( 'posts_nav' ) ) {
        return '<span class="sr-only">' . __( 'Next Page', 'b4genesis' ) . '</span>'
            . '<span aria-hidden="true">&raquo;</span>';
    }
    return $text;
}

// Pagination Prev/Next
remove_action( 'genesis_after_endwhile', 'genesis_posts_nav' );
add_action( 'genesis_after_endwhile', 'bfg_genesis_posts_nav' );

function bfg_genesis_posts_nav() {
    if ( 'numeric' === genesis_get_option( 'posts_nav' ) ) {
		// bfg_numeric_posts_nav();
		bfg_pagination();
    } else {
        bfg_genesis_prev_next_posts_nav();
    }
}

function bfg_numeric_posts_nav() {

	if( is_singular() )
		return;

	global $wp_query;

	// Stop execution if there's only one page.
	if( $wp_query->max_num_pages <= 1 )
		return;

	$paged = get_query_var( 'paged' ) ? absint( get_query_var( 'paged' ) ) : 1;
	$max   = intval( $wp_query->max_num_pages );

	// Add current page to the array.
	if ( $paged >= 1 )
		$links[] = $paged;

	// Add the pages around the current page to the array.
	if ( $paged >= 3 ) {
		$links[] = $paged - 1;
		$links[] = $paged - 2;
	}

	if ( ( $paged + 2 ) <= $max ) {
		$links[] = $paged + 2;
		$links[] = $paged + 1;
	}

	genesis_markup( array(
		'open'    => genesis_html5() ? '<nav %s>' : '<div %s>',
		'context' => 'archive-pagination',
	) );

	$before_number = genesis_a11y( 'screen-reader-text' ) ? '<span class="screen-reader-text">' . __( 'Page ', 'genesis' ) .  '</span>' : '';

	echo '<ul class="pagination">';

	// Previous Post Link.
	if ( get_previous_posts_link() )
		printf( '<li class="page-item pagination-previous">%s</li>' . "\n", get_previous_posts_link( apply_filters( 'genesis_prev_link_text', '&#x000AB; ' . __( 'Previous Page', 'genesis' ) ) ) );

	// Link to first page, plus ellipses if necessary.
	if ( ! in_array( 1, $links ) ) {

		$class = 1 == $paged ? ' class="page-item active"' : ' class="page-item"';

		printf( '<li%s><a class="%s" href="%s">%s</a></li>' . "\n", $class, "page-link", esc_url( get_pagenum_link( 1 ) ), $before_number . '1' );

		if ( ! in_array( 2, $links ) ) {
			echo '<li class="pagination-omission">&#x02026;</li>' . "\n";
		}

	}

	// Link to current page, plus 2 pages in either direction if necessary.
	sort( $links );
	foreach ( (array) $links as $link ) {
		$class = $paged == $link ? ' class="page-item active"  aria-label="' . __( 'Current page', 'genesis' ) . '"' : ' class="page-item"';
		printf( '<li%s><a class="%s" href="%s">%s</a></li>' . "\n", $class, "page-link", esc_url( get_pagenum_link( $link ) ), $before_number . $link );
	}

	// Link to last page, plus ellipses if necessary.
	if ( ! in_array( $max, $links ) ) {

		if ( ! in_array( $max - 1, $links ) )
			echo '<li class="pagination-omission">&#x02026;</li>' . "\n";

		$class = $paged == $max ? ' class="page-item active"' : ' class="page-item"';
		printf( '<li%s><a class="%s" href="%s">%s</a></li>' . "\n", $class, "page-link", esc_url( get_pagenum_link( $max ) ), $before_number . $max );

	}

	// Next Post Link.
	if ( get_next_posts_link() )
		printf( '<li class="page-item pagination-next">%s</li>' . "\n", get_next_posts_link( apply_filters( 'genesis_next_link_text', __( 'Next Page', 'genesis' ) . ' &#x000BB;' ) ) );

	echo '</ul>';
	genesis_markup( array(
		'close'    => genesis_html5 ? '</nav>' : '</div>',
		'context' => 'archive-pagination',
	) );

	echo "\n";

}

function bfg_genesis_prev_next_posts_nav() {
	$prev_link = get_previous_posts_link( apply_filters( 'genesis_prev_link_text', '<span aria-hidden="true">&larr;</span> ' . __( 'Previous Page', 'b4genesis' ) ) );
	$next_link = get_next_posts_link( apply_filters( 'genesis_next_link_text', __( 'Next Page', 'b4genesis' ) . ' <span aria-hidden="true">&rarr;</span>' ) );

	$prev = $prev_link ? '<li class="page-item previous">' . $prev_link . '</li>' : '';
	$next = $next_link ? '<li class="page-item next">' . $next_link . '</li>' : '';

	$nav = genesis_markup( array(
		'html5'   => '<nav %s><ul class="pagination">',
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
add_action( 'genesis_entry_content', 'bfg_do_post_content_nav', 12 );
add_filter( 'wp_link_pages_link', 'bfg_wp_link_pages_link' );

function bfg_wp_link_pages_link( $link ) {
    if ( $link && '<' !== $link[0] ) {
        return '<li class="active"><a href="#">' . $link . '</a></li>';
    } else {
        return '<li>' . $link . '</li>';
    }
}

function bfg_do_post_content_nav( $attr ) {
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

if ( ! function_exists( 'bfg_pagination' ) ) {
	function bfg_pagination() {
		global $wp_query;
		$big = 999999999; // This needs to be an unlikely integer
		// For more options and info view the docs for paginate_links()
		// http://codex.wordpress.org/Function_Reference/paginate_links
		$paginate_links = paginate_links( array(
			'base' => str_replace( $big, '%#%', get_pagenum_link($big) ),
			'current' => max( 1, get_query_var('paged') ),
			'total' => $wp_query->max_num_pages,
			'mid_size' => 5,
			'prev_next' => True,
			'prev_text' => __('<span aria-hidden="true">&laquo;</span>' . '<span class="sr-only">' . __( 'Previous Page', 'b4genesis' ) . '</span>'),
			'next_text' => __('<span aria-hidden="true">&raquo;</span>' . '<span class="sr-only">' . __( 'Next Page', 'b4genesis' ) . '</span>'),
			'type' => 'list'
		) );
		$paginate_links = str_replace( "<ul class='page-numbers'>", "<ul class='pagination'>", $paginate_links );
		$paginate_links = str_replace( "<li><span class='page-numbers current'>", "<li class='page-item active'><a class='page-link' href='#'>", $paginate_links );
    $paginate_links = str_replace( "<li>", "<li class='page-item'>", $paginate_links );
		$paginate_links = str_replace( "<a", "<a class='page-link' ", $paginate_links );

		$paginate_links = str_replace( "</span>", "</a>", $paginate_links );
		$paginate_links = preg_replace( "/\s*page-numbers/", "", $paginate_links );
		// Display the pagination if more than one page is found
		if ( $paginate_links ) {
			echo $paginate_links;
		}
	}
}
