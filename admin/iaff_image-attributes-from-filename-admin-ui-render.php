<?php
/**
 * Admin UI setup and render
 *
 * @since 1.3
 * @function	iaff_global_switch_callback()		Global Switch Callback
 * @function	iaff_general_settings_callback()	General Settings field Callback
 * @function	iaff_filter_settings_callback()		Filter Settings field callback
 * @function	iaff_basic_seo_settings_callback()	Basic SEO Settings Callback
 * @function	iaff_preview_pro_settings_callback()Preview Pro Features Callback
 * @function	iaff_advanced_filter_callback()		Advanced Filter Settings Callback
 * @function	iaff_custom_filter_callback()		Custom Filter Callback
 * @function	iaff_capitalization_callback()		Capitalization Settings Callback
 * @function	iaff_advanced_image_title_callback() 		Image Title Settings Callback
 * @function	iaff_advanced_image_alt_text_callback()		Image Alt Text Settings Callback
 * @function	iaff_advanced_image_caption_callback()		Image Caption Settings Callback
 * @function	iaff_advanced_image_description_callback()	Image Description Settings Callback
 * @function	iaff_miscellaneous_callback()				Miscellaneous Settings Callback
 * @function	iaff_bu_general_settings_callback()			Bulk Updater General Settings Callback
 * @function	iaff_bu_filter_settings_callback()			Bulk Updater Filter Settings Callback
 * @function	iaff_bu_custom_filter_callback()			Bulk Updater Custom Filter Callback
 * @function	iaff_bu_capitalization_settings_callback()	Bulk Updater Capitalization Settings Callback
 * @function	iaff_bu_image_title_settings_callback()		Bulk Updater Image Title Settings Callback
 * @function	iaff_bu_alt_text_settings_callback()		Bulk Updater Image Alt Text Settings Callback
 * @function	iaff_bu_image_caption_settings_callback()	Bulk Updater Image Caption Settings Callback
 * @function	iaff_bu_image_description_settings_callback() Bulk Updater Image Description Settings Callback		
 * @function	iaff_admin_interface_render()				Admin interface renderer	
 */

// Exit if accessed directly
if ( ! defined('ABSPATH') ) exit;

/**
 * Global Switch Callback
 *
 * @since 	1.4
 */
function iaff_global_switch_callback() {	

	// Get Settings
	$settings = iaff_get_settings();
	?>
		
	<fieldset>
	
		<label for="iaff_settings[global_switch]">
			<input type="checkbox" name="iaff_settings[global_switch]" id="iaff_settings[global_switch]" value="1" <?php if ( isset($settings['global_switch']) ) checked( '1', $settings['global_switch'] ); ?>>
			<span><?php _e('Globally enable or disable Auto Image Attributes. Should be checked for the plugin to work.', 'auto-image-attributes-from-filename-with-bulk-updater') ?></span>
		</label><br>
		
	</fieldset>
		
	<?php
}

/**
 * General Settings field Callback
 *
 * @since 1.0
 */
function iaff_general_settings_callback() {	

	// Get Settings
	$settings = iaff_get_settings();

	// General Settings. Name of form element should be same as the setting name in register_setting(). 
	?>
	
	<fieldset>
	
		<!-- Auto Add Image Title  -->
		<label for="iaff_settings[image_title]">
			<input type="checkbox" name="iaff_settings[image_title]" id="iaff_settings[image_title]" value="1" <?php if ( isset($settings['image_title']) ) checked( '1', $settings['image_title'] ); ?>>
			<span><?php _e('Set Image Title for new uploads', 'auto-image-attributes-from-filename-with-bulk-updater') ?></span>
		</label><br>
			
		<!-- Auto Add Image Caption  -->
		<label for="iaff_settings[image_caption]">
			<input type="checkbox" name="iaff_settings[image_caption]" id="iaff_settings[image_caption]" value="1" <?php if ( isset($settings['image_caption']) ) checked( '1', $settings['image_caption'] ); ?>>
			<span><?php _e('Set Image Caption for new uploads', 'auto-image-attributes-from-filename-with-bulk-updater') ?></span>
		</label><br>
			
		<!-- Auto Add Image Description  -->
		<label for="iaff_settings[image_description]">
			<input type="checkbox" name="iaff_settings[image_description]" id="iaff_settings[image_description]" value="1" <?php if ( isset($settings['image_description']) ) checked( '1', $settings['image_description'] ); ?>>
			<span><?php _e('Set Image Description for new uploads', 'auto-image-attributes-from-filename-with-bulk-updater') ?></span>
		</label><br>
			
		<!-- Auto Add Alt Text -->
		<label for="iaff_settings[image_alttext]">
			<input type="checkbox" name="iaff_settings[image_alttext]" id="iaff_settings[image_alttext]" value="1" <?php if ( isset($settings['image_alttext']) ) checked( '1', $settings['image_alttext'] ); ?>>
			<span><?php _e('Set Image Alt Text for new uploads', 'auto-image-attributes-from-filename-with-bulk-updater') ?></span>
		</label><br>
		
	</fieldset>

	<?php
}


/**
 * Filter Settings field callback
 *
 * @since 	1.0
 */
function iaff_filter_settings_callback() {	

	// Get Settings
	$settings = iaff_get_settings();
	?>
	
	<fieldset>
	
		<!-- Filter Hyphens -->
		<label for="iaff_settings[hyphens]">
			<input type="checkbox" name="iaff_settings[hyphens]" id="iaff_settings[hyphens]" value="1" <?php if ( isset($settings['hyphens']) ) checked( '1', $settings['hyphens'] ); ?>>
			<span><?php _e('Remove hyphens ( - ) from filename', 'auto-image-attributes-from-filename-with-bulk-updater') ?></span>
		</label><br>
			
		<!-- Filter Underscore  -->
		<label for="iaff_settings[under_score]">
			<input type="checkbox" name="iaff_settings[under_score]" id="iaff_settings[under_score]" value="1" <?php if ( isset($settings['under_score']) ) checked( '1', $settings['under_score'] ); ?>>
			<span><?php _e('Remove underscores ( _ ) from filename', 'auto-image-attributes-from-filename-with-bulk-updater') ?></span>
		</label><br>
			
		<!-- Filter Full stops  -->
		<label for="iaff_settings[full_stop]">
			<input type="checkbox" name="iaff_settings[full_stop]" id="iaff_settings[full_stop]" value="1" <?php if ( isset($settings['full_stop']) ) checked( '1', $settings['full_stop'] ); ?>>
			<span><?php _e('Remove full stops ( . ) from filename', 'auto-image-attributes-from-filename-with-bulk-updater') ?></span>
		</label><br>
			
		<!-- Filter Commas  -->
		<label for="iaff_settings[commas]">
			<input type="checkbox" name="iaff_settings[commas]" id="iaff_settings[commas]" value="1" <?php if ( isset($settings['commas']) ) checked( '1', $settings['commas'] ); ?>>
			<span><?php _e('Remove commas ( , ) from filename', 'auto-image-attributes-from-filename-with-bulk-updater') ?></span>
		</label><br>
			
		<!-- Filter Numbers  -->
		<label for="iaff_settings[all_numbers]">
			<input type="checkbox" name="iaff_settings[all_numbers]" id="iaff_settings[all_numbers]" value="1" <?php if ( isset($settings['all_numbers']) ) checked( '1', $settings['all_numbers'] ); ?>>
			<span><?php _e('Remove all numbers ( 0-9 ) from filename', 'auto-image-attributes-from-filename-with-bulk-updater') ?></span>
		</label><br>
	
	</fieldset>
		
	<?php
}

