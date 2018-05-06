=== Auto Image Attributes From Filename With Bulk Updater ===
Contributors: arunbasillal
Donate link: https://imageattributespro.com/?utm_source=wordpress.org&utm_medium=donate-link
Tags: image title, image caption, image description, alt text, bulk edit images, bulk rename images, auto image attributes, auto image alt text, remove underscores, image seo
Requires at least: 3.5.0
Tested up to: 4.9
Stable tag: trunk
License: GPLv2 or later
License URI: http://www.gnu.org/licenses/gpl-2.0.html

Automatically Add Image Title, Caption, Description And Alt Text From Filename. Includes a bulk updater to update existing images in the Media Library

== Description ==

Automatically add Image attributes such as Image Title, Image Caption, Description And Alt Text from Image Filename. 

The plugin can update image attributes for both new images and existing images in the media library. 

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

With the bulk updater you can: 

* Set the image filename as image Title, Caption, Description and Alt Text after removing hyphens and underscores from the filename.
* Update any number of images in your Media Library in one click.

If your image filename is *My_image-name.jpg*, your Image Title, Caption, Description And Alt Text will be *My image name*. 

The plugin settings and bulk updater are in WordPress Admin > Settings > Image Attributes. Here you can choose which attributes to update for NEW uploads. 

Please remember to take a database backup before running the bulk updater. The bulk updater updates ALL attributes for existing images in the Media Library and ignores the settings set for NEW uploads.

**Image Attributes Pro**

A pro add-on is now available for the plugin. Check out [Image Attributes Pro](https://imageattributespro.com/?utm_source=wordpress&utm_medium=readme).

What the pro add-on you get these additional features:

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
* Use post title as title text. If image is not attached to a post, image filename will be used instead.
* Use post title as alt text. If image is not attached to a post, image filename will be used instead.
* Use post title as caption. If image is not attached to a post, image filename will be used instead.
* Use post title as description. If image is not attached to a post, image filename will be used instead.
* Choose to turn off any of the above mentioned features.

With the pro bulk updater you can:

* Update image title and alt text for images inserted into posts and custom post types.
* Fine tune all settings. Choose what to update.
* Update image titles / alt text in media library only. Image titles / alt text in existing posts will be left unchanged.
* Update image titles / alt text in media library and existing posts.
* Update image titles / alt text in existing posts only if no title / alt text is set. All image titles/ alt text in media library will be updated.
* Choose to turn off any of the above mentioned features.

For screenshots, FAQ and further details, please see the [product website](https://imageattributespro.com/?utm_source=wordpress&utm_medium=readme).

== Installation ==

To install this plugin:

1. Install the plugin through the WordPress admin interface, or upload the plugin folder to /wp-content/plugins/ using ftp.
2. Activate the plugin through the 'Plugins' screen in WordPress.
3. Go to WordPress Admin > Settings > Image Attributes.

== Frequently Asked Questions ==

= Will this plugin update existing images in the media library? =

Yes, the plugin will update image Title, Caption, Description And Alt Text from the image filename for both existing images in the media library and new uploads.

= I need more features. Can I hire you? =

Please checkout the [Image Attributes Pro add-on](https://imageattributespro.com/?utm_source=wordpress&utm_medium=readme) to see if it suits your requirement. If not, please [get in touch via my contact form](http://millionclues.com/contact/) with a brief description of your requirement and budget for the project. I will be in touch shortly.

= This plugin saved me a lot of time, how can I show my appreciation? =

I am glad to hear that! You can either [upgrade to pro](https://imageattributespro.com/?utm_source=wordpress&utm_medium=readme) or leave a [rating](https://wordpress.org/support/plugin/auto-image-attributes-from-filename-with-bulk-updater/reviews/?rate=5#new-post) to motivate me to keep working on the plugin. 

== Screenshots ==

1. The settings page in WordPress Admin > Settings > Image Attributes with default settings.
2. Preview of the Advanced settings screen. Seen only when the preview is enabled.
2. Preview of the Bulk Updater settings screen. Seen only when the preview is enabled.
4. Bulk Updater

== Changelog ==

= 1.5 =
* Date: 
* Enhancement: Changed text domain from abl_iaff_td to auto-image-attributes-from-filename-with-bulk-updater to make the plugin translation ready in translate.wordpress.org.
* Enhancement: Code improvements.
* Enhancement: Added an actvation notice with link to the settings page for better onboarding experience. 

= 1.4 =
* Date: 22.November.2017
* NEW: Global switch to enable or disable the plugin.
* NEW: Test button.
* NEW: Stop Bulk Updater button.
* NEW: Support tab.
* Improvement: Changed source of filename from guid to wp_get_attachment_url() to prevent conflicts with other plugins. GUID was being replaced by other plugins. Thanks to @niresh12495 for [bringing this up] (https://wordpress.org/support/topic/image-title-description-and-alt-tag-replaced-with-attachment-idnumber/).
* Impreovement: Added checks to check if attachment is image before processing.
* FIX: Added [boolval() function for backwards compatibility](https://millionclues.com/wordpress-tips/solved-fatal-error-call-to-undefined-function-boolval/) with servers with PHP older than PHP 5.5. 
* Added preview of premium options that ship with [Image Attributes Pro](https://imageattributespro.com/docs?utm_source=wordpressorg&utm_medium=changelog)
* UI Improvements.
* Code improvements.

= 1.3 =
* Date: 17.August.2017
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
* Date: 15.July.2017
* Added: Character filter options. Plugin now removes hyphens and underscores.
* Bug Fix: Minor bug fix.

= 1.1 =
* Date: 4.July.2017
* Added: Options to choose individual image attributes for NEW uploads. 

= 1.0 =
* Date: 4.July.2017
* First release of the plugin.

== Upgrade Notice ==

= 1.4 =
* Date: 22.November.2017
* NEW: Global switch to enable or disable the plugin.
* NEW: Test button.
* NEW: Stop Bulk Updater button.
* NEW: Support tab.
* Improvement: Changed source of filename from guid to wp_get_attachment_url() to prevent conflicts with other plugins. GUID was being replaced by other plugins. Thanks to @niresh12495 for [bringing this up] (https://wordpress.org/support/topic/image-title-description-and-alt-tag-replaced-with-attachment-idnumber/).
* Impreovement: Added checks to check if attachment is image before processing.
* FIX: Added [boolval() function for backwards compatibility](https://millionclues.com/wordpress-tips/solved-fatal-error-call-to-undefined-function-boolval/) with servers with PHP older than PHP 5.5. 
* Added preview of premium options that ship with [Image Attributes Pro](https://imageattributespro.com/docs?utm_source=wordpressorg&utm_medium=changelog)
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