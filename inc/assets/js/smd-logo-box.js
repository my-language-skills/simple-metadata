jQuery(document).ready(function($){
  var mediaUploader;
  $('#smd_upload_image_button').click(function(e) {
    e.preventDefault();
      if (mediaUploader) {
      mediaUploader.open();
      return;
    }
    mediaUploader = wp.media.frames.file_frame = wp.media({
      title: 'Choose Image',
      button: {
      text: 'Choose Image'
    }, multiple: false });
    mediaUploader.on('select', function() {
      var attachment = mediaUploader.state().get('selection').first().toJSON();
		//	$('#smd_logo_image_url').val(attachment.url);
			$('#smd_organization_logo_image_id').val(attachment.id);
    });
    mediaUploader.open();
  });

    $('#smd_unset_image_button').click(function(f){
      $('#smd_organization_logo_image_id').removeAttr('value');
      $('#smd_unset_image_button').attr('disabled','disabled');
      alert("Image unset! Do not forget to save changes bellow");      
    });
});
