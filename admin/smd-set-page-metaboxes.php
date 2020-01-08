<?php

/**
 * Set admin settings settings metaboxes
 *
 *
 * @link URL
 *
 * @package simple-metadata
 * @subpackage simple-metadata/smd-metaboxes
 * @since 1.0
 */


 /**
  * Add option page 'Metadata'
  *
  * Creates 'Metadata' option page and for it:
  * Site settings page, Settings page and cpt site-meta
  *
  * @since 1.0
  *
  */
add_action ('admin_menu', 'smd_add_option_page');

function smd_add_option_page () {

		//Adds main menu page for plugin and all addons
		add_menu_page('Simple Metadata', __('Metadata', 'simple-metadata'), 'manage_options', 'smd_set_page', 'smd_render_options_page', 'dashicons-search');
		//Fix having different name in admin menu for main subpage
		add_submenu_page('smd_set_page',__('Settings', 'simple-metadata'), __('Settings', 'simple-metadata'), 'manage_options', 'smd_set_page');

		//Add Organization submenu
		add_submenu_page('smd_set_page',__('Organization', 'simple-metadata'), __('Organization', 'simple-metadata'), 'manage_options', 'smd_set_page_organization', 'smd_render_organization_page');

		// Front-page metabox
		add_meta_box('smd-settings', __('Front Page', 'simple-metadata'), 'smd_render_frontpage_metabox', 'smd_set_page', 'normal', 'high');

		if (!is_plugin_active('pressbooks/pressbooks.php') || 1 == get_current_blog_id()){
			add_meta_box('smd-location-settings', __('General Metadata', 'simple-metadata'), 'smd_render_locations_metabox', 'smd_set_page', 'normal', 'core');
		}

		if (is_plugin_active('pressbooks/pressbooks.php') && 1 != get_current_blog_id() ){
			smd_add_metadata_config_box(); // metabox 'Metadata config'
		}

		smd_add_options_box(); // metabox 'Options'

		smd_add_organization_box(); //metabox 'Organization'

		$post_types = smd_get_all_post_types();
		$locations = get_option('smd_locations');

		$net_locations = [];

		if (is_multisite()){
			$net_locations = get_site_option('smd_net_locations');
		}

		//adding settings sections for type of site setting and locations
		add_settings_section( 'smd_set_page_section_sitetype', '', '', 'smd_set_page' );
		add_settings_section( 'smd_locations', '', '', 'smd_locations' );
		//registering setting for type of site
		register_setting ('smd_set_setting_sitetype', 'smd_website_blog_type');
		//registering setting for locations
		register_setting('smd_locations', 'smd_locations');

		if (!get_option('smd_website_blog_type') && !is_plugin_active('pressbooks/pressbooks.php')) {
			update_option('smd_website_blog_type', __('Blog', 'simple-metadata') );
		}

		if  ( 1 != get_current_blog_id()){
			add_settings_field ('smd_website_blog_type', __('Type of Site', 'simple-metadata'), 'smd_render_blog_type_switch_set', 'smd_set_page', 'smd_set_page_section_sitetype');
		} elseif( 1 == get_current_blog_id()){
			add_settings_field ('smd_website_blog_type', __('Type of Site', 'simple-metadata'), 'smd_render_blog_type_switch_set_for_site1', 'smd_set_page', 'smd_set_page_section_sitetype');
		}

		//adding location option for every public CPT
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

			add_settings_field ('smd_locations['.$post_type.']', $label, function () use ($post_type, $locations, $net_locations){
				$checked = isset($locations[$post_type]) ? true : false;
				$disabled = isset($net_locations[$post_type]) ? 'disabled' : '';
				?>
					<input type="checkbox" name="smd_locations[<?=$post_type?>]" id="smd_locations[<?=$post_type?>]" value="1" <?php checked(1, $checked);?> <?=$disabled?>>
					<?php if('' !== $disabled): ?>
						<input type="hidden" name="smd_locations[<?=$post_type?>]" value="1">
					<?php endif; ?>
				<?php

			}, 'smd_locations', 'smd_locations');
		}
}

