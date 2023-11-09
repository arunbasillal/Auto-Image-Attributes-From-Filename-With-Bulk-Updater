<?php
/**
 * Admin setup for the plugin
 *
 * @since 1.3
 * @function	iaff_add_menu_links()		Add admin menu pages
 * @function	iaff_register_settings()	Register Settings
 * @function	iaff_get_settings()			Set global default values for settings
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
	
	if ( iaff_is_pro() ) {
		$iaff_plugin_title 	= 'Image Attributes Pro';
		$iaff_menu_title 	= 'Image Attributes Pro';
	} else {
		$iaff_plugin_title 	= 'Auto Image Attributes';
		$iaff_menu_title 	= 'Image Attributes';
	}
	
	add_options_page( $iaff_plugin_title, $iaff_menu_title, 'manage_options', 'image-attributes-from-filename','iaff_admin_interface_render'  );
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
		'iaff_settings', 		// Setting Name = HTML form <input> name on settings form
		'iaff_settings_validater_and_sanitizer'
	);
	
	// Register Basic Settings Section
    add_settings_section(
        'iaff_basic_settings_section_id',			// ID
        __('Basic Settings','auto-image-attributes-from-filename-with-bulk-updater'),			// Title
        '__return_false',							// Callback Function
        'iaff_basic_settings_section'				// Page slug
    );
		
		// General Settings
		add_settings_field(
			'iaff_general_settings',					// ID
			__( 'General Settings<p class="iaff-description">Select image attributes that should be automatically generated when you upload a new image.</p>', 'auto-image-attributes-from-filename-with-bulk-updater' ),		// Title
			'iaff_general_settings_callback',			// Callback function
			'iaff_basic_settings_section',				// Page slug
			'iaff_basic_settings_section_id'			// Settings Section ID
		);
		
		// Filter Settings
		add_settings_field(
			'iaff_filter_settings',						// ID
			__( 'Filter Settings<p class="iaff-description">Selected characters will be removed from filename text before using them as image attributes.</p>', 'auto-image-attributes-from-filename-with-bulk-updater' ),		// Title
			'iaff_filter_settings_callback',			// Callback function
			'iaff_basic_settings_section',				// Page slug
			'iaff_basic_settings_section_id'			// Settings Section ID
		);
		
		// Basic SEO Settings
		add_settings_field(
			'iaff_basic_seo_settings',					// ID
			__('Basic SEO Settings', 'auto-image-attributes-from-filename-with-bulk-updater'),	// Title
			'iaff_basic_seo_settings_callback',			// Callback function
			'iaff_basic_settings_section',				// Page slug
			'iaff_basic_settings_section_id'			// Settings Section ID
		);
		
		// Preview Pro Features
		if ( ! iaff_is_pro() ) {
			
			add_settings_field(
				'iaff_preview_pro_settings',				// ID
				__('Preview Pro Features', 'auto-image-attributes-from-filename-with-bulk-updater'),	// Title
				'iaff_preview_pro_settings_callback',		// Callback function
				'iaff_basic_settings_section',				// Page slug
				'iaff_basic_settings_section_id'			// Settings Section ID
			);
		}
	
	// Register Advanced Settings Section
    add_settings_section(
        'iaff_advanced_settings_section_id',		// ID
        __('Advanced Settings','auto-image-attributes-from-filename-with-bulk-updater'),		// Title
        '__return_false',							// Callback Function
        'iaff_advanced_settings_section'			// Page slug
    );
	
		// Advanced Filter
		add_settings_field(
			'iaff_advanced_filter_settings',			// ID
			__( 'Advanced Filter<p class="iaff-description">Selected characters will be removed from filename text before using them as image attributes.</p>', 'auto-image-attributes-from-filename-with-bulk-updater' ),		// Title
			'iaff_advanced_filter_callback',			// Callback function
			'iaff_advanced_settings_section',			// Page slug
			'iaff_advanced_settings_section_id'			// Settings Section ID
		);
		
		// Custom Filter
		add_settings_field(
			'iaff_custom_filter_settings',				// ID
			__('Custom Filter', 'auto-image-attributes-from-filename-with-bulk-updater'),			// Title
			'iaff_custom_filter_callback',				// Callback function
			'iaff_advanced_settings_section',			// Page slug
			'iaff_advanced_settings_section_id'			// Settings Section ID
		);
		
		// Capitalization Settings
		add_settings_field(
			'iaff_capitalization_settings',				// ID
			__('Capitalization Settings', 'auto-image-attributes-from-filename-with-bulk-updater'),// Title
			'iaff_capitalization_callback',				// Callback function
			'iaff_advanced_settings_section',			// Page slug
			'iaff_advanced_settings_section_id'			// Settings Section ID
		);
		
		// Image Title Settings
		add_settings_field(
			'iaff_image_title_settings',				// ID
			__('Image Title Settings', 'auto-image-attributes-from-filename-with-bulk-updater'),	// Title
			'iaff_advanced_image_title_callback',		// Callback function
			'iaff_advanced_settings_section',			// Page slug
			'iaff_advanced_settings_section_id'			// Settings Section ID
		);
		
		// Image Alt Text Settings
		add_settings_field(
			'iaff_image_alt_text_settings',				// ID
			__('Image Alt Text Settings', 'auto-image-attributes-from-filename-with-bulk-updater'),// Title
			'iaff_advanced_image_alt_text_callback',	// Callback function
			'iaff_advanced_settings_section',			// Page slug
			'iaff_advanced_settings_section_id'			// Settings Section ID
		);
		
		// Image Caption Settings
		add_settings_field(
			'iaff_image_caption_settings',				// ID
			__('Image Caption Settings', 'auto-image-attributes-from-filename-with-bulk-updater'),// Title
			'iaff_advanced_image_caption_callback',		// Callback function
			'iaff_advanced_settings_section',			// Page slug
			'iaff_advanced_settings_section_id'			// Settings Section ID
		);
		
		// Image Description Settings
		add_settings_field(
			'iaff_image_description_settings',			// ID
			__('Image Description Settings', 'auto-image-attributes-from-filename-with-bulk-updater'),// Title
			'iaff_advanced_image_description_callback',	// Callback function
			'iaff_advanced_settings_section',			// Page slug
			'iaff_advanced_settings_section_id'			// Settings Section ID
		);
		
		// Miscellaneous Settings
		add_settings_field(
			'iaff_miscellaneous_settings',				// ID
			__('Miscellaneous Settings', 'auto-image-attributes-from-filename-with-bulk-updater'),// Title
			'iaff_miscellaneous_callback',				// Callback function
			'iaff_advanced_settings_section',			// Page slug
			'iaff_advanced_settings_section_id'			// Settings Section ID
		);
	
	// Register Bulk Updater Settings Section
    add_settings_section(
        'iaff_bu_settings_section_id',				// ID
        __('Bulk Updater Settings','auto-image-attributes-from-filename-with-bulk-updater'),	// Title
        '__return_false',							// Callback Function
        'iaff_bu_settings_section'					// Page slug
    );
	
		// General Settings
		add_settings_field(
			'iaff_bu_general_settings',						// ID
			__( 'General Settings<p class="iaff-description">Select image attributes that should be updated when you run the Bulk Updater.</p>', 'auto-image-attributes-from-filename-with-bulk-updater' ),			// Title
			'iaff_bu_general_settings_callback',			// Callback function
			'iaff_bu_settings_section',						// Page slug
			'iaff_bu_settings_section_id'					// Settings Section ID
		);
		
		// Image Title Settings
		add_settings_field(
			'iaff_bu_image_title_settings',					// ID
			sprintf( __( 'Image Title Settings<p class="iaff-description">Recommended to update in both the Media Library and post HTML. <a href="%s" target="_blank">Read more.</a></p>', 'auto-image-attributes-from-filename-with-bulk-updater'), 'https://imageattributespro.com/how-wordpress-store-image-attributes/?utm_source=iaff-basic&utm_medium=bulk-updater-settings-tab' ),		// Title
			'iaff_bu_image_title_settings_callback',		// Callback function
			'iaff_bu_settings_section',						// Page slug
			'iaff_bu_settings_section_id',					// Settings Section ID
			array(
				'class'	=> 'iaff_bu_image_title_settings',
			)
		);
		
		// Image Alt Text Settings
		add_settings_field(
			'iaff_bu_image_alttext_settings',					// ID
			sprintf( __('Image Alt Text Settings<p class="iaff-description">Recommended to update in both the Media Library and post HTML. <a href="%s" target="_blank">Read more.</a></p>', 'auto-image-attributes-from-filename-with-bulk-updater'), 'https://imageattributespro.com/how-wordpress-store-image-attributes/?utm_source=iaff-basic&utm_medium=bulk-updater-settings-tab' ),	// Title
			'iaff_bu_image_alttext_settings_callback',			// Callback function
			'iaff_bu_settings_section',						// Page slug
			'iaff_bu_settings_section_id',					// Settings Section ID
			array(
				'class'	=> 'iaff_bu_image_alttext_settings',
			)
		);
		
		// Image Caption Settings
		add_settings_field(
			'iaff_bu_image_caption_settings',				// ID
			__('Image Caption Settings<p class="iaff-description">Caption is updated only in the Media Library.</p>', 'auto-image-attributes-from-filename-with-bulk-updater'),	// Title
			'iaff_bu_image_caption_settings_callback',		// Callback function
			'iaff_bu_settings_section',						// Page slug
			'iaff_bu_settings_section_id',					// Settings Section ID
			array(
				'class'	=> 'iaff_bu_image_caption_settings',
			)
		);
		
		// Image Description Settings
		add_settings_field(
			'iaff_bu_image_description_settings',				// ID
			__('Image Description Settings<p class="iaff-description">Description is updated only in the Media Library.</p>', 'auto-image-attributes-from-filename-with-bulk-updater'),// Title
			'iaff_bu_image_description_settings_callback',	// Callback function
			'iaff_bu_settings_section',						// Page slug
			'iaff_bu_settings_section_id',					// Settings Section ID
			array(
				'class'	=> 'iaff_bu_image_description_settings',
			)
		);

}
add_action( 'admin_init', 'iaff_register_settings' );

/**
 * Input validator and sanitizer
 *
 * @since 1.4
 * 
 * @param Array	$settings An array that contains all the settings
 * 
 * @return Array Array containing all the settings
 */
