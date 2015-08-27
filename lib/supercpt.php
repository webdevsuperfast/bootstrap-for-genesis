<?php

if ( !class_exists( 'Super_Custom_Post_Type' ) )
	return;

add_action( 'init', 'bfg_supercpt_args' );
function bfg_supercpt_args() {
	$testimonials = new Super_Custom_Post_Type(
		'testimonial',
		'Testimonial',
		'Testimonials',
		array(
			'has_archive' => false,
			'supports' => array( 'title', 'editor', 'thumbnail' ),
			'public' => true
		)
	);

	$testimonial->set_icon['comments'];
}