/**
 * Basic SEO Settings Callback
 *
 * @since 	1.4
 */
function iaff_basic_seo_settings_callback() {	

	// Get Settings
	$settings = iaff_get_settings();
	?>
		
	<fieldset>
	
		<!-- Insert Image Title Into Post HTML -->
		<label for="iaff_settings[image_title_to_html]">
			<input type="checkbox" name="iaff_settings[image_title_to_html]" id="iaff_settings[image_title_to_html]" value="1" <?php if ( isset($settings['image_title_to_html']) ) checked( '1', $settings['image_title_to_html'] ); ?>>
			<span><?php _e('Insert Image Title into post HTML. This will add title="Image Title" in the &lt;img&gt; tag.', 'auto-image-attributes-from-filename-with-bulk-updater') ?></span>
		</label><br>
		
	</fieldset>
		
	<?php
}

/**
 * Preview Pro Features Callback
 *
 * @since 	1.4
 */
function iaff_preview_pro_settings_callback() {	

	// Get Settings
	$settings = iaff_get_settings();
	?>
		
	<fieldset>
	
		<!-- Preview Pro Settings -->
		<label for="iaff_settings[preview_pro]">
			<input type="checkbox" name="iaff_settings[preview_pro]" id="iaff_settings[preview_pro]" value="1" <?php if ( isset($settings['preview_pro']) ) checked( '1', $settings['preview_pro'] ); ?>>
			<span><?php printf( __( 'Check to see a preview of all the options that ship with <a href="%s" target="_blank">Image Attributes Pro</a>.', 'auto-image-attributes-from-filename-with-bulk-updater' ), 
								'https://imageattributespro.com/?utm_source=iaff-basic&utm_medium=preview-pro-setting'
						); ?></span>
		</label><br>
		
	</fieldset>
		
	<?php
}

/**
 * Advanced Filter Settings Callback
 *
 * @since 	1.4
 */
function iaff_advanced_filter_callback() {	

	// Get Settings
	$settings = iaff_get_settings();
	?>
		
	<fieldset>
	
		<!-- Filter Apostrophe -->
		<label for="iaff_settings[apostrophe]">
			<input type="checkbox" name="iaff_settings[apostrophe]" id="iaff_settings[apostrophe]" value="1" <?php if ( isset($settings['apostrophe']) ) checked( '1', $settings['apostrophe'] ); ?>>
			<span><?php _e('Remove apostrophe ( \' ) from filename', 'auto-image-attributes-from-filename-with-bulk-updater') ?></span>
		</label><br>
		
		<!-- Filter Tilde -->
		<label for="iaff_settings[tilde]">
			<input type="checkbox" name="iaff_settings[tilde]" id="iaff_settings[tilde]" value="1" <?php if ( isset($settings['tilde']) ) checked( '1', $settings['tilde'] ); ?>>
			<span><?php _e('Remove tilde ( ~ ) from filename', 'auto-image-attributes-from-filename-with-bulk-updater') ?></span>
		</label><br>
		
		<!-- Filter Plus -->
		<label for="iaff_settings[plus]">
			<input type="checkbox" name="iaff_settings[plus]" id="iaff_settings[plus]" value="1" <?php if ( isset($settings['plus']) ) checked( '1', $settings['plus'] ); ?>>
			<span><?php _e('Remove plus ( + ) from filename', 'auto-image-attributes-from-filename-with-bulk-updater') ?></span>
		</label><br>
		
		<!-- Filter Pound -->
		<label for="iaff_settings[pound]">
			<input type="checkbox" name="iaff_settings[pound]" id="iaff_settings[pound]" value="1" <?php if ( isset($settings['pound']) ) checked( '1', $settings['pound'] ); ?>>
			<span><?php _e('Remove pound ( # ) from filename', 'auto-image-attributes-from-filename-with-bulk-updater') ?></span>
		</label><br>
		
		<!-- Filter Ampersand -->
		<label for="iaff_settings[ampersand]">
			<input type="checkbox" name="iaff_settings[ampersand]" id="iaff_settings[ampersand]" value="1" <?php if ( isset($settings['ampersand']) ) checked( '1', $settings['ampersand'] ); ?>>
			<span><?php _e('Remove ampersand ( & ) from filename', 'auto-image-attributes-from-filename-with-bulk-updater') ?></span>
		</label><br>
		
		<!-- Filter Round Brackets -->
		<label for="iaff_settings[round_brackets]">
			<input type="checkbox" name="iaff_settings[round_brackets]" id="iaff_settings[round_brackets]" value="1" <?php if ( isset($settings['round_brackets']) ) checked( '1', $settings['round_brackets'] ); ?>>
			<span><?php _e('Remove round brackets ( ( ) ) from filename', 'auto-image-attributes-from-filename-with-bulk-updater') ?></span>
		</label><br>
		
		<!-- Filter Square Brackets -->
		<label for="iaff_settings[square_brackets]">
			<input type="checkbox" name="iaff_settings[square_brackets]" id="iaff_settings[square_brackets]" value="1" <?php if ( isset($settings['square_brackets']) ) checked( '1', $settings['square_brackets'] ); ?>>
			<span><?php _e('Remove square brackets ( [ ] ) from filename', 'auto-image-attributes-from-filename-with-bulk-updater') ?></span>
		</label><br>
		
		<!-- Filter Curly Brackets -->
		<label for="iaff_settings[curly_brackets]">
			<input type="checkbox" name="iaff_settings[curly_brackets]" id="iaff_settings[curly_brackets]" value="1" <?php if ( isset($settings['curly_brackets']) ) checked( '1', $settings['curly_brackets'] ); ?>>
			<span><?php _e('Remove curly brackets ( { } ) from filename', 'auto-image-attributes-from-filename-with-bulk-updater') ?></span>
		</label><br>
		
	</fieldset>
		
	<?php
}

/**
 * Custom Filter Callback
 *
 * @since 	1.4
 */
function iaff_custom_filter_callback() {	

	// Get Settings
	$settings = iaff_get_settings();
	?>
		
	<fieldset>
		
		<p>Enter words or characters to filter separated by commas. Filter is case sensitive.</p>
		<input type="text" name="iaff_settings[custom_filter]" placeholder="DCIM, img" class="all-options" value="<?php if ( isset( $settings['custom_filter'] ) && ( ! empty( $settings['custom_filter'] ) ) ) echo esc_attr( $settings['custom_filter'] ); ?>"/><br><br>
		
		<p>Filter with regular expression</p>
		<input type="text" name="iaff_settings[regex_filter]" placeholder="/regex/" class="all-options" value="<?php if ( isset( $settings['regex_filter'] ) && ( ! empty( $settings['regex_filter'] ) ) ) echo esc_attr( $settings['regex_filter'] ); ?>"/><br>
		
	</fieldset>
	
	<?php
}

