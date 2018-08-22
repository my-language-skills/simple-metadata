<?php

/*
Plugin Name: AIOM News Realted Content
Plugin URI: https://github.com/my-language-skills/aiom-extensions
Description: This plugin makes your news posts more understandable for search engines by telling wich kind of news article the given one is and adding automatically generated metadata based on post information.
Version: 0.1
Author: Daniil Zhitnitskii (My Language Skills)
Author URI: https://github.com/my-language-skills
License: GPL 3.0
*/


defined ("ABSPATH") or die ("No script assholes!");

/**
 *	Function for creation of metabox to pick type of news post for proper Schema.org schema type
 */
function aiex_add_news_post_type_meta () {

	add_meta_box (
		'aiex_news_post_type', //Unique ID
		'Type Of News Article', //Title
		'aiex_render_news_post_type_meta', //Callback function
		'post', //for pages
		'side', //Context
		'high' //priority
	);
}

function aiex_render_news_post_type_meta ($object, $box) {
	//creating nonce
	wp_nonce_field( basename( __FILE__ ), 'aiex_render_news_post_type_meta' );

	$news_type = esc_attr(get_post_meta ($object->ID, 'aiex_news_post_type', true));
	$news_types = array(
					'NewsArticle'				=> 'General News Article',
					'AnalysisNewsArticle' 		=> 'Analysis Article',
					'AskPublicNewsArticle' 		=> '"Ask Public" Article',
					'BackgroundNewsArticle' 	=> 'Background Article',
					'ReportageNewsArticle'		=> 'Reportage Article',
					'ReviewNewsArticle'			=> 'Review Article',
				  );
	?>
		<p>News Post Type</p>
			<select style="width: 90%;" name="aiex_news_post_type" id="aiex_news_post_type">
				<?php
					foreach ($news_types as $key => $value) {
						$selected = $news_type == $key ? 'selected' : '';
						echo '<option value="'.$key.'" '.$selected.'>'.$value.'</option>';
					}
				?>
			</select>
	<?php
}

/**
 * Function for post saving/updating action
 */
function aiex_save_news_post_type ($post_id, $post) {

	/* Verify the nonce before proceeding. */
	if ( !isset( $_POST['aiex_render_news_post_type_meta'] ) || !wp_verify_nonce( $_POST['aiex_render_news_post_type_meta'], basename( __FILE__ ) ) ){
		return $post_id;
	}


	//fetching old and new meta values if they exist
	$new_meta_value = isset($_POST['aiex_news_post_type']) ? sanitize_text_field ($_POST['aiex_news_post_type']) : '';
	$old_meta_value = get_post_meta ($post_id, 'aiex_news_post_type', true);

	if ( $new_meta_value && '' == $old_meta_value ) {
		add_post_meta( $post_id, 'aiex_news_post_type', $new_meta_value, true ); 
	} elseif ( $new_meta_value && $new_meta_value != $meta_value ) {
		update_post_meta( $post_id, 'aiex_news_post_type', $new_meta_value );
	} 
}

function aiex_print_news_post_meta_fields () {

	if ('post' == get_post_type(get_the_ID())) {

		$news_type = get_post_meta(get_the_ID(), 'aiex_news_post_type', true) ?: 'empty';

		if ('empty' == $news_type){
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
		$publication_date = get_the_time(get_option( 'date_format' ));;
		?>

		<div itemscope itemtype="http://schema.org/<?=$news_type;?>">
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

add_action ('add_meta_boxes', 'aiex_add_news_post_type_meta');
add_action ('save_post', 'aiex_save_news_post_type', 10, 2);
add_action ('wp_head', 'aiex_print_news_post_meta_fields');