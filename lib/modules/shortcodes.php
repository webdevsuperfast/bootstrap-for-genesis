<?php
/**
 * Shortcodes
 *
 * @package      Bootstrap for Genesis
 * @since        1.0
 * @link         http://www.superfastbusiness.com
 * @author       SuperFastBusiness <www.superfastbusiness.com>
 * @copyright    Copyright (c) 2015, SuperFastBusiness
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 *
*/

// Bootstrap Badge
function bfg_badge_shortcode( $atts, $content = null ) {
	$defaults = array(
		'class' => ''
	);

	$atts = shortcode_atts( $defaults, $atts, 'badge' );

	$output = '';
	$output .= '<span class="badge'.( !empty( $atts['class'] ) ? ' ' . $atts['class'] : '' ).'">';
	$output .= do_shortcode( $content );
	$output .= '</span>';

	return apply_filters( 'bfg_badge_shortcode', $output, $atts );
}

if ( shortcode_exists( 'badge' ) ) {
	remove_shortcode( 'badge' );
	add_shortcode( 'badge', 'bfg_badge_shortcode' );
} else {
	add_shortcode( 'badge', 'bfg_badge_shortcode' );
}

// Bootstrap Alert
function bfg_alert_shortcode( $atts, $content = null ) {
	$defaults = array(
		'class' => ''
	);

	$atts = shortcode_atts( $defaults, $atts, 'alert' );

	$output = '';
	$output .= '<div class="alert' .( !empty( $atts['class'] ) ? ' ' . $atts['class'] : ' alert-warning' ).'" role="alert">';
	$output .= do_shortcode( $content );
	$output .= '</div>';

	return apply_filters( 'bfg_alert_shortcode', $output, $atts );
}

if ( shortcode_exists( 'alert' ) ) {
	remove_shortcode( 'alert' );
	add_shortcode( 'alert', 'bfg_alert_shortcode' );
} else {
	add_shortcode( 'alert', 'bfg_alert_shortcode' );
}

// Bootstrap Labels
function bfg_label_shortcode( $atts, $content = null ) {
	$defaults = array(
		'class' => ''
	);

	$atts = shortcode_atts( $defaults, $atts, 'label' );

	$output = '';
	$output .= '<span class="label' .( !empty( $atts['class'] ) ? ' ' . $atts['class'] : ' label-primary' ).'">';
	$output .= do_shortcode( $content );
	$output .= '</span>';

	return apply_filters( 'bfg_label_shortcode', $output, $atts );
}

if ( shortcode_exists( 'label' ) ) {
	remove_shortcode( 'label' );
	add_shortcode( 'label', 'bfg_label_shortcode' );
} else {
	add_shortcode( 'label', 'bfg_label_shortcode' );
}

function bfg_thumbnail_shortcode( $atts, $content = null ) {
	$defaults = array(
		'class' => '',
		'image' => '',
		'link' => '',
		'alt' => ''
	);

	$atts = shortcode_atts( $defaults, $atts, 'thumbnail' );

	$output = '';
	$output .= ( !empty( $atts['link'] ) ? '<a href="'.$atts['link'].'"' : '<div ' );
	$output .= 'class="thumbnail' .( !empty( $atts['class'] ) ? ' ' . $atts['class'] : '' ).'"';
	$output .= '>';
	$output .= ( !empty( $atts['image'] ) ? '<img src="'.$atts['image'].'" alt="'.( $atts['alt'] ).'"/>' : '' ); 
	$output .= ( !empty( $atts['link'] ) ? '</a>' : '</div>' );

	return apply_filters( 'bfg_thumbnail_shortcode', $output, $atts );
}

if ( shortcode_exists( 'thumbnail' ) ) {
	remove_shortcode( 'thumbnail' );
	add_shortcode( 'thumbnail', 'bfg_thumbnail_shortcode' );
} else {
	add_shortcode( 'thumbnail', 'bfg_thumbnail_shortcode' );
}