/**
 * Capitalization Settings Callback
 *
 * @since 	1.4
 */
function iaff_capitalization_callback() {	

	// Get Settings
	$settings = iaff_get_settings();
	?>
		
	<fieldset>
	
		<!-- No capitalization -->
		<label>
			<input type="radio" name="iaff_settings[capitalization]" value="0" <?php if ( isset($settings['capitalization']) ) checked( '0', $settings['capitalization'] ); ?>/>
			<span><?php esc_attr_e( 'Leave unchanged', 'auto-image-attributes-from-filename-with-bulk-updater' ); ?></span>
		</label><br>
		
		<!-- Lowercase -->
		<label>
			<input type="radio" name="iaff_settings[capitalization]" value="1" <?php if ( isset($settings['capitalization']) ) checked( '1', $settings['capitalization'] ); ?>/>
			<span><?php esc_attr_e( 'convert to lowercase', 'auto-image-attributes-from-filename-with-bulk-updater' ); ?></span>
		</label><br>
		
		<!-- Uppercase -->
		<label>
			<input type="radio" name="iaff_settings[capitalization]" value="2" <?php if ( isset($settings['capitalization']) ) checked( '2', $settings['capitalization'] ); ?>/>
			<span><?php esc_attr_e( 'CONVERT TO UPPERCASE', 'auto-image-attributes-from-filename-with-bulk-updater' ); ?></span>
		</label><br>
		
		<!-- Title Casing -->
		<label>
			<input type="radio" name="iaff_settings[capitalization]" value="3" <?php if ( isset($settings['capitalization']) ) checked( '3', $settings['capitalization'] ); ?>/>
			<span><?php esc_attr_e( 'Use title casing. First Letter Of Each Word Will Be Capitalized.', 'auto-image-attributes-from-filename-with-bulk-updater' ); ?></span>
		</label><br>
		
		<!-- Sentence Casing -->
		<label>
			<input type="radio" name="iaff_settings[capitalization]" value="4" <?php if ( isset($settings['capitalization']) ) checked( '4', $settings['capitalization'] ); ?>/>
			<span><?php esc_attr_e( 'Use sentence casing. First letter of a sentence will be capitalized.', 'auto-image-attributes-from-filename-with-bulk-updater' ); ?></span>
		</label><br>
		
	</fieldset>
		
	<?php
}

/**
 * Image Title Settings Callback
 *
 * @since 	1.4
 */
function iaff_advanced_image_title_callback() {	

	// Get Settings
	$settings = iaff_get_settings();
	?>
		
	<fieldset>
	
		<label>
			<input type="radio" name="iaff_settings[title_source]" value="0" <?php if ( isset($settings['title_source']) ) checked( '0', $settings['title_source'] ); ?>/>
			<span><?php esc_attr_e( 'Use image filename as title text', 'auto-image-attributes-from-filename-with-bulk-updater' ); ?></span>
		</label><br>
		
		<label>
			<input type="radio" name="iaff_settings[title_source]" value="1" <?php if ( isset($settings['title_source']) ) checked( '1', $settings['title_source'] ); ?>/>
			<span><?php esc_attr_e( 'Use post title as title text. If image is not attached to a post, image filename will be used instead.', 'auto-image-attributes-from-filename-with-bulk-updater' ); ?></span>
		</label><br>
		
	</fieldset>
		
	<?php
}

/**
 * Image Alt Text Settings Callback
 *
 * @since 	1.4
 */
function iaff_advanced_image_alt_text_callback() {	

	// Get Settings
	$settings = iaff_get_settings();
	?>
		
	<fieldset>
	
		<label>
			<input type="radio" name="iaff_settings[alt_text_source]" value="0" <?php if ( isset($settings['alt_text_source']) ) checked( '0', $settings['alt_text_source'] ); ?>/>
			<span><?php esc_attr_e( 'Use image filename as alt text', 'auto-image-attributes-from-filename-with-bulk-updater' ); ?></span>
		</label><br>
		
		<label>
			<input type="radio" name="iaff_settings[alt_text_source]" value="1" <?php if ( isset($settings['alt_text_source']) ) checked( '1', $settings['alt_text_source'] ); ?>/>
			<span><?php esc_attr_e( 'Use post title as alt text. If image is not attached to a post, image filename will be used instead.', 'auto-image-attributes-from-filename-with-bulk-updater' ); ?></span>
		</label><br>
		
	</fieldset>
		
	<?php
}

/**
 * Image Caption Settings Callback
 *
 * @since 	1.4
 */
function iaff_advanced_image_caption_callback() {	

	// Get Settings
	$settings = iaff_get_settings();
	?>
		
	<fieldset>
	
		<label>
			<input type="radio" name="iaff_settings[caption_source]" value="0" <?php if ( isset($settings['caption_source']) ) checked( '0', $settings['caption_source'] ); ?>/>
			<span><?php esc_attr_e( 'Use image filename as caption', 'auto-image-attributes-from-filename-with-bulk-updater' ); ?></span>
		</label><br>
		
		<label>
			<input type="radio" name="iaff_settings[caption_source]" value="1" <?php if ( isset($settings['caption_source']) ) checked( '1', $settings['caption_source'] ); ?>/>
			<span><?php esc_attr_e( 'Use post title as caption. If image is not attached to a post, image filename will be used instead.', 'auto-image-attributes-from-filename-with-bulk-updater' ); ?></span>
		</label><br>
		
	</fieldset>
		
	<?php
}

/**
 * Image Description Settings Callback
 *
 * @since 	1.4
 */
function iaff_advanced_image_description_callback() {	

	// Get Settings
	$settings = iaff_get_settings();
	?>
		
	<fieldset>
	
		<label>
			<input type="radio" name="iaff_settings[description_source]" value="0" <?php if ( isset($settings['description_source']) ) checked( '0', $settings['description_source'] ); ?>/>
			<span><?php esc_attr_e( 'Use image filename as description', 'auto-image-attributes-from-filename-with-bulk-updater' ); ?></span>
		</label><br>
		
		<label>
			<input type="radio" name="iaff_settings[description_source]" value="1" <?php if ( isset($settings['description_source']) ) checked( '1', $settings['description_source'] ); ?>/>
			<span><?php esc_attr_e( 'Use post title as description. If image is not attached to a post, image filename will be used instead.', 'auto-image-attributes-from-filename-with-bulk-updater' ); ?></span>
		</label><br>
		
	</fieldset>
		
	<?php
}

/**
 * Miscellaneous Settings Callback
 *
 * @since 	1.4
 */
function iaff_miscellaneous_callback() {	

	// Get Settings
	$settings = iaff_get_settings();
	?>
		
	<fieldset>
	
		<!-- Clean filename -->
		<label for="iaff_settings[clean_filename]">
			<input type="checkbox" name="iaff_settings[clean_filename]" id="iaff_settings[clean_filename]" value="1" <?php if ( isset($settings['clean_filename']) ) checked( '1', $settings['clean_filename'] ); ?>>
			<span><?php _e('Clean actual image filename after upload.', 'auto-image-attributes-from-filename-with-bulk-updater') ?></span>
		</label><br>
		
	</fieldset>
		
	<?php
}

