<?php
/**
 * Plugin Name: Auto Image Attributes From Filename With Bulk Updater
 * Plugin URI: https://imageattributespro.com/?utm_source=plugin-header&utm_medium=plugin-uri
 * Description: Automatically Add Image Title, Image Caption, Description And Alt Text From Image Filename. Since this plugin includes a bulk updater this can update both existing images in the Media Library and new images. 
 * Author: Arun Basil Lal
 * Author URI: https://imageattributespro.com/?utm_source=plugin-header&utm_medium=author-uri
 * Version: 1.6
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
 * Plugin directory path and URL constants
 *
 * @since 1.3
 * @since 1.5 Removed IAFF_IMAGE_ATTRIBUTES_FROM_FILENAME constant
 */
if ( ! defined( 'IAFF_IMAGE_ATTRIBUTES_FROM_FILENAME_DIR' ) ) {
	
	/**
	 * The absolute path to the plugin directory without the trailing slash. Useful for using with includes
	 * eg - C:\xampp\htdocs\wp/wp-content/plugins/auto-image-attributes-from-filename-with-bulk-updater
	 */
	define( 'IAFF_IMAGE_ATTRIBUTES_FROM_FILENAME_DIR', plugin_dir_path( __FILE__ ) );
}

if ( ! defined( 'IAFF_IMAGE_ATTRIBUTES_FROM_FILENAME_URL' ) ) {
	
	/**
	* The url to the plugin folder. Useful for referencing src
	* eg - http://localhost/wp/wp-content/plugins/auto-image-attributes-from-filename-with-bulk-updater/
	*/
	define( 'IAFF_IMAGE_ATTRIBUTES_FROM_FILENAME_URL', plugin_dir_url( __FILE__ ) );
}

/**
 * A constant with current version of plugin
 *
 * IAFF_VERSION_NUM will be current version of the plugin. 
 * This is useful for database upgrades and doing stuff after plugin update. 
 *
 * @since 1.3
 */
if ( ! defined( 'IAFF_VERSION_NUM' ) ) {
	define( 'IAFF_VERSION_NUM', '1.6' );
}

/**
 * Do stuff after a plugin upgrade.
 *
 * @since 1.4
 * @since 1.5 Switched to version_compare for version check and added iaff_upgrade_complete_admin_notice transient.
 */
function iaff_upgrader() {
	
	/**
	 * Get the current version of the plugin stored in the db.
	 * Version was added in 1.3, defaults to 1.2
	 */
	$current_ver = get_option( 'abl_iaff_version', '1.2' );
	
	// Return if we have already done this todo
	if ( version_compare( $current_ver, IAFF_VERSION_NUM, '==' ) ) {
		return;
	}
	
	/**
	 * Upgrade database settings when upgrading from 1.3 or lower
	 * A global swith with setting name global_switch was introduce in 1.4
	 */
	if ( version_compare( $current_ver, '1.3', '<=' ) ) {
		
		$settings = get_option( 'iaff_settings' );
	
		if ( $settings !== false ) {
			
			$settings['global_switch'] = 1;	// Global switch was introduced in ver 1.4
			update_option('iaff_settings', $settings);
		}
	}
	
	/**
	 * Detect first install. 
	 * 
	 * Since abl_iaff_version is not saved at this point, $current_ver will be 
	 * the default value of 1.2 at this point. 
	 * 
	 * @since 1.6
	 */
	if ( $current_ver !== '1.2' ) {
		
		// Set transient to show upgrade complete notice
		set_transient( 'iaff_upgrade_complete_admin_notice', true, 300 );
	}
	
	// Finally add the current version to the database. Upgrade todo complete. 
	update_option( 'abl_iaff_version', IAFF_VERSION_NUM );
}
add_action( 'admin_init', 'iaff_upgrader' );

// Load everything
require_once( IAFF_IMAGE_ATTRIBUTES_FROM_FILENAME_DIR . '/admin/iaff_image-attributes-from-filename-loader.php');

// Register activation hook
register_activation_hook( __FILE__ , 'iaff_activate_plugin' );