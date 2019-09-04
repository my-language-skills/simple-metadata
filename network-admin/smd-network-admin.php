<?php

/**
 * Network admin interface
 *
 * Description. (use period)
 *
 * @link URL
 *
 * @package simple-metadata
 * @subpackage simple-metadata/network-admin
 * @since 1.0
 */

defined ("ABSPATH") or die ("No script assholes!");

/**
 * Function for adding network settings page
 *
 * @since   1.0
 *
 */
function smd_add_network_settings() {
	// Create our options page.
  add_submenu_page( 'settings.php', __('Simple Metadata Network Settings', 'simple-metadata'),
  __('Metadata', 'simple-metadata'), 'manage_network_options',
  'smd_net_set_page', 'smd_render_network_settings');

  //adding settings metaboxes and settigns sections
  add_meta_box('smd-metadata-network-location', __('General Metadata', 'simple-metadata'), 'smd_network_render_metabox_schema_locations', 'smd_net_set_page', 'normal', 'core');
  if (!is_plugin_active('pressbooks/pressbooks.php')){
  	add_meta_box('smd-network-metadata-sites-type', __('Home', 'simple-metadata'), 'smd_network_render_metabox_sites_type', 'smd_net_set_page', 'normal', 'core');
	}
  add_settings_section( 'smd_network_meta_locations', '', '', 'smd_network_meta_locations' );

  smd_add_net_metabox_for_options();

  if (!is_plugin_active('pressbooks/pressbooks.php')){
  	add_settings_section( 'smd_network_meta_sites_type', '', '', 'smd_network_meta_sites_type' );
	}


  //registering settings
  add_site_option('smd_net_locations', '');
  if (!is_plugin_active('pressbooks/pressbooks.php')){
    add_site_option('smd_net_sites_type', '');
	}

	// getting options values from DB
	$post_types = smd_get_all_post_types();
	$locations = get_site_option('smd_net_locations');
	$sites_type = get_site_option('smd_net_sites_type');

	if (!is_plugin_active('pressbooks/pressbooks.php')){
		add_settings_field ('smd_network_site_type', __('Type of Sites', 'simple-metadata'), 'smd_render_net_switch_set', 'smd_network_meta_sites_type', 'smd_network_meta_sites_type');
	}

	//adding settings for locations
	foreach ($post_types as $post_type) {

		// we ommit Book Info or Site-Meta as general meta is not applicable for them
		if ('metadata' == $post_type || 'site-meta' == $post_type){
			continue;
		}


    // Translate post type for internalization
    switch ($post_type) {
      case 'post':
        $label = __('Post', 'simple-metadata');
        break;
      case 'page':
        $label = __('Page', 'simple-metadata');
        break;
      default:
        $label = ucfirst($post_type);
        break;
    }

		add_settings_field ('smd_net_locations['.$post_type.']', $label,
     function () use ($post_type, $locations){
  		$checked = isset($locations[$post_type]) ? true : false;
			?>
				<input type="checkbox" name="smd_net_locations[<?=$post_type?>]" id="smd_net_locations[<?=$post_type?>]" value="1" <?php checked(1, $checked);?>>
			<?php
		}, 'smd_network_meta_locations', 'smd_network_meta_locations');
	}


}

/**
 * Adds the metabox 'Options' in the network page
 *
 * @since   1.4
 */
function smd_add_net_metabox_for_options(){
  //Options metabox
  add_meta_box('smd-net-box-options', __('Options', 'simple-metadata'), 'smd_render_net_metabox_options', 'smd_net_set_page', 'normal', 'low');
  add_settings_section( 'smd_net_section_options', '', '', 'smd_net_section_options' );
  add_settings_field ('smd_net_options_hide_dates', __('Hide dates', 'simple-metadata'), 'smd_render_net_options_hide_dates', 'smd_net_section_options', 'smd_net_section_options');
  add_site_option('smd_net_hide_metadata_dates', '');
}

/**
 * Display the content in the metabox 'Option'
 *
 * @since   1.4
 */
function smd_render_net_metabox_options(){
  ?>
  <div id="smd_render_net_metabox_options" class="smd_render_net_metabox_options">
    <form method="post" action="edit.php?action=smd_update_network_options">
      <?php
      do_settings_sections( 'smd_net_section_options' );
      settings_fields( 'smd_net_section_options' );
      submit_button();
      ?>
    </form>
    <p></p>
  </div>
  <?php
}

/**
 * Display the option 'Hide dates' in the metabox 'Options'
 *
 * @since   1.4
 */
function smd_render_net_options_hide_dates(){
  ?>
  <label for="smd_net_hide_dates">
    <input type="checkbox" id="smd_net_hide_metadata_dates" name="smd_net_hide_metadata_dates" value="true"
      <?php checked('true', get_site_option('smd_net_hide_metadata_dates'))?>
    >
  </label><br>
  <span class="description">
      <?php
      esc_html_e('If selected the metadata tags "dateCreated" and "datePublished" will be hide');
      ?>
  </span>
  <?php
}


/**
 * Function for rendering network settings page
 *
 * @since   1.0
 *
 */
function smd_render_network_settings(){
  wp_enqueue_script('common');
	wp_enqueue_script('wp-lists');
	wp_enqueue_script('postbox');
	    ?>
	    <div class="wrap">
	    	<?php if (isset($_GET['settings-updated']) && $_GET['settings-updated']) { //in case settings were saved, we show notice?>
        	<div class="notice notice-success is-dismissible">
				<p><strong><?php esc_html_e('Settings saved.', 'simple-metadata'); ?></strong></p>
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
                postboxes.add_postbox_toggles('smd_net_set_page');
            });
            //]]>
		</script>
		<?php
}