/**
 * Bulk Updater General Settings Callback
 *
 * @since 1.4
 */
function iaff_bu_general_settings_callback() {	

	// Get Settings
	$settings = iaff_get_settings();
	?>
	
	<fieldset>
	
		<!-- Auto Add Image Title  -->
		<label for="iaff_settings[bu_image_title]">
			<input type="checkbox" name="iaff_settings[bu_image_title]" id="iaff_settings[bu_image_title]" value="1" <?php if ( isset($settings['bu_image_title']) ) checked( '1', $settings['bu_image_title'] ); ?>>
			<span><?php _e('Update Image Title', 'auto-image-attributes-from-filename-with-bulk-updater') ?></span>
		</label><br>
			
		<!-- Auto Add Image Caption  -->
		<label for="iaff_settings[bu_image_caption]">
			<input type="checkbox" name="iaff_settings[bu_image_caption]" id="iaff_settings[bu_image_caption]" value="1" <?php if ( isset($settings['bu_image_caption']) ) checked( '1', $settings['bu_image_caption'] ); ?>>
			<span><?php _e('Update Image Caption', 'auto-image-attributes-from-filename-with-bulk-updater') ?></span>
		</label><br>
			
		<!-- Auto Add Image Description  -->
		<label for="iaff_settings[bu_image_description]">
			<input type="checkbox" name="iaff_settings[bu_image_description]" id="iaff_settings[bu_image_description]" value="1" <?php if ( isset($settings['bu_image_description']) ) checked( '1', $settings['bu_image_description'] ); ?>>
			<span><?php _e('Update Image Description', 'auto-image-attributes-from-filename-with-bulk-updater') ?></span>
		</label><br>
			
		<!-- Auto Add Alt Text -->
		<label for="iaff_settings[bu_image_alttext]">
			<input type="checkbox" name="iaff_settings[bu_image_alttext]" id="iaff_settings[bu_image_alttext]" value="1" <?php if ( isset($settings['bu_image_alttext']) ) checked( '1', $settings['bu_image_alttext'] ); ?>>
			<span><?php _e('Update Image Alt Text', 'auto-image-attributes-from-filename-with-bulk-updater') ?></span>
		</label><br>
		
	</fieldset>

	<?php
}

/**
 * Bulk Updater Filter Settings Callback
 *
 * @since 	1.4
 */
function iaff_bu_filter_settings_callback() {	

	// Get Settings
	$settings = iaff_get_settings();
	?>
		
	<fieldset>
	
		<!-- Filter Hyphens -->
		<label for="iaff_settings[bu_hyphens]">
			<input type="checkbox" name="iaff_settings[bu_hyphens]" id="iaff_settings[bu_hyphens]" value="1" <?php if ( isset($settings['bu_hyphens']) ) checked( '1', $settings['bu_hyphens'] ); ?>>
			<span><?php _e('Remove hyphens ( - ) from filename', 'auto-image-attributes-from-filename-with-bulk-updater') ?></span>
		</label><br>
			
		<!-- Filter Underscore  -->
		<label for="iaff_settings[bu_under_score]">
			<input type="checkbox" name="iaff_settings[bu_under_score]" id="iaff_settings[bu_under_score]" value="1" <?php if ( isset($settings['bu_under_score']) ) checked( '1', $settings['bu_under_score'] ); ?>>
			<span><?php _e('Remove underscores ( _ ) from filename', 'auto-image-attributes-from-filename-with-bulk-updater') ?></span>
		</label><br>
			
		<!-- Filter Full stops  -->
		<label for="iaff_settings[bu_full_stop]">
			<input type="checkbox" name="iaff_settings[bu_full_stop]" id="iaff_settings[bu_full_stop]" value="1" <?php if ( isset($settings['bu_full_stop']) ) checked( '1', $settings['bu_full_stop'] ); ?>>
			<span><?php _e('Remove full stops ( . ) from filename', 'auto-image-attributes-from-filename-with-bulk-updater') ?></span>
		</label><br>
			
		<!-- Filter Commas  -->
		<label for="iaff_settings[bu_commas]">
			<input type="checkbox" name="iaff_settings[bu_commas]" id="iaff_settings[bu_commas]" value="1" <?php if ( isset($settings['bu_commas']) ) checked( '1', $settings['bu_commas'] ); ?>>
			<span><?php _e('Remove commas ( , ) from filename', 'auto-image-attributes-from-filename-with-bulk-updater') ?></span>
		</label><br>
			
		<!-- Filter Numbers  -->
		<label for="iaff_settings[bu_all_numbers]">
			<input type="checkbox" name="iaff_settings[bu_all_numbers]" id="iaff_settings[bu_all_numbers]" value="1" <?php if ( isset($settings['bu_all_numbers']) ) checked( '1', $settings['bu_all_numbers'] ); ?>>
			<span><?php _e('Remove all numbers ( 0-9 ) from filename', 'auto-image-attributes-from-filename-with-bulk-updater') ?></span>
		</label><br>
		
		<!-- Filter Apostrophe -->
		<label for="iaff_settings[bu_apostrophe]">
			<input type="checkbox" name="iaff_settings[bu_apostrophe]" id="iaff_settings[bu_apostrophe]" value="1" <?php if ( isset($settings['bu_apostrophe']) ) checked( '1', $settings['bu_apostrophe'] ); ?>>
			<span><?php _e('Remove apostrophe ( \' ) from filename', 'auto-image-attributes-from-filename-with-bulk-updater') ?></span>
		</label><br>
		
		<!-- Filter Tilde -->
		<label for="iaff_settings[bu_tilde]">
			<input type="checkbox" name="iaff_settings[bu_tilde]" id="iaff_settings[bu_tilde]" value="1" <?php if ( isset($settings['bu_tilde']) ) checked( '1', $settings['bu_tilde'] ); ?>>
			<span><?php _e('Remove tilde ( ~ ) from filename', 'auto-image-attributes-from-filename-with-bulk-updater') ?></span>
		</label><br>
		
		<!-- Filter Plus -->
		<label for="iaff_settings[bu_plus]">
			<input type="checkbox" name="iaff_settings[bu_plus]" id="iaff_settings[bu_plus]" value="1" <?php if ( isset($settings['bu_plus']) ) checked( '1', $settings['bu_plus'] ); ?>>
			<span><?php _e('Remove plus ( + ) from filename', 'auto-image-attributes-from-filename-with-bulk-updater') ?></span>
		</label><br>
		
		<!-- Filter Pound -->
		<label for="iaff_settings[bu_pound]">
			<input type="checkbox" name="iaff_settings[bu_pound]" id="iaff_settings[bu_pound]" value="1" <?php if ( isset($settings['bu_pound']) ) checked( '1', $settings['bu_pound'] ); ?>>
			<span><?php _e('Remove pound ( # ) from filename', 'auto-image-attributes-from-filename-with-bulk-updater') ?></span>
		</label><br>
		
		<!-- Filter Ampersand -->
		<label for="iaff_settings[bu_ampersand]">
			<input type="checkbox" name="iaff_settings[bu_ampersand]" id="iaff_settings[bu_ampersand]" value="1" <?php if ( isset($settings['bu_ampersand']) ) checked( '1', $settings['bu_ampersand'] ); ?>>
			<span><?php _e('Remove ampersand ( & ) from filename', 'auto-image-attributes-from-filename-with-bulk-updater') ?></span>
		</label><br>
		
		<!-- Filter Round Brackets -->
		<label for="iaff_settings[bu_round_brackets]">
			<input type="checkbox" name="iaff_settings[bu_round_brackets]" id="iaff_settings[bu_round_brackets]" value="1" <?php if ( isset($settings['bu_round_brackets']) ) checked( '1', $settings['bu_round_brackets'] ); ?>>
			<span><?php _e('Remove round brackets ( ( ) ) from filename', 'auto-image-attributes-from-filename-with-bulk-updater') ?></span>
		</label><br>
		
		<!-- Filter Square Brackets -->
		<label for="iaff_settings[bu_square_brackets]">
			<input type="checkbox" name="iaff_settings[bu_square_brackets]" id="iaff_settings[bu_square_brackets]" value="1" <?php if ( isset($settings['bu_square_brackets']) ) checked( '1', $settings['bu_square_brackets'] ); ?>>
			<span><?php _e('Remove square brackets ( [ ] ) from filename', 'auto-image-attributes-from-filename-with-bulk-updater') ?></span>
		</label><br>
		
		<!-- Filter Curly Brackets -->
		<label for="iaff_settings[bu_curly_brackets]">
			<input type="checkbox" name="iaff_settings[bu_curly_brackets]" id="iaff_settings[bu_curly_brackets]" value="1" <?php if ( isset($settings['bu_curly_brackets']) ) checked( '1', $settings['bu_curly_brackets'] ); ?>>
			<span><?php _e('Remove curly brackets ( { } ) from filename', 'auto-image-attributes-from-filename-with-bulk-updater') ?></span>
		</label><br>
		
	</fieldset>
		
	<?php
}