function iaff_settings_validater_and_sanitizer( $settings ) {
	
	// Sanitize Custom Filter
	$settings['custom_filter']	= sanitize_text_field( $settings['custom_filter'] );

	// Validating Regex
	if ( @preg_match( $settings['regex_filter'], null ) === false ) {
		unset( $settings['regex_filter'] );
	}
	
	// Sanitize Custom Attributes
	$settings['custom_attribute_title'] 			= iaff_sanitize_text_field( $settings['custom_attribute_title'] );
	$settings['custom_attribute_alt_text'] 			= iaff_sanitize_text_field( $settings['custom_attribute_alt_text'] );
	$settings['custom_attribute_caption'] 			= iaff_sanitize_text_field( $settings['custom_attribute_caption'] );
	$settings['custom_attribute_description'] 		= iaff_sanitize_text_field( $settings['custom_attribute_description'] );
	
	return $settings;
}

/**
 * Extend sanitize_text_field() to preserve %category% custom attribute tag.
 * 
 * sanitize_text_field() converts %category% to tegory%.
 * Here %category% is replaced with IAFF_CATEGORY_CUSTOM_TAG keyword before sanitization. 
 * Then IAFF_CATEGORY_CUSTOM_TAG is replaced with %category% after sanitization. 
 * 
 * @since 3.1
 * 
 * @param (String) $str String to be sanitized.
 * 
 * @return (String) Sanitized string with %category% preserved. 
 */
