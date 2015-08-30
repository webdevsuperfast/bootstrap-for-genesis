<?php
/**
 * Scripts
 *
 * @package      Bootstrap for Genesis
 * @since        1.0
 * @link         http://www.superfastbusiness.com
 * @author       SuperFastBusiness <www.superfastbusiness.com>
 * @copyright    Copyright (c) 2015, SuperFastBusiness
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 *
*/

// Theme Scripts
add_action( 'wp_enqueue_scripts', 'bfg_theme_scripts' );
function bfg_theme_scripts() {

	if ( !is_admin() ) {
		wp_register_script( 'vendor-js', BFG_THEME_SCRIPTS . 'vendor.min.js', array( 'jquery' ), null, true );
		wp_enqueue_script( 'vendor-js' );

		wp_register_script( 'app-js', BFG_THEME_SCRIPTS . 'app.min.js', array( 'jquery' ), null, true );
		wp_enqueue_script( 'app-js' );
	}
}

// Editor Styles
add_action( 'init', 'bfg_custom_editor_css' );
function bfg_custom_editor_css() {
	add_editor_style( get_stylesheet_uri() );
}
