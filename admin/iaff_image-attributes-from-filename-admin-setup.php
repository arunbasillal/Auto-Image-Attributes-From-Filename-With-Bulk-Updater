<?php
/**
 * Admin setup for the plugin
 *
 * @since 1.3
 * @function	iaff_add_menu_links()		Add admin menu pages
 * @function	iaff_register_settings()	Register Settings
 * @function	iaff_enqueue_js_and_css()	Load Admin Side Js and CSS
 */


// Exit if accessed directly
if ( !defined('ABSPATH') ) exit;
 
 
/**
 * Add admin menu pages
 *
 * @since 	1.0
 * @refer	https://developer.wordpress.org/plugins/administration-menus/
 */
function iaff_add_menu_links() {
	add_options_page( __('Auto Image Attributes','abl_iaff_td'), __('Image Attributes','abl_iaff_td'), 'manage_options', 'image-attributes-from-filename','iaff_admin_interface_render'  );
}
add_action( 'admin_menu', 'iaff_add_menu_links' );


/**
 * Register Settings
 *
 * @since 	1.0
 */
function iaff_register_settings() {

	// Register Setting
	register_setting( 
		'iaff_settings_group', 	// Group Name
		'iaff_settings' 		// Setting Name = HTML form <input> name on settings form
	);
	
	// Register A New Section
    add_settings_section(
        'iaff_auto_image_attributes_settings',							// ID
        __('Image Attribute Settings For New Uploads', 'abl_iaff_td'),	// Title
        'iaff_auto_image_attributes_callback',							// Callback Function
        'image-attributes-from-filename'								// Page slug
    );
	
	// General Settings
    add_settings_field(
        'iaff_general_settings',								// ID
        __('General Settings', 'abl_iaff_td'),					// Title
        'iaff_auto_image_attributes_settings_field_callback',	// Callback function
        'image-attributes-from-filename',						// Page slug
        'iaff_auto_image_attributes_settings'					// Settings Section ID
    );
	
	// Filter Settings
    add_settings_field(
        'iaff_filter_settings',									// ID
        __('Filter Settings', 'abl_iaff_td'),					// Title
        'iaff_auto_image_attributes_filter_settings_callback',	// Callback function
        'image-attributes-from-filename',						// Page slug
        'iaff_auto_image_attributes_settings'					// Settings Section ID
    );
	
}
add_action( 'admin_init', 'iaff_register_settings' );


/**
 * Set default values for settings
 *
 * @since 	1.0
 */
// Default Values For Settings
$defaults = array(
					'image_title' 			=> '1',
					'image_caption' 		=> '1',
					'image_description' 	=> '1',
					'image_alttext' 		=> '1',
					'image_title_to_html' 	=> '0',
					'hyphens' 				=> '1',
					'under_score' 			=> '1',
					'full_stop' 			=> '0',
					'commas' 				=> '0',
					'all_numbers' 			=> '0',
				);


/**
 * Load Admin Side Js and CSS
 *
 * Used for styling the plugin pages and bulk updater.
 * @since	1.3
 */
function iaff_enqueue_js_and_css() {
    wp_register_style( 'iaff-style', plugins_url( '/css/iaff-style.css', __FILE__ ), '', IAFF_VERSION_NUM );
}
add_action( 'admin_enqueue_scripts', 'iaff_enqueue_js_and_css' );

?>