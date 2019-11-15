<div class="modal fade" id="cropperModal" tabindex="-1" role="dialog" aria-labelledby="cropperModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Upload Image</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="container">
                <div class="panel panel-info">
                    {{-- <div class="panel-heading">/div> --}}
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12 form-group" id="image-preview">
                                    {{-- <img id="preview-crop-image"  style="display: none;" class="img-responsive img-fluid"/> --}}
                                </div>
                                <div class="col-md-12 form-group">
                                    {{-- <label>Select image to crop:</label> --}}
                                    <input type="file" id="{{$name}}" class="image" name="{{$name}}">
                                    <input type="hidden" name="left" id="left" value="" />
                                    <input type="hidden" name="top" id="top" value="" />
                                    <input type="hidden" name="width" id="width" value="" />
                                    <input type="hidden" name="height" id="height" value="" />
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary" id="uploaded-image">Done</button>
        </div>
        </div>
    </div>
</div>

@section('pagescript')
    <script type="text/javascript" src={{asset('node_modules/darkroom/vendor/fabric.js')}}></script>
    <script type="text/javascript" src={{asset('node_modules/darkroom/build/darkroom.js')}}></script>
    <script type="text/javascript">
        var imageCropper = false
        $(document).on("change", ".image", function(){
            
            var imageReader = new FileReader();
            console.log(imageReader);
            imageReader.readAsDataURL(document.querySelector(".image").files[0]);
            
            imageReader.onload = function (oFREvent) {
                // console.log(typeof imageCropper !== 'undefined');
                // if (imageCropper) {
                //     imageCropper.selfDestroy();
                // }
                $('#image-preview').find('.darkroom-container').remove();
                $('#image-preview').append('<img src="'+oFREvent.target.result+'" id="preview-crop-image" class="img-responsive" style="display: none;"/>');
                var p = $(document).find("#preview-crop-image");
                // p.show(20);
                // p.attr('src', oFREvent.target.result).fadeIn();
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

                        // Plugins options
                        plugins: {
                            crop: {
                            // minHeight: 50,
                            // minWidth: 50,
                            // ratio: 1
                            },
                            save: false // disable plugin,
                        },

                        // Post initialization method
                        initialize: function() {
                            // Active crop selection
                            this.plugins['crop'].requireFocus();
                            this.toolbar.element.children[2].children[1].remove();
                            this.toolbar.element.children[2].children[1].remove();
                            // Add custom listener
                            // this.addEventListener('core:transformation', function() { /* ... */ });
                        },
                        // save: function() {
                        //     alert('hi');
                        //         // oFREvent.target.result = 
                        //         console.log('saved!');
                        //         var oMyForm = new FormData();
                        //         oMyForm.append("ContentID", $('#ID').val());
                        //         oMyForm.append("Title", $('#Title').val());
                        //         oMyForm.append("ContentType", 'content');
                        //         //Now the file (large version)
                        //         var oBlob = dkrm.sourceImage.toDataURL();

                        //         oMyForm.append("ImgFile", oBlob);
                        //         console.log(oMyForm);

                        // },
                        // save: {
                        //     callback : function() {
                        //         alert('hi');
                        //         console.log(this);
                        //     }
                        // }
                    }
                );
                console.log(imageCropper);
            };
        });
        $(document).on('click', '#uploaded-image', function() {
            var activeObject = imageCropper.canvas.getActiveObject();
            if (typeof activeObject != 'undefined') {
                console.log(activeObject.left);
                $(document).find('#left').val(activeObject.left);
                $(document).find('#top').val(activeObject.top);
                $(document).find('#width').val(activeObject.width);
                $(document).find('#height').val(activeObject.height);
                $('#cropperModal').modal('toggle');
            }
        });
    </script>
@endsection


@section('css')
    <link rel="stylesheet" href="{{asset('node_modules/darkroom/build/darkroom.css')}}">
@endsection