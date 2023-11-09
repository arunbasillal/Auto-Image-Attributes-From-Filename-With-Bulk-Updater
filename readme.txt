=== Auto Image Attributes From Filename With Bulk Updater (Add Alt Text, Image Title For Image SEO) ===
Contributors: arunbasillal
Donate link: https://imageattributespro.com/?utm_source=wordpress.org&utm_medium=donate-link
Tags: image title, image caption, image description, alt text, bulk edit images, bulk rename images, auto image attributes, auto image alt text, remove underscores, image seo
Requires at least: 3.5.0
Tested up to: 6.4.1
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Automatically Add Image Title, Caption, Description And Alt Text From Filename. Includes a bulk updater to update existing images in the Media Library. Great for Image SEO.

== Description ==

Automatically add Image attributes such as Image Title, Image Caption, Description And Alt Text from Image Filename. 

The plugin can update image attributes for both new images and existing images in the media library. 

https://www.youtube.com/watch?v=V5SOU4okOfU

Image alt text and title is critical for your image SEO and will help users discover your images (and there by your website) in Google / Yahoo / Bing image search. 

> **Life-Saver**
> It allowed me to save tons of time. Further, the support is nice and ready to help.
> - [thnk4](https://wordpress.org/support/topic/life-saver-188/)

Proper alt text also helps people who are blind or who have low vision understand your images there by improving the accessibility of your website. This will open up your website to a new segment of visitors and increase your traffic.

> **Wow!**
> If I could give this 1 more star I would!
> - [jdev](https://wordpress.org/support/topic/wow-550/)

With this plugin you can:

* Set the image filename as the image Title.
* Set the image filename as the image Caption.
* Set the image filename as the image Description.
* Set the image filename as the image Alt Text. This was a default feature in WordPress before 4.7. The plugin restores this essential feature which is great for SEO.
* Insert Image Title into post HTML. WordPress stopped adding Image Titles to images since WordPress 3.5. The plugin restores it.
* Remove hyphens from the image filename.
* Remove underscores from the image filename.
* Remove full stops from filename.
* Remove commas from filename.
* Remove all numbers from filename.
* Choose to turn off any of the above mentioned features.
* Display image attributes as columns in Media Library list view.

With the bulk updater you can: 

* Set the image filename as image Title, Caption, Description and Alt Text after removing hyphens and underscores from the filename.
* Update any number of images in your Media Library in one click.

If your image filename is *My_image-name.jpg*, your Image Title, Caption, Description And Alt Text will be *My image name*. 

The plugin settings and bulk updater are in WordPress Admin > Settings > Image Attributes. Here you can choose which attributes to update for NEW uploads. 

**Please remember to take a database backup before running the bulk updater (or anything bulk in general). The bulk updater updates ALL attributes for existing images in the Media Library and ignores the settings set for NEW uploads.**

## Image Attributes Pro

A pro add-on is now available for the plugin. Check out [Image Attributes Pro](https://imageattributespro.com/?utm_source=wordpress.org&utm_medium=readme).

The pro add-on can update the image attributes from not just the image filename, but also from the post / page / product / custom post type title. You can fine tune the bulk updater settings and even clean up the actual image filename. 

> Thank you so much for all your help in trying to fix this, its very much appreciated indeed. You've gone above and beyond what I was expecting in support!
> Rest assured I will give great feedback on your plugin anywhere I can!!
> - **James Barber**, for [Image Attributes Pro](https://imageattributespro.com/?utm_source=wordpress.org&utm_medium=readme) via email.

**What the pro add-on you get these additional features:**

* Use post title as title text. If image is not attached to a post, image filename will be used instead.
* Use post title as alt text. If image is not attached to a post, image filename will be used instead.
* Use post title as caption. If image is not attached to a post, image filename will be used instead.
* Use post title as description. If image is not attached to a post, image filename will be used instead.
* Build your own attributes using custom tags like `%filename%`, `%posttitle%`, `%sitetitle%`, `%category%`, `%tag%`, `%yoastfocuskw%`, `%yoastseotitle%`, `%rankmathfocuskw%`, `%seopresstargetkw%` and [many more](https://imageattributespro.com/custom-image-attribute-tags/?utm_source=wordpress.org&utm_medium=readme). Each custom tag will be replaced  with it's value. You can combine them as you please!
* Use Yoast Focus Keyword and Rank Math Focus Keyword as image attributes.
* Clear any image attribute by setting it as blank / empty. 
* Exclude images from Bulk Updater. A meta box and a checkbox is added to the `Media Library` > `Edit Media` sidebar. When checked, the bulk updater will not update the attributes of that image in the media library or in posts / products where the image is used. 
* Remove apostrophe ( ' ) from filename
* Remove tilde ( ~ ) from filename
* Remove plus ( + ) from filename
* Remove pound ( # ) from filename
* Remove ampersand ( & ) from filename
* Remove round brackets ( ( ) ) from filename
* Remove square brackets ( [ ] ) from filename
* Remove curly brackets ( { } ) from filename
* Filter words or characters from filename
* Filter filename with regex
* convert image attributes to lowercase
* CONVERT IMAGE ATTRIBUTES TO UPPERCASE
* Use title casing for image attributes. First Letter Of Each Word Will Be Capitalized.
* Use sentence casing for image attributes. First letter of a sentence will be capitalized.
* Clean the actual image filename after upload.
* Choose to turn off any of the above mentioned features.

**With the Image Attributes Pro bulk updater you can:**

* Update image title and alt text **for images inserted into posts and custom post types**. Not just the media library. [What is the difference?](https://imageattributespro.com/how-wordpress-store-image-attributes/?utm_source=wordpress.org&utm_medium=readme)
* Fine tune all settings. Choose what to update.
* Update image titles / alt text in media library and / or existing posts.
* Update image titles / alt text in media library and / or existing posts only if no title / alt text is set. Existing image titles / alt text will be preserved.
* Update image caption and description in the media library. Existing image captions and descriptions can be preserved.
* Build your own attributes using custom tags like `%filename%`, `%posttitle%`, `%sitetitle%`, `%category%`, `%tag%`, `%yoastfocuskw%`, `%yoastseotitle%`, `%rankmathfocuskw%`, `%seopresstargetkw%` and [many more](https://imageattributespro.com/custom-image-attribute-tags/?utm_source=wordpress.org&utm_medium=readme). Each custom tag will be replaced  with it's value. You can combine them as you please!
* Choose to turn off any of the above mentioned features.
* Bulk update image attributes in [ACF's WYSIWYG Editor](https://imageattributespro.com/acf-compatibility/?utm_source=wordpress.org&utm_medium=readme) and [Divi theme](https://imageattributespro.com/divi-compatibility/?utm_source=wordpress.org&utm_medium=readme).
* Modify auto generated image attributes using the [iaffpro_image_attributes filter](https://imageattributespro.com/codex/iaffpro_image_attributes/?utm_source=wordpress.org&utm_medium=readme).
* Choose specific post types to bulk update using the [iaffpro_included_post_types filter](https://imageattributespro.com/codex/iaffpro_included_post_types/?utm_source=wordpress.org&utm_medium=readme).
* Disable updating of attributes in media library completely and just updated attributes in Post HTML or vice versa.
* Add or remove custom image attributes using the [iaffpro_html_image_markup_post_update filter](https://imageattributespro.com/codex/iaffpro_html_image_markup_post_update/?utm_source=wordpress.org&utm_medium=readme)

**Other Image Attributes Pro features:**

* Bulk edit image attributes from the Media Library quickly and easily. [Read more.](https://imageattributespro.com/media-library-bulk-editing/?utm_source=wordpress.org&utm_medium=readme)
* Bulk Update image attributes from WordPress Media Library. Select images and choose `Update image attributes` Bulk action in Media Library (list view). [Read more.](https://imageattributespro.com/bulk-actions/?utm_source=wordpress.org&utm_medium=readme)
* Bulk Update image attributes from WordPress admin page for Posts, Pages and WooCommerce Products. Select the posts, pages or WooCommerce products in bulk and choose "Update image attributes" Bulk action. [Read more.](https://imageattributespro.com/bulk-actions/?utm_source=wordpress.org&utm_medium=readme)
* Copy image attributes to post HTML while updating in Media Library. Any changes made to image attributes in the media library will be automatically synced to the corresponding post HTML. [Read more.](https://imageattributespro.com/auto-copy-image-attributes-to-post-html-from-media-library/?utm_source=wordpress.org&utm_medium=readme)
* Update image attributes on post publish or update. Automatically updates image attributes when a post is published or updated. Ensures image attributes are always consistent with settings. [Read more.](https://imageattributespro.com/update-image-attributes-on-save-post/?utm_source=wordpress.org&utm_medium=readme)

For screenshots, FAQ and full list of features, please see the [product website](https://imageattributespro.com/?utm_source=wordpress.org&utm_medium=readme).

> **No Competitors**
> This is the only one that enables you to add missing tags to your images in one go, simple! ... This one is very well coded and the author pays great attentions to users feedback / requests / support. 
> - [arsenalemusica](https://wordpress.org/support/topic/no-competitors/)

== Installation ==

To install this plugin:

1. Install the plugin through the WordPress admin interface, or upload the plugin folder to /wp-content/plugins/ using ftp.
2. Activate the plugin through the 'Plugins' screen in WordPress.
3. Go to WordPress Admin > Settings > Image Attributes.

== Frequently Asked Questions ==

= Will this plugin update existing images in the media library? =

Yes, the plugin will update image Title, Caption, Description And Alt Text from the image filename for both existing images in the media library and new uploads.

= I need more features. Can I hire you? =

Please checkout the [Image Attributes Pro add-on](https://imageattributespro.com/?utm_source=wordpress.org&utm_medium=readme) to see if it suits your requirement. If not, please [send in a feature request](https://imageattributespro.com/contact/?utm_source=wordpress.org&utm_medium=faq-feature-request) with a brief description of your requirement and I will be in touch shortly.

= This plugin saved me a lot of time, how can I show my appreciation? =

I am glad to hear that! You can either [upgrade to pro](https://imageattributespro.com/?utm_source=wordpress.org&utm_medium=readme-faq) or leave a [rating](https://wordpress.org/support/plugin/auto-image-attributes-from-filename-with-bulk-updater/reviews/?rate=5#new-post) to motivate me to keep working on the plugin. 

== Screenshots ==

1. The settings page in WordPress Admin > Settings > Image Attributes with default settings.
2. Preview of the Advanced settings screen. Seen only when the preview is enabled.
2. Preview of the Bulk Updater settings screen. Seen only when the preview is enabled.
4. Bulk Updater
5. Image attributes displayed in the Media Library as columns.

== Changelog ==

= 4.4 =
* Date: 09.November.2023.
* Tested with WordPress 6.4.1.
* New Feature: Display image attributes in the Media Library columns (list view) to easily read image attributes without opening each image. Image Attributes Pro let's you edit image attributes from the Media Library in bulk. [Read more.](https://imageattributespro.com/media-library-bulk-editing/?utm_source=wordpress.org&utm_medium=changelog)
* Enhancement: Activate Image Attributes Pro from plugin sidebar if pro plugin is installed.
* UI Enhancement: Improved placeholder text in settings text boxes and made them lighter to avoid confusion.

= 4.3.1 =
* Date: 25.April.2023.
* Bug Fix: Fix a bug where trailing commas were used with unset and function calls. This is unsupported in PHP versions older than 7.3.

= 4.3 =
* Date: 25.April.2023.
* Enhancement: Compatibility with Image Attributes Pro version 4.3. [Check what's new in 4.3](https://imageattributespro.com/changelog/?utm_source=wordpress.org&utm_medium=changelog).
* Bug Fix: Fixed an issue where non English characters in image filename were not being read correctly. This fix will resolve such issues for new uploads going forward. Since information is already lost when WordPress sanitize the filename, there is no way to recover it once the image upload is complete.

= 4.2 =
* Date: 28.March.2023.
* Tested with WordPress 6.2.
* Enhancement: `!IMPORTANT!` Files were renamed and moved around for better organization. If you see any PHP errors, it should be temporary and deactivating and activation the plugin should fix it.
* Enhancement: Compatibility with Image Attributes Pro version 4.2. [Check what's new in 4.2](https://imageattributespro.com/changelog/?utm_source=wordpress.org&utm_medium=changelog).
* I18n: Plugin is translated to [Ukrainian](https://translate.wordpress.org/locale/uk/default/wp-plugins/auto-image-attributes-from-filename-with-bulk-updater/) thanks to [@kleindberg](https://profiles.wordpress.org/kleindberg/).

= 4.1 =
* Date: 01.February.2023.
* Enhancement: Compatibility with Image Attributes Pro version 4.1. [Check what's new in 4.1](https://imageattributespro.com/changelog/?utm_source=wordpress.org&utm_medium=changelog).

= 4.0 =
* Date: 13.December.2022.
* Tested with WordPress 6.1.1.
* Enhancement: Compatibility with Image Attributes Pro version 4.0. [Check what's new in 4.0](https://imageattributespro.com/changelog/?utm_source=wordpress.org&utm_medium=changelog).

= 3.3 =
* Date: 10.November.2022.
* Tested with WordPress 6.1.
* Enhancement: Compatibility with Image Attributes Pro version 3.2. [Check what's new in 3.2](https://imageattributespro.com/changelog/?utm_source=wordpress.org&utm_medium=changelog).
* Bug Fix: Fixed a UI issue where the buttons for Custom Attribute Tags were not working in certain cases.
* I18n: Plugin is translated to Polish thanks to Robert from [RobertLajka.pl](https://robertlajka.pl/).

= 3.2 =
* Date: 27.April.2022.
* Tested with WordPress 5.9.3.
* Enhancement: Log message for `Skip Image` button now specifies which image is skipped and links to the `Edit Media` page for that image.

= 3.1 =
* Date: 24.March.2022.
* Tested with WordPress 5.9.2.
* New Feature: Added `Skip Image` button for the Bulk Updater. Useful during troubleshooting. [Read more.](https://imageattributespro.com/fix-bulk-updater-stuck-on-same-image/?utm_source=wordpress.org&utm_medium=changelog)
* Enhancement: Compatibility with Image Attributes Pro version 3.0. [Check what's new in 3.0.](https://imageattributespro.com/changelog/?utm_source=wordpress.org&utm_medium=changelog)

= 3.0 =
* Date: 19.January.2022.
* Tested with WordPress 5.8.3.
* Enhancement: Removed "Global Switch" option as part of cleaning up the user interface. This option was redundant and the same can be accomplished either by deactivating the plugin or by disabling every option in "General Settings". Please take a note of this change if you have disabled "Global Switch" on your website.
* UI Enhancement: Added description text to clarity settings to improve usability. 
* UI Enhancement: Added [demo video link](https://imageattributespro.com/demo/?utm_source=wordpress.org&utm_medium=changelog) in plugin settings page. 

= 2.1 =
* Date: 02.July.2021.
* Enhancement: Compatibility with Image Attributes Pro v2.0. 

= 2.0 =
* Date: 18.June.2021.
* Tested with WordPress 5.7.2.
* UI Enhancement: Changed order of `General Settings` to match the order in `Media Library`. 
* UI Enhancement: Changed the word `attached` to `uploaded` in `If image is not attached to a post, image filename will be used instead` for better clarity. 
* I18n: More strings are now translation ready, thanks to [@alexclassroom](https://profiles.wordpress.org/alexclassroom/).

= 1.6 =
* Date: 06.January.2019.
* Tested with WordPress 5.0.2. 
* Enhancement: Improved bulk updater warning and inline documentation. 
* Bug Fix: Fixed a bug that ignored the setting for inserting image title into the post HTML. Thanks [@jamesryancooper](https://wordpress.org/support/topic/image-title-being-inserted-even-with-checkbox-unselected/)

= 1.5 =
* Date: 06.May.2018.
* Enhancement: Changed text domain from abl_iaff_td to auto-image-attributes-from-filename-with-bulk-updater to make the plugin translation ready in translate.wordpress.org.
* Enhancement: Code improvements.
* Enhancement: Added an activation notice with link to the settings page for better on-boarding experience. 

= 1.4 =
* Date: 22.November.2017.
* NEW: Global switch to enable or disable the plugin.
* NEW: Test button.
* NEW: Stop Bulk Updater button.
* NEW: Support tab.
* Improvement: Changed source of filename from guid to wp_get_attachment_url() to prevent conflicts with other plugins. GUID was being replaced by other plugins. Thanks to @niresh12495 for [bringing this up] (https://wordpress.org/support/topic/image-title-description-and-alt-tag-replaced-with-attachment-idnumber/).
* Impreovement: Added checks to check if attachment is image before processing.
* FIX: Added [boolval() function for backwards compatibility](https://millionclues.com/wordpress-tips/solved-fatal-error-call-to-undefined-function-boolval/) with servers with PHP older than PHP 5.5. 
* Added preview of premium options that ship with [Image Attributes Pro](https://imageattributespro.com/docs?utm_source=wordpress.org&utm_medium=changelog)
* UI Improvements.
* Code improvements.

= 1.3 =
* Date: 17.August.2017.
* Improved the architecture of the plugin laying foundation for future updates. Utilizing my [starter plugin framework](http://millionclues.com/lab/wordpress-starter-plugin-a-framework-for-quick-plugin-development/)
* Bug fix: For images that had EXIF data, EXIF data was used instead of filename. Props to @mathieupellegrin for reporting this. 
* NEW: Added option to Insert Image Title into HTML. WordPress stopped including image titles since 3.5. Code from [Restore Image Title](https://wordpress.org/plugins/restore-image-title/) plugin was used. 
* NEW: Remove full stops ( . ) from filename.
* NEW: Remove commas ( , ) from filename.
* NEW: Remove all numbers ( 0-9 ) from filename.
* NEW: Added a warning and user confirmation before while clicking "Run Bulk Updater" button to prevent accidental clicks.
* UI Improvement: Cleaned up the interface and moved the Bulk Updater to its own tab. 
* UI Improvement: Bulk updater log is now displayed in a neat box instead of just printing the results on the page. 
* Parts of the code was updated for more efficiency and faster processing. 
* Tested on WordPress 4.8.1. Result = pass.

= 1.2 =
* Date: 15.July.2017.
* Added: Character filter options. Plugin now removes hyphens and underscores.
* Bug Fix: Minor bug fix.

= 1.1 =
* Date: 4.July.2017.
* Added: Options to choose individual image attributes for NEW uploads. 

= 1.0 =
* Date: 4.July.2017.
* First release of the plugin.

== Upgrade Notice ==

= 4.4 =
* Date: 09.November.2023.
* Tested with WordPress 6.4.1.
* New Feature: Display image attributes in the Media Library columns (list view) to easily read image attributes without opening each image. Image Attributes Pro let's you edit image attributes from the Media Library in bulk. [Read more.](https://imageattributespro.com/media-library-bulk-editing/?utm_source=wordpress.org&utm_medium=changelog)
* Enhancement: Activate Image Attributes Pro from plugin sidebar if pro plugin is installed.
* UI Enhancement: Improved placeholder text in settings text boxes and made them lighter to avoid confusion.

= 4.3.1 =
* Date: 25.April.2023.
* Bug Fix: Fix a bug where trailing commas were used with unset and function calls. This is unsupported in PHP versions older than 7.3.

= 4.3 =
* Date: 25.April.2023.
* Enhancement: Compatibility with Image Attributes Pro version 4.3. [Check what's new in 4.3](https://imageattributespro.com/changelog/?utm_source=wordpress.org&utm_medium=changelog).
* Bug Fix: Fixed an issue where non English characters in image filename were not being read correctly. This fix will resolve such issues for new uploads going forward. Since information is already lost when WordPress sanitize the filename, there is no way to recover it once the image upload is complete.

= 4.2 =
* Date: 28.March.2023.
* Tested with WordPress 6.2.
* Enhancement: `!IMPORTANT!` Files were renamed and moved around for better organization. If you see any PHP errors, it should be temporary and deactivating and activation the plugin should fix it.
* Enhancement: Compatibility with Image Attributes Pro version 4.2. [Check what's new in 4.2](https://imageattributespro.com/changelog/?utm_source=wordpress.org&utm_medium=changelog).
* I18n: Plugin is translated to [Ukrainian](https://translate.wordpress.org/locale/uk/default/wp-plugins/auto-image-attributes-from-filename-with-bulk-updater/) thanks to [@kleindberg](https://profiles.wordpress.org/kleindberg/).

= 4.1 =
* Date: 01.February.2023.
* Enhancement: Compatibility with Image Attributes Pro version 4.1. [Check what's new in 4.1](https://imageattributespro.com/changelog/?utm_source=wordpress.org&utm_medium=changelog).

= 4.0 =
* Date: 13.December.2022.
* Tested with WordPress 6.1.1.
* Enhancement: Compatibility with Image Attributes Pro version 4.0. [Check what's new in 4.0](https://imageattributespro.com/changelog/?utm_source=wordpress.org&utm_medium=changelog).

= 3.3 =
* Date: 10.November.2022.
* Tested with WordPress 6.1.
* Enhancement: Compatibility with Image Attributes Pro version 3.2. [Check what's new in 3.2](https://imageattributespro.com/changelog/?utm_source=wordpress.org&utm_medium=changelog).
* Bug Fix: Fixed a UI issue where the buttons for Custom Attribute Tags were not working in certain cases.
* I18n: Plugin is translated to Polish thanks to Robert from [RobertLajka.pl](https://robertlajka.pl/).

= 3.2 =
* Date: 27.April.2022. 
* Tested with WordPress 5.9.3. 
* Enhancement: Log message for `Skip Image` button now specifies which image is skipped and links to the `Edit Media` page for that image. 

= 3.1 =
* Date: 24.March.2022. 
* Tested with WordPress 5.9.2. 
* New Feature: Added 'Skip Image' button for the Bulk Updater. Useful during troubleshooting. [Read more.](https://imageattributespro.com/fix-bulk-updater-stuck-on-same-image/?utm_source=wordpress.org&utm_medium=changelog) 
* Enhancement: Compatibility with Image Attributes Pro version 3.0. [Check what's new in 3.0.](https://imageattributespro.com/changelog/?utm_source=wordpress.org&utm_medium=changelog)

= 3.0 =
* Date: 19.January.2022.
* Tested with WordPress 5.8.3.
* Enhancement: Removed "Global Switch" option as part of cleaning up the user interface. This option was redundant and the same can be accomplished either by deactivating the plugin or by disabling every option in "General Settings". Please take a note of this change if you have disabled "Global Switch" on your website.
* UI Enhancement: Added description text to clarity settings to improve usability. 
* UI Enhancement: Added [demo video link](https://imageattributespro.com/demo/?utm_source=wordpress.org&utm_medium=changelog) in plugin settings page. 

= 2.1 =
* Date: 02.July.2021.
* Enhancement: Compatibility with Image Attributes Pro v2.0. 

= 2.0 =
* Tested with WordPress 5.7.2.
* UI Enhancement: Changed order of `General Settings` to match the order in `Media Library`. 
* UI Enhancement: Changed the word `attached` to `uploaded` in `If image is not attached to a post, image filename will be used instead` for better clarity. 
* I18n: More strings are now translation ready, thanks to [@alexclassroom](https://profiles.wordpress.org/alexclassroom/).

= 1.6 =
* Tested with WordPress 5.0.2. 
* Enhancement: Improved bulk updater warning and inline documentation. 
* Bug Fix: Fixed a bug that ignored the setting for inserting image title into the post HTML. 

= 1.5 =
* Enhancement: Changed text domain from abl_iaff_td to auto-image-attributes-from-filename-with-bulk-updater to make the plugin translation ready in translate.wordpress.org.
* Enhancement: Code improvements.
* Enhancement: Added an activation notice with link to the settings page for better on-boarding experience. 

= 1.4 =
* Date: 22.November.2017.
* NEW: Global switch to enable or disable the plugin.
* NEW: Test button.
* NEW: Stop Bulk Updater button.
* NEW: Support tab.
* Improvement: Changed source of filename from guid to wp_get_attachment_url() to prevent conflicts with other plugins. GUID was being replaced by other plugins. Thanks to @niresh12495 for [bringing this up] (https://wordpress.org/support/topic/image-title-description-and-alt-tag-replaced-with-attachment-idnumber/).
* Impreovement: Added checks to check if attachment is image before processing.
* FIX: Added [boolval() function for backwards compatibility](https://millionclues.com/wordpress-tips/solved-fatal-error-call-to-undefined-function-boolval/) with servers with PHP older than PHP 5.5. 
* Added preview of premium options that ship with [Image Attributes Pro](https://imageattributespro.com/docs?utm_source=wordpress.org&utm_medium=changelog)
* UI Improvements.
* Code improvements.

= 1.3 =
* Improved the architecture of the plugin laying foundation for future updates. Utilizing my [starter plugin framework](http://millionclues.com/lab/wordpress-starter-plugin-a-framework-for-quick-plugin-development/)
* Bug fix: For images that had EXIF data, EXIF data was used instead of filename. Props to @mathieupellegrin for reporting this. 
* NEW: Added option to Insert Image Title into HTML. WordPress stopped including image titles since 3.5. Code from [Restore Image Title](https://wordpress.org/plugins/restore-image-title/) plugin was used. 
* NEW: Remove full stops ( . ) from filename.
* NEW: Remove commas ( , ) from filename.
* NEW: Remove all numbers ( 0-9 ) from filename.
* NEW: Added a warning and user confirmaton before while clicking "Run Bulk Updater" button to prevent accidental clicks.
* UI Improvement: Cleaned up the interface and moved the Bulk Updater to its own tab. 
* UI Improvement: Bulk updater log is now displayed in a neat box instead of just printing the results on the page. 
* Parts of the code was updated for more efficiency and faster processing. 
* Tested on WordPress 4.8.1. Result = pass.

= 1.2 =
* Added: Character filter options. Plugin now removes hyphens and underscores.
* Bug Fix: Minor bug fix.

= 1.1 =
* Added: Options to choose individual image attributes for NEW uploads. 

= 1.0 =
* First release of the plugin.