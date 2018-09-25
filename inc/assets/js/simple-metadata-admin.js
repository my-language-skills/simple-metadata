jQuery(document).ready(function ($) {

    //Code used to remove the Button (Add new site metadata) from the CPT Named Site-Meta
    var txt =  $('.page-title-action').text();

    if(txt == 'Add New Site Metadata'){
        $('.page-title-action').hide();
    }
});