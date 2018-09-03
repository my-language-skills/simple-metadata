<?php
/*
Plugin Name: Simple Metadata
Plugin URI: https://github.com/my-language-skills/aiom-extensions
Description: This plugin provides auto-generated metadata on the basis of default WP web-pages information.
Version: 1.0
Author: My Language Skills team
Author URI: https://github.com/my-language-skills
License: GPL 3.0
*/

defined ("ABSPATH") or die ("No script assholes!");

include_once plugin_dir_path( __FILE__ ) . "smd-webpage-related-content/smd-webpage-related-content.php";
include_once plugin_dir_path( __FILE__ ) . "smd-posts-related-content/smd-posts-related-content.php";
include_once plugin_dir_path( __FILE__ ) . "smd-website-blog-switch/smd-website-blog-switch.php";