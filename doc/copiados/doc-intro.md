# Simple Metadata

We're convinced that [structured data](https://developers.google.com/search/docs/guides/intro-structured-data) makes the web better, and we've worked hard to create [Rich Snippets](https://webmasters.googleblog.com/2009/05/introducing-rich-snippets.html) and [Rich Cards](https://webmasters.googleblog.com/2016/05/introducing-rich-cards.html) for better search results. Thanks to [metadata](https://www.youtube.com/watch?v=L9BqE01SLeE), the search engines can understand the relevance of that content in context. Simple Metadata is a complete solution for adding metadata to a Wordpress site.

* [Webmasters Rich Snippets FAQ](/doc/doc-faq.md)

## About Simple Metadata plugin

This is a plugin for the Wordpress CMS that can be used to add metadata on a website (single installation or multisite installation).

The aim of Simple Metadata is to accomplish a detailed description of the basic schema metadata for a WordPress installation.

This plugin is unbranded! This means that we don’t even put the name “Simple Metadata” anywhere within the WordPress interface, aside from the plugin activation page.
This plugin makes great use of the default WordPress interface elements, like as if this plugin is part of WordPress. No ads, no nags.

Nobody has to know about the tools you’ve used to create your or someone else’s website. A clean interface, for everyone.

Check [Installation, Integrations and Compatibilities](/doc/doc-general.md) for more information.

## What is not Simple Metadata

Is not a SEO solution. Schemas don’t actually boost the organic search rankings. With Schemas review ratings, recipes or events in Google’s [SERPs](https://moz.com/learn/seo/serp-features) (search engine results pages) are not just normal search listings but also contain additional information that makes the crawling easier. Those are known as rich snippets and they are thanks to schema markup. Rich snippets actually increase clickthrough rates. Schema may not directly improve your search rankings, but it can still be beneficial for your SEO.

## About Simple Metadata for Google
[Google Search](https://moz.com/blog/google-glossary) works hard to understand the content of a page. However, you can provide explicit clues about the meaning of a page to Google by including structured data on the page. [Structured Data](https://developers.google.com/search/docs/guides/intro-structured-data) is a standardized format for providing information about a page and classifying the page content; for example, if is it a recipe page, what are the ingredients, the cooking time and temperature, the calories, and so on.

Be sure to test your structured data using the [Structured Data Testing Tool](https://search.google.com/structured-data/testing-tool/u/0/) during development, and the [Search Console Structured Data report](https://www.google.com/webmasters/tools/structured-data?pli=1) after deployment, to monitor the health of your pages, which might break after deployment due to templating or serving issues.

### Schema
[Schema.org](http://schema.org/) is a collaborative, community activity with a mission to create, maintain, and promote schemas for [structured data](https://moz.com/learn/seo/schema-structured-data) on the Internet, on web pages, in email messages, and beyond.

Schema.org vocabulary can be used with many different encodings, including RDFa, Microdata and JSON-LD. These vocabularies cover entities, relationships between entities and actions, and can easily be extended through a well-documented extension model. Over 10 million sites use Schema.org to markup their web pages and email messages.

Founded by Google, Microsoft, Yahoo and Yandex, Schema.org vocabularies are developed by an open community process, using the public-schemaorg@w3.org mailing list and through [GitHub](https://github.com/schemaorg/schemaorg).

[How to Add Schema.org Markup to WordPress for Better SEO](https://premium.wpmudev.org/blog/schema-wordpress-seo/)

Currently we use the version 3.8.

(FUTURE: https://developers.google.com/gmail/markup/)

#### types

Schema.org organizes schemas in a hierarchy. This allows you to associate a schema with a content from a very broad perspective to a very specific one. The following discusses that.

**Thing**: Thing is the most generic type available. Most common thing properties: name, description, url, and image.

In the next level in the hierarchy, there are seven schemas. Each of which has more schemas. The following table gives a basic idea of these.

* **CreativeWork**	Specifies that the associated content is a creative work, for example, books, movies, photographs, software programs, etc.
* **Event**	Specifies that the associated content is an event happening at a certain time at a certain location.
* **Intangible**	Specifies that the associated content is about something intangible, like quantities, structured values, etc.
* **Organization**	Specifies that the associated content is about an organization like a School, a Club, a Corporate House etc.
* **Person**	Specifies that the associated content is about a person. He / she may be alive, dead or even fictional.
* **Place**	Specifies that the associated content is about a place. The place must be a fixed, physical entity.
* **Product**	Specifies that the associated content is about a product, anything which is sellable. For example a PC, an Apartment, A Car etc.

More specific types share properties with broader types. For example, a Place is a more specific type of Thing, and a LocalBusiness is a more specific type of Place. More specific items inherit the properties of their parent. (Actually, a LocalBusiness is a more specific type of Place and a more specific type of Organization, so it inherits properties from both parent types.)

We have a set of types, arranged in a multiple inheritance hierarchy where each type may be a sub-class of multiple types.

#### Properties

We have a set of properties:
* each property may have one or more types as its domains. The property may be used for instances of any of these types.
* each property may have one or more types as its ranges. The value(s) of the property should be instances of at least one of these types.

##### Expected Types, Text and URLs

When browsing the schema.org types, you will notice that many properties have "expected types". This means that the value of the property can itself be an embedded item (see section 1d: embedded items). But this is not a requirement—it's fine to include just regular text or a URL. In addition, whenever an expected type is specified, it is also fine to embed an item that is a child type of the expected type.

The value of the property can itself be an embedded item. But that is not mandatory. You can also have a child type embedded as expected type. For example, for a content, if the expected type is Event, you can use it's child type BusinessEvent if you find it appropriate.

## syntaxes

Syntaxes define attributes that get added to your existing HTML elements. You can mix them up as you like. (You could use both vocabularies with both syntaxes on the same page. You could use both vocabularies with only one syntax. You could use only one vocabulary with both syntaxes, or with only one syntax. …). It totally depends on your specific use case.

What do you want to achieve? If you are interested in a specific 3rd party parsing your content, you should check their documentation. They typically support only certain vocabularies with certain syntaxes.

But if you want to mark up your content with semantic metadata without having a specific use case in mind, you could stick to one syntax and use whichever vocabularies are appropriate for your content.

### Microdata

In the web context, [Microdata](https://html.spec.whatwg.org/multipage/microdata.html) is a WHATWG HTML specification for embedding semantically meaningful markup chiefly within the HTML body. Microdata isn’t the same thing as metadata, as microdata isn’t restricted to conveying only information about the creation of the text. Microdata becomes part of the web document itself and serves somewhat like an annotation within the HTML body text. Microdata tells machines something more about the meaning of the text.

Basically, microdata is an HTML specification that allows for the expression of other vocabularies, such as Schema.org, within a webpage.

By using Microdata, you are not directly playing part in the Semantic Web (and AFAIK Microdata doesn’t intend to), mostly because it’s not defined as RDF serialization (although there are ways to extract RDF from Microdata).

---
[Readme](/Readme.md)
