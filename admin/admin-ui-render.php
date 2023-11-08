<?php
/**
 * Admin UI setup and render
 *
 * @since 1.3
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
 * @function	iaff_bu_image_title_settings_callback()		Bulk Updater Image Title Settings Callback
 * @function	iaff_bu_image_alttext_settings_callback()		Bulk Updater Image Alt Text Settings Callback
 * @function	iaff_bu_image_caption_settings_callback()	Bulk Updater Image Caption Settings Callback
 * @function	iaff_bu_image_description_settings_callback() Bulk Updater Image Description Settings Callback		
 * @function	iaff_admin_interface_render()				Admin interface renderer	
 */

// Exit if accessed directly
if ( ! defined('ABSPATH') ) exit;

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
		
		<!-- Auto Add Alt Text -->
		<label for="iaff_settings[image_alttext]">
			<input type="checkbox" name="iaff_settings[image_alttext]" id="iaff_settings[image_alttext]" value="1" <?php if ( isset($settings['image_alttext']) ) checked( '1', $settings['image_alttext'] ); ?>>
			<span><?php _e('Set Image Alt Text for new uploads', 'auto-image-attributes-from-filename-with-bulk-updater') ?></span>
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
		
		<p><?php printf( __( 'Enter words or characters to filter separated by commas. Filter is case sensitive. <a href="%s" target="_blank">Read more.</a>', 'auto-image-attributes-from-filename-with-bulk-updater' ), 'https://imageattributespro.com/custom-filter-and-regex-filter/?utm_source=iaff-basic&utm_medium=advanced-tab' ); ?></p>
		<input type="text" name="iaff_settings[custom_filter]" placeholder="e.g. DCIM, img" class="regular-text code" value="<?php if ( isset( $settings['custom_filter'] ) && ( ! empty( $settings['custom_filter'] ) ) ) echo esc_attr( $settings['custom_filter'] ); ?>"/><br><br>
		
		<p><?php _e('Filter with regular expression', 'auto-image-attributes-from-filename-with-bulk-updater') ?></p>
		<input type="text" name="iaff_settings[regex_filter]" placeholder="/regex/" class="regular-text code" value="<?php if ( isset( $settings['regex_filter'] ) && ( ! empty( $settings['regex_filter'] ) ) ) echo esc_attr( $settings['regex_filter'] ); ?>"/><br>
		
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
		
	<fieldset class="iaff-image-attribute-settings-fieldset">
	
		<label>
			<input type="radio" name="iaff_settings[title_source]" value="0" <?php if ( isset($settings['title_source']) ) checked( '0', $settings['title_source'] ); ?>/>
			<span><?php esc_attr_e( 'Use image filename as title text', 'auto-image-attributes-from-filename-with-bulk-updater' ); ?></span>
		</label><br>
		
		<label>
			<input type="radio" name="iaff_settings[title_source]" value="1" <?php if ( isset($settings['title_source']) ) checked( '1', $settings['title_source'] ); ?>/>
			<span><?php esc_attr_e( 'Use post title as title text. If image is not uploaded to a post, image filename will be used instead.', 'auto-image-attributes-from-filename-with-bulk-updater' ); ?></span>
		</label><br>
		
		<label>
			<input type="radio" id="radio_custom_attribute_title" class="radio_custom_attribute" data-attribute="title" name="iaff_settings[title_source]" value="2" <?php if ( isset( $settings['title_source'] ) ) checked( '2', $settings['title_source'] ); ?>/>
			<span><?php esc_attr_e( 'Use custom attribute', 'auto-image-attributes-from-filename-with-bulk-updater' ); ?></span>
			
			<input type="text" id="text_custom_attribute_title" class="text_custom_attribute regular-text code" data-attribute="title" name="iaff_settings[custom_attribute_title]" placeholder="e.g. %filename% - %posttitle%" value="<?php if ( isset( $settings['custom_attribute_title'] ) && ( ! empty( $settings['custom_attribute_title'] ) ) ) echo esc_attr( $settings['custom_attribute_title'] ); ?>" />

			<span class="copy-attribute-link" data-attribute="title" data-copied-text="<?php _e( 'Copied!', 'auto-image-attributes-from-filename-with-bulk-updater' ); ?>"><a href="#"><?php _e( 'Copy to all attributes.', 'auto-image-attributes-from-filename-with-bulk-updater' ); ?></a></span>
		</label><br>

		<?php iaff_custom_attribute_tags_ui_render( 'title' ); ?>
		
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
		
	<fieldset class="iaff-image-attribute-settings-fieldset">
	
		<label>
			<input type="radio" name="iaff_settings[alt_text_source]" value="0" <?php if ( isset($settings['alt_text_source']) ) checked( '0', $settings['alt_text_source'] ); ?>/>
			<span><?php esc_attr_e( 'Use image filename as alt text', 'auto-image-attributes-from-filename-with-bulk-updater' ); ?></span>
		</label><br>
		
		<label>
			<input type="radio" name="iaff_settings[alt_text_source]" value="1" <?php if ( isset($settings['alt_text_source']) ) checked( '1', $settings['alt_text_source'] ); ?>/>
			<span><?php esc_attr_e( 'Use post title as alt text. If image is not uploaded to a post, image filename will be used instead.', 'auto-image-attributes-from-filename-with-bulk-updater' ); ?></span>
		</label><br>
		
		<label>
			<input type="radio" id="radio_custom_attribute_alt_text" class="radio_custom_attribute" data-attribute="alt_text" name="iaff_settings[alt_text_source]" value="2" <?php if ( isset( $settings['alt_text_source'] ) ) checked( '2', $settings['alt_text_source'] ); ?>/>
			<span><?php esc_attr_e( 'Use custom attribute', 'auto-image-attributes-from-filename-with-bulk-updater' ); ?></span>
			
			<input type="text" id="text_custom_attribute_alt_text" class="text_custom_attribute regular-text code" data-attribute="alt_text" name="iaff_settings[custom_attribute_alt_text]" placeholder="e.g. %filename% - %posttitle%" value="<?php if ( isset( $settings['custom_attribute_alt_text'] ) && ( ! empty( $settings['custom_attribute_alt_text'] ) ) ) echo esc_attr( $settings['custom_attribute_alt_text'] ); ?>" />

			<span class="copy-attribute-link" data-attribute="alt_text" data-copied-text="<?php _e( 'Copied!', 'auto-image-attributes-from-filename-with-bulk-updater' ); ?>"><a href="#"><?php _e( 'Copy to all attributes.', 'auto-image-attributes-from-filename-with-bulk-updater' ); ?></a></span>
		</label><br>

		<?php iaff_custom_attribute_tags_ui_render( 'alt_text' ); ?>
		
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
		
	<fieldset class="iaff-image-attribute-settings-fieldset">
	
		<label>
			<input type="radio" name="iaff_settings[caption_source]" value="0" <?php if ( isset($settings['caption_source']) ) checked( '0', $settings['caption_source'] ); ?>/>
			<span><?php esc_attr_e( 'Use image filename as caption', 'auto-image-attributes-from-filename-with-bulk-updater' ); ?></span>
		</label><br>
		
		<label>
			<input type="radio" name="iaff_settings[caption_source]" value="1" <?php if ( isset($settings['caption_source']) ) checked( '1', $settings['caption_source'] ); ?>/>
			<span><?php esc_attr_e( 'Use post title as caption. If image is not uploaded to a post, image filename will be used instead.', 'auto-image-attributes-from-filename-with-bulk-updater' ); ?></span>
		</label><br>
		
		<label>
			<input type="radio" id="radio_custom_attribute_caption" class="radio_custom_attribute" data-attribute="caption" name="iaff_settings[caption_source]" value="2" <?php if ( isset( $settings['caption_source'] ) ) checked( '2', $settings['caption_source'] ); ?>/>
			<span><?php esc_attr_e( 'Use custom attribute', 'auto-image-attributes-from-filename-with-bulk-updater' ); ?></span>
			
			<input type="text" id="text_custom_attribute_caption" class="text_custom_attribute regular-text code" data-attribute="caption" name="iaff_settings[custom_attribute_caption]" placeholder="e.g. %filename% - %posttitle%" value="<?php if ( isset( $settings['custom_attribute_caption'] ) && ( ! empty( $settings['custom_attribute_caption'] ) ) ) echo esc_attr( $settings['custom_attribute_caption'] ); ?>" />

			<span class="copy-attribute-link" data-attribute="caption" data-copied-text="<?php _e( 'Copied!', 'auto-image-attributes-from-filename-with-bulk-updater' ); ?>"><a href="#"><?php _e( 'Copy to all attributes.', 'auto-image-attributes-from-filename-with-bulk-updater' ); ?></a></span>
		</label><br>

		<?php iaff_custom_attribute_tags_ui_render( 'caption' ); ?>
		
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
		
	<fieldset class="iaff-image-attribute-settings-fieldset">
	
		<label>
			<input type="radio" name="iaff_settings[description_source]" value="0" <?php if ( isset($settings['description_source']) ) checked( '0', $settings['description_source'] ); ?>/>
			<span><?php esc_attr_e( 'Use image filename as description', 'auto-image-attributes-from-filename-with-bulk-updater' ); ?></span>
		</label><br>
		
		<label>
			<input type="radio" name="iaff_settings[description_source]" value="1" <?php if ( isset($settings['description_source']) ) checked( '1', $settings['description_source'] ); ?>/>
			<span><?php esc_attr_e( 'Use post title as description. If image is not uploaded to a post, image filename will be used instead.', 'auto-image-attributes-from-filename-with-bulk-updater' ); ?></span>
		</label><br>
		
		<label>
			<input type="radio" id="radio_custom_attribute_description" class="radio_custom_attribute" data-attribute="description" name="iaff_settings[description_source]" value="2" <?php if ( isset( $settings['description_source'] ) ) checked( '2', $settings['description_source'] ); ?>/>
			<span><?php esc_attr_e( 'Use custom attribute', 'auto-image-attributes-from-filename-with-bulk-updater' ); ?></span>
			
			<input type="text" id="text_custom_attribute_description" class="text_custom_attribute regular-text code" data-attribute="description" name="iaff_settings[custom_attribute_description]" placeholder="e.g. %filename% - %posttitle%" value="<?php if ( isset( $settings['custom_attribute_description'] ) && ( ! empty( $settings['custom_attribute_description'] ) ) ) echo esc_attr( $settings['custom_attribute_description'] ); ?>" />

			<span class="copy-attribute-link" data-attribute="description" data-copied-text="<?php _e( 'Copied!', 'auto-image-attributes-from-filename-with-bulk-updater' ); ?>"><a href="#"><?php _e( 'Copy to all attributes.', 'auto-image-attributes-from-filename-with-bulk-updater' ); ?></a></span>
		</label><br>

		<?php iaff_custom_attribute_tags_ui_render( 'description' ); ?>
		
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
			<input type="checkbox" name="iaff_settings[clean_filename]" id="iaff_settings[clean_filename]" value="1" <?php if ( isset( $settings['clean_filename'] ) ) checked( '1', $settings['clean_filename'] ); ?>>
			<span><?php _e( 'Clean actual image filename after upload.', 'auto-image-attributes-from-filename-with-bulk-updater' ); ?></span>
		</label>
		<p class="iaff-description"><?php printf( __( 'Cleans filename of new image uploads using selected filters, including custom filters.', 'auto-image-attributes-from-filename-with-bulk-updater' ) ); ?></p>

		<!-- Copy image attributes to post HTML while updating in Media Library. -->
		<label for="iaff_settings[copy_attachment_to_post]">
			<input type="checkbox" name="iaff_settings[copy_attachment_to_post]" id="iaff_settings[copy_attachment_to_post]" value="1" <?php if ( isset( $settings['copy_attachment_to_post'] ) ) checked( '1', $settings['copy_attachment_to_post'] ); echo iaff_disabled( '4.3' ); ?>>
			<span><?php _e( 'Copy image attributes to post HTML while updating in Media Library.', 'auto-image-attributes-from-filename-with-bulk-updater' ); ?></span>
		</label>
		<p class="iaff-description"><?php printf( __( 'Any changes made to image attributes in the media library will be automatically synced to the corresponding post HTML. <a href="%s" target="_blank">Read more.</a>', 'auto-image-attributes-from-filename-with-bulk-updater' ), 'https://imageattributespro.com/auto-copy-image-attributes-to-post-html-from-media-library/?utm_source=iaff-basic&utm_medium=advanced-tab' ); ?></p>

		<!-- Update image attributes on post publish or update. -->
		<label for="iaff_settings[update_attributes_on_save_post]">
			<input type="checkbox" name="iaff_settings[update_attributes_on_save_post]" id="iaff_settings[update_attributes_on_save_post]" value="1" <?php if ( isset( $settings['update_attributes_on_save_post'] ) ) checked( '1', $settings['update_attributes_on_save_post'] ); echo iaff_disabled( '4.3' ); ?>>
			<span><?php _e( 'Update image attributes on post publish or update.', 'auto-image-attributes-from-filename-with-bulk-updater' ); ?></span>
		</label>
		<p class="iaff-description"><?php printf( __( 'Automatically updates image attributes when a post is published or updated. Ensures image attributes are always consistent with settings. <a href="%s" target="_blank">Read more.</a>', 'auto-image-attributes-from-filename-with-bulk-updater' ), 'https://imageattributespro.com/update-image-attributes-on-save-post/?utm_source=iaff-basic&utm_medium=advanced-tab' ); ?></p>

		<?php iaff_print_disabled_notice( '4.3' ); ?>
		
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
		
		<!-- Auto Add Alt Text -->
		<label for="iaff_settings[bu_image_alttext]">
			<input type="checkbox" name="iaff_settings[bu_image_alttext]" id="iaff_settings[bu_image_alttext]" value="1" <?php if ( isset($settings['bu_image_alttext']) ) checked( '1', $settings['bu_image_alttext'] ); ?>>
			<span><?php _e('Update Image Alt Text', 'auto-image-attributes-from-filename-with-bulk-updater') ?></span>
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
		
	</fieldset>

	<?php
}

