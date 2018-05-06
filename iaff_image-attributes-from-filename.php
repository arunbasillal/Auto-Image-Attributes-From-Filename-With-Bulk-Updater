<?php
/*
Plugin Name: Auto Image Attributes From Filename With Bulk Updater
Plugin URI: http://millionclues.com/portfolio/
Description: Automatically Add Image Title, Image Caption, Description And Alt Text From Image Filename. Since this plugin includes a bulk updater this can update both existing images in the Media Library and new images. 
Author: Arun Basil Lal
Author URI: http://millionclues.com
Version: 1.0
Text Domain: abl_iaff_td
Domain Path: /languages
License: GPL v2 - http://www.gnu.org/licenses/old-licenses/gpl-2.0.html
*/


/*------------------------------------------*/
/*			Plugin Setup Functions			*/
/*------------------------------------------*/

// Exit If Accessed Directly
if ( ! defined( 'ABSPATH' ) ) exit;


// Add Admin Menu Pages
// Refer: https://developer.wordpress.org/plugins/administration-menus/
function iaff_add_menu_links() {
	add_options_page( __('Auto Image Attributes','abl_iaff_td'), __('Image Attributes','abl_iaff_td'), 'manage_options', 'image-attributes-from-filename','iaff_admin_interface_render'  );
}
add_action( 'admin_menu', 'iaff_add_menu_links' );


// Print Direct Link To Plugin Settings In Plugins List In Admin
function iaff_settings_link( $links ) {
	return array_merge(
		array(
			'settings' => '<a href="' . admin_url( 'options-general.php?page=image-attributes-from-filename' ) . '">' . __( 'Settings', 'abl_iaff_td' ) . '</a>'
		),
		$links
	);
}
add_filter( 'plugin_action_links_' . plugin_basename(__FILE__), 'iaff_settings_link' );


// Add Donate Link to Plugins list
function iaff_plugin_row_meta( $links, $file ) {
	if ( strpos( $file, 'iaff_image-attributes-from-filename.php' ) !== false ) {
		$new_links = array(
				'donate' => '<a href="http://millionclues.com/donate/" target="_blank">Donate</a>',
				'kuttappi' => '<a href="http://kuttappi.com/" target="_blank">My Travelogue</a>',
				);
		$links = array_merge( $links, $new_links );
	}
	return $links;
}
add_filter( 'plugin_row_meta', 'iaff_plugin_row_meta', 10, 2 );


// Load Text Domain
function iaff_load_plugin_textdomain() {
    load_plugin_textdomain( 'abl_iaff_td', FALSE, basename( dirname( __FILE__ ) ) . '/languages/' );
}
add_action( 'plugins_loaded', 'iaff_load_plugin_textdomain' );


// Do Stuff On Plugin Activation
function iaff_activate_plugin() {
	add_option( 'iaff_image_attributes_from_filename_settings', '1' );	// Setting default value. 1 = enable Auto Image Attributes for new images on plugin install
	add_option( 'iaff_bulk_updater_counter', '0' );					// Setting numer of images processed as zero
}
register_activation_hook( __FILE__, 'iaff_activate_plugin' );


// Register Settings
function iaff_register_settings() {

	// Register Setting
	register_setting( 'iaff_image_attributes_from_filename_settings_group', 'iaff_image_attributes_from_filename_settings', 'boolval' );
	
	// Register A New Section
    add_settings_section(
        'iaff_auto_image_attributes_settings',		// ID
        __('Auto Image Attributes', 'abl_iaff_td'),	// Title
        'iaff_auto_image_attributes_callback',		// Callback Function
        'image-attributes-from-filename'			// Page slug
    );
	
	// Register a new field in the "iaff_auto_image_attributes_settings" section, inside the "image-attributes-from-filename" page
    add_settings_field(
        'iaff_auto_image_attributes_settings_field',			// ID
        __('Auto Image Attributes Setting', 'abl_iaff_td'),		// Title
        'iaff_auto_image_attributes_settings_field_callback',	// Callback function
        'image-attributes-from-filename',						// Page slug
        'iaff_auto_image_attributes_settings'					// Settings Section ID
    );
}
add_action( 'admin_init', 'iaff_register_settings' );


