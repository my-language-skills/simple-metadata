# Metadata Properties relationships

## A - General

| Cod    | Field                  | LOM              | LRMI    | Schema               | DC
| ------ | ---------------------- | ---------------- | ------- | -------------------- | --
| A1-1   | Identifier: URI        | identifier       | NA      | NA                   | NA
| A1.1-1 |  └Catalog              | catalog          | --      | --                   | --
| A1.2-1 |  └Entry                | entry            | --      | --                   | DC.identifier
| A1-2   | Identifier: ISSN       | identifier       | NA      | issn (1)             | NA
| A1.1-2 |  └Catalog              | catalog          | --      | --                   | --
| A1.2-2 |  └Entry                | entry            | --      | --                   | DC.identifier
| A1-3   | Identifier: ISBN       | identifier       | NA      | isbn (2)             | NA
| A1.1-3 |  └Catalog              | catalog          | --      | --                   | --
| A1.2-3 |  └Entry                | entry            | --      | --                   | DC.identifier
| A1-4   | Identifier: eBook ISBN | identifier       | NA      | isbn (2)             | NA
| A1.1-4 |  └Catalog              | catalog          | --      | --                   | --
| A1.2-4 |  └Entry                | entry            | --      | --                   | DC.identifier
| A2-0   | Title                  | title            | --      | Headline             | DC.title
| A3-0   | Language               | language         | --      | inLanguage           | DC.language
| A4-0   | Description            | description      | --      | description          | DC.description
| A5-0   | Keyword                | keyword          | --      | keywords             | DC.subject (ARTICLESECTION SCHEMA)
| A6.1   | Coverage: place        | coverage         | --      | spatialCoverage      | DC.coverage
| A6.2   | Coverage: time         | coverage         | --      | temporalCoverage     | DC.coverage
| A7-0   | Structure              | structure        | --      | --                   | --
| A8-0   | Aggregation Level      | aggregationLevel | --      | --                   | --
| A9-0   | Content                | --               | --      | text/articleBody (3) | --
| A10-0  | Category               | --               | --      | articleSection (3)   | --
| A11-0  | Word Count             | --               | --      | WordCount (3)        | --
| A12-0  | Secondary Title        | --               | --      | alternativeHeadline  | --
| A13-0  | Family Friendly        | --               | --      | isFamilyFriendly     | --
| A14-0  | Position               | --               | --      | position             | --
| A15-0  | Publishing Principles  | --               | --      | publishingPrinciples | --
| A16-0  | Image                  | --               | --      | image                | --

1 WebSite; Blog
2 Book
3 Article

# Fields Definitions

## General
This category groups the general information that describes this resource as a whole.

| Source  | Field                   | Definitions | Values
| ------- | ----------------------- | ----------- | ------
| ------- | Identifier: URI         | Provide a name for the identification scheme and a unique value to identify the resource. | --
| ------- |  └Catalog               | Use the common abbreviation or the standard name for the identification scheme that is used to reference the resource. | `URI`
| ------- |  └Entry                 | Provide the actual value of the URN or identifier as derived from any specified identification scheme. | --
| ------- | Identifier: ISSN        | Provide a name for the identification scheme and a unique value to identify the resource. | --
| ------- |  └Catalog               | Use the common abbreviation or the standard name for the identification scheme that is used to reference the resource. | `ISSN`
| ------- |  └Entry                 | Provide the actual value of the ISSN. | --
| ------- | Identifier: ISBN        | Provide a name for the identification scheme and a unique value to identify the resource. | --
| ------- |  └Catalog               | Use the common abbreviation or the standard name for the identification scheme that is used to reference the resource. | `ISBN`
| ------- |  └Entry                 | Provide the actual value of the ISBN. | --
| ------- | Identifier: eBook ISBN  | Provide a name for the identification scheme and a unique value to identify the resource. | --
| ------- |  └Catalog               | Use the common abbreviation or the standard name for the identification scheme that is used to reference the resource. | `ISBN`
| ------- |  └Entry                 | Provide the actual value of the URN or identifier as derived from any specified identification scheme. | --
| ------- | Title                   | Name given to this resource.  | --
| ------- | Language                | Language or languages used within the resource to communicate to the intended user. | ISO 639
| ------- | Description             | Provide a neutral and concise yet thorough description of the resource. | --
| ------- | Keyword                 | Use the most specific terms that are descriptive of the subject covered by the resource. Use a separate keyword element for each term or phrase, avoiding lengthy phrases. | --
| ------- | Coverage: place         | Indicate the areas, regions, and/or jurisdictions covered by the content of the resource.  | --
| ------- | Coverage: time          | Indicate the time period covered by the content of the resource.  | --
| ------- | Structure               | Indicate the way in which the resource is logically related to other resources to form an aggregate or composite resource. | atomic, collection, networked, hierarchical, linear
| ------- | Aggregation Level       | Indicate the number of times that the resource or its component parts can be decomposed into still smaller components.  | 1, 2, 3, 4
| ------- | Family Friendly         | Indicates if the content is family friendly  | Yes or Not
| ------- | Position                | The position of the resource in a series or sequence of resources.  | --
| ------- | Publishing Principles   | Provie a document describing the editorial principles that relate to the activities as a publisher.   | --
| ------- | Content                 | The actual body of the resource.  | --
| ------- | Image                   | An image of the resource.  | --
| ------- | Secondary Title         | A secondary title of the resource.  | --
| ------- | Word Count              | --  | --

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
