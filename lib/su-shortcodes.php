<?php
/**
 * Extend Shortcodes Ultimate
 *
 * @package      Bootstrap for Genesis
 * @since        1.0
 * @link         http://www.superfastbusiness.com
 * @author       SuperFastBusiness <www.superfastbusiness.com>
 * @copyright    Copyright (c) 2015, SuperFastBusiness
 * @license      http://opensource.org/licenses/gpl-2.0.php GNU Public License
 *
*/

// Groups
add_filter( 'su/data/groups', 'bfg_register_groups', 10, 2 );
function bfg_register_groups( $groups ) {
	$groups['bootstrap'] = __( 'Bootstrap', 'bfg' );
	
	return $groups;
}

// Shortcodes
add_filter( 'su/data/shortcodes', 'bfg_register_shortcodes', 10, 2 );
function bfg_register_shortcodes( $shortcodes ) {
	$shortcodes['bfg_button'] = array(
		'name' => __( 'BFG Button', 'bfg' ),
		'type' => 'wrap',
		'group' => 'bootstrap',
		'atts' => array(
			'class' => array(
				'type' => 'text',
				'default' => '',
				'name' => __( 'Class', 'bfg' ),
				'desc' => __( 'Button class', 'bfg' )
			),
			'padding' => array(
				'type' => 'text',
				'default' => '',
				'name' => __( 'Padding', 'bfg' ),
				'desc' => __( 'Button padding', 'bfg' )
			),
			'size' => array(
				'type' => 'slider',
				'min' => 1,
				'max' => 100,
				'step' => 1,
				'default' => '',
				'name' => __( 'Font Size', 'bfg' ),
				'desc' => __( 'Font size', 'bfg' )
			),
			'margin' => array(
				'type' => 'slider',
				'min' => 0,
				'max' => 100,
				'step' => 1,
				'default' => '',
				'name' => __( 'Margin', 'bfg' ),
				'desc' => __( 'Bottom margin', 'bfg' )
			),
			'target' => array(
				'type' => 'select',
				'values' => array(
					'_self' => 'Self',
					'_blank' => 'Blank'
				),
				'default' => '_self',
				'name' => __( 'Target', 'bfg' ),
				'desc' => __( 'Button target', 'bfg' )
			),
			'url' => array(
				'type' => 'text',
				'default' => '',
				'name' => __( 'URL', 'bfg' ),
				'desc' => __( 'Button URL', 'bfg' )
			)
		),
		'content' => __( 'Button text', 'bfg' ),
		'desc' => __( 'Button text', 'bfg' ),
		'icon' => 'code',
		'function' => 'bfg_custom_button_shortcode'	
	);

	$shortcodes['bfg_text'] = array(
		'name' => __( 'BFG Text', 'bfg' ),
		'type' => 'wrap',
		'group' => 'bootstrap',
		'atts' => array(
			'class' => array(
				'type' => 'text',
				'default' => '',
				'name' => __( 'Class', 'bfg' ),
				'desc' => __( 'Text class', 'bfg' )
			),
			'tag' => array(
				'type' => 'text',
				'default' => 'span',
				'name' => __( 'Tag', 'bfg' ),
				'desc' => __( 'HTML tag', 'bfg' )
			),
			'size' => array(
				'type' => 'slider',
				'min' => 1,
				'max' => 100,
				'step' => 1,
				'default' => '',
				'name' => __( 'Font Size', 'bfg' ),
				'desc' => __( 'Font size', 'bfg' )
			),
			'alignment' => array(
				'type' => 'select',
				'values' => array(
					'center' => 'Center',
					'left' => 'Left',
					'right' => 'Right'
				),
				'default' => 'left',
				'name' => __( 'Alignment', 'bfg' ),
				'desc' => __( 'Text alignment', 'bfg' )
			),
			'color' => array(
				'type' => 'color',
				'values' => array( ),
				'default' => '',
				'name' => __( 'Color', 'bfg' ),
				'desc' => __( 'Text color', 'bfg' )
			),
			'margin' => array(
				'type' => 'slider',
				'min' => 0,
				'max' => 100,
				'step' => 1,
				'default' => '',
				'name' => __( 'Margin', 'bfg' ),
				'desc' => __( 'Bottom margin', 'bfg' )
			)
		),
		'content' => __( 'Text', 'bfg' ),
		'desc' => __( 'Text content', 'bfg' ),
		'icon' => 'code',
		'function' => 'bfg_custom_text_shortcode'	
	);
	
	$shortcodes['bfg_thumbnail'] = array(
		'name' => __( 'BFG Thumbnail', 'bfg' ),
		'type' => 'single',
		'group' => 'bootstrap',
		'atts' => array(
			'class' => array(
				'type' => 'text',
				'default' => '',
				'name' => __( 'Class', 'bfg' ),
				'desc' => __( 'Text class', 'bfg' )
			),
			'width' => array(
				'type' => 'number',
				'default' => '',
				'name' => __( 'Width', 'bfg' ),
				'desc' => __( 'Image width', 'bfg' )
			),
			'alignment' => array(
				'type' => 'select',
				'values' => array(
					'center' => 'Center',
					'left' => 'Left',
					'right' => 'Right'
				),
				'default' => 'left',
				'name' => __( 'Alignment', 'bfg' ),
				'desc' => __( 'Text alignment', 'bfg' )
			),
			'margin' => array(
				'type' => 'slider',
				'min' => 0,
				'max' => 100,
				'step' => 1,
				'default' => '',
				'name' => __( 'Margin', 'bfg' ),
				'desc' => __( 'Image margin based on chosen alignment', 'bfg' )
			)
		),
		'content' => __( '', 'bfg' ),
		'desc' => __( 'Text content', 'bfg' ),
		'icon' => 'code',
		'function' => 'bfg_custom_thumbnail_shortcode'
	);
	
	return $shortcodes;
}

