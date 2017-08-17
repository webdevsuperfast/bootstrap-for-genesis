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

// General Section
BFG_Kirki::add_section( 'general', array(
	'title' => __( 'General', 'bootstrap-for-genesis' ),
	'priority' => '1',
	'capability' => 'edit_theme_options'
) );

BFG_Kirki::add_field( 'bootstrap-for-genesis', array(
    'type' => 'image',
    'settings' => 'logo',
    'label' => __( 'Logo', 'bootstrap-for-genesis' ),
    'description' => __( '', 'bootstrap-for-genesis' ),
    'section' => 'general',
    'default' => '',
    'priority' => 10
) );

BFG_Kirki::add_field( 'bootstrap-for-genesis', array(
    'type' => 'image',
    'settings' => 'favicon',
    'label' => __( 'Favicon', 'bootstrap-for-genesis' ),
    'description' => __( '', 'bootstrap-for-genesis' ),
    'section' => 'general',
    'default' => '',
    'priority' => 15
) );

// Header Section
BFG_Kirki::add_section( 'header', array(
	'title' => __( 'Header', 'bootstrap-for-genesis' ),
	'priority' => '2',
	'capability' => 'edit_theme_options'
) );

// Navigation Section
BFG_Kirki::add_section( 'navigation', array(
	'title' => __( 'Navigation', 'bootstrap-for-genesis' ),
	'priority' => '3',
	'capability' => 'edit_theme_options'
) );

BFG_Kirki::add_field( 'bootstrap-for-genesis', array(
    'type' => 'select',
    'settings' => 'navtype',
    'section' => 'navigation',
    'label' => __( 'Navigation Type', 'bootstrap-for-genesis' ),
    'description' => __( '', 'bootstrap-for-genesis' ),
    'priority' => 5,
    'choices' => array(
        'navbar-default' => __( 'Default', 'bootstrap-for-genesis' ),
        'navbar-static-top' => __( 'Static Top', 'bootstrap-for-genesis' ),
        'navbar-fixed-top' => __( 'Fixed Top', 'bootstrap-for-genesis' ),
        'navbar-fixed-bottom' => __( 'Fixed Bottom', 'bootstrap-for-genesis' ),
    ),
    'default' => 'navbar-default'
) );

BFG_Kirki::add_field( 'bootstrap-for-genesis', array(
    'type' => 'select',
    'settings' => 'navalign',
    'section' => 'navigation',
    'label' => __( 'Navigation Alignment', 'bootstrap-for-genesis' ),
    'description' => __( '', 'bootstrap-for-genesis' ),
    'priority' => 10,
    'choices' => array(
        'navbar-left' => __( 'Default', 'bootstrap-for-genesis' ),
        'navbar-right' => __( 'Right', 'bootstrap-for-genesis' ),
    ),
    'default' => ''
) );

BFG_Kirki::add_field( 'bootstrap-for-genesis', array(
	'type' => 'checkbox',
	'settings' => 'navextra',
	'label' => __( 'Display navigation extras?', 'bootstrap-for-genesis' ),
	'section' => 'navigation',
	'default' => '0',
	'priority' => 10
) );

BFG_Kirki::add_field( 'bootstrap-for-genesis', array(
    'type' => 'select',
    'settings' => 'select',
    'label' => __( 'Select Navigation Extra', 'bootstrap-for-genesis' ),
    'description' => __( '', 'bootstrap-for-genesis' ),
    'section' => 'navigation',
    'default' => 'search',
    'priority' => 15,
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
	'default' => '[footer_copyright] &middot; <a href="http://www.rotsenacob.com">Rotsen Mark Acob</a> &middot; Built on the <a href="http://www.studiopress.com/themes/genesis" title="Genesis Framework">Genesis Framework</a>',
	'priority' => 10
) );