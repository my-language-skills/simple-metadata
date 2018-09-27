<?php

//network admin interface

defined ("ABSPATH") or die ("No script assholes!");

/**
 * Function for adding network settings page
 */
function smd_add_network_settings() {
	// Create our options page.
    add_submenu_page( 'settings.php', 'Simple Metadata Network Settings',
    'Metadata', 'manage_network_options',
    'smd_net_set_page', 'smd_render_network_settings');

    //adding settings metaboxes and settigns sections
    add_meta_box('smd-metadata-network-location', 'General Metadata', 'smd_network_render_metabox_schema_locations', 'smd_net_set_page', 'normal', 'core');
    if (!is_plugin_active('pressbooks/pressbooks.php')){
    	add_meta_box('smd-network-metadata-sites-type', 'Front pages', 'smd_network_render_metabox_sites_type', 'smd_net_set_page', 'normal', 'core');
	}

    add_settings_section( 'smd_network_meta_locations', '', '', 'smd_network_meta_locations' );

    if (!is_plugin_active('pressbooks/pressbooks.php')){
    	add_settings_section( 'smd_network_meta_sites_type', '', '', 'smd_network_meta_sites_type' );
	}


    //registering settings
    register_setting('smd_network_meta_locations', 'smd_net_locations');
    if (!is_plugin_active('pressbooks/pressbooks.php')){
		register_setting ('smd_network_meta_sites_type', 'smd_net_sites_type');
	}


	// getting options values from DB
	$post_types = smd_get_all_post_types();
	$locations = get_option('smd_net_locations');
	$sites_type = get_option('smd_net_sites_type');

	if (!is_plugin_active('pressbooks/pressbooks.php')){
		add_settings_field ('smd_network_site_type', 'Type of Sites', 'smd_render_net_switch_set', 'smd_network_meta_sites_type', 'smd_network_meta_sites_type');
	}
	

	//adding settings for locations
	foreach ($post_types as $post_type) {

		// we ommit Book Info or Site-Meta as general meta is not applicable for them
		if ('metadata' == $post_type || 'site-meta' == $post_type){
			continue;
		}

		$label = ucfirst($post_type);

		add_settings_field ('smd_net_locations['.$post_type.']', $label, function () use ($post_type, $locations){
			$checked = isset($locations[$post_type]) ? true : false;
			?>
				<input type="checkbox" name="smd_net_locations[<?=$post_type?>]" id="smd_net_locations[<?=$post_type?>]" value="1" <?php checked(1, $checked);?>>
			<?php
		}, 'smd_network_meta_locations', 'smd_network_meta_locations');
	}

	
}

/**
 * Function for rendering network settings page
 */
function smd_render_network_settings(){
	wp_enqueue_script('common');
		wp_enqueue_script('wp-lists');
		wp_enqueue_script('postbox');
	    ?>
	    <div class="wrap">
	    	<?php if (isset($_GET['settings-updated']) && $_GET['settings-updated']) { //in case settings were saved, we show notice?>
        	<div class="notice notice-success is-dismissible"> 
				<p><strong>Settings saved.</strong></p>
			</div>
			<?php } ?>
		    <div class="metabox-holder">
			    <?php
			    	do_meta_boxes('smd_net_set_page', 'normal','');
			    ?>
		    </div>
	    </div>
	    <script type="text/javascript">
            //<![CDATA[
            jQuery(document).ready( function($) {
                // close postboxes that should be closed
                $('.if-js-closed').removeClass('if-js-closed').addClass('closed');
                // postboxes setup
                postboxes.add_postbox_toggles('<?php echo 'smd_net_set_page'; ?>');
            });
            //]]>
		</script>
		<?php
}

/**
 * Function for rendering metabox of locations
 */
function smd_network_render_metabox_schema_locations(){
	?>
	<div id="smd_network_meta_locations" class="smd_network_meta_locations">
		<span class="description"><span class="description">Description for general network settings metabox</span></span>
		<form method="post" action="edit.php?action=smd_update_network_locations">
			<?php
			settings_fields( 'smd_network_meta_locations' );
			do_settings_sections( 'smd_network_meta_locations' );
			submit_button();
			?>
		</form>
		<p></p>
	</div>
	<?php
}

/**
 * Function for rendering metabox for properties management
 */
