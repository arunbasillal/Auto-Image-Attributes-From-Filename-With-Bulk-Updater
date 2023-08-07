<?php
/**
 * Loads the plugin files
 *
 * @since	1.3
 */

// Exit if accessed directly
if ( ! defined( 'ABSPATH' ) ) exit;

// Load basic setup. Plugin list links, text domain, footer links etc. 
require_once( IAFF_IMAGE_ATTRIBUTES_FROM_FILENAME_DIR . '/admin/basic-setup.php' );

// Load admin setup. Register menus and settings
require_once( IAFF_IMAGE_ATTRIBUTES_FROM_FILENAME_DIR . '/admin/admin-setup.php' );

// Render Admin UI
require_once( IAFF_IMAGE_ATTRIBUTES_FROM_FILENAME_DIR . '/admin/admin-ui-render.php' );
require_once( IAFF_IMAGE_ATTRIBUTES_FROM_FILENAME_DIR . '/admin/columns-media-library.php' );

// Do plugin operations
require_once( IAFF_IMAGE_ATTRIBUTES_FROM_FILENAME_DIR . '/admin/do.php' );