function iaff_sanitize_text_field( $str ) {

	$str = str_replace( '%category%', 'IAFF_CATEGORY_CUSTOM_TAG', $str );
	$str = sanitize_text_field( $str );
	$str = str_replace( 'IAFF_CATEGORY_CUSTOM_TAG', '%category%', $str );

	return $str;
}

/**
 * Set global default values for settings
 *
 * @since 	1.4
 * @return	Array	A merged array of default and settings saved in database. 
 */
function iaff_get_settings() {

	$iaff_defaults = array(
		'image_title' 				=> '1',
		'image_caption' 			=> '1',
		'image_description' 		=> '1',
		'image_alttext' 			=> '1',

		'image_title_to_html' 		=> '1',

		'preview_pro'				=> '0',

		'hyphens' 					=> '1',
		'under_score' 				=> '1',

		'capitalization'			=> '0',

		'title_source'				=> '0',
		'alt_text_source'			=> '0',
		'caption_source'			=> '0',
		'description_source'		=> '0',

		'clean_filename'			=> '1',

		'bu_image_title' 			=> '1',
		'bu_image_caption' 			=> '1',
		'bu_image_description' 		=> '1',
		'bu_image_alttext' 			=> '1',

		'bu_title_location_ml'		=> '1',
		'bu_title_location_post'	=> '1',
		'bu_title_behaviour'		=> '2',

		'bu_alt_text_location_ml'	=> '1',
		'bu_alt_text_location_post'	=> '1',
		'bu_alt_text_behaviour'		=> '2',

		'bu_caption_location_ml'	=> '1',
		'bu_caption_behaviour'		=> '1',

		'bu_description_location_ml'=> '1',
		'bu_description_behaviour'	=> '1',
	);

	$settings = get_option( 'iaff_settings', $iaff_defaults );

	/**
	 * Add compatibility for Image Attributes Pro 4.2 or lower. 
	 * 
	 * In a case where the basic plugin is version 4.3 or higher but Image Attributes Pro is 4.2 or lower,
	 * make sure that the older settings are still available.
	 */
	if ( defined( 'IAFFPRO_VERSION_NUM' ) && version_compare( IAFFPRO_VERSION_NUM, '4.2', '<=' ) ) {

		$deprecated_settings = array(
			'bu_hyphens',
			'bu_under_score',
			'bu_full_stop',
			'bu_commas',
			'bu_all_numbers',
			'bu_apostrophe',
			'bu_tilde',
			'bu_plus',
			'bu_pound',
			'bu_ampersand',
			'bu_round_brackets',
			'bu_square_brackets',
			'bu_curly_brackets',
			'bu_custom_filter',
			'bu_regex_filter',
			'bu_capitalization',
			'bu_title_source',
			'custom_attribute_bu_title',
			'bu_alt_text_source',
			'custom_attribute_bu_alt_text',
			'bu_caption_source',
			'custom_attribute_bu_caption',
			'bu_description_source',
			'custom_attribute_bu_description',
		);

		foreach( $deprecated_settings as $deprecated_setting ) {

			// All these deprecated settings are replaced by their equivalent setting without the bu_ prefix.
			$replacement_setting = str_replace( 'bu_', '', $deprecated_setting );

			if ( isset( $settings[$replacement_setting] ) ) {
				$settings[$deprecated_setting] = $settings[$replacement_setting];
			}
		}

		/**
		 * bu_titles_in_post became bu_title_behaviour in 4.3 and
		 * bu_alt_text_in_post became bu_alt_text_behaviour in 4.3.
		 */
		$settings['bu_titles_in_post'] = $settings['bu_title_behaviour'];
		$settings['bu_alt_text_in_post'] = $settings['bu_alt_text_behaviour'];
	}
	
	return $settings;
}

