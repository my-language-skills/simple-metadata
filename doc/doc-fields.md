# Metadata Properties relationships

## A - General

| Cod    | Info                   | LOM (DELETE)     | LRMI    | Schema                                                                            | LOM              | DC
| ------ | ---------------------- | ---------------- | ------- | --------------------------------------------------------------------------------- | ---------------- | --
| A1-1   | Identifier: URI        | identifier       | NA      | NA                                                                                | identifier       | NA
| A1.1-1 |  └Catalog              | catalog          | --      | --                                                                                | catalog          | --
| A1.2-1 |  └Entry                | entry            | --      | --                                                                                | entry            | DC.identifier
| A1-2   | Identifier: ISSN       | identifier       | NA      | issn (1)                                                                          | identifier       | NA
| A1.1-2 |  └Catalog              | catalog          | --      | --                                                                                | catalog          | --
| A1.2-2 |  └Entry                | entry            | --      | --                                                                                | entry            | DC.identifier
| A1-3   | Identifier: ISBN       | identifier       | NA      | isbn (3)                                                                          | identifier       | NA
| A1.1-3 |  └Catalog              | catalog          | --      | --                                                                                | catalog          | --
| A1.2-3 |  └Entry                | entry            | --      | --                                                                                | entry            | DC.identifier
| A1-4   | Identifier: eBook ISBN | identifier       | NA      | isbn (3)                                                                          | identifier       | NA
| A1.1-4 |  └Catalog              | catalog          | --      | --                                                                                | catalog          | --
| A1.2-4 |  └Entry                | entry            | --      | --                                                                                | entry            | DC.identifier
| A2-0   | Title                  | title            | --      | [name](https://schema.org/name)                                                   | title            | DC.title
| A3-0   | Alternative title      | --               | --      | alternateName                                                                     | --               | --
| A4-0   | Headline               | --               | --      | [headline](https://schema.org/headline)                                           | --               | --
| A5-0   | Alternative Headline   | --               | --      | alternativeHeadline                                                               | --               | --
| A6-0   | Language               | language         | --      | [inLanguage](https://schema.org/inLanguage)                                       | language         | DC.language
| A7-0   | About                  | --               | --      | [about](https://schema.org/about)                                                 | --               | --
| A8-0   | Description            | description      | --      | description                                                                       | description      | DC.description
| A9-0   | Category               | --               | --      | articleSection (4)                                                                | --               | --
| A10-0  | Tag                    | keyword          | --      | [keywords](https://schema.org/keywords)                                           | keyword          | DC.subject (ARTICLESECTION SCHEMA)
| A11-0  | Genre                  | --               | --      | genre                                                                             | --               | --
| A12.1  | Coverage: place        | coverage         | --      | spatialCoverage                                                                   | coverage         | DC.coverage
| A12.2  | Coverage: time         | coverage         | --      | temporalCoverage                                                                  | coverage         | DC.coverage
| A13-0  | Structure              | structure        | --      | --                                                                                | structure        | --
| A14-0  | Aggregation Level      | aggregationLevel | --      | --                                                                                | aggregationLevel | --
| A15-0  | Family Friendly        | --               | --      | isFamilyFriendly                                                                  | --               | --
| A16-0  | Publishing Principles  | --               | --      | publishingPrinciples                                                              | --               | --
| A17-0  | Publisher              | --               | --      | [publisher](https://schema.org/publisher) ([logo](https://schema.org/logo) [name]()) | --               | --
| A18-0  | Author Organization    | --               | --      | sourceOrganization                                                                | --               | --
| A19-0  | Last reviewed          | --               | --      | [lastReviewed](https://schema.org/lastReviewed) (2)                               | --               | --
| A20-0  | Reviewed by            | --               | --      | [reviewebBy](https://schema.org/reviewebBy) (2)                                   | --               | --
| A21-0  | Author                 | --               | --      | [author](https://schema.org/author)                                               | --               | --
| A22-0  | Author last editor     | --               | --      | [author](https://schema.org/author)                                               | --               | --
| A23-0  | Editor                 | --               | --      | [editor](https://schema.org/editor)                                               | --               | --
| A24-0  | Date Created           | --               | --      | [dateCreated](https://schema.org/dateCreated)                                     | --               | --
| A25-0  | Dated Published        | --               | --      | [dateModified](https://schema.org/dateModified)                                   | --               | --
| A26-0  | Date Modified          | --               | --      | [datePublished](https://schema.org/datePublished)                                 | --               | --
| A27-0  | Order                  | --               | --      | position                                                                          | --               | -- xxxxxxxxxxxxx
| A28-0  | Primary image of page  | --               | --      | [primaryImageOfPage](https://schema.org/primaryImageOfPage) (2)                   | --               | --
| A29-0  | Thumbnail              | --               | --      | [thumbnailUrl](https://schema.org/thumbnailUrl)                                   | --               | --
| A30-0  | Image                  | --               | --      | [image](https://schema.org/image)                                                 | --               | --
| A31-0  | Content                | --               | --      | [Text](https://schema.org/Text)/[articleBody](https://schema.org/articleBody) (4) | --               | --
| A32-0  | Section                | --               | --      | [articleSection](https://schema.org/articleSection) (4)                           | --               | --
| A33-0  | Word Count             | --               | --      | [wordCount](https://schema.org/wordCount) (4)                                     | --               | --
| A34-0  | URL                    | --               | --      | [URL](https://schema.org/url)                                                     | --               | --

1 WebSite; Blog
2 WebPage
3 Book
4 Article

# Fields Definitions

## General
This category groups the general information that describes this resource as a whole.

| Cod    | Info                   | Definitions                                                                                                            | Values
| --     | ---------------------- | ---------------------------------------------------------------------------------------------------------------------- | ------
| A1-1   | Identifier: URI        | Provide a name for the identification scheme and a unique value to identify the resource.                              | --
| A1.1-1 |  └Catalog              | Use the common abbreviation or the standard name for the identification scheme that is used to reference the resource. | `URI`
| A1.2-1 |  └Entry                | Provide the actual value of the URN or identifier as derived from any specified identification scheme.                 | --
| A1-2   | Identifier: ISSN       | Provide a name for the identification scheme and a unique value to identify the resource.                              | --
| A1.1-2 |  └Catalog              | Use the common abbreviation or the standard name for the identification scheme that is used to reference the resource. | `ISSN`
| A1.2-2 |  └Entry                | Provide the actual value of the ISSN.                                                                                  | --
| A1-3   | Identifier: ISBN       | Provide a name for the identification scheme and a unique value to identify the resource.                              | --
| A1.1-3 |  └Catalog              | Use the common abbreviation or the standard name for the identification scheme that is used to reference the resource. | `ISBN`
| A1.2-3 |  └Entry                | Provide the actual value of the ISBN.                                                                                  | --
| A1-4 | Identifier: eBook ISBN   | Provide a name for the identification scheme and a unique value to identify the resource.                              | --
| A1.1-4 |  └Catalog              | Use the common abbreviation or the standard name for the identification scheme that is used to reference the resource. | `ISBN`
| A1.2-4 |  └Entry                | Provide the actual value of the URN or identifier as derived from any specified identification scheme.                 | --
| A2-0   | Title                  | Name given to this resource.                                                                                           | -- | [Text](https://schema.org/Text)
| A3-0   | Alternative title      | A secondary title of the resource.                                                                                     | --  
| A4-0   | Headline               | --                                                                                                                     | -- | [Text](https://schema.org/Text)
| A5-0   | Alternative Headline   | --                                                                                                                     | --
| A6-0   | Language               | Language or languages used within the resource to communicate to the intended user.                                    | ISO 639 | Text](https://schema.org/Text)
| A7-0   | About                  | --                                                                                                                     | -- | [Text](https://schema.org/Text)
| A8-0   | Description            | Provide a neutral and concise yet thorough description of the resource.                                                | --
| A9-0   | Category               | --                                                                                                                     | --
| A10-0  | Tag                    | Use the most specific terms that are descriptive of the subject covered by the resource. Use a separate tag element for each term or phrase, avoiding lengthy phrases. | -- | [Text](https://schema.org/Text)
| A11-0  | Genre                  | --                                                                                                                     | --
| A12.1  | Coverage: place        | Indicate the areas, regions, and/or jurisdictions covered by the content of the resource.                              | --
| A12.2  | Coverage: time         | Indicate the time period covered by the content of the resource.                                                       | --
| A13-0  | Structure              | Indicate the way in which the resource is logically related to other resources to form an aggregate or composite resource. | atomic, collection, networked, hierarchical, linear
| A14-0  | Aggregation Level      | Indicate the number of times that the resource or its component parts can be decomposed into still smaller components.  | 1, 2, 3, 4
| A15-0  | Family Friendly        | Indicates if the content is family friendly                                                                            | Yes or Not
| A16-0  | Publishing Principles  | Provie a document describing the editorial principles that relate to the activities as a publisher.                    | --
| A17-0  | Publisher              | --                                                                                                                     | -- | [URL](https://schema.org/URL) - [Text](https://schema.org/Text) or [Organization](https://schema.org/Organization)*
| A18-0  | Author Organization    | --                                                                                                                     | --
| A19-0  | Last reviewed          | --                                                                                                                     | -- | [Date](https://schema.org/Date)
| A20-0  | Reviewed by            | --                                                                                                                     | -- | [Person](https://schema.org/Person)
| A21-0  | Author                 | --                                                                                                                     | -- | [Person](https://schema.org/Person)
| A22-0  | Author last editor     | --                                                                                                                     | -- | [Person](https://schema.org/Person)
| A23-0  | Editor                 | --                                                                                                                     | -- | [Person](https://schema.org/Person)
| A24-0  | Date Created           | --                                                                                                                     | -- | [Date](https://schema.org/Date
| A25-0  | Dated Published        | --                                                                                                                     | -- | [Date](https://schema.org/Date
| A26-0  | Date Modified          | --                                                                                                                     | -- | [Date](https://schema.org/Date
| A27-0  | Order                  | The position of the resource in a series or sequence of resources.                                                     | --
| A28-0  | Primary image of page  | --                                                                                                                     | -- | [ImageObject](https://schema.org/ImageObject)
| A29-0  | Thumbnail              | A thumbnail image relevant to the resource.                                                                            | -- | [URL](https://schema.org/URL)
| A30-0  | Image                  | An image of the resource.                                                                                              | -- | [URL](https://schema.org/URL) or [ImageObject](https://schema.org/ImageObject)
| A31-0  | Content                | The actual body of the resource.                                                                                       | -- | [Text](https://schema.org/Text)
| A32-0  | Section                | --                                                                                                                     | -- | [Text](https://schema.org/Text)
| A33-0  | Word Count             | --                                                                                                                     | -- | [Integer](https://schema.org/Integer)
| A34-0  | URL                    | The URL of the page.                                                                                                   | -- | [URL](https://schema.org/URL)

* If a SEO plugin is activated, it uses the Organization value.

# Vocabulary recommendations

## General

**Catalog** Vocabulary Recommendations
* **URI Uniform Resource Identifier**: A character string used to identify a resource (such as a file) from anywhere on the Internet by type and location (URL).
* **ISBN International Standard Book Number**: The ISBN is a ten-digit number that is used to identify books and similar publications.
* **ISSN International Standard Serial Number**: The ISSN is an eight-digit number that identifies periodical publications, including electronic serials.

**Structure** Vocabulary Recommendations
* **atomic**: Any resource that is a raw media file or fragment, or corresponds with a level-1 resource as defined under Aggregation Level.
* **collection**: Any set of resources with no established relationships or defined links between them.
* **networked**: Any set of resources that are interrelated in a manner that is neither clearly hierarchical nor linear, or where relationships exist but are not clearly or consistently specified.
* **hierarchical**: Any set of resources that are interrelated with a logical tree structure, or which can be decomposed into resources that are themselves aggregate in nature.
* **linear**: Any set of resources that are interrelated as a single sequence.

**Aggregation Level**  Vocabulary Recommendations
* **1 (raw media data or fragments)** This value refers to any resource that cannot be further and easily decomposed into component resources. This level of granularity corresponds to the Asset category in the SCORM (1.3) Content Aggregation Model.
* **2 (a collection of level-1 learning objects)** This value includes Zip and other packages that can be accessed as individual files, where those files together form a single aggregate resource. It also includes a single Web page (or HTML file) that might incorporate one or more images. This level of granularity corresponds with, but is not limited to the SCO (Shareable Content Object) category in the SCORM (1.2) Content Aggregation Model.
* **3 (a collection of level-2 learning objects)** This value refers to resources that can be decomposed into two or more resources that are themselves collections of raw data or fragments. This level of aggregation would include a set of Web pages (or a Website), where one or more of those Web pages incorporates images or other resources.
Although the LOM provides the example of a course as corresponding to this level of aggregation, it is conceivable that a course may, in practice, consist of several third-level aggregations. This level of granularity corresponds, but is not limited, to the Content Aggregation category in the SCORM (1.3) Content Aggregation Model.
* **4 (the largest level of granularity)** This value simply refers to any resource that incorporates more than two levels of combination or aggregation. In this case, a level-4 resource would be a combination of other resources that are themselves not entirely decomposable into raw media fragments. A level-4 resource can also be a collection of other level-4 resources. These aggregations of multiple aggregate objects may compose, but are not limited to, courses or certificate
programs.

---

[Readme](/Readme.md)
