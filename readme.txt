=== Simple metadata ===
Contributors: colomet, danzhik, huguespages, dcazzorla
Donate link: https://opencollective.com/mylanguageskills
Tags: multisite, pressbooks, simple metadata, metadata, schema.org, rich snippets, wordpress-plugin,
Requires at least: 5.2
Tested up to: 5.3
Requires PHP: 5.6
Stable tag: 1.5.3
License: GPLv3 or later
License URI: https://www.gnu.org/licenses/gpl-3.0.html

This plugin provides auto-generated metadata on the basis of default WP web-pages information.

== Description ==

This plugin provides the ability to set different types of schema types in one click (for Blogs and WebSites) by using the default WordPress fields.

> By default:
> a Front page is a Blog type
> a Page is a WebPage type
> a Post is an Article type
>
> in a PB installation, a site is a Book and a Post is a Chapter

Demo [here](https://simple-metadata.000webhostapp.com/).
== Front-page related content =

* Types:
  * **[Blog](https://simple-metadata.000webhostapp.com/blog/)**
  * **WebSite**

Properties
 * **CreativeWork** type: **inLanguage**
 * **Thing** type: **name**, **description** & **URL**

= Pages related content =

Types:

* **[WebPage](https://simple-metadata.000webhostapp.com/webpage/)** type
  * **AboutPage** type
  * **CheckoutPage** type
  * **CollectionPage** type
  * **ImageGallery** type
  * **VideoGallery** type
  * **ContactPage** type
  * **FAQPage** type
  * **ItemPage** type
  * **MedicalWebPage** type
  * **ProfilePage** type
  * **QAPage** type
  * **SearchResultsPage** type

Properties:

* **WepPage** Type:
 * Properties: **lastReviewed**
* **CreativeWork** type:
 * Properties: **author**, **dateCreated**, **datePublished**, **editor**, **headline** & **thumbnailUrl**

= Posts related content =

Types

* **[Article](https://simple-metadata.000webhostapp.com/article/)** type
 * **AdvertiserContentArticle** type
* **Report** type
* **SatiricalArticle** type
* **SocialMediaPosting** type
 * **BlogPosting** type
   * **LiveBlogPosting** type
    * **DiscussionForumPosting** type
* **TechArticle** type

Properties

* **Article** type
  * Properties: **articleBody**, **articleSection** & **wordCount**
* **CreativeWork** Type
  * Properties: **author**, **dateCreated**, **dateModified**, **datePublished**, **editor**, **headline**, **keywords**, **logo**, **publisher**, **thumbnailUrl**
* **Thing** type
    * Properties: **image**

=== Works with ===
The SEO framework
Yoast SEO

== Installation ==

= Installation instructions: =

This section describes how to install the plugin and get it working.

1. Upload the plugin files to the `/wp-content/plugins/simple-metadata` directory, or install the plugin
through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress
3. Access the plugins menu through the metadata menu page to use the plugin.

== Screenshots ==

1. Settings - organisation name and logo
2. Settings - front page, pages and cpt’s
3. Front page metadata
4. Settings - new page metabox
5. Page metadata 1
6. Page metadata 2
7. Settings - new post metabox
8. Post metadata 1
9. Post metadata 2

== Frequently Asked Questions ==

= I have a feature request, I've found a bug, a plugin is incompatible... =

Please visit [the support forums](https://wordpress.org/support/plugin/simple-metadata/)

= I am a developer; how can I help? =

Any input is much appreciated, and everything will be considered.
Please visit the [GitHub project page](https://github.com/my-language-skills/simple-metadata) to submit issues or even pull requests.

Please note GitHub is not a support forum, and issues that aren't properly qualified as bugs will be closed.

= Is Simple Metadata free? =

Absolutely! It will stay free as well, without ads or nags!
This plugin is all-inclusive without upsells.

= Is there more? =

For more advanced metadata options and output, we offer extensions

Simple metadata annotation
Simple metadata education
Simple metadata lifecycle
Simple metadata metametadata
Simple metadata news
Simple metadata relation
Simple metadata rights
Simple metadata technical

= What is structured data? =
We're convinced that [structured data](https://developers.google.com/search/docs/guides/intro-structured-data) makes the web better, and we've worked hard to create [Rich Snippets](https://webmasters.googleblog.com/2009/05/introducing-rich-snippets.html) and [Rich Cards](https://webmasters.googleblog.com/2016/05/introducing-rich-cards.html) for better search results. Thanks to [metadata](https://www.youtube.com/watch?v=L9BqE01SLeE), the search engines can understand the relevance of that content in context. Simple metadata is a complete solution for adding metadata to a Wordpress site.

= What is not Simple metadata =
Is not a SEO solution. Schemas don’t actually boost the organic search rankings. With Schemas review ratings, recipes or events in Google’s [SERPs](https://moz.com/learn/seo/serp-features) (search engine results pages) are not just normal search listings but also contain additional information that makes the crawling easier. Those are known as rich snippets and they are thanks to schema markup. Rich snippets actually increase clickthrough rates. Schema may not directly improve your search rankings, but it can still be beneficial for your SEO.

= How Google understand the content? =
[Google Search](https://moz.com/blog/google-glossary) works hard to understand the content of a page. However, you can provide explicit clues about the meaning of a page to Google by including structured data on the page. [Structured Data](https://developers.google.com/search/docs/guides/intro-structured-data) is a standardized format for providing information about a page and classifying the page content; for example, if is it a recipe page, what are the ingredients, the cooking time and temperature, the calories, and so on.

= Hot to test? =
Be sure to test your structured data using the [Structured Data Testing Tool](https://search.google.com/structured-data/testing-tool/u/0/) during development, and the [Search Console Structured Data report](https://www.google.com/webmasters/tools/structured-data?pli=1) after deployment, to monitor the health of your pages, which might break after deployment due to templating or serving issues.

Still under development, [Google Rich cards test](https://search.google.com/test/rich-results) can help you with  the test.

= What is Schema.org? =
[Schema.org](http://schema.org/) is a collaborative, community activity with a mission to create, maintain, and promote schemas for [structured data](https://moz.com/learn/seo/schema-structured-data) on the Internet, on web pages, in email messages, and beyond.

Schema.org vocabulary can be used with many different encodings, including RDFa, Microdata and JSON-LD. These vocabularies cover entities, relationships between entities and actions, and can easily be extended through a well-documented extension model. Over 10 million sites use Schema.org to markup their web pages and email messages.

Founded by Google, Microsoft, Yahoo and Yandex, Schema.org vocabularies are developed by an open community process, using the public-schemaorg@w3.org mailing list and through [GitHub](https://github.com/schemaorg/schemaorg).

=  How can I find the FAQ page? =
[welcomed on GitHub](https://github.com/my-language-skills/simple-metadata)

https://github.com/my-language-skills/simple-metadata/blob/master/doc/doc-faq.md

== Changelog ==
= 1.5.3 =
* **BUGFIX**
  * m=Modified condition to proper display correct post types (locations) to fit all the cases
	* Course description condition fix

= 1.5.2 =
* **ADDITIONS**
	* JS "use strict" mode now and minor modifications
	* Escape html added to some stings

* **MODIFICATION**
	* indents

* **BUGFIX**
	* Book tagline description when Course selected now works properly

* **List of Files revised**
	* smd-logo-box.js
	* smd-googleImage-box.js
	* simple-metadata-admin.js
	* smd-posts-related-content.php
	* smd-frontpage-related-content.php
	* smd-pages-related-content.php

= 1.5.1 =
* **ADDITIONS**
 * If site type is Course then Book tagline (pb_about_140) is used as description

* **List of Files revised**
 * smd-front-page-related-content.php

= 1.5 =
 ADDITIONS
	* Site 1 has now special status in terms of site types and is not overridable by network settings
	* JS alert when Organization image unset
	* Provider tag
	* When site type is not Book - Illustrator is printed as contributor
	* If PB installation set Course site type as default in all sites on plugin activation

 MODIFICATION
	* All Publisher menu settings renamed to Organization
	* PB - Booktype option removed and default site type approach is used now
	* Specifying when to display certain metaboxes and fields related to the type of installation and site type
	* Contributor type - thing changed to person
	* Minor text and styling fixes

 REMOVED
	* Site submenu page removed

  List of Files revised
  	 * smd-posts-related-content.php
  	 * smd-front-page-related-content.php
  	 * smd-pages-related-content.php
  	 * smd-set-page-metaboxes.php
  	 * smd-logo-box.js
  	 * smd-general-functions.php
  	 * smd-network-admin.php
     * simple-metadada.php

 = 1.4.4  =
 ADDITIONS
	 * New submenu field "Publisher" with "Organization" metabox where admin is able to set Publisher logo (Network(Site1) level and single site level) and related functionality
	 * Comments in HTML header signalizing on what type of metadata is printed
	 * Functionality related thumbnail metadata in case featured_image_for_pressbooks plugin is activated

 MODIFICATION
 	 * Metadata menu field (and its settings) is now displayed also on Site1

List of Files revised
	 * smd-posts-related-content.php
	 * smd-front-page-related-content.php
	 * smd-pages-related-content.php
	 * smd-set-page-metaboxes.php
	 * smd-logo-box.js
	 * smd-general-functions.php
	 * smd-network-admin.php

 = 1.4.3  =
Changes in this version are related ONLY to Pressbooks use case.
 ADDITIONS
	 * Extends and modifies functionality in Book admin 'Book type' metabox for course, book options and for front-matter, back-matter.

 REMOVED
    Disabled by commenting out.
	 * Network admin locations metabox which enables/disables printing metadata for selected post-type.
	 * Book(site) admin locations metabox which enables/disables printing metadata for selected post-type.

 List of Files revised
	 * smd-posts-related-content.php
	 * smd-set-page-metaboxes.php
	 * documentation

 = 1.4.2  =
 ADDITIONS
	 * Admin metabox related to set book type option (Book/Course/Default) that modifies metadata print.

ENHANCEMENTS
	* Specify date print format in smd_get_general_tags() functon to 'Y-m-d'

 List of Files revised
	* smd-general-functions.php
	* smd-posts-related-content.php
	* smd-set-page-metaboxes.php

 =1.4.1  =
*ADDITIONS
	* Admin Logo image metabox

List of Files revised
	* smd-set-page-metaboxes.php

= 1.4 =

* Metabox 'Options'
* Metabox 'Google image'
* Pressbook Integration
* Print metadata from smd-relation
* Moved network options to sitemeta table
* Microtags to json-ld (using wp_json_encode #27)
* Bufixes

= 1.3 =

ADDITIONS:
	Internationalization (#20)

REMOVED:
  Auto update from github

ENHANCEMENTS:
	Modification admin panel, front page type of site older

BUGFIXES:
	Bug button in post metaboxes
	no-type post were not set properly

List of Files revised:
	smd-general-functions.php
	smd-frontpage-related-content.php
	smd-pages-related-content.php
	smd-posts-related-content.php
	smd-frontpage-related-content.php
	smd-network-admin.php

= 1.2.1 =
* ENHANCEMENTS: Make in corect order the admin panel. Change name site-meta in home page

= 1.2 =
* ADDITIONS: Add new plugins : simple-metadata-annotation; Add new functionality to auto upload with plugin-uptdate-checker

= 1.1 =
* ADDITIONS: Integration with add-ons was significantly increased. Some new properties were added for all possible post types. Plugin now supports network-wide applied options

= 1.0 =
* Initial release.


== Upgrade Notice ==

= 1.3 =

== Disclaimers ==

The Simple metadata is supplied "as is" and all use is at your own risk.