/**
 * Function for rendering metabox of locations
 *
 * @since   1.0
 *
 */
function smd_network_render_metabox_schema_locations(){
	?>
	<div id="smd_network_meta_locations" class="smd_network_meta_locations">
		<span class="description">
      <span class="description">
          <?php esc_html_e('Activate the public post types where metadata will be available. General Metadata just uses WordPress core fields.',
            'simple-metadata'); ?>
            <br>
          <?php esc_html_e('If activate, site administrators can not deactivate.',
                        'simple-metadata'); ?>
      </span>
    </span>
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
 * @since   1.0
 *
 */
function smd_network_render_metabox_sites_type(){
	?>
	<div id="smd_network_meta_options" class="smd_network_meta_options">
		<span class="description"><?php esc_html_e('Select the Homepage type. If selected, site administrators can not modify.', 'simple-metadata'); ?></span>
		<form method="post" action="edit.php?action=smd_update_network_site_type">
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
 * @since   1.0
 *
 */
function smd_render_net_switch_set() {
	?>
	<label for="smd_website_blog_type_0"><?php esc_html_e('Local value', 'simple-metadata'); ?> <input type="radio" id="smd_website_blog_type_0" name="smd_net_sites_type" value="0" checked="checked" <?php checked('0', get_site_option('smd_net_sites_type'))?>></label>
	<label for="smd_website_blog_type_1"><?php esc_html_e('Blog', 'simple-metadata'); ?> <input type="radio" id="smd_website_blog_type_1" name="smd_net_sites_type" value="Blog" <?php checked('Blog', get_site_option('smd_net_sites_type'))?>></label>
  <label for="smd_website_blog_type_2"><?php esc_html_e('WebSite', 'simple-metadata'); ?> <input type="radio" id="smd_website_blog_type_2" name="smd_net_sites_type" value="WebSite" <?php checked('WebSite', get_site_option('smd_net_sites_type'))?>></label>
	<?php // if education plugin is active, add new options to select (possibly new values with other addons)
	if (is_plugin_active('simple-metadata-education/simple-metadata-education.php')){
		?>
	<label for="smd_website_blog_type_3"><?php esc_html_e('Book', 'simple-metadata'); ?> <input type="radio" id="smd_website_blog_type_3" name="smd_net_sites_type" value="Book" <?php checked('Book', get_site_option('smd_net_sites_type'))?>></label>
	<label for="smd_website_blog_type_4"><?php esc_html_e('Course', 'simple-metadata'); ?> <input type="radio" id="smd_website_blog_type_4" name="smd_net_sites_type" value="Course" <?php checked('Course', get_site_option('smd_net_sites_type'))?>></label><br>
		<?php
	}

	echo '<br><span class="description">' . __('By default, blogs uses WebSite configuration.', 'simple-metadata') . '</span>';
}

/**
 * Handler for locations settings update
 *
 * @since
 */
function smd_update_network_locations() {

	//checking admin referer to prevent direct access to this function
	check_admin_referer('smd_network_meta_locations-options');

	//Wordpress Database variable for database operations
    global $wpdb;

    //collecting locations accumulative option from POST request
	$locations = isset($_POST['smd_net_locations']) ? $_POST['smd_net_locations'] : array();

	//updating network location option
	update_site_option('smd_net_locations', $locations);

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
 *
 * @since 1.0
 */
function smd_update_network_site_type() {


	//checking admin reffer to prevent direct access to this function
	check_admin_referer('smd_network_meta_sites_type-options');

  $site_type = isset($_POST['smd_net_sites_type']) ? $_POST['smd_net_sites_type'] : '';
  update_site_option('smd_net_sites_type', $site_type);

  smd_net_overwrite_in_all_sites('smd_website_blog_type', $site_type);

  // At the end we redirect back to our options page.
  wp_redirect(add_query_arg(array('page' => 'smd_net_set_page',
  'settings-updated' => 'true'), network_admin_url('settings.php')));

  exit;
}

/**
 * Update options for options metabox
 *
 * @since 1.3
 */
function smd_update_net_hide_dates() {
	//checking admin reffer to prevent direct access to this function
	check_admin_referer('smd_net_section_options-options');

  //Get value selected in the checkboxes
  $is_hide_dates = isset($_POST['smd_net_hide_metadata_dates']) ? $_POST['smd_net_hide_metadata_dates'] : '';
  //updating network options
	update_site_option('smd_net_hide_metadata_dates', $is_hide_dates);

  // smd-general-function.php
  smd_net_overwrite_in_all_sites('smd_hide_metadata_dates', $is_hide_dates );

}
// when save changes is clicked
add_action( 'network_admin_edit_smd_update_network_options', 'smd_update_net_hide_dates', 10);

/**
 * Redirect to set page
 * Used now just for the metabox 'Options'
 *
 * @since 1.3
 */
function smd_redirect_to_set_page(){
  // At the end we redirect back to our options page.
  wp_redirect(add_query_arg(array('page' => 'smd_net_set_page',
  'settings-updated' => 'true'), network_admin_url('settings.php')));
  exit;
}

/**
 * When save changes is clicked
 * The priority 100 so it will be excecuted after all plugins update functions:
 * smd_update_net_hide_dates(), smdan_update_net_hide_annotation ecc...
 */
add_action( 'network_admin_edit_smd_update_network_options', 'smd_redirect_to_set_page', 100);



add_action( 'network_admin_menu', 'smd_add_network_settings');
add_action( 'network_admin_edit_smd_update_network_locations', 'smd_update_network_locations');
add_action( 'network_admin_edit_smd_update_network_site_type', 'smd_update_network_site_type');
