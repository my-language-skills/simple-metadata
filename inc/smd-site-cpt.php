<?php 

//Registring 'Site-Meta' post type if not registered and not pressbooks

/**
 * Function to register site-meta type if it doesn't exist ot not Pressbooks installation , wrapper for 'smd_register_cpt' function
 */
function smd_init_cpt(){
	if(!post_type_exists('metadata') && !post_type_exists('site-meta')){
		smd_register_cpt();
	}
}

/**
 * Defining 'site-meta' post type and registering it
 */
function smd_register_cpt(){

	$labels = array(
			'name' => 'Site Metadata', 
			'singular_name' => 'Site Metadata', 
			'add_new' => 'Add New Site Metadata', 
			'add_new_item' => 'Edit Site Meta Information', 
			'edit_item' => 'Edit Site Meta Information', 
			'new_item' => 'New Site Metadata', 
			'view_item' => 'View Site Metadata', 
			'search_items' => 'Search Site Metadata', 
			'not_found' => 'No site metadata found', 
			'not_found_in_trash' => 'No site metadata found in Trash', 
			'parent_item_colon' => '',
			'menu_name' => 'Site Metadata', 
		);
		$args = array(
			'labels' => $labels,
			'public' => true,
			'publicly_queryable' => true,
			'show_ui' => true,
			'show_in_menu' => true,
			'menu_position' => 5,
			'query_var' => true,
			'rewrite' => false,
			'capability_type' => 'post',
			'has_archive' => true,
			'hierarchical' => false,
			//capabilities are added to only give administrators right of site-meta modification
			'capabilities' => array(
    			'edit_post'          => 'update_core',
    			'read_post'          => 'update_core',
    			'delete_post'        => 'update_core',
    			'edit_posts'         => 'update_core',
    			'edit_others_posts'  => 'update_core',
    			'delete_posts'       => 'update_core',
    			'publish_posts'      => 'update_core',
    			'read_private_posts' => 'update_core'
				),
			'supports' => array('')
		);
		register_post_type('site-meta',$args);

}

/**
 * Hiding site-meta post ype from default post editing/review pages of WP and creating custom page under pluggin settings
 */
function smd_reorganize_dash () {
	//Used to remove the default menu for the cpt we created
	remove_menu_page( 'edit.php?post_type=site-meta' );
	remove_meta_box( 'submitdiv', 'site-meta', 'side' );
	//adding custom metabox to save site-meta information
	add_meta_box( 'metadata-save', 'Save Site Metadata Information', 'smd_metadata_save_box', 'site-meta', 'side', 'high' );
	$meta = smd_get_site_meta_post();
	if ( ! empty( $meta ) ) {
		$site_meta_url = 'post.php?post=' . absint( $meta->ID ) . '&action=edit';
	} else {
		$site_meta_url = 'post-new.php?post_type=site-meta';
	}
	//adding Site-Meta page under main plugin page, not for root blog
	if ((1 != get_current_blog_id() && !is_plugin_active('pressbooks/pressbooks.php')) || !is_multisite()){
		add_submenu_page('tools.php','Site-Meta', 'Site-Meta', 'manage_options', $site_meta_url);
	}
}

/**
 * Function for getting site-meta post WP_Post format
 */
function smd_get_site_meta_post() {

	$args = array(
		'post_type' => 'site-meta',
		'posts_per_page' => 1,
		'post_status' => 'publish',
		'orderby' => 'modified',
		'no_found_rows' => true,
		'cache_results' => true,
	);
	$q = new \WP_Query();
	$results = $q->query( $args );
	if ( empty( $results ) ) {
		return false;
	}
	return $results[0];
}

/**
	 * A function that manipulates the inputs for saving the new cpt data
	 * @since    0.1
	 */
function smd_metadata_save_box( $post ) {
	if ( 'publish' === $post->post_status ) { ?>
        <input name="original_publish" type="hidden" id="original_publish" value="Update"/>
        <input name="save" type="submit" class="button button-primary button-large" id="publish" accesskey="p" value="Save"/>
	<?php } else { ?>
        <input name="original_publish" type="hidden" id="original_publish" value="Publish"/>
        <input name="publish" id="publish" type="submit" class="button button-primary button-large" value="Save" tabindex="5" accesskey="p"/>
		<?php
	}
}



/**
 * Changing psot manipulations messages for site-meta post
 */
function smd_change_custom_post_mess($messages){
		$messages['site-meta'] = array(
			0 => '', // Unused. Messages start at index 1.
			1 => 'Site Metadata updated.',
			2 => 'Custom field deleted.',
			3 => 'Custom field deleted.',
			4 => 'Site Metadata updated.',
			/* translators: %s: date and time of the revision */
			5 => isset( $_GET['revision'] ) ? sprintf( 'Site Metadata restored to revision from %s', wp_post_revision_title( (int) $_GET['revision'], false ) ) : false,
			6 => 'Site Metadata updated.',
			7 => 'Site Metadata saved.',
			8 => 'Site Metadata submitted'
		);
		return $messages;
}

/**
 * Enqueue js for admin area
 */
function smd_enqueue_script() {

	wp_enqueue_script( 'smd_admin_script', plugin_dir_url( __FILE__ ) . 'assets/js/simple-metadata-admin.js', array( 'jquery' ));
}


add_action('init', 'smd_init_cpt');
add_action('admin_menu', 'smd_reorganize_dash', 1, 0);
add_action( 'admin_enqueue_scripts', 'smd_enqueue_script');
add_action( 'post_updated_messages', 'smd_change_custom_post_mess');