/**
 * Bulk Updater Custom Filter Callback
 *
 * @since 	1.4
 */
function iaff_bu_custom_filter_callback() {	

	// Get Settings
	$settings = iaff_get_settings();
	?>
		
	<fieldset>
		
		<p>Enter words or characters to filter separated by commas. Filter is case sensitive.</p>
		<input type="text" name="iaff_settings[bu_custom_filter]" placeholder="DCIM, img" class="all-options" value="<?php if ( isset( $settings['bu_custom_filter'] ) && ( ! empty( $settings['bu_custom_filter'] ) ) ) echo esc_attr( $settings['bu_custom_filter'] ); ?>"/><br><br>
		
		<p>Filter with regular expression</p>
		<input type="text" name="iaff_settings[bu_regex_filter]" placeholder="/regex/" class="all-options" value="<?php if ( isset( $settings['bu_regex_filter'] ) && ( ! empty( $settings['bu_regex_filter'] ) ) ) echo esc_attr( $settings['bu_regex_filter'] ); ?>"/><br>
		
	</fieldset>
	
	<?php
}

/**
 * Bulk Updater Capitalization Settings Callback
 *
 * @since 	1.4
 */
function iaff_bu_capitalization_settings_callback() {	

	// Get Settings
	$settings = iaff_get_settings();
	?>
		
	<fieldset>
	
		<!-- No bu_capitalization -->
		<label>
			<input type="radio" name="iaff_settings[bu_capitalization]" value="0" <?php if ( isset($settings['bu_capitalization']) ) checked( '0', $settings['bu_capitalization'] ); ?>/>
			<span><?php esc_attr_e( 'Leave unchanged', 'auto-image-attributes-from-filename-with-bulk-updater' ); ?></span>
		</label><br>
		
		<!-- Lowercase -->
		<label>
			<input type="radio" name="iaff_settings[bu_capitalization]" value="1" <?php if ( isset($settings['bu_capitalization']) ) checked( '1', $settings['bu_capitalization'] ); ?>/>
			<span><?php esc_attr_e( 'convert to lowercase', 'auto-image-attributes-from-filename-with-bulk-updater' ); ?></span>
		</label><br>
		
		<!-- Uppercase -->
		<label>
			<input type="radio" name="iaff_settings[bu_capitalization]" value="2" <?php if ( isset($settings['bu_capitalization']) ) checked( '2', $settings['bu_capitalization'] ); ?>/>
			<span><?php esc_attr_e( 'CONVERT TO UPPERCASE', 'auto-image-attributes-from-filename-with-bulk-updater' ); ?></span>
		</label><br>
		
		<!-- Title Casing -->
		<label>
			<input type="radio" name="iaff_settings[bu_capitalization]" value="3" <?php if ( isset($settings['bu_capitalization']) ) checked( '3', $settings['bu_capitalization'] ); ?>/>
			<span><?php esc_attr_e( 'Use title casing. First Letter Of Each Word Will Be Capitalized.', 'auto-image-attributes-from-filename-with-bulk-updater' ); ?></span>
		</label><br>
		
		<!-- Sentence Casing -->
		<label>
			<input type="radio" name="iaff_settings[bu_capitalization]" value="4" <?php if ( isset($settings['bu_capitalization']) ) checked( '4', $settings['bu_capitalization'] ); ?>/>
			<span><?php esc_attr_e( 'Use sentence casing. First letter of a sentence will be capitalized.', 'auto-image-attributes-from-filename-with-bulk-updater' ); ?></span>
		</label><br>
		
	</fieldset>
		
	<?php
}

/**
 * Bulk Updater Image Title Settings Callback
 *
 * @since 	1.4
 */
function iaff_bu_image_title_settings_callback() {	

	// Get Settings
	$settings = iaff_get_settings();
	?>
		
	<fieldset>
	
		<label>
			<input type="radio" name="iaff_settings[bu_title_source]" value="0" <?php if ( isset($settings['bu_title_source']) ) checked( '0', $settings['bu_title_source'] ); ?>/>
			<span><?php esc_attr_e( 'Use image filename as title text', 'auto-image-attributes-from-filename-with-bulk-updater' ); ?></span>
		</label><br>
		
		<label>
			<input type="radio" name="iaff_settings[bu_title_source]" value="1" <?php if ( isset($settings['bu_title_source']) ) checked( '1', $settings['bu_title_source'] ); ?>/>
			<span><?php esc_attr_e( 'Use post title as title text. If image is not attached to a post, image filename will be used instead.', 'auto-image-attributes-from-filename-with-bulk-updater' ); ?></span>
		</label><br>
		
		<h4>Bulk Updater Behaviour</h4>
		
		<label>
			<input type="radio" name="iaff_settings[bu_titles_in_post]" value="0" <?php if ( isset($settings['bu_titles_in_post']) ) checked( '0', $settings['bu_titles_in_post'] ); ?>/>
			<span><?php esc_attr_e( 'Update image titles in media library only. Image titles in existing posts will be left unchanged.', 'auto-image-attributes-from-filename-with-bulk-updater' ); ?></span>
		</label><br>
		
		<label>
			<input type="radio" name="iaff_settings[bu_titles_in_post]" value="1" <?php if ( isset($settings['bu_titles_in_post']) ) checked( '1', $settings['bu_titles_in_post'] ); ?>/>
			<span><?php esc_attr_e( 'Update image titles in media library and existing posts.', 'auto-image-attributes-from-filename-with-bulk-updater' ); ?></span>
		</label><br>
		
		<label>
			<input type="radio" name="iaff_settings[bu_titles_in_post]" value="2" <?php if ( isset($settings['bu_titles_in_post']) ) checked( '2', $settings['bu_titles_in_post'] ); ?>/>
			<span><?php esc_attr_e( 'Update image titles in existing posts only if no title is set. All image titles in media library will be updated.', 'auto-image-attributes-from-filename-with-bulk-updater' ); ?></span>
		</label><br>
		
	</fieldset>
		
	<?php
}

