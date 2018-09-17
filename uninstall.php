<?php

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

//declaring global DB connection variable
global $wpdb;

//get all the sites for multisite, if not a multisite, set blog id to 1
if (is_multisite()) {
	$blogs_ids = get_sites();
} else {
	$blogs_ids = [1];
}

//delete plugin options and posts/chapter related metadata from every site
foreach( $blogs_ids as $b ){
	//if multisite, each iteration changes site
	if (is_multisite()) {
		switch_to_blog( $b->blog_id );
	}

	//get all the options from database
	$all_options = wp_load_alloptions();
	$plugin_options = [];


	//extract plugin options from all options
	foreach ( $all_options as $name => $value ) {

		if ( stristr($name, 'smd_') || stristr($name, 'smde_')) {

			$plugin_options[ $name ] = $value;
		}
	}


	//delete plugin options
	foreach ( $plugin_options as $key => $value ) {
		if ( get_option( $key ) || get_option($key, 'nonex') !== 'nonex') {
			delete_option( $key );
		}
	}

	// Delete plugin related posts' meta
	//if blog is root, do not add blog number to table name
	$blog_id = $b->blog_id == 1 || $b == 1 ? '' : $b->blog_id.'_';
	//DELETE query to postmeta database
	$wpdb->query( "DELETE FROM `".$wpdb->prefix.$blog_id."postmeta` WHERE `meta_key` LIKE 'smd_%'");
}