// Do Stuff On Plugin Uninstall
function iaff_uninstall_plugin() {
	delete_option( 'iaff_image_attributes_from_filename_settings' );
	delete_option( 'iaff_bulk_updater_counter' );
}
register_uninstall_hook(__FILE__, 'iaff_uninstall_plugin' );



/*--------------------------------------*/
/*			Admin Options Page			*/
/*--------------------------------------*/

function iaff_auto_image_attributes_callback()
{
	echo '<p>' . __('Enable this to automatically add Image Caption, Description and Alt Text from image title for new uploads.', 'abl_iaff_td') . '</p>';
}
 
// field content cb
function iaff_auto_image_attributes_settings_field_callback()
{	
	// Get the value of the setting we've registered with register_setting()
	$setting = get_option('iaff_image_attributes_from_filename_settings');

	// Output the field 
	// ID and name of form element should be same as the setting name. ?>
	<input type="checkbox" name="iaff_image_attributes_from_filename_settings" id="iaff_image_attributes_from_filename_settings" value="Enable Auto Image Attributes" <?php echo boolval($setting) ? 'checked' : '';?>><label for="iaff_image_attributes_from_filename_settings"><?php _e('Enable Auto Image Attributes', 'abl_iaff_td') ?></label>

	<?php
}

// Admin Interface Renderer
function iaff_admin_interface_render () {
	
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	}

	/* Commented out after moving menu location to Settings pages instead of Media as originally deisigned.
	// https://core.trac.wordpress.org/ticket/31000
	// Check if the user have submitted the settings
	// WordPress will add the "settings-updated" $_GET parameter to the url
	if ( isset( $_GET['settings-updated'] ) ) {
		// Add settings saved message with the class of "updated"
		add_settings_error( 'iaff_settings_saved_message', 'iaff_settings_saved_message', __( 'Settings are Saved', 'abl_iaff_td' ), 'updated' );
	}
 
	// Show Settings Saved Message
	settings_errors( 'iaff_settings_saved_message' ); */?> 
	
	<div class="wrap">	
		<h1>Auto Image Attributes From Filename With Bulk Updater</h1>
		
		<form action="options.php" method="post">		
			<?php
			// Output nonce, action, and option_page fields for a settings page.
			settings_fields( 'iaff_image_attributes_from_filename_settings_group' );
			
			// Prints out all settings sections added to a particular settings page. 
			do_settings_sections( 'image-attributes-from-filename' );	// Page slug
			
			// Output save settings button
			submit_button( __('Save Settings', 'abl_iaff_td') );
			?>
		</form>
		
		<h2><?php _e('Update Existing Images In Media Library', 'abl_iaff_td') ?></h2>
		
		<p style="color:red"><?php _e('IMPORTANT: Please backup your database before running the bulk updater.', 'abl_iaff_td') ?></p>
		<p><?php _e('Run this bulk updater to update Image Title, Caption, Description and Alt Text from image filename for existing images in the media library.', 'abl_iaff_td') ?></p>
		<p><?php _e('If your image is named a-lot-like-love.jpg, your Image Title, Caption, Description and Alt Text will be: A Lot Like Love.', 'abl_iaff_td') ?></p>
		<p><?php _e('Do not close the browser while it\'s running. In case you do, you can always resume by returning to this page later.', 'abl_iaff_td') ?></p> <?php
		
		submit_button( __('Run Bulk Updater', 'abl_iaff_td'), 'iaff_run_bulk_updater_button' ); ?>
		
		<p><?php _e('To restart processing images from the beginning (the oldest upload first), reset the counter.', 'abl_iaff_td') ?></p> <?php 
		submit_button( __('Reset Counter', 'abl_iaff_td'), 'iaff_reset_counter_button' ); ?>
		
		<p><?php _e('Number of Images Updated: ', 'abl_iaff_td') ?><span id="iaff_updated_counter"><?php iaff_number_of_images_updated(); ?></span></p>
		<p id="iaff_remaining_images_text" style="display: none;"><?php _e('Number of Images Remaining: ', 'abl_iaff_td') ?><span id="iaff_remaining_counter"><?php echo iaff_total_number_of_images(); ?></span></p>
		
		<span id="iaff_bulk_updater_results"></span>
		
	</div>
	<?php
}



