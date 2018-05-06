<?php
/**
 * Admin UI setup and render
 *
 * @since 1.3
 * @function	iaff_general_settings_section_callback()	Callback function for General Settings section
 * @function	iaff_general_settings_field_callback()		Callback function for General Settings field
 * @function	iaff_admin_interface_render()				Admin interface renderer
 */

 
// Exit if accessed directly
if ( !defined('ABSPATH') ) exit;


/**
 * Callback function for General Settings section
 *
 * @since 1.0
 */
function iaff_auto_image_attributes_callback() {
	echo '<p>' . __('Automatically add Image attributes such as Image Title, Image Caption, Description And Alt Text from Image Filename for new uploads.', 'abl_iaff_td') . '</p>';
}


/**
 * Callback function for General Settings field
 *
 * @since 1.0
 */
function iaff_auto_image_attributes_settings_field_callback() {	

	// Default Values For Settings
	global $defaults;

	// Get Settings
	$settings = get_option('iaff_settings', $defaults);

	// General Settings. Name of form element should be same as the setting name in register_setting(). ?>
	
	<!-- Auto Add Image Title  -->
	<input type="checkbox" name="iaff_settings[image_title]" id="iaff_settings[image_title]" value="1" 
		<?php if ( isset( $settings['image_title'] ) ) { checked( '1', $settings['image_title'] ); } ?>>
		<label for="iaff_settings[image_title]"><?php _e('Set Image Title from filename for new uploads', 'abl_iaff_td') ?></label>
		<br>
		
	<!-- Auto Add Image Caption  -->
	<input type="checkbox" name="iaff_settings[image_caption]" id="iaff_settings[image_caption]" value="1" 
		<?php if ( isset( $settings['image_caption'] ) ) { checked( '1', $settings['image_caption'] ); } ?>>
		<label for="iaff_settings[image_caption]"><?php _e('Set Image Caption from filename for new uploads', 'abl_iaff_td') ?></label>
		<br>
		
	<!-- Auto Add Image Description  -->
	<input type="checkbox" name="iaff_settings[image_description]" id="iaff_settings[image_description]" value="1" 
		<?php if ( isset( $settings['image_description'] ) ) { checked( '1', $settings['image_description'] ); } ?>>
		<label for="iaff_settings[image_description]"><?php _e('Set Image Description from filename for new uploads', 'abl_iaff_td') ?></label>
		<br>
		
	<!-- Auto Add Alt Text -->
	<input type="checkbox" name="iaff_settings[image_alttext]" id="iaff_settings[image_alttext]" value="1" 
		<?php if ( isset( $settings['image_alttext'] ) ) { checked( '1', $settings['image_alttext'] ); } ?>>
		<label for="iaff_settings[image_alttext]"><?php _e('Set Image Alt Text from filename for new uploads', 'abl_iaff_td') ?></label>
		<br>
		
	<!-- Insert Image Title Into Post HTML -->
	<input type="checkbox" name="iaff_settings[image_title_to_html]" id="iaff_settings[image_title_to_html]" value="1" 
		<?php if ( isset( $settings['image_title_to_html'] ) ) { checked( '1', $settings['image_title_to_html'] ); } ?>>
		<label for="iaff_settings[image_title_to_html]"><?php _e('Insert Image Title into post HTML. This will add title="Image Title" in the &lt;img&gt; tag.', 'abl_iaff_td') ?></label>
		<br>

	<?php
}


/**
 * Filter Settings field callback
 *
 * @since 	1.0
 */
function iaff_auto_image_attributes_filter_settings_callback() {	

	// Default Values For Settings
	global $defaults;

	// Get Settings
	$settings = get_option('iaff_settings', $defaults); ?>
	
	<!-- Filter Hyphens -->
	<input type="checkbox" name="iaff_settings[hyphens]" id="iaff_settings[hyphens]" value="1" 
		<?php if ( isset( $settings['hyphens'] ) ) { checked( '1', $settings['hyphens'] ); } ?>>
		<label for="iaff_settings[hyphens]"><?php _e('Remove hyphens ( - ) from filename', 'abl_iaff_td') ?></label>
		<br>
		
	<!-- Filter Underscore  -->
	<input type="checkbox" name="iaff_settings[under_score]" id="iaff_settings[under_score]" value="1" 
		<?php if ( isset( $settings['under_score'] ) ) { checked( '1', $settings['under_score'] ); } ?>>
		<label for="iaff_settings[under_score]"><?php _e('Remove underscores ( _ ) from filename', 'abl_iaff_td') ?></label>
		<br>
		
	<!-- Filter Full stops  -->
	<input type="checkbox" name="iaff_settings[full_stop]" id="iaff_settings[full_stop]" value="1" 
		<?php if ( isset( $settings['full_stop'] ) ) { checked( '1', $settings['full_stop'] ); } ?>>
		<label for="iaff_settings[full_stop]"><?php _e('Remove full stops ( . ) from filename', 'abl_iaff_td') ?></label>
		<br>
		
	<!-- Filter Commas  -->
	<input type="checkbox" name="iaff_settings[commas]" id="iaff_settings[commas]" value="1" 
		<?php if ( isset( $settings['commas'] ) ) { checked( '1', $settings['commas'] ); } ?>>
		<label for="iaff_settings[commas]"><?php _e('Remove commas ( , ) from filename', 'abl_iaff_td') ?></label>
		<br>
		
	<!-- Filter Numbers  -->
	<input type="checkbox" name="iaff_settings[all_numbers]" id="iaff_settings[all_numbers]" value="1" 
		<?php if ( isset( $settings['all_numbers'] ) ) { checked( '1', $settings['all_numbers'] ); } ?>>
		<label for="iaff_settings[all_numbers]"><?php _e('Remove all numbers ( 0-9 ) from filename', 'abl_iaff_td') ?></label>
		<br>
		
	<?php
}
 

