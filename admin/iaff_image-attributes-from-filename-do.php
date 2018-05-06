<?php
/**
 * Operations of the plugin are included here. 
 *
 * @since 1.3
 * @function	iaff_auto_image_attributes()	Auto add image attributes from image filename for new uploads
 * @function	iaff_rename_old_image()			Auto add image attributes from image filename for existing uploads
 * @function	iaff_number_of_images_updated()	Count number of images updated by the bulk updater
 * @function	iaff_total_number_of_images()	Count total number of images in the database
 * @function	iaff_count_remaining_images()	Count remaining number of images to process
 * @function	iaff_reset_bulk_updater_counter()	Reset counter to zero so that bulk updating starts from scratch
 * @function	iaff_image_bulk_updater()		Bulk Updater Ajax
 * @function	iaff_lcb_restore_image_title()	Insert Image Title Into Post HTML
 * @function	iaff_upload_comma_prefilter()	Replace commas in filename with -_-
 */


// Exit if accessed directly
if ( !defined('ABSPATH') ) exit;


/**
 * Auto add image attributes from image filename for new uploads
 *
 * @since	1.0
 */
function iaff_auto_image_attributes( $post_ID ) {

	// Default Values For Settings
	global $defaults;
	
	// Get Settings
	$settings = get_option('iaff_settings', $defaults);

	$attachment = get_post( $post_ID );
	
	// Extract the image name from the image url
	$image_extension 	= pathinfo($attachment->guid);
	$attachment_title 	= basename($attachment->guid, '.'.$image_extension['extension']);
	
	$filter_chars = array();
	
	if ( isset( $settings['hyphens'] ) && boolval($settings['hyphens']) ) {
		$filter_chars[] = '-';	// Hypen
	}
	if ( isset( $settings['under_score'] ) && boolval($settings['under_score']) ) {
		$filter_chars[] = '_';	// Underscore
	}
	if ( isset( $settings['full_stop'] ) && boolval($settings['full_stop']) ) {
		$filter_chars[] = '.';	// Full stops
	}
	if ( isset( $settings['commas'] ) && boolval($settings['commas']) ) {
		$filter_chars[] = '-_-';	// WordPress removes commas during file upload. iaff_upload_comma_prefilter() replaces commas with -_- so that we can process commas here. 
	}
	
	// Remove characters
	if ( !empty($filter_chars) ) {
        $attachment_title = str_replace( $filter_chars, ' ', $attachment_title );
    }
	
	// Remove all numbers
	if ( isset( $settings['all_numbers'] ) && boolval($settings['all_numbers']) ) {
		$attachment_title = preg_replace('/[0-9]+/', '', $attachment_title);
	}
	
	// Final cleanup
	$attachment_title = preg_replace('/\s\s+/', ' ', $attachment_title); // Replace multiple spaces with a single spaces
	$attachment_title = trim($attachment_title);		// Remove white spaces from both ends
	$attachment_title = ucwords( $attachment_title );	// Capitalize First Word

	$uploaded_image			= array();
	$uploaded_image['ID'] 	= $post_ID;
	
	if ( isset( $settings['image_title'] ) && boolval($settings['image_title']) ) {
		$uploaded_image['post_title'] 	= $attachment_title;	// Image Title
	}
	if ( isset( $settings['image_caption'] ) && boolval($settings['image_caption']) ) {
		$uploaded_image['post_excerpt'] = $attachment_title;	// Image Caption
	}
	if ( isset( $settings['image_description'] ) && boolval($settings['image_description']) ) {
		$uploaded_image['post_content'] = $attachment_title;	// Image Description
	}
	if ( isset( $settings['image_alttext'] ) && boolval($settings['image_alttext']) ) {
		update_post_meta( $post_ID, '_wp_attachment_image_alt', $attachment_title ); // Image Alt Text
	}

	wp_update_post( $uploaded_image );
	
}
add_action( 'add_attachment', 'iaff_auto_image_attributes' );