/*--------------------------------------*/
/*			Plugin Operations			*/
/*--------------------------------------*/


// Auto Add Image Attributes From Image Filename
function iaff_auto_image_attributes( $post_ID ) {

	// Check if Auto Image Attributes is enabled
	$setting = get_option('iaff_image_attributes_from_filename_settings');
	if ( ! boolval($setting) ) {
		return;
	}

	$attachment 		= get_post( $post_ID );
	$attachment_title 	= $attachment->post_title;
	
	$attachment_title 	= str_replace( '-', ' ', $attachment_title );	// Hyphen Removal
	$attachment_title 	= ucwords( $attachment_title );					// Capitalize First Word

	$uploaded_image               	= array();
	$uploaded_image['ID']         	= $post_ID;
	$uploaded_image['post_title'] 	= $attachment_title;	// Image Title
	$uploaded_image['post_excerpt'] = $attachment_title;	// Image Caption
	$uploaded_image['post_content'] = $attachment_title;	// Image Description
	
	update_post_meta( $post_ID, '_wp_attachment_image_alt', $attachment_title ); // Image Alt Text

	wp_update_post( $uploaded_image );
	
}
add_action( 'add_attachment', 'iaff_auto_image_attributes' );


// Auto Add Image Attributes From Image Filename For Existing Uploads
function iaff_rename_old_image() {

	// Security Check
	check_ajax_referer( 'iaff_rename_old_image_nonce', 'security' );

	// Retrieve Counter
	$counter = get_option('iaff_bulk_updater_counter');
	$counter = intval ($counter);

	global $wpdb;
	$image = $wpdb->get_row("SELECT ID,guid FROM {$wpdb->prefix}posts WHERE post_type='attachment' ORDER BY post_date LIMIT 1 OFFSET {$counter}");
	
	// Die If No Image
	if ($image === NULL) {
		wp_die();
	}
	
	// Extract the image name from the image url
	$image_extension = pathinfo($image->guid);
	$image_name = basename($image->guid, '.'.$image_extension['extension']);
	
	// Process the image name and neatify it
	$image_name = str_replace( '-', ' ', $image_name );	// replace hyphens with spaces
	$image_name = ucwords( $image_name ); // Capitalize each word
	
	// Update the image Title, Caption and Description with the image name
	$updated_image = array(
	  'ID'           	=> $image->ID,
	  'post_title'		=> $image_name,	// Image Title
	  'post_excerpt'		=> $image_name,	// Image Caption
	  'post_content'		=> $image_name,	// Image Description
	);
	wp_update_post( $updated_image );
	
	// Update Image Alt Text (stored in post_meta table)
	update_post_meta( $image->ID, '_wp_attachment_image_alt', $image_name ); // Image Alt Text
	
	// Increment Counter And Update It
	$counter++;
	update_option( 'iaff_bulk_updater_counter', $counter );
	
	echo __('Image Attributes Updated For Image: ', 'abl_iaff_td') . $image->guid;
	wp_die();	
}
add_action( 'wp_ajax_iaff_rename_old_image', 'iaff_rename_old_image' );


