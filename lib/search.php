<?php
/**
 * Search Form
 *
 * @package      Bootstrap for Genesis
 * @since        1.0
 * @link         http://webdevsuperfast.github.io
 * @author       Rotsen Mark Acob <webdevsuperfast.github.io>
 * @copyright    Copyright (c) 2017, Rotsen Mark Acob
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 *
*/

add_filter( 'get_search_form', 'bfg_search_form' );
function bfg_search_form( $form ) {
    $form = '<form class="form-inline" role="search" method="get" id="searchform" action="' . home_url('/') . '" >
	<input class="form-control mr-2" type="text" value="' . get_search_query() . '" placeholder="' . esc_attr__('Search', 'bootstrap-for-genesis') . '..." name="s" id="s" />
	<button type="submit" id="searchsubmit" value="'. esc_attr__('Search', 'bootstrap-for-genesis') .'" class="btn btn-primary"><i class="fa fa-search"></i></button>
    </form>';
    return $form;
}
