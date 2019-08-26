<?php

/**
 * Front page metadata
 *
 * Description. (use period)
 *
 * @link URL
 *
 * @package simple-metadata
 * @subpackage simple-metadata/smd-fronpage-related-content
 * @since 1.0
 */



/**
 * Function for printing metatag in header of front page
 *
 * @since ...
 */
function smd_print_wsb_field () {

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
		if ($type){
		?>
<?="\n"?><!-- SM FRONTPAGE META -->
<script type="application/ld+json">
{
	"@context": "http://schema.org/",
	"@type": "<?=$type?>",
	"name": "<?=$title?>",
	"url": "<?=$url?>",
	"inLanguage": "<?=$language?>",
	"description": "<?=$description?>"<?php
	//printing tags from add-on plugins, if they are active
	if (is_plugin_active('simple-metadata-education/simple-metadata-education.php') && (isset(get_option('smde_locations')['site-meta'])  || isset(get_option('smde_locations')['metadata']))){
		smde_print_tags();
	}
	if (is_plugin_active('simple-metadata-lifecycle/simple-metadata-lifecycle.php') && (isset(get_option('smdlc_locations')['site-meta']) || isset(get_option('smdlc_locations')['metadata']))){
		smdlc_print_tags($type);
	}
	if (is_plugin_active('simple-metadata-annotation/simple-metadata-annotation.php') && (isset(get_option('smdan_locations')['site-meta']) || isset(get_option('smdan_locations')['metadata']))){
		smdan_print_tags($type);
	}
	if (is_plugin_active('simple-metadata-relation/simple-metadata-relation.php')){
		smdre_print_tags();
	}
	if(is_plugin_active('pressbooks/pressbooks.php')){
		echo smd_get_pressbooks_metadata();
	}
	?>
}
</script>
<!-- END OF SM FRONTPAGE META -->
	<?php

		}
	}
}

add_action ('wp_head', 'smd_print_wsb_field', 1000);
