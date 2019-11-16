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
                                    <input type="hidden" name="file_hidden" id="file_hidden" value="" />
                                    {{-- <input type="hidden" name="top" id="top" value="" />
                                    <input type="hidden" name="width" id="width" value="" />
                                    <input type="hidden" name="height" id="height" value="" /> --}}
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
