<?php
/**
 * SiteOrigin Widgets
 *
 * @package      Bootstrap for Genesis
 * @since        1.0
 * @link         http://www.superfastbusiness.com
 * @author       SuperFastBusiness <www.superfastbusiness.com>
 * @copyright    Copyright (c) 2015, SuperFastBusiness
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 *
*/

// SiteOrigin Widgets
function bfg_siteorigin_widgets( $folders ){
	$folders[] = BFG_THEME_MODULES . 'siteorigin/widgets/';
	return $folders;
}

add_filter( 'siteorigin_widgets_widget_folders', 'bfg_siteorigin_widgets' );