<?php
/**
 * Custom Footer
 *
 * @package      Bootstrap for Genesis
 * @since        1.0
 * @link         http://www.rotsenacob.com
 * @author       Rotsen Mark Acob <www.rotsenacob.com>
 * @copyright    Copyright (c) 2015, Rotsen Mark Acob
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 *
*/

// add_filter( 'genesis_footer_creds_text', 'bfg_footer_creds_text' );
function bfg_footer_creds_text( $creds ) {
    $creds = get_theme_mod( 'creds', '[footer_copyright] &middot; <a href="http://rotsenacob.com">Rotsen Mark Acob</a> &middot; Built on the <a href="http://www.studiopress.com/themes/genesis" title="Genesis Framework">Genesis Framework</a>' );
    // $creds = $credits;

    return $creds;
}