function bfg_custom_button_shortcode( $atts, $content = null ) {
	$atts = shortcode_atts( array(
		'class' => '',
		'target' => '_self',
		'url' => '',
		'padding' => '',
		'margin' => '',
		'size' => ''
	), $atts, 'bfg_button' );
	
	$output = $atts['url'] ? '<a href="'.esc_url( $atts['url'] ).'" role="button"' : '<button';
	$output .= 'class="btn';
	$output .= $atts['class'] ? ' ' . esc_attr( $atts['class'] ) : '';
	$output .= '" ';
	$output .= 'target="'.$atts['target'].'" ';
	$output .= 'style="padding:'.esc_attr( $atts['padding'] ).';';
	$output .= 'margin-bottom:';
	$output .= $atts['margin'] ? esc_attr( $atts['margin'] ) . 'px;' : '0px;';
	$output .= 'font-size:';
	$output .= $atts['size'] ? esc_attr( $atts['size'] ) . 'px;' : '16px;';
	$output .= '">';
	$output .= do_shortcode( $content );
	$output .= $atts['url'] ? '</a>' : '</button>';
	
	return $output;
}

function bfg_custom_text_shortcode( $atts, $content = null ) {
	$atts = shortcode_atts( array(
		'class' => '',
		'size' => '',
		'tag' => 'span',
		'alignment' => '',
		'color' => '#000',
		'margin' => ''
	), $atts, 'bfg_text' );

	$output = $atts['tag'] ? '<'. $atts['tag'] : '<span';
	$output .= ' style="';
	$output .= 'font-size:';
	$output .= $atts['size'] ? esc_attr( $atts['size'] ) . 'px;' : '16px;';
	$output .= 'text-align:';
	$output .= $atts['alignment'] ? esc_attr( $atts['alignment'] ) . ';' : 'left;';
	$output .= 'margin-bottom:';
	$output .= $atts['margin'] ? esc_attr( $atts['margin'] ) . 'px;' : '0px;';
	$output .= 'color:';
	$output .= $atts['color'] ? esc_attr( $atts['color'] ) . ';' : '#000;';
	$output .= '" class="text';
	$output .= $atts['class'] ? ' ' . esc_attr( $atts['class'] ) : '';
	$output .= '">';
	$output .= do_shortcode( $content );
	$output .= $atts['tag'] ? '</' . $atts['tag'] . '>' : '</span>';

	return $output;
} 