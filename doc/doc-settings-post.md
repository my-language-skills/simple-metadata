# Post metadata
Simple Metadata will create Post Type options in Posts (metabox).

## Simple Metadata settings
Post type have 9 options which allow the configuration of the metadata. Pick the one that describes better the Post:
* Article *By default if **Type of site: WebSite** is activated in the settings page.*
  * AdvertiserContentArticle
  * NewsArticle (NO)
  * Report
  * SatiricalArticle
  * ScholartlyArticle (NO)
  * SocialMediaPosting
    * BlogPosting *By default if **Type of site: Blog** is activated in the settings page.*
      * LiveBlogPosting
    * DiscussionForumPosting
  * TechArticle

Note: Article is a parent type. Any other type is a child type of Article.

# Post types and properties

## Article

The related properties from the [Article](https://schema.org/Article "https://schema.org/Article") type that matters to the project are:

| From | Property | Type | Description | Settings place |
| ---- | -------- |----- | ----------- | --------------
| WP-Core | [articleBody](https://schema.org/articleBody) | [Text](https://schema.org/Text)  | The actual body of the Post. | NA
| WP-Core | [articleSection](https://schema.org/articleSection) | [Text](https://schema.org/Text) | Articles may belong to one or more 'categories' such as Sports, Lifestyle, etc. | NA
| WP-Core | [wordCount](https://schema.org/wordCount) | [Integer](https://schema.org/Integer) | 	The number of words in the text of the Post. | NA

### AdvertiserContentArticle

[AdvertiserContentArticle](https://schema.org/AdvertiserContentArticle "https://schema.org/AdvertiserContentArticle") type uses the related properties from the Article type.

### Report

[Report](https://schema.org/Report "https://schema.org/Report") type uses the related properties from the Article type.

### SatiricalArticle

[SatiricalArticle](https://schema.org/SatiricalArticle "https://schema.org/SatiricalArticle") type uses the related properties from the Article type.

### SocialMediaPosting

[SocialMediaPosting](https://schema.org/SocialMediaPosting "https://schema.org/SocialMediaPosting") type uses the related properties from the Article type.

### BlogPosting

[BlogPosting](https://schema.org/BlogPosting "https://schema.org/BlogPosting") type uses the related properties from the Article type.

### LiveBlogPosting

[LiveBlogPosting](https://schema.org/LiveBlogPosting "https://schema.org/LiveBlogPosting") type uses the related properties from the Article type.

### DiscussionForumPosting

[DiscussionForumPosting](https://schema.org/DiscussionForumPosting "https://schema.org/DiscussionForumPosting") type uses the related properties from the Article type.

### TechArticle

[TechArticle](https://schema.org/TechArticle "https://schema.org/TechArticle") type uses the related properties from the Article type.

## General Article properties

The related properties from the [Creative Work](https://schema.org/CreativeWork "https://schema.org/CreativeWork") type that matters to the project are:

| From | Property | Type | Description | Settings place |
| ---- | -------- |----- | ----------- | --------------
| WP-Core | [author](https://schema.org/author) | [Person](https://schema.org/Person) | The author of this Post.  | NA
| WP-Core | [dateCreated](https://schema.org/dateCreated) | [Date](https://schema.org/Date) | The date on which the Post was created. | NA
| WP-Core | [dateModified](https://schema.org/dateModified) | [Date](https://schema.org/Date)  | The date on which the Post was most recently modified. | NA
| WP-Core | [datePublished](https://schema.org/datePublished) | [Date](https://schema.org/Date) | Date of first Post. | NA
| WP-Core | [editor](https://schema.org/editor) | [Person](https://schema.org/Person) | The last user that modify this Post.  | NA
| WP-Core | [headline](https://schema.org/headline) | [Text](https://schema.org/Text) | Title of the Post. | NA
| WP-Core | [keywords](https://schema.org/keywords) | [Text](https://schema.org/Text) | 	Keywords or tags used to describe this content. Multiple entries in a keywords list are typically delimited by commas. | NA
| WP-Core | [publisher](https://schema.org/publisher) ([logo](https://schema.org/logo) [name]()) | [URL](https://schema.org/URL)/[Text](https://schema.org/Text) | By default the name of the domain is taken. If a SEO plugin is activated, it uses the Organization value.  | NA
---| WP-Core | [publisher](https://schema.org/publisher) | [Organization](https://schema.org/Organization) | By default the name of the domain is taken. If a SEO plugin is activated, it uses the Organization value.  | NA ---
| WP-Core | [thumbnailUrl](https://schema.org/thumbnailUrl) | [NA](https://schema.org/URL) | A thumbnail image relevant to the Post. | NA
articleBody
articleSelection
wordCount

The related properties from the [Thing](https://schema.org/Thing "https://schema.org/Thing") type that matters to the project are:

| From | Property | Type | Description | Settings place |
| ---- | -------- |----- | ----------- | --------------
| WP-Core | [image](https://schema.org/image) | [URL](https://schema.org/URL) | Featured image of the Post. *If no Featured image in the Post, user avatar will be the Post image.* | NA


# Screenshots
Settings site
![settings-post](/doc/images/settings-post.png)

Structured data
![structured-data-post](/doc/images/structured-data-post.png)

---

[Readme](//Readme.md)
