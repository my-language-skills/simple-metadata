<?php

/*
Plugin Name: AIOM Webpage Realted Content
Plugin URI: https://github.com/my-language-skills/aiom-extensions
Description: This plugin makes your pages more understandable for search engines by telling wich kind of page the given one is and adding automatically generated metadata based on page information.
Version: 0.1
Author: Daniil Zhitnitskii (My Language Skills)
Author URI: https://github.com/my-language-skills
License: GPL 3.0
*/

defined ("ABSPATH") or die ("No script assholes!");

/**
 *	Function for creation of metabox to pick type of page for proper Schema.org schema type
 */
function aiex_add_page_type_meta () {
	if (current_user_can('administrator')){
		add_meta_box (
			'aiex_page_type', //Unique ID
			'Page Type', //Title
			'aiex_render_page_type_meta', //Callback function
			'page', //for pages
			'side', //Context
			'high' //priority
		);
	}
}

function aiex_render_page_type_meta ($object, $box) {
	//creating nonce
	wp_nonce_field( basename( __FILE__ ), 'aiex_render_page_type_meta' );

	$page_type = esc_attr(get_post_meta ($object->ID, 'aiex_page_type', true));
	$page_types = array(
					'no_page_type'		=> '--Select--',
					'AboutPage' 		=> 'About Page',
					'CheckoutPage' 		=> 'Checkout Page',
					'CollectionPage' 	=> 'Collection Page',
					'ContactPage'		=> 'Contact Page',
					'FAQPage'			=> 'FAQ Page',
					'ItemPage'			=> 'Item Page',
					'MedicalWebPage'	=> 'Medical Web Page',
					'ProfilePage'		=> 'Profile Page',
					'QAPage'			=> 'QA Page',
					'SearchResultsPage'	=> 'Search Results Page'
				  );
	?>
		<p>Page Type</p>
			<select style="width: 90%;" name="aiex_page_type" id="aiex_page_type">
				<?php
					foreach ($page_types as $key => $value) {
						$selected = $page_type == $key ? 'selected' : '';
						echo '<option value="'.$key.'" '.$selected.'>'.$value.'</option>';
					}
				?>
			</select>
	<?php
}

/**
 * Function for post saving/updating action
 */
function aiex_save_page_type ($post_id, $post) {

	/* Verify the nonce before proceeding. */
	if ( !isset( $_POST['aiex_render_page_type_meta'] ) || !wp_verify_nonce( $_POST['aiex_render_page_type_meta'], basename( __FILE__ ) ) ){
		return $post_id;
	}


	//if user is not administrator, exit function
	if ( !current_user_can( 'administrator' ) ){
		return $post_id;
	}

	//fetching old and new meta values if they exist
	$new_meta_value = isset($_POST['aiex_page_type']) ? sanitize_text_field ($_POST['aiex_page_type']) : '';
	$old_meta_value = get_post_meta ($post_id, 'aiex_page_type', true);

	if ( $new_meta_value && '' == $old_meta_value && $new_meta_value != 'no_page_type' ) {
		add_post_meta( $post_id, 'aiex_page_type', $new_meta_value, true ); 
	} elseif ( $new_meta_value && $new_meta_value != $meta_value && $new_meta_value != 'no_page_type' ) {
		update_post_meta( $post_id, 'aiex_page_type', $new_meta_value );
	} elseif ( 'no_page_type' == $new_meta_value && $old_meta_value ) {
		delete_post_meta( $post_id, 'aiex_page_type', $old_meta_value );
	}
}

/**
 * Function responsible for output of metadata automatically obtained from page information
 */
function aiex_print_page_meta_fields () {

	if ('page' == get_post_type(get_the_ID())) {
		$page_type = get_post_meta(get_the_ID(), 'aiex_page_type', true) ?: 'no_page_type';
		if ('no_page_type' == $page_type){
			return;
		}
		$author_id = get_post_field('post_author', get_the_ID());
		$author = get_the_author_meta('first_name', $author_id) && get_the_author_meta('last_name', $author_id) ? get_the_author_meta('first_name', $author_id).' '.get_the_author_meta('last_name', $author_id) : get_the_author_meta('display_name', $author_id);
		$creation_date = get_the_date();
		$title = get_the_title();
		$last_modification_date = get_the_modified_date();
		$last_modifier = get_the_modified_author();
		$thumbnail_url = get_the_post_thumbnail_url();
		$publication_date = get_the_time(get_option( 'date_format' ));;
		?>

		<div itemscope itemtype="http://schema.org/<?=$page_type;?>">
			<meta itemprop="author" content="<?=$author;?>">
			<meta itemprop="dateCreated" content="<?=$creation_date;?>">
			<meta itemprop="headline" content="<?=$title;?>">
			<meta itemprop="lastReviewed" content="<?=$last_modification_date;?>">
			<meta itemprop="editor" content="<?=$last_modifier;?>">
			<meta itemprop="thumbnailUrl" content="<?=$thumbnail_url;?>">
			<meta itemprop="datePublished" content="<?=$publication_date?>">
		</div>

		<?php
	}

}

add_action ('add_meta_boxes', 'aiex_add_page_type_meta');
add_action ('save_post', 'aiex_save_page_type', 10, 2);
add_action ('wp_head', 'aiex_print_page_meta_fields');