<?php

/*
Plugin Name: AIOM Articles Realted Content
Plugin URI: https://github.com/my-language-skills/aiom-extensions
Description: This plugin makes your articles posts more understandable for search engines by telling wich kind of  article the given one is and adding automatically generated metadata based on post information.
Version: 0.1
Author: Daniil Zhitnitskii (My Language Skills)
Author URI: https://github.com/my-language-skills
License: GPL 3.0
*/


defined ("ABSPATH") or die ("No script assholes!");

/**
 *	Function for creation of metabox to pick type of news post for proper Schema.org schema type
 */
function aiex_add_article_post_type_meta () {

	add_meta_box (
		'site_level_admin_article', //Unique ID
		'Articles', //Title
		'aiex_render_article_sec', //Callback function
		'site_level_admin_display', //for network settigns of AIOM
		'normal', //Context
		'core' //priority
	);

	add_settings_section('article_type_sec', __('Choose type of articles used', 'all-in-one-metadata'), null, 'site_level_admin_display_article');
    register_setting('site_level_admin_display_article', 'aiex_article_post_type');
    add_settings_field('aiex_article_post_type', 'Type', 'aiex_render_article_post_type', 'site_level_admin_display_article', 'article_type_sec');
}

/**
 *	Function for rendering new section in network settings
 */
function aiex_render_article_sec (){
	?>
	    <form method="POST" action="edit.php?action=update_network_options_article_type"><?php
	    settings_fields('site_level_admin_display_article');
	    submit_button();
	    do_settings_sections('site_level_admin_display_article');
	    ?></form>
    <p></p><?php
}

/**
 * Function for rendering Article type field
 */
function aiex_render_article_post_type () {

	$article_type = esc_attr(get_blog_option (1, 'aiex_article_post_type'));
	$article_types = array(
					'no_type'					=> '--Select--',
					'Report'					=> 'Report',
					'SatiricalArticle' 			=> 'Satirical Article',
					'ScholarlyArticle' 			=> 'Scholarly Article',
					'MedicalScholarlyArticle' 	=> 'Medical Scholarly Article',
					'SocialMediaPosting'		=> 'Social Media Posting',
					'BlogPosting'				=> 'Blog Posting',
					'DiscussionForumPosting'	=> 'Discussion Forum Posting',
					'TechArticle'				=> 'Technology Article',
				  );
	?>
			<select  name="aiex_article_post_type" id="aiex_article_post_type">
				<?php
					foreach ($article_types as $key => $value) {
						$selected = $article_type == $key ? 'selected' : '';
						echo '<option value="'.$key.'" '.$selected.'>'.$value.'</option>';
					}
				?>
			</select>
	<?php
}

/**
 * Function for printing meta tags of Artile in post pages
 */
function aiex_print_article_post_meta_fields () {

	if ('post' == get_post_type(get_the_ID())) {

		$article_type = get_blog_option(1, 'aiex_article_post_type');

		if (!$article_type){
			return;
		}

		$post_id = get_the_ID();

		
		$post_content = get_post( $post_id )->post_content;
		$word_count = str_word_count($post_content);
		$categories = get_the_category( $post_id);
		$categories_arr = [];
		foreach ($categories as $category) {
			$categories_arr[] = $category->name;
		}
		$categories_string = implode(', ', $categories_arr);
		$key_words = wp_get_post_tags($post_id, ['fields' => 'names']);
		$key_words_string = implode(', ', $key_words);

		$author_id = get_post_field('post_author', $post_id);
		$author = get_the_author_meta('first_name', $author_id) && get_the_author_meta('last_name', $author_id) ? get_the_author_meta('first_name', $author_id).' '.get_the_author_meta('last_name', $author_id) : get_the_author_meta('display_name', $author_id);
		$creation_date = get_the_date();
		$title = get_the_title();
		$last_modifier = get_the_modified_author();
		$thumbnail_url = get_the_post_thumbnail_url();
		$publication_date = get_the_time(get_option( 'date_format' ));
		?>

		<div itemscope itemtype="http://schema.org/<?=$article_type;?>">
			<meta itemprop="author" content="<?=$author;?>">
			<meta itemprop="dateCreated" content="<?=$creation_date;?>">
			<meta itemprop="headline" content="<?=$title;?>">
			<meta itemprop="editor" content="<?=$last_modifier;?>">
			<meta itemprop="thumbnailUrl" content="<?=$thumbnail_url;?>">
			<meta itemprop="image" content="<?=$thumbnail_url;?>">
			<meta itemprop="datePublished" content="<?=$publication_date?>">
			<meta itemprop="keywords" content="<?=$key_words_string?>">
			<meta itemprop="articleSection" content="<?=$categories_string?>">
			<meta itemprop="wordCount" content="<?=$word_count?>">
		</div>

		<?php
	}

}

/**
 * Handler for updating option of article type
 */
function update_network_options_article_type() {

	//checking if request was done by authorized user
	check_admin_referer('site_level_admin_display_article-options');


	//fetching old and new option values if they exist
	$new_value = isset($_POST['aiex_article_post_type']) ? sanitize_text_field ($_POST['aiex_article_post_type']) : '';
	$old_value = get_blog_option (1, 'aiex_article_post_type');

	if ( $new_value && '' == $old_value && $new_value != 'no_type' ) {
		add_blog_option( 1, 'aiex_article_post_type', $new_value); 
	} elseif ( $new_value && $new_value != $old_value && $new_value != 'no_type' ) {
		update_blog_option( 1, 'aiex_article_post_type', $new_value );
	} elseif ( 'no_type' == $new_value && $old_value ) {
		delete_blog_option( 1, 'aiex_article_post_type');
	}

	wp_redirect(add_query_arg(array('page' => 'site_level_admin_display',
		                                'updated' => 'true'), network_admin_url('settings.php')));

		exit;
}

add_action( 'network_admin_edit_update_network_options_article_type', 'update_network_options_article_type');
add_action ('network_admin_menu', 'aiex_add_article_post_type_meta');
add_action ('wp_head', 'aiex_print_article_post_meta_fields');