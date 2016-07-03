<?php
/**
 * Breadcrumbs
 *
 * @package      Bootstrap for Genesis
 * @since        1.0
 * @link         http://www.recommendwp.com
 * @author       RecommendWP <www.recommendwp.com>
 * @copyright    Copyright (c) 2015, RecommendWP
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 *
*/

// Changing breadcrumbs to Bootstrap's format
// @link http://jhtechservices.com/2015/05/integrate-bootstraps-breadcrumbs-into-genesis-theme/
add_filter( 'genesis_breadcrumb_args', 'bfg_breadcrumb_args' );
function bfg_breadcrumb_args( $args ){
	$args['sep'] = '     ';
	$args['prefix'] = sprintf( '<ol %s>', genesis_attr( 'breadcrumb' ) );
    $args['suffix'] = '</ol>';
	
	return $args;
}

add_filter( 'genesis_build_crumbs', 'bfg_build_crumbs', 10, 2 );
function bfg_build_crumbs( $crumbs ){

	foreach( $crumbs as &$crumb ){
		$crumb = str_replace( '     ','</li><li class="active">', $crumb );
		$class = strpos( $crumb, '</a>' ) ? '' : 'class="active"';
		$crumb = '<li ' . $class .'>' . $crumb . '</li>';
	}
	return $crumbs;
}