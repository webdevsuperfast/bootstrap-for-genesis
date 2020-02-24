<?php
/**
 * Widget Areas
 *
 * @package      Bootstrap for Genesis
 * @since        1.0
 * @link         http://webdevsuperfast.github.io
 * @author       Rotsen Mark Acob <webdevsuperfast.github.io>
 * @copyright    Copyright (c) 2015, Rotsen Mark Acob
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 *
*/

// Register Sidebar Function
add_action( 'init', 'bfg_register_sidebars' );
function bfg_register_sidebars() {
	// Register Custom Sidebars
	genesis_register_sidebar( array(
		'id' => 'home-featured',
		'name' => __( 'Home Featured', 'bootstrap-for-genesis' ),
		'description' => __( 'This is the home featured area. It uses the jumbotron bootstrap section.', 'bootstrap-for-genesis' )
	) );
}
