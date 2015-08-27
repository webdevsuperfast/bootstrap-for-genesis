<?php

add_action( 'after_setup_theme', 'bfg_required_theme_support', 12 );
function bfg_required_theme_support() {
	// Bootstrap Shortcodes
	require_if_theme_supports( 'bfg-module-shortcodes', BFG_THEME_MODULES . 'shortcodes.php' );
	
	// TGM Plugin Activation
	require_if_theme_supports( 'bfg-module-tgm', BFG_THEME_MODULES . 'tgm-plugin-activation/tgm-plugin-activation.php' );

	// AQ Resizer
	require_if_theme_supports( 'bfg-module-aqresizer', BFG_THEME_MODULES . 'aq_resizer.php' );
}