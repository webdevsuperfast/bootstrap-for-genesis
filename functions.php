<?php
add_action( 'genesis_setup', 'bfg_childtheme_setup', 15 );

function bfg_childtheme_setup() {
	//* Start the engine
	include_once( get_template_directory() . '/lib/init.php' );

	//* Child theme (do not remove)
	define( 'BFG_THEME_NAME', 'Bootstrap for Genesis' );
	define( 'BFG_THEME_URL', 'http://www.superfastbusiness.com/' );
	define( 'BFG_THEME_LIB', CHILD_DIR . '/lib/' );
	define( 'BFG_THEME_LIB_URL', CHILD_URL . '/lib/' );
	define( 'BFG_THEME_IMAGES', CHILD_URL . '/images/' );
	define( 'BFG_THEME_SCRIPTS', CHILD_URL . '/assets/js/' );
	define( 'BFG_THEME_MODULES', CHILD_DIR . '/lib/modules/' );

	//* Enqueue Google Fonts
	add_action( 'wp_enqueue_scripts', 'bfg_google_fonts' );
	function bfg_google_fonts() {
		wp_enqueue_style( 'google-fonts', '//fonts.googleapis.com/css?family=Raleway:400,300,700,500|Roboto:400,400italic,700,700italic,300italic,300', array(), BFG_THEME_VERSION );
	}

	// Cleanup WP Head
	remove_action( 'wp_head', 'rsd_link' );
	remove_action( 'wp_head', 'wlwmanifest_link' );
	remove_action( 'wp_head', 'wp_generator' );
	remove_action( 'wp_head', 'start_post_rel_link' );
	remove_action( 'wp_head', 'index_rel_link' );
	remove_action( 'wp_head', 'adjacent_posts_rel_link' );
	remove_action( 'wp_head', 'wp_shortlink_wp_head' );

	// Remove WP Version
	add_filter( 'the_generator', 'mb_remove_wp_version' );

	// Add HTML5 markup structure
	add_theme_support( 'html5', array( 'search-form', 'comment-form', 'comment-list' ) );

	// Add viewport meta tag for mobile browsers
	add_theme_support( 'genesis-responsive-viewport' );

	// Add support for custom background
	add_theme_support( 'custom-background' );

	// Add support for custom header image
	add_theme_support( 'custom-header', array(
		'flex-height' => true,
		'width' => 272,
		'height' => 72,
		'header-selector' => '.site-title a',
		'header-text' => false
	) );

	// Add support for 3-column footer widgets
	add_theme_support( 'genesis-footer-widgets', 3 );

	// Structural Wraps
	add_theme_support( 'genesis-structural-wraps', array(
		'header',
		'nav',
		'subnav',
		'site-inner',
		'footer-widgets',
		'footer',
		'home-featured'
	) );

	// WooCommerce Support
	add_theme_support( 'genesis-connect-woocommerce' );

	// Custom Image Size
	add_image_size( 'bootstrap-featured', 750, 422, true );

	// Add AQ Resizer Support
	add_theme_support( 'bfg-module-aqresizer' );

	// Add Shortcode Support
	add_theme_support( 'bfg-module-shortcodes' );

	// Add TGM Plugin Activation Support
	add_theme_support( 'bfg-module-tgm' );
	
	// Add Customizer Helper support
	add_theme_support( 'bfg-module-customizer' );

	// Customizer Helper
	require_once( BFG_THEME_MODULES . 'customizer-library/customizer-library.php' );

	// Custom SiteOrigin Widgets
	require_once( BFG_THEME_MODULES . 'siteorigin/siteorigin.php' );

	// Include php files from lib folder
	// @link https://gist.github.com/theandystratton/5924570
	foreach ( glob( dirname( __FILE__ ) . '/lib/*.php' ) as $file ) { 
		include $file; 
	}
	
	if ( current_theme_supports( 'bf-module-customizer' ) ) 
		require_once( BFG_THEME_MODULES . 'customizer.php' );

	// Move Sidebar Secondary After Content
	remove_action( 'genesis_after_content_sidebar_wrap', 'genesis_get_sidebar_alt' );
	add_action( 'genesis_after_content', 'genesis_get_sidebar_alt' );

	// Remove Gallery CSS
	add_filter( 'use_default_gallery_style', '__return_false' );

	// Add Shortcode Functionality to Text Widgets
	add_filter( 'widget_text', 'shortcode_unautop' );
	add_filter( 'widget_text', 'do_shortcode' );

	// Move Featured Image
	remove_action( 'genesis_entry_content', 'genesis_do_post_image', 8 );
	add_action( 'genesis_entry_header',  'genesis_do_post_image', 0 );
}