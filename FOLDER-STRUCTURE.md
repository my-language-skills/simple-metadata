# Folder structure
```
plugins/simple-metadata                                 # → Plugin root
├── admin                                               # → Admin folder
│   ├── index.php                                       # → Index file php
│   ├── smd-googleImage-box.php                         # → Google image Metabox file php
│   ├── smd-set-page-metaboxes.php                      # → Settings page Metaboxes file php
│   └── smd-site-cpt.php                                # → Custom post type site-meta file php
├── doc   
│   ├── copiados  
│   │   ├── doc-conf-page.md
│   │   ├── doc-conf-post.md
│   │   ├── doc-conf-site.md
│   │   ├── doc-faq.md
│   │   ├── doc-fields.md
│   │   ├── doc-general.md
│   │   ├── doc-intro.md
│   │   ├── doc-metadata-page.md
│   │   ├── doc-metadata.post.md
│   │   ├── doc-metadata.site.md
│   │   ├── doc-seo.md
│   │   ├── doc-settings-mu.md
│   │   └── doc-metadata.site.md
│   └── images
│       ├── settings-mu.png                                   
│       ├── settings-page.png                                   
│       ├── settings-post.png                                   
│       ├── settings-site.png                                   
│       ├── structured-data-page.png                                  
│       ├── structured-data-post.png                                   
│       └── structured-data-site.png                                   
├── inc                                                 # → Included functions folder
│   ├── assets                                          # → Assets folder
│   │    └── js                                         # → Javascript files folder
│   │         ├── simple-metadata-admin.js              # → Custom post type site-meta file js
│   │         ├── smd-googleImage-box.js                # → Google image Metabox file js
│   │         └── smd-logo-box.js                       # → Google image Metabox file js
│   ├── index.php                                       # → index file php
│   ├── smd-general-functions.php                       # → General functions file php
│   └── smd-uninstall-functions.php                     # → Unistall functions file php
├── languages                                           # → Internationalization folder
│   └── simple-metadata.pot                             # → Simple Metadata POT file
├── network-admin                                       # → Network admin folder
│   ├── index.php                                       
│   └── smd-network-admin.php                           # → Network admin file php
├── smd-frontpage-related-content                       # → Front page folder
│   ├── index.php                                       # → Index file php
│   └── smd-frontpage-related-content.php               # → Front page file php
├── smd-pages-related-content                           # → Pages folder
│   ├── index.php                                       # → Index file php
│   └── smd-pages-related-content.php                   # → Pages file php
├── smd-posts-related-content                           # → Posts folder
│   ├── index.php                                       # → Index file php
│   └── smd-posts-related-content.php                   # → Posts file php
├── symbionts                                           # → symbionts folder
│   ├── custom-metadata
│   │   ├── css   
│   │   │   ├── images
│   │   │   │   ├── calendar.png                             
│   │   │   │   ├── ui-bg_flat_0_aaaaaa_40x100.png                             
│   │   │   │   ├── ui-bg_flat_75_ffffff_40x100.png                              
│   │   │   │   ├── ui-bg_glass_55_fbf9ee_1x400.png
│   │   │   │   ├── ui-bg_glass_65_ffffff_1x400.png                              
│   │   │   │   ├── ui-bg_glass_75_dadada_1x400.png                               
│   │   │   │   ├── ui-bg_glass_75_e6e6e6_1x400.png                              
│   │   │   │   ├── ui-bg_glass_95_fef1ec_1x400.png                              
│   │   │   │   ├── ui-bg_highlight-soft_75_cccccc_1x100.png                              
│   │   │   │   ├── ui-icons_2e83ff_256x240.png                              
│   │   │   │   ├── ui-icons_222222_256x240.png                              
│   │   │   │   ├── ui-icons_454545_256x240.png                              
│   │   │   │   ├── ui-icons_888888_256x240                              
│   │   │   │   └── ui-icons_cd0a0a_256x240                              
│   │   │   ├── custom-metadata-manager.css                                    
│   │   │   ├── jquery-ui-smoothness.css                                     
│   │   │   ├── select2.css  
│   │   │   ├── select2.png  
│   │   │   ├── select2x2.png
│   │   │   └── spinner.gif  
│   │   ├── js  
│   │   │   ├── images
│   │   │   ├── custom-metadata-manager.js
│   │   │   ├── jquery-ui-timepicker.min.js
│   │   │   └── select2.min.js
│   │   └── custom_metadata.php                         # → Custom Metadata third party plugin
│   ├── index.php                                       # →
│   └── readme.md                                       # → Symbionts folder readme file
├── wp-assets
│   ├── banner-772x250.png
│   ├── banner-1544x500.png
│   ├── icon-128x128.png
│   └── icon-256x256.png
├── .editorconfig                                                                 
├── .gitattributes                                                                 
├── .gitignore
├── CHANGELOG.md                                        # → Detailed recopilation of changes
├── FOLDER-STRUCTURE.md                                     
├── index.php
├── LICENSE.md                                          # → License for GitHub
├── License.txt                                         # → License for WP
├── README.md                                           # → Readme file for GitHub
├── readme.txt                                          # → Readme file for WP
├── simple-metadata.php                                 # → Plugin file php
└── unistall.php                                        # → File css for all the css template
