<?php

/**
 * Summary (no period for file headers)
 *
 * file containing functions, used over all the post types and all the addons
 * identical functions (except class methods) should be added to this file
 *
 * @link URL
 *
 * @package simple-metadata
 * @subpackage XXXXXXX/XXXXXXX
 * @since x.x.x (when the file was introduced)
 */
 
/**
* Function for getting properties' metatags, collected from WP Core data
*
* @since
*
*/

function smd_get_general_tags($post_meta_type) {

	$post_id = get_the_ID();

	//> Data, related to 'Article' type properties

	//articleBody
	$post_content = get_post( $post_id )->post_content;

	//wordcount
	$word_count = str_word_count($post_content);

	///> articleSection
	$categories = get_the_category( $post_id);
	$categories_arr = [];
	foreach ($categories as $category) {
		$categories_arr[] = $category->name;
	}
	$categories_string = implode(', ', $categories_arr);
	///<

	//<

	//> Data, related to 'CreativeWork' properties

	///> author
	$author_id = get_post_field('post_author', $post_id);
	$author = get_the_author_meta('first_name', $author_id) && get_the_author_meta('last_name', $author_id) ? get_the_author_meta('first_name', $author_id).' '.get_the_author_meta('last_name', $author_id) : get_the_author_meta('display_name', $author_id);
	///<

	//dateCreated
	$creation_date = get_the_date();

	//dateModified
	$last_modification_date = get_the_modified_date();

	//datePublished
	$publication_date = get_the_time(get_option( 'date_format' ));

	//editor
	$last_modifier = get_the_modified_author();

	//inLanguage
	$language = get_bloginfo( 'language' );

	//headline
	$title = get_the_title();


	///> publisher

	//logo
	$custom_logo_id = get_theme_mod( 'custom_logo' );
	$logo = isset(wp_get_attachment_image_src( $custom_logo_id , 'full' )[0]) ? wp_get_attachment_image_src( $custom_logo_id , 'full' )[0] : (get_avatar_url($author_id) ?: '');

	//publisher (name), by default name of the website
	$publisher = get_bloginfo();
	///<

	//type of publisher
	//TODO when Google will support Person type for publisher, check type in SEO plugins
	$type = 'Organization';

	//thumbnailUrl
	$thumbnail_url = get_the_post_thumbnail_url();

	///> checking main SEO plugin for publisher information
	//include to check if YOAST or SEO Framework are installed
	include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

	//if YOAST plugin is active, get company or person name to set for publisher property
	if (is_plugin_active('wordpress-seo/wp-seo.php')){

		$all_vals = get_option('wpseo_titles');

		if (!empty($all_vals)){

			$publisher = 'company' == $all_vals['company_or_person'] ? $all_vals['company_name'] : ('person' == $all_vals['company_or_person'] ? $all_vals['person_name'] : get_bloginfo()) ;

			if ($all_vals['company_logo'] && 'company' == $all_vals['company_or_person']){
				$logo = $all_vals['company_logo'];
			}
		}
	}

	//if SEO Framework plugin is active, get company or person name to set for publisher property
	if (is_plugin_active('autodescription/autodescription.php')){

		$all_vals = get_option('autodescription-site-settings');

		if (!empty($all_vals)){

			$publisher = $all_vals['knowledge_name'] ?: get_bloginfo();

			if ($all_vals['knowledge_logo_url'] && 'organization' == $all_vals['knowledge_type']){
				$logo = $all_vals['knowledge_logo_url'];
			}
		}
	}
	///<

	//<

	//> Data, related to 'Thing' type properties
	$image = $thumbnail_url ?: $logo;
	//<

	//constructing metafields
	$html = "<meta itemprop='author' content='$author'>\n".
			"<meta itemprop='author' content='$last_modifier'>\n".
			"<meta itemprop='dateCreated' content='$creation_date'>\n".
			"<meta itemprop='dateModified' content='$last_modification_date'>\n".
			"<meta itemprop='datePublished' content='$publication_date'>\n".
			"<meta itemprop='inLanguage' content = '$language'>\n".
			"<meta itemprop='headline' content='$title'>\n".
			"<div itemprop='publisher' itemscope itemtype='http://schema.org/$type'>\n".
				"\t<meta itemprop='name' content='$publisher'>\n".
				"\t<meta itemprop='logo' content='$logo'>\n".
			"</div>\n".
			"<meta itemprop='thumbnailUrl' content='$thumbnail_url'>\n".
			"<meta itemprop='image' content='$image'>\n";

	//array of types, which support 'Article' type fields
	$supported_types = ['Article', 'AdvertiserContentArticle', 'BlogPosting', 'DiscussionForumPosting', 'LiveBlogPosting',	'Report', 'SatiricalArticle' , 'SocialMediaPosting', 'TechArticle'];

	//adding 'Article' properties to supported types
	if(in_array($post_meta_type, $supported_types)){
		$html .= "<meta itemprop='articleBody' content='$post_content'>\n".
				 "<meta itemprop='articleSection' content='$categories_string'>\n".
				 "<meta itemprop='wordCount' content='$word_count'>\n";
	}

	return $html;
}


/**
* Function for getting all post types of installation
*
* @since
*
*/

 function smd_get_all_post_types(){
 	require_once( ABSPATH . '/wp-admin/includes/plugin.php' );
 	//Gathering the post types that are public including the wordpress ones if pressbooks is disabled
 	if(!is_plugin_active('pressbooks/pressbooks.php')){

 		$postTypes = array_keys( get_post_types( array( 'public' => true )) );
 		$postTypes1 =array_reverse($postTypes);

 		//we unset attachment sa it needs different markup (for future)
 		if (($key = array_search('attachment', $postTypes1)) !== false){
 			unset($postTypes1[$key]);
 		}
 	}else{
 		$postTypes1 = ['metadata','front-matter','chapter','part', 'back-matter'];
 	}
 	return $postTypes1;
 }
