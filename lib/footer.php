<?php
/**
 * Custom Footer
 *
 * @package      Bootstrap for Genesis
 * @since        1.0
 * @link         http://www.superfastbusiness.com
 * @author       SuperFastBusiness <www.superfastbusiness.com>
 * @copyright    Copyright (c) 2015, SuperFastBusiness
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 *
*/

// Custom Footer
remove_action( 'genesis_footer', 'genesis_do_footer' );
add_action( 'genesis_footer', 'bfg_do_footer' );

function bfg_do_footer() {
    if ( get_theme_mod( 'creds', false ) ) {
        $creds = get_theme_mod( 'creds' );
    } else {
        $creds = '<a href="http://www.superfastbusiness.com">Bootstrap for Genesis</a> by <a href="http://www.superfastbusiness.com">SuperFastBusiness</a>';
    }
    
    genesis_markup(array(
        'html5' => '<div %s>',
        'xhtml' => '<div class="copyright">',
        'context' => 'copyright'
    ));
        echo apply_filters( 'bfg_footer_creds', do_shortcode( $creds ) );
    echo '</div>';

    if ( is_active_sidebar( 'footer-right' ) ) {
        genesis_markup( array(
            'html5' => '<div %s>',
            'xhtml' => '<div class="footer-widget-area">',
            'context' => 'footer-widget-area'
        ) );

        genesis_widget_area( 'footer-right', array(
            'before' => '',
            'after' => ''
        ) );

        echo '</div>';
    }
}