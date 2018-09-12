<?php

//Metadata for front page


/**
 * Fuction for creating option to choose etween blog and web-site
 */
function smd_add_option_page () {
	//registering setting for type of site
	register_setting ('smd_set_page', 'smd_website_blog_type');
	//adding main menu page for plugin and all addons
	add_menu_page('Simple Metadata', 'Metadata', 'manage_options', 'smd_set_page', 'smd_render_options_page', 'dashicons-search');
	//fix to have different name in admin menu for main subpage
	add_submenu_page('smd_set_page','General Settings', 'General Settings', 'manage_options', 'smd_set_page');

	//adding settings section and field for type of site setting
	add_settings_section( 'smd_set_page', '', '', 'smd_set_page' );
	add_settings_field ('smd_website_blog_type', 'Type of Site', 'smd_render_switch_set', 'smd_set_page', 'smd_set_page');
	if (!get_option('smd_website_blog_type')){
		update_option('smd_website_blog_type', 'Blog');
	}
}


/**
 * Render the options page for plugin.
 *
 * @since  1.0
 */
function smd_render_options_page() {
	if(!current_user_can('manage_options')){
		return;
	}
	?>
       <div class="wrap">
           <h2>Simple Metadata Settings</h2>
           <form method="post" action="options.php">
			<?php
			settings_fields( 'smd_set_page' );
			do_settings_sections( 'smd_set_page' );
			submit_button();
			?>
		   </form>
       </div>
	<?php
}

/**
 * Function for rendering radio button
 */
function smd_render_switch_set() {
	?>
	<label for="smd_website_blog_type_1">Blog <input type="radio" id="smd_website_blog_type_1" name="smd_website_blog_type" value="Blog" <?php checked('Blog', get_option('smd_website_blog_type'))?>></label>
	<label for="smd_website_blog_type_2">WebSite <input type="radio" id="smd_website_blog_type_2" name="smd_website_blog_type" value="WebSite" <?php checked('WebSite', get_option('smd_website_blog_type'))?>></label>
	<?php // if education plugin is active, add new options to select
	if (is_plugin_active('simple-metadata-education/simple-metadata-education.php')){
		?>
	<label for="smd_website_blog_type_3">Book <input type="radio" id="smd_website_blog_type_3" name="smd_website_blog_type" value="Book" <?php checked('Book', get_option('smd_website_blog_type'))?>></label>
	<label for="smd_website_blog_type_4">Course <input type="radio" id="smd_website_blog_type_4" name="smd_website_blog_type" value="Course" <?php checked('Course', get_option('smd_website_blog_type'))?>></label>
		<?php
	}
}

/**
 * Function for printing metatag in header of front page
 */
function smd_print_wsb_field () {
	if (is_front_page()){
		$type = get_option('smd_website_blog_type');
		$title = get_bloginfo();
		$description = get_bloginfo( 'description' );
		$url = get_bloginfo( 'url' );
		$language = get_bloginfo( 'language' );
		if ($type){
		?>
		<!-- FRONTPAGE META -->
			<div itemscope itemtype="http://schema.org/<?=$type?>">
				<meta itemprop="name" content="<?=$title?>">
				<meta itemprop = "description" content = "<?=$description?>">
		        <meta itemprop = "url" content = "<?=$url?>">
		        <meta itemprop = "inLanguage" content = "<?=$language?>">
			</div>
		<!-- END OF FRONTPAGE META -->
		<?php
		
		}
	}	
}


add_action ('admin_menu', 'smd_add_option_page');
add_action ('wp_head', 'smd_print_wsb_field');