<?php

// Metadata for pages

defined ("ABSPATH") or die ("No script assholes!");

/**
 *	Function for creation of metabox to pick type of page for proper Schema.org schema type
 */
function smd_add_page_type_meta () {
	if (current_user_can('administrator')){
		if (isset(get_option('smd_locations')['page']))
		add_meta_box (
			'smd_page_type', //Unique ID
			'Page Type', //Title
			'smd_render_page_type_meta', //Callback function
			'page', //for pages
			'side', //Context
			'high' //priority
		);
	}
}

function smd_render_page_type_meta ($object, $box) {
	//creating nonce
	wp_nonce_field( basename( __FILE__ ), 'smd_render_page_type_meta' );

	//receiving type of page from opton in metabox
	$page_type = get_post_meta ($object->ID, 'smd_page_type', true) ? esc_attr(get_post_meta ($object->ID, 'smd_page_type', true)) : 'no_page_type';

	switch (get_option('smd_website_blog_type')) {
		case 'Blog':
		case 'Course':
			$page_suppose_type = 'WebPage';
			break;
		case 'Book':
			$page_suppose_type = 'WebPage';
			break;
		case 'WebSite':
			$page_suppose_type = 'WebPage';	
			break;	
		default:
			$page_suppose_type = 'WebPage';
			break;
	}

	if ('no_page_type' == $page_type){
		$page_type = $page_suppose_type;
	}
	$page_types = array(
					'WebPage'		=> 'Web Page',
					'AboutPage' 		=> 'About Page',
					'CheckoutPage' 		=> 'Checkout Page',
					'CollectionPage' 	=> 'Collection Page',
					'ContactPage'		=> 'Contact Page',
					'FAQPage'			=> 'FAQ Page',
					'ImageGallery'		=> 'Image Gallery',
					'ItemPage'			=> 'Item Page',
					'MedicalWebPage'	=> 'Medical Web Page',
					'ProfilePage'		=> 'Profile Page',
					//'QAPage'			=> 'QA Page',
					'SearchResultsPage'	=> 'Search Results Page',
					'VideoGallery'		=> 'Video Gallery'
				  );
	//if (is_plugin_active('simple-metadata-education/simple-metadata-education.php')){
	//	$page_types['Chapter'] = 'Chapter';
	//}
	?>
		<p>Page Type</p>
			<select style="width: 90%;" name="smd_page_type" id="smd_page_type">
				<?php
					foreach ($page_types as $key => $value) {
						$selected = $page_type == $key ? 'selected' : '';
						echo '<option value="'.$key.'" '.$selected.'>'.$value.'</option>';
					}
				?>
			</select>
			<p><i>As '<?=get_option('smd_website_blog_type')?>' is chosen as type of web-site, by default type of page is '<?=$page_suppose_type?>'</i></p>
	<?php
}

/**
 * Function for post saving/updating action
 */
function smd_save_page_type ($post_id, $post) {

	/* Verify the nonce before proceeding. */
	if ( !isset( $_POST['smd_render_page_type_meta'] ) || !wp_verify_nonce( $_POST['smd_render_page_type_meta'], basename( __FILE__ ) ) ){
		return $post_id;
	}


	//if user is not administrator, exit function
	if ( !current_user_can( 'administrator' ) ){
		return $post_id;
	}

	//fetching old and new meta values if they exist
	$new_meta_value = isset($_POST['smd_page_type']) ? sanitize_text_field ($_POST['smd_page_type']) : '';
	$old_meta_value = get_post_meta ($post_id, 'smd_page_type', true);

	if ( $new_meta_value && '' == $old_meta_value && $new_meta_value != 'no_page_type' ) {
		add_post_meta( $post_id, 'smd_page_type', $new_meta_value, true ); 
	} elseif ( $new_meta_value && $new_meta_value != $meta_value && $new_meta_value != 'no_page_type' ) {
		update_post_meta( $post_id, 'smd_page_type', $new_meta_value );
	} elseif ( 'no_page_type' == $new_meta_value && $old_meta_value ) {
		delete_post_meta( $post_id, 'smd_page_type', $old_meta_value );
	}
}

/**
 * Function responsible for output of metadata automatically obtained from page information
 */
function smd_print_page_meta_fields () {

	if ('page' == get_post_type(get_the_ID()) && isset(get_option('smd_locations')['page']) && !is_front_page() && !isset(get_option('smde_locations')['page'])) {

		$page_type = get_post_meta(get_the_ID(), 'smd_page_type', true) ?: 'no_page_type';

		//if nothing was selected before, by default WebPage
		if ('no_page_type' == $page_type){
			switch (get_option('smd_website_blog_type')) {
			case 'Blog':
			case 'Course':
				$page_type = 'WebPage';
				break;
			case 'Book':
				$page_type = 'WebPage';
				break;
			case 'WebSite':
				$page_type = 'WebPage';	
				break;	
			default:
				$page_type = 'WebPage';
				break;
			}
		}
		?>

		<div itemscope itemtype="http://schema.org/<?=$page_type;?>">
			<?php smd_get_general_tags($page_type); ?>
			<?php// if ( 'QAPage' == $page_type ) { echo '<meta itemprop="mainEntity" content="page">';}?>
		</div>

		<?php
	}

}

add_action ('add_meta_boxes', 'smd_add_page_type_meta');
add_action ('save_post', 'smd_save_page_type', 10, 2);
add_action ('wp_head', 'smd_print_page_meta_fields');