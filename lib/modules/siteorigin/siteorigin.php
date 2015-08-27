<?php
// SiteOrigin Widgets
function bfg_siteorigin_widgets( $folders ){
	$folders[] = BFG_THEME_MODULES . 'siteorigin/widgets/';
	return $folders;
}

add_filter('siteorigin_widgets_widget_folders', 'bfg_siteorigin_widgets');