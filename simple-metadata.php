<?php
/**
 * Plugin Name: Simple Metadata
 * Plugin URI: https://github.com/my-language-skills/simple-metadata
 * Description: This plugin provides auto-generated metadata on the basis of default WP web-pages information.
 * Version: 1.3
 * Author: My Language Skills team
 * Author URI: https://github.com/my-language-skills
 * License: GPL 3.0
 * License URI: https://www.gnu.org/licenses/gpl-3.0.en.html
*/

defined ("ABSPATH") or die ("No script assholes!");

require_once( ABSPATH . '/wp-admin/includes/plugin.php' );

//if not presbooks and AIOM not installed, load custom_metadata symbiont (when all packages will be organized, second condition can be removed)
if (!is_plugin_active('pressbooks/pressbooks.php') && !function_exists('x_add_metadata_field')){
	require_once plugin_dir_path( dirname(__FILE__ ) ) . '/simple-metadata/symbionts/custom-metadata/custom_metadata.php';
}

if (is_plugin_active('simple-metadata-education/simple-metadata-education.php') || is_plugin_active('simple-metadata-lifecycle/simple-metadata-lifecycle.php') || is_plugin_active('simple-metadata-annotation/simple-metadata-annotation.php')){
	include_once plugin_dir_path( __FILE__ ) . "inc/smd-site-cpt.php";
}
include_once plugin_dir_path( __FILE__ ) . "inc/smd-general-functions.php";
include_once plugin_dir_path( __FILE__ ) . "smd-pages-related-content/smd-pages-related-content.php";
include_once plugin_dir_path( __FILE__ ) . "smd-posts-related-content/smd-posts-related-content.php";
include_once plugin_dir_path( __FILE__ ) . "smd-frontpage-related-content/smd-frontpage-related-content.php";
//loading network settings only for multisite installation
if (is_multisite()){
	include_once plugin_dir_path( __FILE__ ) . "network-admin/smd-network-admin.php";
}
