# Auto Image Attributes From Filename With Bulk Updater

Automatically Add Image Title, Caption, Description And Alt Text From Filename. Includes a bulk updater to update existing images in the Media Library

The plugin can update image attributes for both new images and existing images in the media library. 

[![Image Attributes Pro Demo Video](https://i.ytimg.com/vi/V5SOU4okOfU/maxresdefault.jpg)](https://youtu.be/V5SOU4okOfU)

Image alt text and title is critical for your image SEO and will help users discover your images (and there by your website) in Google / Yahoo / Bing image search. 

Proper alt text also helps people who are blind or who have low vision understand your images there by improving the accessibility of your website. This will open up your website to a new segment of visitors and increase your traffic.

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

A pro add-on is now available for the plugin. Check out [Image Attributes Pro](https://imageattributespro.com/?utm_source=github&utm_medium=readme.md).

The pro add-on can update the image attributes from not just the image filename, but also from the post / page / product / custom post type title. You can fine tune the bulk updater settings and even clean up the actual image filename. 

What the pro add-on you get these additional features:

* Use post title as title text. If image is not attached to a post, image filename will be used instead.
* Use post title as alt text. If image is not attached to a post, image filename will be used instead.
* Use post title as caption. If image is not attached to a post, image filename will be used instead.
* Use post title as description. If image is not attached to a post, image filename will be used instead.
* Build your own attributes using custom tags like `%filename%`, `%posttitle%`, `%sitetitle%`, `%category%`, `%tag%`, `%yoastfocuskw%`, `%yoastseotitle%`, `%rankmathfocuskw%`, `%seopresstargetkw%` and [many more](https://imageattributespro.com/custom-image-attribute-tags/?utm_source=github&utm_medium=readme.md). Each custom tag will be replaced  with it's value. You can combine them as you please!
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

With the Image Attributes Pro bulk updater you can:

* Update image title and alt text for images inserted into posts and custom post types. Not just the media library. [What is the difference?](https://imageattributespro.com/how-wordpress-store-image-attributes/?utm_source=github&utm_medium=readme.md)
* Fine tune all settings. Choose what to update.
* Update image titles / alt text in media library and / or existing posts.
* Update image titles / alt text in media library and / or existing posts only if no title / alt text is set. Existing image titles / alt text will be preserved.
* Update image caption and description in the media library. Existing image captions and descriptions can be preserved.
* Build your own attributes using custom tags like `%filename%`, `%posttitle%`, `%sitetitle%`, `%category%`, `%tag%`, `%yoastfocuskw%`, `%yoastseotitle%`, `%rankmathfocuskw%`, `%seopresstargetkw%` and [many more](https://imageattributespro.com/custom-image-attribute-tags/?utm_source=github&utm_medium=readme.md). Each custom tag will be replaced  with it's value. You can combine them as you please!
* Choose to turn off any of the above mentioned features.
* Bulk update image attributes in [ACF's WYSIWYG Editor](https://imageattributespro.com/acf-compatibility/?utm_source=github&utm_medium=readme.md) and [Divi theme](https://imageattributespro.com/divi-compatibility/?utm_source=github&utm_medium=readme.md.md).
* Modify auto generated image attributes using the [iaffpro_image_attributes filter](https://imageattributespro.com/codex/iaffpro_image_attributes/?utm_source=github&utm_medium=readme.md).
* Choose specific post types to bulk update using the [iaffpro_included_post_types filter](https://imageattributespro.com/codex/iaffpro_included_post_types/?utm_source=github&utm_medium=readme.md).
* Disable updating of attributes in media library completely and just updated attributes in Post HTML or vice versa.
* Add or remove custom image attributes using the [iaffpro_html_image_markup_post_update filter](https://imageattributespro.com/codex/iaffpro_html_image_markup_post_update/?utm_source=github&utm_medium=readme.md)

Other Image Attributes Pro features:

* Bulk Update image attributes from WordPress Media Library. Select images and choose `Update image attributes` Bulk action in Media Library (list view). [Read more.](https://imageattributespro.com/bulk-actions/?utm_source=github&utm_medium=readme.md)
* Bulk Update image attributes from WordPress admin page for Posts, Pages and WooCommerce Products. Select the posts, pages or WooCommerce products in bulk and choose "Update image attributes" Bulk action. [Read more.](https://imageattributespro.com/bulk-actions/?utm_source=github&utm_medium=readme.md)
* Copy image attributes to post HTML while updating in Media Library. Any changes made to image attributes in the media library will be automatically synced to the corresponding post HTML. [Read more.](https://imageattributespro.com/auto-copy-image-attributes-to-post-html-from-media-library/?utm_source=github&utm_medium=readme.md)
* Update image attributes on post publish or update. Automatically updates image attributes when a post is published or updated. Ensures image attributes are always consistent with settings. [Read more.](https://imageattributespro.com/update-image-attributes-on-save-post/?utm_source=github&utm_medium=readme.md)

For screenshots, FAQ and further details, please see the [product website](https://imageattributespro.com/?utm_source=github&utm_medium=readme.md).

## Installation

To install this plugin:

1. Install the plugin through the WordPress admin interface, or upload the plugin folder to /wp-content/plugins/ using ftp.
2. Activate the plugin through the 'Plugins' screen in WordPress.
3. Go to WordPress Admin > Settings > Image Attributes.

## Frequently Asked Questions

### Will this plugin update existing images in the media library?

Yes, the plugin will update image Title, Caption, Description And Alt Text from the image filename for both existing images in the media library and new uploads.

### I need more features. Can I hire you?

Please checkout the [Image Attributes Pro add-on](https://imageattributespro.com/?utm_source=github&utm_medium=readme.md) to see if it suits your requirement. 
