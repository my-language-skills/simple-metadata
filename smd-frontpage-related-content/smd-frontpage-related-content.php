<?php

//Metadata for front page


/**
 * Fuction for creating option to choose etween blog and web-site
 */
function smd_add_option_page () {
	
	//adding main menu page for plugin and all addons
	add_menu_page('Simple Metadata', 'Metadata', 'manage_options', 'smd_set_page', 'smd_render_options_page', 'dashicons-search');
	//fix to have different name in admin menu for main subpage
	add_submenu_page('smd_set_page','Settings', 'Settings', 'manage_options', 'smd_set_page');
	if (!is_plugin_active('pressbooks/pressbooks.php')){
		add_submenu_page('smd_set_page','Site', 'Site', 'manage_options', 'smd_set_page_site', 'smd_render_site_page');
	}
	add_meta_box('smd-location-settings', 'Active Locations', 'smd_render_locations_metabox', 'smd_set_page', 'normal', 'core');
	add_meta_box('smd-settings', 'Front Page', 'smd_render_metabox', 'smd_set_page_site', 'normal', 'core');

	$post_types = smd_get_all_post_types();
	$locations = get_option('smd_locations');

	//adding settings sections for type of site setting and locations
	add_settings_section( 'smd_set_page_site', '', '', 'smd_set_page_site' );
	add_settings_section( 'smd_locations', '', '', 'smd_locations' );
	//registering setting for type of site
	register_setting ('smd_set_page_site', 'smd_website_blog_type');
	//registering setting for locations
	register_setting('smd_locations', 'smd_locations');

	if (!get_option('smd_website_blog_type') && !is_plugin_active('pressbooks/pressbooks.php')) {
		update_option('smd_website_blog_type', 'Blog');
	}
	if (!is_plugin_active('pressbooks/pressbooks.php')){
		add_settings_field ('smd_website_blog_type', 'Type of Site', 'smd_render_switch_set', 'smd_set_page_site', 'smd_set_page_site');
	}

	foreach ($post_types as $post_type) {
			// we ommit Book Info or Site-Meta as general meta is not applicable for them
			if ('metadata' == $post_type || 'site-meta' == $post_type){
				continue;
			}
			$label = ucfirst($post_type);
			add_settings_field ('smd_locations['.$post_type.']', $label, function () use ($post_type, $locations){
				$checked = isset($locations[$post_type]) ? true : false;
				?>
					<input type="checkbox" name="smd_locations[<?=$post_type?>]" id="smd_locations[<?=$post_type?>]" value="1" <?php checked(1, $checked);?>>
				<?php
				
			}, 'smd_locations', 'smd_locations');
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

	wp_enqueue_script('common');
	wp_enqueue_script('wp-lists');
	wp_enqueue_script('postbox');
	?>
        <div class="wrap">
        	<?php if (isset($_GET['settings-updated']) && $_GET['settings-updated']) { ?>
        	<div class="notice notice-success is-dismissible"> 
				<p><strong>Settings saved.</strong></p>
			</div>
			<?php } ?>
            <div class="metabox-holder">
					<?php
					do_meta_boxes('smd_set_page', 'normal','');
					?>
            </div>
        </div>
        <script type="text/javascript">
            //<![CDATA[
            jQuery(document).ready( function($) {
                // close postboxes that should be closed
                $('.if-js-closed').removeClass('if-js-closed').addClass('closed');
                // postboxes setup
                postboxes.add_postbox_toggles('smd_set_page');
            });
            //]]>
        </script>
		<?php
}

function smd_render_site_page () {

	if(!current_user_can('manage_options')){
		return;
	}

	wp_enqueue_script('common');
	wp_enqueue_script('wp-lists');
	wp_enqueue_script('postbox');
	?>
        <div class="wrap">
        	<?php if (isset($_GET['settings-updated']) && $_GET['settings-updated']) { ?>
        	<div class="notice notice-success is-dismissible"> 
				<p><strong>Settings saved.</strong></p>
			</div>
			<?php } ?>
            <div class="metabox-holder">
					<?php
					do_meta_boxes('smd_set_page_site', 'normal','');
					?>
            </div>
        </div>
        <script type="text/javascript">
            //<![CDATA[
            jQuery(document).ready( function($) {
                // close postboxes that should be closed
                $('.if-js-closed').removeClass('if-js-closed').addClass('closed');
                // postboxes setup
                postboxes.add_postbox_toggles('smd_set_page_site');
            });
            //]]>
        </script>
		<?php
}

function smd_render_metabox(){
	?>
	<div class="wrap">
           <form method="post" action="options.php">
			<?php
			settings_fields( 'smd_set_page_site' );
			do_settings_sections( 'smd_set_page_site' );
			submit_button();
			?>
		   </form>
		   <p></p>
    </div>
    <?php
}

function smd_render_locations_metabox () {
	?>
	<div class="wrap">
			<span class="description">For CPTs possible options are equal to 'post' options</span>
           <form method="post" action="options.php">
			<?php
			settings_fields( 'smd_locations' );
			do_settings_sections( 'smd_locations' );
			submit_button();
			?>
		   </form>
		   <p></p>
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
	<label for="smd_website_blog_type_4">Course <input type="radio" id="smd_website_blog_type_4" name="smd_website_blog_type" value="Course" <?php checked('Course', get_option('smd_website_blog_type'))?>></label><br>
		<?php
	}

	echo '<br><span class="description">Select schema type which will be appplied for front-page metadata</span>';
}

/**
 * Function for printing metatag in header of front page
 */
function smd_print_wsb_field () {
	if (is_front_page()){
		//In case of pressbooks installation, always applied Book -> Chapter
		if (!is_plugin_active('pressbooks/pressbooks.php')){
			$type = get_option('smd_website_blog_type');
		} else {
			$type = 'Book';
		}
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

/**
 * Function for getting all post types of installation
 */
function smd_get_all_post_types(){
	require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
	//Gathering the post types that are public including the wordpress ones if pressbooks is disabled
	if(!is_plugin_active('pressbooks/pressbooks.php')){
		$postTypes = array_keys( get_post_types( array( 'public' => true )) );
	}else{
		$postTypes = ['chapter', 'part', 'front-matter', 'back-matter', 'metadata'];
	}
	return $postTypes;
}


add_action ('admin_menu', 'smd_add_option_page');
add_action ('wp_head', 'smd_print_wsb_field');