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

// Theme Scripts & Stylesheet
remove_action( 'genesis_meta', 'genesis_load_stylesheet' );
add_action( 'wp_enqueue_scripts', 'bfg_theme_scripts' );
function bfg_theme_scripts() {
	$version = wp_get_theme()->Version;
	if ( !is_admin() ) {
		wp_register_style( 'bootstrap_for_genesis_styles', BFG_THEME_CSS . 'style.min.css', array(), $version );
		wp_enqueue_style( 'bootstrap_for_genesis_styles' );
		
		wp_register_script( 'vendor-js', BFG_THEME_JS . 'vendor.min.js', array( 'jquery' ), null, true );
		wp_enqueue_script( 'vendor-js' );

		wp_register_script( 'app-js', BFG_THEME_JS . 'app.min.js', array( 'jquery' ), null, true );
		wp_enqueue_script( 'app-js' );
	}
}

// Editor Styles
add_action( 'init', 'bfg_custom_editor_css' );
function bfg_custom_editor_css() {
	add_editor_style( get_stylesheet_uri() );
}