/**
 * Auto add image attributes from image filename for existing uploads
 *
 * @since 	1.0
 */
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
	$image_extension 	= pathinfo($image->guid);
	$image_name 		= basename($image->guid, '.'.$image_extension['extension']);
	
	// Process the image name and neatify it
	$image_name = str_replace( '-', ' ', $image_name );	// replace hyphens with spaces
	$image_name = str_replace( '_', ' ', $image_name );	// replace underscores with spaces
	$image_name = ucwords( $image_name ); // Capitalize each word
	
	// Update the image Title, Caption and Description with the image name
	$updated_image = array(
	  'ID'           		=> $image->ID,
	  'post_title'			=> $image_name,	// Image Title
	  'post_excerpt'		=> $image_name,	// Image Caption
	  'post_content'		=> $image_name,	// Image Description
	);
	wp_update_post( $updated_image );
	
	// Update Image Alt Text (stored in post_meta table)
	update_post_meta( $image->ID, '_wp_attachment_image_alt', $image_name ); // Image Alt Text
	
	// Increment Counter And Update It
	$counter++;
	update_option( 'iaff_bulk_updater_counter', $counter );
	
	echo __('Image Attributes Updated For: ', 'abl_iaff_td') . $image->guid;
	wp_die();	
}
add_action( 'wp_ajax_iaff_rename_old_image', 'iaff_rename_old_image' );


/**
 * Print number of images updated by the bulk updater
 *
 * @since	1.0
 */
function iaff_number_of_images_updated() {
	
	$iaff_images_updated_counter = get_option('iaff_bulk_updater_counter');
	return $iaff_images_updated_counter;
}


/**
 * Count total number of images in the database
 *
 * @since 	1.0
 */
function iaff_total_number_of_images() {
	
	global $wpdb;
	$total_no_of_images = $wpdb->get_var("SELECT COUNT(ID) FROM {$wpdb->prefix}posts WHERE post_type='attachment'");
	
	return $total_no_of_images;
}

/**
 * Count remaining number of images to process
 *
 * @since	1.0
 * @return 	integer			Returns the number of remaining images to process. 
 * @param 	$force_return	When set as true the function will always return a value even when called from ajax. 
 */
function iaff_count_remaining_images( $force_return = false ) {
	
	$total_no_of_images = iaff_total_number_of_images();
	
	$no_of_images_processed = get_option('iaff_bulk_updater_counter');
	$no_of_images_processed = intval ($no_of_images_processed);
	
	$reamining_images = $total_no_of_images - $no_of_images_processed;
	
	// If called from Ajax echo the result. Else return as an integer. 
	// :TODO: Calling iaff_count_remaining_images() from Ajax for ignores the default value of $force_return for some reason. When I set if ( wp_doing_ajax() && $force_return === false ) this does not work even though they are logically equivalent. If you know why it is so, please email me - arunbasillal@gmail.com
	if ( wp_doing_ajax() && $force_return !== true ) {
		echo $reamining_images;
		wp_die();
	} else {
		return $reamining_images;
	}
}
add_action( 'wp_ajax_iaff_count_remaining_images', 'iaff_count_remaining_images' );


/**
 * Reset counter to zero so that bulk updating starts from scratch
 * 
 * @since	1.0
 */
function iaff_reset_bulk_updater_counter() {
	
	// Security Check
	check_ajax_referer( 'iaff_reset_counter_nonce', 'security' );
	
	update_option( 'iaff_bulk_updater_counter', '0' );
	
	$response = array(
		'message'			=> __('Counter reset. The bulk updater will start from scratch in the next run.', 'abl_iaff_td'),
		'remaining_images'	=> iaff_count_remaining_images(true),
	);
	wp_send_json($response);
}
add_action( 'wp_ajax_iaff_reset_bulk_updater_counter', 'iaff_reset_bulk_updater_counter' );