function bfg_text_shortcode( $atts, $content = null ) {
	$defaults = array(
		'class' => '',
		'wrap' => 'p'
	);

	$atts = shortcode_atts( $defaults, $atts, 'text' );

	$output = '';
	$output .= '<'.$atts['wrap'].' class="text' .( !empty( $atts['class'] ) ? ' ' . $atts['class'] : '' ).'">';
	$output .= do_shortcode( $content );
	$output .= '</'.$atts['wrap'].'>';

	return apply_filters( 'bfg_text_shortcode', $output, $atts );
}

if ( shortcode_exists( 'text' ) ) {
	remove_shortcode( 'text' );
	add_shortcode( 'text', 'bfg_text_shortcode' );
} else {
	add_shortcode( 'text', 'bfg_text_shortcode' );
}

// Bootstrap Buttons
function bfg_button_shortcode( $atts, $content = null ) {
	$defaults = array(
		'class' => '',
		'link' => ''
	);

	$atts = shortcode_atts( $defaults, $atts, 'button' );

	$output = '';
	$output .= ( !empty( $atts['link'] ) ? '<a href="'.$atts['link'].'" role="button"' : '<button ' );
	$output .= 'class="btn' .( !empty( $atts['class'] ) ? ' ' . $atts['class'] : ' btn-default' ).'">';
	$output .= do_shortcode( $content );
	$output .= ( !empty( $atts['link'] ) ? '</a>' : '</button>' );

	return apply_filters( 'bfg_button_shortcode', $output, $atts );
}

if ( shortcode_exists( 'button' ) ) {
	remove_shortcode( 'button' );
	add_shortcode( 'button', 'bfg_button_shortcode' );
} else {
	add_shortcode( 'button', 'bfg_button_shortcode' );
}

// Bootstrap Well
function bfg_well_shortcode( $atts, $content = null ) {
	$defaults = array(
		'class' => ''
	);

	$atts = shortcode_atts( $defaults, $atts, 'well' );

	$output = '';
	$output .= '<div class="well'.( $atts['class'] ? ' ' . $atts['class'] : '' ).'">';
	$output .= do_shortcode( $content );
	$output .= '</div>';

	return apply_filters( 'bfg_well_shortcode', $output, $atts );
}

if ( shortcode_exists( 'well' ) ) {
	remove_shortcode( 'well' );
	add_shortcode( 'well', 'bfg_well_shortcode' );
} else {
	add_shortcode( 'well', 'bfg_well_shortcode' );
}

// Bootstrap Tooltip
function bfg_tooltip_shortcode( $atts, $content = null ) {
	$defaults = array(
		'class' => 'btn-default',
		'position' => 'top',
		'title' => ''
	);

	$atts = shortcode_atts( $defaults, $atts, 'tooltip' );

	$output = '<button type="button" class="btn '.$atts['class'].'" data-toggle="tooltip" data-placement="'.$atts['position'].'" title="'.$atts['title'].'">';
	$output .= do_shortcode( $content );
	$output .= '</button>';

	return apply_filters( 'bfg_tooltip_shortcode', $output, $atts );
}

if ( shortcode_exists( 'tooltip' ) ) {
	remove_shortcode( 'tooltip' );
	add_shortcode( 'tooltip', 'bfg_tooltip_shortcode' );
} else {
	add_shortcode( 'tooltip', 'bfg_tooltip_shortcode' );
}

// Bootstrap Popover
function bfg_popover_shortcode( $atts, $content = null ) {
	$defaults = array(
		'class' => 'btn-default',
		'position' => 'top',
		'title' => '',
		'content' => ''
	);

	$atts = shortcode_atts( $defaults, $atts, 'popover' );

	$output = '<button type="button" class="btn '.$atts['class'].'" data-toggle="popover" data-placement="'.$atts['position'].'" title="'.$atts['title'].'" data-content="'.$atts['content'].'" data-container="body" data-trigger="focus">';
	$output .= do_shortcode( $content );
	$output .= '</button>';

	return apply_filters( 'bfg_popover_shortcode', $output, $atts );
}

if ( shortcode_exists( 'popover' ) ) {
	remove_shortcode( 'popover' );
	add_shortcode( 'popover', 'bfg_popover_shortcode' );
} else {
	add_shortcode( 'popover', 'bfg_popover_shortcode' );
}