/**
 * Bulk Updater Image Alt Text Settings Callback
 *
 * @since 	1.4
 */
function iaff_bu_alt_text_settings_callback() {	

	// Get Settings
	$settings = iaff_get_settings();
	?>
		
	<fieldset>
	
		<label>
			<input type="radio" name="iaff_settings[bu_alt_text_source]" value="0" <?php if ( isset($settings['bu_alt_text_source']) ) checked( '0', $settings['bu_alt_text_source'] ); ?>/>
			<span><?php esc_attr_e( 'Use filename as alt text.', 'auto-image-attributes-from-filename-with-bulk-updater' ); ?></span>
		</label><br>
		
		<label>
			<input type="radio" name="iaff_settings[bu_alt_text_source]" value="1" <?php if ( isset($settings['bu_alt_text_source']) ) checked( '1', $settings['bu_alt_text_source'] ); ?>/>
			<span><?php esc_attr_e( 'Use post title as alt text. If image is not attached to a post, image filename will be used instead.', 'auto-image-attributes-from-filename-with-bulk-updater' ); ?></span>
		</label><br>
		
		<h4>Bulk Updater Behaviour</h4>
		
		<label>
			<input type="radio" name="iaff_settings[bu_alt_text_in_post]" value="0" <?php if ( isset($settings['bu_alt_text_in_post']) ) checked( '0', $settings['bu_alt_text_in_post'] ); ?>/>
			<span><?php esc_attr_e( 'Update alt text in media library only. Alt text in existing posts will be left unchanged.', 'auto-image-attributes-from-filename-with-bulk-updater' ); ?></span>
		</label><br>
		
		<label>
			<input type="radio" name="iaff_settings[bu_alt_text_in_post]" value="1" <?php if ( isset($settings['bu_alt_text_in_post']) ) checked( '1', $settings['bu_alt_text_in_post'] ); ?>/>
			<span><?php esc_attr_e( 'Update alt text in media library and existing posts.', 'auto-image-attributes-from-filename-with-bulk-updater' ); ?></span>
		</label><br>
		
		<label>
			<input type="radio" name="iaff_settings[bu_alt_text_in_post]" value="2" <?php if ( isset($settings['bu_alt_text_in_post']) ) checked( '2', $settings['bu_alt_text_in_post'] ); ?>/>
			<span><?php esc_attr_e( 'Update alt text in existing posts only if no alt text is set. All alt text in media library will be updated.', 'auto-image-attributes-from-filename-with-bulk-updater' ); ?></span>
		</label><br>
		
	</fieldset>
		
	<?php
}

/**
 * Bulk Updater Image Caption Settings Callback
 *
 * @since 	1.4
 */
function iaff_bu_image_caption_settings_callback() {	

	// Get Settings
	$settings = iaff_get_settings();
	?>
		
	<fieldset>
	
		<label>
			<input type="radio" name="iaff_settings[bu_caption_source]" value="0" <?php if ( isset($settings['bu_caption_source']) ) checked( '0', $settings['bu_caption_source'] ); ?>/>
			<span><?php esc_attr_e( 'Use image filename as caption', 'auto-image-attributes-from-filename-with-bulk-updater' ); ?></span>
		</label><br>
		
		<label>
			<input type="radio" name="iaff_settings[bu_caption_source]" value="1" <?php if ( isset($settings['bu_caption_source']) ) checked( '1', $settings['bu_caption_source'] ); ?>/>
			<span><?php esc_attr_e( 'Use post title as caption. If image is not attached to a post, image filename will be used instead.', 'auto-image-attributes-from-filename-with-bulk-updater' ); ?></span>
		</label><br>
		
	</fieldset>
		
	<?php
}

/**
 * Bulk Updater Image Description Settings Callback
 *
 * @since 	1.4
 */