/**
 * Load Admin Side Js and CSS
 *
 * Used for styling the plugin pages and bulk updater.
 * @since	1.3
 */
function iaff_enqueue_js_and_css() {
	
	// Load files only on plugin screens
	$screen = get_current_screen();
	if ( $screen->id !== "settings_page_image-attributes-from-filename" ) {
		return;
	}
	
	// Custom IAFF Styling
    wp_enqueue_style( 'iaff-style', plugins_url( '/css/iaff-style.css', __FILE__ ), '', IAFF_VERSION_NUM );
	
	// Custom IAFF JS
	wp_enqueue_script( 'iaff-js', plugins_url('/js/iaff-js.js', __FILE__), array( 'jquery', 'jquery-ui-dialog' ), IAFF_VERSION_NUM, true );
	
	// jQuery Dialog CSS
	wp_enqueue_style( 'wp-jquery-ui-dialog' );
	
	// Google Fonts
	wp_enqueue_style('iaff-google-font', 'https://fonts.googleapis.com/css?family=Patua+One', array(), null, 'all');
}
add_action( 'admin_enqueue_scripts', 'iaff_enqueue_js_and_css' );

/**
 * Tags for custom attribute
 * 
 * @since 2.1
 */
function iaff_custom_attribute_tags() {
	
	$available_tags = array(
		'filename'			=> __( 'Image filename', 'auto-image-attributes-from-filename-with-bulk-updater' ),
		'posttitle'			=> __( 'Title of the post, page or product where the image is used', 'auto-image-attributes-from-filename-with-bulk-updater' ),
		'sitetitle'			=> __( 'Site Title defined in WordPress General Settings', 'auto-image-attributes-from-filename-with-bulk-updater' ),
		'category'			=> __( 'Post or product Category', 'auto-image-attributes-from-filename-with-bulk-updater' ),
		'tag'				=> __( 'Post or product Tag', 'auto-image-attributes-from-filename-with-bulk-updater' ),
		'excerpt'			=> __( 'Excerpt or product short description', 'auto-image-attributes-from-filename-with-bulk-updater' ),
		'copymedialibrary'	=> __( 'Copy attribute from Media Library', 'auto-image-attributes-from-filename-with-bulk-updater' ),
		'imagetitle'		=> __( 'Image Title', 'auto-image-attributes-from-filename-with-bulk-updater' ),
		'imagealttext'		=> __( 'Image Alt Text', 'auto-image-attributes-from-filename-with-bulk-updater' ),
		'imagecaption'		=> __( 'Image Caption', 'auto-image-attributes-from-filename-with-bulk-updater' ),
		'imagedescription'	=> __( 'Image Description', 'auto-image-attributes-from-filename-with-bulk-updater' ),
	);
	
	/**
	 * Filter the custom attribute tags. 
	 * Used by Image Attributes Pro to add custom tags like %yoastfocuskw% and %rankmathfocuskw% dynamically. 
	 * 
	 * @since 3.1
	 * 
	 * @param $available_tags (array) Array containing all custom attribute tags.
	 */
	return apply_filters( 'iaff_custom_attribute_tags', $available_tags );
}

