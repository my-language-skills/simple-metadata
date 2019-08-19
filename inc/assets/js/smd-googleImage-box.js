jQuery(document).ready(function($) {

	// Uploading files
	var file_frame;

	jQuery.fn.smd_upload_googleImage = function( button ) {
		var button_id = button.attr('id');
		var field_id = button_id.replace( '_button', '' );

		// If the media frame already exists, reopen it.
		if ( file_frame ) {
		  file_frame.open();
		  return;
		}

		// Create the media frame.
		file_frame = wp.media.frames.file_frame = wp.media({
		  title: jQuery( this ).data( 'uploader_title' ),
		  button: {
		    text: jQuery( this ).data( 'uploader_button_text' ),
		  },
		  multiple: false
		});

		// When an image is selected, run a callback.
		file_frame.on( 'select', function() {
		  var attachment = file_frame.state().get('selection').first().toJSON();
		  jQuery("#"+field_id).val(attachment.id);
		  jQuery("#smd_googleImage_box img").attr('src',attachment.url);
		  jQuery( '#smd_googleImage_box img' ).show();
		  jQuery( '#' + button_id ).attr( 'id', 'smd_remove_googleImage_button' );
		  jQuery( '#smd_remove_googleImage_button' ).text( 'Remove Google image' );
		});

		// Finally, open the modal
		file_frame.open();
	};

	jQuery('#smd_googleImage_box').on( 'click', '#smd_upload_googleImage_button', function( event ) {
		event.preventDefault();
		jQuery.fn.smd_upload_googleImage( jQuery(this) );
	});

	jQuery('#smd_googleImage_box').on( 'click', '#smd_remove_googleImage_button', function( event ) {
		event.preventDefault();
		jQuery( '#smd_upload_googleImage' ).val( '' );
		jQuery( '#smd_googleImage_box img' ).attr( 'src', '' );
		jQuery( '#smd_googleImage_box img' ).hide();
		jQuery( this ).attr( 'id', 'smd_upload_googleImage_button' );
		jQuery( '#smd_upload_googleImage_button' ).text( 'Set Google image' );
	});

});
