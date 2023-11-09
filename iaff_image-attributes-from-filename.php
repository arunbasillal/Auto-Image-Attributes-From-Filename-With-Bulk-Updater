<?php
/**
 * Plugin Name: Auto Image Attributes From Filename With Bulk Updater
 * Plugin URI: https://imageattributespro.com/?utm_source=plugin-header&utm_medium=plugin-uri
 * Description: Automatically Add Image Title, Image Caption, Description And Alt Text From Image Filename. Since this plugin includes a bulk updater this can update both existing images in the Media Library and new images. 
 * Author: Arun Basil Lal
 * Author URI: https://imageattributespro.com/?utm_source=plugin-header&utm_medium=author-uri
 * Version: 4.4
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
 * /languages/					- Translation files go here.
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
	define( 'IAFF_VERSION_NUM', '4.4' );
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
	 * @since 2.1
	 * Bulk Updater Behaviour was added for image caption and description.
	 */
	if ( version_compare( $current_ver, '2.0', '<=' ) ) {
		
		$settings = get_option( 'iaff_settings' );

		if ( $settings !== false ) {
			$settings['bu_caption_behaviour'] = 1;
			$settings['bu_description_behaviour'] = 1;

			update_option('iaff_settings', $settings);
		}
	}

	/**
	 * @since 4.3
	 * 
	 * Some major changes were made in the UI:
	 * - Removed Filter Settings and Custom Filter from Bulk Updater Settings. The bulk updater will use the same filters from the Advanced settings from here on.
	 * - Removed Capitalization Settings from Bulk Updater Settings. The bulk updater will use the capitalization settings from the Advanced settings from here on.
	 * - Removed image attribute configuration in Bulk Updater Settings. The image attributes set in the Advanced settings will be used by the bulk updater from here on.
	 * - Choose where to update image title and alt text while running the Bulk Updater. Image attributes can be updated in Media Library, post HTML, or both.
	 */
	if ( version_compare( $current_ver, '4.2', '<=' ) ) {

		// This will return false during first install since iaff_settings does not exist.
		$settings = get_option( 'iaff_settings' );

		if ( $settings !== false ) {

			/**
			 * Add "Update in: Media Library and Post HTML" setting for all attributes.
			 * 
			 * Up until now, there was no option to disable updating the Media Library.
			 * So this setting being turned on is the default expected behaviour when users update.
			 * 
			 * For Post HTML, users had the option to disable it before by selecting "Update image titles in media library only.".
			 * Setting it to be enabled might be unexpected to some users. However a compromise had to be made.
			 * Users can still choose to downgrade to version 4.2 of the basic plugin and use it.
			 */
			$settings['bu_title_location_ml'] = 1;
			$settings['bu_alt_text_location_ml'] = 1;
			$settings['bu_caption_location_ml'] = 1;
			$settings['bu_description_location_ml'] = 1;

			$settings['bu_title_location_post'] = 1;
			$settings['bu_alt_text_location_post'] = 1;

			/**
			 * If current image title setting is set to "Update image titles in media library only.",
			 * then set it to "Update all attributes overwriting any existing attributes.".
			 *
			 * The value of "Update all attributes overwriting any existing attributes." is 1. 
			 * Users can manage updating the Media Library using the "Update in:" setting.
			 * 
			 * bu_titles_in_post can have values 0, 1 or 2.
			 * bu_titles_in_post is renamed to bu_title_behaviour in 4.3 and can have values 1 or 2.
			 */
			if ( $settings['bu_titles_in_post'] == '0' ) {
				$settings['bu_title_behaviour'] = 1;
			} else {
				$settings['bu_title_behaviour'] = $settings['bu_titles_in_post'];
			}

			/**
			 * If current alt text setting is set to "Update alt text in media library only.",
			 * then set it to "Update all attributes overwriting any existing attributes.".
			 *
			 * The value of "Update all attributes overwriting any existing attributes." is 1. 
			 * Users can manage updating the Media Library using the "Update in:" setting.
			 * 
			 * bu_alt_text_in_post can have values 0, 1 or 2.
			 * bu_alt_text_in_post is renamed to bu_alt_text_behaviour in 4.3 and can have values 1 or 2.
			 */
			if ( $settings['bu_alt_text_in_post'] == '0' ) {
				$settings['bu_alt_text_behaviour'] = 1;
			} else {
				$settings['bu_alt_text_behaviour'] = $settings['bu_alt_text_in_post'];
			}

			// Remove deleted settings.
			unset(
				$settings['bu_hyphens'],
				$settings['bu_under_score'],
				$settings['bu_full_stop'],
				$settings['bu_commas'],
				$settings['bu_all_numbers'],
				$settings['bu_apostrophe'],
				$settings['bu_tilde'],
				$settings['bu_plus'],
				$settings['bu_pound'],
				$settings['bu_ampersand'],
				$settings['bu_round_brackets'],
				$settings['bu_square_brackets'],
				$settings['bu_curly_brackets'],
				$settings['bu_custom_filter'],
				$settings['bu_regex_filter'],
				$settings['bu_capitalization'],
				$settings['bu_title_source'],
				$settings['custom_attribute_bu_title'],
				$settings['bu_alt_text_source'],
				$settings['custom_attribute_bu_alt_text'],
				$settings['bu_caption_source'],
				$settings['custom_attribute_bu_caption'],
				$settings['bu_description_source'],
				$settings['custom_attribute_bu_description']
			);

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
		
		// Set transient to show upgrade complete notice.
		set_transient( 'iaff_upgrade_complete_admin_notice', true, 300 );
	}
	
	// Finally add the current version to the database. Upgrade todo complete. 
	update_option( 'abl_iaff_version', IAFF_VERSION_NUM );
}
add_action( 'admin_init', 'iaff_upgrader' );

// Load everything
require_once( IAFF_IMAGE_ATTRIBUTES_FROM_FILENAME_DIR . '/loader.php');

// Register activation hook
register_activation_hook( __FILE__ , 'iaff_activate_plugin' );