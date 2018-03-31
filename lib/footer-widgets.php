<?php
/**
 * Custom Footer Widget Area
 *
 * @package      Bootstrap for Genesis
 * @since        1.0
 * @link         http://webdevsuperfast.github.io
 * @author       Rotsen Mark Acob <webdevsuperfast.github.io>
 * @copyright    Copyright (c) 2015, Rotsen Mark Acob
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 *
*/

// Custom footer widget area
add_filter( 'genesis_footer_widget_areas', 'bfg_footer_widget_areas', 10, 2 );

function bfg_footer_widget_areas( $output, $footer_widgets ) {

    $footer_widgets = get_theme_support( 'genesis-footer-widgets' );

    if ( ! $footer_widgets || ! isset( $footer_widgets[0] ) || ! is_numeric( $footer_widgets[0] ) )
        return;

    $footer_widgets = (int) $footer_widgets[0];

    //* Check to see if first widget area has widgets. If not, do nothing. No need to check all footer widget areas.
    if ( ! is_active_sidebar( 'footer-1' ) )
        return;

    switch ( $footer_widgets ) {
        case '1':
        default:
            $class = 'col-sm-12';
            break;
        
        case '2':
            $class = 'col-sm-6';
            break;

        case '3':
            $class = 'col-sm-4';
            break;

        case '4': 
            $class = 'col-sm-3';
            break;

        case '6':
            $class = 'col-sm-2';
            break;

        case '12':
            $class = 'col-sm-1';
            break;
    }

    $inside  = '';
    $output  = '';
    $counter = 1;

    while ( $counter <= $footer_widgets ) {

        //* Darn you, WordPress! Gotta output buffer.
        ob_start();
        dynamic_sidebar( 'footer-' . $counter );

        $widgets = ob_get_clean();

        $inside .= sprintf( '<div class="footer-widgets-%d %s widget-area">%s</div>', $counter, $class, $widgets );

        $counter++;

    }

    if ( $inside ) {
    
        $output .= genesis_markup( array(
            'html5'   => '<div %s>',
            'xhtml'   => '<div id="footer-widgets" class="footer-widgets">',
            'context' => 'footer-widgets',
        ) );
    
        $output .= genesis_structural_wrap( 'footer-widgets', 'open', 0 );
        
        $output .= $inside;
        
        $output .= genesis_structural_wrap( 'footer-widgets', 'close', 0 );
        
        $output .= '</div>';

    }

    return $output;
}