<?php

/*
Widget Name: BFG - Modal Widget
Description: A widget implementation of Bootstrap modal component.
Author: SuperFastBusiness
Author URI: http://www.superfastbusiness.com
*/

class BFG_Modal_Widget extends SiteOrigin_Widget {
	function __construct() {

		parent::__construct(
			'bfg-modal-widget',
			__( 'BFG - Modal Widget', 'bfg' ),
			array(
				'description' => __( 'A widget implementation of Bootstrap modal component.', 'bfg' ),
			),

			array(

			),

			array(
				'title' => array(
					'type' => 'text',
					'label' => __( 'Modal Title', 'siteorigin-widgets' ),
					'default' => ''
				),
				'settings' => array(
					'type' => 'section',
					'label' => __( 'Modal Settings', 'siteorigin-widgets' ),
					'hide' => true,
					'fields' => array(
						'settings_id' => array(
							'type' => 'text',
							'label' => __( 'Modal ID', 'siteorigin-widgets' ),
							'default' => ''
						),
						'settings_size' => array(
							'type' => 'select',
							'label' => __( '', 'siteorigin-widgets' ),
							'prompt' => __( 'Modal Size', 'siteorigin-widgets' ),
							'options' => array(
								'' => 'Default',
								'modal-sm' => 'Small',
								'modal-lg' => 'Large'
							)
						)
					)
				),
				'button' => array(
					'type' => 'section',
					'label' => __( 'Modal Button', 'siteorigin-widgets' ),
					'hide' => true,
					'fields' => array(
						'button_text' => array(
							'type' => 'text',
							'label' => __( 'Button Text', 'siteorigin-widgets' ),
							'default' => ''
						),
						'button_class' => array(
							'type' => 'text',
							'label' => __( 'Button Class', 'siteorigin-widgets' ),
							'default' => ''
						)
					)
				),
				'body' => array(
					'type' => 'section',
					'label' => __( 'Modal Body', 'siteorigin-widgets' ),
					'hide' => true,
					'fields' => array(
						'body_text' => array(
							'type' => 'textarea',
							'label' => __( 'Modal Body Text', 'siteorigin-widgets' )
						)
					)
				),
				'footer' => array(
					'type' => 'section',
					'label' => __( 'Modal Footer', 'siteorigin-widgets' ),
					'hide' => true,
					'fields' => array(
						'footer_text' => array(
							'type' => 'textarea',
							'label' => __( 'Modal Footer Text', 'siteorigin-widgets' )
						)
					)
				)
			),

			BFG_THEME_MODULES
		);
	}

	function get_template_name( $instance ) {
		return 'bfg-modal-widget-template';
	}

	function get_style_name( $instance ) {
		return 'bfg-modal-widget-style';
	}

}

siteorigin_widget_register( 'bfg-modal-widget', __FILE__, 'BFG_Modal_Widget' );
