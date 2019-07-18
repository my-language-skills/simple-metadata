<?php


/**
 * Deletes all network options stored in wp_sitemeta
 *
 * @param string plugin_abbreviation e.g. 'smd_' for simple-metadata
 * @since 1.3
 *
 */
function smd_delete_network_options($plugin_abbreviation){
	//declaring global DB connection variable
	global $wpdb;
  /*
  * get all netword option stored in wp_sitemeta
  * and store them like int => meta_key(option_name)
  */
  $net_options = $wpdb->get_col('SELECT meta_key FROM wp_sitemeta');
  //Options of the plugin
  $network_plugin_options = [];

  //extract plugin options from all network_options
  foreach ( $net_options as $key => $value ) {

		if ( stristr($value, $plugin_abbreviation) || stristr($value, 'smde_')) {

			$network_plugin_options[ $key ] = $value;
		}
	}

  //delete network plugin options
	foreach ( $network_plugin_options as $key => $value ) {
		if ( get_site_option( $value ) || get_site_option($value, 'nonex') !== 'nonex') {
			delete_site_option( $value );
		}
	}
}

/**
 * Delete plugin options and posts/chapter related metadata from every site
 *
 * @param array blogs_ids The id number of each site (e.g. id = 1, 2, 3...)
 * @param string plugin_abbreviation e.g. 'smd_' for simple-metadata
 * @since 1.3
 *
 */
function smd_delete_local_options_and_post_meta($blogs_ids, $plugin_abbreviation){
	//declaring global DB connection variable
	global $wpdb;
  foreach( $blogs_ids as $b ){
  	//if multisite, each iteration changes site
  	if (is_multisite()) {
  		switch_to_blog( $b->blog_id );
  	}

  	/*
    * get all local sub-site options from table wp_options each site
    * and store them in an array option_name => option_value
    */
  	$local_options = wp_load_alloptions();

    // Stores all option used by the plugin
    $local_plugin_options = [];

  	//extract plugin options from all local_options
  	foreach ( $local_options as $name => $value ) {

  		if ( stristr($name, $plugin_abbreviation) || stristr($name, 'smde_')) { 

  			$local_plugin_options[ $name ] = $value;
  		}
  	}

  	//delete local plugin options
  	foreach ( $local_plugin_options as $key => $value ) {
  		if ( get_option( $key ) || get_option($key, 'nonex') !== 'nonex') {
  			delete_option( $key );
  		}
  	}

  	// Delete plugin related posts' meta
  	//if blog is root, do not add blog number to table name
  	$blog_id = $b->blog_id == 1 || $b == 1 ? '' : $b->blog_id.'_';
  	//DELETE query to postmeta database
  	$wpdb->query( "DELETE FROM `".$wpdb->prefix.$blog_id."postmeta` WHERE `meta_key` LIKE ".$plugin_abbreviation."'%'");
  }
}

?>