/**
 * Bulk Updater Image Title Settings Callback
 *
 * @since 1.4
 * @since 4.3 Added "Update in:" checkboxes. "Bulk Updater Behaviour" is renamed to "Handling existing attributes:" and it's values are set to 1 and 2 to match existing values.
 */
function iaff_bu_image_title_settings_callback() {	

	// Get Settings
	$settings = iaff_get_settings();
	?>
		
	<fieldset>

		<h4 style="margin-top: 5px;"><?php _e( 'Update in:', 'auto-image-attributes-from-filename-with-bulk-updater' ); ?></h4>

		<label for="iaff_settings[bu_title_location_ml]">
			<input type="checkbox" name="iaff_settings[bu_title_location_ml]" id="iaff_settings[bu_title_location_ml]" value="1" <?php if ( isset($settings['bu_title_location_ml']) ) checked( '1', $settings['bu_title_location_ml'] ); echo iaff_disabled( '4.3' ); ?>>
			<span><?php _e( 'Media Library', 'auto-image-attributes-from-filename-with-bulk-updater' ) ?></span>
		</label><br>

		<label for="iaff_settings[bu_title_location_post]">
			<input type="checkbox" name="iaff_settings[bu_title_location_post]" id="iaff_settings[bu_title_location_post]" value="1" <?php if ( isset($settings['bu_title_location_post']) ) checked( '1', $settings['bu_title_location_post'] ); echo iaff_disabled( '4.3' ); ?>>
			<span><?php _e( 'Post HTML', 'auto-image-attributes-from-filename-with-bulk-updater' ) ?></span>
		</label><br>

		<?php iaff_print_disabled_notice( '4.3' ); ?>

		<?php if ( iaff_disabled( '4.3' ) == 'disabled' ) { ?>
			<!-- Hidden fields added to preserve values during a save -->
			<input type="hidden" name="iaff_settings[bu_title_location_ml]" value="1">
			<input type="hidden" name="iaff_settings[bu_title_location_post]" value="1">
		<?php } ?>
		
		<h4><?php _e( 'Handling existing attributes:', 'auto-image-attributes-from-filename-with-bulk-updater' ); ?></h4>
		
		<label>
			<input type="radio" name="iaff_settings[bu_title_behaviour]" value="1" <?php if ( isset($settings['bu_title_behaviour']) ) checked( '1', $settings['bu_title_behaviour'] ); ?>/>
			<span><?php esc_attr_e( 'Update all attributes overwriting any existing attributes.', 'auto-image-attributes-from-filename-with-bulk-updater' ); ?></span>
		</label><br>
		
		<label>
			<input type="radio" name="iaff_settings[bu_title_behaviour]" value="2" <?php if ( isset($settings['bu_title_behaviour']) ) checked( '2', $settings['bu_title_behaviour'] ); ?>/>
			<span><?php esc_attr_e( 'Preserve existing attributes and add missing attributes only.', 'auto-image-attributes-from-filename-with-bulk-updater' ); ?></span>
		</label><br>
		
	</fieldset>
		
	<?php
}

