<?php

/**
 * Summary (no period for file headers)
 *
 * Description. (use period)
 *
 * @link URL
 *
 * @package simple-metadata
 * @subpackage unistall
 * @since 0.1 (when the file was introduced)
 */

// If uninstall not called from WordPress, then exit.
if ( ! defined( 'WP_UNINSTALL_PLUGIN' ) ) {
	exit;
}

//uninstall functions
include_once plugin_dir_path( __FILE__ ) . "inc/smd-uninstall-functions.php";

//get all the sites for multisite, if not a multisite, set blog id to 1
if (is_multisite()) {
	$blogs_ids = get_sites();
  smd_delete_network_options('smd_');
} else {
	$blogs_ids = [1];
}
smd_delete_local_options_and_post_meta($blogs_ids, 'smd_');