/**
 * Activate Image Attributes Pro plugin from the sidebar.
 * 
 * In the basic version, there is a sidebar to up sell Image Attributes Pro. When the pro plugin is installed, 
 * and not activated, the button to buy is replaced with activate Image Attributes Pro. Activation is handled here.
 * 
 * Using WordPress native activation (using plugins.php?action=activate... link) redirects to the Plugins list after activation.
 * There isn't an evident way to control the redirection after plugin activation without using activate_plugin().
 * 
 * @since 4.4
 */
function iaff_activate_image_attributes_pro_plugin() {
	
	// Add a fallback if wp_get_referer() returns false.
	$redirect_url = wp_get_referer() === false ? admin_url( 'options-general.php?page=image-attributes-from-filename' ) : wp_get_referer();

	// Authentication
	if ( 
		! current_user_can( 'manage_options' ) || 
		! ( isset( $_GET['iaff_activate_image_attributes_pro_plugin_nonce_name'] ) && wp_verify_nonce( $_GET['iaff_activate_image_attributes_pro_plugin_nonce_name'], 'activate_image_attributes_pro_plugin' ) ) || 
		is_plugin_active( 'auto-image-attributes-pro/auto-image-attributes-pro.php' )
	) {
		
		// Return to referer if authentication fails or if plugin is already active.
		wp_redirect( $redirect_url );
		exit;
	}

	$activation_status = activate_plugin( 'auto-image-attributes-pro/auto-image-attributes-pro.php', $redirect_url );

	if ( $activation_status === null ) {
		// Show admin notice to inform that the operation was successful. 
		set_transient( 'iaff_activate_image_attributes_pro_plugin_complete', true, 100 );
	}
}
add_action( 'admin_post_iaff_activate_image_attributes_pro_plugin', 'iaff_activate_image_attributes_pro_plugin' );