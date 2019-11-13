<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.min.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/croppie/2.6.2/croppie.js"></script>
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/imgareaselect/0.9.10/css/imgareaselect-animated.css">
<script src="https://cdnjs.cloudflare.com/ajax/libs/imgareaselect/0.9.10/js/jquery.imgareaselect.min.js"></script>
<div class="modal fade" id="cropperModal" tabindex="-1" role="dialog" aria-labelledby="cropperModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title">Delete?</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
            <div class="container">
                <div class="panel panel-info">
                    <div class="panel-heading">Laravel 5.6 - Preview and Crop Image Before Upload using Ajax- HDTuto.com</div>
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-4 text-center">
                                    <div id="upload-demo"></div>
                                </div>
                                <div class="col-md-4" style="padding:5%;">
                                    <strong>Select image to crop:</strong>
                                    <input type="file" id="image" class="image">
                                    <input type="hidden" name="x1" value="" />
                                    <input type="hidden" name="y1" value="" />
                                    <input type="hidden" name="w" value="" />
                                    <input type="hidden" name="h" value="" />
                                    <button class="btn btn-primary btn-block upload-image" style="margin-top:2%">Upload Image</button>
                                </div>
                                <div class="col-md-4">
                                    <div id="preview-crop-image" style="background:#9d9d9d;width:300px;padding:50px 50px;height:300px;"></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-primary">Delete</button>
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancel</button>
        </div>
        </div>
    </div>
</div>

{{-- <input type="hidden" name="x1" value="" />
<input type="hidden" name="y1" value="" />
<input type="hidden" name="w" value="" />
<input type="hidden" name="h" value="" />
<div class="row mt-5">
    <p><img id="previewimage" style="display:none;"/></p>
    @if(session('path'))
        <img src="{{ session('path') }}" />
    @endif
</div>
       --}}
<script type="text/javascript">
    $(document).ready(function() {
        var p = $("#preview-crop-image");
        $("body").on("change", ".image", function(){

            var imageReader = new FileReader();
            console.log(imageReader);
            imageReader.readAsDataURL(document.querySelector(".image").files[0]);

            imageReader.onload = function (oFREvent) {
                p.attr('src', oFREvent.target.result).fadeIn();
            };
        });

        $('#preview-crop-image').imgAreaSelect({
            onSelectEnd: function (img, selection) {
                $('input[name="x1"]').val(selection.x1);
                $('input[name="y1"]').val(selection.y1);
                $('input[name="w"]').val(selection.width);
                $('input[name="h"]').val(selection.height);            
            }
        });
        console.log(p);
    })
    // $.ajaxSetup({
    //     headers: {
    //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    //     }
    // });
    
    // var resize = $('#upload-demo').croppie({
    
    //     enableExif: true,
    
    //     enableOrientation: true,    
    
    //     viewport: { 
    
    //         width: 200,
    
    //         height: 200,
    
    //         type: 'circle'
    
    //     },
    
    //     boundary: {
    
    //         width: 300,
    
    //         height: 300
    
    //     }
    
    // });
    
    // $('#image').on('change', function () { 
    //     var reader = new FileReader();
    //     reader.onload = function (e) {
    //         resize.croppie('bind',{
    //             url: e.target.result
    //         }).then(function(){
    //             console.log('jQuery bind complete');
    //         });
    //     }
    //     reader.readAsDataURL(this.files[0]);
    // });
    
    // $('.upload-image').on('click', function (ev) {
    //     resize.croppie('result', {
    //         type: 'canvas',
    //         size: 'viewport'
    //     }).then(function (img) {
    //         $.ajax({
    //             url: "{{route('categories.create')}}",
    //             type: "POST",
    //             data: {"image":img},
    //             success: function (data) {
    //                 html = '<img src="' + img + '" />';
    //                 $("#preview-crop-image").html(html);
    //             }
    //         });
    //     });
    // });
</script>
    