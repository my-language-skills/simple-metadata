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

PB Uses chapter type (non article properties are used)

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
