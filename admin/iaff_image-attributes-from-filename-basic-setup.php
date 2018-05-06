<?php 
/**
 * Basic setup functions for the plugin
 *
 * @since 1.3
 * @function	iaff_activate_plugin()			Plugin activatation todo list
 * @function	iaff_load_plugin_textdomain()	Load plugin text domain
 * @function	iaff_settings_link()			Print direct link to plugin settings in plugins list in admin
 * @function	iaff_plugin_row_meta()			Add donate and other links to plugins list
 * @function	iaff_footer_text()				Admin footer text
 * @function	iaff_footer_version()			Admin footer version
 */


// Exit if accessed directly
if ( ! defined('ABSPATH') ) exit;

 
/**
 * Plugin activatation todo list
 *
 * This function runs when user activates the plugin
 * @since	1.0
 */
function iaff_activate_plugin() {
	add_option( 'iaff_bulk_updater_counter', '0' );				// Setting numer of images processed as zero
}


/**
 * Load plugin text domain
 *
 * @since	1.0
 */
function iaff_load_plugin_textdomain() {
    load_plugin_textdomain( 'abl_iaff_td', FALSE, IAFF_IMAGE_ATTRIBUTES_FROM_FILENAME_DIR . '/languages/' );
}
add_action( 'plugins_loaded', 'iaff_load_plugin_textdomain' );


/**
 * Print direct link to plugin settings in plugins list in admin
 *
 * @since	1.0
 */
function iaff_settings_link( $links ) {
	return array_merge(
		array(
			'settings' => '<a href="' . admin_url( 'options-general.php?page=image-attributes-from-filename' ) . '">' . __( 'Settings', 'abl_iaff_td' ) . '</a>'
		),
		$links
	);
}
add_filter( 'plugin_action_links_' . IAFF_IMAGE_ATTRIBUTES_FROM_FILENAME . '/iaff_image-attributes-from-filename.php', 'iaff_settings_link' );


/**
 * Add donate and other links to plugins list
 *
 * @since	1.0
 */
function iaff_plugin_row_meta( $links, $file ) {
	
	if ( iaff_is_pro() ) {
		return $links;
	}
	
	if ( strpos( $file, 'iaff_image-attributes-from-filename.php' ) !== false ) {
		$new_links = array(
				'upgrade' 	=> '<a href="https://imageattributespro.com/?utm_source=iaff-basic&utm_medium=plugins-list" target="_blank">Upgrade To Image Attributes Pro</a>',
				);
		$links = array_merge( $links, $new_links );
	}
	
	return $links;
}
add_filter( 'plugin_row_meta', 'iaff_plugin_row_meta', 10, 2 );


/**
 * Admin footer text
 *
 * A function to add footer text to the settings page of the plugin. Footer text contains plugin rating and donation links.
 * Note: Remove the rating link if the plugin doesn't have a WordPress.org directory listing yet. (i.e. before initial approval)
 * @since	1.0
 * @refer	https://codex.wordpress.org/Function_Reference/get_current_screen
 */
function iaff_footer_text($default) {
    
	// Retun default on non-plugin pages
	$screen = get_current_screen();
	if ( $screen->id !== "settings_page_image-attributes-from-filename" ) {
		return $default;
	}
	
    $iaff_footer_text = sprintf( __( 'If you like this plugin, please <a href="%s" target="_blank">upgrade to pro</a> or leave a <a href="%s" target="_blank">&#9733;&#9733;&#9733;&#9733;&#9733;</a> rating to support continued development. Thanks a bunch!', 'abl_iaff_td' ), 
								'https://imageattributespro.com/?utm_source=iaff-basic&utm_medium=footer',
								'https://wordpress.org/support/plugin/auto-image-attributes-from-filename-with-bulk-updater/reviews/?rate=5#new-post' 
						);
						
	if( iaff_is_pro() ) {
		$iaff_footer_text = __( 'Thank you for choosing Image Attributes Pro! Use the support tab if you have any questions or feedback.', 'abl_iaff_td' );
	}
	
	return $iaff_footer_text;
}
add_filter('admin_footer_text', 'iaff_footer_text');

/**
 * Admin footer version
 *
 * @since	1.3
 */
function iaff_footer_version($default) {
	
	// Retun default on non-plugin pages
	$screen = get_current_screen();
	if ( $screen->id !== "settings_page_image-attributes-from-filename" ) {
		return $default;
	}
	
	return 'Plugin version ' . IAFF_VERSION_NUM;
}
add_filter( 'update_footer', 'iaff_footer_version', 11 );