// Print Number Of Images Updated By The Bulk Updater
function iaff_number_of_images_updated() {
	
	$iaff_images_updated_counter = get_option('iaff_bulk_updater_counter');
	echo $iaff_images_updated_counter;
}


// Count Total Number Of Images In The Database
function iaff_total_number_of_images() {
	
	global $wpdb;
	$total_no_of_images = $wpdb->get_var("SELECT COUNT(ID) FROM {$wpdb->prefix}posts WHERE post_type='attachment'");
	
	return $total_no_of_images;
}

// Count Remaining Number Of Images To Process
function iaff_count_remaining_images() {
	
	$total_no_of_images = iaff_total_number_of_images();
	
	$no_of_images_processed = get_option('iaff_bulk_updater_counter');
	$no_of_images_processed = intval ($no_of_images_processed);
	
	$reamining_images = $total_no_of_images - $no_of_images_processed;
	echo $reamining_images;
	
	wp_die();
}
add_action( 'wp_ajax_iaff_count_remaining_images', 'iaff_count_remaining_images' );


// Reset Counter To Zero So That Bulk Updating Starts From Scratch
function iaff_reset_bulk_updater_counter() {
	
	// Security Check
	check_ajax_referer( 'iaff_reset_counter_nonce', 'security' );
	
	update_option( 'iaff_bulk_updater_counter', '0' );
	echo __('Counter reset. The bulk updater will start from scratch in the next run.', 'abl_iaff_td');
	
	wp_die();
}
add_action( 'wp_ajax_iaff_reset_bulk_updater_counter', 'iaff_reset_bulk_updater_counter' );


// Bulk Updater Ajax
function iaff_image_bulk_updater() { 
	
	// Load Ajax Only On Plugin Page
	$screen = get_current_screen();
	if ( $screen->id !== "settings_page_image-attributes-from-filename" ) {
		return;
	}?>

	<script type="text/javascript" >
	jQuery(document).ready(function($) {	
		// Reset Bulk Updater Counter
		$('.iaff_reset_counter_button').click(function() {		
			data = {
				action: 'iaff_reset_bulk_updater_counter',
				security: '<?php echo wp_create_nonce( "iaff_reset_counter_nonce" ); ?>'
			};
			
			$.post(ajaxurl, data, function (response) {
				alert(response);
				$('#iaff_updated_counter').text('0');
			});
		});
		
		// Run Bulk Updater
		$('.iaff_run_bulk_updater_button').click(function() {
			// Count Remaining Images To Process
			data = {
				action: 'iaff_count_remaining_images'
			};
			
			var remaining_images = null;
			
			var reamining_images_count = $.post(ajaxurl, data, function (response) {
				remaining_images = response;
				console.log(remaining_images);	
			});
			
			// Loop For Each Image And Update Its Attributes
			reamining_images_count.done(function iaff_rename_image() {
			
				if(remaining_images > 0){
				
					$('#iaff_remaining_images_text').show();						// Show the text for remaining images
					
					data = {
						action: 'iaff_rename_old_image',
						security: '<?php echo wp_create_nonce( "iaff_rename_old_image_nonce" ); ?>'
					};
					
					var rename_image = $.post(ajaxurl, data, function (response) {
						$('#iaff_bulk_updater_results').append('<p>' + response + '</p>');
						var updated_counter = parseInt($('#iaff_updated_counter').text());
						$('#iaff_updated_counter').text(updated_counter+1);			// Update total number of images updated
						$('#iaff_remaining_counter').text(remaining_images-1);		// Update total number of images remaining
						console.log(response);
					});
					
					rename_image.done(function() {
						remaining_images--;
						iaff_rename_image();
					});
				}
				else {
					$('#iaff_bulk_updater_results').append('<p>All done!</p>')
					$('#iaff_remaining_counter').text('All done!')
				}
			});
		});
	});	
	</script> <?php
}
add_action( 'admin_footer', 'iaff_image_bulk_updater' );
?>