/**
 * Render the options page for plugin
 *
 * @since   1.0
 *
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
				<p><strong> <?php esc_html_e('Settings saved.', 'simple-metadata'); ?></strong></p>
			</div>
			<?php } ?>
			<h1><?php esc_html_e('Simple Metadata Settings', 'simple-metadata'); ?></h1>
            <div class="metabox-holder">
					<?php
					do_meta_boxes('smd_set_page', 'normal','');
					?>
            </div>
        </div>

		<?php
		
		wp_add_inline_script('postbox','jQuery(document).ready( function($) {
			"use strict";
			  $(".if-js-closed").removeClass("if-js-closed").addClass("closed");
			  postboxes.add_postbox_toggles("smd_set_page");
		  });');
}

/**
 * Render the Organization page
 *
 * @since   1.4.4
 *
 */
function smd_render_organization_page () {
		if(!current_user_can('manage_options')){
			return;
		}
		?>
	        <div class="wrap">
	        	<?php if (isset($_GET['settings-updated']) && $_GET['settings-updated']) { //if settings were saved, we show notice?>
	        	<div class="notice notice-success is-dismissible">
					<p><strong><?php esc_html_e('Settings saved.', 'simple-metadata'); ?></strong></p>
				</div>
				<?php } ?>
				<h1><?php esc_html_e('Organization settings', 'simple-metadata'); ?></h1>
	            <div class="metabox-holder">
						<?php
						do_meta_boxes('smd_set_page_organization', 'normal','');
						?>
	            </div>
	        </div>
			<?php
	}

/**
 * Adds the metabox 'Options' in the settings page
 *
 * @since   1.4
 */
function smd_add_options_box(){
	add_meta_box('smd-box-options',	__('Options', 'simple-metadata'), 'smd_render_metabox_options', 'smd_set_page', 'normal', 'low');
	add_settings_section( 'smd_set_page_section_options', '', '', 'smd_set_page_section_options' );
	add_settings_field ('smd_options_hide_dates', __('Hide dates', 'simple-metadata'), 'smd_render_options_hide_dates', 'smd_set_page_section_options', 'smd_set_page_section_options');
	register_setting ('smd_set_page_section_options', 'smd_hide_metadata_dates');
}

/**
 * Adds the metabox 'Metadata config' in the settings page
 *
 * @since   1.4.2
 */
function smd_add_metadata_config_box(){
	add_meta_box('smd_meta_config_metabox',	__('Metadata print configuration', 'simple-metadata'), 'smd_render_meta_config_box', 'smd_set_page', 'normal', 'high');
	add_settings_section( 'smd_set_page_section_meta_config', '', '', 'smd_set_page_section_meta_config' );
	add_settings_field ('smd_disable_meta_frontback', __('Disable WebPage type for', 'simple-metadata'), 'smd_render_disable_meta_frontback', 'smd_set_page_section_meta_config', 'smd_set_page_section_meta_config');

	register_setting ('smd_set_page_section_meta_config', 'smd_disable_frontmatter_type');
	register_setting ('smd_set_page_section_meta_config', 'smd_disable_backmatter_type');
}

/**
 * Adds the metabox 'Organization' metabox in the Organization page
 *
 * @since   1.4.4
 */
function smd_add_organization_box(){
	add_meta_box('smd_organization_box',	__('Organization', 'simple-metadata'), 'smd_render_organization_box', 'smd_set_page_organization', 'normal', 'low');
	add_settings_section( 'smd_set_page_section_organization', '', '', 'smd_set_page_section_organization' );
	add_settings_field ('smd_organization_name', 'Organization name', 'smd_render_organization_name_field', 'smd_set_page_section_organization', 'smd_set_page_section_organization');
	add_settings_field ('smd_organization_logo_image', 'Organization logo', 'smd_render_organization_logo_field', 'smd_set_page_section_organization', 'smd_set_page_section_organization');

	register_setting ('smd_set_page_section_organization', 'smd_organization_logo_image_id');
	register_setting ('smd_set_page_section_organization', 'smd_organization_name');
}

