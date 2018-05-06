<?php
/**
 * Fired when the plugin is uninstalled.
 *
 * Everything in uninstall.php will be executed when user decides to delete the plugin. 
 * @since		1.3
 */

// Exit if accessed directly
if ( !defined('ABSPATH') ) exit;

// If uninstall not called from WordPress, then die.
if ( !defined('WP_UNINSTALL_PLUGIN') ) die;

/**
 * Delete database entries
 *
 * @since		1.0
 */ 
delete_option( 'iaff_settings' );
delete_option( 'iaff_bulk_updater_counter' );
delete_option( 'abl_iaff_version' );