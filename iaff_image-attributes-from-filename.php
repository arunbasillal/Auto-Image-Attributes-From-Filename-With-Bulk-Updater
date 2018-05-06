<?php
/**
 * Plugin Name: Auto Image Attributes From Filename With Bulk Updater
 * Plugin URI: https://imageattributespro.com/?utm_source=wordpress.org&utm_medium=plugin-uri
 * Description: Automatically Add Image Title, Image Caption, Description And Alt Text From Image Filename. Since this plugin includes a bulk updater this can update both existing images in the Media Library and new images. 
 * Author: Arun Basil Lal
 * Author URI: https://imageattributespro.com/?utm_source=wordpress.org&utm_medium=author-uri
 * Version: 1.5
 * Text Domain: auto-image-attributes-from-filename-with-bulk-updater
 * Domain Path: /languages
 * License: GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
 */
 
/**
 * This plugin was developed using the WordPress starter plugin template by Arun Basil Lal <arunbasillal@gmail.com>
 * Please leave this credit and the directory structure intact for future developers who might read the code. 
 * @Github		https://github.com/arunbasillal/WordPress-Starter-Plugin
 */
 
/**
 * ~ Directory Structure ~
 *
 * /admin/ 						- Plugin backend stuff.
 * /includes/					- External third party classes and libraries.
 * /languages/					- Translation files go here. 
 * /public/						- Front end files go here.
 * index.php					- Dummy file.
 * license.txt					- GPL v2
 * iaff_starter-plugin.php		- File containing plugin name and other version info for WordPress.
 * readme.txt					- Readme for WordPress plugin repository. https://wordpress.org/plugins/files/2017/03/readme.txt
 * uninstall.php				- Fired when the plugin is uninstalled. 
 */

// Exit if accessed directly
if ( ! defined('ABSPATH') ) exit;

/**
 * Plugin name and directory constants
 *
 * @since 1.3
 */
// The name of the plugin
// 'auto-image-attributes-from-filename-with-bulk-updater'
if (!defined('IAFF_IMAGE_ATTRIBUTES_FROM_FILENAME'))
    define('IAFF_IMAGE_ATTRIBUTES_FROM_FILENAME', trim(dirname(plugin_basename(__FILE__)), '/'));

// The absolute path to the plugin directory without the trailing slash. Useful for using with includes
// eg - C:\xampp\htdocs\wp/wp-content/plugins/auto-image-attributes-from-filename-with-bulk-updater
if (!defined('IAFF_IMAGE_ATTRIBUTES_FROM_FILENAME_DIR'))
    define('IAFF_IMAGE_ATTRIBUTES_FROM_FILENAME_DIR', plugin_dir_path( __FILE__ ));

// The url to the plugin folder. Useful for referencing src
// eg - http://localhost/wp/wp-content/plugins/auto-image-attributes-from-filename-with-bulk-updater/
if (!defined('IAFF_IMAGE_ATTRIBUTES_FROM_FILENAME_URL'))
    define('IAFF_IMAGE_ATTRIBUTES_FROM_FILENAME_URL', plugin_dir_url( __FILE__ ));

/**
 * Add plugin version to database
 *
 * @since 		1.3
 * @constant 	IAFF_VERSION_NUM		the version number of the current version
 * @refer		https://www.smashingmagazine.com/2011/03/ten-things-every-wordpress-plugin-developer-should-know/
 */
if (!defined('IAFF_VERSION_NUM'))
    define('IAFF_VERSION_NUM', '1.5');

/**
 * Upgrade database settings on update 
 *
 * @since	1.4
 */
function iaff_upgrade_db_settings() {
	
	$current_ver = get_option('abl_iaff_version');
	
	if ( ($current_ver >= 1.4 ) ) {
		return;	// Version was added in 1.3. Return if version is above 1.3. 
	}
	
	$settings = get_option('iaff_settings');
	
	if ( $settings != false ) {
		$settings['global_switch'] = 1;	// Global switch was introduced in ver 1.4
		update_option('iaff_settings', $settings);
	}
	
	update_option('abl_iaff_version', IAFF_VERSION_NUM);
}
add_action( 'plugins_loaded', 'iaff_upgrade_db_settings' );

// Load everything
require_once( IAFF_IMAGE_ATTRIBUTES_FROM_FILENAME_DIR . '/admin/iaff_image-attributes-from-filename-loader.php');

// Register activation hook (this has to be in the main plugin file.)
register_activation_hook( __FILE__ , 'iaff_activate_plugin' );