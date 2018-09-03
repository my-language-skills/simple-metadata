# Simple Metadata

* Contributors: colomet, danzhik
* Donate link: 
* Tags: aiom, extensions, metadata
* Requires at least: 4.9.6
* Tested up to: 4.9.6
* Requires PHP: 7.2.0
* Stable tag: 0.1
* License: GNU 3.0
* License URI: https://www.gnu.org/licenses/gpl-3.0.en.html
 
Plugin for automatic generation of meta fields in web-pages.
 
## Description 
 
This plugin feeds your posts and pages, and also front-page, with automatically generated meta-fileds for better search-engines visibility.
 
## Installation 
 
1. Upload plugin folder to /wp-content/plugins/ folder in your web-site file-system.
1. Activate it from 'Plugins page' in your website.

## Packages

### Webpages Related Content

This extension gives automatically generated data for posts of default WP post type 'page'. Added information is based on Schema.org 'WebPage' type. For every post you can select subtype of 'WebPage' type, depending on belonging of your content. The information added is following:
* Author ('author' Schema.org property)
* Last modifier ('editor' Schema.org property)
* Creation date ('dateCreated' Schema.org property)
* Publication date ('datePublished' Schema.org property)
* Last modification date ('lastReviewed' Schema.org property)
* Title of content ('headline' Schema.org property)
* Featured image URL ('thumbnailUrl' Schema.org property)


### Articles Related Content

This extension gives automatically generated data for posts of default WP post type 'post'. Added information is based on Schema.org 'Article' type. For all the posts you can select subtype of 'Article' type, depending on belonging of your content. Subtype can be chosen only from netowrk settings page of All In One Metadata, which means it will be applied to ALL posts on ALL blogs. The information added is following:
* Author ('author' Schema.org property)
* Last modifier ('editor' Schema.org property)
* Creation date ('dateCreated' Schema.org property)
* Publication date ('datePublished' Schema.org property)
* Title of content ('headline' Schema.org property)
* Featured image URL ('thumbnailUrl' Schema.org property)
* Image URL ('image' Schema.org property,also utilizes thumbanail url) (added just because Google requires it)
* Post tags ('keywords' Schema.org property)
* Post categories ('articleSection' Schema.org property)
* Wordcount of article ('wordcount' Schema.org property)

