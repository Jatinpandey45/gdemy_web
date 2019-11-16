var imageCropper = false
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
                    saveEventRegister(this.toolbar.element.children[3]);
                },  
            }
        );
    };
});
$(document).on('click', '#uploaded-image', function() {
    var activeObject = imageCropper.canvas.getActiveObject();
    $(document).find('#file_hidden').val($(document).find('#image-preview > img').attr('src'));
    $('#cropperModal').modal('toggle');
});
function saveEventRegister(elem) {
    $(elem).on('click', function() {
        $(document).find('#image-preview').hide();
        setTimeout(function() {
            $(document).find('#image-preview > img').addClass('img-fluid');
            $(document).find('#image-preview').show();
        }, 100);
    });
}