function iaff_bu_image_description_settings_callback() {	

	// Get Settings
	$settings = iaff_get_settings();
	?>
		
	<fieldset>
	
		<label>
			<input type="radio" name="iaff_settings[bu_description_source]" value="0" <?php if ( isset($settings['bu_description_source']) ) checked( '0', $settings['bu_description_source'] ); ?>/>
			<span><?php esc_attr_e( 'Use image filename as description', 'auto-image-attributes-from-filename-with-bulk-updater' ); ?></span>
		</label><br>
		
		<label>
			<input type="radio" name="iaff_settings[bu_description_source]" value="1" <?php if ( isset($settings['bu_description_source']) ) checked( '1', $settings['bu_description_source'] ); ?>/>
			<span><?php esc_attr_e( 'Use post title as description. If image is not attached to a post, image filename will be used instead.', 'auto-image-attributes-from-filename-with-bulk-updater' ); ?></span>
		</label><br>
		
	</fieldset>
		
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
	} 
	
	// Get Settings
	$settings = iaff_get_settings();
	?>
	
	<div id="iaff-pro" class="wrap">
		
		<h1>
			<?php 
			if( iaff_is_pro() ) {
				echo 'Image Attributes Pro <sup>'. IAFFPRO_VERSION_NUM .'</sup>';
			} else {
				echo 'Auto Image Attributes From Filename With Bulk Updater';
			} ?>
		</h1>
		
		<div class="iaff-admin-options <?php if( ! iaff_is_pro() ) echo 'iaff-columns-2'; ?>">
		
			<div class="iaff-admin-options-main">
				<h2 class="nav-tab-wrapper hide-if-no-js showh2">
					<a class="nav-tab" href="#iaff-basic"><?php _e('Basic', 'auto-image-attributes-from-filename-with-bulk-updater') ?></a>
					<?php if ( (isset( $settings['preview_pro'] ) && boolval($settings['preview_pro'])) || iaff_is_pro() ) { ?>
						<a class="nav-tab" href="#iaff-advanced"><?php _e('Advanced', 'auto-image-attributes-from-filename-with-bulk-updater') ?></a>
						<a class="nav-tab" href="#iaff-bulk-updater-settings"><?php _e('Bulk Updater Settings', 'auto-image-attributes-from-filename-with-bulk-updater') ?></a>
					<?php } ?>
					<a class="nav-tab" href="#iaff-bulk-updater"><?php _e('Bulk Updater', 'auto-image-attributes-from-filename-with-bulk-updater') ?></a>
					<a class="nav-tab" href="#iaff-support" id="iaff-support-tab"><?php _e('Support', 'auto-image-attributes-from-filename-with-bulk-updater') ?></a>
				</h2>
			
				<form id="iaff-settings" action="options.php" method="post" enctype="multipart/form-data">
					
					<!-- Output nonce, action, and option_page fields for a settings page. -->
					<?php settings_fields( 'iaff_settings_group' ); ?>
					
					<!-- Basic Settings -->
					<div id="iaff-basic" class="iaff-settings-tab">
						<h2 class="showh2"><?php _e('Basic Settings', 'auto-image-attributes-from-filename-with-bulk-updater') ?></h2>
						<p><?php _e('Automatically add Image attributes such as Image Title, Image Caption, Description And Alt Text from Image Filename for new uploads', 'auto-image-attributes-from-filename-with-bulk-updater') ?></p>
						<?php do_settings_sections( 'iaff_basic_settings_section' ); ?>
						<?php submit_button( __('Save Settings', 'auto-image-attributes-from-filename-with-bulk-updater') ); ?>
					</div>
					
					<!-- Advanced Settings -->
					<div id="iaff-advanced" class="iaff-settings-tab">
					
						<?php if( ! iaff_is_pro() ) { ?>
							<div class="notice notice-warning inline" style="margin-top: 20px;"> 
								<p><strong><?php printf( __( 'The options below is a preview of the features included in <a href="%s" target="_blank">Image Attributes Pro</a>. Please upgrade to use them.', 'auto-image-attributes-from-filename-with-bulk-updater' ), 'https://imageattributespro.com/?utm_source=iaff-basic&utm_medium=preview-warning-advanced-tab' ); ?></strong></p>
							</div>
						<?php } ?>
						
						<h2 class="showh2"><?php _e('Advanced Settings', 'auto-image-attributes-from-filename-with-bulk-updater') ?></h2>
						<p><?php _e('Advanced settings for new uploads.', 'auto-image-attributes-from-filename-with-bulk-updater') ?></p>
						<?php do_settings_sections( 'iaff_advanced_settings_section' ); ?>
						<?php if( iaff_is_pro() ) submit_button( __('Save Settings', 'auto-image-attributes-from-filename-with-bulk-updater') ); ?>
					</div>
					
					<!-- Bulk Updater Settings -->
					<div id="iaff-bulk-updater-settings" class="iaff-settings-tab">
					
						<?php if( ! iaff_is_pro() ) { ?>
							<div class="notice notice-warning inline" style="margin-top: 20px;"> 
								<p><strong><?php printf( __( 'The options below is a preview of the features included in <a href="%s" target="_blank">Image Attributes Pro</a>. Please upgrade to use them.', 'auto-image-attributes-from-filename-with-bulk-updater' ), 'https://imageattributespro.com/?utm_source=iaff-basic&utm_medium=preview-warning-bu-settings-tab' ); ?></strong></p>
							</div>
						<?php } ?>
						
						<h2 class="showh2"><?php _e('Bulk Updater Settings', 'auto-image-attributes-from-filename-with-bulk-updater') ?></h2>
						<p><?php _e('Options set here will be used while running the Bulk Updater.', 'auto-image-attributes-from-filename-with-bulk-updater') ?></p>
						<?php do_settings_sections( 'iaff_bu_settings_section' ); ?>
						<?php if( iaff_is_pro() ) submit_button( __('Save Settings', 'auto-image-attributes-from-filename-with-bulk-updater') ); ?>
					</div>
					
				</form>

				<!-- Bulk Updater -->
				<div id="iaff-bulk-updater" class="iaff-settings-tab">

					<h2 class="showh2"><?php _e('Bulk Updater', 'auto-image-attributes-from-filename-with-bulk-updater') ?></h2>
					
					<p><?php _e('Run this bulk updater to update Image Title, Caption, Description and Alt Text for all images.', 'auto-image-attributes-from-filename-with-bulk-updater') ?></p>
					
					<div class="error inline"> 
						<p class="hide-if-js"><strong><?php _e('It seems that JavasScript is disabled in your browser. Please enable JavasScript or use a different browser to use the bulk updater.', 'auto-image-attributes-from-filename-with-bulk-updater') ?></strong></p>
						
						<p><strong><?php _e('IMPORTANT: Please backup your database before running the bulk updater.', 'auto-image-attributes-from-filename-with-bulk-updater') ?></strong></p>
						
						<p><strong><?php _e('Use <code>Test Bulk Updater</code> button to update one image at a time and verify the results.', 'auto-image-attributes-from-filename-with-bulk-updater') ?></strong></p>
						
						<?php if( ! iaff_is_pro() ) { ?>
							<p><strong><?php printf( __( 'If your image is named <em>a-lot-like_love.jpg</em>, your Image Title, Caption, Description and Alt Text will be: <em>a lot like love</em>. <a href="%s" target="_blank">Upgrade to Pro</a> for more options.', 'auto-image-attributes-from-filename-with-bulk-updater' ), 'https://imageattributespro.com/?utm_source=iaff-basic&utm_medium=bulk-updater-notice' ); ?></strong></p>
						<?php } ?>
						
					</div>
					
					<p class="submit">
						<input class="button-primary iaff-bulk-updater-buttons iaff_run_bulk_updater_button" type="submit" name="Run Bulk Updater" value="<?php _e( 'Run Bulk Updater', 'auto-image-attributes-from-filename-with-bulk-updater' ) ?>" />
						
						<input class="button-secondary iaff-bulk-updater-buttons iaff_test_bulk_updater_button" type="submit" name="Test Bulk Updater" value="<?php _e( 'Test Bulk Updater', 'auto-image-attributes-from-filename-with-bulk-updater' ) ?>" />
						
						<input class="button-secondary iaff-bulk-updater-buttons iaff_stop_bulk_updater_button" type="submit" name="Stop Bulk Updater" value="<?php _e( 'Stop Bulk Updater', 'auto-image-attributes-from-filename-with-bulk-updater' ) ?>" disabled />
					</p>
					
					<h2 class="showh2"><?php _e('Reset Counter', 'auto-image-attributes-from-filename-with-bulk-updater') ?></h2>
					
					<p><?php _e('To restart processing images from the beginning (the oldest upload first), reset the counter.', 'auto-image-attributes-from-filename-with-bulk-updater') ?></p> 
					
					<span class="reset-counter-button">
						<?php submit_button( __('Reset Counter', 'auto-image-attributes-from-filename-with-bulk-updater'), 'iaff_reset_counter_button' ); ?>
					</span>
					
					<!-- Event log -->
					<div id="bulk-updater-results">
						<fieldset id="bulk-updater-log-wrapper">
							<legend><span class="dashicons dashicons-welcome-write-blog"></span>&nbsp;<strong>Event Log</strong>&nbsp;<div class="iaff-spinner is-active" style="margin-top:0px;"></div></legend>
							
							<div id="bulk-updater-log">
								<p id="iaff_remaining_images_text"><?php _e('Number of Images Remaining: ', 'auto-image-attributes-from-filename-with-bulk-updater') ?><?php echo iaff_count_remaining_images(); ?></p>
								
								<p><?php _e('Number of Images Updated: ', 'auto-image-attributes-from-filename-with-bulk-updater') ?><?php echo iaff_number_of_images_updated(); ?></p>
							</div>
						</fieldset>
					</div>
					
					<!-- Dialogs -->
					<div class="hidden-dialogs" style="display:none;">
					
						<!-- Run Bulk Updater Confirmation Dialog -->
						<div id="iaff-confirm-run-dialog" title="Run Bulk Updater">
							<p>You are about to run the bulk updater. This will update all images and cannot be undone. Please make a database backup before you proceed. Press OK to confirm.</p>
						</div>
						
						<!-- Test Bulk Updater Dialog -->
						<div id="iaff-test-run-dialog" title="Test Bulk Updater">
							<p>The bulk updater will do a test run by updating one image. Note that this is a live test and actual values will be updated in the database. Please make a database backup before you proceed. Press Ok to confirm.</p>
						</div>
						
						<!-- Bulk Updater Reset Counter Dialog -->
						<div id="iaff-reset-counter-dialog" title="Reset Counter">
							<p>You are about to reset the bulk updater counter. The bulk updater will start from scratch in the next run. Press Ok to confirm.</p>
						</div>
						
					</div>
					
				</div><!-- Bulk Updater ends -->
				
				<!-- Support Tab -->
				<div id="iaff-support" class="iaff-settings-tab">
					
					<h2 class="showh2"><?php _e('Support And Documentation', 'auto-image-attributes-from-filename-with-bulk-updater') ?></h2>
					
					<p><?php _e('Looking for help? Here are the available options.', 'auto-image-attributes-from-filename-with-bulk-updater') ?></p>
					
					<!-- Free Support -->
					<div class="iaff-support-block">
						<div class="iaff-support-block-inner">
							<h2 class="patua showh2">Free Support</h2>
							<ul>
								<li><span class="dashicons dashicons-yes"></span><a target="_blank" href="https://imageattributespro.com/docs/?utm_source=iaff-basic&utm_medium=support-tab">Documentation</a></li>
								<li><span class="dashicons dashicons-yes"></span><a target="_blank" href="https://wordpress.org/plugins/auto-image-attributes-from-filename-with-bulk-updater/#faq-header">Read the FAQ</a></li>
								<li><span class="dashicons dashicons-yes"></span><a target="_blank" href="https://wordpress.org/support/plugin/auto-image-attributes-from-filename-with-bulk-updater">Free Support Forum</a></li>
							</ul>
						</div>
					</div><!-- .iaff-support-block -->
					
					<!-- Premium Support -->
					<?php if ( iaff_is_pro() ) { ?>
						<div class="iaff-support-block">
							<div class="iaff-support-block-inner">
								<h2 class="patua showh2">Premium Support</h2>
								<ul>
									<li><span class="dashicons dashicons-yes"></span><a target="_blank" href="https://imageattributespro.com/docs/?utm_source=iap&utm_medium=support-tab">Documentation</a></li>
									<li><span class="dashicons dashicons-yes"></span><a target="_blank" href="https://imageattributespro.com/contact/?utm_source=iap&utm_medium=support-tab">Priority Email Support</a></li>
									<li><span class="dashicons dashicons-yes"></span><a target="_blank" href="https://imageattributespro.com/contact/?utm_source=iap&utm_medium=support-tab">Contact Support</a></li>
									
								</ul>
							</div>
						</div><!-- .iaff-support-block -->
					<?php } ?>
					
					<!-- Upgrade for Premium Support -->
					<?php if ( ! iaff_is_pro() ) { ?>
						<div class="iaff-support-block">
							<div class="iaff-support-block-inner">
								<a target="_blank" href="https://imageattributespro.com/?utm_source=iaff-basic&utm_medium=support-tab">
									<h2 class="patua showh2">Upgrade to Pro</h2>
									<ul>
										<li><span class="dashicons dashicons-yes"></span>Priority support</li>
										<li><span class="dashicons dashicons-yes"></span>Advanced features</li>
										<li><span class="dashicons dashicons-yes"></span>Support ongoing development</li>
									</ul>
								</a>
							</div>
						</div><!-- .iaff-support-block -->
					<?php } ?>
					
				</div>
			</div><!-- .iaff-admin-options-main -->
			
			<!-- Upgrade to pro sidebar -->
			<?php if ( ! iaff_is_pro() ) { ?>
				<div class="iaff-admin-options-sidebar">
					
					<div class="iaff-upgrade-header">
						<a href="https://imageattributespro.com/?utm_source=iaff-basic&utm_medium=coupon-sidebar" target="_blank">
							<div class="iaff-icon"></div>
							<h1 class="patua">Upgrade to Pro</h1>
							<ul>
								<li><span class="dashicons dashicons-yes"></span>Advanced formatting options</li>
								<li><span class="dashicons dashicons-yes"></span>Use post titles as attributes</li>
								<li><span class="dashicons dashicons-yes"></span>Fine tune bulk updater settings</li>
							</ul>
						</a>
					</div><!-- .iaff-upgrade-header -->
					
					<div class="iaff-upgrade-form">
					
						<form method="post" action="https://imageattributespro.com/coupons/" target="_blank">
							
							<h1 class="patua">10% For Lifetime</h1>

							<?php $user = wp_get_current_user(); ?>

							<p>Submit your name and email to receive 10% off when you upgrade to the Lifetime license.</p>

							<fieldset>
								
								<input type="text" name="first_name" value="<?php echo esc_attr( trim( $user->first_name ) ); ?>" placeholder="First Name"/>
								
								<input type="email" name="email" value="<?php echo esc_attr( $user->user_email ); ?>" placeholder="Your Email"/>

								<input type="hidden" name="source" value="IAFF" />
								<input type="hidden" name="submitted" id="submitted" value="true" />

								<input type="submit" class="button" value="Send me the coupon"/>
								
							</fieldset>

							<p class="opacity-75">Your email will be kept private and will not be shared or spammed.</p>
						</form>
						
						<hr>
						
						<div class="iaff-upgrade-review">
							<div class="iaff-upgrade-review-stars">
								<h3>"Fast &amp; Simple Time Saver"</h3>
								<?php echo str_repeat('<span class="dashicons dashicons-star-filled"></span>', 5); ?>
							</div>
							<div class="iaff-upgrade-review-detail">
								<div class="iaff-upgrade-review-detail-left">
									<img class="iaff-upgrade-review-avatar" src="<?php echo IAFF_IMAGE_ATTRIBUTES_FROM_FILENAME_URL . 'admin/img/checkerboardflyer.jpeg'; ?>" />
								</div>
								<div class="iaff-upgrade-review-detail-right">
									<p>"This plugin will save me a LOT of time! Great plugin!" <br><a target="_blank" href="https://wordpress.org/support/topic/fast-simple-time-saver/">@checkerboardflyer</a></p>
								</div>	
							</div>
						</div>
					</div><!-- .iaff-upgrade-form -->
				</div><!-- .iaff-admin-options-sidebar -->
			<?php } ?>
			
		</div><!-- .iaff-admin-options -->
	</div><!-- #iaff-pro .wrap -->
	<?php
}