<?php
/**
 *	Functionality for marking web-pages elements with appropriate Schema.org types
 */


function aiex_enque_elements_script () {
	wp_enqueue_script ('aiex_webpage_elements', plugin_dir_url( __FILE__ ).'assets/scripts/aiex-wepbage-elements.js');
}

add_action( 'wp_enqueue_scripts', 'aiex_enque_elements_script' );