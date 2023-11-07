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
 * @function	iaff_before_bulk_updater()		Wrapper for functions to run before running bulk updater
 * @function	iaff_after_bulk_updater()		Wrapper for functions to run after running bulk updater
 * @function	iaff_image_bulk_updater()		Bulk Updater Ajax
 * @function	iaff_lcb_restore_image_title()	Insert Image Title Into Post HTML
 * @function	iaff_clean_filename()			Replace commas in filename with -
 * @function	iaff_image_name_from_filename()	Extract, format and return image name from filename
 * @function	iaff_update_image()				Update Image Attributes in database
 * @function	boolval()						Get the boolean value of a variable
 * @function	iaff_is_pro()					Check if IAFF Pro is installed
 */

// Exit if accessed directly
if ( ! defined('ABSPATH') ) exit;

/**
 * Auto add image attributes from image filename for new uploads.
 *
 * @since 1.0
 * @since 4.3 Added post meta iaff_wp_attachment_original_post_title to save WordPress generated image title from image filename.
 * 
 * @param $post_id (int) Attachment ID.
 */
function iaff_auto_image_attributes( $post_id ) {
	
	// Return if attachment is not an image
	if( ! wp_attachment_is_image( $post_id ) ) {
		return;
	}

	// Retrieve image object from its ID
	$image = get_post( $post_id );

	// Save WordPress generated image title (saved as post_title) into a post meta. This is based on image filename.
	add_post_meta( $post_id, 'iaff_wp_attachment_original_post_title', $image->post_title, true );
	
	// Image Attributes Pro
	if ( iaff_is_pro() ) {
		
		// Running the pro module
		iaffpro_auto_image_attributes_pro( $image );
		
	} else {
		
		// Get the image name from filename
		$image_name = iaff_image_name_from_filename( $post_id );
		
		// Update image attributes
		iaff_update_image( $post_id, $image_name );
	}
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
	$image = $wpdb->get_row("SELECT ID, post_parent FROM {$wpdb->prefix}posts WHERE post_type='attachment' AND post_mime_type LIKE 'image%' ORDER BY post_date LIMIT 1 OFFSET {$counter}");
	
	// Die if no image
	if ($image === NULL) {
		wp_die();
	}
	
	// Image Attributes Pro
	if ( iaff_is_pro() ) {

		// Get the object of the image form image ID.
		$image_object = get_post( $image->ID );
		
		// Running the pro module
		iaffpro_auto_image_attributes_pro( $image_object, true );
		
	} else {
		
		// Get the image name from filename
		$image_name = iaff_image_name_from_filename($image->ID, true);
		
		// Update image attributes
		iaff_update_image($image->ID, $image_name, true);
	}
	
	// Increment counter and update it
	$counter++;
	update_option( 'iaff_bulk_updater_counter', $counter );
	
	// Extract the image url
	$image_url = wp_get_attachment_url($image->ID);
	
	// Update Event log
	echo __('Image attributes updated for: ', 'auto-image-attributes-from-filename-with-bulk-updater') . '<a href="'. get_edit_post_link($image->ID) .'">'. $image_url .'</a>';
	
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
	$total_no_of_images = $wpdb->get_var("SELECT COUNT(ID) FROM {$wpdb->prefix}posts WHERE post_type='attachment' AND post_mime_type LIKE 'image%'");
	
	return $total_no_of_images;
}

/**
 * Count remaining number of images to process.
 *
 * @since 1.0
 * @since 4.0 Removed the $force_return param which when set to false would echo the result. Created iaff_echo_count_remaining_images() for that.
 * 
 * @return (integer) Returns the number of remaining images to process. 
 */
function iaff_count_remaining_images() {
	
	$total_no_of_images = iaff_total_number_of_images();
	
	$no_of_images_processed = get_option('iaff_bulk_updater_counter');
	$no_of_images_processed = intval( $no_of_images_processed );
	
	return max( $total_no_of_images - $no_of_images_processed, 0 );
}

/**
 * Wrapper for iaff_count_remaining_images() to echo the result.
 *
 * @since 4.0
 */
