# Legend
Types of changes
  * **Added** for new features.
  * **Changed** for changes in existing functionality.
  * **Deprecated** for soon-to-be removed features.
  * **Removed** for now removed features.
  * **Fixed** for any bug fixes.
  * **Security** in case of vulnerabilities.

* **List of Files revised**

## 1.4.2
### Plugin

### Administration
  * **Added** Site1 administration menu(beta)


## 1.4.1
### Plugin
  * **Changed** Simple Relation integration

### Administration
  * **Added** Logo metabox

# 1.4

## Plugin
  * **Changed** network options in sitemeta table

## Administration
  * **Added** Options metabox
    * **Added** Hide dates

## Site related content
  * **Added** Simple Metadata Relation integration
  * **Changed** microtags to json-ld
  * **Fixed** Pressbooks integration
  * **Fixed** yoast Seo for site-meta post type
  * **Fixed** ui for site-meta

  * Site settings
    * **Changed** Website Blog -> Blog Website

  * Properties
    * **Added** isFamilyFriendly
    * **Removed** lastReviewed

## Pages related content
  * **Added** Google image metabox
  * **Added** Simple Mtedata Relation integration
  * **Changed** microtags to json-ld
  * **Fixed** Pressbooks integration

  * Properties
    * **Added** width, height for image
    * **Added** isFamilyFriendly
    * **Changed** reviewedBy to contributor
    * **Changed** about to description

## Posts related content
  * **Added** Google image metabox
  * **Added** Simple Mtedata Relation integration
  * **Changed** microtags to json-ld
  * **Fixed** Pressbooks integration
  * **Fixed** default post type: Article

  * Properties
    * **Added** width and height for image
    * **Added** isFamilyFriendly
    * **Removed** editor
    WebPage
    * **Changed** keywords = tags + categories


# 1.3

## Plugin
  * **Added** Internationalization (#20)
  * **Removed** Auto update from github

## Administration
  * **Changed** admin panel

## Front page related content
  * **Changed** front page type of site older

## Posts related content
  * **Fixed** Bug button in post metaboxes
  * **Fixed** no-type post were not set properly

* **List of Files revised**
    * smd-general-functions.php
    * smd-frontpage-related-content.php
    * smd-pages-related-content.php
    * smd-posts-related-content.php
    * smd-frontpage-related-content.php
    * smd-network-admin.php


# 1.2.1

## Administration
	* Make in correct order the admin panel. Change name site-meta in home page

* **List of Files revised**
  * smd-general-functions.php

# 1.2

## Plugin
  * **Added** new plugins : simple-metadata-annotation
  * **Added** Add new functionality to auto upload with plugin-uptdate-checker

* **List of Files revised**
    * simple-metadata.php
    * smd-frontpage-related-content.php
    * smd-pages-related-content.php
    * smd-posts-related-content.php


# 1.1

## Administration

 * **Added** network-wide settings
 * **Fixed** integration with PressBooks

## Site related content

* Types
  * **Added** integration with add-ons types

* Properties
  * **Added** integration with add-ons properties

## Pages related content

* Types
  * **Added** integration with add-ons types

* Properties
  * **Added** integration with add-ons properties
  * Creative Work type
    * **Added** inLanguage property

## Posts related content

* Types
  * **Added** integration with add-ons types

* Properties
  * **Added** integration with add-ons properties
  * Creative Work type
    * **Added** inLanguage property


# 1.0

## Site related content

* Types
  * **Added:** Blog type
  * **Added:** WebSite type
* Properties
  * Creative Work type
    * **Added:** inLanguage property
  * Thing type
    * **Added:** name property
    * **Added:** description property
    * **Added:** URL property

## Pages related content

* Types
  * **Added:** WebPage type
    * **Added:** AboutPage type
    * **Added:** CheckoutPage type
    * **Added:** CollectionPage type
    * **Added:** ImageGallery type
    * **Added:** VideoGallery type
    * **Added:** ContactPage type
    * **Added:** FAQPage type
    * **Added:** ItemPage type
    * **Added:** MedicalWebPage type
    * **Added:** ProfilePage type
    * **Added:** QAPage type
    * **Added:** SearchResultsPage type
* Properties
  * WepPage Type
    * **Added:** lastReviewed property
  * Creative Work type
    * **Added:** author property
    * **Added:** dateCreated property
    * **Added:** datePublished property
    * **Added:** editor property
    * **Added:** headline property
    * **Added:** thumbnailUrl property

## Posts related content

* Types
  * **Added:** Article type
    * **Added:** AdvertiserContentArticle type
    * **Added:** Report type
    * **Added:** SatiricalArticle type
    * **Added:** SocialMediaPosting type
      * **Added:** BlogPosting type
        * **Added:** LiveBlogPosting type
    * **Added:** DiscussionForumPosting type
  * **Added:** TechArticle type
* Properties
  * Article type
    * **Added:** articleBody property
    * **Added:** articleSection property
    * **Added:** wordCount property
  * Creative Work Type
    * **Added:** author property
    * **Added:** dateCreated property
    * **Added:** dateModified property
    * **Added:** datePublished property
    * **Added:** editor property
    * **Added:** headline property
    * **Added:** keywords property
    * **Added:** logo property
    * **Added:** publisher property
    * **Added:** thumbnailUrl property
  * Thing type
    * **Added:** image property
