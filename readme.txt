=== Simple metadata ===
Contributors: colomet, danzhik 
Tags: wordpress, wordpress-plugin, timezone, multisite
Requires at least: 4.6
Tested up to: 4.9.8
Stable tag: 4.9.8
Requires PHP: 7.2.0
License: GPLv3
License URI: https://www.gnu.org/licenses/gpl-3.0.html

This plugin provides auto-generated metadata on the basis of default WP web-pages information.

== Description ==

This plugin provides the ability to set different types of schema types in one click (for Blogs and WebSites.

> By default:
> 
> a page is a WebPage type
> a Post is a BlogPosting type

== Front-page related content =

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

= Pages related content =

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

= Posts related content =

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

=== Works with ===
The SEO framework
Yoast SEO

=== Bug reports ===

Bug reports for Simple metadta are [welcomed on GitHub](https://github.com/my-language-skills/simple-metadata). Please note GitHub is not a support forum, and issues that aren't properly qualified as bugs will be closed.

=== Developers ===

[Simple metadata on GitHub](https://github.com/my-language-skills/simple-metadata)

== Installation ==

1. Upload the plugin files to the `/wp-content/plugins/simple-default-timezone` directory, or install the plugin 
through the WordPress plugins screen directly.
2. Activate the plugin through the 'Plugins' screen in WordPress
3. Access the plugins menu through the Clear Images menu page to use the plugin.

== Screenshots ==
 
1. Settings field in Network Settings
2. Disabled settings field in single-site settings

== Frequently Asked Questions ==

= What is structured data? =
We're convinced that [structured data](https://developers.google.com/search/docs/guides/intro-structured-data) makes the web better, and we've worked hard to create [Rich Snippets](https://webmasters.googleblog.com/2009/05/introducing-rich-snippets.html) and [Rich Cards](https://webmasters.googleblog.com/2016/05/introducing-rich-cards.html) for better search results. Thanks to [metadata](https://www.youtube.com/watch?v=L9BqE01SLeE), the search engines can understand the relevance of that content in context. Simple metadata is a complete solution for adding metadata to a Wordpress site.

= What is not Simple metadata =
Is not a SEO solution. Schemas don’t actually boost the organic search rankings. With Schemas review ratings, recipes or events in Google’s [SERPs](https://moz.com/learn/seo/serp-features) (search engine results pages) are not just normal search listings but also contain additional information that makes the crawling easier. Those are known as rich snippets and they are thanks to schema markup. Rich snippets actually increase clickthrough rates. Schema may not directly improve your search rankings, but it can still be beneficial for your SEO.

= How Google understand the content? =
[Google Search](https://moz.com/blog/google-glossary) works hard to understand the content of a page. However, you can provide explicit clues about the meaning of a page to Google by including structured data on the page. [Structured Data](https://developers.google.com/search/docs/guides/intro-structured-data) is a standardized format for providing information about a page and classifying the page content; for example, if is it a recipe page, what are the ingredients, the cooking time and temperature, the calories, and so on.

= Hot to test? =
Be sure to test your structured data using the [Structured Data Testing Tool](https://search.google.com/structured-data/testing-tool/u/0/) during development, and the [Search Console Structured Data report](https://www.google.com/webmasters/tools/structured-data?pli=1) after deployment, to monitor the health of your pages, which might break after deployment due to templating or serving issues.

= What is Schema.org? =
[Schema.org](http://schema.org/) is a collaborative, community activity with a mission to create, maintain, and promote schemas for [structured data](https://moz.com/learn/seo/schema-structured-data) on the Internet, on web pages, in email messages, and beyond.

Schema.org vocabulary can be used with many different encodings, including RDFa, Microdata and JSON-LD. These vocabularies cover entities, relationships between entities and actions, and can easily be extended through a well-documented extension model. Over 10 million sites use Schema.org to markup their web pages and email messages.

Founded by Google, Microsoft, Yahoo and Yandex, Schema.org vocabularies are developed by an open community process, using the public-schemaorg@w3.org mailing list and through [GitHub](https://github.com/schemaorg/schemaorg).

=  How can I find the FAQ page? =
[welcomed on GitHub](https://github.com/my-language-skills/simple-metadata)

https://github.com/my-language-skills/simple-metadata/blob/master/doc/doc-faq.md

== Changelog ==

1.0 Initial release.

 
== Upgrade Notice ==
