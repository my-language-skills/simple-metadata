<?php

/*
Plugin Name: Simple Metadata WebSite-Blog Switch
Plugin URI: https://github.com/my-language-skills/aiom-extensions
Description: This plugin creates WebSite or Blog Schema.org types metatag in all pages. To switch between go to Reading settings.
Version: 1.0
Author: My Language Skills
Author URI: https://github.com/my-language-skills
License: GPL 3.0
*/


/**
 * Fuction for creating option to choose etween blog and web-site
 */
function smd_add_radio_option () {
	register_setting ('reading', 'smd_website_blog_type');
	add_settings_field ('smd_website_blog_type', 'Type of Site', 'smd_render_switch_set', 'reading', 'default');
}

function smd_render_switch_set() {
	?>
	<label for="smd_website_blog_type_1">Blog <input type="radio" id="smd_website_blog_type_1" name="smd_website_blog_type" value="Blog" <?php checked('Blog', get_option('smd_website_blog_type'))?>></label>
	<label for="smd_website_blog_type_2">WebSite <input type="radio" id="smd_website_blog_type_2" name="smd_website_blog_type" value="WebSite" <?php checked('WebSite', get_option('smd_website_blog_type'))?>></label>
	<?php
}

/**
 * Function for printing metatag in header
 */
function smd_print_wsb_field () {
	if (is_front_page()){
		$type = get_option('smd_website_blog_type');
		$title = get_bloginfo();
		if ($type){
		?>
		<!-- FRONTPAGE META -->
			<div itemscope itemtype="http://schema.org/<?=$type?>">
				<meta itemprop="name" content="<?=$title?>">
			</div>
		<!-- END OF FRONTPAGE META -->
		<?php
		
		}
	}	
}


add_action ('admin_init', 'smd_add_radio_option');
add_action ('wp_head', 'smd_print_wsb_field');