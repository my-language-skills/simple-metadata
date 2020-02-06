<?php

/**
 * General functions
 *
 * file containing functions, used over all the post types and all the addons
 * identical functions (except class methods) should be added to this file
 *
 *
 * @package simple-metadata
 * @subpackage simple-metadata/general-functions
 * @since 1.0 (when the file was introduced)
 */

 // Used for Pressbook integration
 use Pressbooks\Book;
 use Pressbooks\Metadata;
 use function Pressbooks\Metadata\get_section_information;
 use function Pressbooks\Metadata\section_information_to_schema;

/**
* Function for getting properties' metatags, collected from WP Core data
*
* @since 1.0
*
*/


function smd_get_general_tags($post_meta_type) {

  $post_id = get_the_ID();

  /*---- Data, related to 'Article' type properties ----*/
  //get the content and filter from html
  $post_content_2 = get_post( $post_id );
  $post_content = strip_tags(apply_filters('the_content', $post_content_2->post_content));
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

  /*----- Data, related to 'CreativeWork' properties -----*/
  /*--- Author ---*/
  $author_id = get_post_field('post_author', $post_id);
  $author = get_the_author_meta('first_name', $author_id) && get_the_author_meta('last_name', $author_id) ? get_the_author_meta('first_name', $author_id).' '.get_the_author_meta('last_name', $author_id) : get_the_author_meta('display_name', $author_id);
  /*--- end Author ---*/

  //dateCreated
  $creation_date = get_the_date('Y-m-d');
  //dateModified
  $last_modification_date = get_the_modified_date('Y-m-d');
  //datePublished
  $publication_date = get_the_time('Y-m-d');
  //editor
  $last_modifier = get_the_modified_author();
  //inLanguage
  $language = get_bloginfo( 'language' );
  //headline
  $title = get_the_title();

  /*--- Publisher ---*/
  //logo
  $custom_logo_id = get_theme_mod( 'custom_logo' );
  $logo_url= isset(wp_get_attachment_image_src( $custom_logo_id , 'full' )[0]) ? wp_get_attachment_image_src( $custom_logo_id , 'full' )[0] : (get_avatar_url($author_id) ?: '');
  $logo_measures = wp_get_attachment_image_src( $custom_logo_id , 'full'); //retrieve and array (url, width, height)
  //publisher (name), by default name of the website
  $publisher = get_bloginfo();
  //type of publisher
  //TODO when Google will support Person type for publisher, check type in SEO plugins
  $type = 'Organization';
  /*--- end Publisher ---*/


  // get the thumbnail of the post/page/homepage/ecc...
  // If the post thumbnail is set by featured_image_for_pressbooks plugin we use this image for metadata of the post thumbnail (fifp functions are located in featured_image_for_pressbooks plugin)
  if (is_plugin_active('featured-image-for-pressbooks/featured-image-for-pressbooks.php') && fifp_has_ext_thumbnail() && "print_local_fi" != $fi_info = fifp_get_fi_info()){

    if (!empty($fi_info)){
      switch_to_blog(get_option( '_ext_source_id'));
        $thumbnail_url = wp_get_attachment_url($fi_info );
      restore_current_blog();
    }
  } else {  // if featured_image_for_pressbooks is not active - default
    $thumbnail_url = get_the_post_thumbnail_url($post_id, 'thumbnail');
  }


  /*--- Checking main SEO plugin for publisher information ---*/
  //include to check if YOAST or SEO Framework are installed
  include_once( ABSPATH . 'wp-admin/includes/plugin.php' );

  //if YOAST plugin is active, get company or person name to set for publisher property
  if (is_plugin_active('wordpress-seo/wp-seo.php')){

    $all_vals = get_option('wpseo_titles');

    if (!empty($all_vals)){

      $publisher = 'company' == $all_vals['company_or_person'] ? $all_vals['company_name'] : ('person' == $all_vals['company_or_person'] ? $all_vals['person_name'] : get_bloginfo()) ;

      if ($all_vals['company_logo'] && 'company' == $all_vals['company_or_person']){
        $logo_url= $all_vals['company_logo'];
        $logo_measures = wp_get_attachment_image_src( $all_vals['company_logo_id'], 'full'); //retrieve and array (url, width, height)
      }
    }
  }

  //if SEO Framework plugin is active, get company or person name to set for publisher property
  if (is_plugin_active('autodescription/autodescription.php')){

    $all_vals = get_option('autodescription-site-settings');

    if (!empty($all_vals)){

      $publisher = $all_vals['knowledge_name'] ?: get_bloginfo();

      if ($all_vals['knowledge_logo_url'] && 'organization' == $all_vals['knowledge_type']){
        $logo_url= $all_vals['knowledge_logo_url'];
        $logo_measures = wp_get_attachment_image_src( $all_vals['knowledge_logo_id'], 'full'); //retrieve and array (url, width, height)
      }
    }
  }
 /*--- end check plugin SEO ---*/

 /*--- Checking if the logo is set in metabox 'Logo' (settings page) ---*/
 $logo_id = get_option('smd_logo_image_id');
 if($logo_id){
   $logo_url= wp_get_attachment_image_url( $logo_id, 'full');
   $logo_measures = wp_get_attachment_image_src( $logo_id, 'full'); //retrieve and array (url, width, height)
 }

  /* --- Checking if Organization logo is set ---*/
  $smd_organization_logo_image_id = get_option('smd_organization_logo_image_id');
  $logo_url_organization = 0;
  $logo_measures_organization = 0;

  if (!empty($smd_organization_logo_image_id)){                        // USE LOCAL ORGANIZATION LOGO
        $logo_url_organization = wp_get_attachment_image_url( $smd_organization_logo_image_id, 'full');
        $logo_measures_organization = wp_get_attachment_image_src($smd_organization_logo_image_id, 'full');

  } elseif(empty($smd_organization_logo_image_id) && is_multisite()) { // IF NOT SET LOCAL USE LOGO FROM SITE 1

      switch_to_blog( 1 );
         $smd_net_logo_image_id = get_option('smd_organization_logo_image_id');
          if (!empty($smd_net_logo_image_id)){
            $smd_net_logo_image_id = get_option('smd_organization_logo_image_id');
            $logo_url_organization = wp_get_attachment_image_url( $smd_net_logo_image_id, 'full');
            $logo_measures_organization = wp_get_attachment_image_src($smd_net_logo_image_id, 'full');
          }
       restore_current_blog();
   }

  /*----- end Data, related to 'CreativeWork' properties */


 // Start adding metadata
 $metadata = [];

  if(get_option('smd_hide_metadata_dates')){
    //Hide date options is activated in network menu or site munu
    $metadata['dateModified'] = $last_modification_date;
  }else{
    $metadata['dateCreated'] = $creation_date;
    $metadata['dateModified'] = $last_modification_date;
    $metadata['datePublished'] = $publication_date;
  }
  $metadata['inLanguage'] = $language;
  $metadata['headline'] = $title;

  if(!empty($thumbnail_url)){
    $metadata['thumbnailUrl'] = $thumbnail_url;
  }

  if('G' == get_option('avatar_rating')){
    // The content is family friendly
    // It's selected in settings->discussion "G — Suitable for all audiences"
    $metadata['isFamilyFriendly'] = 'true';
  }

  //array of types, which support 'Article' type fields
 $supported_types = ['Article', 'AdvertiserContentArticle', 'BlogPosting', 'DiscussionForumPosting', 'LiveBlogPosting',	'Report', 'SatiricalArticle' , 'SocialMediaPosting', 'TechArticle'];

 //adding 'Article' properties to supported types
 if(in_array($post_meta_type, $supported_types)){
    $metadata['articleBody'] = $post_content;
    $metadata['articleSection'] = $categories_string;
    $metadata['wordCount'] = $word_count;
 }

  // --- Image tag ---
  if( get_post_meta($post_id, 'smd_googleImage_id', true) ){
    $img_id = get_post_meta($post_id, 'smd_googleImage_id', true);
  }
  else if( has_post_thumbnail() ){
    // feature image id
    $img_id = get_post_thumbnail_id();
  }

  if(isset($img_id) && !empty($img_id)){
    //Get all attributes
    $img_thumbnail_title = get_post($img_id)->post_title;
    $img_caption = get_post($img_id)->post_excerpt;
    $img_description = get_post($img_id)->post_content;
    $img_author = get_the_author_meta('display_name', get_post($img_id)->post_author);
    $img_date = get_post_time('F j, Y g:i a', true, $img_id);
    $img_url_width_height = wp_get_attachment_image_src( $img_id, 'full'); //retrieve and array (url, width, height)
    $img_type = get_post_mime_type($img_id);
    $img_size = size_format(filesize(get_attached_file($img_id)));

    $img_metadata = [
      'image' => [
        '@type'=> 'ImageObject',
        'name' => $img_thumbnail_title,
        'caption'=> $img_caption,
        'description'=> $img_description,
        'url'=> $img_url_width_height[0],
        'uploadDate'=> $img_date,
        'encodingFormat'=> $img_type,
        'width'=> (string) $img_url_width_height[1],
        'height'=> (string) $img_url_width_height[2],
        'contentSize'=> $img_size,
        'author'=> [
          '@type'=> 'Person',
          'name'=> $img_author
        ]
      ]
    ];
    $metadata = array_merge($metadata, $img_metadata);
  }else{
    $metadata['image'] = $logo_url;
  }

  if ( 'disabled' === smd_is_option_disabled('smd_net_sites_type') && 1 != get_current_blog_id()){   // if local value is disabled by network we get network post_meta_type
        $site_type_to_set = get_network_option('', 'smd_net_sites_type');
    } elseif (get_option('smd_website_blog_type')) {
        $site_type_to_set = get_option('smd_website_blog_type');
    } else { // site type not set anywhere
      $site_type_to_set = '';
    }

    if($smd_organization_name = get_option('smd_organization_name')){
      $organization_name = $smd_organization_name;
    } else {
      $organization_name = $publisher;
    }

    // --- Provider tag ---
    $provider_metadata = [
      'provider' => [
        '@type'=>  $type,
        'name'=> $organization_name,
        'logo'=> [
          '@type'=>  'ImageObject',
          'url'=>  $logo_url_organization ?: $logo_url,
          'width'=>  (string) $logo_measures_organization[1] ?: (string) $logo_measures[1],
          'height'=> (string) $logo_measures_organization[2] ?: (string) $logo_measures[2]
        ]
      ]
    ];
    $metadata = array_merge($metadata, $provider_metadata);


      // --- Pubblisher tag ---
      $publisher_metadata = [
        'publisher' => [
          '@type'=>  $type,
          'name'=> $organization_name,
          'logo'=> [
            '@type'=>  'ImageObject',
            'url'=>  $logo_url_organization ?: $logo_url,
            'width'=>  (string) $logo_measures_organization[1] ?: (string) $logo_measures[1],
            'height'=> (string) $logo_measures_organization[2] ?: (string) $logo_measures[2]
          ]
        ]
      ];
      $metadata = array_merge($metadata, $publisher_metadata);


  // if the pressbook isn't active we use our author metatag
  if(!is_plugin_active('pressbooks/pressbooks.php') || 'page' == $post_meta_type){
    $author_metadata = [
      'author' => [
        '@type' => 'Person',
        'name' =>  $author
      ]
    ];
    $metadata = array_merge($metadata, $author_metadata);
  }

 return $metadata;
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
  if(is_plugin_active('pressbooks/pressbooks.php') || (is_plugin_active('pressbooks/pressbooks.php') &&  1 != get_current_blog_id()) ){
    $postTypes1 = ['metadata','front-matter','chapter','part', 'back-matter'];

 	}else{
    $postTypes = array_keys( get_post_types( array( 'public' => true )) );
    $postTypes1 =array_reverse($postTypes);

    //we unset attachment sa it needs different markup (for future)
    if (($key = array_search('attachment', $postTypes1)) !== false){
      unset($postTypes1[$key]);
    }
 	}
 	return $postTypes1;
 }

 /**
 * Check if the post type is a subtype of Creative Work
 *
 * Used in smd_annotation and smd_lifecycle to make them work only if the post is creative work
 *
 * @since 1.4
 * @param int $post_id the Id of the post to check
 * @return boolean
 */
 function smd_is_post_CreativeWork($post_id){

 	if('page' == get_post_type($post_id) && !is_front_page()){
 		$post_meta_type = get_post_meta($post_id, 'smd_page_type', true) ?: 'no_type';
 		$creative_works_arr = ['WebPage' , 'AboutPage'  , 'CheckoutPage'  ,
 		'CollectionPage', 'ContactPage' , 'FAQPage'	 , 'ImageGallery' ,
 		'ItemPage', 'MedicalWebPage' , 'ProfilePage' ,'SearchResultsPage', 'VideoGallery' ];
 	}
 	else if('site-meta' ==  get_post_type($post_id) || is_front_page()){
		$post_meta_type = get_option('smd_website_blog_type') ?: 'no_type';
 		$creative_works_arr = ['WebSite', 'Blog', 'Course', 'Book' ];
 	}
  else{
    // all others types of post
 		$post_meta_type = get_post_meta($post_id, 'smd_post_type', true) ?: 'no_type';
 		$creative_works_arr = ['Article', 'AdvertiserContentArticle', 'BlogPosting',
 		'DiscussionForumPosting', 'LiveBlogPosting', 'Report', 'SatiricalArticle', 'SocialMediaPosting',
 		'TechArticle', 'Chapter', 'WebPage' ];
  }

 	return in_array($post_meta_type, $creative_works_arr);
 }

 /**
  * Overwrite with it the local option in all sites
  *
  * @since 1.4
  *
  * @param string $option_local_name The name of site option that you want to overwrite
  * @param string $option_value The value of the option to overwrite
  */
 function smd_net_overwrite_in_all_sites( $option_local_name, $option_value ){

   //Wordpress Database variable for database operations
   global $wpdb;

 	//Grabbing all the site IDs
   $siteids = $wpdb->get_col("SELECT blog_id FROM $wpdb->blogs");

   //Going through the sites
   foreach ($siteids as $site_id) {
   	if (1 == $site_id){
   		continue;
   	}

   	switch_to_blog($site_id);

   	//updating local options obly if some option is selected
   	if ('0' !== $option_value){
   		update_option($option_local_name, $option_value);
   	}
     restore_current_blog();
   }
 }

 /**
  * Update with it the local option in all sites
  *
  * @since 1.4
  *
  * @param string $option_local_name The name of site option that you want to overwrite
  * @param string $option_value The value of the option to overwrite
  */
 function smd_net_update_in_all_sites( $option_local_name, $option_value ){

   //Wordpress Database variable for database operations
   global $wpdb;

 	//Grabbing all the site IDs
   $siteids = $wpdb->get_col("SELECT blog_id FROM $wpdb->blogs");

   //Going through the sites
   foreach ($siteids as $site_id) {
   	if (1 == $site_id){
   		continue;
   	}

   	switch_to_blog($site_id);

   	//updating local options obly if some option is selected
   	if ('0' !== $option_value && false == get_option($option_local_name)){
   		update_option($option_local_name, $option_value);
   	}
     restore_current_blog();
   }
 }

 /**
  * Get from pressbook the metadata
  *
  * @since 1.4
  * @return string the associative array
  */
 function smd_get_pressbooks_metadata(){

  // Code from pressbook function add_json_ld_metadata
  $context = is_singular( [ 'front-matter', 'part', 'chapter', 'back-matter' ] ) ? 'section' : 'book';
  if ( $context === 'section' ) {
  	global $post;
  	$section_information = get_section_information( $post->ID );
  	$book_information = Book::getBookInformation();
  	$metadata = section_information_to_schema( $section_information, $book_information );
  } else {
  	$metadataObj = new Metadata();
    $metadata = $metadataObj->jsonSerialize(); // get the array serializable
    //Delete the tag that we already use
    unset($metadata['name']);
  }

  //Delete tags from pressbook
  unset($metadata['reviewedBy']);
  if(get_option('smdre_is_translated_from') && is_plugin_active('simple-metadata-relation/simple-metadata-relation.php')){
    // Unset isBasedOn because there is already translationOfWork
    unset($metadata['isBasedOn']);
  }

  return $metadata;
 }

 /**
  * Delete empty values from an array and multidimensional array
  *
  * @since 1.4
  * @return string the html to print
  */
 function smd_array_filter_recursive($input)
 {
     foreach ($input as &$value)
     {
         if (is_array($value))
         {
             $value = smd_array_filter_recursive($value);
         }
     }

  return array_filter($input);
 }

 /**
  *
  * @since 1.4
  * @return $languages
  */
 function smd_supported_languages() {

 	$languages = [
    '' 				    => __('--Select--', 'simple-metadata'),
    'ab'     			=> __('Abkhazian', 'simple-metadata'),
    'aa'     			=> __('Afar', 'simple-metadata'),
    'af'     			=> __('Afrikaans', 'simple-metadata'),
    'ak'     			=> __('Akan', 'simple-metadata'),
    'sq'     			=> __('Albanian', 'simple-metadata'),
    'am'     			=> __('Amharic', 'simple-metadata'),
    'ar'     			=> __('Arabic', 'simple-metadata'),
    'an'     			=> __('Aragonese', 'simple-metadata'),
    'hy'     			=> __('Armenian', 'simple-metadata'),
    'as'     			=> __('Assamese', 'simple-metadata'),
    'av'     			=> __('Avaric', 'simple-metadata'),
    'ae'     			=> __('Avestan', 'simple-metadata'),
    'ay'     			=> __('Aymara', 'simple-metadata'),
    'az'     			=> __('Azerbaijani', 'simple-metadata'),
    'bm'     			=> __('Bambara', 'simple-metadata'),
    'ba'     			=> __('Bashkir', 'simple-metadata'),
    'eu'     			=> __('Basque', 'simple-metadata'),
    'bn'     			=> __('Bengali', 'simple-metadata'),
    'be'     			=> __('Belarusian', 'simple-metadata'),
    'bh'     			=> __('Bihari languages', 'simple-metadata'),
    'bi'     			=> __('Bislama', 'simple-metadata'),
    'nb'     			=> __('Bokmål, Norwegian; Norwegian Bokmål', 'simple-metadata'),
    'bs'     			=> __('Bosnian', 'simple-metadata'),
    'br'					=> __('Breton', 'simple-metadata'),
    'bg'     			=> __('Bulgarian', 'simple-metadata'),
    'my'     			=> __('Burmese', 'simple-metadata'),
    'km'     			=> __('Central Khmer', 'simple-metadata'),
    'ch'     			=> __('Chamorro', 'simple-metadata'),
    'ce'     			=> __('Chechen', 'simple-metadata'),
    'ny'     			=> __('Chichewa; Chewa; Nyanja', 'simple-metadata'),
    'zh'     			=> __('Chinese', 'simple-metadata'),
    'cv'     			=> __('Chuvash', 'simple-metadata'),
    'kw'     			=> __('Cornish', 'simple-metadata'),
    'co'     			=> __('Corsican', 'simple-metadata'),
    'cr'     			=> __('Cree', 'simple-metadata'),
    'hr'     			=> __('Croatian', 'simple-metadata'),
    'cs'     			=> __('Czech', 'simple-metadata'),
    'da'     			=> __('Danish', 'simple-metadata'),
    'dz'     			=> __('Dzongkha', 'simple-metadata'),
    'nl'     			=> __('Dutch; Flemish', 'simple-metadata'),
    'en'     			=> __('English', 'simple-metadata'),
    'eo'     			=> __('Esperanto', 'simple-metadata'),
    'et'     			=> __('Estonian', 'simple-metadata'),
    'ee'     			=> __('Ewe', 'simple-metadata'),
    'fo'     			=> __('Faroese', 'simple-metadata'),
    'fj'     			=> __('Fijian', 'simple-metadata'),
    'fi'     			=> __('Finnish', 'simple-metadata'),
    'fr'     			=> __('French', 'simple-metadata'),
    'ff'     			=> __('Fulah', 'simple-metadata'),
    'gd'     			=> __('Gaelic', 'simple-metadata'),
    'gl'     			=> __('Galician', 'simple-metadata'),
    'lg'     			=> __('Ganda', 'simple-metadata'),
    'ka'     			=> __('Georgian', 'simple-metadata'),
    'de'     			=> __('German', 'simple-metadata'),
    'el'     			=> __('Greek', 'simple-metadata'),
    'gn'     			=> __('Guarani', 'simple-metadata'),
    'gu'     			=> __('Gujarati', 'simple-metadata'),
    'ht'     			=> __('Haitian', 'simple-metadata'),
    'ha'     			=> __('Hausa', 'simple-metadata'),
    'he'     			=> __('Hebrew', 'simple-metadata'),
    'hz'     			=> __('Herero', 'simple-metadata'),
    'hi'     			=> __('Hindi', 'simple-metadata'),
    'ho'     			=> __('Hiri Motu', 'simple-metadata'),
    'hu'     			=> __('Hungarian', 'simple-metadata'),
    'is'     			=> __('Icelandic', 'simple-metadata'),
    'io'     			=> __('Ido', 'simple-metadata'),
    'ig'     			=> __('Igbo', 'simple-metadata'),
    'id'     			=> __('Indonesian', 'simple-metadata'),
    'ia'     			=> __('Interlingua', 'simple-metadata'),
    'ie'     			=> __('Interlingue', 'simple-metadata'),
    'iu'     			=> __('Inuktitut', 'simple-metadata'),
    'ik'     			=> __('Inupiaq', 'simple-metadata'),
    'ga'     			=> __('Irish', 'simple-metadata'),
    'it'     			=> __('Italian', 'simple-metadata'),
    'ja'     			=> __('Japanese', 'simple-metadata'),
    'jv'     			=> __('Javanese', 'simple-metadata'),
    'kl'     			=> __('Kalaallisut; Greenlandic', 'simple-metadata'),
    'kn'     			=> __('Kannada', 'simple-metadata'),
    'kr'     			=> __('Kanuri', 'simple-metadata'),
    'ks'     			=> __('Kashmiri', 'simple-metadata'),
    'kk'     			=> __('Kazakh', 'simple-metadata'),
    'ki'     			=> __('Kikuyu; Gikuyu', 'simple-metadata'),
    'rw'     			=> __('Kinyarwanda', 'simple-metadata'),
    'kv'     			=> __('Komi', 'simple-metadata'),
    'kg'     			=> __('Kongo', 'simple-metadata'),
    'ko'     			=> __('Korean', 'simple-metadata'),
    'kj'     			=> __('Kuanyama; Kwanyama', 'simple-metadata'),
    'ku'     			=> __('Kurdish', 'simple-metadata'),
    'ky'     			=> __('Kirghiz; Kyrgyz', 'simple-metadata'),
    'lo'     			=> __('Lao', 'simple-metadata'),
    'la'     			=> __('Latin', 'simple-metadata'),
    'lv'     			=> __('Latvian', 'simple-metadata'),
    'li'     			=> __('Limburgan; Limburger; Limburgish', 'simple-metadata'),
    'ln'     			=> __('Lingala', 'simple-metadata'),
    'lt'     			=> __('Lithuanian', 'simple-metadata'),
    'lu'     			=> __('Luba-Katanga', 'simple-metadata'),
    'lb'     			=> __('Luxembourgish; Letzeburgesch', 'simple-metadata'),
    'mk'     			=> __('Macedonian', 'simple-metadata'),
    'mg'     			=> __('Malagasy', 'simple-metadata'),
    'ml'     			=> __('Malayalam', 'simple-metadata'),
    'dv'     			=> __('Maldivian', 'simple-metadata'),
    'gv'     			=> __('Manx', 'simple-metadata'),
    'mi'     			=> __('Maori', 'simple-metadata'),
    'ms'     			=> __('Malay', 'simple-metadata'),
    'mt'     			=> __('Maltese', 'simple-metadata'),
    'mr'     			=> __('Marathi', 'simple-metadata'),
    'mh'     			=> __('Marshallese', 'simple-metadata'),
    'mn'     			=> __('Mongolian', 'simple-metadata'),
    'na'     			=> __('Nauru', 'simple-metadata'),
    'nv'     			=> __('Navajo; Navaho', 'simple-metadata'),
    'nd'     			=> __('Ndebele, North; North Ndebele', 'simple-metadata'),
    'nr'     			=> __('Ndebele, South; South Ndebele', 'simple-metadata'),
    'ng'     			=> __('Ndonga', 'simple-metadata'),
    'ne'     			=> __('Nepali', 'simple-metadata'),
    'se'     			=> __('Northern Sami', 'simple-metadata'),
    'nn'     			=> __('Norwegian Nynorsk; Nynorsk, Norwegian', 'simple-metadata'),
    'no'     			=> __('Norwegian', 'simple-metadata'),
    'oc'     			=> __('Occitan; Provençal', 'simple-metadata'),
    'oj'     			=> __('Ojibwa', 'simple-metadata'),
    'om'     			=> __('Oromo', 'simple-metadata'),
    'or'     			=> __('Oriya', 'simple-metadata'),
    'os'     			=> __('Ossetian; Ossetic', 'simple-metadata'),
    'pa'     			=> __('Panjabi; Punjabi', 'simple-metadata'),
    'pi'     			=> __('Pali', 'simple-metadata'),
    'fa'     			=> __('Persian', 'simple-metadata'),
    'pl'     			=> __('Polish', 'simple-metadata'),
    'pt'     			=> __('Portuguese', 'simple-metadata'),
    'ps'     			=> __('Pushto; Pashto', 'simple-metadata'),
    'qu'     			=> __('Quechua', 'simple-metadata'),
    'ro'     			=> __('Romanian; Moldavian; Moldovan', 'simple-metadata'),
    'rm'     			=> __('Romansh', 'simple-metadata'),
    'rn'     			=> __('Rundi', 'simple-metadata'),
    'ru'     			=> __('Russian', 'simple-metadata'),
    'sm'     			=> __('Samoan', 'simple-metadata'),
    'sg'     			=> __('Sango', 'simple-metadata'),
    'sa'     			=> __('Sanskrit', 'simple-metadata'),
    'sc'     			=> __('Sardinian', 'simple-metadata'),
    'sr'     			=> __('Serbian', 'simple-metadata'),
    'sn'     			=> __('Shona', 'simple-metadata'),
    'ii'     			=> __('Sichuan Yi', 'simple-metadata'),
    'sd'     			=> __('Sindhi', 'simple-metadata'),
    'si'     			=> __('Sinhala; Sinhalese', 'simple-metadata'),
    'sk'     			=> __('Slovak', 'simple-metadata'),
    'sl'     			=> __('Slovenian', 'simple-metadata'),
    'so'     			=> __('Somali', 'simple-metadata'),
    'st'     			=> __('Sotho, Southern', 'simple-metadata'),
    'es'     			=> __('Spanish', 'simple-metadata'),
    'su'     			=> __('Sundanese', 'simple-metadata'),
    'ss'     			=> __('Swati', 'simple-metadata'),
    'sv'     			=> __('Swedish', 'simple-metadata'),
    'sw'     			=> __('Swahili', 'simple-metadata'),
    'tl'     			=> __('Tagalog', 'simple-metadata'),
    'ty'     			=> __('Tahitian', 'simple-metadata'),
    'tg'     			=> __('Tajik', 'simple-metadata'),
    'ta'     			=> __('Tamil', 'simple-metadata'),
    'tt'     			=> __('Tatar', 'simple-metadata'),
    'te'     			=> __('Telugu', 'simple-metadata'),
    'th'     			=> __('Thai', 'simple-metadata'),
    'bo'     			=> __('Tibetan', 'simple-metadata'),
    'ti'     			=> __('Tigrinya', 'simple-metadata'),
    'to'     			=> __('Tonga', 'simple-metadata'),
    'ts'     			=> __('Tsonga', 'simple-metadata'),
    'tn'     			=> __('Tswana', 'simple-metadata'),
    'tr'     			=> __('Turkish', 'simple-metadata'),
    'tk'     			=> __('Turkmen', 'simple-metadata'),
    'tw'     			=> __('Twi', 'simple-metadata'),
    'ug'     			=> __('Uighur; Uyghur', 'simple-metadata'),
    'uk'     			=> __('Ukrainian', 'simple-metadata'),
    'ur'     			=> __('Urdu', 'simple-metadata'),
    'uz'     			=> __('Uzbek', 'simple-metadata'),
    'vl'     			=> __('Valencian', 'simple-metadata'),
    've'     			=> __('Venda', 'simple-metadata'),
    'vi'     			=> __('Vietnamese', 'simple-metadata'),
    'vo'     			=> __('Volapük', 'simple-metadata'),
    'wa'     			=> __('Walloon', 'simple-metadata'),
    'cy'     			=> __('Welsh', 'simple-metadata'),
    'fy'     			=> __('Western Frisian', 'simple-metadata'),
    'wo'     			=> __('Wolof', 'simple-metadata'),
    'xh'     			=> __('Xhosa', 'simple-metadata'),
    'yi'     			=> __('Yiddish', 'simple-metadata'),
    'yo'     			=> __('Yoruba', 'simple-metadata'),
    'za'     			=> __('Zhuang; Chuang', 'simple-metadata'),
    'zu'     		  => __('Zulu', 'simple-metadata')
 	];

 	asort( $languages );

 	return $languages;
 }
