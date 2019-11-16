var imageCropper = false
var saveElement = 'undefined';
var okButton = 'undefined';
$(document).on("change", ".image", function(){
    
    var imageReader = new FileReader();
    imageReader.readAsDataURL(document.querySelector(".image").files[0]);
    
    imageReader.onload = function (oFREvent) {
        $('#image-preview').find('.darkroom-container').remove();
        $('#image-preview').html('<img src="'+oFREvent.target.result+'" id="preview-crop-image" class="img-responsive" style="display: none;"/>');
        var p = $(document).find("#preview-crop-image");
        imageCropper = new Darkroom(
            '#preview-crop-image',
            {
                save: {
                    callback: function() {
                        console.log(this);
                    }
                },
            // Canvas initialization size
                minWidth: 100,
                minHeight: 100,
                maxWidth: 500,
                maxHeight: 500,

                // Post initialization method
                initialize: function() {
                    // Active crop selection
                    this.plugins['crop'].requireFocus();
                    saveElement = this.toolbar.element.children[3];
                    okButton = this.toolbar.element.children[2].children[1];
                    saveEventRegister(this.toolbar.element.children[3]);
                },  
            }
        );
    };
});
var okClickInterval = 'undefined';
$(document).on('click', '#uploaded-image', function() {
    $(okButton).trigger('click');
    if (typeof okClickInterval != 'undefined') {
        clearTimeout(okClickInterval);
    }
    okClickInterval = setTimeout(function() {
        $(saveElement).find('button').trigger('click');
    }, 200);
    // $(document).find('#file_hidden').val($(document).find('#image-preview > img').attr('src'));
    $('#cropperModal').modal('toggle');
});

var timeInterval = 'undefined';
function saveEventRegister(elem) {
    $(elem).on('click', function() {
        $(document).find('#image-preview').hide();
        if (typeof timeInterval != 'undefined') {
            clearTimeout(timeInterval);
        }
        timeInterval = setTimeout(function() {
            $(document).find('#image-preview > img').addClass('img-fluid');
            $(document).find('#image-preview').show();
            $(document).find('#file_hidden').val($(document).find('#image-preview > img').attr('src'));
        }, 100);
    });
}