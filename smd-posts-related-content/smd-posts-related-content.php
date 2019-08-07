<?php

/**
 * Metadata for posts and CPTs
 *
 * Description. (use period)
 *
 * @link URL
 *
 * @package simple-metadata
 * @subpackage simple-metadata/smd-posts-related-content
 * @since 1.0
 */

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
		if (isset(get_option('smd_locations')['post']))
		add_meta_box (
		'smd_post_type', //Unique ID
		__('Post Type', 'simple-metadata'), //Title
		'smd_render_article_type_meta', //Callback function
		$location, //location
		'side', //Context
		'high' //priority
		);

	}

}

/**
* Function for rendering post type metabox
*
* @since
*
*/

function smd_render_article_type_meta (){

	//creating nonce
	wp_nonce_field( basename( __FILE__ ), 'smd_render_post_type_meta' );

	//receiving type of post from option in metabox
	$post_type = get_post_meta (get_the_ID(), 'smd_post_type', true) ? esc_attr(get_post_meta (get_the_ID(), 'smd_post_type', true)) : 'no_type';
	$test = get_option('smd_website_blog_type');


switch ($test) {
	case 'Blog':
		$post_suppose_type = __('Article', 'simple-metadata');
		break;
	case 'Course':
		$post_suppose_type = __('Article', 'simple-metadata');
		break;
	case 'Book':
		$post_suppose_type = __('Chapter', 'simple-metadata');
		break;
	case 'WebSite':
		$post_suppose_type = __('Web Page', 'simple-metadata');
		break;

	default:
	  $post_suppose_type = '';
		break;
}

	$post_meta_types = array(
					'Article'					=> __('Article', 'simple-metadata'),
					'AdvertiserContentArticle'	=> __('Advertisement', 'simple-metadata'),
					'BlogPosting'				=> __('Blog Posting', 'simple-metadata'),
					'DiscussionForumPosting'	=> __('Discussion Forum Posting', 'simple-metadata'),
					'LiveBlogPosting'			=> __('Live Blog Posting', 'simple-metadata'),
					'Report'					=> __('Report', 'simple-metadata'),
					'SatiricalArticle' 			=> __('Satirical Article', 'simple-metadata'),
					'SocialMediaPosting'		=> __('Social Media Posting', 'simple-metadata'),
					'TechArticle'				=> __('Technology Article', 'simple-metadata')
				  );

	//if Educational add-on is active, we add new possible options
	if (is_plugin_active('simple-metadata-education/simple-metadata-education.php')){
		$post_meta_types['Chapter'] = __('Chapter', 'simple-metadata');
		$post_meta_types['WebPage'] = __('Web Page', 'simple-metadata');
	}else{
		$post_meta_types['WebPage'] = __('Web Page', 'simple-metadata');
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
			<p><i>
					<?php printf(esc_html__('As %s is chosen as type of web-site, by default type of post is %s', 'simple-metadata'),
										get_option('smd_website_blog_type'), $post_suppose_type);
					?>
			</i></p>
	<?php
}

/**
* Function for post saving/updating action in post page
*
* @since
*
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

	if ( $new_meta_value && '' == $old_meta_value ) {
		add_post_meta( $post_id, 'smd_post_type', $new_meta_value, true );
	} elseif ( $new_meta_value && $new_meta_value != $meta_value) {
		update_post_meta( $post_id, 'smd_post_type', $new_meta_value );
	}
}

/**
* Function for printing meta tags of Article in post pages
*
* @since
*
*/

function smd_print_post_meta_fields () {

	$post_id = get_the_ID();
	$post = get_post($post_id);
	/*
	*	Retrivieng the excerpt of the post, not using get_the_excerpt
	* because if the excerpt is empty it automatically generates it
	*/
	$post_excerpt = isset($post->post_excerpt) ?	$post->post_excerpt : '';


	$post_type = get_post_type($post_id);

	//we print these tags only if location is not active in education and post type is not page
	if (isset(get_option('smd_locations')[$post_type]) && !is_front_page() && !is_home() && 'page' != $post_type) {
		//In case of pressbooks installation, always applied Book -> Chapter
		if (!is_plugin_active('pressbooks/pressbooks.php')){
			$post_meta_type = get_post_meta(get_the_ID(), 'smd_post_type', true) ?: 'no_type';
		} else {
			$post_meta_type = 'Chapter';
		}

		if ('no_type' == $post_meta_type){
			$post_meta_type = get_option('smd_website_blog_type');
			switch ($post_meta_type) {
				case 'Blog':
					$post_meta_type = 'Article';
					break;
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
				  $post_meta_type = '';
					break;
			}
		}



		//> data, related to 'Article' type properties (only applicable for 'post' and post-compitable CPTs)

			//keywords
			$key_words = wp_get_post_tags($post_id, ['fields' => 'names']);
			$key_words_string = implode(', ', $key_words);

		//<

		?>
<?="\n"?><!--SM POSTS METADATA-->
<script type="application/ld+json">
{
	"@context": "http://schema.org/",
	"@type": "<?=$post_meta_type?>",
	<?php
	if(!empty($key_words_string))
		echo '"keywords": "'.$key_words_string.'",' . "\n\t";
	echo '"mainEntityOfPage": "'.get_permalink().'",' . "\n\t";
	if(	!empty($post_excerpt))
		echo '"about":	"'.$post_excerpt.'",'	.	"\n\t";
	echo smd_get_general_tags($post_meta_type);
	//	printing tags from add-on plugins, if they are active
	if (is_plugin_active('simple-metadata-education/simple-metadata-education.php') && isset(get_option('smde_locations')[$post_type])){
		smde_print_tags();
	}
	if (is_plugin_active('simple-metadata-lifecycle/simple-metadata-lifecycle.php') && isset(get_option('smdlc_locations')[$post_type])){
		smdlc_print_tags($post_meta_type);
	}
	if (is_plugin_active('simple-metadata-annotation/simple-metadata-annotation.php') && isset(get_option('smdan_locations')[$post_type])){
		smdan_print_tags($post_meta_type);
	}
	?>

}
</script>
<!--END OF SM POSTS METADATA-->
		<?php
	}
}


if (!is_plugin_active('pressbooks/pressbooks.php')){
	add_action ('add_meta_boxes', 'smd_add_post_type_meta');
}
add_action ('save_post', 'smd_save_post_type', 10, 2);
add_action ('wp_head', 'smd_print_post_meta_fields', 1000);
