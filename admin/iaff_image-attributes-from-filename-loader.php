<?php
/**
 * Loads the plugin files
 *
 * @since	1.3
 */


// Exit if accessed directly
if ( ! defined('ABSPATH') ) exit;

// Load basic setup. Plugin list links, text domain, footer links etc. 
require_once( IAFF_IMAGE_ATTRIBUTES_FROM_FILENAME_DIR . '/admin/iaff_image-attributes-from-filename-basic-setup.php');

// Load admin setup. Register menus and settings
require_once( IAFF_IMAGE_ATTRIBUTES_FROM_FILENAME_DIR . '/admin/iaff_image-attributes-from-filename-admin-setup.php');

// Render Admin UI
require_once( IAFF_IMAGE_ATTRIBUTES_FROM_FILENAME_DIR . '/admin/iaff_image-attributes-from-filename-admin-ui-render.php');

// Do plugin operations
require_once( IAFF_IMAGE_ATTRIBUTES_FROM_FILENAME_DIR . '/admin/iaff_image-attributes-from-filename-do.php');