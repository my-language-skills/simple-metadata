# AIOM Extensions

* Contributors: danzhik
* Donate link: 
* Tags: aiom, extensions, metadata
* Requires at least: 4.9.6
* Tested up to: 4.9.6
* Requires PHP: 7.2.0
* Stable tag: 0.1
* License: GNU 3.0
* License URI: https://www.gnu.org/licenses/gpl-3.0.en.html
 
Extensions for All In One Metadata plugin.
 
## Description 
 
This repository contains tiny extensions for [!All In One Metadata](https://github.com/my-language-skills/all-in-one-metadata) plugin - structured data creation tool. Each folder contains separate plugin, created for different type of content
 
## Installation 
 
1. Upload plugin folder to /wp-content/plugins/ folder in your web-site file-system.
1. Activate it from 'Plugins page' in your website.

## Packages

### Webpages Related Content

This extension gives automatically generated data for posts of default WP post type 'page'. Added information is based on Schema.org 'WebPage' type. For every page you can select subtype of 'WebPage' type, depending on belonging of your content. The information added is following:
* Author ('author' Schema.org property)
* Last modifier ('editor' Schema.org property)
* Creation date ('dateCreated' Schema.org property)
* Publication date ('datePublished' Schema.org property)
* Last modification date ('lastReviewed' Schema.org property)
* Title of content ('headline' Schema.org property)
* Featured image URL ('thumbnailUrl' Schema.org property)

### News Related Content

This extension gives automatically generated data for posts of default WP post type 'post'. Added information is based on Schema.org 'NewsArticle' type. For every page you can select subtype of 'NewsArticle' type, depending on belonging of your content. The information added is following:
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
