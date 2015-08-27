<?php
/**
 * Widget Areas
 *
 * @package      Bootstrap for Genesis
 * @since        1.0
 * @link         http://www.superfastbusiness.com
 * @author       SuperFastBusiness <www.superfastbusiness.com>
 * @copyright    Copyright (c) 2015, SuperFastBusiness
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 *
*/

// Register Sidebar Function
add_action( 'init', 'bfg_register_sidebars' );
function bfg_register_sidebars() {
	// Register Custom Sidebars
	genesis_register_sidebar( array(
		'id' => 'home-featured',
		'name' => __( 'Home Featured', 'bfg' ),
		'description' => __( 'This is the home featured area. It uses the jumbotron bootstrap section.', 'bfg' )
	) );

    genesis_register_sidebar( array(
        'id' => 'footer-right',
        'name' => __( 'Footer Right', 'bfg' ),
        'description' => __( 'This is the footer right area. It usually appears after the copyright information.', 'bfg' )
    ) );
}
