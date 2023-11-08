<?php 
/**
 * Basic setup functions for the plugin
 *
 * @since 1.3
 * @function	iaff_activate_plugin()			Plugin activatation todo list
 * @function	iaff_load_plugin_textdomain()	Load plugin text domain
 * @function	iaff_settings_link()			Print direct link to plugin settings in plugins list in admin
 * @function	iaff_plugin_row_meta()			Add donate and other links to plugins list
 * @function 	iaff_admin_notices()			Admin notices
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
	
	// Set the counter to 0 for the number of images updated by bulk updater.
	add_option( 'iaff_bulk_updater_counter', '0' );	// Setting numer of images processed as zero
	
	// Show admin notice
	set_transient( 'iaff_activation_admin_notice', true, 5 );
}

/**
 * Load plugin text domain
 *
 * @since	1.0
 */
function iaff_load_plugin_textdomain() {
    load_plugin_textdomain( 'auto-image-attributes-from-filename-with-bulk-updater', FALSE, IAFF_IMAGE_ATTRIBUTES_FROM_FILENAME_DIR . '/languages/' );
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
			'settings' => '<a href="' . admin_url( 'options-general.php?page=image-attributes-from-filename' ) . '">' . __( 'Settings', 'auto-image-attributes-from-filename-with-bulk-updater' ) . '</a>'
		),
		$links
	);
}
add_filter( 'plugin_action_links_auto-image-attributes-from-filename-with-bulk-updater/iaff_image-attributes-from-filename.php', 'iaff_settings_link' );

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
				'upgrade' 	=> '<a href="https://imageattributespro.com/?utm_source=iaff-basic&utm_medium=plugins-list" target="_blank">' . __( 'Upgrade To Image Attributes Pro', 'auto-image-attributes-from-filename-with-bulk-updater' ) . '</a>',
				);
		$links = array_merge( $links, $new_links );
	}
	
	return $links;
}
add_filter( 'plugin_row_meta', 'iaff_plugin_row_meta', 10, 2 );

/**
 * Admin notices
 * 
 * @since 1.5
 */
function iaff_admin_notices() {
	
	// Plugin activation notice
	if ( get_transient( 'iaff_activation_admin_notice' ) ) {
		
		echo '<div class="notice notice-success is-dismissible"><p>' . sprintf( __( 'Thank you for installing <strong>Auto Image Attributes From Filename With Bulk Updater</strong>! <a href="%s">Change settings &rarr;</a>', 'auto-image-attributes-from-filename-with-bulk-updater' ), admin_url( 'options-general.php?page=image-attributes-from-filename' ) ) . '</p></div>';
		
		// Delete transient
		delete_transient( 'iaff_activation_admin_notice' );
		
		// No more notices on plugin activation.
		return;
	}
	
	// Upgrade complete notice
	if ( get_transient( 'iaff_upgrade_complete_admin_notice' ) ) {
		
		echo '<div class="notice notice-success is-dismissible"><p>' . __( '<strong>Auto Image Attributes From Filename With Bulk Updater</strong> successfully updated. ', 'auto-image-attributes-from-filename-with-bulk-updater' ) . sprintf( __( '<br>Stay tuned to the latest image SEO news and receive helpful product updates. Subscribe to the <a href="%s" target="_blank">Image SEO Newsletter &rarr;</a>', 'auto-image-attributes-from-filename-with-bulk-updater' ), 'https://imageattributespro.com/newsletter/?utm_source=iaff-basic&utm_medium=upgrade-complete-admin-notice' ) . '</p></div>';
		
		// Delete transient
		delete_transient( 'iaff_upgrade_complete_admin_notice' );
	}

	// Image Attributes Pro activation notice (when activated from basic plugin sidebar)
	if ( get_transient( 'iaff_activate_image_attributes_pro_plugin_complete' ) ) {

		echo '<div class="notice notice-success is-dismissible"><p>' . __( 'Image Attributes Pro activated', 'auto-image-attributes-from-filename-with-bulk-updater' ) . '</p></div>';

		// Delete transient. 
		delete_transient( 'iaff_activate_image_attributes_pro_plugin_complete' );
	}
}
add_action( 'admin_notices', 'iaff_admin_notices' );

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
	
    $iaff_footer_text = sprintf( __( 'If you like this plugin, please <a href="%s" target="_blank">upgrade to pro</a> or leave a <a href="%s" target="_blank">&#9733;&#9733;&#9733;&#9733;&#9733;</a> rating to support continued development. Thanks a bunch!', 'auto-image-attributes-from-filename-with-bulk-updater' ), 
								'https://imageattributespro.com/?utm_source=iaff-basic&utm_medium=footer',
								'https://wordpress.org/support/plugin/auto-image-attributes-from-filename-with-bulk-updater/reviews/?rate=5#new-post' 
						);
						
	if( iaff_is_pro() ) {
		$iaff_footer_text = __( 'Thank you for choosing Image Attributes Pro! Use the support tab if you have any questions or feedback.', 'auto-image-attributes-from-filename-with-bulk-updater' );
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