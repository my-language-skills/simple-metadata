# Folder structure
```
plugins/simple-metadata                                                         # → Plugin root
├── admin                                                                       # → Admin folder
│   ├── index.php                                                               # → Index file php
│   ├── smd-googleImage-box.php                                                 # → Google image Metabox file php
│   ├── smd-set-page-metaboxes.php                                              # → Settings page Metaboxes file php
│   └── smd-site-cpt.php                                                        # → Custom post type site-meta file php
├── doc                                                                         # → Doc folder
│   ├── copiados                                                                # → Copiados folder  
│   │   ├── doc-conf-page.md                                                    # → Page file md
│   │   ├── doc-conf-post.md                                                    # → Post file md
│   │   ├── doc-conf-site.md                                                    # → Site file md
│   │   ├── doc-faq.md                                                          # → Faq file md
│   │   ├── doc-fields.md                                                       # → Fields file md
│   │   ├── doc-general.md                                                      # → General file md
│   │   ├── doc-intro.md                                                        # → Intro file md
│   │   ├── doc-metadata-page.md                                                # → Metadata page file md
│   │   ├── doc-metadata.post.md                                                # → Metadata post file md
│   │   ├── doc-metadata.site.md                                                # → Metadata site file md
│   │   ├── doc-seo.md                                                          # → Seo file md
│   │   ├── doc-settings-mu.md                                                  # → Settings mu file md
│   │   └── doc-metadata.site.md                                                # → Metadata site file md
│   └── images                                                                  # → Images folder
│       ├── settings-mu.png                                                     # → Settings mu file png
│       ├── settings-page.png                                                   # → Settings page file png
│       ├── settings-post.png                                                   # → Settings post file png        
│       ├── settings-site.png                                                   # → Settings site file png        
│       ├── structured-data-page.png                                            # → Structured data page file png              
│       ├── structured-data-post.png                                            # → Structured data post file png               
│       └── structured-data-site.png                                            # → Structured data site file png
├── inc                                                                         # → Included functions folder
│   ├── assets                                                                  # → Assets folder
│   │    └── js                                                                 # → Javascript files folder
│   │         ├── simple-metadata-admin.js                                      # → Simple metadata admin file js
│   │         ├── smd-googleImage-box.js                                        # → Google image Metabox file js
│   │         └── smd-logo-box.js                                               # → Google image Metabox file js
│   ├── index.php                                                               # → Empty index file php
│   ├── smd-general-functions.php                                               # → General functions file php
│   └── smd-uninstall-functions.php                                             # → Unistall functions file php
├── languages                                                                   # → Languages folder
│   └── simple-metadata.pot                                                     # → Simple Metadata POT file
├── network-admin                                                               # → Network admin folder
│   ├── index.php                                                               # → Empty index file php
│   └── smd-network-admin.php                                                   # → Network admin file php
├── smd-frontpage-related-content                                               # → Front page folder
│   ├── index.php                                                               # → Empty index file php
│   └── smd-frontpage-related-content.php                                       # → Front page file php
├── smd-pages-related-content                                                   # → Pages folder
│   ├── index.php                                                               # → Empty index file php
│   └── smd-pages-related-content.php                                           # → Pages file php
├── smd-posts-related-content                                                   # → Posts folder
│   ├── index.php                                                               # → Empty index file php
│   └── smd-posts-related-content.php                                           # → Posts file php
├── symbionts                                                                   # → symbionts folder
│   ├── custom-metadata                                                         # → Custom metadata folder
│   │   ├── css                                                                 # → Css folder
│   │   │   ├── images                                                          # → Images folder
│   │   │   │   ├── calendar.png                                                # → Calendar file png     
│   │   │   │   ├── ui-bg_flat_0_aaaaaa_40x100.png                              # → Bg flat file png                      
│   │   │   │   ├── ui-bg_flat_75_ffffff_40x100.png                             # → Bg flat file png    
│   │   │   │   ├── ui-bg_glass_55_fbf9ee_1x400.png                             # → Bg glass file png
│   │   │   │   ├── ui-bg_glass_65_ffffff_1x400.png                             # → Bg glass file png
│   │   │   │   ├── ui-bg_glass_75_dadada_1x400.png                             # → Bg glass file png
│   │   │   │   ├── ui-bg_glass_75_e6e6e6_1x400.png                             # → Bg glass file png
│   │   │   │   ├── ui-bg_glass_95_fef1ec_1x400.png                             # → Bg glass file png
│   │   │   │   ├── ui-bg_highlight-soft_75_cccccc_1x100.png                    # → Bg highlight soft file png          
│   │   │   │   ├── ui-icons_2e83ff_256x240.png                                 # → Icons file png
│   │   │   │   ├── ui-icons_222222_256x240.png                                 # → Icons file png
│   │   │   │   ├── ui-icons_454545_256x240.png                                 # → Icons file png
│   │   │   │   ├── ui-icons_888888_256x240                                     # → Icons file png
│   │   │   │   └── ui-icons_cd0a0a_256x240                                     # → Icons file png
│   │   │   ├── custom-metadata-manager.css                                     # → Custom metadata manager file css
│   │   │   ├── jquery-ui-smoothness.css                                        # → Jquery file css
│   │   │   ├── select2.css                                                     # → Select2 file css
│   │   │   ├── select2.png                                                     # → Select2 file png
│   │   │   ├── select2x2.png                                                   # → Select2x2 file png
│   │   │   └── spinner.gif                                                     # → Spinner file gif
│   │   ├── js                                                                  # → Js folder
│   │   │   ├── images                                                          # → Images folder
│   │   │   ├── custom-metadata-manager.js                                      # → Custom metadata manager file js
│   │   │   ├── jquery-ui-timepicker.min.js                                     # → Jquery ui timepicker file js
│   │   │   └── select2.min.js                                                  # → Select2 file js
│   │   └── custom_metadata.php                                                 # → Custom Metadata third party plugin
│   ├── index.php                                                               # → Empty index file php
│   └── readme.md                                                               # → Symbionts folder readme file md
├── wp-assets                                                                   # → Wp assets folder
│   ├── banner-772x250.png                                                      # → Banner file png
│   ├── banner-1544x500.png                                                     # → Banner file png
│   ├── icon-128x128.png                                                        # → Icon file png
│   └── icon-256x256.png                                                        # → Icon file png
├── .editorconfig                                                               # →   
├── .gitattributes                                                              # →    
├── .gitignore                                                                  # →
├── CHANGELOG.md                                                                # → Detailed recopilation of changes file md
├── FOLDER-STRUCTURE.md                                                         # → Folder structure file md
├── index.php                                                                   # → Empty index file php
├── LICENSE.md                                                                  # → License for GitHub
├── License.txt                                                                 # → License for WP
├── README.md                                                                   # → Readme file for GitHub
├── readme.txt                                                                  # → Readme file for WP
├── simple-metadata.php                                                         # → Plugin file php
└── unistall.php                                                                # → Unistall file php