function smd_network_render_metabox_sites_type(){
	?>
	<div id="smd_network_meta_sites_type" class="smd_network_meta_sites_type">
		<span class="description">Description for site network option metabox</span>
		<form method="post" action="edit.php?action=smd_update_network_options">
			<?php
			settings_fields( 'smd_network_meta_sites_type' );
			do_settings_sections( 'smd_network_meta_sites_type' );
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
function smd_render_net_switch_set() {
	?>
	<label for="smd_website_blog_type_0">Local value <input type="radio" id="smd_website_blog_type_0" name="smd_net_sites_type" value="0" <?php checked('0', get_option('smd_net_sites_type'))?>></label>
	<label for="smd_website_blog_type_1">Blog <input type="radio" id="smd_website_blog_type_1" name="smd_net_sites_type" value="Blog" <?php checked('Blog', get_option('smd_net_sites_type'))?>></label>
	<label for="smd_website_blog_type_2">WebSite <input type="radio" id="smd_website_blog_type_2" name="smd_net_sites_type" value="WebSite" <?php checked('WebSite', get_option('smd_net_sites_type'))?>></label>
	<?php // if education plugin is active, add new options to select (possibly new values with other addons)
	if (is_plugin_active('simple-metadata-education/simple-metadata-education.php')){
		?>
	<label for="smd_website_blog_type_3">Book <input type="radio" id="smd_website_blog_type_3" name="smd_net_sites_type" value="Book" <?php checked('Book', get_option('smd_net_sites_type'))?>></label>
	<label for="smd_website_blog_type_4">Course <input type="radio" id="smd_website_blog_type_4" name="smd_net_sites_type" value="Course" <?php checked('Course', get_option('smd_net_sites_type'))?>></label><br>
		<?php
	}

	echo '<br><span class="description">Select schema type which will be appplied for front-page metadata</span>';
}

/**
 * Handler for locations settings update
 */
function smd_update_network_locations() {

	//checking admin reffer to prevent direct access to this function
	check_admin_referer('smd_network_meta_locations-options');

	//Wordpress Database variable for database operations
    global $wpdb;

    //collecting locations accumulative option from POST request
	$locations = isset($_POST['smd_net_locations']) ? $_POST['smd_net_locations'] : array();

	//updating network location option
	update_blog_option(1, 'smd_net_locations', $locations);

	//Grabbing all the site IDs
    $siteids = $wpdb->get_col("SELECT blog_id FROM $wpdb->blogs");

    //Going through the sites and updating active locations site-by-site
    foreach ($siteids as $site_id) {
    	if (1 == $site_id){
    		continue;
    	}

    	switch_to_blog($site_id);

    	//getting blog active lcoations
    	$locations_local = get_option('smd_locations') ?: array();

    	//we merge active locations of blog with active locations from network settings
    	$locations_local = array_merge($locations_local, $locations);

    	update_option('smd_locations', $locations_local);

    }

    restore_current_blog();

	// At the end we redirect back to our options page.
    wp_redirect(add_query_arg(array('page' => 'smd_net_set_page',
    'settings-updated' => 'true'), network_admin_url('settings.php')));

    exit;
}

/**
 * Handler for properties settings update
 */
function smd_update_network_options() {

	//checking admin reffer to prevent direct access to this function
	check_admin_referer('smd_network_meta_sites_type-options');

	//Wordpress Database variable for database operations
    global $wpdb;

    //getting option for type of sites
    $sites_type = isset($_POST['smd_net_sites_type']) ? $_POST['smd_net_sites_type'] : '';
    

    //updating network options
	update_blog_option(1, 'smd_net_sites_type', $sites_type);

	//Grabbing all the site IDs
    $siteids = $wpdb->get_col("SELECT blog_id FROM $wpdb->blogs");

    //Going through the sites
    foreach ($siteids as $site_id) {

    	if (1 == $site_id){
    		continue;
    	}

    	switch_to_blog($site_id);  	

    	//updating local options obly if some type is selected
    	if ('0' !== $sites_type){
    		update_option('smd_website_blog_type', $sites_type);
    	}

    }

    restore_current_blog();

	// At the end we redirect back to our options page.
    wp_redirect(add_query_arg(array('page' => 'smd_net_set_page',
    'settings-updated' => 'true'), network_admin_url('settings.php')));

    exit;
}


add_action( 'network_admin_menu', 'smd_add_network_settings');
add_action( 'network_admin_edit_smd_update_network_locations', 'smd_update_network_locations');
add_action( 'network_admin_edit_smd_update_network_options', 'smd_update_network_options');