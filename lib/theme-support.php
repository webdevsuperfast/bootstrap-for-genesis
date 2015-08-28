<?php
/**
 * Theme Supports
 *
 * @package      Bootstrap for Genesis
 * @since        1.0
 * @link         http://www.superfastbusiness.com
 * @author       SuperFastBusiness <www.superfastbusiness.com>
 * @copyright    Copyright (c) 2015, SuperFastBusiness
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 *
*/

add_action( 'after_setup_theme', 'bfg_required_theme_support', 12 );
function bfg_required_theme_support() {
	// Bootstrap Shortcodes
	require_if_theme_supports( 'bfg-module-shortcodes', BFG_THEME_MODULES . 'shortcodes.php' );
	
	// TGM Plugin Activation
	require_if_theme_supports( 'bfg-module-tgm', BFG_THEME_MODULES . 'tgm-plugin-activation.php' );

	// AQ Resizer
	require_if_theme_supports( 'bfg-module-aqresizer', BFG_THEME_MODULES . 'aq_resizer.php' );
}