function iaff_echo_count_remaining_images() {
	echo iaff_count_remaining_images();
	wp_die();
}
add_action( 'wp_ajax_iaff_count_remaining_images', 'iaff_echo_count_remaining_images' );


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
		'message'			=> __('Counter reset. The bulk updater will start from scratch in the next run.', 'auto-image-attributes-from-filename-with-bulk-updater'),
		'remaining_images'	=> iaff_count_remaining_images(),
	);
	wp_send_json($response);
}
add_action( 'wp_ajax_iaff_reset_bulk_updater_counter', 'iaff_reset_bulk_updater_counter' );

/**
 * Wrapper for functions to run before running bulk updater
 * 
 * @since	1.4
 */
function iaff_before_bulk_updater() {
	
	// Security Check
	check_ajax_referer( 'iaff_before_bulk_updater_nonce', 'security' );
	
	/**
	 * Action hook that is fired at the start of the Bulk Updater before updating any image.
	 * 
	 * @link https://imageattributespro.com/codex/iaff_before_bulk_updater/
	 */
	do_action('iaff_before_bulk_updater');

	wp_die();
}
add_action( 'wp_ajax_iaff_before_bulk_updater', 'iaff_before_bulk_updater' );

/**
 * Wrapper for functions to run after running bulk updater
 * 
 * @since	1.4
 */
function iaff_after_bulk_updater() {
	
	// Security Check
	check_ajax_referer( 'iaff_after_bulk_updater_nonce', 'security' );
	
	/**
	 * Action hook that is fired at the end of the Bulk Updater after updating all images.
	 * 
	 * @link https://imageattributespro.com/codex/iaff_after_bulk_updater/
	 */
	do_action('iaff_after_bulk_updater');

	wp_die();
}
add_action( 'wp_ajax_iaff_after_bulk_updater', 'iaff_after_bulk_updater');

/**
 * Increment the counter by one to skip one image.
 * 
 * @since 3.1
 */
