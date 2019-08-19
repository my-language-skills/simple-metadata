<?php
/**
 * Creates the metaboxe 'GoogleImage' for post, page and every cpt that supports post thumbnail
 *
 * Description. (use period)
 *
 * @link URL
 *
 * @package simple-metadata
 * @subpackage simple-metadata/smd-googleImage-metabox
 * @since 1.4
 */


 /**
 * Initialize metabox
 *
 * @since 1.4
 *
 */
function smd_create_googleImage_box ($post_type) {
	if (1 != get_current_blog_id() || !is_multisite()){
		if(!is_front_page() && post_type_supports( $post_type, 'thumbnail' )){
			//is not front page and the current post support "feature image"
			add_meta_box( 'smd_googleImage_box', __( 'Google Image', 'simple-metadata' ), 'smd_render_googleImage_box', $post_type, 'side', 'low');
		}
	}
}
add_action( 'add_meta_boxes', 'smd_create_googleImage_box' );


/**
* Render the content in the box
*
* @since 1.4
*
*/
function smd_render_googleImage_box ( $post ) {
	global $content_width, $_wp_additional_image_sizes;
	$image_id = get_post_meta( $post->ID, 'smd_googleImage_id', true );
	$old_content_width = $content_width;
	$content_width = 254; //the size to display the image
	$content = '<p class="description">This image will not be displayed, it is just for metadata. <br>
For best results, provide a image with one of the following aspect ratios: 16x9, 4x3, or 1x1.</p>';
	if ( $image_id && get_post( $image_id ) ) {
		if ( ! isset( $_wp_additional_image_sizes['post-thumbnail'] ) ) {
			$thumbnail_html = wp_get_attachment_image( $image_id, array( $content_width, $content_width ) );
		} else {
			$thumbnail_html = wp_get_attachment_image( $image_id, 'post-thumbnail' );
		}
		if ( ! empty( $thumbnail_html ) ) {
			//If the image exist
			$content .=  $thumbnail_html;
			$content .= '<p class="hide-if-no-js"><a href="javascript:;" id="smd_remove_googleImage_button" >' . esc_html__( 'Remove Google Image', 'simple-metadata' ) . '</a></p>';
			$content .= '<input type="hidden" id="smd_upload_googleImage" name="smd_googleImage_cover" value="' . esc_attr( $image_id ) . '" />';
		}
		$content_width = $old_content_width;
	} else {
		//the image is not in the database
		$content .= '<img src="" style="width:' . esc_attr( $content_width ) . 'px;height:auto;border:0;display:none;" />';
		$content .= '<p class="hide-if-no-js"><a title="' . esc_attr__( 'Set Google image', 'simple-metadata' ) . '" href="javascript:;" id="smd_upload_googleImage_button" id="set-googleImage" data-uploader_title="' . esc_attr__( 'Choose an image', 'simple-metadata' ) . '" data-uploader_button_text="' . esc_attr__( 'Set Google image', 'simple-metadata' ) . '">' . esc_html__( 'Set Google image', 'simple-metadata' ) . '</a></p>';
		$content .= '<input type="hidden" id="smd_upload_googleImage" name="smd_googleImage_cover" value="" />';
	}
	echo $content;
}

/**
* Save the content for the metabox
*
* @since 1.4
*
*/
function smd_save_googleImage ( $post_id ) {
	if( isset( $_POST['smd_googleImage_cover'] ) ) {
		$image_id = (int) $_POST['smd_googleImage_cover'];
		update_post_meta( $post_id, 'smd_googleImage_id', $image_id );
	}
}
// When the post is saved
add_action( 'save_post', 'smd_save_googleImage', 10, 1 );


/**
* Enqueue js for googleImae metabox
*
* @since 1.4
*
*/
function smd_enqueue_googleImage_script() {
	wp_enqueue_script( 'smd-googleImage-box', plugins_url( 'simple-metadata') . '/inc/assets/js/smd-googleImage-box.js', array( 'jquery' ));
}
add_action( 'admin_enqueue_scripts', 'smd_enqueue_googleImage_script');
