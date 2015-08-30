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
	
	// Sections Goes Here
	$section = 'logo';
	
	$sections[] = array(
		'id' => $section,
		'title' => __( 'Logo', 'bfg' ),
		'priority' => '30',
		'description' => __( 'Upload your logo here.', 'bfg' )
	);
	$options['logo'] = array(
		'id' => 'logo',
		'label'   => __( 'Upload Logo', 'bfg' ),
		'section' => $section,
		'type'    => 'image',
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