/**
 * Bulk Updater Ajax
 *
 * @since 1.0
 */
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
				$('#bulk-updater-log').append('<p>Number of Images Remaining: ' + response.remaining_images + '</p>');
				$('#bulk-updater-log').append('<p>Number of Images Updated: 0</p>');
				$("#bulk-updater-log").animate({scrollTop:$("#bulk-updater-log")[0].scrollHeight - $("#bulk-updater-log").height()},200);
				alert(response.message);
			});
		});
		
		// Run Bulk Updater
		$('.iaff_run_bulk_updater_button').click(function() {
			// Re-confirm from the user
			var r = confirm("You are about to update all images in the Media Library. This cannot be undone.\nPress OK to confirm.");
			if (r !== true) {
				$('#bulk-updater-log').append('<p class="iaff-red">Operation aborted by user.</p>');
				$("#bulk-updater-log").animate({scrollTop:$("#bulk-updater-log")[0].scrollHeight - $("#bulk-updater-log").height()},200);
				return;
			}
			
			// Notice to the user
			$('#bulk-updater-log').append('<p class="iaff-green">Initializing bulk updater. Be Patient and do not close the browser while it\'s running. In case you do, you can always resume by returning to this page later.</p>');
			$("#bulk-updater-log").animate({scrollTop:$("#bulk-updater-log")[0].scrollHeight - $("#bulk-updater-log").height()},200);

			// Count Remaining Images To Process
			data = {
				action: 'iaff_count_remaining_images',
			};
			
			var remaining_images = null;
			
			var reamining_images_count = $.post(ajaxurl, data, function (response) {
				remaining_images = response;
				console.log(remaining_images);	
			});
			
			// Loop For Each Image And Update Its Attributes
			reamining_images_count.done(function iaff_rename_image() {
			
				if(remaining_images > 0){
					data = {
						action: 'iaff_rename_old_image',
						security: '<?php echo wp_create_nonce( "iaff_rename_old_image_nonce" ); ?>'
					};
					
					var rename_image = $.post(ajaxurl, data, function (response) {
						$('#bulk-updater-log').append('<p>' + response + '</p>');
						$('#bulk-updater-log').append('<p>Images remaining: ' + (remaining_images-1) + '</p>');
						$("#bulk-updater-log").animate({scrollTop:$("#bulk-updater-log")[0].scrollHeight - $("#bulk-updater-log").height()},100);
						console.log(response);
					});
					
					rename_image.done(function() {
						remaining_images--;
						iaff_rename_image();
					});
				}
				else {
					$('#bulk-updater-log').append('<p class="iaff-green"><span class="dashicons dashicons-yes"></span>All done!</p>');
					$("#bulk-updater-log").animate({scrollTop:$("#bulk-updater-log")[0].scrollHeight - $("#bulk-updater-log").height()},200);
				}
			});
		});
	});	
	</script> <?php
}
add_action( 'admin_footer', 'iaff_image_bulk_updater' );


/**
 * Insert Image Title Into Post HTML
 *
 * Since WordPress 3.5 images inserted into posts do not have the title attribute with the image tag. 
 * The following functions were written by Les Bessant in his Restore Image Title plugin to restore the pre 3.5 feature.
 * @since	1.3
 * @author 	Les Bessant - https://profiles.wordpress.org/lesbessant
 * @refer	https://wordpress.org/plugins/restore-image-title/
 */
function iaff_lcb_restore_image_title( $html, $id ) {
	$attachment = get_post($id);
    if (strpos($html, "title=")) {
    	return $html;
    } else {
		$mytitle = esc_attr($attachment->post_title);
		return str_replace('<img', '<img title="' . $mytitle . '" '  , $html);      
	}
}
function iaff_lcb_restore_title_to_gallery( $content, $id ) {
	$thumb_title = get_the_title($id);
	return str_replace('<a', '<a title="' . esc_attr($thumb_title) . '" ', $content);
}

// Insert image title to post HTML only if it is enabled in the settings. Disabled by default. 
$settings = get_option('iaff_settings');
if ( isset($settings['image_title_to_html']) && ($settings['image_title_to_html'] == 1) ) {
	add_filter( 'media_send_to_editor', 'iaff_lcb_restore_image_title', 15, 2 );
	add_filter('wp_get_attachment_link', 'iaff_lcb_restore_title_to_gallery', 10, 4);
}


/**
 * Replace commas in filename with -_-
 *
 * WordPress removes commas during file upload. This function replaces commas with -_- so that we can replace them later. Without this red,pill.jpg will become redpill.jpg and we cannot extract the word 'Red Pill' with the space out of it. 
 * @since	1.3
 * @refer	https://codex.wordpress.org/Plugin_API/Filter_Reference/wp_handle_upload_prefilter
 */
function iaff_upload_comma_prefilter( $file ){
	$settings = get_option('iaff_settings');
	
	if ( isset($settings['commas']) && ($settings['commas'] == 1) ) {
		$file['name'] = str_replace( ',', '-_-', $file['name'] );
		return $file;
	} else {
		return $file;
	}
}
add_filter('wp_handle_upload_prefilter', 'iaff_upload_comma_prefilter' );
 
?>