<?php
/*
Plugin Name: AIOM Extensions
Plugin URI: https://github.com/my-language-skills/aiom-extensions
Description: This plugin provides auto-generated metadata on the basis of default WP web-pages information. With use of All-In-One Metadata plugin provides extended functionality.
Version: 0.1
Author: Daniil Zhitnitskii (My Language Skills)
Author URI: https://github.com/my-language-skills
License: GPL 3.0
*/

defined ("ABSPATH") or die ("No script assholes!");

include_once plugin_dir_path( __FILE__ ) . "aiom-webpage-related-content/aiom-webpage-related-content.php";
include_once plugin_dir_path( __FILE__ ) . "aiom-news-related-content/aiom-news-related-content.php";
include_once plugin_dir_path( __FILE__ ) . "aiom-articles-related-content/aiom-articles-related-content.php";