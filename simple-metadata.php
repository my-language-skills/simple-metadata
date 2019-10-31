<?php

/**
 * Simple Metadata
 *
 * This file is read by WordPress to generate the plugin information in the plugin
 * admin area. This file also includes all of the dependencies used by the plugin,
 * registers the activation and deactivation functions, and defines a function
 * that starts the plugin.
 *
 * @link              https://github.com/my-language-skills/simple-metadata
 * @since             0.1
 * @package           simple-metadata
 *
 * @wordpress-plugin
 * Plugin Name:       Simple Metadata
 * Plugin URI:        https://github.com/my-language-skills/simple-metadata
 * Description:       This plugin provides auto-generated metadata on the basis of default WP web-pages information.
 * Version:           1.4.3
 * Author:            My Language Skills team
 * Author URI:        https://github.com/my-language-skills/
 * License:           GPL 3.0
 * License URI:       http://www.gnu.org/licenses/gpl-3.0.txt
 * Text Domain:       simple-metadata
 * Domain Path:       /languages
 */

defined ("ABSPATH") or die ("No script assholes!");

require_once( ABSPATH . '/wp-admin/includes/plugin.php' );

//if not presbooks and AIOM not installed, load custom_metadata symbiont (when all packages will be organized, second condition can be removed)
if (!is_plugin_active('pressbooks/pressbooks.php') && !function_exists('x_add_metadata_field')){
	require_once plugin_dir_path( dirname(__FILE__ ) ) . '/simple-metadata/symbionts/custom-metadata/custom_metadata.php';
}

if (is_plugin_active('simple-metadata-education/simple-metadata-education.php') ||
		is_plugin_active('simple-metadata-lifecycle/simple-metadata-lifecycle.php') ||
		is_plugin_active('simple-metadata-annotation/simple-metadata-annotation.php') ||
		is_plugin_active('simple-metadata-relation/simple-metadata-relation.php')){
	include_once plugin_dir_path( __FILE__ ) . "admin/smd-site-cpt.php";
}

include_once plugin_dir_path( __FILE__ ) . "inc/smd-general-functions.php";
include_once plugin_dir_path( __FILE__ ) . "admin/smd-set-page-metaboxes.php";
include_once plugin_dir_path( __FILE__ ) . "admin/smd-googleImage-box.php";
include_once plugin_dir_path( __FILE__ ) . "smd-posts-related-content/smd-posts-related-content.php";
include_once plugin_dir_path( __FILE__ ) . "smd-pages-related-content/smd-pages-related-content.php";
include_once plugin_dir_path( __FILE__ ) . "smd-frontpage-related-content/smd-frontpage-related-content.php";
//loading network settings only for multisite installation
if (is_multisite()){
	include_once plugin_dir_path( __FILE__ ) . "network-admin/smd-network-admin.php";
}

/**
 * Internalization
 * Loads the MO file for plugin's translation.
 *
 * @since 1.3
 *
 */
	function smd_load_plugin_textdomain() {
    load_plugin_textdomain( 'simple-metadata', FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );
}

/**
 * The activated plugin has been loaded
 */
add_action( 'plugins_loaded', 'smd_load_plugin_textdomain' );

/**
 * @since 1.3
 */
function smd_disable_pressbook_metadata() {
	if(is_plugin_active('pressbooks/pressbooks.php')){
    remove_action('wp_head', '\Pressbooks\Metadata\add_json_ld_metadata');
		remove_action('wp_head', '\Pressbooks\Metadata\add_citation_metadata');
	}
}

// Fires after WordPress has finished loading but before any headers are sent.
add_action( 'init', 'smd_disable_pressbook_metadata' );