/**
 * Bulk Updater Image Alt Text Settings Callback
 *
 * @since 1.4
 * @since 4.3 Added "Update in:" checkboxes. "Bulk Updater Behaviour" is renamed to "Handling existing attributes:" and it's values are set to 1 and 2 to match existing values.
 */
function iaff_bu_image_alttext_settings_callback() {	

	// Get Settings
	$settings = iaff_get_settings();
	?>
		
	<fieldset>

		<h4 style="margin-top: 5px;"><?php _e( 'Update in:', 'auto-image-attributes-from-filename-with-bulk-updater' ); ?></h4>

		<?php
		
		?>

		<label for="iaff_settings[bu_alt_text_location_ml]">
			<input type="checkbox" name="iaff_settings[bu_alt_text_location_ml]" id="iaff_settings[bu_alt_text_location_ml]" value="1" <?php if ( isset($settings['bu_alt_text_location_ml']) ) checked( '1', $settings['bu_alt_text_location_ml'] ); echo iaff_disabled( '4.3' ); ?>>
			<span><?php _e( 'Media Library', 'auto-image-attributes-from-filename-with-bulk-updater' ) ?></span>
		</label><br>

		<label for="iaff_settings[bu_alt_text_location_post]">
			<input type="checkbox" name="iaff_settings[bu_alt_text_location_post]" id="iaff_settings[bu_alt_text_location_post]" value="1" <?php if ( isset($settings['bu_alt_text_location_post']) ) checked( '1', $settings['bu_alt_text_location_post'] ); echo iaff_disabled( '4.3' ); ?>>
			<span><?php _e( 'Post HTML', 'auto-image-attributes-from-filename-with-bulk-updater' ) ?></span>
		</label><br>

		<?php iaff_print_disabled_notice( '4.3' ); ?>

		<?php if ( iaff_disabled( '4.3' ) == 'disabled' ) { ?>
			<!-- Hidden fields added to preserve values during a save -->
			<input type="hidden" name="iaff_settings[bu_alt_text_location_ml]" value="1">
			<input type="hidden" name="iaff_settings[bu_alt_text_location_post]" value="1">
		<?php } ?>
		
		<h4><?php _e( 'Handling existing attributes:', 'auto-image-attributes-from-filename-with-bulk-updater' ); ?></h4>

		<label>
			<input type="radio" name="iaff_settings[bu_alt_text_behaviour]" value="1" <?php if ( isset($settings['bu_alt_text_behaviour']) ) checked( '1', $settings['bu_alt_text_behaviour'] ); ?>/>
			<span><?php esc_attr_e( 'Update all attributes overwriting any existing attributes.', 'auto-image-attributes-from-filename-with-bulk-updater' ); ?></span>
		</label><br>
		
		<label>
			<input type="radio" name="iaff_settings[bu_alt_text_behaviour]" value="2" <?php if ( isset($settings['bu_alt_text_behaviour']) ) checked( '2', $settings['bu_alt_text_behaviour'] ); ?>/>
			<span><?php esc_attr_e( 'Preserve existing attributes and add missing attributes only.', 'auto-image-attributes-from-filename-with-bulk-updater' ); ?></span>
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
		
		<h4 style="margin-top: 5px;"><?php _e( 'Handling existing attributes:', 'auto-image-attributes-from-filename-with-bulk-updater' ); ?></h4>

		<label>
			<input type="radio" name="iaff_settings[bu_caption_behaviour]" value="0" <?php if ( isset($settings['bu_caption_behaviour']) ) checked( '0', $settings['bu_caption_behaviour'] ); ?>/>
			<span><?php esc_attr_e( 'Update all attributes overwriting any existing attributes.', 'auto-image-attributes-from-filename-with-bulk-updater' ); ?></span>
		</label><br>

		<label>
			<input type="radio" name="iaff_settings[bu_caption_behaviour]" value="1" <?php if ( isset($settings['bu_caption_behaviour']) ) checked( '1', $settings['bu_caption_behaviour'] ); ?>/>
			<span><?php esc_attr_e( 'Preserve existing attributes and add missing attributes only.', 'auto-image-attributes-from-filename-with-bulk-updater' ); ?></span>
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
		
		<h4 style="margin-top: 5px;"><?php _e( 'Handling existing attributes:', 'auto-image-attributes-from-filename-with-bulk-updater' ); ?></h4>

		<label>
			<input type="radio" name="iaff_settings[bu_description_behaviour]" value="0" <?php if ( isset($settings['bu_description_behaviour']) ) checked( '0', $settings['bu_description_behaviour'] ); ?>/>
			<span><?php esc_attr_e( 'Update all attributes overwriting any existing attributes.', 'auto-image-attributes-from-filename-with-bulk-updater' ); ?></span>
		</label><br>

		<label>
			<input type="radio" name="iaff_settings[bu_description_behaviour]" value="1" <?php if ( isset($settings['bu_description_behaviour']) ) checked( '1', $settings['bu_description_behaviour'] ); ?>/>
			<span><?php esc_attr_e( 'Preserve existing attributes and add missing attributes only.', 'auto-image-attributes-from-filename-with-bulk-updater' ); ?></span>
		</label><br>
		
	</fieldset>
		
	<?php
}

