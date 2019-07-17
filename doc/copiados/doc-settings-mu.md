# Multisite settings

The super-administrator have the same options as site-administrator. But, it will work in all child sites.

* Settings
	* [Site settings](/doc/doc-settings-site.md)
* Configuration
	* [Site configuration](/doc/doc-conf-site.md)



# Multisite settings

The super-administrator can decide over all the subsites several options:

In which places besides the home page (pages or posts) is possible to produce the General metadatada.

Which type apply in any child site (Blog, WebSite, Book or Course ).

If the installation will create just second languages educational resources, we can have a specific configuration.

In which places (public post types or home page) is possible to produce the Educational metadatada.

Also is possible to select which properties from any site-meta (book info in pressbooks) can be used in all the public post types (Post, Pages, CPTs) from their respective site.
By disabled, the selected field  is hide in page,post ect; but the information are in the database. If you disabled you have the posibility to delete all informations saved in the database ( multisite : delete all in each sites for the field ; single site : delete all info for the field for the site.
By local value, the value is printed from the site-meta, of the site; but in multisite, local value means that the choice it's not freeze for single site
By sharing, the value created in site-meta would be the default value in a new post (if the option is selected after a post is created, the value would be share just if the selected field is empty). By freezing, the values would be block and just sites administrators can write the values in the fields which will be share across the full post created or future created post of the installation.
