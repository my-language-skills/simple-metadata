<?php

/**
 * Front page metadata
 *
 *
 * @package simple-metadata
 * @subpackage simple-metadata/smd-fronpage-related-content
 * @since 1.0
 */


/**
 * Function for printing metatag in header of front page
 *
 * @since 1.0
 */
function smd_print_wsb_field ($post_meta_type) {


	if (is_front_page()){

		//In case of pressbooks installation, always applied Book -> Chapter
		if (!is_plugin_active('pressbooks/pressbooks.php')){
			$type = get_option('smd_website_blog_type');
		} else {
			$type = 'Book';
		}
		$title = get_bloginfo();
		$description = get_bloginfo( 'description' );
		$url = get_bloginfo( 'url' );
		$language = get_bloginfo( 'language' );
		$translation_of = get_option('smd_translation_of');
		if ($type){
			$metadata = [
				'@context' => 'http://schema.org/',
				'@type'	=> $type,
				'name'=> $title,
				'url'=> $url,
				'inLanguage'=> $language,
				'description'=> $description,
				'translationOfWork'=> [
					'id'	=>	$translation_of
				]
			];

			//printing tags from add-on plugins, if they are active
			if (is_plugin_active('simple-metadata-education/simple-metadata-education.php') && (isset(get_option('smde_locations')['site-meta'])  || isset(get_option('smde_locations')['metadata']))){
				$metadata = array_merge($metadata, smde_print_tags());
			}
			if (is_plugin_active('simple-metadata-lifecycle/simple-metadata-lifecycle.php') && (isset(get_option('smdlc_locations')['site-meta']) || isset(get_option('smdlc_locations')['metadata']))){
				$metadata = array_merge($metadata, smdlc_print_tags(get_option('smd_website_blog_type')));
			}
			if (is_plugin_active('simple-metadata-annotation/simple-metadata-annotation.php') && (isset(get_option('smdan_locations')['site-meta']) || isset(get_option('smdan_locations')['metadata']))){
				$metadata = array_merge($metadata, smdan_print_tags(get_option('smd_website_blog_type')));
			}
			if (is_plugin_active('simple-metadata-relation/simple-metadata-relation.php')){
				$metadata = array_merge($metadata, 	smdre_print_tags());
			}
			if(is_plugin_active('pressbooks/pressbooks.php')){
				$metadata = array_merge(smd_get_pressbooks_metadata(), $metadata);
				// Take the general metadata
				$general_metadata = smd_get_general_tags($post_meta_type);
				// Overwrite the publisher with the our publisher
				$metadata['publisher'] = $general_metadata['publisher'];
			}

			$metadata = smd_array_filter_recursive($metadata);
			printf( "<script type='application/ld+json'>\n%s\n</script>", wp_json_encode( $metadata, JSON_PRETTY_PRINT ) );

		}
	}
}

add_action ('wp_head', 'smd_print_wsb_field', 1000);
