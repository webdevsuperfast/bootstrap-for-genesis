<?php
/**
 * SiteOrigin Settings
 *
 * @package      Bootstrap for Genesis
 * @since        1.0
 * @link         http://www.superfastbusiness.com
 * @author       SuperFastBusiness <www.superfastbusiness.com>
 * @copyright    Copyright (c) 2015, SuperFastBusiness
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 *
*/

// Filter Default SiteOrigin Settings
add_filter( 'siteorigin_panels_settings_defaults', 'bfg_siteorigin_settings' );
function bfg_siteorigin_settings( $defaults ) {
	// Widgets field
	$defaults['title-html'] = '<h4 class="widgettitle">{{title}}</h4>';
	$defaults['recommended-widgets'] = false;

	// Bottom margin
	$defaults['margin-bottom'] = 0;

	// Side margins
	$defaults['margin-sides'] = 30;

	// Layout field
	$defaults['mobile-width'] = 767;
	
	// Content field
	$defaults['copy-content'] = false;

	// Post types
	$defaults['post-types'] = array('page');

	return $defaults;
}