# Simple Metadata

* Contributors: @colomet, @danzhik
* Donate link: https://opencollective.com/mylanguageskills
* Tags: aiom, extensions, metadata
* Requires at least: 4.9.6
* Tested up to: 4.9.8
* Requires PHP: 7.2.0
* Stable tag: 1.0
* License: GNU 3.0
* License URI: https://www.gnu.org/licenses/gpl-3.0.en.html

Plugin for automatic generation of meta fields in web-pages.

## Description

Wordpress gives you the ability to add metadata to your sites thus helping Google and other search engines to recognise it. The problem comes if you want to expand.

Simple metadata, extends the functionality of Wordpress and gives you the flexibility to add automatically metadata in your sites, taking advantage of the schema markup.

Simple metadata just work in default WP post and pages.

* [Introduction](/doc/doc-intro.md)
* [Installation, Integrations and Compatibilities](/doc/doc-general.md)
* [Site settings](/doc/doc-settings.md)
* [Metadata filds](/doc/doc-fields.md)

Schema properties used
* [Site metadata](/doc/doc-conf-settings-site.md)
* [Page metadata](/doc/doc-conf-settings-page.md)
* [Post metadata](/doc/doc-conf-settings-post.md)
* [MU metadata](/doc/doc-conf-settings-mu.md)

Simple metadata markup will be stored in cached versions of web-pages when a caching plugin is available. Please be sure to clear your cache.


## Installation

1. Upload plugin folder to /wp-content/plugins/ folder in your web-site file-system.
1. Activate it from 'Plugins page' in your website.

## upgrades

For upgrades, download the last stable version from github, delete from FTP the old plugin and install the new one.

## Frequently Asked Questions

[FAQ](/doc/doc-faq.md)


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
### 1.2
* **ADDITIONS***
   * Add new plugins : simple-metadata-annotation
   * Add new functionality to auto upload with plugin-uptdate-checker

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
