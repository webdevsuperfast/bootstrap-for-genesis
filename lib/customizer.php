<?php
/**
 * Customizer Options
 *
 * @package      Bootstrap for Genesis
 * @since        1.0
 * @link         http://www.superfastbusiness.com
 * @author       SuperFastBusiness <www.superfastbusiness.com>
 * @copyright    Copyright (c) 2015, SuperFastBusiness
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 *
*/

add_action( 'init', 'bfg_customizer_options' );
function bfg_customizer_options() {
	// Stores all the controls that will be added
	$options = array();

	// Stores all the sections to be added
	$sections = array();

	// Stores all the panels to be added
	$panels = array();

	// Adds the sections to the $options array
	$options['sections'] = $sections;

	// Logo
	$section = 'logo';
	$sections[] = array(
		'id' => $section,
		'title' => __( 'Logo', 'bfg' ),
		'priority' => '25'
	);

	$options['logo'] = array(
		'id' => 'logo',
		'label' => __( 'Upload logo', 'bfg' ),
		'type' => 'upload',
		'section' => $section,
		'default' => ''
	);

	// Navigation Extras
	$section = 'navextra';
	
	$choices = array(
		'date' => __( 'Date', 'bfg' ),
		'search' => __( 'Search Form', 'bfg' )
	);
	
	$sections[] = array(
		'id' => $section,
		'title' => __( 'Navigation Extras', 'bfg' ),
		'priority' => '30'
	);

	$options['navextra'] = array(
		'id' => 'navextra',
		'label' => __( 'Display navigation extras', 'bfg' ),
		'section' => $section,
		'type' => 'checkbox',
		'default' => false
	);
	
	$options['select'] = array(
		'id' => 'select',
		'label' => __( 'Select Navigation Extra', 'bfg' ),
		'section' => $section,
		'type' => 'select',
		'choices' => $choices,
		'default' => 'search'
	);

	// Typography
	$section = 'typography';
	$font_choices = customizer_library_get_font_choices();
	$sections[] = array(
		'id' => $section,
		'title' => __( 'Typography', 'bfg' ),
		'priority' => '30'
	);
	$options['custom-font'] = array(
		'id' => 'custom-font',
		'label' => __( 'Enable custom font', 'bfg' ),
		'section' => $section,
		'type' => 'checkbox',
		'default' => false	
	);
	$options['heading-font'] = array(
		'id' => 'heading-font',
		'label'   => __( 'Heading Font', 'bfg' ),
		'section' => $section,
		'type'    => 'select',
		'choices' => $font_choices,
		'default' => 'Raleway'
	);
	$options['body-font'] = array(
		'id' => 'body-font',
		'label'   => __( 'Body Font', 'bfg' ),
		'section' => $section,
		'type'    => 'select',
		'choices' => $font_choices,
		'default' => 'Roboto'
	);

	// Footer
	$section = 'footer';

	$sections[] = array(
		'id' => $section,
		'title' => __( 'Footer', 'bfg' ),
		'priority' => '35',
		'description' => __( '', 'bfg' )
	);
	$options['footer'] = array(
		'id' => 'creds',
		'label' => __( 'Copyright', 'bfg' ),
		'section' => $section,
		'type' => 'text',
		'default' => ''
	);

	// Adds the sections to the $options array
	$options['sections'] = $sections;

	// Adds the panels to the $options array
	$options['panels'] = $panels;
	$customizer_library = Customizer_Library::Instance();
	$customizer_library->add_options( $options );

	// To delete custom mods use: customizer_library_remove_theme_mods();
}

// Enqueue Google Fonts via Customizer
add_action( 'wp_enqueue_scripts', 'bfg_customizer_fonts' );
function bfg_customizer_fonts() {
	// Font options
	$fonts = array(
		get_theme_mod( 'heading-font', customizer_library_get_default( 'heading-font' ) ),
		get_theme_mod( 'body-font', customizer_library_get_default( 'heading-font' ) )
	);
	$font_uri = customizer_library_get_google_font_uri( $fonts );

	if ( get_theme_mod( 'custom-font', false ) ) {
		// Load Google Fonts
		wp_enqueue_style( 'customizer-fonts', $font_uri, array(), null, 'screen' );
		
		// Remove default font enqueue
		remove_action( 'wp_enqueue_scripts', 'bfg_google_fonts' );
	}
}

if ( ! function_exists( 'bfg_customizer_build_styles' ) && class_exists( 'Customizer_Library_Styles' ) ) {

	add_action( 'customizer_library_styles', 'bfg_customizer_build_styles' );
	function bfg_customizer_build_styles() {
		if ( get_theme_mod( 'custom-font', false ) ) {
			// Heading font
			$setting = 'heading-font';
			$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );
			$stack = customizer_library_get_font_stack( $mod );
			if ( $mod != customizer_library_get_default( $setting ) ) {
				Customizer_Library_Styles()->add( array(
					'selectors' => array(
						'.footer-widgets .widgettitle',
						'.widgettitle',
						'.h1',
						'.h2',
						'.h3',
						'.h4',
						'.h5',
						'.h6',
						'h1',
						'h2',
						'h3',
						'h4',
						'h5',
						'h6',
						'.widget_recent_entries li a',
					),
					'declarations' => array(
						'font-family' => $stack
					)
				) );
			}
	
			// Body Font
			$setting = 'body-font';
			$mod = get_theme_mod( $setting, customizer_library_get_default( $setting ) );
			$stack = customizer_library_get_font_stack( $mod );
			if ( $mod != customizer_library_get_default( $setting ) ) {
				Customizer_Library_Styles()->add( array(
					'selectors' => array(
						'body',
						'.popover',
						'.tooltip',
						'.widget_recent_entries li span',
						'.site-header .site-description'
					),
					'declarations' => array(
						'font-family' => $stack
					)
				) );
			}
		}
	}
	
}

if ( !function_exists( 'bfg_library_styles' ) ) {
	add_action( 'wp_head', 'bfg_library_styles' );
	function bfg_library_styles() {
		do_action( 'customizer_library_styles' );

		$css = Customizer_Library_Styles()->build();

		if ( !empty( $css ) ) {
			echo "\n<!-- Begin Custom CSS -->\n<style type=\"text/css\" id=\"bfg-custom-css\">\n";
				echo $css;
			echo "\n</style>\n<!-- End Custom CSS -->\n";
		}
	}
}
