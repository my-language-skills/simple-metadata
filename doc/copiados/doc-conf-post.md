# Post metadata

If Post metadata is activate at [site settings](/doc-settings-site.md) Simple Metadata will create Post Type options in Page (metabox).

## Settings

The top 'type' for the description of the Post, Article, (which is a subtype of Creative Work) is specified In the next level in the hierarchy within 8 schemas:

* Article *Activated by default*
  * AdvertiserContentArticle
  * NewsArticle (NO)
  * Report
  * SatiricalArticle
  * ScholartlyArticle (NO)
  * SocialMediaPosting
    * BlogPosting
      * LiveBlogPosting
    * DiscussionForumPosting
  * TechArticle

## PRESSBOOKS use case:
In version 1.4.3 rework of the plugin was done related ONLY to Pressbooks Configuration page and subsequent font-end metadata print.

1.
Locations metaboxes were removed (disabled) from both Network admin settings and Site (book) admin settings.
These locations settings were replaced by using on of the two Book type presets. Course and Book.
Course (default) - sets printed metadata type in following way: (Part -> Chapter | Chapter -> Article).
Book - sets printed metadata type in following way:  (Part -> no metadata | Chapter -> Chapter).

2.
Front-matter (introduction) and back-matter (appendix) metadata are now printed as a type 'WebPage' by default.
It is possible to remove printing this metadata by checking the box in 'Disable WebPage type' settings field in Site admin settings.

_No further configuration is necessary, all the properties find the values from WordPress._

# Post types and properties

Article is the most generic type available and inherits properties from both parent types (Thing and CreativeWork).

The Post can be identified by a collection of 13 schema.org [Properties](/doc/doc-metadata-post.md).

SM just offer properties from WordPress core fields. If you woud like to extend those poroperties, you must activate one of the Simple Metadata addons.

# Screenshots

Settings site
![settings-post](/doc/images/settings-post.png)

Structured data
![structured-data-post](/doc/images/structured-data-post.png)

---

[Readme](//Readme.md)