/**
* Render organization metabox
*
* @since 1.4.4
*
*/
function smd_render_organization_box(){
	wp_enqueue_script('common');
	wp_enqueue_script('wp-lists');
	wp_enqueue_script('postbox');
	?>
		<div class="wrap">
			<span class="description"><?php esc_html_e( 'Organization metadata is used for publisher and provider types', 'simple-metadata' )  ?></span>
			<form method="post" action="options.php">
			 <?php
				 settings_fields( 'smd_set_page_section_organization' );
				 do_settings_sections( 'smd_set_page_section_organization' );
				 submit_button();
			  ?>
		 	</form>
			<p></p>
		</div>
	<?php
	wp_add_inline_script('postbox','jQuery(document).ready( function($) {
		"use strict";
		  $(".if-js-closed").removeClass("if-js-closed").addClass("closed");
		  postboxes.add_postbox_toggles("smd_set_page_organization");
	  });');
}

/**
* Render Metadata config metabox
*
* @since 1.4.2
*
*/
function smd_render_meta_config_box(){
	?>
  <div class="wrap">
    <form method="post" action="options.php">
				<?php
				settings_fields( 'smd_set_page_section_meta_config' );
				do_settings_sections( 'smd_set_page_section_meta_config' );
				submit_button();
				?>
		</form>
	</div>
<?php
}

/**
 * Display the content in the metabox 'Option'
 *
 * @since   1.4
 */
function smd_render_metabox_options(){
  ?>
  <div class="wrap">
    <form method="post" action="options.php">
      <?php
			settings_fields( 'smd_set_page_section_options' );
			do_settings_sections( 'smd_set_page_section_options' );
      submit_button();
      ?>
    </form>
    <p></p>
  </div>
  <?php
}

/**
 * Simple Metadata Settings
 *
 * @since 1.0
 *
 */
