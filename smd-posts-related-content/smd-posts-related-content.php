<?php

//Metadata for posts and CPTs


defined ("ABSPATH") or die ("No script assholes!");
require_once( ABSPATH . '/wp-admin/includes/plugin.php' );

/**
 *	Function for creation of metabox to pick type of news post for proper Schema.org schema type
 */
function smd_add_post_type_meta () {

	$locations = get_option('smd_locations') ?: array('post' => 1);

	foreach ($locations as $location => $val) {
		if ('page' == $location || 'site-meta' == $location || 'metadata' == $location){
			continue;
		}
		add_meta_box (
		'smd_post_type', //Unique ID
		'Post Type', //Title
		'smd_render_article_type_meta', //Callback function
		$location, //location
		'side', //Context
		'high' //priority
		);
	}

}

/**
 *	Function for rendering post type metabox
 */
function smd_render_article_type_meta (){

	//creating nonce
	wp_nonce_field( basename( __FILE__ ), 'smd_render_post_type_meta' );

	//receiving type of post from option in metabox
	$post_type = get_post_meta (get_the_ID(), 'smd_post_type', true) ? esc_attr(get_post_meta (get_the_ID(), 'smd_post_type', true)) : 'no_type';

	switch (get_option('smd_website_blog_type')) {
			case 'Blog':
				$post_suppose_type = 'BlogPosting';
				break;
			case 'Course':
				$post_suppose_type = 'Article';
				break;
			case 'Book':
				$post_suppose_type = 'Chapter';
				break;
			case 'WebSite':
				$post_suppose_type = 'WebPage';
				break;		
			default:
				$post_suppose_type = 'Article';
				break;
		}

	if ('no_type' == $post_type){
		$post_type = $post_suppose_type;
	}

	$post_meta_types = array(
					'Article'					=> 'Article',
					'AdvertiserContentArticle'	=> 'Advertisement',
					'BlogPosting'				=> 'Blog Posting',
					'DiscussionForumPosting'	=> 'Discussion Forum Posting',
					'LiveBlogPosting'			=> 'Live Blog Posting',
					'Report'					=> 'Report',
					'SatiricalArticle' 			=> 'Satirical Article',
					'SocialMediaPosting'		=> 'Social Media Posting',
					'TechArticle'				=> 'Technology Article',
				  );

	if (is_plugin_active('simple-metadata-education/simple-metadata-education.php')){
		$post_meta_types['WebPage'] = 'Web Page';
		$post_meta_types['Chapter'] = 'Chapter';

	}
	?>
			<select  name="smd_post_type" id="smd_post_type">
				<?php
					foreach ($post_meta_types as $key => $value) {
						$selected = $post_type == $key ? 'selected' : '';
						
						echo '<option value="'.$key.'" '.$selected.'>'.$value.'</option>';
					}
				?>
			</select>
			<p><i>As '<?=get_option('smd_website_blog_type')?>' is chosen as type of web-site, by default type of post is '<?=$post_suppose_type?>'</i></p>
	<?php
}

/**
 * Function for post saving/updating action
 */
function smd_save_post_type ($post_id, $post) {

	/* Verify the nonce before proceeding. */
	if ( !isset( $_POST['smd_render_post_type_meta'] ) || !wp_verify_nonce( $_POST['smd_render_post_type_meta'], basename( __FILE__ ) ) ){
		return $post_id;
	}


	//if user is not administrator, exit function
	if ( !current_user_can( 'administrator' ) ){
		return $post_id;
	}

	//fetching old and new meta values if they exist
	$new_meta_value = isset($_POST['smd_post_type']) ? sanitize_text_field ($_POST['smd_post_type']) : '';
	$old_meta_value = get_post_meta ($post_id, 'smd_post_type', true);

	if ( $new_meta_value && '' == $old_meta_value) {
		add_post_meta( $post_id, 'smd_post_type', $new_meta_value, true ); 
	} elseif ( $new_meta_value && $new_meta_value != $meta_value) {
		update_post_meta( $post_id, 'smd_post_type', $new_meta_value );
	} 
}


/**
 * Function for printing meta tags of Article in post pages
 */
function smd_print_post_meta_fields () {

	$post_type = get_post_type(get_the_ID());

	if (isset(get_option('smd_locations')[$post_type]) && !is_front_page() && !isset(get_option('smde_locations')[$post_type]) && 'page' != $post_type) {
		//In case of pressbooks installation, always applied Book -> Chapter
		if (!is_plugin_active('pressbooks/pressbooks.php')){
			$post_meta_type = get_post_meta(get_the_ID(), 'smd_post_type', true) ?: 'no_type';
		} else {
			$post_meta_type = 'Chapter';
		}

		if ('no_type' == $post_meta_type){
			switch (get_option('smd_website_blog_type')) {
			case 'Blog':
			case 'Course':
				$post_meta_type = 'Article';
				break;
			case 'Book':
				$post_meta_type = 'Chapter';
				break;
			case 'WebSite':
				$post_meta_type = 'WebPage';
				break;		
			default:
				$post_meta_type = 'Article';
				break;
			}
		}

		//> data, related to 'Article' type properties (only applicable for 'post' and post-compitable CPTs)

			//keywords
			$key_words = wp_get_post_tags($post_id, ['fields' => 'names']);
			$key_words_string = implode(', ', $key_words);

		//<	
		
		?>

		<div itemscope itemtype="http://schema.org/<?=$post_meta_type;?>">
			<?php echo smd_get_general_tags($post_meta_type);?>
			<meta itemprop='keywords' content='$key_words_string'>
		</div>

		<?php
	}

}
		

if (!is_plugin_active('pressbooks/pressbooks.php')){
	add_action ('add_meta_boxes', 'smd_add_post_type_meta');
}
add_action ('save_post', 'smd_save_post_type', 10, 2);
add_action ('wp_head', 'smd_print_post_meta_fields');
