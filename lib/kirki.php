<?php
/**
 * Customizer Options
 *
 * @package      Bootstrap for Genesis
 * @since        1.0
 * @link         http://www.rotsenacob.com
 * @author       Rotsen Mark Acob <www.rotsenacob.com>
 * @copyright    Copyright (c) 2015, Rotsen Mark Acob
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 *
*/

// Kirki
BFG_Kirki::add_config( 'bootstrap-for-genesis', array(
	'capability' => 'edit_theme_options',
	'option_type' => 'theme_mod'
) );

// Navigation Section
BFG_Kirki::add_section( 'navigation', array(
	'title' => __( 'Navigation', 'bootstrap-for-genesis' ),
	'priority' => '3',
	'capability' => 'edit_theme_options'
) );

BFG_Kirki::add_field( 'bootstrap-for-genesis', array(
    'type' => 'select',
    'settings' => 'navposition',
    'section' => 'navigation',
    'label' => __( 'Navigation Type', 'bootstrap-for-genesis' ),
    'description' => __( '', 'bootstrap-for-genesis' ),
    'priority' => 5,
    'choices' => array(
        '' => __( 'Default', 'bootstrap-for-genesis' ),
        'sticky-top' => __( 'Sticky Top', 'bootstrap-for-genesis' ),
        'fixed-top' => __( 'Fixed Top', 'bootstrap-for-genesis' ),
        'fixed-bottom' => __( 'Fixed Bottom', 'bootstrap-for-genesis' ),
    ),
    'default' => ''
) );

BFG_Kirki::add_field( 'bootstrap-for-genesis', array(
    'type' => 'select',
    'settings' => 'navcontainer',
    'section' => 'navigation',
    'label' => __( 'Navigation Container', 'bootstrap-for-genesis' ),
    'description' => __( '', 'bootstrap-for-genesis' ),
    'priority' => 10,
    'choices' => array(
        'sm' => __( 'Small', 'bootstrap-for-genesis' ),
        'md' => __( 'Medium', 'bootstrap-for-genesis' ),
        'lg' => __( 'Large', 'bootstrap-for-genesis' ),
        'xl' => __( 'Extra Large', 'bootstrap-for-genesis' )
    ),
    'default' => 'lg'
) );

BFG_Kirki::add_field( 'bootstrap-for-genesis', array(
    'type' => 'select',
    'settings' => 'navcolor',
    'section' => 'navigation',
    'label' => __( 'Navigation Color Scheme', 'bootstrap-for-genesis' ),
    'description' => __( '', 'bootstrap-for-genesis' ),
    'priority' => 15,
    'choices' => array(
        'light' => __( 'Light', 'bootstrap-for-genesis' ),
        'dark' => __( 'Dark', 'bootstrap-for-genesis' ),
        'primary' => __( 'Primary', 'bootstrap-for-genesis' )
    ),
    'default' => 'dark'
) );

BFG_Kirki::add_field( 'bootstrap-for-genesis', array(
	'type' => 'checkbox',
	'settings' => 'navextra',
	'label' => __( 'Display navigation extras?', 'bootstrap-for-genesis' ),
	'section' => 'navigation',
	'default' => 0,
	'priority' => 20
) );

BFG_Kirki::add_field( 'bootstrap-for-genesis', array(
    'type' => 'select',
    'settings' => 'select',
    'label' => __( 'Select Navigation Extra', 'bootstrap-for-genesis' ),
    'description' => __( '', 'bootstrap-for-genesis' ),
    'section' => 'navigation',
    'default' => 'search',
    'priority' => 25,
    'choices' => array(
        'date' => __( 'Date', 'bootstrap-for-genesis' ),
        'search' => __( 'Search Form', 'bootstrap-for-genesis' )
    )
) );

// Footer Section
BFG_Kirki::add_section( 'footer', array(
	'title' => __( 'Footer', 'bootstrap-for-genesis' ),
	'priority' => '4',
	'capability' => 'edit_theme_options'
) );

BFG_Kirki::add_field( 'bootstrap-for-genesis', array(
	'type' => 'textarea',
	'settings' => 'creds',
	'label' => __( 'Footer Credits', 'bootstrap-for-genesis' ),
	'section' => 'footer',
	'default' => '',
	'priority' => 10
) );