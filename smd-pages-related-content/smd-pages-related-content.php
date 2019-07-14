<?php

/**
 * Metadata for pages
 *
 * Description. (use period)
 *
 * @link URL
 *
 * @package simple-metadata
 * @subpackage simple-metadata/smd-pages-related-content
 * @since 1.0
 */

defined ("ABSPATH") or die ("No script assholes!");

/**
 *	Function for creation of metabox to pick type of page for proper Schema.org schema type
 */
function smd_add_page_type_meta () {
	//we only add metabox if current user is administrator
	if (current_user_can('administrator')){
		if (isset(get_option('smd_locations')['page']))
		add_meta_box (
			'smd_page_type', //Unique ID
			__('Page Type', 'simple-metadata'), //Title
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

	//for pages default supposed type is always WebPage
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
					'WebPage'		=> __('Web Page', 'simple-metadata'),
					'AboutPage' 		=> __('About Page', 'simple-metadata'),
					'CheckoutPage' 		=> __('Checkout Page', 'simple-metadata'),
					'CollectionPage' 	=> __('Collection Page', 'simple-metadata'),
					'ContactPage'		=> __('Contact Page', 'simple-metadata'),
					'FAQPage'			=> __('FAQ Page', 'simple-metadata'),
					'ImageGallery'		=> __('Image Gallery', 'simple-metadata'),
					'ItemPage'			=> __('Item Page', 'simple-metadata'),
					'MedicalWebPage'	=> __('Medical Web Page', 'simple-metadata'),
					'ProfilePage'		=> __('Profile Page', 'simple-metadata'),
					//'QAPage'			=> 'QA Page',
					'SearchResultsPage'	=> __('Search Results Page', 'simple-metadata'),
					'VideoGallery'		=> __('Video Gallery', 'simple-metadata'),
				  );
	//if (is_plugin_active('simple-metadata-education/simple-metadata-education.php')){
	//	$page_types['Chapter'] = 'Chapter';
	//}
	?>
		<p><?php esc_html_e('Page Type', 'simple-metadata'); ?></p>
			<select style="width: 90%;" name="smd_page_type" id="smd_page_type">
				<?php
					foreach ($page_types as $key => $value) {
						$selected = $page_type == $key ? 'selected' : '';
						echo '<option value="'.$key.'" '.$selected.'>'.$value.'</option>';
					}
				?>
			</select>
			<p><i><?php printf(esc_html__('As %s is chosen as type of web-site, by default type of page is %s', 'simple-metadata'),
										get_option('smd_website_blog_type'), $page_suppose_type);
						?></i></p>
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

	//we print tags only if location is active and it is not active in Education Plugin
	if ('page' == get_post_type(get_the_ID()) && isset(get_option('smd_locations')['page']) && !is_front_page() && !is_home()) {

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

		//lastReviewed
		$last_reviewed = get_the_modified_date();

		//reviewedBy
		$last_modifier = get_the_modified_author();

		//primaryIamgeOfPage (url)
		$thumbnail_url = get_the_post_thumbnail_url();
		$image = $thumbnail_url;
		?>
<?="\n"?><!--SM PAGES METADATA-->
<div itemscope itemtype="http://schema.org/<?=$page_type;?>">
	<meta itemprop="lastReviewed" content="<?=$last_reviewed?>">
	<meta itemprop="reviewedBy" content="<?=$last_modifier?>">
	<meta itemprop="primaryImageOfPage" content="<?=$image?>">
	<?php echo smd_get_general_tags($page_type); ?>
	<?php //printing tags from add-on plugins, if they are active
	if (is_plugin_active('simple-metadata-education/simple-metadata-education.php') && isset(get_option('smde_locations')['page'])){
		smde_print_tags();
	}
	if (is_plugin_active('simple-metadata-lifecycle/simple-metadata-lifecycle.php') && isset(get_option('smdlc_locations')['page'])){
		smdlc_print_tags(get_option('smd_website_blog_type'));
	}
	if (is_plugin_active('simple-metadata-annotation/simple-metadata-annotation.php') && isset(get_option('smdan_locations')['page'])){
		smdan_print_tags(get_option('smd_website_blog_type'));
	}
	?>
	<?php // if ( 'QAPage' == $page_type ) { echo '<meta itemprop="mainEntity" content="page">';} ?>

<?="\n"?></div>
<!--END OF SM PAGES METADATA-->
	<?php
	}

}

add_action ('add_meta_boxes', 'smd_add_page_type_meta');
add_action ('save_post', 'smd_save_page_type', 10, 2);
add_action ('wp_head', 'smd_print_page_meta_fields', 1000);
