<?php
/**
 * Plugin Name: Auto Image Attributes From Filename With Bulk Updater
 * Plugin URI: http://millionclues.com/
 * Description: Automatically Add Image Title, Image Caption, Description And Alt Text From Image Filename. Since this plugin includes a bulk updater this can update both existing images in the Media Library and new images. 
 * Author: Arun Basil Lal
 * Author URI: http://millionclues.com
 * Version: 1.3
 * Text Domain: abl_iaff_td
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

 
/**
 * :TODO:
 *
 * - Update IAFF_VERSION_NUM 			in iaff_starter-plugin.php (keep this line for future updates)
 */


// Exit if accessed directly
if ( !defined('ABSPATH') ) exit;


/**
 * Plugin name and directory constants
 *
 * @since 		1.3
 * @constant 	IAFF_STARTER_PLUGIN		The name of the plugin - 'starter-plugin'
 * @constant	IAFF_STARTER_PLUGIN_DIR	The absolute path to the plugin directory without the trailing slash - C:\xampp\htdocs\wp/wp-content/plugins/starter-plugin
 */
if (!defined('IAFF_STARTER_PLUGIN'))
    define('IAFF_STARTER_PLUGIN', trim(dirname(plugin_basename(__FILE__)), '/'));

if (!defined('IAFF_STARTER_PLUGIN_DIR'))
    define('IAFF_STARTER_PLUGIN_DIR', WP_PLUGIN_DIR . '/' . IAFF_STARTER_PLUGIN);


/**
 * Add plugin version to database
 *
 * @since 		1.3
 * @constant 	IAFF_VERSION_NUM		the version number of the current version
 * @refer		https://www.smashingmagazine.com/2011/03/ten-things-every-wordpress-plugin-developer-should-know/
 */
if (!defined('IAFF_VERSION_NUM'))
    define('IAFF_VERSION_NUM', '1.3');
update_option('abl_iaff_version', IAFF_VERSION_NUM);	// Change to add_option when we need to check installed version at some later point. 


// Load everything
require_once( IAFF_STARTER_PLUGIN_DIR . '/admin/iaff_image-attributes-from-filename-loader.php');

// Register activation hook (this has to be in the main plugin file.)
register_activation_hook( __FILE__ , 'iaff_activate_plugin' );

?>