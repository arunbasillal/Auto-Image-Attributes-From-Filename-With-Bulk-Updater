<?php
/**
 * Display image attributes as columns in the Media Library.
 * 
 * @since 4.4
 */

// Exit if accessed directly
if ( ! defined('ABSPATH') ) exit;

add_filter( 'manage_media_columns', 'iaff_manage_media_columns_add_columns' );
add_action( 'manage_media_custom_column', 'iaff_manage_media_custom_column_add_data', 10, 2 );

/**
 * Add columns in Media Library for each of the image attributes.
 * 
 * @since 4.4
 * 
 * @param $columns (array) An array of columns displayed in the Media list table.
 */
function iaff_manage_media_columns_add_columns( $columns ) {

    $columns['iaff_image_title'] = esc_html__( 'Title', 'auto-image-attributes-from-filename-with-bulk-updater' );
    $columns['iaff_image_alt'] = esc_html__( 'Alternative Text', 'auto-image-attributes-from-filename-with-bulk-updater' );
    $columns['iaff_image_caption'] = esc_html__( 'Caption', 'auto-image-attributes-from-filename-with-bulk-updater' );
    $columns['iaff_image_description'] = esc_html__( 'Description', 'auto-image-attributes-from-filename-with-bulk-updater' ) . '&nbsp;<a target="_blank" title="Read More." href="https://imageattributespro.com/media-library-bulk-editing/?utm_source=iaff-basic&utm_medium=media-library-info-button"><span class="dashicons dashicons-info"></span></a>';

    return $columns;
}

/**
 * Add image attributes data to the columns in the Media Library for each of the images.
 * 
 * @since 4.4
 * 
 * @param $column_name (string) Name of the custom column.
 * @param $id (int) Attachment ID.
 */
function iaff_manage_media_custom_column_add_data( $column_name, $id ) {

    // Retrieve image object from its ID
	$image = get_post( $id );

    if ( $image === NULL ) {
        return '';
    }

    switch( $column_name ) {
        case 'iaff_image_title':
            echo $image->post_title;
            break;

        case 'iaff_image_alt':
            $iaff_image_alt = get_post_meta( $id, '_wp_attachment_image_alt', true );
            echo ( $iaff_image_alt !== false ) ? $iaff_image_alt : '';
            break;

        case 'iaff_image_caption':
            echo $image->post_excerpt;
            break;

        case 'iaff_image_description':
            echo $image->post_content;
            break;
    }
}