<?php
/**
 * Custom Footer
 *
 * @package      Bootstrap for Genesis
 * @since        1.0
 * @link         http://www.recommendwp.com
 * @author       RecommendWP <www.recommendwp.com>
 * @copyright    Copyright (c) 2015, RecommendWP
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 *
*/

// add_filter( 'genesis_footer_creds_text', 'bfg_footer_creds_text' );
function bfg_footer_creds_text( $creds ) {
    $creds = get_theme_mod( 'creds', '[footer_copyright] &middot; <a href="http://recommendwp.com">RecommendWP</a> &middot; Built on the <a href="http://www.studiopress.com/themes/genesis" title="Genesis Framework">Genesis Framework</a>' );
    // $creds = $credits;

    return $creds;
}
