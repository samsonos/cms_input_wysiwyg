
SamsonCMS_InputWYSIWYG = function(textarea){

    // TODO #update 6
    /**
     * Manage wysiwyg in popup
     * Show wysiwyg in table as popup
     * Get dom elements
     */
    var parentTable = textarea.parent().parent().parent();

    // Handle click open and close
    s('.edit-value-wysiwyg', parentTable).click(function(e) {

        var parentBlock = s(e).parent(),
            popupLocal = s('.edit-value-wysiwyg-content', parentBlock),
            closeLink = s('.close-popup-wysiwyg-block-a', parentBlock);

        // Show popup and loader
        popupLocal.css('display', 'block');
        loader.show('', true);

        // Hide popup and loader
        closeLink.unbind('click');
        closeLink.click(function() {
            popupLocal.css('display', 'none');
            loader.hide('', true);
        });
    });

    var field = textarea.parent();

    // Current value view
    var sp = s('.note-editable.panel-body', field);

    // Add special class to display as it was on site
    sp.addClass('cms-content');

    // Original value
    var ov = s('.__hidden', field);

    // Save handler
    sp.blur(function (tb) {
        // Create loader object
        var loader = new Loader(field);

        // Get current tb value
        var new_value = tb.html();

        // If value changed
        if (new_value !== ov.val()) {
            sp.hide();
            loader.show();

            // Create form for async post
            form = s('<form method="post" enctype="multipart/form-data"></form>');

            // Set field action as form action
            form.a('action', s('input[name="__action"]', field).val());

            // Add all field hidden fields to form
            s('input[type="hidden"]', field).each(function (hidden) {
                form.append('<textarea name="' + hidden.a('name') + '">' + hidden.val() + '</textarea>');
            });

            // Add new field value
            form.append('<textarea name="__value">' + new_value + '</textarea>');

            // Perform ajax save
            form.ajaxForm(function (responce) {
                // Hide loader
                loader.remove();

                sp.show();

                // Save new value as original value
                ov.val(new_value);
            });
        }
    });
    /*});*/
}

SamsonCMS_InputWYSIWYG_SUMMERNOTE = function(){
    $('.__wysiwyg .__input').summernote({
        fontsize: '18px',
        // Handle image uploading
        onImageUpload: function(files) {
            if(files[0]) { // If we have file
                // Call async file uploader from samsonphp/upload
                asyncFileUploader(files[0], {
                    // Get controller url from markup
                    url:s('input[name=__imageupload_action]').val(),
                    // Output received tag to current editor position
                    successHandler:function(response){
                        $(document.getSelection().anchorNode.parentNode).append(response.tag);
                    }
                });
            }
        },
        height: 425                 // set editor height
    });
}

// Bind input
SamsonCMS_Input.bind(SamsonCMS_InputWYSIWYG_SUMMERNOTE, '.__wysiwyg .__input');
SamsonCMS_Input.bind(SamsonCMS_InputWYSIWYG, '.__wysiwyg .__input');
