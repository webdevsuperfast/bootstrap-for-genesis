<?php

/*
Widget Name: BFG - Accordion Widget
Description: A widget implementation of Bootstrap accordion component.
Author: SuperFastBusiness
Author URI: http://www.superfastbusiness.com
*/

class BFG_Accordion_Widget extends SiteOrigin_Widget {
	function __construct() {

		parent::__construct(
			'bfg-accordion-widget',
			__( 'BFG - Accordion Widget', 'bfg' ),
			array(
				'description' => __( 'A widget implementation of Bootstrap accordion component.', 'bfg' ),
			),

			array(

			),

			array(
				'title' => array(
					'type' => 'text',
					'label' => __( 'Title', 'siteorigin-widgets' ),
					'default' => ''
				),

				'content' => array(
					'type' => 'repeater',
					'label' => __( 'Content' , 'siteorigin-widgets' ),
					'item_name'  => __( 'Add content', 'siteorigin-widgets' ),
					'item_label' => array(
						'selector'     => "[id*='heading']",
						'update_event' => 'change',
						'value_method' => 'val'
					),
					'fields' => array(
						'heading' => array(
							'type' => 'text',
							'label' => __( 'Heading', 'siteorigin-widgets' ),
							'default' => ''
						),
						'body' => array(
							'type' => 'textarea',
							'label' => __( 'Body', 'siteorigin-widgets' ),
							'default' => ''
						)
					)
				)
			),

			BFG_THEME_MODULES
		);
	}

	function get_template_name( $instance ) {
		return 'bfg-accordion-widget-template';
	}

	function get_style_name( $instance ) {
		return 'bfg-accordion-widget-style';
	}

}

siteorigin_widget_register( 'bfg-accordion-widget', __FILE__, 'BFG_Accordion_Widget' );
