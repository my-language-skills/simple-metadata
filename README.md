# Simple Metadata

* Contributors: @colomet, @danzhik, @huguespages, @davideC00, @lukastonhajzer
* Donate link: https://opencollective.com/mylanguageskills
* Tags: simple metadata, extensions, metadata, multisite
* Requires at least: 5.2
* Tested up to: 5.2.2
* Requires PHP: 5.6
* Stable tag: 1.6
* License: GNU 3.0
* License URI: https://www.gnu.org/licenses/gpl-3.0.html
* Gutenberg: compatible

Plugin for automatic generation of meta fields in web-pages.

## Description

WordPress gives you the ability to add metadata to your sites thus helping Google and other search engines to recognise it. The problem comes if you want to expand.

Simple metadata, extends the functionality of WordPress and gives you the flexibility to add automatically metadata in your sites, taking advantage of the schema markup.

* General
	* [Introduction](/doc/doc-intro.md)
	* [Installation, Integrations and Compatibilities](/doc/doc-general.md)
	* [Metadata fields](/doc/doc-fields.md)
* Settings
	* [Site settings](/doc/doc-settings-site.md)
	* [MU settings](/doc/doc-settings-mu.md)
* Configuration
	* [Site configuration](/doc/doc-conf-site.md)
		* [Site metadata](/doc/doc-metadata-site.md)
	* [Page configuration](/doc/doc-conf-page.md)
		* [Page metadata](/doc/doc-metadata-page.md)
	* [Post configuration](/doc/doc-conf-post.md)
		* [Post metadata](/doc/doc-metadata-post.md)

Simple metadata markup will be stored in cached versions of web-pages when a caching plugin is available. Please be sure to clear your cache.

## Installation

1. Upload plugin folder to /wp-content/plugins/ folder in your web-site file-system.
1. Activate it from 'Plugins page' in your website.

## Upgrades

For upgrades, download the last stable version from github, delete from FTP the old plugin and install the new one.

## Frequently Asked Questions

[Rich Snippets FAQ](/doc/doc-faq.md)

[What is a SEO plugin?](/doc/doc-seo.md)

## Disclaimers

The Simple metadata plugin is supplied "as is" and all use is at your own risk.

## Roadmap

## To expand
Copy and paste the simple metadata lifecycle plugins, you have to change the function names and then to modify as desired the new metaboxes.
we create a big meta data block, then inside we create fields, here it is in the file (admin/smd....-class.php). To see how we can create our own field, we have to go to the plugin simple-metadata/symbionts/custom-metadata/custom_metadata.php and then we can create using this file for the documentation.
Don't forget to add in the simple-metadata plugin, in each smd-...-related-content folder the lines to write the metatags, for example :
```
if (is_plugin_active('simple-metadata-annotation/simple-metadata-annotation.php') && (isset(get_option('smdan_locations')['site-meta']) || isset(get_option('smdan_locations')['metadata'])){
		smdan_print_tags($type);
	}
```
Like  you can see smdan_locations, is a function where create in the new plugin
Don't forget to modify also the simple-metadata.php file this line and add the new plugin :
```
if (is_plugin_active('simple-metadata-education/simple-metadata-education.php') || is_plugin_active('simple-metadata-lifecycle/simple-metadata-lifecycle.php') || is_plugin_active('simple-metadata-annotation/simple-metadata-annotation.php'))
```

### Changelog
### 1.6
* **MODIFICATION**
	* CodeCanyon code review

	 1 all .js files have the "use_strict" statement.
   - .php files with script tags changed (smd-set-page-metaboxes.php {143,248},smd-network-admin.php-{168})

	 2 Nothing changed for this
   - on .js files "jQuery(document).ready(function($)" to "jQuery(function($)" ?
   - same on php files.

   3 escape all translatable strings?...
	 - (possible locations:smd-frontpage-related-content.php {$metadata to json}, smd-general-functions.php {213-228},smd-posts-related-content.php{$post_meta_type})

	 4 delete all unused code: - comments.. => no comments..  (problem in sumbionts/custom_metadata.php)
  - not reachable blocks.

	5 smd-general-functions. 216,254
	changed at smd-pages-related-content.php deleted comment "//'QAPage' at line: 79 deleted " and  line: 36

### 1.5.3
* **BUGFIX**
  * Modified condition to proper display correct post types (locations) to fit all the cases
  * Course description condition fix

* **List of Files revised**
	* smd-frontpage-related-content.php
	* smd-frontpage-related-content.php