/**
 * Display the selector UI to show available tags.
 * 
 * @since 2.1
 * 
 * @param $data_attribute string The attribute for which the UI will be used for.data-attribute will be different for each attribute.
 */
function iaff_custom_attribute_tags_ui_render( $data_attribute ) {
	?>
<div class="iaff-custom-attribute-tags">
	<?php
	$available_tags = iaff_custom_attribute_tags();

	if ( ! empty( $available_tags ) ) :
		?>
		<p><?php _e( 'Available tags:' ); ?></p>
		<p><?php _e( 'The following tags when used in a custom attribute will be replaced with their corresponding value.', 'auto-image-attributes-from-filename-with-bulk-updater' ); ?></p>
		<ul class="iaff-available-custom-attribute-tags" role="list">
			<?php
			foreach ( $available_tags as $tag => $explanation ) {
				?>
				<li>
					<button type="button"
						class="button button-secondary"
						data-attribute="<?php echo $data_attribute; ?>"
						title ="<?php echo esc_attr( $explanation ); ?>"
						aria-label="<?php echo esc_attr( $explanation ); ?>">
						<?php echo '%' . $tag . '%'; ?>
					</button>
				</li>
				<?php
			}
			?>
		</ul>
		<p><?php _e( 'For example, if you set custom attribute as <code>%posttitle% - Your Name</code>, the <code>%posttitle%</code> will be replaced by the title of the post to which the image is uploaded to. ', 'auto-image-attributes-from-filename-with-bulk-updater' ); ?></p>
	<?php endif; ?>
</div>
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
						<p><?php printf( __( 'Automatically add image attributes such as Image Title, Alt Text, Caption and Description from image filename for new uploads. <a href="%s" target="_blank">Take a tour</a>', 'auto-image-attributes-from-filename-with-bulk-updater' ), 'https://imageattributespro.com/demo/?utm_source=iaff-basic&utm_medium=basic-tab' ); ?> 📺</p>
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
						<p class="hide-if-js"><strong><?php _e('It seems that JavaScript is disabled in your browser. Please enable JavasScript or use a different browser to use the bulk updater.', 'auto-image-attributes-from-filename-with-bulk-updater') ?></strong></p>
						
						<p><strong><?php _e('IMPORTANT: Please backup your database before running the bulk updater.', 'auto-image-attributes-from-filename-with-bulk-updater') ?></strong></p>
						
						<p><strong><?php _e('Use <code>Test Bulk Updater</code> button to update one image at a time and verify the results.', 'auto-image-attributes-from-filename-with-bulk-updater') ?></strong></p>
						
						<?php if( ! iaff_is_pro() ) { ?>
							<p><strong><?php printf( __( 'The Bulk Updater will update every attribute. If your image is named <em>a-lot-like_love.jpg</em>, your Image Title, Alt Text, Caption and Description will be: <em>a lot like love</em>. <a href="%s" target="_blank">Upgrade to Pro</a> for more options.', 'auto-image-attributes-from-filename-with-bulk-updater' ), 'https://imageattributespro.com/?utm_source=iaff-basic&utm_medium=bulk-updater-notice' ); ?></strong></p>
						<?php } ?>
						
					</div>

					<?php 
					$disabled_attribute = '';

					if ( function_exists( 'iaffpro_get_settings' ) ) {
						$settings = iaffpro_get_settings();

						if ( empty( $settings['registered_email'] ) || empty( $settings['license_key'] ) ) {
							$disabled_attribute = 'disabled';
						}
					}
					?>
						
					<?php if ( $disabled_attribute === 'disabled' ) { ?>
						<div class="error inline"> 
							<p><strong><?php printf( __( '<a href="%s">Please enter license info</a> to activate the plugin and run the bulk updater.', 'auto-image-attributes-from-filename-with-bulk-updater' ), admin_url( 'options.php?page=image-attributes-pro-activation' ) ); ?></strong></p>
						</div>
					<?php } ?>
					
					<p class="submit">
						<input class="button-primary iaff-bulk-updater-buttons iaff_run_bulk_updater_button" type="submit" name="Run Bulk Updater" value="<?php _e( 'Run Bulk Updater', 'auto-image-attributes-from-filename-with-bulk-updater' ) ?>" <?php echo $disabled_attribute; ?>/>
						
						<input class="button-secondary iaff-bulk-updater-buttons iaff_test_bulk_updater_button" type="submit" name="Test Bulk Updater" value="<?php _e( 'Test Bulk Updater', 'auto-image-attributes-from-filename-with-bulk-updater' ) ?>" <?php echo $disabled_attribute; ?>/>
						
						<input class="button-secondary iaff-bulk-updater-buttons iaff_stop_bulk_updater_button" type="submit" name="Stop Bulk Updater" value="<?php _e( 'Stop Bulk Updater', 'auto-image-attributes-from-filename-with-bulk-updater' ) ?>" disabled />
					</p>
					
					<h2 class="showh2"><?php _e('Tools', 'auto-image-attributes-from-filename-with-bulk-updater') ?></h2>
					
					<p><?php _e('To restart processing images from the beginning (the oldest upload first), reset the counter.', 'auto-image-attributes-from-filename-with-bulk-updater') ?></p>

					<?php if ( apply_filters( 'iaff_debug_mode', false ) ) { ?>
						<p><?php printf( __( 'If Bulk Updater is stuck, refresh the page, skip current image and try running the bulk updater again. <a href="%s" target="_blank">Read more.</a>', 'auto-image-attributes-from-filename-with-bulk-updater' ), 'https://imageattributespro.com/fix-bulk-updater-stuck-on-same-image/?utm_source=iaff-basic&utm_medium=skip-image-button' ); ?></p>
					<?php } ?>

					<p class="submit">
						<input class="button-secondary iaff-bulk-updater-buttons iaff_reset_counter_button" type="submit" name="Reset Counter" value="<?php _e( 'Reset Counter', 'auto-image-attributes-from-filename-with-bulk-updater' ) ?>" />
						
						<?php if ( apply_filters( 'iaff_debug_mode', false ) ) { ?>
							<input class="button-secondary iaff-bulk-updater-buttons iaff_skip_image_button" type="submit" name="Skip Image" value="<?php _e( 'Skip Image', 'auto-image-attributes-from-filename-with-bulk-updater' ) ?>" />
						<?php } ?>
					</p>
					
					<!-- Event log -->
					<div id="bulk-updater-results">
						<fieldset id="bulk-updater-log-wrapper">
							<legend><span class="dashicons dashicons-welcome-write-blog"></span>&nbsp;<strong><?php _e('Event Log', 'auto-image-attributes-from-filename-with-bulk-updater'); ?></strong>&nbsp;<div class="iaff-spinner is-active" style="margin-top:0px;"></div></legend>

							<?php if ( function_exists( 'iaffpro_event_log_delete' ) ) { ?>
								<div id="bulk-updater-delete-log-button" class="dashicons dashicons-trash" title="<?php _e( 'Delete Event Log', 'auto-image-attributes-from-filename-with-bulk-updater' ) ?>" style="float: right; opacity: 0.7; margin-top: -25px; font-size: 18px;"></div>
							<?php } ?>
							
							<div id="bulk-updater-log">

								<?php 
								if ( function_exists( 'iaffpro_event_log_read' ) ) {
									$event_log = iaffpro_event_log_read();

									foreach ( $event_log as $log ) {
										echo '<p>' . $log . '</p>';
									}
								}
								?>

								<p id="iaff_remaining_images_text"><?php _e('Number of Images Remaining: ', 'auto-image-attributes-from-filename-with-bulk-updater') ?><?php echo iaff_count_remaining_images(); ?></p>
								
								<p><?php _e('Number of Images Updated: ', 'auto-image-attributes-from-filename-with-bulk-updater') ?><?php echo iaff_number_of_images_updated(); ?></p>
								
							</div>
						</fieldset>
					</div>
					
					<!-- Dialogs -->
					<div class="hidden-dialogs" style="display:none;">
					
						<!-- Run Bulk Updater Confirmation Dialog -->
						<div id="iaff-confirm-run-dialog" title="<?php esc_attr_e('Run Bulk Updater', 'auto-image-attributes-from-filename-with-bulk-updater'); ?>">
							<p><?php _e('You are about to run the bulk updater. This will update all images and cannot be undone. Please make a database backup before you proceed. Press OK to confirm.', 'auto-image-attributes-from-filename-with-bulk-updater'); ?></p>
						</div>
						
						<!-- Test Bulk Updater Dialog -->
						<div id="iaff-test-run-dialog" title="<?php esc_attr_e('Test Bulk Updater', 'auto-image-attributes-from-filename-with-bulk-updater'); ?>">
							<p><?php _e('The bulk updater will do a test run by updating one image. Note that this is a live test and actual values will be updated in the database. Please make a database backup before you proceed. Press Ok to confirm.', 'auto-image-attributes-from-filename-with-bulk-updater'); ?></p>
						</div>
						
						<!-- Bulk Updater Reset Counter Dialog -->
						<div id="iaff-reset-counter-dialog" title="<?php esc_attr_e('Reset Counter', 'auto-image-attributes-from-filename-with-bulk-updater'); ?>">
							<p><?php _e('You are about to reset the bulk updater counter. The bulk updater will start from scratch in the next run. Press Ok to confirm.', 'auto-image-attributes-from-filename-with-bulk-updater'); ?></p>
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
							<h2 class="patua showh2"><?php _e('Free Support', 'auto-image-attributes-from-filename-with-bulk-updater'); ?></h2>
							<ul>
								<li><span class="dashicons dashicons-yes"></span><a target="_blank" href="https://imageattributespro.com/docs/?utm_source=iaff-basic&utm_medium=support-tab"><?php _e('Documentation', 'auto-image-attributes-from-filename-with-bulk-updater'); ?></a></li>
								<li><span class="dashicons dashicons-yes"></span><a target="_blank" href="https://wordpress.org/plugins/auto-image-attributes-from-filename-with-bulk-updater/#faq-header"><?php _e('Read the FAQ', 'auto-image-attributes-from-filename-with-bulk-updater'); ?></a></li>
								<li><span class="dashicons dashicons-yes"></span><a target="_blank" href="https://wordpress.org/support/plugin/auto-image-attributes-from-filename-with-bulk-updater"><?php _e('Free Support Forum', 'auto-image-attributes-from-filename-with-bulk-updater'); ?></a></li>
							</ul>
						</div>
					</div><!-- .iaff-support-block -->
					
					<!-- Premium Support -->
					<?php if ( iaff_is_pro() ) { ?>
						<div class="iaff-support-block">
							<div class="iaff-support-block-inner">
								<h2 class="patua showh2"><?php _e('Premium Support', 'auto-image-attributes-from-filename-with-bulk-updater'); ?></h2>
								<ul>
									<li><span class="dashicons dashicons-yes"></span><a target="_blank" href="https://imageattributespro.com/docs/?utm_source=iap&utm_medium=support-tab"><?php _e('Documentation', 'auto-image-attributes-from-filename-with-bulk-updater'); ?></a></li>
									<li><span class="dashicons dashicons-yes"></span><a target="_blank" href="https://imageattributespro.com/contact/?utm_source=iap&utm_medium=support-tab"><?php _e('Priority Email Support', 'auto-image-attributes-from-filename-with-bulk-updater'); ?></a></li>
									<li><span class="dashicons dashicons-yes"></span><a target="_blank" href="https://imageattributespro.com/contact/?utm_source=iap&utm_medium=support-tab"><?php _e('Contact Support', 'auto-image-attributes-from-filename-with-bulk-updater'); ?></a></li>
									
								</ul>
							</div>
						</div><!-- .iaff-support-block -->
					<?php } ?>
					
					<!-- Upgrade for Premium Support -->
					<?php if ( ! iaff_is_pro() ) { ?>
						<div class="iaff-support-block">
							<div class="iaff-support-block-inner">
								<a target="_blank" href="https://imageattributespro.com/?utm_source=iaff-basic&utm_medium=support-tab">
									<h2 class="patua showh2"><?php _e('Upgrade to Pro', 'auto-image-attributes-from-filename-with-bulk-updater'); ?></h2>
									<ul>
										<li><span class="dashicons dashicons-yes"></span><?php _e('Priority support', 'auto-image-attributes-from-filename-with-bulk-updater'); ?></li>
										<li><span class="dashicons dashicons-yes"></span><?php _e('Advanced features', 'auto-image-attributes-from-filename-with-bulk-updater'); ?></li>
										<li><span class="dashicons dashicons-yes"></span><?php _e('Support ongoing development', 'auto-image-attributes-from-filename-with-bulk-updater'); ?></li>
									</ul>
								</a>
							</div>
						</div><!-- .iaff-support-block -->
					<?php } ?>
					
				</div>
			</div><!-- .iaff-admin-options-main -->
			
			<!-- Upgrade to pro sidebar -->
			<?php if ( ! iaff_is_pro() ) { 
				
				// Modify sidebar if Image Attributes Pro is installed, but not activated.
				if ( file_exists( WP_PLUGIN_DIR . '/auto-image-attributes-pro/auto-image-attributes-pro.php' ) ) {
					$button_text =  __( 'Activate Image Attributes Pro', 'auto-image-attributes-from-filename-with-bulk-updater' );
					$button_link = wp_nonce_url( admin_url( 'admin-post.php?action=iaff_activate_image_attributes_pro_plugin' ), 'activate_image_attributes_pro_plugin', 'iaff_activate_image_attributes_pro_plugin_nonce_name' );
					$button_target = '';
				} else {
					$button_text = __( 'Upgrade to Pro', 'auto-image-attributes-from-filename-with-bulk-updater' );
					$button_link = 'https://imageattributespro.com/?utm_source=iaff-basic&utm_medium=coupon-sidebar';
					$button_target = '_blank'; 
				}
				?>
				<div class="iaff-admin-options-sidebar">
					
					<div class="iaff-upgrade-header">
						<a href="<?php echo $button_link; ?>" target="<?php echo $button_target; ?>">
							<div class="iaff-icon"></div>
							<h1 class="patua"><?php _e( 'Unlock Traffic', 'auto-image-attributes-from-filename-with-bulk-updater' ); ?></h1>
							<ul>
								<li><span class="dashicons dashicons-yes"></span><?php _e('Get more traffic from Google Images', 'auto-image-attributes-from-filename-with-bulk-updater'); ?></li>
								<li><span class="dashicons dashicons-yes"></span><?php _e('Use post / product title as attributes', 'auto-image-attributes-from-filename-with-bulk-updater'); ?></li>
								<li><span class="dashicons dashicons-yes"></span><?php _e('Preserve existing attributes', 'auto-image-attributes-from-filename-with-bulk-updater'); ?></li>
								<li><span class="dashicons dashicons-yes"></span><?php _e('Update attributes within posts', 'auto-image-attributes-from-filename-with-bulk-updater'); ?></li>
								<li><span class="dashicons dashicons-yes"></span><?php _e('Build custom attributes and fine tune settings', 'auto-image-attributes-from-filename-with-bulk-updater'); ?></li>
							</ul>
							<button class="button" style="width:100%"><?php echo $button_text; ?> &rarr; </button>
						</a>
					</div><!-- .iaff-upgrade-header -->
					
					<div class="iaff-upgrade-form">

						<div class="iaff-upgrade-review">
							<div class="iaff-upgrade-review-stars">
								<h3>"<?php _e('Fast &amp; Simple Time Saver', 'auto-image-attributes-from-filename-with-bulk-updater'); ?>"</h3>
								<?php echo str_repeat('<span class="dashicons dashicons-star-filled"></span>', 5); ?>
							</div>
							<div class="iaff-upgrade-review-detail">
								<div class="iaff-upgrade-review-detail-left">
									<img class="iaff-upgrade-review-avatar" src="<?php echo IAFF_IMAGE_ATTRIBUTES_FROM_FILENAME_URL . 'admin/img/checkerboardflyer.jpeg'; ?>" />
								</div>
								<div class="iaff-upgrade-review-detail-right">
									<p>"<?php _e('This plugin will save me a LOT of time! Great plugin!', 'auto-image-attributes-from-filename-with-bulk-updater'); ?>" <br><a target="_blank" href="https://wordpress.org/support/topic/fast-simple-time-saver/">@checkerboardflyer</a></p>
								</div>	
							</div>
						</div>

						<hr style="margin: 20px 0px;">
					
						<form method="post" action="https://imageattributespro.com/newsletter/" target="_blank">
							
							<h1 class="patua" style="text-align: center;"><?php _e( 'SEO Newsletter', 'auto-image-attributes-from-filename-with-bulk-updater' ); ?></h1>

							<?php $user = wp_get_current_user(); ?>

							<p><?php _e('Stay tuned to the latest image SEO news and receive helpful product updates.', 'auto-image-attributes-from-filename-with-bulk-updater'); ?></p>

							<fieldset>

								<input type="email" name="email" value="<?php echo esc_attr( $user->user_email ); ?>" placeholder="<?php _e('Your Email', 'auto-image-attributes-from-filename-with-bulk-updater'); ?>"/>

								<input type="hidden" name="source" value="IAFF" />
								<input type="hidden" name="submitted" id="submitted" value="true" />

								<input type="submit" class="button-primary" style="margin-top:5px;" value="<?php _e( 'Subscribe', 'auto-image-attributes-from-filename-with-bulk-updater' ); ?>"/>
								
							</fieldset>

							<p class="opacity-75"><?php _e('Your email will be kept private and will not be shared or spammed.', 'auto-image-attributes-from-filename-with-bulk-updater'); ?></p>
						</form>	
						
					</div><!-- .iaff-upgrade-form -->
				</div><!-- .iaff-admin-options-sidebar -->
			<?php } ?>
			
		</div><!-- .iaff-admin-options -->
	</div><!-- #iaff-pro .wrap -->
	<?php
}