function smd_render_locations_metabox () {
	?>
	<div class="wrap">
			<span class="description">
				<span class="description">
					 <?php esc_html_e('Activate the post types where metadata will be available.', 'simple-metadata'); ?>
			 	</span>
			</span>
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
 * Simple Metadata Site configuration
 *
 * @since 1.0
 *
 */
function smd_render_frontpage_metabox(){
	?>
	<div class="wrap">
	<span class="description"></span>
      <form method="post" action="options.php">
				<?php
					settings_fields( 'smd_set_setting_sitetype' );
					do_settings_sections( 'smd_set_page' );
					submit_button();
				?>
		   </form>
		   <p></p>
    </div>
    <?php
}

/**
 * Function for rendering radio button fields
 *
 * @since 1.0
 */
function smd_render_blog_type_switch_set() {
	$disabled = smd_is_option_disabled('smd_net_sites_type');

	if (is_multisite()){
		$network_site_type = get_network_option('', 'smd_net_sites_type');
		if ($network_site_type != '0'){
			?><p><?php esc_html_e('Overridden by network site type: ') ?><b><?php echo $network_site_type ?></b></p><?php
		}
	}

	$website_blog_type = get_option('smd_website_blog_type');

	if (!is_plugin_active('pressbooks/pressbooks.php') || 1 == get_current_blog_id()){
		?>
			<label for="smd_website_blog_type_1"><input type="radio" id="smd_website_blog_type_1" name="smd_website_blog_type" value="Blog" <?php checked('Blog', $website_blog_type)?> <?=$disabled?> ><?php esc_html_e('Blog', 'simple-metadata'); ?> </label>
			<br><label for="smd_website_blog_type_2"><input type="radio" id="smd_website_blog_type_2" name="smd_website_blog_type" value="WebSite"  <?php checked('WebSite', $website_blog_type)?> <?=$disabled?> ><?php esc_html_e('WebSite', 'simple-metadata'); ?> </label><br>
		<?php
	}

	// if education plugin is active, add new options to select (possibly new values with other addons)
	if (is_plugin_active('simple-metadata-education/simple-metadata-education.php') || is_plugin_active('pressbooks/pressbooks.php')){

		?>
			<label for="smd_website_blog_type_4"><input type="radio" id="smd_website_blog_type_4" name="smd_website_blog_type" value="Course" <?php checked('Course', $website_blog_type)?> <?=$disabled?> ><?php esc_html_e('Course', 'simple-metadata'); ?> </label>
			<br><label for="smd_website_blog_type_3"> <input type="radio" id="smd_website_blog_type_3" name="smd_website_blog_type" value="Book" <?php checked('Book', $website_blog_type)?> <?=$disabled?> ><?php esc_html_e('Book', 'simple-metadata'); ?></label><br>
		<?php
	}

	if ('disabled' === $disabled){
		echo '<br><span class="description">' .	__('Type was selected by network administrator.', 'simple-metadata') . '</span>';
	} else {
		echo '<br><span class="description">' . __('Select schema type which will be appplied for front-page metadata and its post types.', 'simple-metadata') . '</span>';
	}
}

/**
 * Function for rendering specified Metabox for Site 1 when pressbooks plugin is activated
 *
 * @since 1.5
 */
function smd_render_blog_type_switch_set_for_site1() {
	?>
		<label for="smd_website_blog_type_1"><input type="radio" id="smd_website_blog_type_1" name="smd_website_blog_type" value="Blog" <?php checked('Blog', get_option('smd_website_blog_type'))?>  ><?php esc_html_e('Blog', 'simple-metadata'); ?> </label>
		<br><label for="smd_website_blog_type_2"><input type="radio" id="smd_website_blog_type_2" name="smd_website_blog_type" value="WebSite"  <?php checked('WebSite', get_option('smd_website_blog_type'))?>  ><?php esc_html_e('WebSite', 'simple-metadata'); ?> </label>
	<?php
		// if education plugin is active, add new options to select (possibly new values with other addons)
	if (is_plugin_active('simple-metadata-education/simple-metadata-education.php')){
		?>
			<br><label for="smd_website_blog_type_3"> <input type="radio" id="smd_website_blog_type_3" name="smd_website_blog_type" value="Book" <?php checked('Book', get_option('smd_website_blog_type'))?>  ><?php esc_html_e('Book', 'simple-metadata'); ?></label>
			<br><label for="smd_website_blog_type_4"><input type="radio" id="smd_website_blog_type_4" name="smd_website_blog_type" value="Course" <?php checked('Course', get_option('smd_website_blog_type'))?> ><?php esc_html_e('Course', 'simple-metadata'); ?> </label><br>
		<?php
	}
}

/**
 * Display the option 'Hide dates' in the metabox 'Options' field
 *
 * @since   1.4
 */
function smd_render_options_hide_dates(){
  ?>
  <label for="smd_hide_dates">
    <input type="checkbox" id="smd_hide_metadata_dates" name="smd_hide_metadata_dates" value="true"
      <?php checked('true', get_option('smd_hide_metadata_dates')) ?>
			<?php echo smd_is_option_disabled('smd_net_hide_metadata_dates') ?>
    >
  </label><br>
  <span class="description">
      <?php
      esc_html_e('If selected the metadata tags "dateCreated" and "datePublished" will be hidden.', 'simple-metadata');
      ?>
  </span>
  <?php
}

/**
*  Render Organization name field
*
* @since 1.4.4
*
*/
function smd_render_organization_name_field(){
	if (!empty(get_option('smd_organization_name'))){
			$organization_name = get_option('smd_organization_name');
	} else {
			$organization_name = get_option('blogname');
	}

	?>
		<input id="smd_organization_name" type="textfield" name="smd_organization_name"  value="<?php echo $organization_name ?>"></input>
	<?php
}

/**
*  Render and manage Organization logo field
*
* @since 1.4.4
*
*/
function smd_render_organization_logo_field(){

	$smd_organization_logo_image_id = get_option('smd_organization_logo_image_id');
	?>
		<input id="smd_upload_image_button" type="button" class="button-primary"  value="Set Image" />
		<input id="smd_unset_image_button" type="button" name="UnsetLogoImage"  class="button-secondary" value="Unset Image" <?php echo (empty($smd_organization_logo_image_id)) ?  "disabled" : "" ?> />
		<input id="smd_organization_logo_image_id" style="display:none" name="smd_organization_logo_image_id"  value="<?php echo  $smd_organization_logo_image_id ?>"></input>

		<span>
		  <?php esc_html_e('Follow', 'simple-metadata'); ?>  <a href="https://developers.google.com/search/docs/data-types/article#logo-guidelines" target="_blank">
			<?php esc_html_e('Google recommendations', 'simple-metadata'); ?></a> <?php esc_html_e('for Publisher logo. Required in Article post type.', 'simple-metadata'); ?>
		</span><br><br>

	<?php

		// check if Organization logo was not recently unset
	  if ( is_null(get_post($smd_organization_logo_image_id))){
	      update_option('smd_organization_logo_image_id', '');
	  }

		//If logo is set we print the logo in metabox
		if ( !is_null(get_post($smd_organization_logo_image_id)) && !empty($smd_organization_logo_image_id) ){

				$smd_logo_image =  wp_get_attachment_image(get_option($smd_organization_logo_image_id), 'full');
				echo wp_get_attachment_image($smd_organization_logo_image_id, array('300', '300'));
				$logo_measures = wp_get_attachment_image_src($smd_organization_logo_image_id, 'full');
				echo '<br><b>Width: </b> ' .$logo_measures[1] . '';
				echo '<br><b>Height: </b>' .$logo_measures[2] . '';
			}

			// in case installation is multisite, and is not site1 (that is where we set Organization logo for all the books in multisite) we print site1 logo
		if (is_multisite() && 1 != get_current_blog_id()){
						?>
						<div style="background-color: #efefef; padding: 10px;">
							<span ><b><?php esc_html_e(' Site1 preset preset logo: ', 'simple-metadata') ?></b> </span><br><br>
						<?php
							// get logo from site1
							switch_to_blog( 1 );
									$smd_net_logo_image_id = get_option('smd_organization_logo_image_id');
									if ( !is_null(get_post($smd_net_logo_image_id)) && !empty($smd_net_logo_image_id) ){
											$net_logo_image =  wp_get_attachment_image(get_option($smd_net_logo_image_id), 'full');
											echo wp_get_attachment_image(get_option('smd_organization_logo_image_id'), array('300', '300'));
											$logo_measures = wp_get_attachment_image_src($smd_net_logo_image_id, 'full');
											echo '<br><b>Width: </b> ' .$logo_measures[1] . ' ';
											echo '<br><b>Height: </b>' .$logo_measures[2] . ' ';
											echo '<br><br><span class="description">By default network (site1) logo is set. To override for this book set your custom logo on this page.</span>';
									} else {
										echo 'not set';
									}
							restore_current_blog();

						 ?>
						</div>
						<br>
					<?php }
}


/**
* Render 'Disable WebPage type for' field
*
* @since 1.4.3
*
*/
function smd_render_disable_meta_frontback(){
	?>
		<input type="checkbox" name="smd_disable_frontmatter_type" id="smd_disable_meta_option_frontmatter"  value="1"
			<?php checked('1', get_option('smd_disable_frontmatter_type')) ?>
		/>	<label for="smd_disable_meta_option_frontmatter"><b> <?php esc_html_e('Front-matter', 'simple-metadata') ?> </b> </label>

		<br>
		<input type="checkbox" name="smd_disable_backmatter_type" id="smd_disable_meta_option_backmatter"  value ="1"
			<?php checked('1', get_option('smd_disable_backmatter_type')) ?>
		/>	<label for="smd_disable_meta_option_backmatter"><b><?php esc_html_e('Back-matter', 'simple-metadata') ?></b></label>
		<span class="description">
				<p><?php esc_html_e('By checking the box, WebPage metadata type will NOT be printed.', 'simple-metadata') ?></p>
		</span>
	<?php

}

/**
 * is option disabled
 *
 * @since 1.4
 *
 * @param string $option_net_name  the name of the network option to check if it exist
 * @return string $disabled could be '' or 'disabled';
 */
function smd_is_option_disabled($option_net_name){
	$disabled = '';

	//if network option is set to something except 'Local value', we disable selection
	if (is_multisite()){

		//getting option for type of site for network
		$net_sites_type = get_site_option ($option_net_name) ?: '0';
		if ('0' !== $net_sites_type){
			$disabled = 'disabled';
		}
	}

	return $disabled;
}

/**
* Enqueue js for logo metabox
*
* @since 1.4.1
*
*/
function smd_enqueue_logo_script() {

	wp_enqueue_media(); // load media uploader
	wp_enqueue_script( 'smd-logo-box', plugins_url( 'simple-metadata') . '/inc/assets/js/smd-logo-box.js', array( 'jquery' ));
}
add_action( 'admin_enqueue_scripts', 'smd_enqueue_logo_script');
