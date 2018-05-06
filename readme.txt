=== Auto Image Attributes From Filename With Bulk Updater ===
Contributors: arunbasillal
Donate link: http://millionclues.com/donate/
Tags: image title, image caption, image description, alt text, bulk edit images, bulk rename images, auto image attributes, auto image alt text, remove underscores
Requires at least: 3.5.0
Tested up to: 4.8.1
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
* Set the image filename as the image Alt Text. This was a default feature in WordPress before 4.7. This option restores this essential feature which is great for SEO.
* Insert Image Title into post HTML. WordPress stopped adding Image Titles to images since WordPress 3.5. This option restores it.
* Remove hyphens from the image filename.
* Remove underscores from the image filename.
* Remove full stops from filename.
* Remove commas from filename.
* Remove all numbers from filename.
* Choose to turn off any of the above mentioned features.

With the bulk updater you can: 

* Set the image filename as image Title, Caption, Description and Alt Text after removing hyphens and underscores from the filename.
* Update any number of images in your Media Library in one click.

If your image filename is *my_image-name.jpg*, your Image Title, Caption, Description And Alt Text will be *My Image Name*. 

The plugin settings and bulk updater are in WordPress Admin > Settings > Image Attributes. Here you can choose which attributes to update for NEW uploads. 

**Please remember to take a database backup before running the bulk updater. The bulk updater updates ALL attributes for existing images in the Media Library and ignores the settings set for NEW uploads.**

== Installation ==

To install this plugin:

1. Install the plugin through the WordPress admin interface, or upload the plugin folder to /wp-content/plugins/ using ftp.
2. Activate the plugin through the 'Plugins' screen in WordPress.
3. Go to WordPress Admin > Settings > Image Attributes.

== Frequently Asked Questions ==

= Will this plugin update existing images in the media library? =

Yes, the plugin will update image Title, Caption, Description And Alt Text from the image filename for both existing images in the media library and new uploads.

= I need more features. Can I hire you? =

Yes! Please [get in touch via my contact form](http://millionclues.com/contact/) with a brief description of your requirement and budget for the project. I will be in touch shortly.

= This plugin saved me a lot of time, how can I show my appreciation? =

I am glad to hear that! You can either [make a donation](http://millionclues.com/donate/) or leave a [rating](https://wordpress.org/support/plugin/auto-image-attributes-from-filename-with-bulk-updater/reviews/?rate=5#new-post) to motivate me to keep working on the plugin. 

== Screenshots ==

1. The settings page in WordPress Admin > Settings > Image Attributes with default settings.
2. Bulk Updater

== Changelog ==

= 1.3 =
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
* Added: Character filter options. Plugin now removes hyphens and underscores.
* Bug Fix: Minor bug fix.

= 1.1 =
* Added: Options to choose individual image attributes for NEW uploads. 

= 1.0 =
* First release of the plugin.

== Upgrade Notice ==

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