/**
 * Print 'disabled' attribute to disable form inputs if compatible version if Image Attributes Pro is not installed.
 * 
 * @since 4.3
 * 
 * @param $version (string) The compatible version required to use the form input.
 * 
 * @return (string) Returns the string 'disabled' if installed version of Image Attributes Pro is lower than required version. Empty string otherwise.
 */
function iaff_disabled( $version ) {
	return defined( 'IAFFPRO_VERSION_NUM' ) && version_compare( IAFFPRO_VERSION_NUM, $version, '<' ) ? 'disabled' : '';
}

/**
 * Print notice to inform user why an option is disabled.
 * 
 * @since 4.3
 * 
 * @param $version (string) The compatible version required to use the form input.
 * 
 * @return (string) HTML notice if installed version of Image Attributes Pro is lower than required version. Empty string otherwise.
 */
function iaff_print_disabled_notice( $version ) {

	if ( iaff_disabled( $version ) != 'disabled' ) {
		return '';
	}

	echo 
		'<p class="iaff-description">' . 
			sprintf( __( 'Note: Requires Image Attributes Pro %s or newer to manage these options. <a href="%s" target="_blank">Read more.</a>', 'auto-image-attributes-from-filename-with-bulk-updater' ), $version, 'https://imageattributespro.com/backwards-compatibility/?utm_source=iaff-basic&utm_medium=bulk-updater-settings-tab' ) . 
		'</p>';
}