/**
 * Admin interface renderer
 *
 * @since 1.0
 */ 
function iaff_admin_interface_render () {
	
	if ( ! current_user_can( 'manage_options' ) ) {
		return;
	} ?>
	
	<div id="iaff-pro" class="wrap">	
		<h1>Auto Image Attributes From Filename With Bulk Updater</h1>
		
		<?php
		// Get the tab query variable. If it's not set, set it to the first tab 
		$active_tab = isset( $_GET[ 'tab' ] ) ? $_GET[ 'tab' ] : 'new-upload-settings';
		?>
		
		<h2 class="nav-tab-wrapper">
			<a class="nav-tab <?php echo $active_tab == 'new-upload-settings' ? 'nav-tab-active' : ''; ?>" href="?page=image-attributes-from-filename&tab=new-upload-settings" style="margin-left: 0px;">New Upload Settings</a>
			<a class="nav-tab <?php echo $active_tab == 'bulk-updater' ? 'nav-tab-active' : ''; ?>" href="?page=image-attributes-from-filename&tab=bulk-updater">Bulk Updater</a>
		</h2>
		
		<?php 
		// New Upload Settings Tab
		if( $active_tab == 'new-upload-settings' ) { ?>
		
			<form action="options.php" method="post">		
				<?php
				// Output nonce, action, and option_page fields for a settings page.
				settings_fields( 'iaff_settings_group' );
				
				// Prints out all settings sections added to a particular settings page. 
				do_settings_sections( 'image-attributes-from-filename' );	// Page slug
				
				// Output save settings button
				submit_button( __('Save Settings', 'abl_iaff_td') );
				?>
			</form>
			<?php
		}
		
		// Bulk Updater Tab
		else if( $active_tab == 'bulk-updater' ) { ?>
			
			<?php // Load Admin CSS
			wp_enqueue_style( 'iaff-style' ); ?>

			<h2><?php _e('Update Existing Images In Media Library', 'abl_iaff_td') ?></h2>
			
			<p><?php _e('Run this bulk updater to update Image Title, Caption, Description and Alt Text from image filename for existing images in the media library.', 'abl_iaff_td') ?></p>
			
			<div class="backup-warning"> 
				<p><strong><?php _e('IMPORTANT: Please backup your database before running the bulk updater. <br>If your image is named a-lot-like_love.jpg, your Image Title, Caption, Description and Alt Text will be: A Lot Like Love. All attributes are updated regardless of the settings for NEW uploads.', 'abl_iaff_td') ?></strong></p>
			</div>
			
			<?php submit_button( __('Run Bulk Updater', 'abl_iaff_td'), 'button-primary iaff_run_bulk_updater_button' ); ?>
			
			<h2><?php _e('Reset Counter', 'abl_iaff_td') ?></h2>
			
			<p><?php _e('To restart processing images from the beginning (the oldest upload first), reset the counter.', 'abl_iaff_td') ?></p> 
			
			<span class="reset-counter-button">
				<?php submit_button( __('Reset Counter', 'abl_iaff_td'), 'iaff_reset_counter_button' ); ?>
			</span>
			
			<div id="bulk-updater-results">
				<fieldset id="bulk-updater-log-wrapper">
					<legend><span class="dashicons dashicons-welcome-write-blog"></span>&nbsp;<strong>Event Log</strong>&nbsp;</legend>
					
					<div id="bulk-updater-log">
						<p id="iaff_remaining_images_text"><?php _e('Number of Images Remaining: ', 'abl_iaff_td') ?><?php echo iaff_count_remaining_images(); ?></p>
						
						<p><?php _e('Number of Images Updated: ', 'abl_iaff_td') ?><?php echo iaff_number_of_images_updated(); ?></p>
					</div>
				</fieldset>
				
			</div>
			
			<?php 
		} ?>
		
	</div>
	<?php
}
 
?>