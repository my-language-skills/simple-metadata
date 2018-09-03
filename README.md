# Simple Metadata

* Contributors: colomet, danzhik
* Donate link:
* Tags: aiom, extensions, metadata
* Requires at least: 4.9.6
* Tested up to: 4.9.6
* Requires PHP: 7.2.0
* Stable tag: 1.0
* License: GNU 3.0
* License URI: https://www.gnu.org/licenses/gpl-3.0.en.html

Plugin for automatic generation of meta fields in web-pages.

## Description

Wordpress gives you the ability to add metadata to your sites thus helping Google and other search engines to recognise it. The problem comes if you want to expand.

Simple metadata, extends the functionality of Wordpress and gives you the flexibility to add more metadata in your sites, taking advantage of the schema markup.

*///wrong///* You can see the [schema properties that we use here](https://github.com/Books4Languages/pressbooks-metadata/blob/master/docs/SchemaUsed.md)

* [Introduction](/doc/doc-intro.md)
* [Installation, Integrations and Compatibilities](/doc/doc-general.md)
* [Site settings](/doc/doc-settings-site.md)


## Installation

1. Upload plugin folder to /wp-content/plugins/ folder in your web-site file-system.
1. Activate it from 'Plugins page' in your website.

## upgrades

For upgrades, download the last stable version from github, delete from FTP the old plugin and install the new one.

## Frequently Asked Questions

[FAQ](/doc/doc-faq.md)


## Disclaimers

The Simple metadata plugin is supplied "as is" and all use is at your own risk.

## Screenshots

You can see all of the screenshots of the plugin [here](https://github.com/Books4Languages/simple-metadata/blob/master/simple-metadata/doc/screenshots.md)

## Roadmap


### Now
## 0.xx
Types of changes
    **Added** for new features.
    **Changed** for changes in existing functionality.
    **Deprecated** for soon-to-be removed features.
    **Removed** for now removed features.
    **Fixed** for any bug fixes.
    **Security** in case of vulnerabilities.

* **List of Files revised**


### Changelog
[See changelog](/CHANGELOG.md)


## Upgrade Notice

### 1.0




## Credits

* Here's a link to [Plugin Boilerplate](http://wppb.io/ "Uses the WordPress Plugin Boilerplate")
* Here's a link to [Composer](https://getcomposer.org/)
* Here's a link to [PressBooks](https://pressbooks.org/get-involved/ "Your favorite ebook platform")
* Here's a link to [Custom Metadata Manager for WordPress](https://wordpress.org/plugins/custom-metadata/ "Framework for custom field creation")

---
[Up](/README.md)











## Features

### Pages Related Content

This extension gives automatically generated data for posts of default WP post type 'page'. Added information is based on Schema.org 'WebPage' type. For every post you can select subtype of 'WebPage' type, depending on belonging of your content. The information added is following:
* Author ('author' Schema.org property)
* Last modifier ('editor' Schema.org property)
* Creation date ('dateCreated' Schema.org property)
* Publication date ('datePublished' Schema.org property)
* Last modification date ('lastReviewed' Schema.org property)
* Title of content ('headline' Schema.org property)
* Featured image URL ('thumbnailUrl' Schema.org property)


### Posts Related Content

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