function iaff_bulk_updater_skip_image() {
	
	// Security Check
	check_ajax_referer( 'iaff_bulk_updater_skip_image_nonce', 'security' );
	
	// Retrieve Counter
	$counter = get_option( 'iaff_bulk_updater_counter' );
	$counter = intval ( $counter );

	global $wpdb;
	$image = $wpdb->get_row("SELECT ID, post_parent FROM {$wpdb->prefix}posts WHERE post_type='attachment' AND post_mime_type LIKE 'image%' ORDER BY post_date LIMIT 1 OFFSET {$counter}");
	
	/**
	 * Die if no image.
	 * This happens if there are no more images to skip. 
	 */
	if ( $image === NULL ) {
		$response = array(
			'message'			=> __( 'No more images to skip.', 'auto-image-attributes-from-filename-with-bulk-updater' ),
			'remaining_images'	=> iaff_count_remaining_images(),
		);
		wp_send_json( $response );
	}

	// Extract the image url
	$image_url = wp_get_attachment_url($image->ID);

	// Increment counter and update it
	$counter++;
	update_option( 'iaff_bulk_updater_counter', $counter );
	
	$response = array(
		'message'			=> __( 'Image skipped: ', 'auto-image-attributes-from-filename-with-bulk-updater' ) . '<a href="'. get_edit_post_link( $image->ID ) .'">'. $image_url .'</a>',
		'remaining_images'	=> iaff_count_remaining_images(),
	);
	wp_send_json( $response );
}
add_action( 'wp_ajax_iaff_bulk_updater_skip_image', 'iaff_bulk_updater_skip_image' );

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
		
		var iaff_stop = false;
		var iaffpro_bu_exists = <?php echo function_exists( 'iaffpro_bu_bulk_updater_init' ) ? 'true' : 'false'; ?>;

		$("#bulk-updater-log").animate({scrollTop:$("#bulk-updater-log")[0].scrollHeight - $("#bulk-updater-log").height()},200);

		// Enable "Stop Bulk Updater" button if Bulk Updater is running in the background.
		<?php if ( function_exists( 'as_has_scheduled_action' ) && ( as_has_scheduled_action( 'iaffpro_bu_bulk_updater' ) === true ) ) {
			echo "iaff_stop_bulk_updater_button_switch( true );";
		}?>
		
		// Bulk Updater
		function iaff_do_bulk_updater(iaff_test=false) {
			
			iaff_stop = false;
			var focused = true;
			window.onfocus = function() {
				focused = true;
			};
			window.onblur = function() {
				focused = false;
			};
			$('.iaff-spinner').addClass("spinner"); // Turn spinner on
			iaff_stop_bulk_updater_button_switch( true ); // Enable stop button
			
			// Notice to the user
			if( ( iaffpro_bu_exists === true ) && ( iaff_test === false ) ) {
				$('#bulk-updater-log').append('<p class="iaff-green"><span class="dashicons dashicons-controls-play"></span>Bulk Updater will now run in the background. You can close this page and check back later to see progress.</p>');
			} else {
				$('#bulk-updater-log').append('<p class="iaff-green"><span class="dashicons dashicons-controls-play"></span>Initializing bulk updater. Please be patient and do not close the browser while it\'s running. In case you do, you can always resume by returning to this page later.</p>');
			}

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
			
			// set remaining count as 1 when running in test mode
			reamining_images_count.done(function() {

				// Run the background bulk updater (since IAP 4.0) if it's available.
				if( ( iaffpro_bu_exists === true ) && ( iaff_test === false ) ) {
					data = {
						action: 'iaffpro_bu_bulk_updater_init',
						security: '<?php echo wp_create_nonce( "iaffpro_bu_bulk_updater_init_nonce" ); ?>'
					};
					$.post(ajaxurl, data);

					return;
				}
				
				if((iaff_test===true)&&(remaining_images>1)) {
					remaining_images = 1;
				}
				
				// Initialize pre run settings
				data = {
					action: 'iaff_before_bulk_updater',
					security: '<?php echo wp_create_nonce( "iaff_before_bulk_updater_nonce" ); ?>'
				};
				var iaff_initializer = $.post(ajaxurl, data);
				
				// Loop For Each Image And Update Its Attributes
				iaff_initializer.done(function iaff_rename_image() {
				
					if((remaining_images > 0)&&(iaff_stop===false)){
						data = {
							action: 'iaff_rename_old_image',
							security: '<?php echo wp_create_nonce( "iaff_rename_old_image_nonce" ); ?>'
						};
						
						var rename_image = $.post(ajaxurl, data, function (response) {
							$('#bulk-updater-log').append('<p>' + response + '</p>');
							if(iaff_test===false) {
								$('#bulk-updater-log').append('<p>Images remaining: ' + (remaining_images-1) + '</p>');
							}
							if( (($('#bulk-updater-log').prop('scrollHeight')-($('#bulk-updater-log').scrollTop()+$('#bulk-updater-log').height())) < 100) || (focused == false) )  {
								$("#bulk-updater-log").animate({scrollTop:$("#bulk-updater-log")[0].scrollHeight - $("#bulk-updater-log").height()},100);
							}
						});
						
						rename_image.done(function() {
							remaining_images--;
							iaff_rename_image();
						});
					} else {
						// Post run stuff
						data = {
							action: 'iaff_after_bulk_updater',
							security: '<?php echo wp_create_nonce( "iaff_after_bulk_updater_nonce" ); ?>'
						};
						$.post(ajaxurl, data);
						
						if(iaff_stop===false) {
							$('#bulk-updater-log').append('<p class="iaff-green"><span class="dashicons dashicons-yes"></span>All done!</p>');
							$("#bulk-updater-log").animate({scrollTop:$("#bulk-updater-log")[0].scrollHeight - $("#bulk-updater-log").height()},200);
						} else {
							$('#bulk-updater-log').append('<p class="iaff-red"><span class="dashicons dashicons-dismiss"></span>Operation aborted by user.</p>');
							$("#bulk-updater-log").animate({scrollTop:$("#bulk-updater-log")[0].scrollHeight - $("#bulk-updater-log").height()},200);
						}
						
						$('.iaff-spinner').removeClass('spinner'); // Turn spinner off
						iaff_stop_bulk_updater_button_switch( false ); // Disable stop button
					}
				});
			});
		}
		
		// Run Bulk Updater
		$('.iaff_run_bulk_updater_button').click(function() {
			
			// Run Bulk Updater Dialog
			$('#iaff-confirm-run-dialog').dialog({
				autoOpen: false,
				width: 600,
				modal: true,
				buttons: {
					"Ok": function() {
						$(this).dialog("close");
						iaff_do_bulk_updater();
					},
					"Cancel": function() {
						$(this).dialog("close");
					}
				}
			});
			$('#iaff-confirm-run-dialog').dialog('open');
		});
		
		// Test Bulk Updater
		$('.iaff_test_bulk_updater_button').click(function() {
			
			// Test Bulk Updater Dialog
			$('#iaff-test-run-dialog').dialog({
				autoOpen: false,
				width: 600,
				modal: true,
				buttons: {
					"Ok": function() {
						$(this).dialog("close");
						iaff_do_bulk_updater(true);
					},
					"Cancel": function() {
						$(this).dialog("close");
					}
				}
			});
			$('#iaff-test-run-dialog').dialog('open');
		});
		
		// Stop Bulk Updater
		$('.iaff_stop_bulk_updater_button').click(function() {
			iaff_stop=true;

			// Stop background processing
			if( iaffpro_bu_exists === true ) {
				data = {
					action: 'iaffpro_bu_stop_bulk_updater',
					security: '<?php echo wp_create_nonce( "iaffpro_bu_stop_bulk_updater_nonce" ); ?>'
				};
				
				$.post(ajaxurl, data, function() {
					iaff_stop_bulk_updater_button_switch( false );
				});
			}
		});
		
		// Reset Bulk Updater Counter
		$('.iaff_reset_counter_button').click(function() {
			
			// Reset Counter Dialog
			$('#iaff-reset-counter-dialog').dialog({
				autoOpen: false,
				width: 600,
				modal: true,
				buttons: {
					"Ok": function() {
						data = {
							action: 'iaff_reset_bulk_updater_counter',
							security: '<?php echo wp_create_nonce( "iaff_reset_counter_nonce" ); ?>'
						};
						$.post(ajaxurl, data, function (response) {
							$('#bulk-updater-log').append('<p class="iaff-green"><span class="dashicons dashicons-yes"></span>' + response.message + '</p>');
							$('#bulk-updater-log').append('<p>Number of Images Remaining: ' + response.remaining_images + '</p>');
							$('#bulk-updater-log').append('<p>Number of Images Updated: 0</p>');
							$("#bulk-updater-log").animate({scrollTop:$("#bulk-updater-log")[0].scrollHeight - $("#bulk-updater-log").height()},200);
						});
						$(this).dialog("close");
					},
					"Cancel": function() {
						$(this).dialog("close");
					}
				}
			});
			$('#iaff-reset-counter-dialog').dialog('open');
		});

		// Skip Image Button
		$('.iaff_skip_image_button').click( function() {
			
			data = {
				action: 'iaff_bulk_updater_skip_image',
				security: '<?php echo wp_create_nonce( "iaff_bulk_updater_skip_image_nonce" ); ?>'
			};

			$.post(ajaxurl, data, function (response) {
				$('#bulk-updater-log').append('<p class="iaff-red"><span class="dashicons dashicons-remove"></span> ' + response.message + '</p>');
				$('#bulk-updater-log').append('<p>Number of Images Remaining: ' + response.remaining_images + '</p>');
				$("#bulk-updater-log").animate({scrollTop:$("#bulk-updater-log")[0].scrollHeight - $("#bulk-updater-log").height()},200);
			});
		});

		/**
		 * Enable or disable "Stop Bulk Updater" button.
		 * 
		 * @param state (bool) True to enable button, false to disable.
		 */
		function iaff_stop_bulk_updater_button_switch( state ) {
			switch ( state ) {
				case true:
					$('.iaff_stop_bulk_updater_button').prop('disabled', false); // Enable stop button
					$('.iaff_stop_bulk_updater_button').removeClass("button-secondary");
					$('.iaff_stop_bulk_updater_button').addClass("button-primary"); // Turn stop button primary
					break;

				case false:
				default:
					$('.iaff_stop_bulk_updater_button').removeClass("button-primary");
					$('.iaff_stop_bulk_updater_button').addClass("button-secondary"); // Turn stop button secondary
					$('.iaff_stop_bulk_updater_button').prop('disabled', true); // Disable stop button
					break;
			}
		}

		// Delete Event Log
		$('#bulk-updater-delete-log-button').click( function() {
				
			data = {
				action: 'iaff_bulk_updater_delete_log',
				security: '<?php echo wp_create_nonce( "iaff_bulk_updater_delete_log_nonce" ); ?>'
			};
	
			$.post(ajaxurl, data, function (response) {
				$('#bulk-updater-log').append('<p class="iaff-red"><span class="dashicons dashicons-trash"></span> ' + response.message + '</p>');
				$("#bulk-updater-log").animate({scrollTop:$("#bulk-updater-log")[0].scrollHeight - $("#bulk-updater-log").height()},200);
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
	
	// Get Settings
	$settings = iaff_get_settings();
	
	// Return if disabled in settings
	if ( ! ( isset( $settings['image_title_to_html'] ) && boolval( $settings['image_title_to_html'] ) ) )  {
		return $html;
	}
	
	// If html already contains a title, do nothing
	if ( strpos($html, "title=") !== false ) {
    	return $html;
    }
	
	$attachment = get_post($id);	
	$mytitle 	= esc_attr($attachment->post_title);
	
	return str_replace('<img', '<img title="' . $mytitle . '" '  , $html);
}
add_filter( 'media_send_to_editor', 'iaff_lcb_restore_image_title', 15, 2 );

function iaff_lcb_restore_title_to_gallery( $content, $id ) {
	
	// Get Settings
	$settings = iaff_get_settings();
	
	// Return if disabled in settings
	if ( ! ( isset( $settings['image_title_to_html'] ) && boolval( $settings['image_title_to_html'] ) ) )  {
		return $content;
	}
	
	$thumb_title = get_the_title($id);
	
	return str_replace('<a', '<a title="' . esc_attr($thumb_title) . '" ', $content);
}
add_filter('wp_get_attachment_link', 'iaff_lcb_restore_title_to_gallery', 10, 4);

/**
 * Replace commas in filename with hyphens
 *
 * WordPress removes commas during file upload. This function replaces commas with hyphens so that we can replace them later. 
 * Without this red,pill.jpg will become redpill.jpg and we cannot extract the word 'Red Pill' with the space out of it.
 * 
 * @since 1.3
 * @refer https://codex.wordpress.org/Plugin_API/Filter_Reference/wp_handle_upload_prefilter
 */
function iaff_clean_filename( $file ) {
	
	$image_extensions = array (
		'image/jpeg', 'image/gif', 'image/png', 'image/bmp', 'image/tiff', 'ico'
	);
	
	// Return if file is not an image file
	if ( ! in_array( $file['type'], $image_extensions ) ) {
		return $file;
	}
	
	// Clean filename with IAFF Pro
	if ( iaff_is_pro() ) {
		return iaffpro_clean_filename( $file );
	}
	
	// Get Settings
	$settings = iaff_get_settings();
	
	if ( isset( $settings['commas'] ) && boolval( $settings['commas'] ) ) {
		$file['name'] = str_replace( ',', '-', $file['name'] );
	}
	
	return $file;
}
add_filter( 'wp_handle_upload_prefilter', 'iaff_clean_filename' );

/**
 * Extract, format and return image name from filename.
 *
 * @since 1.4
 * @since 4.3 Uses the image title generated by WordPress at the time of image upload if it's available. This is saved as iaff_wp_attachment_original_post_title.
 * 
 * @param $image_id (int) Attachment ID.
 * @param $bulk (boolean) True when called from the Bulk Updater. False by default.
 * 
 * @return (string) Name of the image extracted from filename.
 */
function iaff_image_name_from_filename( $image_id, $bulk = false ) {
	
	// Return if no image ID is passed
	if ( $image_id === NULL ) { 
		return;
	}
	
	// Get Settings
	$settings = iaff_get_settings();

	// Image title generated by WordPress.
	$image_name = get_post_meta( $image_id, 'iaff_wp_attachment_original_post_title', true );

	// Extract the image name from the image url if WordPress generated image name is not available.
	if ( ( $image_name === false ) || ( $image_name === '' ) ) {
		$image_url			= wp_get_attachment_url( $image_id );
		$image_extension 	= pathinfo( $image_url );
		$image_name 		= basename( $image_url, '.' . $image_extension['extension'] );
	}
	
	if ( $bulk === true ) {
		$image_name = str_replace( '-', ' ', $image_name );	// replace hyphens with spaces
		$image_name = str_replace( '_', ' ', $image_name );	// replace underscores with spaces
		return $image_name;
	}
	
	$filter_chars = array();
	
	if ( isset( $settings['hyphens'] ) && boolval( $settings['hyphens'] ) ) {
		$filter_chars[] = '-';	// Hypen
	}
	if ( isset( $settings['under_score'] ) && boolval( $settings['under_score'] ) ) {
		$filter_chars[] = '_';	// Underscore
	}
	if ( isset( $settings['full_stop'] ) && boolval( $settings['full_stop'] ) ) {
		$filter_chars[] = '.';	// Full stops
	}
	
	// Remove characters
	if ( ! empty( $filter_chars ) ) {
        $image_name = str_replace( $filter_chars, ' ', $image_name );
    }
	
	// Remove all numbers
	if ( isset( $settings['all_numbers'] ) && boolval( $settings['all_numbers'] ) ) {
		$image_name = preg_replace( '/[0-9]+/', '', $image_name );
	}
	
	// Final cleanup
	$image_name = preg_replace( '/\s\s+/', ' ', $image_name ); // Replace multiple spaces with a single spaces
	$image_name = trim( $image_name );		// Remove white spaces from both ends
	
	return $image_name;
}

/**
 * Update Image Attributes in database
 *
 * @since 	1.4
 * @param	$image_id	Integer		ID of the image to work on
 * @param	$text		String		String to be used for Image Title, Caption, Description and Alt Text
 * @param	$bulk		Boolean		True when called from Bulk Updater. False by default
 * @return	True on success. False otherwise
 */
function iaff_update_image( $image_id, $text, $bulk = false ) {
	
	// Return if no image ID is passed
	if( $image_id === NULL ) return false;
	
	// Get Settings
	$settings = iaff_get_settings();
	
	$image			= array();
	$image['ID'] 	= $image_id;
	
	if ( $bulk == true ) {
		
		$image['post_title'] 	= $text;	// Image Title
		$image['post_excerpt'] 	= $text;	// Image Caption
		$image['post_content'] 	= $text;	// Image Description
		
		// Update Image Alt Text (stored in post_meta table)
		update_post_meta( $image_id, '_wp_attachment_image_alt', $text ); // Image Alt Text
	} else {
		
		if ( isset( $settings['image_title'] ) && boolval($settings['image_title']) ) {
			$image['post_title'] 	= $text;	// Image Title
		}
		if ( isset( $settings['image_caption'] ) && boolval($settings['image_caption']) ) {
			$image['post_excerpt'] = $text;	// Image Caption
		}
		if ( isset( $settings['image_description'] ) && boolval($settings['image_description']) ) {
			$image['post_content'] = $text;	// Image Description
		}
		if ( isset( $settings['image_alttext'] ) && boolval($settings['image_alttext']) ) {
			update_post_meta( $image_id, '_wp_attachment_image_alt', $text ); // Image Alt Text
		}
	}

	$return_id = wp_update_post( $image ); // Retruns the ID of the post if the post is successfully updated in the database. Otherwise returns 0.
	
	if ( $return_id == 0 ) return false;
	
	return true;
}

/**
 * Get the boolean value of a variable
 *
 * For backwards compatibility with pre PHP 5.5
 * @param 	mixed 	The scalar value being converted to a boolean.
 * @return 	boolean The boolean value of var.
 * @refer	https://millionclues.com/wordpress-tips/solved-fatal-error-call-to-undefined-function-boolval/
 */
if( !function_exists('boolval')) {
  
	function boolval($var) {
		return !! $var;
	}
}

/**
* Check if IAFF Pro is installed
*
* @since	1.4
* @return	True if IAFF Pro is installed. False otherwise. 
*/
function iaff_is_pro() {
	
	if( function_exists('iaffpro_auto_image_attributes_pro') )
		return true;
	
	return false;
}