### 1.5.2
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

### 1.5.1
* **ADDITIONS**
 * If site type is Course then Book tagline (pb_about_140) is used as description

* **List of Files revised**
 * smd-front-page-related-content.php

### 1.5
* **ADDITIONS**
	* Site 1 has now special status in terms of site types and is not overridable by network settings
	* JS alert when Organization image unset
	* Provider tag
	* When site type is not Book - Illustrator is printed as contributor
	* If PB installation set Course site type as default in all sites on plugin activation

* **MODIFICATION**
	* All Publisher menu settings renamed to Organization
	* PB - Booktype option removed and default site type approach is used now
	* Specifying when to display certain metaboxes and fields related to the type of installation and site type
	* Contributor type - thing changed to person
	* Minor text and styling fixes

* **REMOVED**
	* Site submenu page removed

### 1.4.4
* **ADDITIONS**
	 * New submenu field "Publisher" with "Organization" metabox where admin is able to set Publisher logo (Network(Site1) level and single site level) and related functionality
	 * Comments in HTML header signalizing on what type of metadata is printed
	 * Functionality related thumbnail metadata in case featured_image_for_pressbooks plugin is activated

* **MODIFICATION**
 	 * Metadata menu field (and its settings) is now displayed also on Site1

* **List of Files revised**
	 * smd-posts-related-content.php
	 * smd-front-page-related-content.php
	 * smd-pages-related-content.php
	 * smd-set-page-metaboxes.php	 
	 * smd-logo-box.js
	 * smd-general-functions.php
	 * smd-network-admin.php

### 1.4.3
Changes in this version are related ONLY to Pressbooks use case.
* **ADDITIONS**
	 * Extends and modifies functionality in Book admin 'Book type' metabox for course, book options and for front-matter, back-matter.

* **REMOVED**
Disabled by commenting out.
	 * Network admin locations metabox which enables/disables printing metadata for selected post-type.
	 * Book(site) admin locations metabox which enables/disables printing metadata for selected post-type.

* **List of Files revised**
	 * smd-posts-related-content.php
	 * smd-set-page-metaboxes.php	 
	 * documentation

### 1.4.2
* **ADDITIONS**
	 * Admin metabox related to set book type option (Book/Course/Default) that modifies metadata print.

* **ENHANCEMENTS***
	* Specify date print format in smd_get_general_tags() functon to 'Y-m-d'

* **List of Files revised**
	* smd-general-functions.php
	* smd-posts-related-content.php
	* smd-set-page-metaboxes.php

### 1.4.1
* **ADDITIONS**
	* Admin Logo image metabox

* **List of Files revised**
	* smd-set-page-metaboxes.php

### 1.4
* Wordpress code review
* Metabox 'Options'
* Metabox 'Google image'
* Pressbook Integration
* Print metadata from smd-relation
* Moved network options to sitemeta table
* Microtags to json-ld (using wp_json_encode #27)
* Bugfixes

### 1.3
* **ADDITIONS**
	 * Internationalization (#20)

* **REMOVED**
   * Auto update from github

* **ENHANCEMENTS***
	 * Modification admin panel, front page type of site older

* **BUGFIXES***
	 * Bug button in post metaboxes
	 * no-type post were not set properly

* **List of Files revised**
	 * smd-general-functions.php
	 * smd-frontpage-related-content.php
	 * smd-pages-related-content.php
	 * smd-posts-related-content.php
	 * smd-frontpage-related-content.php
	 * smd-network-admin.php

### 1.2.1
* **ENHANCEMENTS***
		* Make in correct order the admin panel. Change name site-meta in home page
* **List of Files revised**
   * smd-general-functions.php

### 1.2
* **ADDITIONS***
   * Add new plugins : simple-metadata-annotation
   * Add new functionality to auto upload with plugin-update-checker

* **List of Files revised**
   * simple-metadata.php
   * smd-frontpage-related-content.php
   * smd-pages-related-content.php
   * smd-posts-related-content.php

### 1.1
Integration with add-ons was significantly increased. Some new properties were added for all possible post types. Plugin now supports network-wide applied options

## Credits
* Here's a link to [PressBooks](https://pressbooks.org/get-involved/ "Your favorite ebook platform")
* Here's a link to [Custom Metadata Manager for WordPress](https://wordpress.org/plugins/custom-metadata/ "Framework for custom field creation")

---
[Up](/README.md)
